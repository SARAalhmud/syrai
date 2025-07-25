<?php

namespace App\Http\Controllers;

use App\Models\forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class forumController extends Controller
{
    public function index(Request $request)
    {
 $topics=forum::query();

 if ($request->filled('section')) {
        $topics->where('section', $request->section);
    }

 $posts = $topics->paginate(10);

         return view('profile.forum',["posts"=>$posts]);
    }

public function store(Request $request){
      $user = Auth::user();
if (!$user->expert && !$user->compan &&  !$user->beginner && !$user->student) {
        return response()->json([
            'message' => 'غير مصرح لك بإضافة.'
        ], 403);
    }



 $validatedJob = $request->validate([
        'section' => 'sometimes|required|string|max:255',
        'title' => 'sometimes|required|string|max:255',
        'content' => 'sometimes|required|string|max:255',
        'keywords' => 'sometimes|required|string|max:255',
        'views' => 'sometimes|required|string',
        'replies_count' => 'sometimes|required|string',

    ]);

    $topics = new forum($validatedJob);

    // ربط الوظيفة بالخبير أو الشركة
    if ($user->expert) {
        $topics->experts_id = $user->expert->id;
    } elseif ($user->student) {
        $topics->students_id = $user->student->id;
    }
     elseif ($user->compan) {
        $topics->companies_id = $user->compan->id;
    }
     elseif ($user->beginner) {
        $topics->beginners_id = $user->beginner->id;
    }

    $topics->save();

 return redirect()->back()->with([
        'message' => 'تم إنشاء  بنجاح',
        'topics' => $topics
    ], 201);
}
public function show($id)
{
    $topic = Forum::findOrFail($id);

    // زيادة عدد المشاهدات
    $topic->increment('views');

    return view('profile.forum', compact('topic'));
}

}
