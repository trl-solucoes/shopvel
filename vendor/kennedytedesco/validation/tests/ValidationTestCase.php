<?php

use Orchestra\Testbench\TestCase;

abstract class ValidationTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            'KennedyTedesco\Validation\ValidationServiceProvider',
        ];
    }

    protected function validate(array $data, array $rules, array $messages = [])
    {
        return $this->app->make('validator')->make($data, $rules, $messages);
    }
}
