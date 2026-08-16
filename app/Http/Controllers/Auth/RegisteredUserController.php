<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_type' => ['required', 'string', 'in:perorangan,lembaga,organisasi'],
            'identification_number' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'job_title' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string'],
            'identity_file' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'], // limit 2MB
        ];

        if ($request->user_type === 'organisasi') {
            $rules['identity_file_2'] = ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'];
            $rules['identity_file_3'] = ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'];
            $rules['identity_file_4'] = ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'];
            $rules['identity_file_5'] = ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'];
        }

        $request->validate($rules);

        $identityPath = null;
        if ($request->hasFile('identity_file')) {
            $identityPath = $request->file('identity_file')->store('identities', 'public');
        }

        $identityPath2 = $request->hasFile('identity_file_2') ? $request->file('identity_file_2')->store('identities', 'public') : null;
        $identityPath3 = $request->hasFile('identity_file_3') ? $request->file('identity_file_3')->store('identities', 'public') : null;
        $identityPath4 = $request->hasFile('identity_file_4') ? $request->file('identity_file_4')->store('identities', 'public') : null;
        $identityPath5 = $request->hasFile('identity_file_5') ? $request->file('identity_file_5')->store('identities', 'public') : null;

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
            'identification_number' => $request->identification_number,
            'phone' => $request->phone,
            'job_title' => $request->job_title,
            'address' => $request->address,
            'identity_file_path' => $identityPath,
        ];

        if ($request->user_type === 'organisasi') {
            $userData['identity_file_path_2'] = $identityPath2;
            $userData['identity_file_path_3'] = $identityPath3;
            $userData['identity_file_path_4'] = $identityPath4;
            $userData['identity_file_path_5'] = $identityPath5;
        }

        $user = User::create($userData);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('requests.create');
    }
}
