<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:employer,candidate'],
            'phone' => ['required', 'digits:11'],
            'linkedin_url' => ['nullable', 'regex:/^(https?:\/\/)?(www\.)?linkedin\.com\/in\/[A-Za-z0-9_-]+\/?$/'],
            'resume_path' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
        ]);

        $resumePath = null;
        if ($request->hasFile('resume_path')) {
            $resumePath = $request->file('resume_path')->store('resumes', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'linkedin_url' => $request->linkedin_url,
            'resume_path' => $resumePath,
        ]);

        event(new Registered($user));
        Auth::login($user);

        // ✅ Redirect based on user role
        if ($user->role === User::ROLE_CANDIDATE) {
            return redirect()->route('home');
        } elseif (in_array($user->role, [User::ROLE_EMPLOYER, User::ROLE_ADMIN])) {
            return redirect()->route('dashboard.home');
        }

        return redirect()->route('home');
    }
}
