<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeginnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::where('type','beginner')->with('beginner')->get();

       return view('profile.beginner',['user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show(string $id)
{
    $user = User::with('beginner')->findOrFail($id);

    return view('profile.beginner', compact('user'));
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
       $beginners=Auth::user();
       return view ('profile.edbeginners',compact('beginners'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         $user = Auth::user();
    $beginner = $user->beginner;

    if (!$beginner) {
        return redirect()->back()->with('error', 'لم يتم العثور على بيانات الخبير.');
    }
     $validatedUserData = $request->validate([
        'first_name' => 'sometimes|required|string|max:255',
        'last_name' => 'sometimes|required|string|max:255',
         'Governorate' => [
    'required',
    Rule::in([
        'damascus',
       'aleppo',
       'deir-ez-zor',
        'homs',
        'lattakia',
        'tartous',
        'deraa',
        'sweida',
        'quneitra',
        'idleb',
        'hama',
        'raqqa' ,
        'hasakah',
        'damascus-countryside'
    ])
],      'email' => [
            'sometimes',
            'required',
            'email',
            Rule::unique('users')->ignore(auth()->id()),
        ],
        'Phone_Number' => 'sometimes|nullable|string|max:20',

        'social_links.linkedin' => 'sometimes|nullable|url',
        'social_links.portfolio' => 'sometimes|nullable|url',

        'skills' => 'nullable|array',
        'skills.*.name' => 'required|string|max:255',
        'skills.*.level' => 'required|integer|min:0|max:100',
        'skills.*.category' => 'nullable|string|max:255',
    ]);

    // تحديث بيانات المستخدم
    $user->update($validatedUserData);


$projict = $request->input('projict', []);



    // معالجة projectskills لتكون array لو جت كنص

foreach ($projict as $index => $projData) {
    $imagePaths = [];

    $uploadedImages = $request->file("projict.$index.projectimages");

    if ($uploadedImages && is_array($uploadedImages)) {
        foreach ($uploadedImages as $imageFile) {
            if ($imageFile->isValid()) {
                $path = $imageFile->store('projectimages', 'public');
                $imagePaths[] = $path;
            }
        }
    }

    // معالجة skills
    $skills = [];
    if (!empty($projData['projectskills'])) {
        if (is_string($projData['projectskills'])) {
            $skills = preg_split('/[\s,]+/', $projData['projectskills'], -1, PREG_SPLIT_NO_EMPTY);
        } elseif (is_array($projData['projectskills'])) {
            $skills = $projData['projectskills'];
        }
    }

    // حفظ أو تحديث المشروع
   $isNotEmpty = !empty($projData['projectname']) || !empty($projData['projectdescription']) || !empty($projData['projectlink']) || !empty($skills) || !empty($imagePaths);

if (!empty($projData['id'])) {
    // تحديث مشروع موجود فقط إذا تم إدخال بيانات جديدة
    if ($isNotEmpty) {
        $project = $beginner->projects()->find($projData['id']);
        if ($project) {
            $project->update([
                'projectname' => $projData['projectname'] ?? null,
                'projectdescription' => $projData['projectdescription'] ?? null,
                'projectlink' => $projData['projectlink'] ?? null,
                'projectskills' => $skills,
                'projectimages' => $imagePaths,
            ]);
        }
    }
} elseif ($isNotEmpty) {
    // فقط إذا تم إدخال بيانات، قم بإنشاء مشروع
    $beginner->projects()->create([
        'projectname' => $projData['projectname'] ?? null,
        'projectdescription' => $projData['projectdescription'] ?? null,
        'projectlink' => $projData['projectlink'] ?? null,
        'projectskills' => $skills,
        'projectimages' => $imagePaths,
    ]);
}

}


return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح!');

}




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
