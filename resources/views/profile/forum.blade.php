@extends('layouts.navigation')

@section('nav')

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <h1 class="text-white fw-bold">منتدى نادي التقنيين السوري</h1>
                <p class="text-light fs-5 mb-0">شارك خبراتك ومعرفتك مع مجتمع التقنيين</p>
            </div>
        </div>
    </div>
</section>

<!-- Forum Section -->
<section class="forum-section py-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
           <div class="col-lg-3">
    <!-- Forum Sections -->
    <div class="bg-white rounded p-4 mb-4 shadow-sm">
        <h5 class="mb-4" style="color: var(--primary-color);">أقسام المنتدى</h5>
        <div class="list-group list-group-flush">
            <a href="{{ route('forum') }}" class="list-group-item list-group-item-action border-0 {{ request('section') == null ? 'active' : '' }}">
                <i class="fas fa-comments me-2"></i> جميع المواضيع
            </a>
            <a href="{{ route('forum', ['section' => 'web-dev']) }}" class="list-group-item list-group-item-action border-0 {{ request('section') == 'web-dev' ? 'active' : '' }}">
                تطوير الويب
            </a>
            <a href="{{ route('forum', ['section' => 'mobile-dev']) }}" class="list-group-item list-group-item-action border-0 {{ request('section') == 'mobile-dev' ? 'active' : '' }}">
                تطوير التطبيقات
            </a>
            <a href="{{ route('forum', ['section' => 'ui-ux']) }}" class="list-group-item list-group-item-action border-0 {{ request('section') == 'ui-ux' ? 'active' : '' }}">
                تصميم UI/UX
            </a>
            <a href="{{ route('forum', ['section' => 'security']) }}" class="list-group-item list-group-item-action border-0 {{ request('section') == 'security' ? 'active' : '' }}">
                الأمن السيبراني
            </a>
            <a href="{{ route('forum', ['section' => 'data-science']) }}" class="list-group-item list-group-item-action border-0 {{ request('section') == 'data-science' ? 'active' : '' }}">
                علوم البيانات
            </a>
            <a href="{{ route('forum', ['section' => 'career']) }}" class="list-group-item list-group-item-action border-0 {{ request('section') == 'career' ? 'active' : '' }}">
                الوظائف والمهن
            </a>
        </div>
    </div>



                <!-- Online Members -->
                <div class="bg-white rounded p-4 shadow-sm">
                    <h6 class="mb-3" style="color: var(--primary-color);">الأعضاء المتصلون</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <div class="d-flex align-items-center mb-2">
                            <div class="post-avatar">أح</div>
                            <small class="ms-2">أحمد محمد</small>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="post-avatar">فا</div>
                            <small class="ms-2">فاطمة أحمد</small>
                        </div>
                    </div>
                    <small class="text-muted">+15 عضو آخر</small>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <!-- New Post Button -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">أحدث المناقشات</h4>

                    @auth
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newPostModal">
                            <i class="fas fa-plus me-2"></i> موضوع جديد
                        </button>
                    @else
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">
                            <i class="fas fa-plus me-2"></i> موضوع جديد
                        </button>
                    @endauth
                </div>

                <!-- Forum Topics -->

   <div class="topic-card" data-topic-id="${topic.id}">

@foreach($posts as $topic)
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="flex-grow-1">
                    <h5 class="topic-title mb-2">
                        <a href="#" class="text-decoration-none" onclick="openTopic(${topic.id})">
                        {{ $topic->title }}
                        </a>
                    </h5>
                    <p class="text-muted mb-2" style="font-size: 0.9rem;">
                        </p>
                                        <div class="topic-tags mb-2">
  @foreach(explode(',', $topic->keywords) as $tag)
  <span class="badge bg-light text-dark me-1">{{ trim($tag) }}</span>

                    @endforeach
                                  </div>
                </div>


            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div class="topic-stats">
                    <span class="me-3">
                        <i class="fas fa-reply me-1"></i>
                         {{ $topic->replies_count }} رد
                    </span>
                    <span class="me-3">
                        <i class="fas fa-eye me-1"></i>
                                    {{ $topic->views }} مشاهدة
                    </span>
                    <span class="text-muted">
                        <i class="fas fa-clock me-1"></i>
{{ $topic->created_at->diffForHumans() }}
                    </span>
                </div>

                <div class="text-muted" style="font-size: 0.85rem;">
                    بواسطة  👤 {{  $topic->author_first_name  }}
                </div>
            </div>
        </div>
         @endforeach
<!-- Pagination -->
<div class="mt-4">
    {{ $posts->links() }}
</div>

        </div>
    </div>
</section>

<!-- New Post Modal -->
<div class="modal fade" id="newPostModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إنشاء موضوع جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="newPostForm" method="POST" action="{{ route('forum') }}">
                    @csrf
                      <label for="postCategory" class="form-label">القسم</label>
                            <select class="form-select" id="postCategory" required  name="section">
                                <option value="">اختر القسم</option>
                                <option value="web-dev">تطوير الويب</option>
                                <option value="mobile-dev">تطوير التطبيقات</option>
                                <option value="ui-ux">تصميم UI/UX</option>
                                <option value="security">الأمن السيبراني</option>
                                <option value="data-science">علوم البيانات</option>
                                <option value="career">الوظائف والمهن</option>
                            </select>
                        </div>

                    <div class="mb-3">
                        <label for="postTitle" class="form-label">عنوان الموضوع</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="postContent" class="form-label">محتوى الموضوع</label>
                        <textarea name="content" class="form-control" rows="6" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="postTags" class="form-label">الكلمات المفتاحية</label>
                        <input type="text" name="keywords" class="form-control" placeholder="مثال: Laravel, PHP, MVC">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">نشر الموضوع</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Login Required Modal -->
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
                <p class="text-muted">للتمكن من نشر موضوع جديد، الرجاء تسجيل الدخول</p>
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

@endsection
