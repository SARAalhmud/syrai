<?php

namespace App\Http\Controllers;

use App\Models\beginner;
use App\Models\company;
use App\Models\Expert;
use App\Models\jop;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
 public function dashboard()
{
    // الإحصائيات
    $expertsCount = User::where('type', 'expert')->count();
    $beginnersCount = User::where('type', 'beginner')->count();
    $studentsCount = User::where('type', 'student')->count();
    $companiesCount = User::where('type', 'company')->count();
    $jobsCount = jop::count();

    // جلب الشركات من موديل company مع paginate
    $companies = company::paginate(10);
  $expert = Expert::paginate(10);

    return view('welcome', compact(
        'expertsCount',
        'beginnersCount',
        'studentsCount',
        'companiesCount',
        'jobsCount',
        'companies','expert'
    ));
}

  public function showByCompany($id)
{
    $company = company::with('user')->findOrFail($id);
    return view('compan', compact('company'));
}
  public function showByexpert($id)
{
   $user = User::with('expert.experiences')->findOrFail($id);
       return view('profile.partials.profilex', compact('user'));
}
}
