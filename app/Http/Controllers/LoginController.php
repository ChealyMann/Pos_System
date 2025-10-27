<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;
    use Symfony\Component\HttpFoundation\RedirectResponse;

    class LoginController extends Controller
    {
        public function login(Request $request): RedirectResponse
        {
            $request->validate([
                'user_name' => ['required', 'string'],
                'password' => ['required', 'string'],
            ]);

            // Check if username exists
            $user = User::where('user_name', $request->user_name)->where('status','active')->first();
            if (!$user) {
                return back()->withErrors([
                    'user_name' => 'Username not found'
                ])->onlyInput('user_name');
            }

            // Attempt login
            if (!Auth::attempt(['user_name' => $request->user_name, 'password' => $request->password])) {
                return back()->withErrors([
                    'password' => 'Password is incorrect'
                ])->onlyInput('user_name');
            }

            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        public function logout(Request $request)
        {

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login');
        }
    }
