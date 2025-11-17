<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planos</title>
    <link rel="stylesheet" href="../../public/css/telaPlanos.css">
    <link href="https://fonts.googleapis.com/css2?family=Alata&family=Akshar:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> 
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
            <img src="../../public/imgFy/logoSemfundoEscritaBranca.png" alt="Logo">
        </div>

        <div class="logoWhatsApp">
            <img src="../../public/imgFy/whatsapp (3).png" alt="logoWhatsApp">
        </div>

        <div class="fundoSemiTransparente">

            <div class="main-content-grid">

                <div class="navBar">
                    <nav>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="telaInicialAdmphp">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a href="telaNutricionalAdmin.php">Nutricional</a>
                            </li>
                            <li class="nav-item">
                                <a href="telaPersonal.php">Treinos</a>
                            </li>
                            <li class="nav-item">
                                <a href="telaNewCliente.php">Clientes</a>
                            </li>
                            <li class="nav-item">
                                <a href="telaRelatorios.php">Relatorios</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="active">Planos</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="profile-box-container">
                    <a href="telaPerfilAdmin.php" class="profile-link">
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

                <div class="content-cards-wrapper">

                    <div class="card-plano-form" id="formPlanoCard">
                        <h3 class="form-title" id="formTitle">Cadastrar Novo Plano</h3>
                        
                        <form id="planoForm">
                            <input type="hidden" id="planoId" value="">

                            <div class="input-group">
                                <label for="nomePlano">Nome do Plano</label>
                                <input type="text" id="nomePlano" required>
                            </div>
                            
                            <div class="input-group">
                                <label for="valor">Valor Mensal (R$)</label>
                                <input type="number" id="valor" step="0.01" required>
                            </div>
                            
                            <div class="input-group">
                                <label for="descricao">Descrição / Detalhes</label>
                                <textarea id="descricao" rows="3"></textarea>
                            </div>
                            
                            <div class="input-group">
                                <label for="status">Status</label>
                                <select id="status">
                                    <option value="Ativo">Ativo</option>
                                    <option value="Inativo">Inativo</option>
                                </select>
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
    // Simulação de Banco de Dados de Planos
    let planos = [
        { id: 1, nome: 'Plano Básico', valor: 99.90, descricao: 'Acesso a treinos e acompanhamento semanal.', status: 'Ativo' },
        { id: 2, nome: 'Plano Premium', valor: 199.90, descricao: 'Tudo do básico mais plano nutricional e suporte 24h.', status: 'Ativo' },
        { id: 3, nome: 'Plano Arquivado', valor: 0.00, descricao: 'Plano antigo, sem novas adesões.', status: 'Inativo' }
    ];

    let isEditing = false;
    let planoToEditId = null;

    // =========================================================
    // FUNÇÕES DE UI E CARREGAMENTO
    // =========================================================

    /**
     * Carrega a lista de planos no container.
     */
    function renderPlanosList() {
        const container = document.getElementById('planosListContainer');
        container.innerHTML = '<h3 class="list-title">Planos Atuais:</h3>';
        
        planos.forEach(plano => {
            const badgeClass = plano.status === 'Ativo' ? 'status-ativo' : 'status-inativo';
            const badgeText = plano.status === 'Ativo' ? 'ATIVO' : 'INATIVO';
            const statusIcon = plano.status === 'Ativo' ? 'fa-ban' : 'fa-check'; // Ban = Desativar, Check = Ativar
            
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

    /**
     * Atribui eventos de clique aos botões de edição e status.
     */
    function attachPlanActions() {
        // Editar
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = parseInt(this.getAttribute('data-id'));
                const plano = planos.find(p => p.id === id);
                if (plano) {
                    loadPlanForEdit(plano);
                }
            });
        });

        // Alternar Status (Ativar/Desativar)
        document.querySelectorAll('.btn-toggle-status').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = parseInt(this.getAttribute('data-id'));
                const currentStatus = this.getAttribute('data-status');
                const newStatus = currentStatus === 'Ativo' ? 'Inativo' : 'Ativo';
                
                if (confirm(`Tem certeza que deseja ${newStatus === 'Ativo' ? 'ATIVAR' : 'DESATIVAR'} o plano?`)) {
                    togglePlanStatus(id, newStatus);
                }
            });
        });
    }

    /**
     * Carrega os dados de um plano no formulário para edição.
     * @param {object} plano O objeto plano a ser editado.
     */
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
        document.getElementById('formPlanoCard').scrollIntoView({ behavior: 'smooth' });
    }

    // =========================================================
    // FUNÇÕES DE MANIPULAÇÃO DE DADOS
    // =========================================================

    /**
     * Alterna o status do plano e atualiza a lista.
     * @param {number} id ID do plano.
     * @param {string} newStatus 'Ativo' ou 'Inativo'.
     */
    function togglePlanStatus(id, newStatus) {
        const planoIndex = planos.findIndex(p => p.id === id);
        if (planoIndex !== -1) {
            // ** Ação no Backend: Aqui você enviaria a requisição PUT/PATCH para o PHP **
            planos[planoIndex].status = newStatus;
            
            // Simulação:
            alert(`Plano ${planos[planoIndex].nome} foi ${newStatus.toLowerCase()}! (Ação simulada)`);
            renderPlanosList();
        }
    }
    
    /**
     * Reseta o formulário para o modo de novo cadastro.
     */
    function resetForm() {
        document.getElementById('planoForm').reset();
        document.getElementById('formTitle').textContent = 'Cadastrar Novo Plano';
        document.querySelector('.btn-confirmar').textContent = 'Salvar';
        document.getElementById('planoId').value = '';
        isEditing = false;
        planoToEditId = null;
    }

    // =========================================================
    // EVENTOS PRINCIPAIS
    // =========================================================
    document.addEventListener('DOMContentLoaded', function() {
        renderPlanosList();

        const form = document.getElementById('planoForm');
        const btnNovoPlano = document.getElementById('btnNovoPlano');
        const btnCancelar = document.querySelector('.btn-cancelar');

        // EVENTO: Submissão do Formulário (Salvar/Atualizar)
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const id = document.getElementById('planoId').value ? parseInt(document.getElementById('planoId').value) : null;
            const nomePlano = document.getElementById('nomePlano').value.trim();
            const valor = parseFloat(document.getElementById('valor').value);
            const descricao = document.getElementById('descricao').value.trim();
            const status = document.getElementById('status').value;

            const novoPlano = {
                nome: nomePlano,
                valor: valor,
                descricao: descricao,
                status: status
            };

            if (isEditing) {
                // ** Ação no Backend: Requisição PUT/PATCH para atualizar plano (id) **
                const index = planos.findIndex(p => p.id === id);
                if (index !== -1) {
                    planos[index] = { id: id, ...novoPlano };
                    alert(`Plano '${nomePlano}' atualizado com sucesso! (Ação simulada)`);
                }
            } else {
                // ** Ação no Backend: Requisição POST para novo plano **
                const newId = planos.length > 0 ? Math.max(...planos.map(p => p.id)) + 1 : 1;
                planos.push({ id: newId, ...novoPlano });
                alert(`Plano '${nomePlano}' cadastrado com sucesso! (Ação simulada)`);
            }

            resetForm();
            renderPlanosList();
        });

        // EVENTO: Botão Novo Plano (Limpa o formulário)
        btnNovoPlano.addEventListener('click', resetForm);
        
        // EVENTO: Botão Cancelar
        btnCancelar.addEventListener('click', resetForm);
    });
</script>
</body>
</html>