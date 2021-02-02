<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
		 \App\Models\Reply::class => \App\Policies\ReplyPolicy::class,
		 \App\Models\Topic::class => \App\Policies\TopicPolicy::class,
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];


    public function boot()
    {
        $this->registerPolicies();

        // 修改 policy 使自動發現
        Gate::guessPolicyNamesUsing(function ($modelClass) {
            // 動態返回模型對應的策略名稱，如：// 'App\Model\User' => 'App\Policies\UserPolicy',
            return 'App\Policies\\'.class_basename($modelClass).'Policy';
        });

        \Horizon::auth(function ($request) {
            // 是站長 才可看到 horizon
            if(\Auth::user()){
                return \Auth::user()->hasRole('Founder');
            }
            
            return false;
        });

    }
}
