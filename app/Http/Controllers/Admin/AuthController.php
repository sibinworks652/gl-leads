<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organisation;
use App\Support\ModuleRegistry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm(?Organisation $organisation = null)
    {
        return view('admin.auth.login', [
            'organisation' => $organisation,
        ]);
    }

    public function login(Request $request, ?Organisation $organisation = null): JsonResponse|RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
            'remember' => ['nullable', 'boolean'],
        ]);

        $remember = (bool) ($credentials['remember'] ?? false);
        $loginField = filter_var($credentials['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $loginValue = $loginField === 'email'
            ? Str::lower(trim($credentials['email']))
            : trim($credentials['email']);

        if ($organisation) {
            if (Auth::guard('web')->attempt([
                $loginField => $loginValue,
                'password' => $credentials['password'],
                'status' => true,
                'organisation_id' => $organisation->id,
            ], $remember)) {
                $request->session()->regenerate();
                $user = Auth::guard('web')->user();

                if (! $user->hasAnyRole(['organisation_admin', 'organisation_staff'])) {
                    Auth::guard('web')->logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    throw ValidationException::withMessages([
                        'email' => 'Invalid credentials or inactive staff account.',
                    ]);
                }

                return $this->loginResponse($request, $this->redirectUrlFor($user, 'web'));
            }

            throw ValidationException::withMessages([
                'email' => 'Invalid credentials or inactive account.',
            ]);
        }

        if (Auth::guard('admin')->attempt([
            $loginField => $loginValue,
            'password' => $credentials['password'],
            'status' => true,
        ], $remember)) {
            $request->session()->regenerate();
            $user = Auth::guard('admin')->user();

            if ($user->hasRole('Super Admin')) {
                return $this->loginResponse($request, $this->redirectUrlFor($user, 'admin'));
            }

            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        if (Auth::guard('web')->attempt([
            $loginField => $loginValue,
            'password' => $credentials['password'],
            'status' => true,
        ], $remember)) {
            $request->session()->regenerate();
            $user = Auth::guard('web')->user();

            if (! $user->hasAnyRole(['internal_staff', 'organisation_admin', 'organisation_staff'])) {
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                throw ValidationException::withMessages([
                    'email' => 'Invalid credentials or inactive account.',
                ]);
            }

            return $this->loginResponse($request, $this->redirectUrlFor($user, 'web'));
        }

        throw ValidationException::withMessages([
            'email' => 'Invalid credentials or inactive account.',
        ]);
    }

    public function logout(Request $request): JsonResponse|RedirectResponse
    {
        Auth::guard('admin')->logout();
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Logout successful.',
                'redirect' => route('login'),
            ]);
        }

        return redirect()->route('login');
    }

    protected function loginResponse(Request $request, string $redirectUrl): JsonResponse|RedirectResponse
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Login successful.',
                'redirect' => $redirectUrl,
            ]);
        }

        return redirect()->intended($redirectUrl);
    }

    protected function redirectUrlFor($user, string $guard): string
    {
        if ($guard === 'web') {
            if ($user->hasRole('internal_staff')) {
                return route('staff.dashboard');
            }

            if ($user->hasRole('organisation_admin')) {
                return route('organisation.dashboard');
            }

            return route('organisation-staff.dashboard');
        }

        if ($user->hasRole('Super Admin')) {
            return route('admin.dashboard');
        }

        return route('admin.dashboard');
    }

}
