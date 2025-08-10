<?php

namespace App\Http\Controllers;
use App\Models\RatedPerson;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Nette\Schema\Expect;

class PesonalFiles extends Controller
{
 public function index(Request $request)
{
    $query = User::where('type', 'expert')->with('expert.projects');

    // فلترة حسب سنوات الخبرة
    if ($request->filled('years_of_experience')) {
        $level = $request->input('years_of_experience');
        $query->whereHas('expert', function ($q) use ($level) {
            $q->where('years_of_experience', $level);
        });
    }

    // فلترة حسب المحافظة
    if ($request->filled('Governorate')) {
        $validated = $request->validate([
            'Governorate' => [
                'required',
                Rule::in([
                    'damascus', 'aleppo', 'deir-ez-zor', 'homs', 'lattakia', 'tartous',
                    'deraa', 'sweida', 'quneitra', 'idleb', 'hama', 'raqqa', 'hasakah', 'damascus-countryside'
                ]),
            ]
        ]);

        $governorate = $request->input('Governorate');
        $query->where('Governorate', $governorate);
    }

    // أولاً نجيب كل الأشخاص حسب الشروط السابقة
    $personalFiles = $query->get();

    // فلترة المهارة التقنية في PHP بعد الجلب من القاعدة
    if ($request->filled('skill')) {
        $skill = strtolower($request->input('skill')); // مقارنة غير حساسة لحالة الأحرف

        $personalFiles = $personalFiles->filter(function ($user) use ($skill) {
            if (!is_array($user->skills)) return false;

            foreach ($user->skills as $skillEntry) {
                if (
                    isset($skillEntry['name'], $skillEntry['level']) &&
                    strtolower($skillEntry['name']) === $skill &&
                    intval($skillEntry['level']) > 0
                ) {
                    return true;
                }
            }
            return false;
        });
    }


     $personalFiles->each(function ($user) {
        if ($user->expert) {
            $ratingsQuery = RatedPerson::where('rated_type', 'App\Models\Expert')
                ->where('rated_id', $user->expert->id);

            $user->averageRating = $ratingsQuery->avg('rating_value') ?? 0;
            $user->ratingsCount = $ratingsQuery->count();
        } else {
            $user->averageRating = 0;
            $user->ratingsCount = 0;
        }
    });
    return view('profile.PersonalFiles', ['PersonalFiles' => $personalFiles]);
}



 public function store(Request $request)
    {
        $request->validate([
            'rated_id' => 'required|integer',
            'rated_type' => 'required|in:App\Models\Expert,App\Models\Company',
            'rating_value' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        // منع التكرار
        $exists = RatedPerson::where([
            'rater_id' => Auth::id(),
            'rated_id' => $request->rated_id,
            'rated_type' => $request->rated_type,
        ])->exists();

        if ($exists) {
            return back()->with('error', 'لقد قمت بتقييم هذا الشخص من قبل.');
        }

        RatedPerson::create([
            'rater_id' => Auth::id(),
            'rated_id' => $request->rated_id,
            'rated_type' => $request->rated_type,
            'rating_value' => $request->rating_value,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'تم إرسال التقييم بنجاح.');
    }

public function show(string $id)
{
    $user = User::with('expert.experiences')->findOrFail($id);

    // التأكد أن المستخدم عنده خبير مرتبط
    $averageRating = 0;
    $ratingsCount = 0;

    if ($user->expert) {
        $averageRating = RatedPerson::where('rated_type', 'App\Models\Expert')
            ->where('rated_id', $user->expert->id)
            ->avg('rating_value') ?? 0;

        $ratingsCount = RatedPerson::where('rated_type', 'App\Models\Expert')
            ->where('rated_id', $user->expert->id)
            ->count();
    }
$projectsCount = 0;
    if ($user->expert) {
        $projectsCount = $user->expert->projects->count(); // projects هنا مجموعة (Collection)
    }
    return view('profile.partials.profilex', compact('user', 'averageRating', 'ratingsCount','projectsCount'));
}


}
