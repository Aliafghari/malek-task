<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class resetPasswordController extends Controller
{
    //use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Show the password reset form with the verification code.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showResetForm(): View
    {
        return view('auth.reset-password');
    }

    /**
     * Verify the entered code with the code in the session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyCode(Request $request)
    {
        $request->validate([
            'random_num' => 'required|numeric',
        ]);

        // Read the random_num from the session
        $resetPasswordRandomNum = $request->session()->get('reset_password_random_num');

        // Compare the random_num with the input from the user
        if ($request->input('random_num') == $resetPasswordRandomNum) {
            // If the code is valid, set the displayForm flag to true
            // so that the email and password fields will be shown in the view
            session(['reset_password_display_form' => true]);
        } else {
            // If the code is invalid, display an error message
            return redirect()->back()->withErrors(['random_num' => 'The code you entered is invalid. Please try again.']);
        }

        return redirect()->route('password.reset', [
            'reset_num' => $resetPasswordRandomNum,
            'token' => $request->token,
        ]);
    }

    // The rest of your code remains unchanged
    // ...
}

