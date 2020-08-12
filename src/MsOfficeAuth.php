<?php

namespace LaraOffice\MsOfficeAuth;

use Microsoft\Graph\Graph;
use LaraOffice\MsOfficeAuth\TokenStore\TokenCache;

class MsOfficeAuth
{
    // Build your next great package.
    private $tokenCache;

    public function __construct()
    {
        $this->tokenCache = new TokenCache('office365.json');
    }

    public function getAccessToken()
    {
        return $this->tokenCache->getAccessToken();
    }

    public function graph()
    {
        $accessToken = $this->getAccessToken();
        if( empty($accessToken) ) return false;
        
        $graph = new Graph();
        $graph->setAccessToken($accessToken);
        return $graph;
    }
}
