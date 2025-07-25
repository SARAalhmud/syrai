@extends('layouts.navigation')
@section('nav')
 <section class="hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-100 pt-5">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="display-4 fw-bold text-white mb-4">
                            مرحباً بك في
                            <span class="text-warning">نادي التقنيين السوري</span>
                        </h1>
                        <p class="fs-5 text-light mb-4">
                            منصة تجمع أفضل الخبراء التقنيين والشركات في سوريا لتعزيز التعاون المهني وتبادل المعرفة
                        </p>

                        <!-- Search Bar -->
                        <div class="search-container bg-white rounded-pill p-2 mb-4">
                            <div class="row g-0 align-items-center">
                                <div class="col">
                                    <input type="text" class="form-control border-0 px-3"
                                           placeholder="ابحث عن خبير أو شركة..." id="heroSearch">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary rounded-pill px-4" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hero-image text-center">
                        <div class="floating-cards">
                            <div class="card tech-card">
                                <i class="fab fa-js-square text-warning"></i>
                                <span>JavaScript</span>
                            </div>
                            <div class="card tech-card">
                                <i class="fab fa-python text-info"></i>
                                <span>Python</span>
                            </div>
                            <div class="card tech-card">
                                <i class="fab fa-react text-primary"></i>
                                <span>React</span>
                            </div>
                            <div class="card tech-card">
                                <i class="fas fa-mobile-alt text-success"></i>
                                <span>Mobile</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
      <section class="stats-section py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="stat-number" data-target="1250">{{ $expertsCount }}</h3>
                        <p class="stat-label">خبير تقني</p>
                    </div>
                </div>

                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3 class="stat-number" data-target="180">{{ $companiesCount }}</h3>
                        <p class="stat-label">شركة تقنية</p>
                    </div>
                </div>

                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3 class="stat-number" data-target="850">{{ $studentsCount }}</h3>
                        <p class="stat-label"> عدد الطلاب</p>
                    </div>
                </div>

                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h3 class="stat-number" data-target="420">{{ $jobsCount }}</h3>
                        <p class="stat-label">فرصة عمل</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
      <section class="featured-section py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">خبراء مميزون</h2>
                    <p class="section-subtitle">تعرف على أفضل الخبراء التقنيين في سوريا</p>
                </div>
            </div>

            <div class="row" id="featuredExperts">
                <!-- Featured experts will be loaded here by JavaScript -->
            </div>

            <div class="text-center mt-4">
                <a href="{{route('PersonalFiles')}}" class="btn btn-primary btn-lg">
                    <i class="fas fa-eye me-2"></i>
                    عرض جميع الخبراء
                </a>
            </div>
        </div>
    </section>
      <section class="services-section py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">تخصصاتنا التقنية</h2>
                    <p class="section-subtitle">مجالات الخبرة المتاحة في نادي التقنيين السوري</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-code"></i>
                        </div>
                        <h4>تطوير الويب</h4>
                        <p>خبراء في تطوير المواقع والتطبيقات باستخدام أحدث التقنيات</p>
                        <div class="service-skills">
                            <span class="skill-tag">React</span>
                            <span class="skill-tag">Vue.js</span>
                            <span class="skill-tag">Laravel</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4>تطوير التطبيقات</h4>
                        <p>تطوير تطبيقات الهواتف الذكية للأندرويد و iOS</p>
                        <div class="service-skills">
                            <span class="skill-tag">Flutter</span>
                            <span class="skill-tag">React Native</span>
                            <span class="skill-tag">Kotlin</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-paint-brush"></i>
                        </div>
                        <h4>تصميم UI/UX</h4>
                        <p>تصميم واجهات المستخدم وتجربة المستخدم الرقمية</p>
                        <div class="service-skills">
                            <span class="skill-tag">Figma</span>
                            <span class="skill-tag">Adobe XD</span>
                            <span class="skill-tag">Sketch</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <h4>علوم البيانات</h4>
                        <p>تحليل البيانات والذكاء الاصطناعي والتعلم الآلي</p>
                        <div class="service-skills">
                            <span class="skill-tag">Python</span>
                            <span class="skill-tag">TensorFlow</span>
                            <span class="skill-tag">SQL</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4>الأمن السيبراني</h4>
                        <p>حماية الأنظمة والشبكات من التهديدات الرقمية</p>
                        <div class="service-skills">
                            <span class="skill-tag">Ethical Hacking</span>
                            <span class="skill-tag">Penetration Testing</span>
                            <span class="skill-tag">Security Audit</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-cloud"></i>
                        </div>
                        <h4>الحوسبة السحابية</h4>
                        <p>خدمات السحابة وإدارة البنية التحتية التقنية</p>
                        <div class="service-skills">
                            <span class="skill-tag">AWS</span>
                            <span class="skill-tag">Azure</span>
                            <span class="skill-tag">Docker</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- Companies Section -->
    <section class="companies-section py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">شركات رائدة</h2>
                    <p class="section-subtitle">الشركات التقنية النشطة في منصتنا</p>
                </div>
            </div>

            <div class="row" id="featuredCompanies">
                <!-- Featured companies will be loaded here by JavaScript -->
            </div>

            <div class="text-center mt-4">
                <a href="{{route('companies')}}" class="btn btn-primary btn-lg">
                    <i class="fas fa-building me-2"></i>
                    عرض دليل الشركات
                </a>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-white mb-4">انضم إلى مجتمعنا التقني اليوم</h2>
                    <p class="text-light fs-5 mb-4">
                        كن جزءاً من أكبر شبكة للمحترفين التقنيين في سوريا
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="register.html" class="btn btn-success btn-lg">
                            <i class="fas fa-user-plus me-2"></i>
                            سجل كخبير
                        </a>
                        <a href="register.html" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-building me-2"></i>
                            سجل شركتك
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
