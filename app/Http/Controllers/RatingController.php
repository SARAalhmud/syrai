<?php

namespace App\Http\Controllers;

use App\Models\RatedPerson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{







public function show($id)
{
    $user = User::findOrFail($id);

    // جلب الـ Expert المرتبط بالمستخدم
    $expert = $user->expert;

    if (!$expert) {
        abort(404, 'لا يوجد ملف خبير مرتبط بهذا المستخدم.');
    }

    // استخدام expert_id بدلًا من user_id
    $ratings = RatedPerson::where('rated_id', $expert->id)
        ->where('rated_type', 'App\Models\Expert')
        ->get();

    $ratingsCount = $ratings->count();
    $averageRating = $ratingsCount > 0 ? $ratings->avg('rating_value') : 0;

    return view('profile.partials.profilex', compact('user', 'averageRating', 'ratingsCount', 'ratings'));
}




}
