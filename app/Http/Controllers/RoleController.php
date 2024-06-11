<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function switchRole($role)
    {
        // Periksa apakah user memiliki akses ke peran yang akan diganti
        if (in_array($role, [2, 3, 4, 5])) { // Sesuaikan ID level peran sesuai dengan sistem Anda
            session(['active_role' => $role]);
            return redirect()->route($this->getDashboardRoute($role));
        }

        return redirect()->back()->with('error', 'Peran tidak valid');
    }

    private function getDashboardRoute($role)
    {
        switch ($role) {
            case 2:
                return 'ketua.dashboard';
            case 3:
                return 'sekretaris.dashboard';
            case 4:
                return 'bendahara.dashboard';
            case 5:
                return 'warga.dashboard';
            default:
                return 'login';
        }
    }
}
