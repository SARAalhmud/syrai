@extends('layouts.navigation')
@section('nav')


 <!-- Profile Header -->
  <!-- Profile Header -->

 <section class="profile-content py-5">
    @if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif
 <section class="profile-content py-5">
    @if(session('error'))
    <div class="alert alert-success mt-3">
        {{ session('error') }}
    </div>
@endif
<a href="{{ route('company', ['id' => auth()->user()->id]) }}">
    <button class="btn btn-success btn-sm w-100">العودة للصفحة الشخصية</button>
</a>

  <form action="{{ route('compan.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
    <div class="content-card mb-3 w-50 mx-auto">


    <!-- معلومات التواصل -->
    <div class="content-card mb-3">

        <div class="profile-info">
            <div class="row align-items-center gx-2">
                <div class="col-md-3 text-center">
                    <div class="profile-avatar-large" id="profileAvatar" style="font-size: 1.2rem; height: 80px; width: 80px; line-height: 80px;">
                        أم
                    </div>
                </div>

                <div class="col-md-9">
                    <label for="Company_Name" class="form-label small mb-1">الاسم الأول</label>
                    <input type="text" name="Company_Name" id="Company_Name"
                           class="form-control form-control-sm mb-2"
                           value="{{ old('Company_Name', auth()->user()->compan->Company_Name) }}">
                </div>





                   <div class="col-md-9">
                    <label for="location" class="form-label small mb-1">قطاع العمل</label>
                    <select class="form-select form-select-sm mb-2" id="location" name="Business_sector" required>
                        @php
                            $selectedBusiness_sector = old('Business_sector', auth()->user()->compan->Business_sector);
                        @endphp
                        <option value="software-developmen" {{ $selectedBusiness_sector == 'software-developmen' ? 'selected' : '' }}>         تطوير البرمجيات</option>
                        <option value="web-design" {{ $selectedBusiness_sector == 'web-design' ? 'selected' : '' }}> تصميم المواقع</option>
                        <option value="mobile-apps" {{ $selectedBusiness_sector ==  'mobile-apps' ? 'selected' : '' }}>   تطبيقات الجوال</option>
  <option value="digital-marketing" {{ $selectedBusiness_sector ==   'digital-marketing' ? 'selected' : '' }}>  التسويق الرقمي</option>
                        <option value="it-consulting" {{ $selectedBusiness_sector == 'it-consulting' ? 'selected' : '' }}> استشارات تقنية</option>
                            <option value="cybersecurity" {{ $selectedBusiness_sector ==   'cybersecurity' ? 'selected' : '' }}> الأمن السيبراني</option>
                                                 </select>
                </div>
                  <div class="col-md-9">
                    <label for="location" class="form-label small mb-1">حجم الشركة</label>
                    <select class="form-select form-select-sm mb-2" id="location" name="Company_Size" required>
                        @php
                            $selectedCompany_Size = old('Company_Size', auth()->user()->compan->Company_Size);
                        @endphp
                        <option value="startup" {{  $selectedCompany_Size == 'startup' ? 'selected' : '' }}>         ناشئة</option>
                        <option value="small" {{  $selectedCompany_Size == 'small' ? 'selected' : '' }}> صغيرة</option>
                        <option value="medium" {{  $selectedCompany_Size == 'medium' ? 'selected' : '' }}> متوسطة</option>
                         <option value="large" {{  $selectedCompany_Size == 'large' ? 'selected' : '' }}>كبيرة</option>

                        </select>
                </div>
                <div class="col-md-9">
                    <label for="location" class="form-label small mb-1">المحافظة</label>
                    <select class="form-select form-select-sm mb-2" id="location" name="Governorate" required>
                        @php
                            $selectedGovernorate = old('Governorate', auth()->user()->Governorate);
                        @endphp
                        <option value="damascus" {{ $selectedGovernorate == 'damascus' ? 'selected' : '' }}>دمشق</option>
                        <option value="aleppo" {{ $selectedGovernorate == 'aleppo' ? 'selected' : '' }}>حلب</option>
                        <option value="homs" {{ $selectedGovernorate == 'homs' ? 'selected' : '' }}>حمص</option>
                        <option value="lattakia" {{ $selectedGovernorate == 'lattakia' ? 'selected' : '' }}>اللاذقية</option>
                        <option value="tartous" {{ $selectedGovernorate == 'tartous' ? 'selected' : '' }}>طرطوس</option>
                        <option value="deraa" {{ $selectedGovernorate == 'deraa' ? 'selected' : '' }}>درعا</option>
                        <option value="sweida" {{ $selectedGovernorate == 'sweida' ? 'selected' : '' }}>السويداء</option>
                        <option value="quneitra" {{ $selectedGovernorate == 'quneitra' ? 'selected' : '' }}>القنيطرة</option>
                        <option value="idleb" {{ $selectedGovernorate == 'idleb' ? 'selected' : '' }}>إدلب</option>
                        <option value="hama" {{ $selectedGovernorate == 'hama' ? 'selected' : '' }}>حماة</option>
                        <option value="raqqa" {{ $selectedGovernorate == 'raqqa' ? 'selected' : '' }}>الرقة</option>
                        <option value="deir-ez-zor" {{ $selectedGovernorate == 'deir-ez-zor' ? 'selected' : '' }}>دير الزور</option>
                        <option value="hasakah" {{ $selectedGovernorate == 'hasakah' ? 'selected' : '' }}>الحسكة</option>
                        <option value="damascus-countryside" {{ $selectedGovernorate == 'damascus-countryside' ? 'selected' : '' }}>ريف دمشق</option>
                    </select>
                </div>




                  <div class="content-card mb-4">
          <h4 class="section-title mb-3"><i class="fas fa-user me-2"></i>نبذة عني</h4>
          <textarea name="bio" rows="6" class="form-control">{{ old('bio', auth()->user()->compan?->bio) }}</textarea>
        </div>
              <div class="content-card mb-4">
         <label>خدمات الشركة</label>
<input type="text" name="CompanyServices" class="form-control mb-2"
       value="{{ old('CompanyServices', is_array($companys->compan->CompanyServices ?? null)
           ? implode(', ', $companys->compan->CompanyServices)
           : ($companys->compan->CompanyServices ?? '')) }}">
</div>
    <div class="content-card mb-4">
    <h4 class="section-title mb-3">
        <i class="fas fa-code me-2"></i>
        المشاريع
    </h4>

    @php
        $oldProjects = old('projict');
        $projects = $oldProjects ?? ( $companys->compan ?  $companys->compan->projects : []);
    @endphp

    @if ($projects && count($projects) > 0)
        @foreach ($projects as $index => $project)
            @php
                $isOld = is_array($project); // إذا جاءت من old() تكون مصفوفة
            @endphp
            <div class="project-item border rounded p-3 mb-3">
                <input type="hidden" name="projict[{{ $index }}][id]" value="{{ $isOld ? ($project['id'] ?? '') : $project->id }}">

                <label>اسم المشروع</label>
                <input type="text" name="projict[{{ $index }}][projectname]" class="form-control mb-2"
                       value="{{ $isOld ? ($project['projectname'] ?? '') : $project->projectname }}">

               <label>صور المشروع</label>
<input type="file" name="projict[{{ $index }}][projectimages][]" class="form-control mb-2" multiple>

                <label>لغات مستخدمة ضمن المشروع</label>
                <input type="text" name="projict[{{ $index }}][projectskills]" class="form-control mb-2"
                       value="{{ $isOld ? ($project['projectskills'] ?? '') : (is_array($project->projectskills) ? implode(',', $project->projectskills) : $project->projectskills) }}">

                <label>رابط المشروع</label>
                <input type="text" name="projict[{{ $index }}][projectlink]" class="form-control mb-2"
                       value="{{ $isOld ? ($project['projectlink'] ?? '') : $project->projectlink }}">

                <label>شرح مختصر للمشروع</label>
                <textarea name="projict[{{ $index }}][projectdescription]" class="form-control mb-2">{{ $isOld ? ($project['projectdescription'] ?? '') : $project->projectdescription }}</textarea>
            </div>
        @endforeach
    @else

        <div class="project-item border rounded p-3 mb-3">
            <label>اسم المشروع</label>
            <input type="text" name="projict[0][projectname]" class="form-control mb-2" value="">

            <label>صور المشروع</label>
          <input type="file" name="projict[0][projectimages][]" class="form-control mb-2" multiple>

            <label>لغات مستخدمة ضمن المشروع</label>
            <input type="text" name="projict[0][projectskills]" class="form-control mb-2" value="">

            <label>رابط المشروع</label>
            <input type="text" name="projict[0][projectlink]" class="form-control mb-2" value="">

            <label>شرح مختصر للمشروع</label>
            <textarea name="projict[0][projectdescription]" class="form-control mb-2"></textarea>
        </div>
    @endif

  <button type="button" class="btn btn-success mb-3" id="addProjectBtn">إضافة مشروع جديد</button>
<div id="projectsContainer"></div> <!-- هذا هو الحاوي للمشاريع الجديدة -->
</div>

 </div> </div> </div> </div>
    <div class="col-md-6">
        <div class="content-card mb-4">
          <h4 class="section-title mb-3"><i class="fas fa-cogs me-2"></i>المهارات التقنية</h4>

 <h5 class="card-title small mb-2"><i class="fas fa-address-card me-2"></i>معلومات التواصل</h5>

                <div class="col-md-9">
                    <label for="email" class="form-label small mb-1">البريد الإلكتروني</label>
                    <input type="email" name="email" id="email" class="form-control form-control-sm mb-2" value="{{ old('email', auth()->user()->email) }}">
                </div>

                <div class="col-md-9">
                    <label for="Phone_Number" class="form-label small mb-1">رقم الهاتف</label>
                    <input type="text" name="Phone_Number" id="Phone_Number" class="form-control form-control-sm mb-2" value="{{ old('Phone_Number', auth()->user()->Phone_Number) }}">
                </div>

                <div class="col-md-9">
                    <label for="portfolio" class="form-label small mb-1">رابط الموقع الشخصي</label>
                    <input type="url" name="social_links[portfolio]" id="portfolio" class="form-control form-control-sm mb-2"
                        value="{{ old('social_links.portfolio', auth()->user()->social_links['portfolio'] ?? '') }}">
                </div>

                <div class="col-md-9">
                    <label for="linkedin" class="form-label small mb-1">رابط لينكدإن</label>
                    <input type="url" name="social_links[linkedin]" id="linkedin" class="form-control form-control-sm mb-2"
                        value="{{ old('social_links.linkedin', auth()->user()->social_links['linkedin'] ?? '') }}">
                </div>
            </div>



            <!-- نبذة عني -->


            <button type="submit" class="btn btn-success btn-sm w-100">تحديث جميع البيانات</button>
        </div> </div>  </div>
    </div>

</form></div>
</section>


<script>


document.addEventListener("DOMContentLoaded", function () {
    let projectIndex = {{ isset($projects) ? count($projects) : 1 }}; // يبدأ من آخر مشروع موجود

    document.getElementById("addProjectBtn").addEventListener("click", function () {
        const container = document.getElementById("projectsContainer");

        const projectHTML = `
        <div class="project-item border rounded p-3 mb-3">
            <input type="hidden" name="projict[${projectIndex}][id]" value="">

            <label>اسم المشروع</label>
            <input type="text" name="projict[${projectIndex}][projectname]" class="form-control mb-2" value="">

            <label>صور المشروع (مسارات مفصولة بفواصل)</label>
            <input type="file" name="projict[${projectIndex}][projectimages]" class="form-control mb-2" value="">

            <label>لغات مستخدمة ضمن المشروع</label>
            <input type="text" name="projict[${projectIndex}][projectskills]" class="form-control mb-2" value="">

            <label>رابط المشروع</label>
            <input type="text" name="projict[${projectIndex}][projectlink]" class="form-control mb-2" value="">

            <label>شرح مختصر للمشروع</label>
            <textarea name="projict[${projectIndex}][projectdescription]" class="form-control mb-2"></textarea>
        </div>
        `;

        container.insertAdjacentHTML("beforeend", projectHTML);
        projectIndex++;
    });
});

</script>

@endsection
