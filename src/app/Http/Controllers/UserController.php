<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class UserController extends Controller
{
    public function __construct(private CreatesNewUsers $creator)
    {
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ],
        [
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'password.required' => 'パスワードを入力してください',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin'));
        }

        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function showRegisterStep1()
    {
        return view('register_step1');
    }

    public function storeStep1(RegisterRequest $request)
    {
        $validated = $request->validated();

        $userCreator = app(CreatesNewUsers::class);

        $user = $userCreator->create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => $validated['password'],
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('register.step2');
    }

    public function showRegisterStep2()
    {
        return view('register_step2');
    }

    public function storeStep2(RegisterRequest $request)
    {
        $validated = $request->validated();

        $authenticatedUser = Auth::user();

        WeightLog::create([
            'user_id'          => $authenticatedUser->id,
            'date'             => now()->toDateString(),
            'weight'           => $validated['weight'],
            'calories'         => 0,
            'exercise_time'    => '00:00:00',
            'exercise_content' => '',
        ]);

        $authenticatedUser->weightTarget()->delete();
        WeightTarget::create([
            'user_id'       => $authenticatedUser->id,
            'target_weight' => $validated['target_weight'],
        ]);

        return redirect(route('admin'));
    }
}
