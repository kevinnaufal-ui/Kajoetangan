<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $credentials['email'])->first();
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            // store admin in session
            session(['admin_id' => $admin->id, 'admin_name' => $admin->name]);
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showRegister()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:admins,email',
            'password' => 'required|string|min:6',
        ]);
        $admin = Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Auto-login after register
        session(['admin_id' => $admin->id, 'admin_name' => $admin->name]);
        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        session()->forget(['admin_id','admin_name']);
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    /**
     * Hapus akun admin yang sedang login
     */
    public function destroy(Request $request)
    {
        $adminId = session('admin_id');
        if ($adminId) {
            $admin = \App\Models\Admin::find($adminId);
            if ($admin) {
                $admin->delete();
            }
            session()->forget(['admin_id','admin_name']);
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return redirect()->route('admin.login')->with('status', 'Akun admin berhasil dihapus.');
    }
}
