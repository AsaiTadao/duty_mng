<?php

namespace App\Providers;

use App\Constants\Roles;
use App\Models\Office;
use App\Models\User;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /**
         * Defining the user Roles
         */
        Gate::define('admin-only', function ($user) {
            return $user->role_id === Roles::ADMIN;
        });
        $userOfficeGuard = function(User $user, Office $office) {
            if ($user->role_id === Roles::ADMIN) return true;
            if ($user->role_id === Roles::USER_B) return false;
            $user_office = $user->office;
            if (!$user_office) return false;

            if ($user->role_id === Roles::REGION_MANAGER) {
                if (!$user_office->region_id) return false;
                return $office->region_id === $user_office->region_id;
            }
            return $office->id === $user_office->id;
        };
        Gate::define('get-scheduled-working-office', $userOfficeGuard);
        Gate::define('get-shift-office', $userOfficeGuard);

        Gate::define('get-offices', function(User $user) {
            if ($user->role_id === Roles::ADMIN) return true;
            if ($user->role_id === Roles::USER_B) return false;
            $user_office = $user->office;
            if (!$user_office) return false;
            return true;
        });
    }
}
