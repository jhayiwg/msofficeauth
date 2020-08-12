<?php

namespace LaraOffice\MsOfficeAuth\TokenStore;

use Illuminate\Support\Facades\Storage;

class TokenCache {

  private $token_name;
  public function __construct( $token_name = 'office365.json' )
  {
    $this->token_name = $token_name;
  }
  public function storeTokens($accessToken) {

    Storage::put($this->token_name, serialize([
        "accessToken" => $accessToken->getToken(),
        "refreshToken" => $accessToken->getRefreshToken(),
        "tokenExpires" => $accessToken->getExpires()
    ]));
    
  }

  public function updateTokens($accessToken) {
    session([
      'accessToken' => $accessToken->getToken(),
      'refreshToken' => $accessToken->getRefreshToken(),
      'tokenExpires' => $accessToken->getExpires()
    ]);
  }

  public function clearTokens() {
    Storage::delete($this->token_name);
  }

  public function getAccessToken() {
    // Check if tokens exist
    $token = $this->val();
    
    $accessToken = $this->key('accessToken', $token);
    $refreshToken = $this->key('refreshToken', $token);
    $tokenExpires = $this->key('tokenExpires', $token);

    if ( ! $this->isExist()) {
      return '';
    }

    // Check if token is expired
    //Get current time + 5 minutes (to allow for time differences)
    $now = time() + 300;
    if ($tokenExpires <= $now) {
      // Token is expired (or very close to it)
      // so let's refresh

      // Initialize the OAuth client
      $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
        'clientId'                => env('OAUTH_APP_ID'),
        'clientSecret'            => env('OAUTH_APP_PASSWORD'),
        'redirectUri'             => env('OAUTH_REDIRECT_URI'),
        'urlAuthorize'            => env('OAUTH_AUTHORITY').env('OAUTH_AUTHORIZE_ENDPOINT'),
        'urlAccessToken'          => env('OAUTH_AUTHORITY').env('OAUTH_TOKEN_ENDPOINT'),
        'urlResourceOwnerDetails' => '',
        'scopes'                  => env('OAUTH_SCOPES')
      ]);

      try {
        $newToken = $oauthClient->getAccessToken('refresh_token', [
          'refresh_token' => $refreshToken
        ]);

        // Store the new values
        $this->storeTokens($newToken);

        return $newToken->getToken();
      }
      catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        Log::info('Unable to create Token');
        return '';
      }
    }

    // Token is still valid, just return it
    return $accessToken;
  }

  public function key( $key, $token = false )
  {
    if( ! $token )
      $token = $this->val();

    if( isset($token[$key]) ) {
      return $token[$key];
    }
    return false;
  }
  
  public function val()
  {
    return  unserialize(Storage::get($this->token_name));
  }

  public function isExist()
  {
    return Storage::exists( $this->token_name );
  }
}