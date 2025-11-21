<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planos</title>
    <link rel="stylesheet" href="/css/telaPlanos.css">
    <link rel="stylesheet" href="/css/notifications.css">
    <link href="https://fonts.googleapis.com/css2?family=Alata&family=Akshar:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="/js/notifications.js"></script> 
</head>

<body>
    <div class="background">
        <div class="bolinha bolinha1"></div>
        <div class="bolinha bolinha2"></div>
        <div class="bolinha bolinha3"></div>
        <div class="bolinha bolinha4"></div>
        <div class="bolinha bolinha5"></div>
        <div class="bolinha bolinha6"></div>

        <div class="logoCantoInferior">
            <img src="/imgFy/logoSemfundoEscritaBranca.png" alt="Logo">
        </div>

        

        <div class="fundoSemiTransparente">

            <div class="main-content-grid">
                <div class="navBar">
                    <nav>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="/admin">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/menu/list">Nutricional</a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/exercise/list">Treinos</a>
                            </li>
                            <li class="nav-item">
                                <a href="/cadastro">Clientes</a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/report/list">Relatorios</a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/plano/list" class="active">Planos</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="profile-box-container">
                    <a href="/admin/perfil" class="profile-link">
                        <div class="cardVerPerfil"> <i class="fas fa-user"></i> </div>
                        <div class="textocardVerPerfil"> Ver perfil </div>
                    </a>
                </div>

                <div class="header-content">
                    <h1 class="page-title">Gestão de Planos</h1>
                    <button class="btn-novo-plano" id="btnNovoPlano">
                        <i class="fas fa-plus"></i> Novo Plano
                    </button>
                </div>

                <?php 
                $sucesso = filter_input(INPUT_GET, 'sucesso', FILTER_VALIDATE_INT);
                if ($sucesso !== null): 
                ?>
                    <div class="alert-message <?= $sucesso === 1 ? 'alert-success' : 'alert-error'; ?>" id="alertMessage">
                        <?= $sucesso === 1 ? 'Operação realizada com sucesso!' : 'Erro ao realizar operação. Tente novamente.'; ?>
                    </div>
                    <script>
                        // Remover mensagem após 3 segundos
                        setTimeout(function() {
                            const alert = document.getElementById('alertMessage');
                            if (alert) {
                                alert.style.opacity = '0';
                                setTimeout(() => alert.remove(), 300);
                            }
                        }, 3000);
                    </script>
                <?php endif; ?>

                <div class="content-cards-wrapper">

                    <div class="card-plano-form" id="formPlanoCard">
                        
                        <div class="form-title-wrapper">
                            <h3 class="form-title" id="formTitle">Cadastrar Novo Plano</h3>
                        </div>
                        
                        <form id="planoForm">
                            <input type="hidden" id="planoId" value="">

                            <div class="input-group">
                                <label for="nomePlano">Nome do Plano</label>
                                <input type="text" id="nomePlano" required>
                            </div>
                            
                            <div class="input-group-grid-row">
                                <div class="input-group half-width-field">
                                    <label for="valor">Valor Mensal (R$)</label>
                                    <input type="number" id="valor" step="0.01" required>
                                </div>
                                <div class="input-group half-width-field">
                                    <label for="status">Status</label>
                                    <select id="status">
                                        <option value="Ativo">Ativo</option>
                                        <option value="Inativo">Inativo</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="input-group">
                                <label for="descricao">Descrição / Detalhes</label>
                                <textarea id="descricao" rows="3"></textarea>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="btn-confirmar">Salvar</button>
                                <button type="button" class="btn-cancelar">Cancelar</button>
                            </div>
                        </form>
                    </div>

                    <div class="planos-list-container" id="planosListContainer">
                        <h3 class="list-title">Planos Atuais:</h3>
                        </div>

                </div>
            </div>
        </div>
    </div>

<script>
    // Dados reais do banco de dados (vindos do PHP)
    const planosFromDB = <?= json_encode(array_map(function($plano) {
        return [
            'id' => $plano->getId(),
            'categoria' => $plano->getCategoria(),
            'preco' => $plano->getPreco(),
            'descricao' => $plano->getDescricao(),
            'ativo' => $plano->getAtivo()
        ];
    }, $planoList ?? []), JSON_UNESCAPED_UNICODE); ?>;
    
    // Converter para formato usado no frontend
    let planos = planosFromDB.map(p => ({
        id: p.id,
        nome: p.categoria,
        valor: parseFloat(p.preco),
        descricao: p.descricao,
        status: p.ativo ? 'Ativo' : 'Inativo'
    }));

    let isEditing = false;
    let planoToEditId = null;

    // ... (renderPlanosList, attachPlanActions e togglePlanStatus mantidos) ...
    function renderPlanosList() {
        const container = document.getElementById('planosListContainer');
        container.innerHTML = '<h3 class="list-title">Planos Atuais:</h3>';
        
        planos.forEach(plano => {
            const badgeClass = plano.status === 'Ativo' ? 'status-ativo' : 'status-inativo';
            const badgeText = plano.status === 'Ativo' ? 'ATIVO' : 'INATIVO';
            const statusIcon = plano.status === 'Ativo' ? 'fa-ban' : 'fa-check'; 
            
            const planoCard = document.createElement('div');
            planoCard.className = 'plano-card';
            planoCard.innerHTML = `
                <div class="plano-info">
                    <h4>${plano.nome} (R$ ${plano.valor.toFixed(2).replace('.', ',')})</h4>
                    <p>${plano.descricao}</p>
                </div>
                <div class="plano-status-badge ${badgeClass}">${badgeText}</div>
                <div class="plano-actions">
                    <button class="btn-action btn-edit" data-id="${plano.id}" title="Editar Plano">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="btn-action btn-toggle-status" data-id="${plano.id}" data-status="${plano.status}" title="${plano.status === 'Ativo' ? 'Desativar' : 'Ativar'}">
                        <i class="fas ${statusIcon}"></i>
                    </button>
                </div>
            `;
            container.appendChild(planoCard);
        });

        attachPlanActions();
    }

    function attachPlanActions() {
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault(); 
                const id = parseInt(this.getAttribute('data-id'));
                const plano = planos.find(p => p.id === id);
                if (plano) {
                    loadPlanForEdit(plano);
                }
            });
        });

        document.querySelectorAll('.btn-toggle-status').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = parseInt(this.getAttribute('data-id'));
                const currentStatus = this.getAttribute('data-status');
                const newStatus = currentStatus === 'Ativo' ? 'Inativo' : 'Ativo';
                
                showConfirmModal(
                    `Tem certeza que deseja ${newStatus === 'Ativo' ? 'ATIVAR' : 'DESATIVAR'} o plano?`,
                    'Confirmar Alteração',
                    'Confirmar',
                    'Cancelar'
                ).then(confirmed => {
                    if (confirmed) {
                        togglePlanStatus(id, newStatus);
                    }
                });
            });
        });
    }

    function loadPlanForEdit(plano) {
        document.getElementById('formTitle').textContent = `Editar Plano: ${plano.nome}`;
        document.getElementById('planoId').value = plano.id;
        document.getElementById('nomePlano').value = plano.nome;
        document.getElementById('valor').value = plano.valor;
        document.getElementById('descricao').value = plano.descricao;
        document.getElementById('status').value = plano.status;
        
        isEditing = true;
        planoToEditId = plano.id;
        document.querySelector('.btn-confirmar').textContent = 'Atualizar';
        
        // 💥 CORREÇÃO NO JS: Removendo scrollIntoView para evitar que a tela principal suba
        // document.getElementById('formPlanoCard').scrollIntoView({ behavior: 'smooth' }); 
        
        // Apenas foca no primeiro campo do formulário (opcional)
        document.getElementById('nomePlano').focus();
    }

    function togglePlanStatus(id, newStatus) {
        const plano = planos.find(p => p.id === id);
        if (!plano) return;

        // Carregar o plano para edição e atualizar apenas o status
        const ativo = newStatus === 'Ativo';
        
        const formData = new FormData();
        formData.append('categoria', plano.nome);
        formData.append('preco', plano.valor);
        formData.append('descricao', plano.descricao);
        formData.append('ativo', ativo ? '1' : '0');

        fetch(`/admin/plano/edit?id=${id}`, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.redirected) {
                window.location.href = response.url;
            } else {
                window.location.reload();
            }
        })
            .catch(error => {
                console.error('Erro ao alterar status do plano:', error);
                showToast('Erro ao alterar status do plano. Tente novamente.', 'error', 4000);
            });
    }
    
    function resetForm() {
        document.getElementById('planoForm').reset();
        document.getElementById('formTitle').textContent = 'Cadastrar Novo Plano';
        document.querySelector('.btn-confirmar').textContent = 'Salvar';
        document.getElementById('planoId').value = '';
        isEditing = false;
        planoToEditId = null;
    }

    // ... (Event Listeners mantidos) ...
    document.addEventListener('DOMContentLoaded', function() {
        renderPlanosList();

        const form = document.getElementById('planoForm');
        const btnNovoPlano = document.getElementById('btnNovoPlano');
        const btnCancelar = document.querySelector('.btn-cancelar');

        // EVENTO: Submissão do Formulário (Salvar/Atualizar)
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const id = document.getElementById('planoId').value ? parseInt(document.getElementById('planoId').value) : null;
            const categoria = document.getElementById('nomePlano').value.trim();
            const preco = parseFloat(document.getElementById('valor').value);
            const descricao = document.getElementById('descricao').value.trim();
            const status = document.getElementById('status').value;
            const ativo = status === 'Ativo';

            // Criar FormData para enviar via POST
            const formData = new FormData();
            formData.append('categoria', categoria);
            formData.append('preco', preco);
            formData.append('descricao', descricao);
            formData.append('ativo', ativo ? '1' : '0');

            let url;
            if (isEditing && id) {
                url = `/admin/plano/edit?id=${id}`;
            } else {
                url = '/admin/plano/save';
            }

            // Enviar para o backend
            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                } else {
                    return response.text();
                }
            })
            .then(data => {
                // Se não redirecionou, recarregar a página
                if (data !== undefined) {
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Erro ao salvar plano:', error);
                showToast('Erro ao salvar plano. Tente novamente.', 'error', 4000);
            });
        });

        // EVENTO: Botão Novo Plano (Limpa o formulário)
        btnNovoPlano.addEventListener('click', resetForm);
        
        // EVENTO: Botão Cancelar
        btnCancelar.addEventListener('click', resetForm);
    });
</script>
</body>
</html>