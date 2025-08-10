@extends('layouts.navigation')
@section('nav')
@if (session('success'))
    <div id="fly-alert" class="fly-alert">
        {{ session('success') }}
         <i class="fas fa-paper-plane me-2"></i>
    </div>
@endif
@if (session('error'))
    <div>
        {{ session('error') }}
         <i class="fas fa-paper-plane me-2"></i>
    </div>
@endif

<style>
    .fly-alert {
        position: fixed;
        top: 20px;
        left: -100%; /* تبدأ من خارج يسار الشاشة */
        background-color: #44df66;
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        font-size: 16px;
        z-index: 9999;
        animation: flyin 3s ease-in-out forwards;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    @keyframes flyin {
        0% {
            left: -100%;
            opacity: 0;
        }
        20% {
            left: 20px;
            opacity: 1;
        }
        80% {
            left: 20px;
            opacity: 1;
        }
        100% {
            left: 100%;
            opacity: 0;
        }
    }
</style>


 <section class="profile-header-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="profile-header-card">
                        <div class="profile-cover">
                            <div class="profile-actions">

                            </div>
                        </div>

                        <div class="profile-info">
                            <div class="row align-items-center">
                                <div class="col-md-3 text-center">
                                    <div class="profile-avatar-large" id="profileAvatar">
                                      @if($company->user->image)
    <img src="{{ asset('storage/' . $company->user->image) }}" alt="Profile Image" width="150" >
@else
    <p>لا توجد صورة شخصية</p>
    @endif
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <h2 class="profile-name mb-2" id="profileName">{{$company?->Company_Name ?? 'اسم الشركة غير متوفر'}}
</h2>

                                    <div class="profile-meta d-flex flex-wrap gap-3 mb-3">
                                        <span class="meta-item">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            <span id="profileLocation">{{$company->user->Governorate}}</span>
                                        </span>
                                      <span class="meta-item">
                                              <i class="fas fa-briefcase me-1"></i>


     <span id="profileExperience"> <strong>قطاع العمل</strong>
    @if($company->Business_sector == 'software-developmen')
   تطوير البرمجيات
    @elseif($company->Business_sector == 'web-design')
تصميم المواقع
    @elseif($company->Business_sector == 'mobile-apps')
تطبيقات الجوال
 @elseif($company->Business_sector == 'digital-marketing')
التسويق الرقمي
 @elseif($company->Business_sector == 'it-consulting')
استشارات تقنية
@elseif($company->Business_sector == 'cybersecurity')
الأمن السيبراني
    @else
        غير محددة
    @endif</span>


      <span id="profileExperience"> <strong>حجم الشركة</strong>
    @if($company->Company_Size == 'startup')
 ناشئة
    @elseif($company->Company_Size == 'small')
صغيرة
    @elseif($company->Company_Size == 'medium')
متوسطة
 @elseif($company->Company_Size == 'large')
كبيرة

    @else
        غير محددة
    @endif</span>




   <span class="meta-item">
                                            <i class="fas fa-project-diagram me-1"></i>
                                            <span id="profileProjects">{{ $projectsCount }}  مشروع</span>
                                        </span>
                                    </div>

                                    <div class="profile-rating mb-3">
                                        <div class="rating" id="profileRating">
                                                            <div class="profile-rating mb-3">
@php
    $averageRating = $averageRating ?? 0;
    $ratingsCount = $ratingsCount ?? 0;

    $fullStars = floor($averageRating);
    $halfStar = ($averageRating - $fullStars) >= 0.5;
    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
@endphp


<div class="rating-display">
    <span class="average-rating">{{ number_format($averageRating, 1) }}</span>

    {{-- نجوم كاملة --}}
    @for ($i = 0; $i < $fullStars; $i++)
        <i class="fas fa-star" style="color: gold;"></i>
    @endfor

    {{-- نصف نجمة --}}
    @if ($halfStar)
        <i class="fas fa-star-half-alt" style="color: gold;"></i>
    @endif

    {{-- نجوم فارغة --}}
    @for ($i = 0; $i < $emptyStars; $i++)
        <i class="far fa-star" style="color: gold;"></i>
    @endfor

    <span class="ms-2">({{ $ratingsCount }} تقييم)</span>
</div>


 @auth
<!-- زر لفتح مودال التقييم -->
<button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#ratingModal">
    إضافة تقييم
</button>

<!-- مودال التقييم -->
<div class="modal fade" id="ratingModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('companycontroller.store',$company->id) }}">
            @csrf
            <input type="hidden" name="rated_id" value="{{ $company->user->id }}">
<input type="hidden" name="rated_type" value="App\Models\Company">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تقييم المستخدم</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label>اختر التقييم:</label>
                    <select name="rating_value" class="form-select" required>
                        <option value="">اختر...</option>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} نجمة</option>
                        @endfor
                    </select>

                    <label class="mt-3">تعليق (اختياري):</label>
                    <textarea name="comment" class="form-control" rows="4"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">إرسال التقييم</button>
                </div>
            </div>
        </form>
    </div>
</div>
@else
<!-- إذا لم يكن مسجل -->
<button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">
    إضافة تقييم
</button>

<!-- مودال يطلب تسجيل الدخول -->
<div class="modal fade" id="loginRequiredModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title">تسجيل الدخول مطلوب</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <i class="fas fa-sign-in-alt text-primary mb-3" style="font-size: 3rem;"></i>
                <h6>يجب تسجيل الدخول أولاً</h6>
                <p class="text-muted">لتتمكن من إضافة تقييم، الرجاء تسجيل الدخول.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="{{ route('login') }}" class="btn btn-primary">تسجيل الدخول</a>
                <a href="{{ route('register') }}" class="btn btn-outline-success">إنشاء حساب</a>
            </div>
        </div>
    </div>
</div>
@endauth


    </div>


</span>
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
                         @if (empty($company->bio))
                            لا يوجد بيانات قم بالتعديل
                         @else
                         {{$company->bio}}
                            @endif          </p>
                    </div>
 <div class="content-card mb-4">
    <h4 class="section-title mb-3">
        <i class="fas fa-user me-2"></i>
        خدمات الشركة
    </h4>
    <p class="profile-description" id="profileDescription">
        @if ($company && is_array($company->CompanyServices) && count($company->CompanyServices) > 0)
            @foreach ($company->CompanyServices as $service)
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
                             @if($company)
    @foreach ($company->projects as $project)

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
                                <span id="profileEmail">{{$company->user->email}} </span>
                            </div>
                            <div class="contact-item mb-3">
                                <i class="fas fa-phone text-primary me-2"></i>
                                <span id="profilePhone">{{$company->user->Phone_Number}}</span>
                            </div>
        @php
    $social_links = $social_links ?? [];
@endphp


                              @if (empty($company->user->social_links))
                            لا يوجد بيانات قم بالتعديل
                         @else
                         @foreach ($social_links as $link)
    <div class="contact-item mb-3">
        @if($link['platform'] == 'website')
            <i class="fas fa-globe text-primary me-2"></i>
            <a href="{{ $link['url'] }}" id="profileWebsite" target="_blank">
                {{ $$company->user->first_name }} profile
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

                         @auth
    <button class="btn btn-primary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#contactModal">
        <i class="fas fa-paper-plane me-2"></i>
        إرسال رسالة
    </button>
@else
    <button class="btn btn-primary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">
        <i class="fas fa-paper-plane me-2"></i>
        إرسال رسالة
    </button>
@endauth
                       @if ($company->user->cv_path)
    <a href="{{ asset('storage/' . $company->user->cv_path) }}" class="btn btn-outline-success w-100" download>
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

                    </div>

      </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="contactModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إرسال رسالة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="contactForm" method="POST" action="{{ route('send.message', ['id' => $company->id]) }}">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $company->id }}">
                <input type="hidden" name="receiver_type" value="company">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="senderName" class="form-label">اسمك</label>
                        <input type="text" name="senderName" class="form-control" id="senderName" required>
                    </div>
                    <div class="mb-3">
                        <label for="senderEmail" class="form-label">بريدك الإلكتروني</label>
                        <input type="email" name="senderEmail" class="form-control" id="senderEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="messageSubject" class="form-label">الموضوع</label>
                        <select name="messageSubject" class="form-select" id="messageSubject" required>
                            <option value="">اختر الموضوع</option>
                            <option value="project">مشروع جديد</option>
                            <option value="collaboration">تعاون</option>
                            <option value="consultation">استشارة</option>
                            <option value="job-offer">عرض عمل</option>
                            <option value="other">أخرى</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="messageContent" class="form-label">الرسالة</label>
                        <textarea name="messageContent" class="form-control" id="messageContent" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">إرسال الرسالة</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="loginRequiredModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title">تسجيل الدخول مطلوب</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <i class="fas fa-sign-in-alt text-primary mb-3" style="font-size: 3rem;"></i>
                <h6>يجب تسجيل الدخول أولاً</h6>
                <p class="text-muted">للتمكن من إرسال رسالة، الرجاء تسجيل الدخول</p>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="{{ route('login') }}" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt me-2"></i> تسجيل الدخول
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-success">
                    <i class="fas fa-user-plus me-2"></i> إنشاء حساب
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    // اختفاء التوست بعد 5 ثوانٍ
    setTimeout(() => {
        const toast = document.getElementById('toastMessage');
        if (toast) {
            const bsToast = bootstrap.Toast.getOrCreateInstance(toast);
            bsToast.hide();
        }
    }, 5000);
</script>

@endsection


