<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function edit(Request $request): View
    {
        $user = $request->user();
        abort_unless($user && $user->hasRole(User::ROLE_EMPLOYER), 403);

        return view('pages.dashboard.company.edit', [
            'company' => $user->company,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();
        abort_unless($user && $user->hasRole(User::ROLE_EMPLOYER), 403);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'website' => ['nullable', 'url', 'max:255'],
            'location' => ['required', 'string', 'max:150'],
            'about' => ['nullable', 'string'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'remove_logo' => ['nullable', 'boolean'],
        ]);

        $company = $user->company;

        $removeLogo = $request->boolean('remove_logo');

        if ($removeLogo && $company && $company->logo_path) {
            Storage::disk('public')->delete($company->logo_path);
            $data['logo_path'] = null;
        }

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('company-logos', 'public');
            if ($company && $company->logo_path && $company->logo_path !== $logoPath) {
                Storage::disk('public')->delete($company->logo_path);
            }
            $data['logo_path'] = $logoPath;
        }

        unset($data['logo']);
        unset($data['remove_logo']);

        if (! array_key_exists('logo_path', $data) && $company) {
            // keep existing logo path
        }

        if ($company) {
            $company->update($data);
        } else {
            $data['employer_id'] = $user->id;
            $company = Company::create($data);
        }

        return redirect()
            ->route('dashboard.company.edit')
            ->with('success', 'Company information saved successfully.');
    }
}
