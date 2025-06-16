<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait HasPermissionCheck
{
    /**
     * Abort with 403 if user doesn't have permission.
     */
    public function authorizePermission(string $permissionName): void
    {

        abort_unless($this->hasPermission($permissionName), 403, 'Unauthorized');
    }

    /**
     * Check if the logged-in user has a specific permission.
     */
    public function hasPermission(string $permissionName): bool
    {
        $user = Auth::user();
        if (!$user) {
            return false;
        }

        return $user->roles()->whereHas('permissions', function ($q) use ($permissionName) {
            $q->where('name', $permissionName);
        })->exists();
    }
}
