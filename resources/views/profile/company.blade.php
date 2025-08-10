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

    <!-- Companies Section -->
    <section class="companies-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Filters Sidebar -->
                    <div class="filters-sidebar bg-white rounded p-4 mb-4">
                        <h5 class="mb-4">تصفية النتائج</h5>

                        <!-- Company Size -->
                        <form method="GET" action="{{ route('companies') }}">
                        <div class="filter-group mb-4">
                            <h6 class="filter-title">حجم الشركة</h6>
                           @php
    $selectedSizes = (array) request()->get('Company_Size');
@endphp

<div class="form-check">
    <input class="form-check-input" type="checkbox" value="small" id="smallCheck" name="Company_Size[]"
        {{ in_array('small', $selectedSizes) ? 'checked' : '' }}>
    <label class="form-check-label" for="smallCheck">صغيرة (11-50 موظف)</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" value="medium" id="mediumCheck" name="Company_Size[]"
        {{ in_array('medium', $selectedSizes) ? 'checked' : '' }}>
    <label class="form-check-label" for="mediumCheck">متوسطة (51-200 موظف)</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" value="large" id="largeCheck" name="Company_Size[]"
        {{ in_array('large', $selectedSizes) ? 'checked' : '' }}>
    <label class="form-check-label" for="largeCheck">كبيرة (+200 موظف)</label>
</div>


               <button type="submit" class="btn btn-primary mt-3">تصفية</button>

                        </div>
</form>
                        <!-- Location -->
                      <form method="GET" action="{{ route('companies') }}">
    <div class="filter-group mb-4">
        <h6 class="filter-title">المحافظة</h6>

        @php
            $governorates = [
                'damascus' => 'دمشق',
                'aleppo' => 'حلب',
                'homs' => 'حمص',
                'hama' => 'حماة',
                'lattakia' => 'اللاذقية',
                'tartous' => 'طرطوس',
                'deir-ez-zor' => 'دير الزور',
                'raqqa' => 'الرقة',
                'hasakah' => 'الحسكة',
                'idleb' => 'إدلب',
                'deraa' => 'درعا',
                'sweida' => 'السويداء',
                'quneitra' => 'القنيطرة',
                'damascus-countryside' => 'ريف دمشق',
            ];
            $selectedGovernorate = request()->get('Governorate');
        @endphp

        <select class="form-control" name="Governorate">
            <option value="">-- اختر المحافظة --</option>
            @foreach ($governorates as $value => $label)
                <option value="{{ $value }}" {{ $selectedGovernorate === $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary mt-3">تصفية</button>
    </div>
</form>

               <div class="filter-group mb-4">
                            <h6 class="filter-title">الخدمات المقدمة</h6>
                          <form method="GET" action="{{ route('companies') }}">

                            <div class="services-filter">
                                <div class="form-check">

                           @php
    $selectedSizes = (array) request()->get('CompanyServices');
@endphp

<div class="form-check">
    <input class="form-check-input" type="checkbox" value="webDevService" id="webDevService" name="CompanyServices[]"
        {{ in_array('webDevService', $selectedSizes) ? 'checked' : '' }}>
  <label class="form-check-label" for="webDevService">تطوير الويب</label>

</div>

<div class="form-check">
      <input class="form-check-input" type="checkbox" value="ui-ux-design" id="designService"name="CompanyServices[]"
                            {{ in_array('mobileDevService', $selectedSizes) ? 'checked' : '' }}>
      <label class="form-check-label" for="mobileDevService">تطوير التطبيقات</label>
                       </div>


<div class="form-check">
      <input class="form-check-input" type="checkbox" value="designService" id="designService"name="CompanyServices[]"
                            {{ in_array('designService', $selectedSizes) ? 'checked' : '' }}>
        <label class="form-check-label" for="designService">تصميم UI/UX</label>
                                             </div>
<div class="form-check">
     <input class="form-check-input" type="checkbox" value="digital-marketing" id="marketingService" name="CompanyServices[]"
                                                  {{ in_array('designService', $selectedSizes) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="marketingService">التسويق الرقمي</label>

                                                </div>


               <button type="submit" class="btn btn-primary mt-3">تصفية</button>

                        </div>
</form>
                        <!-- Services -->

                            </div>
                        </div>

                        <button class="btn btn-outline-secondary w-100" id="clearJobFilters">
                            <i class="fas fa-undo me-2"></i>
                          <a href="{{ route('companies') }}" class="btn btn-outline-secondary w-100">

    مسح الفلاتر
</a>

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
                  @if($company->image)
    <img src="{{ asset('storage/' . $company->image) }}" alt="Profile Image" width="150" >
@else
    <p>لا توجد صورة شخصية</p>
    @endif   </div>
            <h5 class="mb-1"> مجال الشركة</h5>
            <p class="mb-0 opacity-75"> {{$company->Business_sector}} </p>
        </div>
        <div class="profile-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">
                    <i class="fas fa-map-marker-alt me-1"></i>
                  {{$company->Governorate}}
                </span>
                <div class="rating">



    @php
        $averageRating = $company->average_rating; // هذي attribute محسوبة
        $ratingsCount = $company->ratings_count;
        $fullStars = floor($averageRating);
        $halfStar = ($averageRating - $fullStars) >= 0.5;
        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
    @endphp

    <div class="rating-display">
        <span class="average-rating">{{ number_format($averageRating, 1) }}</span>

        @for ($i = 0; $i < $fullStars; $i++)
            <i class="fas fa-star" style="color: gold;"></i>
        @endfor

        @if ($halfStar)
            <i class="fas fa-star-half-alt" style="color: gold;"></i>
        @endif

        @for ($i = 0; $i < $emptyStars; $i++)
            <i class="far fa-star" style="color: gold;"></i>
        @endfor

        <span class="ms-2">({{ $ratingsCount }} تقييم)</span>
    </div>


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
                  <a href="{{ route('companyprofile.show', $company->compan->id  ) }}" class="btn btn-primary btn-sm">
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
                    <a href="{{route('register')}}" class="btn  ">

                        <i class="fas fa-building me-2"></i>
                        سجل شركتك الآن
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </section>


@endsection
