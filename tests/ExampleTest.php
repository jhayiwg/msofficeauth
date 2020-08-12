<?php

namespace LaraOffice\MsOfficeAuth\Tests;

use Orchestra\Testbench\TestCase;
use LaraOffice\MsOfficeAuth\MsOfficeAuthServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [MsOfficeAuthServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
