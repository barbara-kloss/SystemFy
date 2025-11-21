// Sistema de Notificações Moderno

// Toast Notification (mensagem temporária)
function showToast(message, type = 'info', duration = 3000) {
    const toast = document.createElement('div');
    toast.className = `toast-notification toast-${type}`;
    toast.innerHTML = `
        <div class="toast-content">
            <span class="toast-icon">${getToastIcon(type)}</span>
            <span class="toast-message">${message}</span>
        </div>
    `;
    
    document.body.appendChild(toast);
    
    // Animação de entrada
    setTimeout(() => toast.classList.add('show'), 100);
    
    // Remover após duração
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, duration);
    
    return toast;
}

function getToastIcon(type) {
    const icons = {
        success: '✓',
        error: '✗',
        warning: '⚠',
        info: 'ℹ'
    };
    return icons[type] || icons.info;
}

// Modal de Confirmação
function showConfirmModal(message, title = 'Confirmação', confirmText = 'Confirmar', cancelText = 'Cancelar') {
    return new Promise((resolve) => {
        const overlay = document.createElement('div');
        overlay.className = 'modal-overlay';
        
        const modal = document.createElement('div');
        modal.className = 'modal-confirm';
        modal.innerHTML = `
            <div class="modal-header">
                <h3>${title}</h3>
            </div>
            <div class="modal-body">
                <p>${message}</p>
            </div>
            <div class="modal-footer">
                <button class="btn-modal btn-cancel">${cancelText}</button>
                <button class="btn-modal btn-confirm">${confirmText}</button>
            </div>
        `;
        
        overlay.appendChild(modal);
        document.body.appendChild(overlay);
        
        // Animação de entrada
        setTimeout(() => overlay.classList.add('show'), 100);
        
        // Eventos dos botões
        const btnConfirm = modal.querySelector('.btn-confirm');
        const btnCancel = modal.querySelector('.btn-cancel');
        
        btnConfirm.addEventListener('click', () => {
            overlay.classList.remove('show');
            setTimeout(() => {
                overlay.remove();
                resolve(true);
            }, 300);
        });
        
        btnCancel.addEventListener('click', () => {
            overlay.classList.remove('show');
            setTimeout(() => {
                overlay.remove();
                showToast('Operação cancelada', 'info', 2000);
                resolve(false);
            }, 300);
        });
        
        // Fechar ao clicar no overlay
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) {
                overlay.classList.remove('show');
                setTimeout(() => {
                    overlay.remove();
                    showToast('Operação cancelada', 'info', 2000);
                    resolve(false);
                }, 300);
            }
        });
        
        // Fechar com ESC
        const handleEsc = (e) => {
            if (e.key === 'Escape') {
                overlay.classList.remove('show');
                setTimeout(() => {
                    overlay.remove();
                    showToast('Operação cancelada', 'info', 2000);
                    resolve(false);
                }, 300);
                document.removeEventListener('keydown', handleEsc);
            }
        };
        document.addEventListener('keydown', handleEsc);
    });
}

// Substituir alert() nativo
window.alert = function(message) {
    showToast(message, 'info', 4000);
};

// Substituir confirm() nativo
window.confirm = function(message) {
    return showConfirmModal(message, 'Confirmação', 'OK', 'Cancelar');
};

// Interceptar onclick com confirm() em links
document.addEventListener('DOMContentLoaded', function() {
    // Interceptar todos os links com onclick="return confirm(...)"
    document.querySelectorAll('a[onclick*="confirm"]').forEach(link => {
        const originalOnclick = link.getAttribute('onclick');
        if (originalOnclick && originalOnclick.includes('confirm')) {
            link.removeAttribute('onclick');
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.getAttribute('href');
                const confirmMatch = originalOnclick.match(/confirm\(['"]([^'"]+)['"]\)/);
                const message = confirmMatch ? confirmMatch[1] : 'Tem certeza que deseja continuar?';
                
                showConfirmModal(message, 'Confirmar Exclusão', 'Confirmar', 'Cancelar')
                    .then(confirmed => {
                        if (confirmed) {
                            window.location.href = url;
                        }
                    });
            });
        }
    });
});

