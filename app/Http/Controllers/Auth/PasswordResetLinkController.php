<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\CustomResetPassword;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email'),
            function ($user, $token) {
                $user->notify(new CustomResetPassword($token));
            }
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', 'Chúng tôi đã gửi liên kết đặt lại mật khẩu qua email!')
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => 'Không thể gửi liên kết đặt lại mật khẩu. Vui lòng kiểm tra email của bạn.']);
    }
}