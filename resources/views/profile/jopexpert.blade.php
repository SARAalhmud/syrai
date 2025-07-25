  @extends('layouts.navigation')
@section('nav')
<div>

    <div class="mt-5"></div>
    <hr><hr>
       @if(session('status'))
    <div class="alert alert-success mt-3">
        {{ session('status') }}
    </div>
@endif
  <div id="jobsContainer">

                             @forelse($jobs as $job)
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

            <div class="job-tags mb-3">
                <h6>المهارات المطلوبة</h6>
                @foreach($job->tags ?? [] as $tag)
                    <span class="badge bg-light text-dark me-1 mb-1">{{ $tag }}</span>
                @endforeach
            </div>

            <div class="job-contact mb-3">
                <h6>معلومات التواصل</h6>
                <p><i class="fas fa-envelope me-2"></i> {{ $job->contactEmail }}</p>
                <p><i class="fas fa-calendar me-2"></i> تاريخ النشر:    {{ $job->updated_at->format('Y-m-d') }}
                   </p>
            </div>

          <form action="{{ route('jobs.toggleStatus', $job->id) }}" method="POST">
    @csrf
    @method('PATCH')

    @if($job->is_closed)
        <button class="btn btn-success">إعادة فتح التقديم</button>
    @else
        <button class="btn btn-danger">إغلاق التقديم</button>
    @endif
</form>


            </div>
        </div>
    </div>
</div>



    {{-- عرض الوظيفة --}}
@empty
    <p>لا توجد فرص عمل لهذا الخبير حالياً.</p>
@endforelse


                    </div></div>
@endsection
