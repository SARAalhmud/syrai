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

     <!-- Profiles Section -->
    <section class="profiles-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Filters Sidebar -->
                    <div class="filters-sidebar bg-white rounded p-4 mb-4">
                        <h5 class="mb-4">تصفية النتائج</h5>

                        <!-- Experience Level -->
                           <form method="GET" action="{{ route('PersonalFiles') }}">

                        <div class="filter-group mb-4">
                            <h6 class="filter-title">مستوى الخبرة</h6>
                               @php
    $selectedSizes = (array) request()->get('years_of_experience');
@endphp

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="junior" id="juniorCheck"name="years_of_experience[]"
        {{ in_array('junior', $selectedSizes) ? 'checked' : '' }}>
                                <label class="form-check-label" for="juniorCheck">مبتدئ (1-3 سنوات)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="mid" id="midCheck"name="years_of_experience[]"
        {{ in_array('mid', $selectedSizes) ? 'checked' : '' }}>
                                <label class="form-check-label" for="midCheck">متوسط (3-7 سنوات)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="senior" id="seniorCheck"name="years_of_experience[]"
        {{ in_array('senior', $selectedSizes) ? 'checked' : '' }}>
                                <label class="form-check-label" for="seniorCheck">خبير (+7 سنوات)</label>

               <button type="submit" class="btn btn-primary mt-3">تصفية</button>

                        </div>
</form>


                        </div>

                        <!-- Location -->
                                          <form method="GET" action="{{ route('PersonalFiles') }}">
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


                        <!-- Skills -->
                      <div class="filter-group mb-4">
    <h6 class="filter-title">المهارات التقنية</h6>
    <div class="skills-filter">
        <a href="{{ route('PersonalFiles', ['skill' => 'JavaScript']) }}" class="skill-tag-filter" data-skill="JavaScript">JavaScript</a>
        <a href="{{ route('PersonalFiles', ['skill' => 'python']) }}" class="skill-tag-filter" data-skill="python">Python</a>
        <a href="{{ route('PersonalFiles', ['skill' => 'react']) }}" class="skill-tag-filter" data-skill="react">React</a>
        <a href="{{ route('PersonalFiles', ['skill' => 'vue']) }}" class="skill-tag-filter" data-skill="vue">Vue.js</a>
        <a href="{{ route('PersonalFiles', ['skill' => 'php']) }}" class="skill-tag-filter" data-skill="php">PHP</a>
        <a href="{{ route('PersonalFiles', ['skill' => 'laravel']) }}" class="skill-tag-filter" data-skill="laravel">Laravel</a>
        <a href="{{ route('PersonalFiles', ['skill' => 'flutter']) }}" class="skill-tag-filter" data-skill="flutter">Flutter</a>
        <a href="{{ route('PersonalFiles', ['skill' => 'figma']) }}" class="skill-tag-filter" data-skill="figma">Figma</a>
    </div>
</div>


                         <button class="btn btn-outline-secondary w-100" id="clearJobFilters">
                            <i class="fas fa-undo me-2"></i>
                          <a href="{{ route('PersonalFiles') }}" class="btn btn-outline-secondary w-100">

    مسح الفلاتر
</a>

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
          @if($PersonalFiles->image)
    <img src="{{ asset('storage/' . $PersonalFiles->image) }}" alt="Profile Image" width="150" >
@else
    <p>لا توجد صورة شخصية</p>
    @endif
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
        @php
            $averageRating = $PersonalFiles->averageRating;
            $ratingsCount =$PersonalFiles->ratingsCount;

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

                 </div>

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
