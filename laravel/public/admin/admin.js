/**
 * Bnyan Association - Arabic Admin Dashboard Javascript
 * Handles: Dirty form guard, SortableJS, file uploads, confirm dialogs, toasts
 */

(function () {
    'use strict';

    // 1. Toast Notification Helper
    window.AdminToast = {
        show(message, type = 'success') {
            let container = document.getElementById('admin-toast-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'admin-toast-container';
                container.style.cssText = 'position:fixed;bottom:24px;left:24px;z-index:9999;display:flex;flex-direction:column;gap:10px;pointer-events:none;';
                document.body.appendChild(container);
            }

            const toast = document.createElement('div');
            const bg = type === 'error' ? '#dc2626' : (type === 'warning' ? '#d97706' : '#1b4332');
            const icon = type === 'error' ? 'fa-circle-exclamation' : (type === 'warning' ? 'fa-triangle-exclamation' : 'fa-circle-check');

            toast.style.cssText = `
                background: ${bg};
                color: #ffffff;
                padding: 12px 20px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.18);
                font-family: 'Noto Kufi Arabic', sans-serif;
                font-size: 13.5px;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 10px;
                pointer-events: auto;
                opacity: 0;
                transform: translateY(12px);
                transition: all 0.25s ease;
                direction: rtl;
            `;

            toast.innerHTML = `<i class="fa-solid ${icon}"></i><span>${message}</span>`;
            container.appendChild(toast);

            requestAnimationFrame(() => {
                toast.style.opacity = '1';
                toast.style.transform = 'translateY(0)';
            });

            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(12px)';
                setTimeout(() => toast.remove(), 250);
            }, 3500);
        },
        success(msg) { this.show(msg, 'success'); },
        error(msg) { this.show(msg, 'error'); },
        warning(msg) { this.show(msg, 'warning'); }
    };

    // 2. Confirm Modal Helper
    window.AdminConfirm = function (message, onConfirm) {
        if (confirm(message)) {
            if (typeof onConfirm === 'function') onConfirm();
            return true;
        }
        return false;
    };

    // 3. Dirty Form Guard (beforeunload protection)
    let isFormDirty = false;
    let isSubmitting = false;

    document.addEventListener('DOMContentLoaded', () => {
        const trackedForms = document.querySelectorAll('form[data-track-dirty="true"], form.track-dirty');

        trackedForms.forEach(form => {
            const initialData = new FormData(form);

            form.addEventListener('input', () => {
                isFormDirty = true;
            });

            form.addEventListener('change', () => {
                isFormDirty = true;
            });

            form.addEventListener('submit', () => {
                isSubmitting = true;
                isFormDirty = false;
            });
        });

        window.addEventListener('beforeunload', (e) => {
            if (isFormDirty && !isSubmitting) {
                e.preventDefault();
                e.returnValue = 'لديك تعديلات غير محفوظة، هل أنت متأكد من مغادرة الصفحة؟';
                return e.returnValue;
            }
        });

        // 4. SortableJS Initializer
        if (typeof Sortable !== 'undefined') {
            document.querySelectorAll('.admin-sortable-list').forEach(container => {
                Sortable.create(container, {
                    handle: '.sortable-handle',
                    animation: 150,
                    ghostClass: 'sortable-ghost',
                    onEnd: function (evt) {
                        isFormDirty = true;
                    }
                });
            });
        }
    });

    // 5. Digit Conversion Helper
    window.AdminDigits = {
        toLatin(str) {
            if (!str) return '';
            const ar = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
            return String(str).replace(/[٠-٩]/g, d => ar.indexOf(d));
        },
        toArabic(str) {
            if (!str) return '';
            const ar = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
            return String(str).replace(/[0-9]/g, d => ar[parseInt(d)]);
        }
    };

    // 6. Restore Defaults Helper
    window.AdminRestore = {
        restoreField(inputSelector, defaultValue) {
            const input = document.querySelector(inputSelector);
            if (input) {
                input.value = defaultValue;
                input.dispatchEvent(new Event('input', { bubbles: true }));
                input.dispatchEvent(new Event('change', { bubbles: true }));
                window.AdminToast.show('تمت استعادة القيمة الأصلية للحقل بنجاح.', 'info');
            }
        }
    };

})();
