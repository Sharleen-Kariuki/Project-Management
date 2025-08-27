<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        $companies = Company::select('id', 'name')->get(); // Fetch companies

        // $teams = Team::where('company_id', Auth::user()->company_id)->get();
        // dd($teams);

        return Inertia::render('Auth/Register', [
            'companies' => $companies,
            // 'teams' => $teams,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        // dd($request->all());
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|string|in:project_manager,member',
            // 'company_name' => 'required_if:role,project_manager|string|max:255|unique:companies,name',
            // // 'company_id' => 'required|exists:companies,id',
            // 'company_id' => 'nullable|required_if:role,member|exists:companies,id',
            'team_id' => 'required_if:role,member|exists:teams,id', // Validate team_id
        ]);


        if ($request->role === 'project_manager') {
            // Create a new company
            $company = Company::create([
                'name' => $request->company_name,
            ]);

            // Associate the Project Manager with the newly created company
            $companyId = $company->id;
        } else {
            // Use the selected company for the member
            $companyId = $request->company_id;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'company_id' => $companyId,
            'team_id' => $request->team_id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
