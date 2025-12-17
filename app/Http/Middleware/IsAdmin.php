<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $adminId = session('admin_id');
        if (!$adminId) {
            return redirect()->route('admin.login');
        }
        $admin = Admin::find($adminId);
        if (!$admin) {
            session()->forget('admin_id');
            return redirect()->route('admin.login');
        }
        // make admin available in views
        view()->share('admin', $admin);
        return $next($request);
    }
}
