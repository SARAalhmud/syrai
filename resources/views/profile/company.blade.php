@extends('layouts.navigation')
@section('nav')

      <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <h1 class="text-white fw-bold">دليل الشركات التقنية</h1>
                    <p class="text-light fs-5 mb-0">اكتشف أفضل الشركات والمؤسسات التقنية في سوريا</p>
                </div>
            </div>
        </div>
    </section>
     <!-- Search and Filter Section -->
    <section class="search-filter-section py-4 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="search-container bg-white rounded p-3 mb-3">
                        <div class="row g-2 align-items-center">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="ابحث عن شركة..." id="companySearch">
                            </div>
                            <div class="col-md-4">
                                <select class="form-select" id="industryFilter">
                                    <option value="">جميع القطاعات</option>
                                    <option value="software-development">تطوير البرمجيات</option>
                                    <option value="web-design">تصميم المواقع</option>
                                    <option value="mobile-apps">تطبيقات الجوال</option>
                                    <option value="digital-marketing">التسويق الرقمي</option>
                                    <option value="it-consulting">استشارات تقنية</option>
                                    <option value="cybersecurity">الأمن السيبراني</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary w-100" type="button" id="searchCompanyBtn">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="filter-options bg-white rounded p-3">
                        <h6 class="mb-3">ترتيب حسب:</h6>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="sortCompanies" id="sortAlphabetical" value="alphabetical" checked>
                            <label class="btn btn-outline-primary" for="sortAlphabetical">الاسم</label>

                            <input type="radio" class="btn-check" name="sortCompanies" id="sortSize" value="size">
                            <label class="btn btn-outline-primary" for="sortSize">الحجم</label>

                            <input type="radio" class="btn-check" name="sortCompanies" id="sortRating" value="rating">
                            <label class="btn btn-outline-primary" for="sortRating">التقييم</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Companies Section -->
    <section class="companies-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Filters Sidebar -->
                    <div class="filters-sidebar bg-white rounded p-4 mb-4">
                        <h5 class="mb-4">تصفية النتائج</h5>

                        <!-- Company Size -->
                        <div class="filter-group mb-4">
                            <h6 class="filter-title">حجم الشركة</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="startup" id="startupCheck">
                                <label class="form-check-label" for="startupCheck">ناشئة (1-10 موظفين)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="small" id="smallCheck">
                                <label class="form-check-label" for="smallCheck">صغيرة (11-50 موظف)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="medium" id="mediumCheck">
                                <label class="form-check-label" for="mediumCheck">متوسطة (51-200 موظف)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="large" id="largeCheck">
                                <label class="form-check-label" for="largeCheck">كبيرة (+200 موظف)</label>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="filter-group mb-4">
                            <h6 class="filter-title">المحافظة</h6>
                            <select class="form-select" id="companyLocationFilter">
                                <option value="">جميع المحافظات</option>
                                <option value="damascus">دمشق</option>
                                <option value="aleppo">حلب</option>
                                <option value="homs">حمص</option>
                                <option value="lattakia">اللاذقية</option>
                                <option value="tartous">طرطوس</option>
                            </select>
                        </div>

                        <!-- Services -->
                        <div class="filter-group mb-4">
                            <h6 class="filter-title">الخدمات المقدمة</h6>
                            <div class="services-filter">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="web-development" id="webDevService">
                                    <label class="form-check-label" for="webDevService">تطوير الويب</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="mobile-development" id="mobileDevService">
                                    <label class="form-check-label" for="mobileDevService">تطوير التطبيقات</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="ui-ux-design" id="designService">
                                    <label class="form-check-label" for="designService">تصميم UI/UX</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="digital-marketing" id="marketingService">
                                    <label class="form-check-label" for="marketingService">التسويق الرقمي</label>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-outline-secondary w-100" id="clearCompanyFilters">
                            <i class="fas fa-undo me-2"></i>
                            مسح الفلاتر
                        </button>
                    </div>
                </div>

                <div class="col-lg-9">
                    <!-- Results Header -->
                    <div class="results-header d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">النتائج: <span id="companyResultsCount">0</span> شركة</h5>
                        <div class="view-toggle">
                            <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="companyViewMode" id="companyGridView" checked>
                                <label class="btn btn-outline-primary" for="companyGridView">
                                    <i class="fas fa-th"></i>
                                </label>

                                <input type="radio" class="btn-check" name="companyViewMode" id="companyListView">
                                <label class="btn btn-outline-primary" for="companyListView">
                                    <i class="fas fa-list"></i>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Companies Grid -->
                    <div class="row" id="companiesContainer">
                    @foreach ($company as $company )
      <div class="col-lg-4 col-md-6 mb-4 fade-in-up" style="animation-delay: 0.1s">
    <div class="company-card">
        <div class="profile-header text-center">
            <div class="profile-avatar mb-3">
                <!-- شعار الشركة -->
                <img src="logo.png" alt="Logo" class="img-fluid" style="max-height: 80px;">
            </div>
            <h5 class="mb-1"> مجال الشركة</h5>
            <p class="mb-0 opacity-75"> {{$company->Business_sector}} </p>
        </div>
        <div class="profile-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">
                    <i class="fas fa-map-marker-alt me-1"></i>
                  {{$company->user->Governorate}}
                </span>
                <div class="rating">
                    ★★★★☆ <small class="ms-1">4.5</small>
                </div>
            </div>

            <div class="mb-3">
                <span class="company-size">  {{$company->Company_Size}}</span>
            </div>

            <div class="mb-3">
                <small class="text-muted d-block mb-2">الخدمات:
                      @if ($company && is_array($company->CompanyServices) && count($company->CompanyServices) > 0)

                    @foreach ($company->CompanyServices as $service)
                <span class="badge bg-success me-1">{{ $service }}</span>
            @endforeach @endif</small>
                <div class="services">
                    <span class="skill-tag"></span>

                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    <i class="fas fa-users me-1"></i>
                    @if($company->Company_Size == 'startup')
1-10 موظفين
    @elseif($company->Company_Size == 'small')
11-50 موظف
    @elseif($company->Company_Size == 'medium')
51-200 موظف
 @elseif($company->Company_Size == 'large')
أكثر من 200 موظف

    @endif
                </small>
                  <a href="{{ route('showcompan.show', $company->id) }}" class="btn btn-primary btn-sm">
    <i class="fas fa-building me-1"></i>
    عرض الشركة
</a>

            </div>
        </div>
    </div>
</div>

  @endforeach

                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Companies pagination" class="mt-5">
                        <ul class="pagination justify-content-center" id="companiesPagination">
                            <!-- Pagination will be generated by JavaScript -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
       <!-- Call to Action -->
    <section class="cta-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-white mb-4">هل تريد إضافة شركتك؟</h2>
                    <p class="text-light fs-5 mb-4">
                        انضم إلى دليل الشركات التقنية الرائدة في سوريا
                    </p>
                    <button class="btn btn-warning btn-lg">
                        <i class="fas fa-building me-2"></i>
                        سجل شركتك الآن
                    </button>
                </div>
            </div>
        </div>
    </section>


@endsection
