<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\beginner;
use App\Models\company;
use App\Models\expert;
use App\Models\student;
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
        $request->validate([
           'first_name' => ['required_unless:type,company', 'string', 'max:255'],

            'last_name' => ['required_unless:type,company', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'Governorate' => ['required', 'string', 'max:255'],
'Phone_Number' => ['required', 'string', 'max:255'],
  'type' => ['required','in:expert,beginner,student,company'],
            'job_title_en'=>  ['string','max:255'],
             'specialization'=>['string','max:255'],
             'years_of_experience'=>['string'],
                'field_of_interest'=>['string'],
                 'Current_level'=>['string'],
                  'learning_goals'=>['string'],
                   'University'=>['string'],
                    'University_Major'=>['string'],
 'Acabemic_Year'=>['string'],
  'technica_interests'=>['string'],
    'Company_Name' => [ 'string', 'max:255'],
   'Company_Size'=>['string'],
 'Business_sector'=>['string'],

        ]);

        $user = User::create([
             'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
           'Phone_Number'=>$request->Phone_Number,
         'Governorate'=>$request->Governorate,   ]);

if ($user->type === 'expert') {
    expert::create([
        'user_id' => $user->id,
        'job_title_en' => $request->job_title_en,
        'specialization' => $request->specialization,
        'years_of_experience' => $request->years_of_experience,
    ]);}
    if ($user->type === 'beginner') {
    beginner::create([
        'user_id' => $user->id,
        'field_of_interest' => $request->field_of_interest,
        'Current_level' => $request->Current_level,
        'learning_goals' => $request->learning_goals,
    ]);}
    if ($user->type === 'student') {
    student::create([
        'user_id' => $user->id,
        'University' => $request->University,
        'University_Major' => $request->University_Major,
        'Acabemic_Year' => $request->Acabemic_Year,
              'technica_interests' => $request->technica_interests,
    ]);}
    if ($user->type === 'company') {
    company::create([
        'user_id' => $user->id,
 'Business_sector' => $request->Business_sector,
        'Company_Name' => $request->Company_Name,
        'Company_Size' => $request->Company_Size,
    ]);}

        event(new Registered($user));

        Auth::login($user);

      return redirect()->route('profile', ['id' => auth()->id()]);
  }
}
