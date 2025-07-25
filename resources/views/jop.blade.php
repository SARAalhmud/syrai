@extends('layouts.navigation')
@section('nav')

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <h1 class="text-white fw-bold">فرص العمل التقنية</h1>
                    <p class="text-light fs-5 mb-0">اكتشف أحدث الوظائف في مجال التقنية في سوريا</p>
                </div>
            </div>
        </div>
    </section>

 <!-- Search and Filter Section -->
<section class="search-filter-section py-4 bg-light">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-8">
                <div class="search-container bg-white rounded p-3 mb-3 shadow-sm">
                    <div class="row g-3 align-items-center">

                        {{-- نوع الوظيفة --}}
                        <div class="col-md-6 col-lg-4">
                            <form method="GET" action="{{ route('jop') }}">
                                <label for="jobType" class="form-label mb-1 fw-bold">نوع الوظيفة</label>
                                <select class="form-select mb-2" id="jobType" name="jobType" onchange="this.form.submit()">
                                    <option value="">جميع الأنواع</option>
                                    <option value="full-time" {{ request('jobType') == 'full-time' ? 'selected' : '' }}>دوام كامل</option>
                                    <option value="part-time" {{ request('jobType') == 'part-time' ? 'selected' : '' }}>دوام جزئي</option>
                                    <option value="freelance" {{ request('jobType') == 'freelance' ? 'selected' : '' }}>عمل حر</option>
                                    <option value="remote" {{ request('jobType') == 'remote' ? 'selected' : '' }}>عن بُعد</option>
                                    <option value="internship" {{ request('jobType') == 'internship' ? 'selected' : '' }}>تدريب</option>
                                </select>
                                <button class="btn btn-outline-primary w-100" type="submit">تصفية النوع</button>
                            </form>
                        </div>

                        {{-- الموقع --}}
                        <div class="col-md-6 col-lg-4">
                            <form method="GET" action="{{ route('jop') }}">
                                <label for="jobLocation" class="form-label mb-1 fw-bold">الموقع</label>
                                <select class="form-select mb-2" id="jobLocation" name="jobLocation" onchange="this.form.submit()">
                                    <option value="">جميع المدن</option>
                                    <option value="damascus" {{ request('jobLocation') == 'damascus' ? 'selected' : '' }}>دمشق</option>
                                    <option value="aleppo" {{ request('jobLocation') == 'aleppo' ? 'selected' : '' }}>حلب</option>
                                    <option value="homs" {{ request('jobLocation') == 'homs' ? 'selected' : '' }}>حمص</option>
                                    <option value="hama" {{ request('jobLocation') == 'hama' ? 'selected' : '' }}>حماة</option>
                                    <option value="lattakia" {{ request('jobLocation') == 'lattakia' ? 'selected' : '' }}>اللاذقية</option>
                                    <option value="tartous" {{ request('jobLocation') == 'tartous' ? 'selected' : '' }}>طرطوس</option>
                                    <option value="idlib" {{ request('jobLocation') == 'idlib' ? 'selected' : '' }}>إدلب</option>
                                    <option value="raqqa" {{ request('jobLocation') == 'raqqa' ? 'selected' : '' }}>الرقة</option>
                                    <option value="deir-ezzor" {{ request('jobLocation') == 'deir-ezzor' ? 'selected' : '' }}>دير الزور</option>
                                    <option value="hasakeh" {{ request('jobLocation') == 'hasakeh' ? 'selected' : '' }}>الحسكة</option>
                                    <option value="sweida" {{ request('jobLocation') == 'sweida' ? 'selected' : '' }}>السويداء</option>
                                    <option value="daraa" {{ request('jobLocation') == 'daraa' ? 'selected' : '' }}>درعا</option>
                                    <option value="quneitra" {{ request('jobLocation') == 'quneitra' ? 'selected' : '' }}>القنيطرة</option>
                                    <option value="remote" {{ request('jobLocation') == 'remote' ? 'selected' : '' }}>عن بُعد</option>
                                </select>
                                <button class="btn btn-outline-primary w-100" type="submit">تصفية المدينة</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="d-flex gap-2 justify-content-lg-end mt-3 mt-lg-0">
                    @auth
                    <!-- زر نشر وظيفة -->
                    <button type="button" class="btn btn-success flex-fill" data-bs-toggle="modal" data-bs-target="#postJobModal">
                        <i class="fas fa-plus me-2"></i> نشر وظيفة
                    </button>
                    @endauth

                    @guest
                    <!-- زر تسجيل الدخول لنشر الوظيفة -->
                    <button type="button" class="btn btn-success flex-fill" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">
                        <i class="fas fa-plus me-2"></i> نشر وظيفة
                    </button>
                    @endguest
                </div>
            </div>

        </div>
    </div>
</section>


    <!-- Jobs Section -->
    <section class="jobs-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Filters Sidebar -->
                    <div class="filters-sidebar bg-white rounded p-4 mb-4">
                        <h5 class="mb-4">تصفية النتائج</h5>

                        <!-- Experience Level -->
       <form method="GET" action="{{ route('jop') }}">
    <div class="filter-group mb-4">
        <h6 class="filter-title">مستوى الخبرة</h6>

        @php
            $selectedLevels = (array) request()->get('experienceLevel');
        @endphp

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="experienceLevel[]" value="entry" id="entryCheck"
                   {{ in_array('entry', $selectedLevels) ? 'checked' : '' }}>
            <label class="form-check-label" for="entryCheck">مبتدئ</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="experienceLevel[]" value="mid" id="midJobCheck"
                   {{ in_array('mid', $selectedLevels) ? 'checked' : '' }}>
            <label class="form-check-label" for="midJobCheck">متوسط</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="experienceLevel[]" value="senior" id="seniorJobCheck"
                   {{ in_array('senior', $selectedLevels) ? 'checked' : '' }}>
            <label class="form-check-label" for="seniorJobCheck">خبير</label>
        </div>

        <button type="submit" class="btn btn-primary mt-3">تصفية</button>
    </div>
</form>



                        <!-- Job Category -->

 <form method="GET" action="{{ route('jop') }}">
    <div class="filter-group mb-4">
          <h6 class="filter-title">فئة الوظيفة</h6>


        @php
            $jobCategory = (array) request()->get('jobCategory');
        @endphp

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="jobCategory[]" value="development" id="entryCheck"
                   {{ in_array('development', $jobCategory) ? 'checked' : '' }}>
            <label class="form-check-label" for="entryCheck">تطوير</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="jobCategory[]" value="design" id="midJobCheck"
                   {{ in_array('design', $jobCategory) ? 'checked' : '' }}>
            <label class="form-check-label" for="midJobCheck">تصميم</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="jobCategory[]" value="marketing" id="seniorJobCheck"
                   {{ in_array('marketing', $jobCategory) ? 'checked' : '' }}>
            <label class="form-check-label" for="seniorJobCheck">تسويق</label>
        </div>
         <div class="form-check">
            <input class="form-check-input" type="checkbox" name="jobCategory[]" value="security" id="seniorJobCheck"
                   {{ in_array('security', $jobCategory) ? 'checked' : '' }}>
            <label class="form-check-label" for="seniorJobCheck">أمن سيبراني</label>
        </div>

        <button type="submit" class="btn btn-primary mt-3">تصفية</button>
    </div>
</form>
                        <!-- Salary Range -->

<form method="GET" action="{{ route('jop') }}">
    @php
        $selectedSalary = request('salaryRange');
    @endphp

    <div class="filter-group mb-4">
        <h6 class="filter-title">نطاق الراتب (ألف ل.س)</h6>
        <select class="form-select mb-3" id="salaryFilter" name="salaryRange">
            <option value="">جميع النطاقات</option>
            <option value="under-500" {{ $selectedSalary == 'under-500' ? 'selected' : '' }}>أقل من 500</option>
            <option value="500-1000" {{ $selectedSalary == '500-1000' ? 'selected' : '' }}>500 - 1000</option>
            <option value="1000-2000" {{ $selectedSalary == '1000-2000' ? 'selected' : '' }}>1000 - 2000</option>
            <option value="2000-3000" {{ $selectedSalary == '2000-3000' ? 'selected' : '' }}>2000 - 3000</option>
            <option value="over-3000" {{ $selectedSalary == 'over-3000' ? 'selected' : '' }}>أكثر من 3000</option>
        </select>

        <button type="submit" class="btn btn-primary w-100">تصفية</button>
    </div>
</form>



                        <button class="btn btn-outline-secondary w-100" id="clearJobFilters">
                            <i class="fas fa-undo me-2"></i>
                          <a href="{{ route('jop') }}" class="btn btn-outline-secondary w-100">

    مسح الفلاتر
</a>

                        </button>
                    </div>

                    <!-- Quick Stats -->
                    <div class="bg-white rounded p-4 shadow-sm">
                        <h6 class="mb-3" style="color: var(--primary-color);">إحصائيات سريعة</h6>
                        <div class="d-flex justify-content-between mb-2">
                            <span>الوظائف النشطة</span>
                            <strong id="activeJobsCount">42</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>شركات تنشر</span>
                            <strong>15</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>جديد هذا الأسبوع</span>
                            <strong>8</strong>
                        </div>
                    </div>
                </div>

                <!-- Main Jobs Content -->
                <div class="col-lg-9">
                    <!-- Results Header -->


                    <!-- Jobs List -->
                    <div id="jobsContainer">

                          @foreach ($jopse as  $job)
           <div class="container py-5">
    <div class="job-card mb-4 fade show" style="animation-delay: 0s;">
        <div class="bg-white rounded p-4 shadow-sm border-right-accent">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="flex-grow-1">
                    <div class="d-flex align-items-center mb-2">
                        <h5 class="job-title mb-0 me-3">{{ $job->jobTitle }}</h5>
                    </div>
                    <p class="company-name text-primary mb-1">
                        <i class="fas fa-building me-1"></i>
                        {{ $job->companyName }}
                    </p>
                    <div class="job-meta d-flex flex-wrap gap-3 text-muted">
                        <span><i class="fas fa-map-marker-alt me-1"></i> {{ $job->jobLocation }}</span>
                        <span><i class="fas fa-user-tie me-1"></i>
                            @switch($job->jobType)
                                @case('full-time') دوام كامل @break
                                @case('part-time') دوام جزئي @break
                                @case('freelance') عمل حر @break
                                @case('remote') عمل عن بُعد @break
                                @case('internship') تدريب @break
                                @default غير محددة
                            @endswitch
                        </span>
                        <span><i class="fas fa-money-bill me-1"></i> {{ $job->salaryRange }}</span>
                    </div>
                    @if($job->isUrgent)
                        <span class="badge bg-danger mt-2">وظيفة عاجلة</span>
                    @endif
                </div>
            </div>

            <div class="job-description mb-3">
                <h6>وصف الوظيفة</h6>
                <p>{{ $job->jobDescription }}</p>
            </div>

            <div class="job-requirements mb-3">
                <h6>المتطلبات</h6>
                <p>{{ $job->jobRequirements }}</p>
            </div>

            <div class="job-tags mb-3">
                <h6>المستوى المطلوب</h6>
                @switch($job->experienceLevel)
                    @case('entry') مبتدئ @break
                    @case('mid') متوسط @break
                    @case('senior') خبير @break
                    @default غير محددة
                @endswitch
            </div>



            <div class="job-contact mb-3">
                <h6>معلومات التواصل</h6>
                <p><i class="fas fa-envelope me-2"></i> {{ $job->contactEmail }}</p>
                <p><i class="fas fa-calendar me-2"></i> تاريخ النشر:    {{ $job->updated_at->format('Y-m-d') }}
                   </p>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div class="job-actions">
                  @if($job->is_closed)
    <span class="badge bg-danger">انتهى التقديم</span>
@endif

<div class="job-actions">
    @if($job->is_closed)
        <button class="btn btn-secondary" disabled>
            <i class="fas fa-times-circle me-1"></i>
            التقديم مغلق
        </button>
    @else
        <a href="" class="btn btn-outline-success">
            <i class="fas fa-paper-plane me-1"></i>
            تقدم للوظيفة
        </a>
    @endif
</div>

                </div>
                <button class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-bookmark"></i>
                </button>
            </div>
        </div>
    </div>
</div>
         @endforeach
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Jobs pagination" class="mt-5">
                        <ul class="pagination justify-content-center" id="jobsPagination">
                             {{ $jopse->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Post Job Modal -->
    @auth
<!-- Modal نشر وظيفة -->



<!-- مودال نشر الوظيفة -->
<div class="modal fade" id="postJobModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="postJobForm" method="POST" action="{{ route('jop') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">نشر وظيفة جديدة</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
        </div>
        <div class="modal-body">
          <!-- الحقول هنا مثل ما كتبتها سابقاً -->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="jobTitle" class="form-label">عنوان الوظيفة</label>
              <input type="text" class="form-control" id="jobTitle" name="jobTitle" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="companyName" class="form-label">اسم الشركة</label>
              <input type="text" class="form-control" id="companyName" name="companyName" required>
            </div>
          </div>

<!-- Modal نشر وظيفة -->




    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="jobType" class="form-label">نوع العمل</label>
            <select class="form-select" id="jobType" name="jobType" required>
                <option value="">اختر النوع</option>
                <option value="full-time">دوام كامل</option>
                <option value="part-time">دوام جزئي</option>
                <option value="freelance">عمل حر</option>
                <option value="remote">عمل عن بُعد</option>
                <option value="internship">تدريب</option>
            </select>
        </div>
     <div class="col-md-3">
    <label for="jobLocation" class="form-label">المحافظة</label>
    <select class="form-select" id="jobLocation" name="jobLocation">
        <option value="">جميع المحافظات</option>
        <option value="damascus" {{ request('jobLocation') == 'damascus' ? 'selected' : '' }}>دمشق</option>
        <option value="aleppo" {{ request('jobLocation') == 'aleppo' ? 'selected' : '' }}>حلب</option>
        <option value="homs" {{ request('jobLocation') == 'homs' ? 'selected' : '' }}>حمص</option>
        <option value="hama" {{ request('jobLocation') == 'hama' ? 'selected' : '' }}>حماة</option>
        <option value="lattakia" {{ request('jobLocation') == 'lattakia' ? 'selected' : '' }}>اللاذقية</option>
        <option value="tartous" {{ request('jobLocation') == 'tartous' ? 'selected' : '' }}>طرطوس</option>
        <option value="daraa" {{ request('jobLocation') == 'daraa' ? 'selected' : '' }}>درعا</option>
        <option value="sweida" {{ request('jobLocation') == 'sweida' ? 'selected' : '' }}>السويداء</option>
        <option value="deir-ezzor" {{ request('jobLocation') == 'deir-ezzor' ? 'selected' : '' }}>دير الزور</option>
        <option value="raqqa" {{ request('jobLocation') == 'raqqa' ? 'selected' : '' }}>الرقة</option>
        <option value="hasakeh" {{ request('jobLocation') == 'hasakeh' ? 'selected' : '' }}>الحسكة</option>
        <option value="idlib" {{ request('jobLocation') == 'idlib' ? 'selected' : '' }}>إدلب</option>
        <option value="quneitra" {{ request('jobLocation') == 'quneitra' ? 'selected' : '' }}>القنيطرة</option>
        <option value="remote" {{ request('jobLocation') == 'remote' ? 'selected' : '' }}>عن بُعد</option>
    </select>
</div>

        <div class="col-md-4 mb-3">
            <label for="experienceLevel" class="form-label">مستوى الخبرة</label>
            <select class="form-select" id="experienceLevel" name="experienceLevel" required>
                <option value="">اختر المستوى</option>
                <option value="entry">مبتدئ</option>
                <option value="mid">متوسط</option>
                <option value="senior">خبير</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="salaryRange" class="form-label">نطاق الراتب</label>
            <input type="text" class="form-control" id="salaryRange" name="salaryRange" placeholder="مثال: 1000 - 2000 ألف ل.س">
        </div>
        <div class="col-md-6 mb-3">
            <label for="jobCategory" class="form-label">فئة الوظيفة</label>
            <select class="form-select" id="jobCategory" name="jobCategory" required>
                <option value="">اختر الفئة</option>
                <option value="development">تطوير</option>
                <option value="design">تصميم</option>
                <option value="marketing">تسويق</option>
                <option value="security">أمن سيبراني</option>
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label for="jobDescription" class="form-label">وصف الوظيفة</label>
        <textarea class="form-control" id="jobDescription" name="jobDescription" rows="4" required></textarea>
    </div>

    <div class="mb-3">
        <label for="jobRequirements" class="form-label">المتطلبات</label>
        <textarea class="form-control" id="jobRequirements" name="jobRequirements" rows="3" placeholder="اكتب كل متطلب في سطر منفصل"></textarea>
    </div>

    <div class="mb-3">
        <label for="contactEmail" class="form-label">البريد الإلكتروني للتواصل</label>
        <input type="email" class="form-control" id="contactEmail" name="contactEmail" required>
    </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
          <button type="submit" class="btn btn-success">نشر الوظيفة</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endauth
    <!-- Footer -->

<div class="modal fade" id="loginRequiredModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تسجيل الدخول مطلوب</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-sign-in-alt text-primary mb-3" style="font-size: 3rem;"></i>
                <h6>يجب تسجيل الدخول أولاً</h6>
                <p class="text-muted">للتمكن من نشر الوظائف، يجب عليك تسجيل الدخول كخبير أو شركة</p>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="{{ route('login') }}" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    تسجيل الدخول
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-success">
                    <i class="fas fa-user-plus me-2"></i>
                    إنشاء حساب
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
