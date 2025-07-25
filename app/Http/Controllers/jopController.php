<?php

namespace App\Http\Controllers;
use App\Models\company;
use App\Models\Expert;
use App\Models\jop;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class jopController extends Controller
{
public function index(Request $request)
{
    $jop = Jop::query();

    if ($request->has('experienceLevel')) {
        $levels = (array) $request->experienceLevel;
        // dd($levels); // لفحص القيم
        $jop->whereIn('experienceLevel', $levels);
    }

     if ($request->has('jobLocation')) {
        $jobLocation = (array) $request->jobLocation;
        // dd($levels); // لفحص القيم
        $jop->whereIn('jobLocation', $jobLocation);
    }
     if ($request->has('jobType')) {
        $jobType = (array) $request->jobType;
        // dd($levels); // لفحص القيم
        $jop->whereIn('jobType', $jobType);
    }
     if ($request->has('jobCategory')) {
        $jobCategory = (array) $request->jobCategory;
        // dd($levels); // لفحص القيم
        $jop->whereIn('jobCategory', $jobCategory);
    }
    if ($request->filled('salaryRange')) {
    switch ($request->salaryRange) {
        case 'under-500':
            $jop->where('salaryRange', '<', 500);
            break;
        case '500-1000':
            $jop->whereBetween('salaryRange', [500, 1000]);
            break;
        case '1000-2000':
            $jop->whereBetween('salaryRange', [1000, 2000]);
            break;
        case '2000-3000':
            $jop->whereBetween('salaryRange', [2000, 3000]);
            break;
        case 'over-3000':
            $jop->where('salaryRange', '>', 3000);
            break;
    }
}

    $jopse = $jop->paginate(10);

    return view('jop', ["jopse" => $jopse]);
}


public function store(Request $request)
{
    $user = Auth::user();

    // تحقق أن المستخدم خبير أو شركة
    if (!$user->expert && !$user->compan) {
        return response()->json([
            'message' => 'غير مصرح لك بإضافة وظيفة.'
        ], 403);
    }

    $validatedJob = $request->validate([
        'jobTitle' => 'sometimes|required|string|max:255',
        'companyName' => 'sometimes|required|string|max:255',
        'salaryRange' => 'sometimes|required|string|max:255',
        'jobCategory' => 'sometimes|required|string|max:255',
        'jobDescription' => 'sometimes|required|string',
        'jobRequirements' => 'sometimes|required|string',
        'jobType' => [
            'required',
            Rule::in(['full-time', 'part-time', 'freelance', 'remote', 'internship'])
        ],
        'jobLocation' => 'sometimes|required|string|max:255',
        'experienceLevel' => [
            'required',
            Rule::in(['entry', 'mid', 'senior'])
        ],
        'contactEmail' => [
            'sometimes',
            'required',
            'email',
        ],
    ]);

    $job = new jop($validatedJob);

    // ربط الوظيفة بالخبير أو الشركة
    if ($user->expert) {
        $job->experts_id = $user->expert->id;
    } elseif ($user->compan) {
        $job->companies_id = $user->compan->id;
    }

    $job->save();

 return redirect()->back()->with([
        'message' => 'تم إنشاء الوظيفة بنجاح',
        'job' => $job
    ], 201);
}

// في Controller

public function showExpertJobs($experts_id)
{
    $expert = Expert::with('jops')->findOrFail($experts_id);

    $jobs = $expert->jops ?? collect();
    return view('profile.jopexpert', [
        'expert' => $expert,
        'jobs' => $jobs
    ]);
}
public function toggleStatus($experts_id)
{
    $job = jop::findOrFail($experts_id);
    $job->is_closed = !$job->is_closed;
    $job->save();

    return back()->with('status', 'تم تحديث حالة التقديم');
}
public function showcompanies($companies_id)
{
    $Compaany = company::with('jops')->findOrFail($companies_id);

    $jobs = $Compaany->jops ?? collect();
    return view('profile.jocompan', [
        'Compaany' => $Compaany,
        'jobs' => $jobs
    ]);
}
public function toggleCompaany($companies_id)
{
    $job = jop::findOrFail($companies_id);
    $job->is_closed = !$job->is_closed;
    $job->save();

    return back()->with('status', 'تم تحديث حالة التقديم');
}

}
