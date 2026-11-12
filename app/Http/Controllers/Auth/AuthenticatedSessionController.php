<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{


public function createAdmin(): View
{
    return view('auth.admin-login');
}

public function createEmployee(): View
{
    return view('auth.employee-login');
}

public function storeAdmin(LoginRequest $request): RedirectResponse
{
    return $this->authenticateForRole($request, 'admin');
}

public function storeEmployee(LoginRequest $request): RedirectResponse
{
    return $this->authenticateForRole($request, 'employee');
}

private function authenticateForRole(
    LoginRequest $request,
    string $requiredRole
): RedirectResponse {
    $request->authenticate();

    $user = Auth::user();

    if (!$user || $user->role !== $requiredRole) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $loginRoute = $requiredRole === 'admin'
            ? 'admin.login'
            : 'employee.login';

        return redirect()->route($loginRoute)
            ->withErrors([
                'email' => 'These credentials are not authorized for this login page.',
            ]);
    }

    $request->session()->regenerate();

    if ($requiredRole === 'admin') {
        return redirect()->route('dashboard');
    }

    return redirect()->route('employee.dashboard');
}

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        }

        if ($user->role === 'employee') {
            return redirect()->route('employee.dashboard');
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->withErrors([
                'email' => 'Your account role is not authorized.',
            ]);
    }

    /**
     * Destroy an authenticated session.
     */
   public function destroy(Request $request): RedirectResponse
{
    $user = Auth::user();

    $loginRoute = $user && $user->role === 'admin'
        ? 'admin.login'
        : 'employee.login';

    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route($loginRoute);
}
}
