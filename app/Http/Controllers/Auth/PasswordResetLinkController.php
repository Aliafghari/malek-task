<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

// class PasswordResetLinkController extends Controller
// {
//     /**
//      * Display the password reset link request view.
//      */
//     public function create(): View
//     {
//         return view('auth.forgot-password');
//     }

//     /**
//      * Handle an incoming password reset link request.
//      *
//      * @throws \Illuminate\Validation\ValidationException
//      */
// public function store(Request $request): RedirectResponse
// {
//     $request->validate([
//         'email' => ['required', 'email'],
//     ]);

//     // We will send the password reset link to this user. Once we have attempted
//     // to send the link, we will examine the response then see the message we
//     // need to show to the user. Finally, we'll send out a proper response.
//     $status = Password::sendResetLink(
//         $request->only('email')
//     );

//     return $status == Password::RESET_LINK_SENT
//                 ? back()->with('status', __($status))
//                 : back()->withInput($request->only('email'))
//                         ->withErrors(['email' => __($status)]);
// }




//     // public function store(Request $request)
//     // {
//     //     $randomNum = rand(100000, 999999);
    
//     //     Password::sendResetLink($request->only('email'), function ($user, $token) use ($randomNum) {
//     //         $user->random_num = $randomNum;
//     //         $user->save();
//     //     });
    
//     //     return view('auth.reset-password-email', [
//     //         'email' => $request->email,
//     //         'randomNumber' => $randomNum
//     //     ]);
//     // }
// }
class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'We could not find a user with that email address.'
            ]);
        }

        $token = app('auth.password.broker')->createToken($user);

        $user->notify(new ResetPasswordNotification($token));

        return back()->with('status', 'We have emailed your password reset link!');
    }
}