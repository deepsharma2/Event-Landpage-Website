// CSA XCON CMS - Admin Panel JavaScript

document.addEventListener('DOMContentLoaded', function () {
    // Mobile menu toggle
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const sidebar = document.getElementById('sidebar');

    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function () {
            sidebar.classList.toggle('active');
        });
    }

    // User menu dropdown
    const userMenuToggle = document.getElementById('userMenuToggle');
    const userDropdown = document.getElementById('userDropdown');

    if (userMenuToggle && userDropdown) {
        userMenuToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            userDropdown.classList.toggle('active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (e) {
            if (!userMenuToggle.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.remove('active');
            }
        });
    }

    // Active navigation highlighting
    const currentPage = window.location.pathname.split('/').pop();
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href === currentPage) {
            link.closest('.nav-item').classList.add('active');
        }
    });

    // Close mobile sidebar when clicking a link
    navLinks.forEach(link => {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 1024) {
                sidebar.classList.remove('active');
            }
        });
    });

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 300);
        }, 5000);
    });
});

// Utility Functions
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
        <span>${message}</span>
    `;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.classList.add('show');
    }, 100);

    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

function confirmAction(message, callback) {
    if (confirm(message)) {
        callback();
    }
}

// AJAX Helper
async function apiRequest(url, method = 'GET', data = null) {
    const options = {
        method: method,
        headers: {
            'Content-Type': 'application/json',
        }
    };

    if (data && method !== 'GET') {
        options.body = JSON.stringify(data);
    }

    try {
        const response = await fetch(url, options);
        const result = await response.json();
        return result;
    } catch (error) {
        console.error('API Request Error:', error);
        showNotification('An error occurred. Please try again.', 'error');
        return null;
    }
}

// Form Validation
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return false;

    const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
    let isValid = true;

    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('error');
            isValid = false;
        } else {
            input.classList.remove('error');
        }
    });

    return isValid;
}

// Image Preview
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            const preview = document.getElementById(previewId);
            if (preview) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
        };

        reader.readAsDataURL(input.files[0]);
    }
}

// Color Picker Handler
function initColorPickers() {
    const colorInputs = document.querySelectorAll('input[type="color"]');

    colorInputs.forEach(input => {
        const textInput = input.nextElementSibling;

        if (textInput && textInput.type === 'text') {
            input.addEventListener('change', function () {
                textInput.value = this.value;
            });

            textInput.addEventListener('input', function () {
                if (/^#[0-9A-F]{6}$/i.test(this.value)) {
                    input.value = this.value;
                }
            });
        }
    });
}

// Sortable Lists (for reordering items)
function initSortable(listId) {
    const list = document.getElementById(listId);
    if (!list) return;

    let draggedItem = null;

    const items = list.querySelectorAll('.sortable-item');

    items.forEach(item => {
        item.draggable = true;

        item.addEventListener('dragstart', function () {
            draggedItem = this;
            this.classList.add('dragging');
        });

        item.addEventListener('dragend', function () {
            this.classList.remove('dragging');
        });

        item.addEventListener('dragover', function (e) {
            e.preventDefault();
            const afterElement = getDragAfterElement(list, e.clientY);
            if (afterElement == null) {
                list.appendChild(draggedItem);
            } else {
                list.insertBefore(draggedItem, afterElement);
            }
        });
    });
}

function getDragAfterElement(container, y) {
    const draggableElements = [...container.querySelectorAll('.sortable-item:not(.dragging)')];

    return draggableElements.reduce((closest, child) => {
        const box = child.getBoundingClientRect();
        const offset = y - box.top - box.height / 2;

        if (offset < 0 && offset > closest.offset) {
            return { offset: offset, element: child };
        } else {
            return closest;
        }
    }, { offset: Number.NEGATIVE_INFINITY }).element;
}

// Rich Text Editor Initialization (if using TinyMCE or similar)
function initRichTextEditor(selector) {
    // This is a placeholder for rich text editor initialization
    // You can integrate TinyMCE, CKEditor, or Quill here
    console.log('Rich text editor initialized for:', selector);
}

// Auto-save functionality
let autoSaveTimeout;
function enableAutoSave(formId, saveUrl) {
    const form = document.getElementById(formId);
    if (!form) return;

    const inputs = form.querySelectorAll('input, textarea, select');

    inputs.forEach(input => {
        input.addEventListener('input', function () {
            clearTimeout(autoSaveTimeout);
            autoSaveTimeout = setTimeout(() => {
                saveFormData(form, saveUrl);
            }, 2000); // Auto-save after 2 seconds of inactivity
        });
    });
}

async function saveFormData(form, url) {
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);

    const result = await apiRequest(url, 'POST', data);

    if (result && result.success) {
        showNotification('Changes saved automatically', 'success');
    }
}

// Export functions for global use
window.CMS = {
    showNotification,
    confirmAction,
    apiRequest,
    validateForm,
    previewImage,
    initColorPickers,
    initSortable,
    initRichTextEditor,
    enableAutoSave
};
