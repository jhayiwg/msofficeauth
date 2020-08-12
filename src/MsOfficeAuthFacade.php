<?php

namespace LaraOffice\MsOfficeAuth;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaraOffice\MsOfficeAuth\Skeleton\SkeletonClass
 */
class MsOfficeAuthFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'msofficeauth';
    }
}
