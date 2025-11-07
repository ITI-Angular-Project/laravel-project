<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->redirectAfterVerification($request);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return $this->redirectAfterVerification($request);
    }

    /**
     * Redirect user based on their role after verification.
     */
    protected function redirectAfterVerification($request): RedirectResponse
    {
        // ✅ التوجيه حسب نوع المستخدم
        if ($request->user()->role === 'employer') {
            return redirect()->intended(route('dashboard.home') . '?verified=1');
        }

        // candidate أو أي دور آخر
        return redirect()->intended(route('home') . '?verified=1');
    }
}
