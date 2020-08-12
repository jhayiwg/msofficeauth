# Laravel Office 365 server to server token management

This package if for server to server processing.

## Installation

You can install the package via composer:

```bash
composer require jhayiwg/msofficeauth
```

## Usage
Add to your .env, check https://docs.microsoft.com/en-us/graph/tutorials/php?tutorial-step=2 for referrence
```
OAUTH_APP_ID="XXXX"
OAUTH_APP_PASSWORD="XXXXX"
OAUTH_REDIRECT_URI=https://yoursite.loc/office/auth
OAUTH_SCOPES='openid profile offline_access user.read mail.read'
OAUTH_AUTHORITY=https://login.microsoftonline.com/common
OAUTH_AUTHORIZE_ENDPOINT=/oauth2/v2.0/authorize
OAUTH_TOKEN_ENDPOINT=/oauth2/v2.0/token
```

### Authentication and Authorization
After setting up, visit visiting https://yoursite.loc/office/signin, login to your ms account then authorize the app. 

The package will store or re-generate the token on your storage folder.

### Automatic Injection
To use in the controller

``` php
// Usage description here
namespace App\Http\Controllers;

use Microsoft\Graph\Model;
use LaraOffice\MsOfficeAuth\MsOfficeAuth;

class HomeController extends Controller
{
    public function index(MsOfficeAuth $msGraph)
    {
        $tokenExpired = $msGraph->getAccessToken() ? 'No' : 'Yes';
        $graph = $msGraph->graph();
        $user = $graph->createRequest('GET', '/me')
            ->setReturnType(Model\User::class)
            ->execute();
        $userEmail = $user->getMail();
        return view('home', compact('tokenExpired', 'userEmail'));
    }
}
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email jhayghost@gmail.com instead of using the issue tracker.

## Credits

- [Jhay](https://github.com/jhayiwg)