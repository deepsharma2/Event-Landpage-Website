// Hero Section Editor JavaScript

document.addEventListener('DOMContentLoaded', function () {
    // Real-time preview updates
    const inputs = {
        badge_text: document.getElementById('badge_text'),
        title: document.getElementById('title'),
        subtitle: document.getElementById('subtitle'),
        description: document.getElementById('description'),
        primary_button_text: document.getElementById('primary_button_text'),
        secondary_button_text: document.getElementById('secondary_button_text')
    };

    const previews = {
        badge: document.getElementById('preview-badge'),
        title: document.getElementById('preview-title'),
        subtitle: document.getElementById('preview-subtitle'),
        description: document.getElementById('preview-description'),
        btnPrimary: document.getElementById('preview-btn-primary'),
        btnSecondary: document.getElementById('preview-btn-secondary')
    };

    // Update preview on input
    Object.keys(inputs).forEach(key => {
        if (inputs[key]) {
            inputs[key].addEventListener('input', function () {
                updatePreview(key, this.value);
            });
        }
    });

    function updatePreview(field, value) {
        switch (field) {
            case 'badge_text':
                previews.badge.textContent = value || 'Badge Text';
                break;
            case 'title':
                previews.title.textContent = value || 'Title';
                break;
            case 'subtitle':
                previews.subtitle.textContent = value || 'Subtitle';
                break;
            case 'description':
                previews.description.textContent = value || 'Description';
                break;
            case 'primary_button_text':
                previews.btnPrimary.textContent = value || 'Button';
                break;
            case 'secondary_button_text':
                previews.btnSecondary.textContent = value || 'Button';
                break;
        }
    }

    // Initialize sortable for stats
    CMS.initSortable('statsList');
});

// Add new stat
function addStat() {
    const statsList = document.getElementById('statsList');
    const newStat = document.createElement('div');
    newStat.className = 'stat-item sortable-item';
    newStat.innerHTML = `
        <div class="stat-drag-handle">
            <i class="fas fa-grip-vertical"></i>
        </div>
        <div class="stat-content">
            <input type="text" class="stat-number" placeholder="100+" onchange="updateStatPreview()">
            <input type="text" class="stat-label" placeholder="Label" onchange="updateStatPreview()">
        </div>
        <div class="stat-actions">
            <button type="button" class="btn-icon" onclick="saveNewStat(this)">
                <i class="fas fa-save"></i>
            </button>
            <button type="button" class="btn-icon btn-danger" onclick="removeStatItem(this)">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `;
    statsList.appendChild(newStat);
    CMS.initSortable('statsList');
}

// Save new stat to database
async function saveNewStat(button) {
    const statItem = button.closest('.stat-item');
    const number = statItem.querySelector('.stat-number').value;
    const label = statItem.querySelector('.stat-label').value;

    if (!number || !label) {
        CMS.showNotification('Please fill in both fields', 'error');
        return;
    }

    const result = await CMS.apiRequest('api/hero-stats.php', 'POST', {
        action: 'create',
        stat_number: number,
        stat_label: label
    });

    if (result && result.success) {
        statItem.setAttribute('data-id', result.id);
        button.setAttribute('onclick', `saveStat(${result.id})`);
        CMS.showNotification('Stat added successfully', 'success');
        updateStatPreview();
    }
}

// Save existing stat
async function saveStat(id) {
    const statItem = document.querySelector(`.stat-item[data-id="${id}"]`);
    const number = statItem.querySelector('.stat-number').value;
    const label = statItem.querySelector('.stat-label').value;

    const result = await CMS.apiRequest('api/hero-stats.php', 'POST', {
        action: 'update',
        id: id,
        stat_number: number,
        stat_label: label
    });

    if (result && result.success) {
        CMS.showNotification('Stat updated successfully', 'success');
        updateStatPreview();
    }
}

// Delete stat
async function deleteStat(id) {
    CMS.confirmAction('Are you sure you want to delete this stat?', async () => {
        const result = await CMS.apiRequest('api/hero-stats.php', 'POST', {
            action: 'delete',
            id: id
        });

        if (result && result.success) {
            const statItem = document.querySelector(`.stat-item[data-id="${id}"]`);
            statItem.remove();
            CMS.showNotification('Stat deleted successfully', 'success');
            updateStatPreview();
        }
    });
}

// Remove stat item (for unsaved items)
function removeStatItem(button) {
    const statItem = button.closest('.stat-item');
    statItem.remove();
    updateStatPreview();
}

// Update stat preview
function updateStatPreview() {
    const previewStats = document.getElementById('preview-stats');
    const statItems = document.querySelectorAll('.stat-item');

    previewStats.innerHTML = '';

    statItems.forEach(item => {
        const number = item.querySelector('.stat-number').value;
        const label = item.querySelector('.stat-label').value;

        if (number && label) {
            const previewStat = document.createElement('div');
            previewStat.className = 'preview-stat';
            previewStat.innerHTML = `
                <div class="preview-stat-number">${number}</div>
                <div class="preview-stat-label">${label}</div>
            `;
            previewStats.appendChild(previewStat);
        }
    });
}

// Refresh preview
function refreshPreview() {
    const inputs = document.querySelectorAll('#heroForm input, #heroForm textarea');
    inputs.forEach(input => {
        const event = new Event('input', { bubbles: true });
        input.dispatchEvent(event);
    });
    updateStatPreview();
    CMS.showNotification('Preview refreshed', 'success');
}

// Form validation before submit
document.getElementById('heroForm')?.addEventListener('submit', function (e) {
    const title = document.getElementById('title').value;

    if (!title.trim()) {
        e.preventDefault();
        CMS.showNotification('Title is required', 'error');
        document.getElementById('title').focus();
        return false;
    }

    return true;
});
