@extends('layouts.navigation')
@section('nav')

    <!-- Profile Header -->
    <section class="profile-header-section">
        <div class="container">
</form>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="profile-header-card">
   <div class="profile-cover">
  <div class="profile-header-card position-relative"> <!-- تأكد من أن هذا العنصر نسبي -->

    <div class="profile-cover">
        <!-- زر الجرس في الزاوية العلوية اليسرى -->
        <button class="btn btn-outline-warning rounded-circle d-flex align-items-center justify-content-center position-absolute"
                style="top: 10px; right: 10px; width: 42px; height: 42px; z-index: 10;">

            <a href="{{route('messages.inbox')}}"><i class="fas fa-bell"></i></a>
        </button>

        <!-- الأزرار الأخرى -->
        <div class="profile-actions d-flex flex-wrap gap-2 align-items-center">
            <div class="d-flex gap-2 ms-auto">
                @if(auth()->user()->expert)
                    <a href="{{ route('expertsjop', ['experts_id' => auth()->user()->expert->id]) }}"
                       class="btn btn-success btn-sm">
                        <i class="fas fa-briefcase me-1"></i> منشورات فرص العمل
                    </a>
                @endif

                <button class="btn btn-success btn-sm">
                    <i class="fas fa-comments me-1"></i> منشورات المنتدى
                </button>
            </div>
        </div>
    </div>
</div>


</div>




                        <div class="profile-info">
                            <div class="row align-items-center">
                                <div class="col-md-3 text-center">
                                    <div class="profile-avatar-large" id="profileAvatar">
                                      @if($user->image)
    <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" width="150" >
@else
    <p>لا توجد صورة شخصية</p>
    @endif
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <h2 class="profile-name mb-2" id="profileName">{{$user->first_name}} {{$user->last_name}}</h2>
                                    <h5 class="profile-title text-primary mb-3" id="profileTitle">{{$user->expert->job_title_en}}</h5>

                                    <div class="profile-meta d-flex flex-wrap gap-3 mb-3">
                                        <span class="meta-item">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            <span id="profileLocation">{{$user->Governorate}}</span>
                                        </span>
                                        <span class="meta-item">
                                              <i class="fas fa-briefcase me-1"></i>
                                            <span id="profileExperience"> <strong>سنوات الخبرة:</strong>
    @if($user->expert->years_of_experience == 'junior')
        1-3 سنوات
    @elseif($user->expert->years_of_experience == 'mid')
        3-7 سنوات
    @elseif($user->expert->years_of_experience == 'senior')
        أكثر من 7 سنوات
    @else
        غير محددة
    @endif</span></i>
                                            <span id="profileExperience"></span>
                                        </span>
                                        <span class="meta-item">
                                            <i class="fas fa-project-diagram me-1"></i>
                                            <span id="profileProjects">{{ $projectsCount }}  مشروع</span>
                                        </span>
                                    </div>




                                    <div class="profile-availability">
                                        <span class="badge bg-success">@if ($user->expert->availability == true)
                                            متاح للعمل
                                       @else
                                       غير متاح للعمل
                                            @endif</span>
                                    </div>
                                <a href="{{route('edite')}}">    <button type="submit" class="btn btn-success w-100">تعديل</button>
</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Profile Content -->
    <section class="profile-content py-5">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- About Section -->
                    <div class="content-card mb-4">
                        <h4 class="section-title mb-3">
                            <i class="fas fa-user me-2"></i>
                            نبذة عني
                        </h4>
                        <p class="profile-description" id="profileDescription">
                         @if (empty($user->expert->bio))
                            لا يوجد بيانات قم بالتعديل
                         @else
                         {{$user->expert->bio}}
                            @endif          </p>
                    </div>

                    <!-- Skills Section -->
                    <div class="content-card mb-4">
                        <h4 class="section-title mb-3">
                            <i class="fas fa-cogs me-2"></i>
                            المهارات التقنية
                        </h4>
                        <div class="skills-grid" >
                          @php
    $skills = is_array(auth()->user()->skills)
        ? auth()->user()->skills
        : (is_string(auth()->user()->skills) ? json_decode(auth()->user()->skills, true) : []);
@endphp

                            @if (empty($user->skills))
                            لا يوجد بيانات قم بالتعديل
                         @else
                        @foreach($skills as $skill)
    <div class="skill-item mb-3">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <span class="skill-name">{{ $skill['name'] }}</span>
            <span class="skill-percentage">{{ $skill['level'] }}%</span>
        </div>
        <div class="skill-progress">
            <div class="skill-progress-bar" style="width: {{ $skill['level'] }}%"></div>
        </div>
    </div>
@endforeach



                            @endif
                        </div>
                    </div>

                    <!-- Experience Section -->
                   <div class="content-card mb-4">
    <h4 class="section-title mb-3">
        <i class="fas fa-briefcase me-2"></i>
        الخبرة العملية
    </h4>
    <div class="experience-timeline" >
     @if($user->expert)
    @foreach ($user->expert->experiences as $experience)
        <div class="experience-item">
            <div class="experience-header">
                <h6 class="experience-position">{{ $experience->spec ?? '-' }}</h6>
                <span class="experience-period">{{ $experience->yers_start ?? '-' }} - {{ $experience->yers_end ?? '-' }}</span>
            </div>

            <p><strong>اسم الشركة:</strong> {{ $experience->name_compani ?? '-' }}</p>
            <p><strong>نبذة عن مهارات العمل:</strong> {{ $experience->texte ?? '-' }}</p>
        </div>
    @endforeach
@else
    <p>لا يوجد خبير مرتبط بهذا المستخدم.</p>
@endif

    </div>
</div>


                    <!-- Projects Section -->
                    <div class="content-card mb-4">
                        <h4 class="section-title mb-3">
                            <i class="fas fa-folder-open me-2"></i>
                            أحدث المشاريع
                        </h4>
                        <div class="row" >
                             @if($user->expert)
    @foreach ($user->expert->projects as $project)

                            <div class="col-md-6 mb-4">
            <div class="project-card">


<div class="project-image">

  @if(!empty($project->projectimages) && is_array($project->projectimages) && count($project->projectimages) > 0)
                <img src="{{ asset('storage/' . $project->projectimages[0]) }}" alt="صورة المشروع" class="card-img-top">
           @else
        <div class="project-placeholder">
            <i class="fas fa-laptop-code"></i>
        </div>
    @endif
</div>


                <div class="project-content">
                    <h6 class="project-name">{{ $project->projectname ?? '-' }}</h6>
                    <p class="project-description">{{ $project->projectdescription ?? '-' }}</p>
                    <div class="project-technologies mb-3">
@if(is_array($project->projectskills))
    @foreach($project->projectskills as $skill)
        <span class="badge bg-success me-1">{{ $skill }}</span>

    @endforeach
@else
    {{ $project->projectskills }} {{-- لو مش مصفوفة اعرض النص مباشرة --}}
@endif




    </div>
                    <a href="" class="btn btn-outline-primary btn-sm" target="_blank">
                        <i class="fas fa-external-link-alt me-1"></i>
                        عرض المشروع
                    </a>
                </div>
            </div>
        </div>
                    @endforeach
@else
    <p>لا يوجد خبير مرتبط بهذا المستخدم.</p>
@endif        </div>
                    </div>

                    <!-- Reviews Section -->
                    <div class="content-card mb-4">
                        <h4 class="section-title mb-3">
                            <i class="fas fa-star me-2"></i>
                            التقييمات والمراجعات
                        </h4>
                        <div id="profileReviews">
                            <!-- Reviews will be loaded here -->
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Contact Card -->
                    <div class="content-card mb-4">
                        <h5 class="card-title mb-3">
                            <i class="fas fa-address-card me-2"></i>
                            معلومات التواصل
                        </h5>
                        <div class="contact-info">
                            <div class="contact-item mb-3">
                                <i class="fas fa-envelope text-primary me-2"></i>
                                <span id="profileEmail">{{$user->email}} </span>
                            </div>
                            <div class="contact-item mb-3">
                                <i class="fas fa-phone text-primary me-2"></i>
                                <span id="profilePhone">{{$user->Phone_Number}}</span>
                            </div>
        @php
    $social_links = $social_links ?? [];
@endphp


                              @if (empty($user->social_links))
                            لا يوجد بيانات قم بالتعديل
                         @else
                         @foreach ($social_links as $link)
    <div class="contact-item mb-3">
        @if($link['platform'] == 'website')
            <i class="fas fa-globe text-primary me-2"></i>
            <a href="{{ $link['url'] }}" id="profileWebsite" target="_blank">
                {{ $user->first_name }} profile
            </a>
        @elseif($link['platform'] == 'linkedin')
            <i class="fab fa-linkedin text-primary me-2"></i>
            <a href="{{ $link['url'] }}" id="profileLinkedin" target="_blank">
                LinkedIn
            </a>

        @endif
    </div>
@endforeach
   @endif


                        <hr>


                       @if ($user->cv_path)
    <a href="{{ asset('storage/' . $user->cv_path) }}" class="btn btn-outline-success w-100" download>
        <i class="fas fa-download me-2"></i>
        تحميل السيرة الذاتية
    </a>
@else
    <button class="btn btn-outline-secondary w-100" disabled>
        لا توجد سيرة ذاتية
    </button>
@endif

                    </div>

                    <!-- Stats Card -->
                    <div class="content-card mb-4">
                        <h5 class="card-title mb-3">
                            <i class="fas fa-chart-bar me-2"></i>
                            إحصائيات الملف
                        </h5>
                        <div class="stats-list">
                            <div class="stat-item d-flex justify-content-between mb-2">
                                <span>مشاهدات الملف</span>
                                <strong>234</strong>
                            </div>
                            <div class="stat-item d-flex justify-content-between mb-2">
                                <span>المشاريع المكتملة</span>
                                <strong>45</strong>
                            </div>
                            <div class="stat-item d-flex justify-content-between mb-2">
                                <span>العملاء الراضون</span>
                                <strong>42</strong>
                            </div>
                            <div class="stat-item d-flex justify-content-between">
                                <span>معدل الاستجابة</span>
                                <strong>95%</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Similar Profiles -->
                    <div class="content-card">
                        <h5 class="card-title mb-3">
                            <i class="fas fa-users me-2"></i>
                            خبراء مشابهون
                        </h5>
                        <div id="similarProfiles">
                            <!-- Similar profiles will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Modal -->

    <!-- Footer -->
  @endsection
