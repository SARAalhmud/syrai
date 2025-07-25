// صفحة الملف الشخصي - JavaScript

// بيانات الملف الشخصي (ستأتي من قاعدة البيانات في التطبيق الحقيقي)
const profileData = {
    id: 1,
    name: "أحمد محمد السيد",
    title: "مطور ويب متقدم",
    avatar: "أم",
    location: "دمشق، سوريا",
    experience: "8 سنوات خبرة",
    projects: 45,
    rating: 4.8,
    reviewsCount: 23,
    availability: "متاح للعمل",
    email: "ahmed.mohamed@example.com",
    phone: "+963 xxx xxx xxx",
    website: "https://ahmed-portfolio.com",
    linkedin: "https://linkedin.com/in/ahmed-mohamed",
    description: "مطور ويب متخصص في تطوير التطبيقات الحديثة باستخدام React و Node.js. لدي خبرة واسعة في بناء تطبيقات ويب قابلة للتطوير وسريعة الاستجابة. أعمل مع الشركات الناشئة والمؤسسات الكبيرة لتحويل أفكارهم إلى حلول تقنية فعالة.",
    skills: [
        { name: "JavaScript", level: 95, category: "Frontend" },
        { name: "React", level: 90, category: "Frontend" },
        { name: "Node.js", level: 85, category: "Backend" },
        { name: "TypeScript", level: 80, category: "Frontend" },
        { name: "MongoDB", level: 75, category: "Database" },
        { name: "PostgreSQL", level: 70, category: "Database" },
        { name: "Docker", level: 65, category: "DevOps" },
        { name: "AWS", level: 60, category: "Cloud" }
    ],
    experience: [
        {
            position: "مطور ويب أول",
            company: "تك سوريا",
            period: "2021 - الآن",
            description: "قيادة فريق تطوير مكون من 5 مطورين لبناء تطبيقات ويب متقدمة للعملاء الكبار."
        },
        {
            position: "مطور React",
            company: "ديجيتال دمشق",
            period: "2019 - 2021",
            description: "تطوير واجهات المستخدم التفاعلية باستخدام React وإدارة الحالة باستخدام Redux."
        },
        {
            position: "مطور ويب",
            company: "سمارت سولوشنز",
            period: "2017 - 2019",
            description: "تطوير مواقع إلكترونية وتطبيقات ويب باستخدام JavaScript وPHP."
        }
    ],
    projects: [
        {
            id: 1,
            name: "منصة التجارة الإلكترونية",
            description: "تطوير منصة تجارة إلكترونية متكاملة باستخدام React و Node.js",
            technologies: ["React", "Node.js", "MongoDB", "Stripe"],
            image: "project1.jpg",
            link: "#"
        },
        {
            id: 2,
            name: "تطبيق إدارة المهام",
            description: "تطبيق ويب لإدارة المهام والمشاريع للفرق",
            technologies: ["Vue.js", "Express", "PostgreSQL"],
            image: "project2.jpg",
            link: "#"
        },
        {
            id: 3,
            name: "نظام إدارة المحتوى",
            description: "نظام إدارة محتوى مخصص للمواقع الإخبارية",
            technologies: ["React", "GraphQL", "Node.js"],
            image: "project3.jpg",
            link: "#"
        }
    ],
    reviews: [
        {
            id: 1,
            clientName: "محمد خالد",
            company: "شركة الإبداع التقني",
            rating: 5,
            date: "2024-01-10",
            comment: "أحمد مطور ممتاز، أنجز المشروع في الوقت المحدد وبجودة عالية. أنصح بالتعامل معه."
        },
        {
            id: 2,
            clientName: "سارة أحمد",
            company: "ستارت أب دمشق",
            rating: 5,
            date: "2023-12-15",
            comment: "عمل احترافي ومتميز. أحمد لديه خبرة واسعة ويقدم حلول إبداعية للمشاكل التقنية."
        },
        {
            id: 3,
            clientName: "علي حسن",
            company: "مؤسسة التقنية المتقدمة",
            rating: 4,
            date: "2023-11-20",
            comment: "مطور موهوب ويتواصل بشكل ممتاز. المشروع تم تسليمه حسب المواصفات المطلوبة."
        }
    ]
};

// الخبراء المشابهون
const similarProfiles = [
    {
        id: 2,
        name: "فاطمة أحمد",
        title: "مصممة UI/UX",
        avatar: "فأ",
        rating: 4.9,
        specialty: "تصميم"
    },
    {
        id: 3,
        name: "محمد علي",
        title: "مطور تطبيقات",
        avatar: "مع",
        rating: 4.7,
        specialty: "تطوير"
    },
    {
        id: 4,
        name: "نور الدين",
        title: "خبير أمن سيبراني",
        avatar: "ند",
        rating: 4.9,
        specialty: "أمان"
    }
];

// تهيئة الصفحة
document.addEventListener('DOMContentLoaded', function() {
    initializeProfile();
});

function initializeProfile() {
    // تحديد ID الملف من URL
    const urlParams = new URLSearchParams(window.location.search);
    const profileId = urlParams.get('id') || '1';
    
    // تحميل بيانات الملف
    loadProfileData(profileId);
    
    // تهيئة الأحداث
    initializeEvents();
    
    // تحميل البيانات الإضافية
    loadSimilarProfiles();
}

function loadProfileData(profileId) {
    // في التطبيق الحقيقي، ستجلب البيانات من API
    displayProfileHeader();
    displaySkills();
    displayExperience();
    displayProjects();
    displayReviews();
}

function displayProfileHeader() {
    // تحديث عناصر الصفحة
    document.getElementById('profileName').textContent = profileData.name;
    document.getElementById('profileTitle').textContent = profileData.title;
    document.getElementById('profileAvatar').textContent = profileData.avatar;
    document.getElementById('profileLocation').textContent = profileData.location;
    document.getElementById('profileExperience').textContent = profileData.experience;
    document.getElementById('profileProjects').textContent = `${profileData.projects} مشروع`;
    document.getElementById('profileDescription').textContent = profileData.description;
    document.getElementById('profileEmail').textContent = profileData.email;
    document.getElementById('profilePhone').textContent = profileData.phone;
    document.getElementById('profileWebsite').href = profileData.website;
    document.getElementById('profileWebsite').textContent = profileData.website.replace('https://', '');
    document.getElementById('profileLinkedin').href = profileData.linkedin;
    
    // تحديث التقييم
    const ratingElement = document.getElementById('profileRating');
    const stars = generateStarsHTML(profileData.rating);
    ratingElement.innerHTML = `${stars} <span class="ms-2">${profileData.rating} (${profileData.reviewsCount} تقييم)</span>`;
    
    // تحديث عنوان الصفحة
    document.title = `${profileData.name} - نادي التقنيين السوري`;
}

function displaySkills() {
    const container = document.getElementById('profileSkills');
    if (!container) return;
    
    const skillsByCategory = groupSkillsByCategory(profileData.skills);
    
    let skillsHTML = '';
    Object.keys(skillsByCategory).forEach(category => {
        skillsHTML += `<div class="skill-category mb-4">`;
        skillsHTML += `<h6 class="skill-category-title mb-3">${getCategoryName(category)}</h6>`;
        skillsHTML += `<div class="skills-list">`;
        
        skillsByCategory[category].forEach(skill => {
            skillsHTML += `
                <div class="skill-item mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="skill-name">${skill.name}</span>
                        <span class="skill-percentage">${skill.level}%</span>
                    </div>
                    <div class="skill-progress">
                        <div class="skill-progress-bar" style="width: ${skill.level}%"></div>
                    </div>
                </div>
            `;
        });
        
        skillsHTML += `</div></div>`;
    });
    
    container.innerHTML = skillsHTML;
}

function displayExperience() {
    const container = document.getElementById('profileExperienceList');
    if (!container) return;
    
    container.innerHTML = profileData.experience.map(exp => `
        <div class="experience-item">
            <div class="experience-header">
                <h6 class="experience-position">${exp.position}</h6>
                <span class="experience-period">${exp.period}</span>
            </div>
            <p class="experience-company text-primary mb-2">
                <i class="fas fa-building me-1"></i>
                ${exp.company}
            </p>
            <p class="experience-description">${exp.description}</p>
        </div>
    `).join('');
}

function displayProjects() {
    const container = document.getElementById('profileProjectsList');
    if (!container) return;
    
    container.innerHTML = profileData.projects.map(project => `
        <div class="col-md-6 mb-4">
            <div class="project-card">
                <div class="project-image">
                    <div class="project-placeholder">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                </div>
                <div class="project-content">
                    <h6 class="project-name">${project.name}</h6>
                    <p class="project-description">${project.description}</p>
                    <div class="project-technologies mb-3">
                        ${project.technologies.map(tech => `<span class="tech-tag">${tech}</span>`).join('')}
                    </div>
                    <a href="${project.link}" class="btn btn-outline-primary btn-sm" target="_blank">
                        <i class="fas fa-external-link-alt me-1"></i>
                        عرض المشروع
                    </a>
                </div>
            </div>
        </div>
    `).join('');
}

function displayReviews() {
    const container = document.getElementById('profileReviews');
    if (!container) return;
    
    container.innerHTML = profileData.reviews.map(review => `
        <div class="review-item mb-4">
            <div class="review-header d-flex justify-content-between align-items-start mb-2">
                <div>
                    <h6 class="reviewer-name mb-1">${review.clientName}</h6>
                    <p class="reviewer-company text-muted mb-0">${review.company}</p>
                </div>
                <div class="review-meta text-end">
                    <div class="review-rating mb-1">
                        ${generateStarsHTML(review.rating)}
                    </div>
                    <small class="review-date text-muted">${formatDate(review.date)}</small>
                </div>
            </div>
            <p class="review-comment">${review.comment}</p>
        </div>
    `).join('');
}

function loadSimilarProfiles() {
    const container = document.getElementById('similarProfiles');
    if (!container) return;
    
    container.innerHTML = similarProfiles.map(profile => `
        <div class="similar-profile-item mb-3">
            <div class="d-flex align-items-center">
                <div class="similar-avatar me-3">
                    ${profile.avatar}
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-1">
                        <a href="profile.html?id=${profile.id}" class="text-decoration-none">
                            ${profile.name}
                        </a>
                    </h6>
                    <p class="text-muted mb-1">${profile.title}</p>
                    <div class="rating-small">
                        ${generateStarsHTML(profile.rating, 'small')}
                        <span class="ms-1">${profile.rating}</span>
                    </div>
                </div>
            </div>
        </div>
    `).join('');
}

function initializeEvents() {
    // زر التواصل
    const contactBtn = document.getElementById('contactBtn');
    contactBtn.addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('contactModal'));
        modal.show();
    });
    
    // زر المشاركة
    const shareBtn = document.getElementById('shareProfileBtn');
    shareBtn.addEventListener('click', shareProfile);
    
    // نموذج التواصل
    const contactForm = document.getElementById('contactForm');
    contactForm.addEventListener('submit', handleContactForm);
}

function shareProfile() {
    if (navigator.share) {
        navigator.share({
            title: `${profileData.name} - ${profileData.title}`,
            text: `تعرف على ${profileData.name}، ${profileData.title} على نادي التقنيين السوري`,
            url: window.location.href
        });
    } else {
        // نسخ الرابط إلى الحافظة
        navigator.clipboard.writeText(window.location.href).then(() => {
            showNotification('تم نسخ رابط الملف الشخصي', 'success');
        });
    }
}

function handleContactForm(e) {
    e.preventDefault();
    
    const formData = {
        senderName: document.getElementById('senderName').value,
        senderEmail: document.getElementById('senderEmail').value,
        subject: document.getElementById('messageSubject').value,
        message: document.getElementById('messageContent').value
    };
    
    // في التطبيق الحقيقي، ستُرسل البيانات إلى الخادم
    console.log('Contact form data:', formData);
    
    // إنشاء رابط البريد الإلكتروني
    const emailSubject = encodeURIComponent(`${getSubjectText(formData.subject)} - من ${formData.senderName}`);
    const emailBody = encodeURIComponent(`السلام عليكم ${profileData.name}،

${formData.message}

مع أطيب التحيات،
${formData.senderName}
${formData.senderEmail}`);
    
    window.location.href = `mailto:${profileData.email}?subject=${emailSubject}&body=${emailBody}`;
    
    // إغلاق النافذة
    const modal = bootstrap.Modal.getInstance(document.getElementById('contactModal'));
    modal.hide();
    
    // مسح النموذج
    document.getElementById('contactForm').reset();
    
    showNotification('تم فتح تطبيق البريد الإلكتروني', 'success');
}

// دوال مساعدة
function generateStarsHTML(rating, size = 'normal') {
    const fullStars = Math.floor(rating);
    const hasHalfStar = rating % 1 !== 0;
    const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
    
    let starsHTML = '';
    
    // نجوم ممتلئة
    for (let i = 0; i < fullStars; i++) {
        starsHTML += '<i class="fas fa-star"></i>';
    }
    
    // نجمة نصف ممتلئة
    if (hasHalfStar) {
        starsHTML += '<i class="fas fa-star-half-alt"></i>';
    }
    
    // نجوم فارغة
    for (let i = 0; i < emptyStars; i++) {
        starsHTML += '<i class="far fa-star"></i>';
    }
    
    return starsHTML;
}

function groupSkillsByCategory(skills) {
    return skills.reduce((groups, skill) => {
        const category = skill.category;
        if (!groups[category]) {
            groups[category] = [];
        }
        groups[category].push(skill);
        return groups;
    }, {});
}

function getCategoryName(category) {
    const categories = {
        'Frontend': 'تطوير الواجهة الأمامية',
        'Backend': 'تطوير الواجهة الخلفية',
        'Database': 'قواعد البيانات',
        'DevOps': 'عمليات التطوير',
        'Cloud': 'الحوسبة السحابية'
    };
    return categories[category] || category;
}

function getSubjectText(subject) {
    const subjects = {
        'project': 'مشروع جديد',
        'collaboration': 'تعاون',
        'consultation': 'استشارة',
        'job-offer': 'عرض عمل',
        'other': 'استفسار عام'
    };
    return subjects[subject] || 'رسالة من منصة نادي التقنيين السوري';
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('ar-SA', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
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