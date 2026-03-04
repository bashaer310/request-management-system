<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Request;
use App\Policies\RequestPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Request::class => RequestPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
