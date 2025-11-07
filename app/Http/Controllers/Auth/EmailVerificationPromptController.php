<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user()->hasVerifiedEmail()
                    ? $this->redirectAfterVerification($request)
                    : view('auth.verify-email');
    }

    protected function redirectAfterVerification(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->role === User::ROLE_EMPLOYER) {
            return redirect()->route('dashboard.home');
        }

        return redirect()->route('home');
    }
}
