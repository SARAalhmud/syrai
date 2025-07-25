<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - نادي التقنيين السوري</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts - Cairo -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
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
                        <a class="nav-link" href="/">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profiles.html">الملفات الشخصية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="directory.html">دليل الشركات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="forum.html">المنتدى</a>
                    </li>
                </ul>

                <div class="d-flex">
                    <a href="{{route('register')}}" class="btn btn-outline-light me-2">
                        <i class="fas fa-user-plus me-1"></i>
                        انضم إلينا
                    </a>
                </div>
            </div>
        </div>
    </nav>

     <section class="py-5" style="min-height: 100vh; background: linear-gradient(135deg, #f8f9fa 0%, #e8f5e8 100%);">
        <div class="container">
            <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="col-md-6 col-lg-5">
                    <div class="auth-form">
                        <div class="text-center mb-4">
                            <div class="mb-3">
                                <i class="fas fa-code" style="font-size: 3rem; color: var(--primary-color);"></i>
                            </div>
                            <h2>تسجيل الدخول</h2>
                            <p class="text-muted">أهلاً بك مرة أخرى في نادي التقنيين السوري</p>
                        </div>

 <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
      <div class="mb-3">
            <x-input-label for="email" :value="__('Email')"   class="form-label"/>
            <x-text-input  class="form-control"  id="email"  type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')"  class="form-label" />
 <div class="position-relative">
            <x-text-input id="password"  class="form-control"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                 <button type="button" class="btn btn-link position-absolute top-0 end-0 me-2 mt-1"
                                            style="border: none; background: none;" onclick="togglePassword()">

                                    </button>
        </div> </div>

        <!-- Remember Me -->
         <div class="mb-3 form-check">
            <label class="form-check-label" for="rememberMe">
                <input id="remember_me" type="checkbox" class="form-check-input" id="rememberMe"  name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

       <div class="flex items-center justify-end mt-4">

     @if (Route::has('password.request'))
     <a  class="text-decoration-none" style="color: var(--primary-color);" href="{{ route('password.request') }}">
                                   {{ __('Forgot your password?') }}
                                </a>
                                  @endif
                            </div>

            <x-primary-button type="submit" class="btn btn-primary w-100 mb-3">
                 <i class="fas fa-sign-in-alt me-2"></i>
                 {{ __('Log in') }}
            </x-primary-button>

        <hr class="my-4">

                            <div class="text-center">
                                <p class="mb-3">ليس لديك حساب؟</p>
                                <a href="{{route('register')}}" class="btn btn-outline-dark w-100">
                                    <i class="fas fa-user-plus me-2"></i>
                                    إنشاء حساب جديد
                                </a>
                            </div>
        </div>

   </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
