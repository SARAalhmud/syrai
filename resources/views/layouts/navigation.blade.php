<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نادي التقنيين السوري - منصة لربط الخبراء التقنيين والشركات</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts - Cairo -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<style>
  /* تصغير مربعات التقييم */
  .skills-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
  }

  .skill-item {
    flex: 1 1 200px; /* كل عنصر بعرض تقريباً 200px مع تكسير الأسطر */
    min-width: 150px;
  }

  .skill-input {
    width: 100px !important; /* عرض مربع التقييم */
    display: inline-block;

  }
</style>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.html">
                <i class="fas fa-code me-2"></i>
                نادي التقنيين السوري
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link " href="/">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('PersonalFiles')}}">الملفات الشخصية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('companies')}}">دليل الشركات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('jop')}}">فرص العمل</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('forum')}}">المنتدى</a>
                    </li>
                </ul>

               <div class="d-flex">
    @guest
        <a href="{{ route('login') }}" class="btn btn-outline-light me-2">
            <i class="fas fa-sign-in-alt me-1"></i>
            تسجيل الدخول
        </a>
        <a href="{{ route('register') }}" class="btn btn-success">
            <i class="fas fa-user-plus me-1"></i>
            انضم إلينا
        </a>
    @endguest

 @auth
    @php
        $user = Auth::user();
    @endphp

    @if ($user && $user->type === 'expert')
        <a href="{{ route('profile', ['id' => $user->id]) }}" class="btn btn-outline-light me-2">
            <i class="fas fa-user-cog me-1"></i>
            صفحتي كخبير
        </a>
    @elseif ($user && $user->type === 'beginner')
        <a href="{{ route('beginner', ['id' => $user->id]) }}" class="btn btn-outline-light me-2">
            <i class="fas fa-user me-1"></i>
            صفحتي كمبتدئ
        </a>
    @elseif ($user && $user->type === 'student')
        <a href="{{ route('student', ['id' => $user->id]) }}" class="btn btn-outline-light me-2">
            <i class="fas fa-user-graduate me-1"></i>
            صفحتي كطالب
        </a>
    @elseif ($user && $user->type === 'company')
        <a href="{{ route('company', ['id' => $user->id]) }}" class="btn btn-outline-light me-2">
            <i class="fas fa-building me-1"></i>
            صفحتي كشركة
        </a>
    @endif

    <form action="{{ route('logout') }}" method="POST" class="ms-2">
        @csrf
        <button type="submit" class="btn btn-danger">
            <i class="fas fa-sign-out-alt me-1"></i>
            تسجيل الخروج
        </button>
    </form>
@endauth


                </div>
            </div>
        </div>
    </nav>

<div class="mt-5"></div>
    @yield('nav')

    <!-- Footer -->
    <footer class="footer bg-dark text-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="text-success mb-3">
                        <i class="fas fa-code me-2"></i>
                        نادي التقنيين السوري
                    </h5>
                    <p class="mb-3">
                        منصة تجمع أفضل الخبراء التقنيين والشركات في سوريا لتعزيز التعاون المهني وتبادل المعرفة
                    </p>
                    <div class="social-links">
                        <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-telegram"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="text-warning mb-3">روابط سريعة</h6>
                    <ul class="list-unstyled">
                        <li><a href="index.html" class="text-light text-decoration-none">الرئيسية</a></li>
                        <li><a href="profiles.html" class="text-light text-decoration-none">الملفات الشخصية</a></li>
                        <li><a href="directory.html" class="text-light text-decoration-none">دليل الشركات</a></li>
                        <li><a href="#" class="text-light text-decoration-none">من نحن</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="text-warning mb-3">التخصصات</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">تطوير الويب</a></li>
                        <li><a href="#" class="text-light text-decoration-none">تطوير التطبيقات</a></li>
                        <li><a href="#" class="text-light text-decoration-none">تصميم UI/UX</a></li>
                        <li><a href="#" class="text-light text-decoration-none">الأمن السيبراني</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 mb-4">
                    <h6 class="text-warning mb-3">تواصل معنا</h6>
                    <p><i class="fas fa-envelope me-2"></i> info@syrian-tech-club.com</p>
                    <p><i class="fas fa-phone me-2"></i> +963 11 123 4567</p>
                    <p><i class="fas fa-map-marker-alt me-2"></i> دمشق، سوريا</p>
                </div>
            </div>

            <hr class="my-4">

            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2024 نادي التقنيين السوري. جميع الحقوق محفوظة.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-light text-decoration-none me-3">سياسة الخصوصية</a>
                    <a href="#" class="text-light text-decoration-none">شروط الاستخدام</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
