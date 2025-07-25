<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب - نادي التقنيين السوري</title>

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
                    <a href="{{route('login')}}" class="btn btn-outline-light me-2">
                        <i class="fas fa-sign-in-alt me-1"></i>
                        تسجيل الدخول
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <section class="py-5" style="min-height: 100vh; background: linear-gradient(135deg, #f8f9fa 0%, #e8f5e8 100%);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="auth-form">
                        <div class="text-center mb-4">
                            <div class="mb-3">
                                <i class="fas fa-user-plus" style="font-size: 3rem; color: var(--primary-color);"></i>
                            </div>
                            <h2>انضم إلى نادي التقنيين السوري</h2>
                            <p class="text-muted">أنشئ حسابك الآن وكن جزءاً من مجتمعنا التقني</p>
                        </div>

                     <form method="POST" action="{{ route('register') }}"  >
        @csrf
        <!-- Account Type Selection -->
                            <div class="mb-4">
                                <label class="form-label">نوع الحساب</label>
                                <div class="row">
                                    <div class="col-6 col-lg-3 mb-2">
                                        <input type="radio" class="btn-check" name="type" id="expert" value="expert" checked>
                                        <label class="btn btn-outline-primary w-100" for="expert">
                                            <i class="fas fa-user-tie me-2"></i>
                                            خبير
                                        </label>
                                    </div>
                                    <div class="col-6 col-lg-3 mb-2">
                                        <input type="radio" class="btn-check" name="type" id="beginner" value="beginner">
                                        <label class="btn btn-outline-primary w-100" for="beginner">
                                            <i class="fas fa-user me-2"></i>
                                            مبتدئ
                                        </label>
                                    </div>
                                    <div class="col-6 col-lg-3 mb-2">
                                        <input type="radio" class="btn-check" name="type" id="student" value="student">
                                        <label class="btn btn-outline-primary w-100" for="student">
                                            <i class="fas fa-graduation-cap me-2"></i>
                                            طالب
                                        </label>
                                    </div>
                                    <div class="col-6 col-lg-3 mb-2">
                                        <input type="radio" class="btn-check" name="type" id="company" value="company">
                                        <label class="btn btn-outline-primary w-100" for="company">
                                            <i class="fas fa-building me-2"></i>
                                            شركة
                                        </label>
                                    </div>
                                </div>


                            </div>
<!-- Expert Fields -->
                            <div id="expertFields">
                                <div class="row">
                   <div class="col-md-6 mb-3">
            <label for="firstName" class="form-label">الاسم الأول</label>
            <input type="text" class="form-control"  name="first_name"
                   value="{{ old('first_name') }}" required autofocus autocomplete="first_name">
          </div>
   <!-- Email Address -->
        <div class="col-md-6 mb-3">
            <label for="lastName" class="form-label">الاسم الأخير</label>
            <input type="text" class="form-control"  name="last_name"
                   value="{{ old('last_name') }}" required autocomplete="last_name">
           </div>
 </div>

                                <div class="mb-3">
                                    <label for="jobTitle" class="form-label">المسمى الوظيفي</label>
                                    <input type="text" class="form-control"  name="job_title_en" placeholder="مثال: مطور ويب متقدم">
                                </div>

                                <div class="mb-3">
                                    <label for="specialty" class="form-label">التخصص</label>
                                    <select class="form-select"  name="specialization">
                                        <option value="">اختر التخصص</option>
                                        <option value="web-development">تطوير الويب</option>
                                        <option value="mobile-development">تطوير التطبيقات</option>
                                        <option value="ui-ux-design">تصميم UI/UX</option>
                                        <option value="data-science">علوم البيانات</option>
                                        <option value="cybersecurity">الأمن السيبراني</option>
                                        <option value="cloud-computing">الحوسبة السحابية</option>
                                        <option value="digital-marketing">التسويق الرقمي</option>
                                        <option value="game-development">تطوير الألعاب</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="experience" class="form-label">سنوات الخبرة</label>
                                    <select class="form-select"  name="years_of_experience">
                                        <option value="">اختر سنوات الخبرة</option>
                                        <option value="junior">1-3 سنوات</option>
                                        <option value="mid">3-7 سنوات</option>
                                        <option value="senior">أكثر من 7 سنوات</option>
                                    </select>
                                </div>
                           </div>
 <!-- Beginner Fields -->
 <div id="beginnerFields" >
                  <div class="row">
                   <div class="col-md-6 mb-3">
            <label for="firstName" class="form-label">الاسم الأول</label>
            <input type="text" class="form-control" name="first_name"
                   value="{{ old('first_name') }}" required autofocus autocomplete="first_name">
          </div>
   <!-- Email Address -->
        <div class="col-md-6 mb-3">
            <label for="lastName" class="form-label">الاسم الأخير</label>
            <input type="text" class="form-control"  name="last_name"
                   value="{{ old('last_name') }}" required autocomplete="last_name">
           </div>
 </div>

                                <div class="mb-3">
                                    <label for="interestedField" class="form-label">المجال المهتم به</label>
                                    <select class="form-select"  name="field_of_interest">
                                        <option value="">اختر المجال الذي تريد تعلمه</option>
                                        <option value="web-development">تطوير الويب</option>
                                        <option value="mobile-development">تطوير التطبيقات</option>
                                        <option value="ui-ux-design">تصميم UI/UX</option>
                                        <option value="data-science">علوم البيانات</option>
                                        <option value="cybersecurity">الأمن السيبراني</option>
                                        <option value="cloud-computing">الحوسبة السحابية</option>
                                        <option value="digital-marketing">التسويق الرقمي</option>
                                        <option value="game-development">تطوير الألعاب</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="currentLevel" class="form-label">مستواك الحالي</label>
                                    <select class="form-select"  name="Current_level">
                                        <option value="">اختر مستواك الحالي</option>
                                        <option value="complete-beginner">مبتدئ تماماً</option>
                                        <option value="some-knowledge">لدي معرفة بسيطة</option>
                                        <option value="self-taught">أتعلم ذاتياً</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="learningGoals" class="form-label">أهدافك في التعلم</label>
                                    <textarea class="form-control"  rows="3" name="learning_goals" placeholder="ما الذي تريد تحقيقه من تعلم التقنية؟"></textarea>
                                </div>
                            </div>
  <div id="studentFields" >
            <div class="row">
                   <div class="col-md-6 mb-3">
            <label for="firstName" class="form-label">الاسم الأول</label>
            <input type="text" class="form-control" id="firstName" name="first_name"
                   value="{{ old('first_name') }}" required autofocus autocomplete="first_name">
          </div>
   <!-- Email Address -->
        <div class="col-md-6 mb-3">
            <label for="lastName" class="form-label">الاسم الأخير</label>
            <input type="text" class="form-control" id="lastName" name="last_name"
                   value="{{ old('last_name') }}" required autocomplete="last_name">
           </div>
 </div>



                                <div class="mb-3">
                                    <label for="university" class="form-label">الجامعة</label>
                                    <input type="text" class="form-control" id="university" name="University" placeholder="اسم الجامعة أو المعهد">
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="major" class="form-label">التخصص الجامعي</label>
                                        <input type="text" class="form-control" id="major" name="University_Major"  placeholder="مثال: هندسة المعلوماتية">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="studyYear" class="form-label">السنة الدراسية</label>
                                        <select class="form-select" id="studyYear" name="Acabemic_Year">
                                            <option value="">اختر السنة الدراسية</option>
                                            <option value="1">السنة الأولى</option>
                                            <option value="2">السنة الثانية</option>
                                            <option value="3">السنة الثالثة</option>
                                            <option value="4">السنة الرابعة</option>
                                            <option value="5">السنة الخامسة</option>
                                            <option value="graduate">دراسات عليا</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="techInterests" class="form-label">اهتماماتك التقنية</label>
                                    <div class="row">
                                        <div class="col-md-6" >
                                            <div class="form-check" >
                                                <input class="form-check-input" type="checkbox" value="web-development" id="interestWeb" name="technica_interests">
                                                <label class="form-check-label" for="interestWeb" >تطوير الويب</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="mobile-development" id="interestMobile" name="technica_interests">
                                                <label class="form-check-label" for="interestMobile">تطوير التطبيقات</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="ui-ux-design" id="interestDesign" name="technica_interests">
                                                <label class="form-check-label" for="interestDesign">تصميم UI/UX</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="data-science" id="interestData" name="technica_interests">
                                                <label class="form-check-label" for="interestData">علوم البيانات</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="cybersecurity" id="interestSecurity" name="technica_interests">
                                                <label class="form-check-label" for="interestSecurity">الأمن السيبراني</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="cloud-computing" id="interestCloud" name="technica_interests">
                                                <label class="form-check-label" for="interestCloud">الحوسبة السحابية</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="digital-marketing" id="interestMarketing" name="technica_interests">
                                                <label class="form-check-label" for="interestMarketing">التسويق الرقمي</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="game-development" id="interestGames" name="technica_interests">
                                                <label class="form-check-label" for="interestGames">تطوير الألعاب</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="companyFields" >
                                <div class="mb-3">
                                    <label for="Company_Name" class="form-label">اسم الشركة</label>
                                    <input type="text" class="form-control" id="companyName" name="Company_Name">
                                </div>

                                <div class="mb-3">
                                    <label for="industry" class="form-label">قطاع العمل</label>
                                    <select class="form-select" id="industry" name="Business_sector">
                                        <option value="">اختر قطاع العمل</option>
                                        <option value="software-development">تطوير البرمجيات</option>
                                        <option value="web-design">تصميم المواقع</option>
                                        <option value="mobile-apps">تطبيقات الجوال</option>
                                        <option value="digital-marketing">التسويق الرقمي</option>
                                        <option value="it-consulting">استشارات تقنية</option>
                                        <option value="cybersecurity">الأمن السيبراني</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="companySize" class="form-label" >حجم الشركة</label>
                                    <select class="form-select" id="companySize" name="Company_Size">
                                        <option value="">اختر حجم الشركة</option>
                                        <option value="startup">ناشئة (1-10 موظفين)</option>
                                        <option value="small">صغيرة (11-50 موظف)</option>
                                        <option value="medium">متوسطة (51-200 موظف)</option>
                                        <option value="large">كبيرة (أكثر من 200 موظف)</option>
                                    </select>
                                </div>
                            </div>



   <!-- Common Fields -->
                                 <div class="mb-3">
            <x-input-label for="email" class="form-label" :value="__('Email')" />
            <x-text-input type="email" class="form-control" id="email"  name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                    <div class="mb-3">
    <label for="phone" class="form-label">رقم الهاتف</label>
    <input type="tel" class="form-control" id="phone" name="Phone_Number"
           placeholder="+963 xxx xxx xxx"
           value="{{ old('Phone_Number') }}"
           required autocomplete="Phone_Number">

                            </div>

                            <div class="mb-3">
                                <label for="location" class="form-label">المحافظة</label>
                                <select class="form-select" id="location" name="Governorate" required>
                                    <option value="">اختر المحافظة</option>
                                    <option value="damascus">دمشق</option>
                                    <option value="aleppo">حلب</option>
                                    <option value="homs">حمص</option>
                                    <option value="lattakia">اللاذقية</option>
                                    <option value="tartous">طرطوس</option>
                                    <option value="deraa">درعا</option>
                                    <option value="sweida">السويداء</option>
                                    <option value="quneitra">القنيطرة</option>
                                    <option value="idleb">إدلب</option>
                                    <option value="hama">حماة</option>
                                    <option value="raqqa">الرقة</option>
                                    <option value="deir-ez-zor">دير الزور</option>
                                    <option value="hasakah">الحسكة</option>
                                    <option value="damascus-countryside">ريف دمشق</option>
                                </select>
                            </div>


 <div class="mb-3">
            <x-input-label for="password" class="form-label" :value="__('Password')" />

            <x-text-input type="password" class="form-control" id="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="confirmPassword" class="form-label" :value="__('Confirm Password')" />

            <x-text-input type="password" class="form-control" id="confirmPassword"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>


                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                                <label class="form-check-label" for="agreeTerms">
                                    أوافق على <a href="#" style="color: var(--primary-color);">شروط الاستخدام</a> و
                                    <a href="#" style="color: var(--primary-color);">سياسة الخصوصية</a>
                                </label>
                            </div>

                         <button type="submit" class="btn btn-primary w-100 mb-3">
                                <i class="fas fa-user-check me-2"></i>

                Register

                            </button>
                             </form>
                              <div class="text-center">
                                <p class="mb-0">لديك حساب بالفعل؟
                                    <a href="{{route('login')}}" class="text-decoration-none" style="color: var(--primary-color);">
                                        تسجيل الدخول
                                    </a>
                                </p>
                    </div>
                </div>
            </div>
        </div>
          </div>
    </section>




  <!-- Custom JavaScript -->
    <script>
        // // Toggle between different account type fields
        // document.querySelectorAll('input[name="type"]').forEach(radio => {
        //     radio.addEventListener('change', function() {
        //         const expertFields = document.getElementById('expertFields');
        //         const beginnerFields = document.getElementById('beginnerFields');
        //         const studentFields = document.getElementById('studentFields');
        //         const companyFields = document.getElementById('companyFields');

        //         // Hide all fields first
        //         expertFields.style.display = 'none';
        //         beginnerFields.style.display = 'none';
        //         studentFields.style.display = 'none';
        //         companyFields.style.display = 'none';

        //         // Show relevant fields based on selection
        //         switch(this.value) {
        //             case 'expert':
        //                 expertFields.style.display = 'block';
        //                 break;
        //             case 'beginner':
        //                 beginnerFields.style.display = 'block';
        //                 break;
        //             case 'student':
        //                 studentFields.style.display = 'block';
        //                 break;
        //             case 'company':
        //                 companyFields.style.display = 'block';
        //                 break;
        //         }
        //     });
        // });


    document.addEventListener('DOMContentLoaded', function () {
        const typeRadios = document.querySelectorAll('input[name="type"]');
        const sections = {
            expert: document.getElementById('expertFields'),
            beginner: document.getElementById('beginnerFields'),
            student: document.getElementById('studentFields'),
            company: document.getElementById('companyFields')
        };

        function toggleFields(selectedType) {
            Object.entries(sections).forEach(([type, section]) => {
                if (section) {
                    const show = type === selectedType;
                    section.style.display = show ? 'block' : 'none';

                    const inputs = section.querySelectorAll('input, select, textarea');
                    inputs.forEach(input => {
                        input.disabled = !show;
                        if (input.hasAttribute('data-required')) {
                            if (show) {
                                input.setAttribute('required', 'required');
                            } else {
                                input.removeAttribute('required');
                            }
                        }
                    });
                }
            });
        }

        // تحديد الحقول المطلوبة بشكل ديناميكي فقط
        Object.values(sections).forEach(section => {
            if (section) {
                const inputs = section.querySelectorAll('input[required], select[required], textarea[required]');
                inputs.forEach(input => {
                    input.setAttribute('data-required', 'true');
                    input.removeAttribute('required');
                });
            }
        });

        // عند تحميل الصفحة
        const selected = document.querySelector('input[name="type"]:checked');
        if (selected) toggleFields(selected.value);

        // عند تغيير نوع الحساب
        typeRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                toggleFields(radio.value);
            });
        });
    });
</script>


</body>
</html>

