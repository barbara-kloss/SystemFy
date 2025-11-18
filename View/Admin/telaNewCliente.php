<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
    <link rel="stylesheet" href="/css/telaNewCliente.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
                            <li class="nav-item"><a href="/admin">Home</a></li>
                            <li class="nav-item"><a href="/admin/menu/list">Nutricional</a></li>
                            <li class="nav-item"><a href="/admin/exercise/list">Treinos</a></li>
                            <li class="nav-item"><a href="/cadastro" class="active">Clientes</a></li>
                            <li class="nav-item"><a href="/admin/report/list">Relatorios</a></li>
                            <li class="nav-item"><a href="/admin/plano/list">Planos</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="top-bar-container">
                    <div class="profile-box-container">
                        <a href="/admin/cadastro" class="profile-link">
                            <div class="cardVerPerfil"> <i class="fas fa-user"></i> </div>
                            <div class="textocardVerPerfil"> Ver perfil </div>
                        </a>
                    </div>
                </div>

                <div class="client-form-main">

                    <h1 class="page-title" id="client-page-title">Clientes: Novo Cadastro</h1> 

                    <?php 
                    $feedback = isset($_GET['sucesso']) ? (int)$_GET['sucesso'] : null;
                    $erro = isset($_GET['erro']) ? $_GET['erro'] : null;
                    ?>
                    <?php if ($feedback !== null): ?>
                        <div class="alerta-feedback" style="margin-bottom: 16px; padding: 12px; border-radius: 8px; background: <?= $feedback === 1 ? '#d4edda' : '#f8d7da'; ?>; border: 1px solid <?= $feedback === 1 ? '#c3e6cb' : '#f5c6cb'; ?>;">
                            <?php if ($feedback === 1): ?>
                                <span style="color: #155724; font-weight: bold;">✓ Cliente cadastrado com sucesso!</span>
                            <?php else: ?>
                                <div style="color: #721c24; font-weight: bold;">
                                    <div style="margin-bottom: 8px;">✗ Não foi possível cadastrar o cliente.</div>
                                    <?php if ($erro): ?>
                                        <div style="font-size: 0.9em; font-weight: normal; margin-top: 8px; padding: 8px; background: rgba(0,0,0,0.05); border-radius: 4px;">
                                            <strong>Detalhes do erro:</strong><br>
                                            <?= htmlspecialchars($erro); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="input-group" style="margin-bottom: 20px;">
                        <label for="buscaCliente">Buscar Cliente</label>
                        <div style="position: relative;">
                            <input type="text" id="buscaCliente" placeholder="Digite o nome ou email do cliente para editar..." 
                                autocomplete="off" style="width: 100%; padding: 8px; background: #EDE7D1; border-radius: 28px; border: none; height: 50px; padding: 0 15px; font-size: 18px;">
                            <div id="suggestionsList" style="position: absolute; top: 100%; left: 0; right: 0; background: white; border: 1px solid #ddd; border-top: none; max-height: 200px; overflow-y: auto; z-index: 1000; display: none; border-radius: 0 0 28px 28px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);"></div>
                        </div>
                    </div>

                    <form id="client-form" method="POST" action="/cadastro" class="form-unified">
                        <input type="hidden" name="id" id="id_cliente_form" value="">
                        <div class="form-main-fields">
                            <div class="input-group">
                                <label for="nome">Nome completo</label>
                                <input type="text" id="nome" name="nome_completo" value="" required>
                            </div>
                            <div class="input-group">
                                <label for="email">E-mail</label>
                                <input type="email" id="email" name="email" value="">
                            </div>

                            <div class="input-group">
                                <label for="senha">Senha</label>
                                <input type="password" id="senha" name="senha" value="" placeholder="Deixe em branco para senha padrão">
                            </div>

                            <div class="input-group">
                                <label for="genero">Gênero</label>
                                <select id="genero" name="genero">
                                    <option value="" disabled selected>Selecione</option>
                                    <option value="Feminino">Feminino</option>
                                    <option value="Masculino">Masculino</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <label for="telefone">Telefone</label>
                                <input type="tel" id="telefone" name="telefone" value="" placeholder="(00) 00000-0000" maxlength="15">
                            </div>
                            <div class="input-group">
                                <label for="dataNasc">Data Nascimento</label>
                                <input type="date" id="dataNasc" name="data_nascimento" value="">
                            </div>

                            <div class="input-group">
                                <label for="plano">Plano</label>
                                <select id="plano" name="plano">
                                    <option value="" disabled selected>Selecione</option>
                                </select>
                            </div>
                            
                            <div class="input-group"> 
                                <label for="observacoes">Observações</label>
                                <textarea id="observacoes" name="observacoes"></textarea>
                            </div>

                            <div class="input-group">
                                <label for="objetivo">Objetivo</label>
                                <input type="text" id="objetivo" name="objetivo" value="">
                            </div>
                        </div>

                        <div class="form-meta-fields">
                            <div class="data-section-title">Dados Físicos</div>

                            <div class="input-group-half-row"> 
                                <div class="input-group half-group-meta">
                                    <label for="peso">Peso</label>
                                    <div class="input-with-unit">
                                        <input type="number" id="peso" name="peso" value="" oninput="calcularIMC()" step="0.1">
                                        <span class="unit-label">Kg</span>
                                    </div>
                                </div>

                                <div class="input-group half-group-meta">
                                    <label for="altura">Altura</label>
                                    <div class="input-with-unit">
                                        <input type="text" id="altura" name="altura" value="" placeholder="1.75" maxlength="4">
                                        <span class="unit-label">m</span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group-half-row"> 
                                <div class="input-group half-group-meta">
                                    <label for="imc">IMC</label>
                                    <input type="text" id="imc" value="" readonly class="imc-result">
                                </div>

                                <div class="input-group half-group-meta">
                                    <label for="metaPeso">Meta Peso</label>
                                    <div class="input-with-unit">
                                        <input type="number" id="metaPeso" name="metaPeso" value="" step="0.1">
                                        <span class="unit-label">Kg</span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group-half-row"> 
                                <div class="input-group half-group-meta">
                                    <label for="gordura">% Gordura Corporal:</label>
                                    <input type="text" id="gordura" name="gordura" value="">
                                </div>

                                <div class="input-group half-group-meta">
                                    <label for="magra">% Massa Magra:</label>
                                    <input type="text" id="magra" name="magra" value="">
                                </div>
                            </div>
                            <div class="input-group" style="width: 100%; margin-top: 15px;">
                                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                                    <input type="checkbox" id="status" name="status" value="1" checked style="width: 24px; height: 24px; cursor: pointer;">
                                    <span>Cliente Ativo</span>
                                </label>
                            </div>
                            <div class="client-form-buttons">
                                <button type="submit" class="action-button-edit-button" id="bottom-edit-button">Salvar/Editar</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
    // =========================================================
    // PLANOS DO BANCO DE DADOS
    // =========================================================
    const planosDisponiveis = <?php 
        if (isset($planos)) {
            echo json_encode(array_map(function($p) {
                return ['id' => $p->getId(), 'categoria' => $p->getCategoria()];
            }, $planos));
        } else {
            echo '[]';
        }
    ?>;
    
    let clienteAtualId = null; 

    // =========================================================
    // FUNÇÕES DE UTILIDADE
    // =========================================================

    window.calcularIMC = function() {
        const alturaInput = document.getElementById('altura');
        const alturaStr = alturaInput.value.replace(',', '.'); // Suporta vírgula ou ponto
        const altura = parseFloat(alturaStr);
        const peso = parseFloat(document.getElementById('peso').value);
        const imcInput = document.getElementById('imc');
        
        if (altura > 0 && peso > 0) {
            // Fórmula: Peso / (Altura * Altura)
            const imc = peso / (altura * altura);
            imcInput.value = imc.toFixed(2);
        } else {
            imcInput.value = '';
        }
    }

    function limparCampos() {
        const form = document.getElementById('client-form');
        if (form) form.reset();
        
        const observacoes = document.getElementById('observacoes');
        if (observacoes) observacoes.value = ''; 
        
        // Limpa campos de dados físicos
        const peso = document.getElementById('peso');
        if (peso) peso.value = '';
        const altura = document.getElementById('altura');
        if (altura) altura.value = '';
        const gordura = document.getElementById('gordura');
        if (gordura) gordura.value = '';
        const magra = document.getElementById('magra');
        if (magra) magra.value = '';
        const metaPeso = document.getElementById('metaPeso');
        if (metaPeso) metaPeso.value = '';
        const status = document.getElementById('status');
        if (status) status.checked = true;

        calcularIMC(); // Limpa o campo IMC
        
        const pageTitle = document.getElementById('client-page-title');
        if (pageTitle) pageTitle.textContent = 'Clientes: Novo Cadastro';
        clienteAtualId = null;
        
        const idClienteForm = document.getElementById('id_cliente_form');
        if (idClienteForm) idClienteForm.value = '';
    }

    // =========================================================
    // EVENT LISTENERS
    // =========================================================
    document.addEventListener('DOMContentLoaded', function () {
        console.log('DOM carregado - Iniciando configuração...');
        
        // Inicializa com campos limpos
        limparCampos();

        const bottomEditButton = document.getElementById('bottom-edit-button');
        const clientNameInput = document.getElementById('nome');
        const pageTitleElement = document.getElementById('client-page-title');
        const buscaClienteInput = document.getElementById('buscaCliente');
        const suggestionsList = document.getElementById('suggestionsList');
        const idClienteForm = document.getElementById('id_cliente_form');
        let searchTimeout = null;
        
        // Verificar se os elementos foram encontrados
        console.log('Elementos encontrados:', {
            buscaClienteInput: !!buscaClienteInput,
            suggestionsList: !!suggestionsList,
            idClienteForm: !!idClienteForm
        });
        
        if (!buscaClienteInput) {
            console.error('ERRO: Campo buscaCliente não encontrado!');
            return;
        }
        
        if (!suggestionsList) {
            console.error('ERRO: suggestionsList não encontrado!');
            return;
        }
        
        // Preencher select de planos
        const planoSelect = document.getElementById('plano');
        planosDisponiveis.forEach(plano => {
            const option = document.createElement('option');
            option.value = plano.id;
            option.textContent = plano.categoria;
            planoSelect.appendChild(option);
        });
        
        // Máscara de telefone
        const telefoneInput = document.getElementById('telefone');
        telefoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é dígito
            
            if (value.length === 0) {
                e.target.value = '';
                return;
            }
            
            if (value.length <= 10) {
                // Telefone fixo: (00) 0000-0000
                if (value.length <= 2) {
                    value = `(${value}`;
                } else if (value.length <= 6) {
                    value = `(${value.substring(0, 2)}) ${value.substring(2)}`;
                } else {
                    value = `(${value.substring(0, 2)}) ${value.substring(2, 6)}-${value.substring(6, 10)}`;
                }
            } else {
                // Celular: (00) 00000-0000
                value = `(${value.substring(0, 2)}) ${value.substring(2, 7)}-${value.substring(7, 11)}`;
            }
            
            e.target.value = value;
        });
        
        // Máscara de altura (formato: 1.75 ou 1,75)
        const alturaInput = document.getElementById('altura');
        alturaInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^\d,.]/g, ''); // Remove tudo exceto números, vírgula e ponto
            
            // Garante que só tenha um ponto ou vírgula
            const parts = value.split(/[,.]/);
            if (parts.length > 2) {
                value = parts[0] + '.' + parts.slice(1).join('');
            }
            
            // Substitui vírgula por ponto
            value = value.replace(',', '.');
            
            // Limita a 4 caracteres (ex: 1.75 ou 2.00)
            if (value.length > 4) {
                value = value.substring(0, 4);
            }
            
            // Valida formato: deve ser entre 0.50 e 2.50 metros
            const numValue = parseFloat(value);
            if (value && !isNaN(numValue)) {
                if (numValue < 0.5 || numValue > 2.5) {
                    // Não bloqueia, mas pode mostrar aviso se necessário
                }
            }
            
            e.target.value = value;
            calcularIMC(); // Recalcula IMC quando altura muda
        });
        
        // Recalcular IMC quando peso muda
        document.getElementById('peso').addEventListener('input', function() {
            calcularIMC();
        });

        // =========================================================
        // BUSCA DE CLIENTE
        // =========================================================
        console.log('Configurando event listener para busca...');
        
        buscaClienteInput.addEventListener('input', function(e) {
            console.log('Evento input disparado!', e.target.value);
            const termo = this.value.trim();
            console.log('Termo de busca:', termo);
            
            clearTimeout(searchTimeout);
            
            if (termo.length < 2) {
                console.log('Termo muito curto, escondendo sugestões');
                suggestionsList.style.display = 'none';
                suggestionsList.innerHTML = '';
                return;
            }
            
            console.log('Iniciando busca com termo:', termo);

            searchTimeout = setTimeout(() => {
                const url = `/cadastro/busca-cliente?q=${encodeURIComponent(termo)}`;
                console.log('Buscando clientes:', url);
                
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                    }
                })
                    .then(response => {
                        console.log('Response status:', response.status, response.statusText);
                        if (!response.ok) {
                            return response.text().then(text => {
                                console.error('Erro HTTP:', text);
                                throw new Error(`HTTP error! status: ${response.status}`);
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Dados recebidos:', data);
                        console.log('Tipo de dados:', typeof data, Array.isArray(data));
                        suggestionsList.innerHTML = '';
                        
                        if (data.error) {
                            console.error('Erro na busca:', data.error);
                            suggestionsList.style.display = 'none';
                            return;
                        }
                        
                        if (!Array.isArray(data)) {
                            console.error('Dados não são um array:', data);
                            suggestionsList.style.display = 'none';
                            return;
                        }
                        
                        if (data.length === 0) {
                            console.log('Nenhum cliente encontrado');
                            suggestionsList.style.display = 'none';
                            return;
                        }
                        
                        console.log(`Encontrados ${data.length} clientes`);
                        data.forEach(cliente => {
                            const item = document.createElement('div');
                            item.style.cssText = 'padding: 10px; cursor: pointer; border-bottom: 1px solid #eee; background: white;';
                            const nome = cliente.nome_completo || 'Sem nome';
                            const email = cliente.email || 'Sem email';
                            item.textContent = `${nome} (${email})`;
                            item.addEventListener('mouseenter', () => item.style.background = '#f0f0f0');
                            item.addEventListener('mouseleave', () => item.style.background = 'white');
                            item.addEventListener('click', () => {
                                console.log('Cliente selecionado:', cliente);
                                carregarCliente(cliente.id);
                                buscaClienteInput.value = nome;
                                suggestionsList.style.display = 'none';
                            });
                            suggestionsList.appendChild(item);
                        });
                        suggestionsList.style.display = 'block';
                    })
                    .catch(err => {
                        console.error('Erro na busca:', err);
                        suggestionsList.innerHTML = '';
                        suggestionsList.style.display = 'none';
                    });
            }, 300);
        });

        document.addEventListener('click', function(e) {
            if (buscaClienteInput && suggestionsList) {
                if (!buscaClienteInput.contains(e.target) && !suggestionsList.contains(e.target)) {
                    suggestionsList.style.display = 'none';
                }
            }
        });
        
        console.log('Configuração de busca concluída!');

        function carregarCliente(id) {
            fetch(`/cadastro/get-cliente?id=${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        alert('Erro ao carregar cliente: ' + data.error);
                        return;
                    }

                    // Preencher todos os campos
                    idClienteForm.value = data.id;
                    document.getElementById('nome').value = data.nome_completo || '';
                    document.getElementById('email').value = data.email || '';
                    document.getElementById('genero').value = data.genero || '';
                    document.getElementById('telefone').value = data.telefone || '';
                    document.getElementById('dataNasc').value = data.data_nascimento || '';
                    document.getElementById('plano').value = data.plano_id || '';
                    document.getElementById('observacoes').value = data.observacao || '';
                    document.getElementById('objetivo').value = data.objetivo || '';
                    document.getElementById('peso').value = data.peso || '';
                    document.getElementById('altura').value = data.altura || '';
                    document.getElementById('gordura').value = data.gordura || '';
                    document.getElementById('magra').value = data.massa || '';
                    document.getElementById('metaPeso').value = data.peso_meta || '';
                    document.getElementById('status').checked = data.status == 1;

                    calcularIMC();
                    
                    // Atualizar título
                    pageTitleElement.textContent = `Editando: ${data.nome_completo || 'Cliente'}`;
                    clienteAtualId = data.id;
                })
                .catch(err => {
                    console.error('Erro ao carregar cliente:', err);
                    alert('Erro ao carregar dados do cliente');
                });
        }
        
        // Limpar formulário após sucesso
        <?php if ($feedback === 1): ?>
        setTimeout(function() {
            document.getElementById('client-form').reset();
            document.getElementById('observacoes').value = '';
            document.getElementById('peso').value = '';
            document.getElementById('altura').value = '';
            document.getElementById('gordura').value = '';
            document.getElementById('magra').value = '';
            document.getElementById('metaPeso').value = '';
            document.getElementById('imc').value = '';
            document.getElementById('client-page-title').textContent = 'Clientes: Novo Cadastro';
            clienteAtualId = null;
        }, 2000);
        <?php endif; ?>

        // --- Atualizar Título da Página ao Digitar o Nome ---
        function updatePageTitle() {
            const nome = clientNameInput.value.trim();
            if (nome) {
                pageTitleElement.textContent = `Novo Cliente: ${nome}`;
            } else {
                pageTitleElement.textContent = 'Clientes: Novo Cadastro';
            }
        }
        clientNameInput.addEventListener('input', updatePageTitle);


        // --- 2. BOTÃO INFERIOR "EDITAR" (SALVAR/CONFIRMAR) ---
        // O botão já é type="submit", então vai submeter automaticamente
        document.getElementById('client-form').addEventListener('submit', function(e) {
            const nome = document.getElementById('nome').value.trim();
            const genero = document.getElementById('genero').value;
            const alturaInput = document.getElementById('altura');
            
            if (!nome) {
                e.preventDefault();
                alert('Nome é obrigatório.');
                return;
            }
            
            if (!genero || genero === '') {
                e.preventDefault();
                alert('Gênero é obrigatório.');
                return;
            }
            
            // Converter vírgula para ponto na altura antes de enviar
            if (alturaInput.value) {
                alturaInput.value = alturaInput.value.replace(',', '.');
            }
        });
        
        
        // Função para limpar busca e campos
        function limparBuscaECampos() {
            buscaClienteInput.value = '';
            idClienteForm.value = '';
            limparCampos();
        }
        
        // Inicializar com campos limpos
        limparCampos();
    });
    </script>
</body>

</html>