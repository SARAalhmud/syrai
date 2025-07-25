@extends('layouts.navigation')
@section('nav')
  <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <h1 class="text-white fw-bold">الملفات الشخصية</h1>
                    <p class="text-light fs-5 mb-0">تصفح ملفات أفضل الخبراء التقنيين في سوريا</p>
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
                                <input type="text" class="form-control" placeholder="ابحث عن خبير..." id="profileSearch">
                            </div>
                            <div class="col-md-4">
                                <select class="form-select" id="specialtyFilter">
                                    <option value="">جميع التخصصات</option>
                                    <option value="web-development">تطوير الويب</option>
                                    <option value="mobile-development">تطوير التطبيقات</option>
                                    <option value="ui-ux-design">تصميم UI/UX</option>
                                    <option value="data-science">علوم البيانات</option>
                                    <option value="cybersecurity">الأمن السيبراني</option>
                                    <option value="cloud-computing">الحوسبة السحابية</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary w-100" type="button" id="searchBtn">
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
                            <input type="radio" class="btn-check" name="sortBy" id="sortNewest" value="newest" checked>
                            <label class="btn btn-outline-primary" for="sortNewest">الأحدث</label>

                            <input type="radio" class="btn-check" name="sortBy" id="sortExperience" value="experience">
                            <label class="btn btn-outline-primary" for="sortExperience">الخبرة</label>

                            <input type="radio" class="btn-check" name="sortBy" id="sortRating" value="rating">
                            <label class="btn btn-outline-primary" for="sortRating">التقييم</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <!-- Profiles Section -->
    <section class="profiles-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Filters Sidebar -->
                    <div class="filters-sidebar bg-white rounded p-4 mb-4">
                        <h5 class="mb-4">تصفية النتائج</h5>

                        <!-- Experience Level -->
                        <div class="filter-group mb-4">
                            <h6 class="filter-title">مستوى الخبرة</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="junior" id="juniorCheck">
                                <label class="form-check-label" for="juniorCheck">مبتدئ (1-3 سنوات)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="mid" id="midCheck">
                                <label class="form-check-label" for="midCheck">متوسط (3-7 سنوات)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="senior" id="seniorCheck">
                                <label class="form-check-label" for="seniorCheck">خبير (+7 سنوات)</label>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="filter-group mb-4">
                            <h6 class="filter-title">المحافظة</h6>
                            <select class="form-select" id="locationFilter">
                                <option value="">جميع المحافظات</option>
                                <option value="damascus">دمشق</option>
                                <option value="aleppo">حلب</option>
                                <option value="homs">حمص</option>
                                <option value="lattakia">اللاذقية</option>
                                <option value="tartous">طرطوس</option>
                            </select>
                        </div>

                        <!-- Skills -->
                        <div class="filter-group mb-4">
                            <h6 class="filter-title">المهارات التقنية</h6>
                            <div class="skills-filter">
                                <span class="skill-tag-filter" data-skill="javascript">JavaScript</span>
                                <span class="skill-tag-filter" data-skill="python">Python</span>
                                <span class="skill-tag-filter" data-skill="react">React</span>
                                <span class="skill-tag-filter" data-skill="vue">Vue.js</span>
                                <span class="skill-tag-filter" data-skill="php">PHP</span>
                                <span class="skill-tag-filter" data-skill="laravel">Laravel</span>
                                <span class="skill-tag-filter" data-skill="flutter">Flutter</span>
                                <span class="skill-tag-filter" data-skill="figma">Figma</span>
                            </div>
                        </div>

                        <button class="btn btn-outline-secondary w-100" id="clearFilters">
                            <i class="fas fa-undo me-2"></i>
                            مسح الفلاتر
                        </button>
                    </div>
                </div>

                <div class="col-lg-9">
                    <!-- Results Header -->
                    <div class="results-header d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">النتائج: <span id="resultsCount">0</span> خبير</h5>
                        <div class="view-toggle">
                            <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="viewMode" id="gridView" checked>
                                <label class="btn btn-outline-primary" for="gridView">
                                    <i class="fas fa-th"></i>
                                </label>

                                <input type="radio" class="btn-check" name="viewMode" id="listView">
                                <label class="btn btn-outline-primary" for="listView">
                                    <i class="fas fa-list"></i>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Profiles Grid -->
                    <div class="row" id="profilesContainer">
            @foreach ($PersonalFiles as $PersonalFiles )

          <div class="col-lg-4 col-md-6 mb-4">

                        <div class="profile-card">
    <div class="profile-header text-center">
      <div class="profile-avatar mb-2">
        <img src="avatar.jpg" alt="صورة الخبير" />
      </div>
      <h5 class="mb-1">{{$PersonalFiles->first_name}}</h5>
      <p class="mb-0 text-muted">{{$PersonalFiles->expert->job_title_en}}</p>
    </div>
    <div class="profile-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">
          <i class="fas fa-map-marker-alt me-1"></i> {{$PersonalFiles->Governorate}}
        </span>
        <div class="rating">
          ⭐⭐⭐⭐☆
          <small class="ms-1">4.0</small>
        </div>
      </div>




@foreach($PersonalFiles as $user)
    <div class="skills">
        @if(!empty($user->expert->skills))
            @foreach($user->expert->skills as $skill)
                @if(($skill['level'] ?? 0) > 0)
                    <span class="skill-tag">{{ $skill['name'] }}</span>
                @endif
            @endforeach
        @endif
    </div>
@endforeach




      <div class="d-flex justify-content-between align-items-center">
        <small class="text-muted">
          <i class="fas fa-briefcase me-1"></i> {{ $PersonalFiles->expert->projects->count() ?? 0 }} مشروع
        </small>
        <a href="{{route('profile.show',['id'=>$PersonalFiles->id])}}" class="btn btn-primary btn-sm">
          <i class="fas fa-eye me-1"></i> عرض الملف
        </a>
      </div>
    </div>
  </div>

</div> @endforeach
      </div>

                    <!-- Pagination -->
                    <nav aria-label="Profiles pagination" class="mt-5">
                        <ul class="pagination justify-content-center" id="profilesPagination">
                            <!-- Pagination will be generated by JavaScript -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection
