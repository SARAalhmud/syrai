<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\RatedPerson;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class companycontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $query = User::where('type', 'company')->with('compan.projects');

    if ($request->has('Company_Size')) {
        $levels = (array) $request->input('Company_Size');
        $query->whereIn('Company_Size', $levels); // اسم العمود كما هو عندك
    }
     if ($request->has('CompanyServices')) {
        $levels = (array) $request->input('CompanyServices');
        $query->whereIn('CompanyServices', $levels); // اسم العمود كما هو عندك
    }
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

        // هنا السحر: نفلتر الشركات حسب علاقة المستخدم ومحافظته
        $query->whereHas('user', function ($q) use ($governorate) {
            $q->where('Governorate', $governorate);
        });
    }

    $companies = $query->paginate(10);

    return view('profile.company', ['company' => $companies]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
   public function showByCompany($id)
{

    $company = company::with('user')->findOrFail($id);
     $averageRating = 0;
    $ratingsCount = 0;

$projectsCount = 0;
    if ($company) {
        $projectsCount = $company->projects->count(); // projects هنا مجموعة (Collection)
    }
    if ($company->user) {
        $averageRating = RatedPerson::where('rated_type', 'App\Models\Company')
            ->where('rated_id', $company->user->id)
            ->avg('rating_value') ?? 0;

        $ratingsCount = RatedPerson::where('rated_type', 'App\Models\Company')
            ->where('rated_id', $company->user->id)
            ->count();
    }
    return view('compan', compact('company','averageRating', 'ratingsCount','projectsCount'));
}


   public function show(string $id)
{
    $user = User::with('compan')->findOrFail($id);

    $averageRating = 0;
    $ratingsCount = 0;

    if ($user->compan) {
        $averageRating = RatedPerson::where('rated_type', 'App\Models\compan')
            ->where('rated_id', $user->compan->id)
            ->avg('rating_value') ?? 0;

        $ratingsCount = RatedPerson::where('rated_type', 'App\Models\compan')
            ->where('rated_id', $user->compan->id)
            ->count();
    }
$projectsCount = 0;
    if ($user->compan) {
        $projectsCount = $user->compan->projects->count(); // projects هنا مجموعة (Collection)
    }
    return view('profile.partials.company', compact('user', 'averageRating', 'ratingsCount','projectsCount'));
}

    /**
     * Show the form for editing the specified resource.
     */
     public function edit()
    {
       $companys=Auth::user();
       return view ('profile.partials.edCompany',compact('companys'));
    }

    /**
     * Update the specified resource in storage.
     */

public function update(Request $request)
{
    $user = Auth::user();
    $company = $user->compan;

    if (!$company) {
        return redirect()->back()->with('error', 'لم يتم العثور على بيانات الخبير.');
    }

    // التحقق من البيانات
    $validatedUserData = $request->validate([
        'first_name' => 'sometimes|required|string|max:255',
        'last_name' => 'sometimes|required|string|max:255',
        'Governorate' => [
            'required',
            Rule::in([
                'damascus', 'aleppo', 'deir-ez-zor', 'homs', 'lattakia', 'tartous',
                'deraa', 'sweida', 'quneitra', 'idleb', 'hama', 'raqqa', 'hasakah', 'damascus-countryside'
            ]),
        ],
        'email' => [
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
          'image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png|max:2048',
           'cv' => 'sometimes|nullable|file|mimes:pdf,doc,docx|max:5120', // 5 ميجابايت مثلا
    ]);
if ($request->hasFile('image')) {
    $path = $request->file('image')->store('image', 'public');
    $validatedUserData['image'] = $path;
}
 if ($request->hasFile('cv')) {
        $cvPath = $request->file('cv')->store('cvs', 'public');
        $validatedUserData['cv_path'] = $cvPath;
    }

    $validatedCompanyData = $request->validate([
        'Company_Name' => 'sometimes|nullable|string|max:255',
        'Business_sector' => [
            'required',
            Rule::in([
                'software-developmen', 'web-design', 'mobile-apps', 'digital-marketing',
                'it-consulting', 'cloud-computing', 'cybersecurity',
            ]),
        ],
        'Company_Size' => [
            'required',
            Rule::in(['startup', 'small', 'medium', 'large']),
        ],
        'bio' => 'sometimes|nullable|string',
        'CompanyServices' => 'nullable',
    ]);

    try {
        DB::beginTransaction();

        // تحديث المستخدم
        $userUpdate = $user->update($validatedUserData);
        if (!$userUpdate) throw new \Exception('فشل في تحديث المستخدم.');
$companyServicesInput = $request->input('CompanyServices');

$companyServices = [];

if (!empty($companyServicesInput)) {
    if (is_string($companyServicesInput)) {
        $companyServices = preg_split('/[\s,،]+/', $companyServicesInput, -1, PREG_SPLIT_NO_EMPTY);
    } elseif (is_array($companyServicesInput)) {
        $companyServices = $companyServicesInput;
    }
}

$validatedCompanyData['CompanyServices'] = $companyServices;
// تحديث الشركة
        $companyUpdate = $company->update($validatedCompanyData);
        if (!$companyUpdate) throw new \Exception('فشل في تحديث بيانات الشركة.');

        // معالجة المشاريع
        $projects = $request->input('projict', []);
        foreach ($projects as $index => $projData) {
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

            $skills = [];
            if (!empty($projData['projectskills'])) {
                $skills = is_string($projData['projectskills'])
                    ? preg_split('/[\s,]+/', $projData['projectskills'], -1, PREG_SPLIT_NO_EMPTY)
                    : $projData['projectskills'];
            }

            $isNotEmpty = !empty($projData['projectname']) || !empty($projData['projectdescription']) || !empty($projData['projectlink']) || !empty($skills) || !empty($imagePaths);

            if (!empty($projData['id'])) {
                if ($isNotEmpty) {
                    $project = $company->projects()->find($projData['id']);
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
                $company->projects()->create([
                    'projectname' => $projData['projectname'] ?? null,
                    'projectdescription' => $projData['projectdescription'] ?? null,
                    'projectlink' => $projData['projectlink'] ?? null,
                    'projectskills' => $skills,
                    'projectimages' => $imagePaths,
                ]);
            }
        }

        DB::commit();
        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'فشل التعديل: ' . $e->getMessage());
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
