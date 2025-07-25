<?php

namespace App\Http\Controllers;

use App\Models\Company;
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
    public function index()
    {
        $company=Company::all();

       return view('profile.company',['company'=>$company]);
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
        //
    }

    /**
     * Display the specified resource.
     */
         public function showcompan(string $id)
{
    $user = User::with('compan')->findOrFail($id);

    return view('compan', compact('user'));
}
     public function show(string $id)
{
    $user = User::with('compan')->findOrFail($id);

    return view('profile.partials.company', compact('user'));
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
    ]);

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
