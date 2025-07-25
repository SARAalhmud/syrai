// نادي التقنيين السوري - JavaScript الرئيسي

// إعدادات التطبيق
const CONFIG = {
    itemsPerPage: 9,
    animationDelay: 100,
    apiEndpoints: {
        members: 'data/members.json',
        companies: 'data/companies.json'
    }
};

// متغيرات عامة
let allMembers = [];
let allCompanies = [];
let currentPage = 1;
let filteredData = [];

// التهيئة عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

// تهيئة التطبيق
async function initializeApp() {
    try {
        // تحميل البيانات
        await loadData();
        
        // تهيئة الصفحة الحالية
        const currentPage = getCurrentPage();
        
        switch(currentPage) {
            case 'index':
                initializeHomePage();
                break;
            case 'profiles':
                initializeProfilesPage();
                break;
            case 'directory':
                initializeDirectoryPage();
                break;
        }
        
        // تهيئة الأحداث العامة
        initializeGlobalEvents();
        
    } catch (error) {
        console.error('خطأ في تهيئة التطبيق:', error);
        showErrorMessage('عذراً، حدث خطأ في تحميل البيانات');
    }
}

// تحديد الصفحة الحالية
function getCurrentPage() {
    const path = window.location.pathname;
    if (path.includes('profiles.html')) return 'profiles';
    if (path.includes('directory.html')) return 'directory';
    return 'index';
}

// تحميل البيانات
async function loadData() {
    try {
        // تحميل بيانات الأعضاء
        const membersResponse = await fetch(CONFIG.apiEndpoints.members);
        if (membersResponse.ok) {
            allMembers = await membersResponse.json();
        }
        
        // تحميل بيانات الشركات
        const companiesResponse = await fetch(CONFIG.apiEndpoints.companies);
        if (companiesResponse.ok) {
            allCompanies = await companiesResponse.json();
        }
        
        console.log('تم تحميل البيانات بنجاح');
    } catch (error) {
        console.warn('لم يتم العثور على ملفات البيانات، سيتم استخدام البيانات الافتراضية');
        loadDefaultData();
    }
}

// تحميل البيانات الافتراضية
function loadDefaultData() {
    // بيانات افتراضية للأعضاء
    allMembers = [
        {
            id: 1,
            name: "أحمد محمد",
            title: "مطور ويب متقدم",
            specialty: "web-development",
            location: "دمشق",
            experience: "senior",
            skills: ["JavaScript", "React", "Node.js", "MongoDB"],
            rating: 4.8,
            projects: 45,
            avatar: "أ م"
        },
        {
            id: 2,
            name: "فاطمة أحمد",
            title: "مصممة UI/UX",
            specialty: "ui-ux-design",
            location: "حلب",
            experience: "mid",
            skills: ["Figma", "Adobe XD", "Sketch", "Photoshop"],
            rating: 4.9,
            projects: 32,
            avatar: "ف أ"
        },
        {
            id: 3,
            name: "محمد علي",
            title: "مطور تطبيقات الجوال",
            specialty: "mobile-development",
            location: "دمشق",
            experience: "senior",
            skills: ["Flutter", "React Native", "Kotlin", "Swift"],
            rating: 4.7,
            projects: 28,
            avatar: "م ع"
        },
        {
            id: 4,
            name: "نور الدين",
            title: "خبير أمن سيبراني",
            specialty: "cybersecurity",
            location: "حمص",
            experience: "senior",
            skills: ["Ethical Hacking", "Penetration Testing", "CISSP"],
            rating: 4.9,
            projects: 22,
            avatar: "ن د"
        },
        {
            id: 5,
            name: "ريم خالد",
            title: "عالمة بيانات",
            specialty: "data-science",
            location: "اللاذقية",
            experience: "mid",
            skills: ["Python", "TensorFlow", "SQL", "Tableau"],
            rating: 4.6,
            projects: 18,
            avatar: "ر خ"
        },
        {
            id: 6,
            name: "عبد الرحمن سعيد",
            title: "مهندس حوسبة سحابية",
            specialty: "cloud-computing",
            location: "دمشق",
            experience: "senior",
            skills: ["AWS", "Azure", "Docker", "Kubernetes"],
            rating: 4.8,
            projects: 35,
            avatar: "ع س"
        }
    ];
    
    // بيانات افتراضية للشركات
    allCompanies = [
        {
            id: 1,
            name: "تك سوريا",
            industry: "software-development",
            location: "دمشق",
            size: "medium",
            services: ["web-development", "mobile-development"],
            rating: 4.7,
            employees: 85,
            projects: 120,
            logo: "ت س"
        },
        {
            id: 2,
            name: "ديجيتال دمشق",
            industry: "digital-marketing",
            location: "دمشق",
            size: "small",
            services: ["digital-marketing", "ui-ux-design"],
            rating: 4.5,
            employees: 25,
            projects: 60,
            logo: "د د"
        },
        {
            id: 3,
            name: "حلب للبرمجيات",
            industry: "software-development",
            location: "حلب",
            size: "large",
            services: ["web-development", "mobile-development", "ui-ux-design"],
            rating: 4.8,
            employees: 150,
            projects: 200,
            logo: "ح ب"
        },
        {
            id: 4,
            name: "الشام الآمنة",
            industry: "cybersecurity",
            location: "دمشق",
            size: "small",
            services: ["cybersecurity"],
            rating: 4.9,
            employees: 15,
            projects: 40,
            logo: "ش آ"
        },
        {
            id: 5,
            name: "ساحل التقنية",
            industry: "it-consulting",
            location: "اللاذقية",
            size: "medium",
            services: ["web-development", "digital-marketing"],
            rating: 4.6,
            employees: 45,
            projects: 80,
            logo: "س ت"
        },
        {
            id: 6,
            name: "نوفا ستارت",
            industry: "software-development",
            location: "حمص",
            size: "startup",
            services: ["mobile-development", "ui-ux-design"],
            rating: 4.4,
            employees: 8,
            projects: 25,
            logo: "ن س"
        }
    ];
}

// تهيئة الصفحة الرئيسية
function initializeHomePage() {
    // تحديث الإحصائيات
    animateStats();
    
    // عرض الخبراء المميزين
    displayFeaturedExperts();
    
    // عرض الشركات المميزة
    displayFeaturedCompanies();
    
    // تهيئة البحث في الصفحة الرئيسية
    initializeHeroSearch();
}

// تحريك الإحصائيات
function animateStats() {
    const statNumbers = document.querySelectorAll('.stat-number');
    
    statNumbers.forEach(stat => {
        const target = parseInt(stat.getAttribute('data-target'));
        const increment = target / 100;
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            stat.textContent = Math.floor(current);
        }, 20);
    });
}

// عرض الخبراء المميزين
function displayFeaturedExperts() {
    const container = document.getElementById('featuredExperts');
    if (!container) return;
    
    const featured = allMembers.slice(0, 3);
    
    container.innerHTML = featured.map(expert => `
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="expert-card">
                <div class="card-body text-center p-4">
                    <div class="expert-avatar">
                        ${expert.avatar}
                    </div>
                    <h5 class="expert-name">${expert.name}</h5>
                    <p class="expert-title">${expert.title}</p>
                    <p class="expert-location">
                        <i class="fas fa-map-marker-alt me-1"></i>
                        ${expert.location}
                    </p>
                    <div class="rating mb-3">
                        ${generateStars(expert.rating)}
                        <span class="ms-2">${expert.rating}</span>
                    </div>
                    <div class="skills mb-3">
                        ${expert.skills.slice(0, 3).map(skill => 
                            `<span class="skill-tag">${skill}</span>`
                        ).join('')}
                    </div>
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-eye me-1"></i>
                        عرض الملف
                    </button>
                </div>
            </div>
        </div>
    `).join('');
}

// عرض الشركات المميزة
function displayFeaturedCompanies() {
    const container = document.getElementById('featuredCompanies');
    if (!container) return;
    
    const featured = allCompanies.slice(0, 3);
    
    container.innerHTML = featured.map(company => `
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="company-card">
                <div class="card-body text-center p-4">
                    <div class="company-logo">
                        ${company.logo}
                    </div>
                    <h5 class="company-name">${company.name}</h5>
                    <p class="company-industry">${getIndustryName(company.industry)}</p>
                    <p class="company-location">
                        <i class="fas fa-map-marker-alt me-1"></i>
                        ${company.location}
                    </p>
                    <div class="company-size">${getSizeName(company.size)}</div>
                    <div class="rating mb-3">
                        ${generateStars(company.rating)}
                        <span class="ms-2">${company.rating}</span>
                    </div>
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-building me-1"></i>
                        عرض الشركة
                    </button>
                </div>
            </div>
        </div>
    `).join('');
}

// تهيئة صفحة الملفات الشخصية
function initializeProfilesPage() {
    filteredData = [...allMembers];
    displayProfiles(1);
    initializeProfilesSearch();
    initializeProfilesFilters();
}

// تهيئة صفحة دليل الشركات
function initializeDirectoryPage() {
    filteredData = [...allCompanies];
    displayCompanies(1);
    initializeCompaniesSearch();
    initializeCompaniesFilters();
}

// عرض الملفات الشخصية
function displayProfiles(page = 1) {
    const container = document.getElementById('profilesContainer');
    const resultsCount = document.getElementById('resultsCount');
    
    if (!container) return;
    
    const startIndex = (page - 1) * CONFIG.itemsPerPage;
    const endIndex = startIndex + CONFIG.itemsPerPage;
    const pageData = filteredData.slice(startIndex, endIndex);
    
    if (pageData.length === 0) {
        container.innerHTML = `
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-users"></i>
                    <h4>لا توجد نتائج</h4>
                    <p>لم نجد أي خبراء يطابقون معايير البحث الخاصة بك</p>
                </div>
            </div>
        `;
    } else {
        container.innerHTML = pageData.map((expert, index) => `
            <div class="col-lg-4 col-md-6 mb-4 fade-in-up" style="animation-delay: ${index * 0.1}s">
                <div class="profile-card">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            ${expert.avatar}
                        </div>
                        <h5 class="mb-1">${expert.name}</h5>
                        <p class="mb-0 opacity-75">${expert.title}</p>
                    </div>
                    <div class="profile-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                ${expert.location}
                            </span>
                            <div class="rating">
                                ${generateStars(expert.rating)}
                                <small class="ms-1">${expert.rating}</small>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <small class="text-muted d-block mb-2">المهارات:</small>
                            <div class="skills">
                                ${expert.skills.slice(0, 4).map(skill => 
                                    `<span class="skill-tag">${skill}</span>`
                                ).join('')}
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-briefcase me-1"></i>
                                ${expert.projects} مشروع
                            </small>
                            <a href="profile.html?id=${expert.id}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>
                                عرض الملف
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');
    }
    
    // تحديث عدد النتائج
    if (resultsCount) {
        resultsCount.textContent = filteredData.length;
    }
    
    // تحديث الترقيم
    updatePagination('profilesPagination', filteredData.length, page, displayProfiles);
}

// عرض الشركات
function displayCompanies(page = 1) {
    const container = document.getElementById('companiesContainer');
    const resultsCount = document.getElementById('companyResultsCount');
    
    if (!container) return;
    
    const startIndex = (page - 1) * CONFIG.itemsPerPage;
    const endIndex = startIndex + CONFIG.itemsPerPage;
    const pageData = filteredData.slice(startIndex, endIndex);
    
    if (pageData.length === 0) {
        container.innerHTML = `
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-building"></i>
                    <h4>لا توجد نتائج</h4>
                    <p>لم نجد أي شركات تطابق معايير البحث الخاصة بك</p>
                </div>
            </div>
        `;
    } else {
        container.innerHTML = pageData.map((company, index) => `
            <div class="col-lg-4 col-md-6 mb-4 fade-in-up" style="animation-delay: ${index * 0.1}s">
                <div class="company-card">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            ${company.logo}
                        </div>
                        <h5 class="mb-1">${company.name}</h5>
                        <p class="mb-0 opacity-75">${getIndustryName(company.industry)}</p>
                    </div>
                    <div class="profile-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                ${company.location}
                            </span>
                            <div class="rating">
                                ${generateStars(company.rating)}
                                <small class="ms-1">${company.rating}</small>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <span class="company-size">${getSizeName(company.size)}</span>
                        </div>
                        
                        <div class="mb-3">
                            <small class="text-muted d-block mb-2">الخدمات:</small>
                            <div class="services">
                                ${company.services.slice(0, 3).map(service => 
                                    `<span class="skill-tag">${getServiceName(service)}</span>`
                                ).join('')}
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-users me-1"></i>
                                ${company.employees} موظف
                            </small>
                            <button class="btn btn-primary btn-sm">
                                <i class="fas fa-building me-1"></i>
                                عرض الشركة
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');
    }
    
    // تحديث عدد النتائج
    if (resultsCount) {
        resultsCount.textContent = filteredData.length;
    }
    
    // تحديث الترقيم
    updatePagination('companiesPagination', filteredData.length, page, displayCompanies);
}

// تهيئة البحث في الصفحة الرئيسية
function initializeHeroSearch() {
    const searchInput = document.getElementById('heroSearch');
    if (!searchInput) return;
    
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            const query = this.value.trim();
            if (query) {
                // توجيه إلى صفحة البحث مع المعايير
                window.location.href = `profiles.html?search=${encodeURIComponent(query)}`;
            }
        }
    });
}

// تهيئة البحث في صفحة الملفات الشخصية
function initializeProfilesSearch() {
    const searchInput = document.getElementById('profileSearch');
    const searchBtn = document.getElementById('searchBtn');
    const specialtyFilter = document.getElementById('specialtyFilter');
    
    if (searchInput) {
        searchInput.addEventListener('input', debounce(filterProfiles, 300));
    }
    
    if (searchBtn) {
        searchBtn.addEventListener('click', filterProfiles);
    }
    
    if (specialtyFilter) {
        specialtyFilter.addEventListener('change', filterProfiles);
    }
    
    // البحث من URL
    const urlParams = new URLSearchParams(window.location.search);
    const searchQuery = urlParams.get('search');
    if (searchQuery && searchInput) {
        searchInput.value = searchQuery;
        filterProfiles();
    }
}

// تهيئة البحث في صفحة الشركات
function initializeCompaniesSearch() {
    const searchInput = document.getElementById('companySearch');
    const searchBtn = document.getElementById('searchCompanyBtn');
    const industryFilter = document.getElementById('industryFilter');
    
    if (searchInput) {
        searchInput.addEventListener('input', debounce(filterCompanies, 300));
    }
    
    if (searchBtn) {
        searchBtn.addEventListener('click', filterCompanies);
    }
    
    if (industryFilter) {
        industryFilter.addEventListener('change', filterCompanies);
    }
}

// تصفية الملفات الشخصية
function filterProfiles() {
    const searchQuery = document.getElementById('profileSearch')?.value.toLowerCase() || '';
    const specialty = document.getElementById('specialtyFilter')?.value || '';
    const location = document.getElementById('locationFilter')?.value || '';
    const experienceLevels = getCheckedValues('input[name="experience"]:checked');
    const selectedSkills = getActiveSkills();
    
    filteredData = allMembers.filter(member => {
        const matchesSearch = !searchQuery || 
            member.name.toLowerCase().includes(searchQuery) ||
            member.title.toLowerCase().includes(searchQuery) ||
            member.skills.some(skill => skill.toLowerCase().includes(searchQuery));
            
        const matchesSpecialty = !specialty || member.specialty === specialty;
        const matchesLocation = !location || member.location === location;
        const matchesExperience = experienceLevels.length === 0 || experienceLevels.includes(member.experience);
        const matchesSkills = selectedSkills.length === 0 || 
            selectedSkills.some(skill => member.skills.some(memberSkill => 
                memberSkill.toLowerCase().includes(skill.toLowerCase())
            ));
        
        return matchesSearch && matchesSpecialty && matchesLocation && matchesExperience && matchesSkills;
    });
    
    displayProfiles(1);
}

// تصفية الشركات
function filterCompanies() {
    const searchQuery = document.getElementById('companySearch')?.value.toLowerCase() || '';
    const industry = document.getElementById('industryFilter')?.value || '';
    const location = document.getElementById('companyLocationFilter')?.value || '';
    const companySizes = getCheckedValues('input[name="companySize"]:checked');
    const selectedServices = getCheckedValues('input[name="services"]:checked');
    
    filteredData = allCompanies.filter(company => {
        const matchesSearch = !searchQuery || 
            company.name.toLowerCase().includes(searchQuery);
            
        const matchesIndustry = !industry || company.industry === industry;
        const matchesLocation = !location || company.location === location;
        const matchesSize = companySizes.length === 0 || companySizes.includes(company.size);
        const matchesServices = selectedServices.length === 0 || 
            selectedServices.some(service => company.services.includes(service));
        
        return matchesSearch && matchesIndustry && matchesLocation && matchesSize && matchesServices;
    });
    
    displayCompanies(1);
}

// تهيئة الفلاتر للملفات الشخصية
function initializeProfilesFilters() {
    // فلاتر مستوى الخبرة
    const experienceCheckboxes = document.querySelectorAll('input[type="checkbox"][id*="Check"]');
    experienceCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', filterProfiles);
    });
    
    // فلتر الموقع
    const locationFilter = document.getElementById('locationFilter');
    if (locationFilter) {
        locationFilter.addEventListener('change', filterProfiles);
    }
    
    // فلاتر المهارات
    const skillTags = document.querySelectorAll('.skill-tag-filter');
    skillTags.forEach(tag => {
        tag.addEventListener('click', function() {
            this.classList.toggle('active');
            filterProfiles();
        });
    });
    
    // مسح الفلاتر
    const clearFilters = document.getElementById('clearFilters');
    if (clearFilters) {
        clearFilters.addEventListener('click', clearAllFilters);
    }
    
    // ترتيب النتائج
    const sortRadios = document.querySelectorAll('input[name="sortBy"]');
    sortRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            sortProfiles(this.value);
        });
    });
}

// تهيئة الفلاتر للشركات
function initializeCompaniesFilters() {
    // فلاتر حجم الشركة
    const sizeCheckboxes = document.querySelectorAll('input[type="checkbox"][id*="Check"]');
    sizeCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', filterCompanies);
    });
    
    // فلتر الموقع
    const locationFilter = document.getElementById('companyLocationFilter');
    if (locationFilter) {
        locationFilter.addEventListener('change', filterCompanies);
    }
    
    // فلاتر الخدمات
    const serviceCheckboxes = document.querySelectorAll('input[name="services"]');
    serviceCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', filterCompanies);
    });
    
    // مسح الفلاتر
    const clearFilters = document.getElementById('clearCompanyFilters');
    if (clearFilters) {
        clearFilters.addEventListener('click', clearAllCompanyFilters);
    }
    
    // ترتيب النتائج
    const sortRadios = document.querySelectorAll('input[name="sortCompanies"]');
    sortRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            sortCompanies(this.value);
        });
    });
}

// ترتيب الملفات الشخصية
function sortProfiles(sortBy) {
    switch(sortBy) {
        case 'newest':
            filteredData.sort((a, b) => b.id - a.id);
            break;
        case 'experience':
            const expOrder = { 'senior': 3, 'mid': 2, 'junior': 1 };
            filteredData.sort((a, b) => expOrder[b.experience] - expOrder[a.experience]);
            break;
        case 'rating':
            filteredData.sort((a, b) => b.rating - a.rating);
            break;
    }
    displayProfiles(1);
}

// ترتيب الشركات
function sortCompanies(sortBy) {
    switch(sortBy) {
        case 'alphabetical':
            filteredData.sort((a, b) => a.name.localeCompare(b.name, 'ar'));
            break;
        case 'size':
            const sizeOrder = { 'large': 4, 'medium': 3, 'small': 2, 'startup': 1 };
            filteredData.sort((a, b) => sizeOrder[b.size] - sizeOrder[a.size]);
            break;
        case 'rating':
            filteredData.sort((a, b) => b.rating - a.rating);
            break;
    }
    displayCompanies(1);
}

// مسح جميع الفلاتر
function clearAllFilters() {
    // مسح حقول الإدخال
    const inputs = document.querySelectorAll('input[type="text"], select');
    inputs.forEach(input => input.value = '');
    
    // مسح الصناديق المحددة
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => checkbox.checked = false);
    
    // مسح المهارات النشطة
    const skillTags = document.querySelectorAll('.skill-tag-filter.active');
    skillTags.forEach(tag => tag.classList.remove('active'));
    
    // إعادة تعيين البيانات المفلترة
    filteredData = [...allMembers];
    displayProfiles(1);
}

// مسح جميع فلاتر الشركات
function clearAllCompanyFilters() {
    // مسح حقول الإدخال
    const inputs = document.querySelectorAll('input[type="text"], select');
    inputs.forEach(input => input.value = '');
    
    // مسح الصناديق المحددة
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => checkbox.checked = false);
    
    // إعادة تعيين البيانات المفلترة
    filteredData = [...allCompanies];
    displayCompanies(1);
}

// تحديث الترقيم
function updatePagination(containerId, totalItems, currentPage, displayFunction) {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    const totalPages = Math.ceil(totalItems / CONFIG.itemsPerPage);
    
    if (totalPages <= 1) {
        container.innerHTML = '';
        return;
    }
    
    let paginationHTML = '';
    
    // السابق
    if (currentPage > 1) {
        paginationHTML += `
            <li class="page-item">
                <a class="page-link" href="#" data-page="${currentPage - 1}">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        `;
    }
    
    // أرقام الصفحات
    for (let i = 1; i <= totalPages; i++) {
        if (i === currentPage) {
            paginationHTML += `
                <li class="page-item active">
                    <span class="page-link">${i}</span>
                </li>
            `;
        } else {
            paginationHTML += `
                <li class="page-item">
                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                </li>
            `;
        }
    }
    
    // التالي
    if (currentPage < totalPages) {
        paginationHTML += `
            <li class="page-item">
                <a class="page-link" href="#" data-page="${currentPage + 1}">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>
        `;
    }
    
    container.innerHTML = paginationHTML;
    
    // إضافة أحداث النقر
    container.querySelectorAll('a.page-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const page = parseInt(this.getAttribute('data-page'));
            displayFunction(page);
        });
    });
}

// تهيئة الأحداث العامة
function initializeGlobalEvents() {
    // أحداث التمرير للكشف عن العناصر
    window.addEventListener('scroll', handleScroll);
    
    // أحداث النقر على الأزرار
    document.addEventListener('click', function(e) {
        if (e.target.matches('.btn-primary, .btn-warning')) {
            // يمكن إضافة منطق النقر هنا
        }
    });
}

// معالجة التمرير
function handleScroll() {
    const elements = document.querySelectorAll('.fade-in-up');
    elements.forEach(element => {
        const elementTop = element.getBoundingClientRect().top;
        const elementVisible = 150;
        
        if (elementTop < window.innerHeight - elementVisible) {
            element.classList.add('visible');
        }
    });
}

// وظائف مساعدة
function generateStars(rating) {
    const fullStars = Math.floor(rating);
    const hasHalfStar = rating % 1 !== 0;
    let starsHTML = '';
    
    for (let i = 0; i < fullStars; i++) {
        starsHTML += '<i class="fas fa-star"></i>';
    }
    
    if (hasHalfStar) {
        starsHTML += '<i class="fas fa-star-half-alt"></i>';
    }
    
    const emptyStars = 5 - Math.ceil(rating);
    for (let i = 0; i < emptyStars; i++) {
        starsHTML += '<i class="far fa-star"></i>';
    }
    
    return starsHTML;
}

function getIndustryName(industry) {
    const industries = {
        'software-development': 'تطوير البرمجيات',
        'web-design': 'تصميم المواقع',
        'mobile-apps': 'تطبيقات الجوال',
        'digital-marketing': 'التسويق الرقمي',
        'it-consulting': 'استشارات تقنية',
        'cybersecurity': 'الأمن السيبراني'
    };
    return industries[industry] || industry;
}

function getSizeName(size) {
    const sizes = {
        'startup': 'ناشئة',
        'small': 'صغيرة',
        'medium': 'متوسطة',
        'large': 'كبيرة'
    };
    return sizes[size] || size;
}

function getServiceName(service) {
    const services = {
        'web-development': 'تطوير الويب',
        'mobile-development': 'تطوير التطبيقات',
        'ui-ux-design': 'تصميم UI/UX',
        'digital-marketing': 'التسويق الرقمي',
        'cybersecurity': 'الأمن السيبراني'
    };
    return services[service] || service;
}

function getCheckedValues(selector) {
    return Array.from(document.querySelectorAll(selector)).map(el => el.value);
}

function getActiveSkills() {
    return Array.from(document.querySelectorAll('.skill-tag-filter.active')).map(el => el.getAttribute('data-skill'));
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function showErrorMessage(message) {
    console.error(message);
    // يمكن إضافة عرض رسالة خطأ للمستخدم هنا
}

// تشغيل الخادم المحلي (للاختبار)
if (typeof module !== 'undefined' && module.exports) {
    const express = require('express');
    const path = require('path');
    const app = express();
    const PORT = 5000;
    
    // تقديم الملفات الثابتة
    app.use(express.static('.'));
    
    // توجيه جميع الطلبات إلى index.html
    app.get('*', (req, res) => {
        res.sendFile(path.join(__dirname, 'index.html'));
    });
    
    app.listen(PORT, '0.0.0.0', () => {
        console.log(`نادي التقنيين السوري يعمل على المنفذ ${PORT}`);
    });
}
