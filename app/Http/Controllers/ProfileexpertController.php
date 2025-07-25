<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProfileexpertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(){
        $PersonalFiles=User::where('type','expert')->with('expert')->get();
       return view('dashboard',['PersonalFiles'=>$PersonalFiles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    $user = User::with('expert.experiences')->findOrFail($id);

    return view('dashboard', compact('user'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
         $PersonalFile = Auth::user();
           return view('editex.ed', compact('PersonalFile'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request)
{
    $user = Auth::user();
    $expert = $user->expert;

    if (!$expert) {
        return redirect()->back()->with('error', 'لم يتم العثور على بيانات الخبير.');
    }

    // تحقق من صحة بيانات المستخدم الأساسية (كما في كودك)
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
],   'email' => [
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

    // تحديث بيانات الخبير (بيانات المفردة)
    $validatedExpertData = $request->validate([
        'job_title_en' => 'sometimes|nullable|string|max:255',
        'years_of_experience' => 'sometimes|nullable|string|in:junior,mid,senior',
        'availability' => 'sometimes|required|in:0,1',
        'bio' => 'sometimes|nullable|string',
    ]);

    if (!empty($validatedExpertData)) {
        if (isset($validatedExpertData['availability'])) {
            $validatedExpertData['availability'] = (bool) $validatedExpertData['availability'];
        }
        $expert->update($validatedExpertData);
    }

    // تحديث أو إنشاء الخبرات العملية المتعددة
    $experiences = $request->input('experiences', []);

    foreach ($experiences as $expData) {
        // تحقق من صحة بيانات كل خبرة قبل التحديث أو الإنشاء (يمكنك إضافة قواعد تحقق هنا)

        if (!empty($expData['id'])) {
            // تعديل خبرة موجودة
            $experience = $expert->experiences()->find($expData['id']);
            if ($experience) {
                $experience->update([
                    'name_compani' => $expData['name_compani'] ?? null,
                    'spec' => $expData['spec'] ?? null,
                    'yers_start' => $expData['yers_start'] ?? null,
                    'yers_end' => $expData['yers_end'] ?? null,
                    'texte' => $expData['texte'] ?? null,
                ]);
            }
        } else {
            // إنشاء خبرة جديدة
            $expert->experiences()->create([
                'name_compani' => $expData['name_compani'] ?? null,
                'spec' => $expData['spec'] ?? null,
                'yers_start' => $expData['yers_start'] ?? null,
                'yers_end' => $expData['yers_end'] ?? null,
                'texte' => $expData['texte'] ?? null,
            ]);
        }
    }




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
        $project = $expert->projects()->find($projData['id']);
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
    $expert->projects()->create([
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
     */
    public function destroy(string $id)
    {
        //
    }
}
