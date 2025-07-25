@extends('layouts.navigation')
@section('nav')
 <section class="profile-header-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="profile-header-card">
                        <div class="profile-cover">
                            <div class="profile-actions">
                                <button class="btn btn-outline-light btn-sm me-2" id="shareProfileBtn">
                                    <i class="fas fa-share me-1"></i>
                                    مشاركة
                                </button>
                                <button class="btn btn-success btn-sm" id="contactBtn">
                                    <i class="fas fa-envelope me-1"></i>
                                    تواصل
                                </button>
                            </div>
                        </div>

                        <div class="profile-info">
                            <div class="row align-items-center">
                                <div class="col-md-3 text-center">
                                    <div class="profile-avatar-large" id="profileAvatar">
                                        أم
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <h2 class="profile-name mb-2" id="profileName">{{$user->compan->Company_Name}}</h2>

                                    <div class="profile-meta d-flex flex-wrap gap-3 mb-3">
                                        <span class="meta-item">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            <span id="profileLocation">{{$user->Governorate}}</span>
                                        </span>
                                      <span class="meta-item">
                                              <i class="fas fa-briefcase me-1"></i>


     <span id="profileExperience"> <strong>قطاع العمل</strong>
    @if($user->compan->Business_sector == 'software-developmen')
   تطوير البرمجيات
    @elseif($user->compan->Business_sector == 'web-design')
تصميم المواقع
    @elseif($user->compan->Business_sector == 'mobile-apps')
تطبيقات الجوال
 @elseif($user->compan->Business_sector == 'digital-marketing')
التسويق الرقمي
 @elseif($user->compan->Business_sector == 'it-consulting')
استشارات تقنية
@elseif($user->compan->Business_sector == 'cybersecurity')
الأمن السيبراني
    @else
        غير محددة
    @endif</span>


      <span id="profileExperience"> <strong>حجم الشركة</strong>
    @if($user->compan->Company_Size == 'startup')
 ناشئة
    @elseif($user->compan->Company_Size == 'small')
صغيرة
    @elseif($user->compan->Company_Size == 'medium')
متوسطة
 @elseif($user->compan->Company_Size == 'large')
كبيرة

    @else
        غير محددة
    @endif</span>




   <span class="meta-item">
                                            <i class="fas fa-project-diagram me-1"></i>
                                            <span id="profileProjects">45 مشروع</span>
                                        </span>
                                    </div>

                                    <div class="profile-rating mb-3">
                                        <div class="rating" id="profileRating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span class="ms-2">4.8 (23 تقييم)</span>
                                        </div>
                                    </div>

                                    <div class="profile-availability">
                                        {{-- <span class="badge bg-success">@if ($user->expert->availability == true)
                                            متاح للعمل
                                       @else
                                       غير متاح للعمل
                                            @endif</span> --}}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
     <section class="profile-content py-5">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- About Section -->
                    <div class="content-card mb-4">
                        <h4 class="section-title mb-3">
                            <i class="fas fa-user me-2"></i>
                    نبذة عنا
                        </h4>
                        <p class="profile-description" id="profileDescription">
                         @if (empty($user->compan->bio))
                            لا يوجد بيانات قم بالتعديل
                         @else
                         {{$user->compan->bio}}
                            @endif          </p>
                    </div>
 <div class="content-card mb-4">
    <h4 class="section-title mb-3">
        <i class="fas fa-user me-2"></i>
        خدمات الشركة
    </h4>
    <p class="profile-description" id="profileDescription">
        @if ($user->compan && is_array($user->compan->CompanyServices) && count($user->compan->CompanyServices) > 0)
            @foreach ($user->compan->CompanyServices as $service)
                <span class="badge bg-success me-1">{{ $service }}</span>
            @endforeach
        @else
            <span class="text-muted">قم بالتعديل لإضافة خدمات الشركة</span>
        @endif
    </p>
</div>

                    <!-- Skills Section -->




                    <!-- Projects Section -->
                    <div class="content-card mb-4">
                        <h4 class="section-title mb-3">
                            <i class="fas fa-folder-open me-2"></i>
                            أحدث المشاريع
                        </h4>
                        <div class="row" >
                             @if($user->compan)
    @foreach ($user->compan->projects as $project)

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

                        <button class="btn btn-primary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#contactModal">
                            <i class="fas fa-paper-plane me-2"></i>
                            إرسال رسالة
                        </button>
                        <button class="btn btn-outline-success w-100">
                            <i class="fas fa-download me-2"></i>
                            تحميل السيرة الذاتية
                        </button>
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

                            </div>
                            <div class="stat-item d-flex justify-content-between">
                                <span>معدل الاستجابة</span>
                                <strong>95%</strong>
                            </div>
                        </div>
                    </div>

      </div>
            </div>
        </div>
    </section>
@endsection


