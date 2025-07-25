

let currentCategory = 'all';
let currentTopics = forumData.topics;

// تهيئة المنتدى عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    initializeForum();
});

function initializeForum() {
    displayTopics();
    initializeCategoryFilters();
    initializeNewPostForm();
    updateOnlineCount();
}

// عرض المواضيع
function displayTopics() {
    const container = document.getElementById('forumTopics');
    if (!container) return;

    const filteredTopics = currentCategory === 'all'
        ? currentTopics
        : currentTopics.filter(topic => topic.category === currentCategory);

    if (filteredTopics.length === 0) {
        container.innerHTML = `
            <div class="text-center py-5">
                <i class="fas fa-comments" style="font-size: 3rem; color: var(--border-color);"></i>
                <h4 class="mt-3 text-muted">لا توجد مواضيع في هذا القسم</h4>
                <p class="text-muted">كن أول من يبدأ مناقشة في هذا القسم</p>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newPostModal">
                    <i class="fas fa-plus me-2"></i>
                    إنشاء موضوع جديد
                </button>
            </div>
        `;
        return;
    }

    container.innerHTML = filteredTopics.map(topic => `
        <div class="topic-card" data-topic-id="${topic.id}">
            ${topic.isPinned ? '<div class="badge bg-success mb-2"><i class="fas fa-thumbtack me-1"></i>مثبت</div>' : ''}

            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="flex-grow-1">
                    <h5 class="topic-title mb-2">
                        <a href="#" class="text-decoration-none" onclick="openTopic(${topic.id})">
                            ${topic.title}
                        </a>
                    </h5>
                    <p class="text-muted mb-2" style="font-size: 0.9rem;">
                        ${topic.content.substring(0, 150)}${topic.content.length > 150 ? '...' : ''}
                    </p>
                    <div class="topic-tags mb-2">
                        ${topic.tags.map(tag => `<span class="badge bg-light text-dark me-1">${tag}</span>`).join('')}
                    </div>
                </div>

                <div class="post-avatar ms-3">
                    ${topic.authorAvatar}
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div class="topic-stats">
                    <span class="me-3">
                        <i class="fas fa-reply me-1"></i>
                        ${topic.replies} رد
                    </span>
                    <span class="me-3">
                        <i class="fas fa-eye me-1"></i>
                        ${topic.views} مشاهدة
                    </span>
                    <span class="text-muted">
                        <i class="fas fa-clock me-1"></i>
                        ${topic.lastReply}
                    </span>
                </div>

                <div class="text-muted" style="font-size: 0.85rem;">
                    بواسطة <strong>${topic.author}</strong>
                </div>
            </div>
        </div>
    `).join('');
}

// تهيئة فلاتر الأقسام
function initializeCategoryFilters() {
    const categoryLinks = document.querySelectorAll('[data-category]');

    categoryLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            // إزالة الفئة النشطة من جميع الروابط
            categoryLinks.forEach(l => l.classList.remove('active'));

            // إضافة الفئة النشطة للرابط المحدد
            this.classList.add('active');

            // تحديث الفئة الحالية
            currentCategory = this.getAttribute('data-category');

            // عرض المواضيع المفلترة
            displayTopics();
        });
    });
}

// تهيئة نموذج الموضوع الجديد
function initializeNewPostForm() {
    const form = document.getElementById('newPostForm');
    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = {
            category: document.getElementById('postCategory').value,
            title: document.getElementById('postTitle').value,
            content: document.getElementById('postContent').value,
            tags: document.getElementById('postTags').value.split(',').map(tag => tag.trim()).filter(tag => tag)
        };

        // التحقق من صحة البيانات
        if (!formData.category || !formData.title || !formData.content) {
            alert('يرجى ملء جميع الحقول المطلوبة');
            return;
        }

        // إنشاء موضوع جديد
        const newTopic = {
            id: forumData.topics.length + 1,
            title: formData.title,
            content: formData.content,
            author: "مستخدم جديد", // في التطبيق الحقيقي سيأتي من جلسة المستخدم
            authorAvatar: "مج",
            category: formData.category,
            replies: 0,
            views: 1,
            lastReply: "الآن",
            tags: formData.tags,
            createdAt: new Date().toISOString().split('T')[0],
            isPinned: false
        };

        // إضافة الموضوع الجديد
        forumData.topics.unshift(newTopic);
        currentTopics = forumData.topics;

        // عرض المواضيع المحدثة
        displayTopics();

        // إغلاق النافذة المنبثقة
        const modal = bootstrap.Modal.getInstance(document.getElementById('newPostModal'));
        modal.hide();

        // مسح النموذج
        form.reset();

        // إظهار رسالة نجاح
        showSuccessMessage('تم إنشاء الموضوع بنجاح!');
    });
}

// فتح موضوع للعرض
function openTopic(topicId) {
    const topic = forumData.topics.find(t => t.id === topicId);
    if (!topic) return;

    // في التطبيق الحقيقي، ستنتقل إلى صفحة الموضوع
    // هنا سنعرض مثالاً بسيطاً
    const topicPosts = forumData.posts.filter(p => p.topicId === topicId);

    let content = `
        <div class="modal fade" id="topicModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">${topic.title}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="forum-post">
                            <div class="post-header">
                                <div class="post-avatar">${topic.authorAvatar}</div>
                                <div class="post-meta">
                                    <div class="post-author">${topic.author}</div>
                                    <div class="post-time">${topic.createdAt}</div>
                                </div>
                            </div>
                            <div class="post-content">
                                ${topic.content}
                            </div>
                            <div class="topic-tags">
                                ${topic.tags.map(tag => `<span class="badge bg-light text-dark me-1">${tag}</span>`).join('')}
                            </div>
                        </div>
    `;

    topicPosts.forEach(post => {
        content += `
            <div class="forum-post">
                <div class="post-header">
                    <div class="post-avatar">${post.authorAvatar}</div>
                    <div class="post-meta">
                        <div class="post-author">${post.author}</div>
                        <div class="post-time">${post.createdAt}</div>
                    </div>
                </div>
                <div class="post-content">
                    ${post.content}
                </div>
                <div class="post-actions">
                    <button class="post-action ${post.isLiked ? 'liked' : ''}" onclick="toggleLike(${post.id})">
                        <i class="fas fa-heart"></i> ${post.likes} إعجاب
                    </button>
                    <button class="post-action">
                        <i class="fas fa-reply"></i> رد
                    </button>
                </div>
            </div>
        `;
    });

    content += `
                        <div class="mt-4">
                            <h6>إضافة رد</h6>
                            <textarea class="form-control mb-3" rows="3" placeholder="اكتب ردك هنا..."></textarea>
                            <button class="btn btn-primary">نشر الرد</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;

    // إزالة النافذة السابقة إن وجدت
    const existingModal = document.getElementById('topicModal');
    if (existingModal) {
        existingModal.remove();
    }

    // إضافة النافذة الجديدة
    document.body.insertAdjacentHTML('beforeend', content);

    // إظهار النافذة
    const modal = new bootstrap.Modal(document.getElementById('topicModal'));
    modal.show();

    // زيادة عدد المشاهدات
    topic.views++;
    displayTopics();
}

// تبديل الإعجاب
function toggleLike(postId) {
    const post = forumData.posts.find(p => p.id === postId);
    if (!post) return;

    if (post.isLiked) {
        post.likes--;
        post.isLiked = false;
    } else {
        post.likes++;
        post.isLiked = true;
    }

    // تحديث العرض
    const likeButton = document.querySelector(`[onclick="toggleLike(${postId})"]`);
    if (likeButton) {
        likeButton.innerHTML = `<i class="fas fa-heart"></i> ${post.likes} إعجاب`;
        likeButton.classList.toggle('liked', post.isLiked);
    }
}

// تحديث عداد المتصلين
function updateOnlineCount() {
    // محاكاة عدد المستخدمين المتصلين
    const onlineCount = Math.floor(Math.random() * 50) + 10;

    // يمكن إضافة عنصر لعرض العدد في الواجهة
    console.log(`المستخدمون المتصلون: ${onlineCount}`);
}

// إظهار رسالة نجاح
function showSuccessMessage(message) {
    // إنشاء عنصر التنبيه
    const alert = document.createElement('div');
    alert.className = 'alert alert-success alert-dismissible fade show position-fixed';
    alert.style.cssText = 'top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; min-width: 300px;';
    alert.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    document.body.appendChild(alert);

    // إزالة التنبيه تلقائياً بعد 3 ثوان
    setTimeout(() => {
        if (alert.parentNode) {
            alert.remove();
        }
    }, 3000);
}

// البحث في المواضيع
function searchTopics(query) {
    if (!query.trim()) {
        currentTopics = forumData.topics;
    } else {
        currentTopics = forumData.topics.filter(topic =>
            topic.title.toLowerCase().includes(query.toLowerCase()) ||
            topic.content.toLowerCase().includes(query.toLowerCase()) ||
            topic.tags.some(tag => tag.toLowerCase().includes(query.toLowerCase()))
        );
    }

    displayTopics();
}

// تحديث آخر نشاط
setInterval(() => {
    updateOnlineCount();
}, 30000); // كل 30 ثانية
