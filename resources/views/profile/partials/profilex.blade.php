@extends('layouts.navigation')
@section('nav')
@if (session('error'))
    <div>
        {{ session('error') }}
         <i class="fas fa-paper-plane me-2"></i>
    </div>
@endif
@if (session('success'))
    <div  >
        {{ session('success') }}
         <i class="fas fa-paper-plane me-2"></i>
    </div>
@endif
<!-- User
    Header -->
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
                                        <span><strong>سنوات الخبرة:</strong>
                                            @if($user->expert->years_of_experience == 'junior')
                                                1-3 سنوات
                                            @elseif($user->expert->years_of_experience == 'mid')
                                                3-7 سنوات
                                            @elseif($user->expert->years_of_experience == 'senior')
                                                أكثر من 7 سنوات
                                            @else
                                                غير محددة
                                            @endif
                                        </span>
                                    </span>
                                    <span class="meta-item">
                                        <i class="fas fa-project-diagram me-1"></i>
                                        <span id="profileProjects">{{ $projectsCount }}  مشروع</span>
                                    </span>
                                </div>

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
        <form method="POST" action="{{ route('profile.store',$user->expert->id) }}">
            @csrf
            <input type="hidden" name="rated_id" value="{{ $user->expert->id }}">
<input type="hidden" name="rated_type" value="App\Models\Expert">

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
</div>


                                <div class="profile-availability">
                                    <span class="badge bg-success">
                                        @if ($user->expert->availability == true)
                                            متاح للعمل
                                        @else
                                            غير متاح للعمل
                                        @endif
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- User Content -->
<section class="profile-content py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- About Section -->
                <div class="content-card mb-4">
                    <h4 class="section-title mb-3">
                        <i class="fas fa-user me-2"></i>
                        عن المستخدم
                    </h4>
                    <p class="profile-description" id="profileDescription">
                        @if (empty($user->expert->bio))
                            لا يوجد بيانات
                        @else
                            {{$user->expert->bio}}
                        @endif
                    </p>
                </div>

                <!-- Skills Section -->
                <div class="content-card mb-4">
                    <h4 class="section-title mb-3">
                        <i class="fas fa-cogs me-2"></i>
                        المهارات التقنية
                    </h4>
                    <div class="skills-grid">
                      @php
    $skills = is_array($user->skills)
        ? $user->skills
        : (is_string($user->skills) ? json_decode($user->skills, true) : []);
@endphp

@if (empty($skills))
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
</div></div>
                <!-- Experience Section -->
                <div class="content-card mb-4">
                    <h4 class="section-title mb-3">
                        <i class="fas fa-briefcase me-2"></i>
                        تجارب المستخدم
                    </h4>
                    <div class="experience-timeline">
                        @foreach ($user->expert->experiences as $experience)
                            <div class="experience-item">
                                <div class="experience-header">
                                    <h6 class="experience-position">{{ $experience->spec ?? '-' }}</h6>
                                    <span class="experience-period">{{ $experience->yers_start ?? '-' }} - {{ $experience->yers_end ?? '-' }}</span>
                                </div>
                                <p><strong>اسم الشركة:</strong> {{ $experience->name_compani ?? '-' }}</p>
                                <p><strong>المهام:</strong> {{ $experience->texte ?? '-' }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Projects Section -->
                <div class="content-card mb-4">
                    <h4 class="section-title mb-3">
                        <i class="fas fa-folder-open me-2"></i>
                        مشاريع المستخدم
                    </h4>
                    <div class="row">
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
                                                {{ $project->projectskills }}
                                            @endif
                                        </div>
                                        <a href="#" class="btn btn-outline-primary btn-sm" target="_blank">
                                            <i class="fas fa-external-link-alt me-1"></i>
                                            عرض المشروع
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
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
                            <span id="profileEmail">{{$user->email}}</span>
                        </div>
                        <div class="contact-item mb-3">
                            <i class="fas fa-phone text-primary me-2"></i>
                            <span id="profilePhone">{{$user->Phone_Number}}</span>
                        </div>
                        @php $social_links = $social_links ?? []; @endphp
                        @foreach ($social_links as $link)
                            <div class="contact-item mb-3">
                                @if($link['platform'] == 'website')
                                    <i class="fas fa-globe text-primary me-2"></i>
                                    <a href="{{ $link['url'] }}" target="_blank">الموقع الشخصي</a>
                                @elseif($link['platform'] == 'linkedin')
                                    <i class="fab fa-linkedin text-primary me-2"></i>
                                    <a href="{{ $link['url'] }}" target="_blank">LinkedIn</a>
                                @endif
                            </div>
                        @endforeach

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
            <form id="contactForm" method="POST" action="{{ route('send.message', ['id' => $user->id]) }}">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $user->expert->id }}">
                <input type="hidden" name="receiver_type" value="expert">
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
