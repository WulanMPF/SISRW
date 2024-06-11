<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CekRole
{
    /**
     * Check if the authenticated user has the given role.
     *
     * @param  string  $role
     * @return bool
     */
    public static function check(string $role)
    {
        $user = Auth::user();
        $roleId = self::getRoleIdByRoleName($role);

        Log::info('User level_id: ' . ($user ? $user->level_id : 'none') . ', required level_id: ' . $roleId);
        return $user && $user->level_id === $roleId;
    }

    /**
     * Get role ID by role name.
     *
     * @param  string  $role
     * @return int|null
     */
    private static function getRoleIdByRoleName(string $role)
    {
        $roles = [
            'admin' => 1,
            'ketua' => 2,
            'sekretaris' => 3,
            'bendahara' => 4,
            'warga' => 5,
        ];

        return $roles[$role] ?? null;
    }
}
