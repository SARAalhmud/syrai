<?php

namespace App\Http\Controllers;

use App\Models\jop;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
   public function dashboardStats()
{
    $expertsCount = User::where('type', 'expert')->count();
    $beginnersCount = User::where('type', 'beginner')->count();
    $studentsCount = User::where('type', 'student')->count();
    $companiesCount = User::where('type', 'company')->count();
    $jobsCount = jop::count();
    return view('welcome', compact(
        'expertsCount',
        'beginnersCount',
        'studentsCount',
        'companiesCount',
                'jobsCount'
    ));
}}
