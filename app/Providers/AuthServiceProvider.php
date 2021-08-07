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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->policyCategory();
        $this->policyProduct();
        $this->policyRole();
        $this->policyRule();
        $this->policyUser();
    }

    public function policyCategory()
    {
        // policy category controller
        Gate::define('list_category', 'App\Policies\CategoryPolicy@viewAny');
        Gate::define('delete_category', 'App\Policies\CategoryPolicy@delete');
        Gate::define('edit_category', 'App\Policies\CategoryPolicy@update');
        Gate::define('add_category', 'App\Policies\CategoryPolicy@create');
    }

    public function policyProduct()
    {
        // policy product controller
        Gate::define('list_product', 'App\Policies\ProductPolicy@viewAny');
        Gate::define('delete_product', 'App\Policies\ProductPolicy@delete');
        Gate::define('edit_product', 'App\Policies\ProductPolicy@update');
        Gate::define('create_product', 'App\Policies\ProductPolicy@create');
    }
    public function policyRole()
    {
        // policy role controller
        Gate::define('list_role', 'App\Policies\AuthorizationRolePolicy@viewAny');
        Gate::define('delete_role', 'App\Policies\AuthorizationRolePolicy@delete');
        Gate::define('edit_role', 'App\Policies\AuthorizationRolePolicy@update');
        Gate::define('create_role', 'App\Policies\AuthorizationRolePolicy@create');
    }
    public function policyRule()
    {
        // policy rule controller
        Gate::define('list_rule', 'App\Policies\AuthorizationRulePolicy@viewAny');
        Gate::define('delete_rule', 'App\Policies\AuthorizationRulePolicy@delete');
        Gate::define('edit_rule', 'App\Policies\AuthorizationRulePolicy@update');
        Gate::define('create_rule', 'App\Policies\AuthorizationRulePolicy@create');
    }
    public function policyUser()
    {
        // policy user controller
        Gate::define('list_user', 'App\Policies\UserPolicy@viewAny');
        Gate::define('delete_user', 'App\Policies\UserPolicy@delete');
        Gate::define('edit_user', 'App\Policies\UserPolicy@update');
        Gate::define('create_user', 'App\Policies\UserPolicy@create');
    }


}
