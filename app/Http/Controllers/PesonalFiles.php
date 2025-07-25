<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Nette\Schema\Expect;

class PesonalFiles extends Controller
{
    public function index(){
  // في الكونترولر
$personalFiles = User::where('type', 'expert')->with('expert.projects')->get();


  return view('profile.PersonalFiles',['PersonalFiles'=>$personalFiles ]);
    }


public function show(string $id)
{
     $user = User::with('expert.experiences')->findOrFail($id);

    return view('profile.partials.profilex', compact('user'));

}

}
