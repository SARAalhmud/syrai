// صفحة فرص العمل - JavaScript

// بيانات الوظائف
const jobsData = [
    {
        id: 1,
        title: "مطور React متقدم",
        company: "تك سوريا",
        location: "damascus",
        type: "full-time",
        category: "development",
        experienceLevel: "senior",
        salary: "2000-3000",
        description: "نبحث عن مطور React متمكن للانضمام إلى فريقنا التقني. ستعمل على تطوير تطبيقات ويب حديثة باستخدام أحدث التقنيات.",
        requirements: [
            "خبرة 5+ سنوات في React",
            "معرفة قوية بـ JavaScript و TypeScript",
            "خبرة في Redux و Context API",
            "معرفة بـ Node.js",
            "قدرة على العمل ضمن فريق"
        ],
        postedDate: "2024-01-15",
        contactEmail: "jobs@techsyria.com",
        isUrgent: true,
        tags: ["React", "JavaScript", "TypeScript", "Redux"]
    },
    {
        id: 2,
        title: "مصمم UI/UX",
        company: "ديجيتال دمشق",
        location: "damascus",
        type: "full-time",
        category: "design",
        experienceLevel: "mid",
        salary: "1000-2000",
        description: "مطلوب مصمم UI/UX مبدع لتصميم واجهات تطبيقاتنا ومواقعنا الإلكترونية.",
        requirements: [
            "خبرة 3+ سنوات في التصميم",
            "إتقان Figma و Adobe XD",
            "معرفة بمبادئ UX",
            "portfolio قوي",
            "إبداع وحس فني عالي"
        ],
        postedDate: "2024-01-14",
        contactEmail: "design@digitaldamascus.com",
        isUrgent: false,
        tags: ["Figma", "UI/UX", "Design", "Adobe XD"]
    },
    {
        id: 3,
        title: "مطور تطبيقات Flutter",
        company: "حلب للبرمجيات",
        location: "aleppo",
        type: "full-time",
        category: "development",
        experienceLevel: "mid",
        salary: "1500-2500",
        description: "انضم إلى فريقنا لتطوير تطبيقات الهواتف الذكية باستخدام Flutter.",
        requirements: [
            "خبرة 2+ سنوات في Flutter",
            "معرفة قوية بـ Dart",
            "خبرة في Firebase",
            "معرفة بـ REST APIs",
            "تطبيقات منشورة على المتاجر"
        ],
        postedDate: "2024-01-13",
        contactEmail: "mobile@alepposoftware.com",
        isUrgent: false,
        tags: ["Flutter", "Dart", "Firebase", "Mobile"]
    },
    {
        id: 4,
        title: "متخصص أمن سيبراني",
        company: "الشام الآمنة",
        location: "damascus",
        type: "full-time",
        category: "security",
        experienceLevel: "senior",
        salary: "2500-3500",
        description: "مطلوب خبير أمن سيبراني لحماية أنظمتنا وعملائنا من التهديدات الرقمية.",
        requirements: [
            "خبرة 5+ سنوات في الأمن السيبراني",
            "شهادات أمنية (CISSP, CEH)",
            "خبرة في Penetration Testing",
            "معرفة بأدوات الأمان",
            "القدرة على التعامل مع الحوادث الأمنية"
        ],
        postedDate: "2024-01-12",
        contactEmail: "security@shamsecure.com",
        isUrgent: true,
        tags: ["Security", "CISSP", "Penetration Testing", "Cybersecurity"]
    },
    {
        id: 5,
        title: "مطور Backend - Node.js",
        company: "سمارت سولوشنز",
        location: "damascus",
        type: "full-time",
        category: "development",
        experienceLevel: "mid",
        salary: "1500-2000",
        description: "نبحث عن مطور Backend متمكن في Node.js لتطوير APIs وخدمات الويب.",
        requirements: [
            "خبرة 3+ سنوات في Node.js",
            "معرفة قوية بـ Express.js",
            "خبرة في قواعد البيانات MongoDB/PostgreSQL",
            "معرفة بـ Docker",
            "خبرة في Git"
        ],
        postedDate: "2024-01-11",
        contactEmail: "backend@smartsolutions.sy",
        isUrgent: false,
        tags: ["Node.js", "Express", "MongoDB", "Docker"]
    },
    {
        id: 6,
        title: "متدرب تطوير ويب",
        company: "كريتيف ديزاين",
        location: "aleppo",
        type: "internship",
        category: "development",
        experienceLevel: "entry",
        salary: "300-500",
        description: "برنامج تدريبي لطلاب الجامعات المهتمين بتطوير الويب.",
        requirements: [
            "طالب في السنة الثالثة أو الرابعة",
            "معرفة أساسية بـ HTML, CSS, JavaScript",
            "شغف بالتعلم",
            "قدرة على التفرغ 6 ساعات يومياً",
            "التزام لمدة 3 أشهر"
        ],
        postedDate: "2024-01-10",
        contactEmail: "internship@creativedesign.sy",
        isUrgent: false,
        tags: ["Internship", "HTML", "CSS", "JavaScript"]
    },
    {
        id: 7,
        title: "مطور WordPress",
        company: "ويب ماستر",
        location: "homs",
        type: "freelance",
        category: "development",
        experienceLevel: "mid",
        salary: "per-project",
        description: "مطلوب مطور WordPress للعمل على عدة مشاريع مواقع إلكترونية.",
        requirements: [
            "خبرة قوية في WordPress",
            "معرفة بـ PHP و MySQL",
            "خبرة في تطوير القوالب المخصصة",
            "معرفة بـ WooCommerce",
            "القدرة على العمل عن بُعد"
        ],
        postedDate: "2024-01-09",
        contactEmail: "freelance@webmaster.sy",
        isUrgent: false,
        tags: ["WordPress", "PHP", "WooCommerce", "Freelance"]
    },
    {
        id: 8,
        title: "متخصص تسويق رقمي",
        company: "موبايل تك",
        location: "remote",
        type: "remote",
        category: "marketing",
        experienceLevel: "mid",
        salary: "1000-1500",
        description: "نبحث عن متخصص تسويق رقمي للعمل عن بُعد على حملاتنا التسويقية.",
        requirements: [
            "خبرة 2+ سنوات في التسويق الرقمي",
            "معرفة بـ Google Ads و Facebook Ads",
            "خبرة في تحليل البيانات",
            "مهارات كتابة محتوى",
            "معرفة بـ SEO"
        ],
        postedDate: "2024-01-08",
        contactEmail: "marketing@mobiletech.sy",
        isUrgent: false,
        tags: ["Digital Marketing", "Google Ads", "SEO", "Remote"]
    }
];

let currentJobsFilter = {
    search: '',
    type: '',
    location: '',
    category: [],
    experienceLevel: [],
    salary: ''
};

let filteredJobs = [...jobsData];
let currentPage = 1;
const itemsPerPage = 6;

// تهيئة الصفحة
document.addEventListener('DOMContentLoaded', function() {
    initializeJobsPage();
});

function initializeJobsPage() {
    displayJobs();
    initializeFilters();
    initializeSearch();
    initializePostJobForm();
    updateJobStats();
}

// عرض الوظائف
function displayJobs(page = 1) {
    const container = document.getElementById('jobsContainer');
    const resultsCount = document.getElementById('jobResultsCount');

    if (!container) return;

    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const pageJobs = filteredJobs.slice(startIndex, endIndex);

    if (pageJobs.length === 0) {
        container.innerHTML = `
            <div class="text-center py-5">
                <i class="fas fa-briefcase" style="font-size: 3rem; color: var(--border-color);"></i>
                <h4 class="mt-3 text-muted">لا توجد وظائف متاحة</h4>
                <p class="text-muted">جرب تغيير معايير البحث أو الفلترة</p>
                <button class="btn btn-primary" onclick="clearAllJobFilters()">
                    <i class="fas fa-undo me-2"></i>
                    مسح جميع الفلاتر
                </button>
            </div>
        `;
    } else {
        container.innerHTML = pageJobs.map((job, index) => `
            <div class="job-card mb-4 fade-in-up" style="animation-delay: ${index * 0.1}s">
                <div class="bg-white rounded p-4 shadow-sm border-right-accent">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center mb-2">
                                <h5 class="job-title mb-0 me-3">${job.title}</h5>
                                ${job.isUrgent ? '<span class="badge bg-danger">عاجل</span>' : ''}
                            </div>
                            <p class="company-name text-primary mb-1">
                                <i class="fas fa-building me-1"></i>
                                ${job.company}
                            </p>
                            <div class="job-meta d-flex flex-wrap gap-3 text-muted">
                                <span><i class="fas fa-map-marker-alt me-1"></i>${getLocationName(job.location)}</span>
                                <span><i class="fas fa-clock me-1"></i>${getJobTypeName(job.type)}</span>
                                <span><i class="fas fa-user-tie me-1"></i>${getExperienceName(job.experienceLevel)}</span>
                                ${job.salary !== 'per-project' ? `<span><i class="fas fa-money-bill me-1"></i>${job.salary} ألف ل.س</span>` : '<span><i class="fas fa-project-diagram me-1"></i>حسب المشروع</span>'}
                            </div>
                        </div>
                        <div class="text-muted">
                            <small>${formatDate(job.postedDate)}</small>
                        </div>
                    </div>

                    <p class="job-description mb-3">${job.description}</p>

                    <div class="job-tags mb-3">
                        ${job.tags.map(tag => `<span class="badge bg-light text-dark me-1">${tag}</span>`).join('')}
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="job-actions">
                            <button class="btn btn-primary me-2" onclick="viewJob(${job.id})">
                                <i class="fas fa-eye me-1"></i>
                                عرض التفاصيل
                            </button>
                            <button class="btn btn-outline-success" onclick="applyJob(${job.id})">
                                <i class="fas fa-paper-plane me-1"></i>
                                تقدم للوظيفة
                            </button>
                        </div>
                        <button class="btn btn-outline-secondary btn-sm" onclick="saveJob(${job.id})">
                            <i class="fas fa-bookmark"></i>
                        </button>
                    </div>
                </div>
            </div>
        `).join('');
    }

    // تحديث عدد النتائج
    if (resultsCount) {
        resultsCount.textContent = filteredJobs.length;
    }

    // تحديث الترقيم
    updateJobsPagination();
}

// تهيئة الفلاتر
function initializeFilters() {
    // فلاتر مستوى الخبرة
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', applyFilters);
    });

    // فلاتر القوائم المنسدلة
    document.getElementById('salaryFilter').addEventListener('change', applyFilters);
    document.getElementById('jobTypeFilter').addEventListener('change', applyFilters);
    document.getElementById('locationFilter').addEventListener('change', applyFilters);

    // مسح الفلاتر
    document.getElementById('clearJobFilters').addEventListener('click', clearAllJobFilters);
}

// تهيئة البحث
function initializeSearch() {
    const searchInput = document.getElementById('jobSearch');
    const searchBtn = document.getElementById('searchJobBtn');

    searchBtn.addEventListener('click', performSearch);
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });
}

// تطبيق الفلاتر
function applyFilters() {
    // جمع الفلاتر المحددة
    const experienceLevels = getCheckedValues('input[name*="experience"]:checked');
    const categories = getCheckedValues('input[name*="category"]:checked');
    const salary = document.getElementById('salaryFilter').value;
    const type = document.getElementById('jobTypeFilter').value;
    const location = document.getElementById('locationFilter').value;

    // تطبيق الفلاتر
    filteredJobs = jobsData.filter(job => {
        const matchesExperience = experienceLevels.length === 0 || experienceLevels.includes(job.experienceLevel);
        const matchesCategory = categories.length === 0 || categories.includes(job.category);
        const matchesSalary = !salary || matchesSalaryRange(job.salary, salary);
        const matchesType = !type || job.type === type;
        const matchesLocation = !location || job.location === location;
        const matchesSearch = !currentJobsFilter.search ||
            job.title.toLowerCase().includes(currentJobsFilter.search.toLowerCase()) ||
            job.company.toLowerCase().includes(currentJobsFilter.search.toLowerCase()) ||
            job.description.toLowerCase().includes(currentJobsFilter.search.toLowerCase());

        return matchesExperience && matchesCategory && matchesSalary &&
               matchesType && matchesLocation && matchesSearch;
    });

    currentPage = 1;
    displayJobs();
}

// تنفيذ البحث
function performSearch() {
    const searchQuery = document.getElementById('jobSearch').value;
    currentJobsFilter.search = searchQuery;
    applyFilters();
}

// مسح جميع الفلاتر
function clearAllJobFilters() {
    // مسح الحقول
    document.getElementById('jobSearch').value = '';
    document.getElementById('jobTypeFilter').value = '';
    document.getElementById('locationFilter').value = '';
    document.getElementById('salaryFilter').value = '';

    // مسح صناديق الاختيار
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.checked = false;
    });

    // إعادة تعيين البيانات
    currentJobsFilter = {
        search: '',
        type: '',
        location: '',
        category: [],
        experienceLevel: [],
        salary: ''
    };

    filteredJobs = [...jobsData];
    currentPage = 1;
    displayJobs();
}

// عرض تفاصيل الوظيفة
function viewJob(jobId) {
    const job = jobsData.find(j => j.id === jobId);
    if (!job) return;

    const modalContent = `
        <div class="modal fade" id="jobDetailsModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">${job.title}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="job-header mb-4">
                            <h6 class="text-primary mb-2">
                                <i class="fas fa-building me-2"></i>
                                ${job.company}
                            </h6>
                            <div class="job-meta d-flex flex-wrap gap-3 text-muted mb-3">
                                <span><i class="fas fa-map-marker-alt me-1"></i>${getLocationName(job.location)}</span>
                                <span><i class="fas fa-clock me-1"></i>${getJobTypeName(job.type)}</span>
                                <span><i class="fas fa-user-tie me-1"></i>${getExperienceName(job.experienceLevel)}</span>
                                ${job.salary !== 'per-project' ? `<span><i class="fas fa-money-bill me-1"></i>${job.salary} ألف ل.س</span>` : '<span><i class="fas fa-project-diagram me-1"></i>حسب المشروع</span>'}
                            </div>
                            ${job.isUrgent ? '<span class="badge bg-danger mb-3">وظيفة عاجلة</span>' : ''}
                        </div>

                        <div class="job-description mb-4">
                            <h6>وصف الوظيفة</h6>
                            <p>${job.description}</p>
                        </div>

                        <div class="job-requirements mb-4">
                            <h6>المتطلبات</h6>
                            <ul>
                                ${job.requirements.map(req => `<li>${req}</li>`).join('')}
                            </ul>
                        </div>

                        <div class="job-tags mb-4">
                            <h6>المهارات المطلوبة</h6>
                            ${job.tags.map(tag => `<span class="badge bg-light text-dark me-1 mb-1">${tag}</span>`).join('')}
                        </div>

                        <div class="job-contact">
                            <h6>معلومات التواصل</h6>
                            <p><i class="fas fa-envelope me-2"></i>${job.contactEmail}</p>
                            <p><i class="fas fa-calendar me-2"></i>تاريخ النشر: ${formatDate(job.postedDate)}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                        <button type="button" class="btn btn-success" onclick="applyJob(${job.id})">
                            <i class="fas fa-paper-plane me-2"></i>
                            تقدم للوظيفة
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;

    // إزالة النافذة السابقة إن وجدت
    const existingModal = document.getElementById('jobDetailsModal');
    if (existingModal) {
        existingModal.remove();
    }

    // إضافة النافذة الجديدة
    document.body.insertAdjacentHTML('beforeend', modalContent);

    // إظهار النافذة
    const modal = new bootstrap.Modal(document.getElementById('jobDetailsModal'));
    modal.show();
}

// التقدم للوظيفة
function applyJob(jobId) {
    const job = jobsData.find(j => j.id === jobId);
    if (!job) return;

    // إنشاء رابط البريد الإلكتروني
    const subject = encodeURIComponent(`التقدم لوظيفة: ${job.title}`);
    const body = encodeURIComponent(`السلام عليكم ورحمة الله وبركاته،

أود التقدم لوظيفة "${job.title}" في شركة ${job.company}.

يرجى العثور على سيرتي الذاتية مرفقة.

مع أطيب التحيات`);

    window.location.href = `mailto:${job.contactEmail}?subject=${subject}&body=${body}`;
}

// حفظ الوظيفة
function saveJob(jobId) {
    // في التطبيق الحقيقي، ستحفظ في قاعدة البيانات
    let savedJobs = JSON.parse(localStorage.getItem('savedJobs') || '[]');

    if (!savedJobs.includes(jobId)) {
        savedJobs.push(jobId);
        localStorage.setItem('savedJobs', JSON.stringify(savedJobs));
        showNotification('تم حفظ الوظيفة بنجاح!', 'success');
    } else {
        showNotification('تم حفظ هذه الوظيفة مسبقاً', 'info');
    }
}

// فحص حالة تسجيل الدخول
function checkLoginStatus() {
    // في التطبيق الحقيقي، ستفحص مع الخادم
    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
    const userType = localStorage.getItem('userType'); // 'expert', 'company', 'student'

    return {
        isLoggedIn: isLoggedIn,
        userType: userType,
        canPostJob: isLoggedIn && (userType === 'expert' || userType === 'company')
    };
}

// تهيئة نموذج نشر الوظائف
function initializePostJobForm() {
    const form = document.getElementById('postJobForm');
    if (!form) return;

    // فحص زر نشر الوظيفة
    const postJobBtn = document.querySelector('[data-bs-target="#postJobModal"]');
    if (postJobBtn) {
        postJobBtn.addEventListener('click', function(e) {
            const loginStatus = checkLoginStatus();

            if (!loginStatus.isLoggedIn) {
                e.preventDefault();
                showLoginRequiredModal();
                return;
            }

            if (!loginStatus.canPostJob) {
                e.preventDefault();
                showAccessDeniedModal();
                return;
            }
        });
    }


}

// دوال مساعدة
function getLocationName(location) {
    const locations = {
        'damascus': 'دمشق',
        'aleppo': 'حلب',
        'homs': 'حمص',
        'lattakia': 'اللاذقية',
        'remote': 'عن بُعد'
    };
    return locations[location] || location;
}

function getJobTypeName(type) {
    const types = {
        'full-time': 'دوام كامل',
        'part-time': 'دوام جزئي',
        'freelance': 'عمل حر',
        'remote': 'عن بُعد',
        'internship': 'تدريب'
    };
    return types[type] || type;
}

function getExperienceName(level) {
    const levels = {
        'entry': 'مبتدئ',
        'mid': 'متوسط',
        'senior': 'خبير'
    };
    return levels[level] || level;
}

function formatDate(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffTime = Math.abs(now - date);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    if (diffDays === 1) return 'منذ يوم واحد';
    if (diffDays < 7) return `منذ ${diffDays} أيام`;
    if (diffDays < 30) return `منذ ${Math.ceil(diffDays / 7)} أسابيع`;
    return `منذ ${Math.ceil(diffDays / 30)} أشهر`;
}

function matchesSalaryRange(jobSalary, filterSalary) {
    if (jobSalary === 'per-project') return filterSalary === 'per-project';

    const ranges = {
        'under-500': [0, 500],
        '500-1000': [500, 1000],
        '1000-2000': [1000, 2000],
        '2000-3000': [2000, 3000],
        'over-3000': [3000, Infinity]
    };

    const range = ranges[filterSalary];
    if (!range) return true;

    const salaryNumbers = jobSalary.split('-').map(s => parseInt(s));
    const jobMin = salaryNumbers[0];
    const jobMax = salaryNumbers[1] || jobMin;

    return (jobMin >= range[0] && jobMin <= range[1]) ||
           (jobMax >= range[0] && jobMax <= range[1]);
}

function getCheckedValues(selector) {
    return Array.from(document.querySelectorAll(selector)).map(el => el.value);
}

function extractTagsFromDescription(text) {
    const commonTags = ['React', 'JavaScript', 'Python', 'PHP', 'Java', 'Node.js', 'Angular', 'Vue', 'Flutter', 'Dart', 'TypeScript', 'MongoDB', 'PostgreSQL', 'MySQL', 'Docker', 'AWS', 'Git', 'Figma', 'Adobe XD', 'Photoshop'];
    return commonTags.filter(tag => text.toLowerCase().includes(tag.toLowerCase()));
}

function updateJobsPagination() {
    const pagination = document.getElementById('jobsPagination');
    if (!pagination) return;

    const totalPages = Math.ceil(filteredJobs.length / itemsPerPage);

    if (totalPages <= 1) {
        pagination.innerHTML = '';
        return;
    }

    let paginationHTML = '';

    // Previous button
    if (currentPage > 1) {
        paginationHTML += `<li class="page-item"><a class="page-link" href="#" onclick="goToJobPage(${currentPage - 1})">السابق</a></li>`;
    }

    // Page numbers
    for (let i = 1; i <= totalPages; i++) {
        if (i === currentPage) {
            paginationHTML += `<li class="page-item active"><span class="page-link">${i}</span></li>`;
        } else {
            paginationHTML += `<li class="page-item"><a class="page-link" href="#" onclick="goToJobPage(${i})">${i}</a></li>`;
        }
    }

    // Next button
    if (currentPage < totalPages) {
        paginationHTML += `<li class="page-item"><a class="page-link" href="#" onclick="goToJobPage(${currentPage + 1})">التالي</a></li>`;
    }

    pagination.innerHTML = paginationHTML;
}

function goToJobPage(page) {
    currentPage = page;
    displayJobs(page);
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function updateJobStats() {
    const activeJobsCount = document.getElementById('activeJobsCount');
    if (activeJobsCount) {
        activeJobsCount.textContent = jobsData.length;
    }
}

// عرض نافذة طلب تسجيل الدخول


// عرض نافذة رفض الصلاحية
function showAccessDeniedModal() {
    const modalContent = `
        <div class="modal fade" id="accessDeniedModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">غير مسموح</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="fas fa-ban text-warning mb-3" style="font-size: 3rem;"></i>
                        <h6>لا يمكنك نشر الوظائف</h6>
                        <p class="text-muted">نشر الوظائف متاح فقط للخبراء والشركات المسجلة في المنصة</p>
                        <p class="text-muted">إذا كنت تريد نشر الوظائف، يرجى إنشاء حساب كخبير أو شركة</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <a href="register.html" class="btn btn-success">
                            <i class="fas fa-user-plus me-2"></i>
                            إنشاء حساب جديد
                        </a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            إغلاق
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;

    // إزالة النافذة السابقة إن وجدت
    const existingModal = document.getElementById('accessDeniedModal');
    if (existingModal) {
        existingModal.remove();
    }

    // إضافة النافذة الجديدة
    document.body.insertAdjacentHTML('beforeend', modalContent);

    // إظهار النافذة
    const modal = new bootstrap.Modal(document.getElementById('accessDeniedModal'));
    modal.show();
}

function showNotification(message, type = 'info') {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-info';
    const alert = document.createElement('div');
    alert.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
    alert.style.cssText = 'top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; min-width: 300px;';
    alert.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    document.body.appendChild(alert);

    setTimeout(() => {
        if (alert.parentNode) {
            alert.remove();
        }
    }, 3000);
}
