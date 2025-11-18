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
                    
                    <div class="search-bar">
                        <input type="text" placeholder="Buscar Cliente (Nome ou Email)" class="search-input" list="client-suggestions">
                        <i class="fas fa-search search-icon"></i>
                    </div>

                    <div class="profile-box-container">
                        <a href="/admin/cadastro" class="profile-link">
                            <div class="cardVerPerfil"> <i class="fas fa-user"></i> </div>
                            <div class="textocardVerPerfil"> Ver perfil </div>
                        </a>
                    </div>
                    
                    <datalist id="client-suggestions"></datalist>
                </div>

                <div class="client-form-main">

                    <h1 class="page-title" id="client-page-title">Clientes: Novo Cadastro</h1> 

                    <form id="client-form">
                        <div class="input-group">
                            <label for="nome">Nome completo</label>
                            <input type="text" id="nome" value="" required>
                        </div>
                        <div class="input-group">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" value="">
                        </div>

                        <div class="input-group">
                            <label for="genero">Gênero</label>
                            <select id="genero">
                                <option value="" disabled selected>Selecione</option>
                                <option value="Feminino">Feminino</option>
                                <option value="Masculino">Masculino</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label for="telefone">Telefone</label>
                            <input type="tel" id="telefone" value="">
                        </div>
                        <div class="input-group">
                            <label for="dataNasc">Data Nascimento</label>
                            <input type="date" id="dataNasc" value="">
                        </div>

                        <div class="input-group">
                            <label for="plano">Plano</label>
                            <select id="plano">
                                <option value="" disabled selected>Selecione</option>
                                <option value="Basico">Básico</option>
                                <option value="Premium">Premium</option>
                            </select>
                        </div>
                        
                        <div class="input-group"> 
                            <label for="observacoes">Observações</label>
                            <textarea id="observacoes"></textarea>
                        </div>

                        <div class="input-group">
                            <label for="objetivo">Objetivo</label>
                            <input type="text" id="objetivo" value="">
                        </div>
                        
                    </form>
                </div>

                <div class="client-form-meta">
                    <div class="data-section-title">Dados Físicos</div>

                    <div class="input-group-half-row"> 
                        <div class="input-group half-group-meta">
                            <label for="peso">Peso</label>
                            <div class="input-with-unit">
                                <input type="number" id="peso" value="" oninput="calcularIMC()" step="0.1">
                                <span class="unit-label">Kg</span>
                            </div>
                        </div>

                        <div class="input-group half-group-meta">
                            <label for="altura">Altura</label>
                            <div class="input-with-unit">
                                <input type="number" id="altura" value="" oninput="calcularIMC()" step="0.01">
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
                                <input type="number" id="metaPeso" value="">
                                <span class="unit-label">Kg</span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group-half-row"> 
                        <div class="input-group half-group-meta">
                            <label for="gordura">% Gordura Corporal:</label>
                            <input type="text" id="gordura" value="">
                        </div>

                        <div class="input-group half-group-meta">
                            <label for="magra">% Massa Magra:</label>
                            <input type="text" id="magra" value="">
                        </div>
                    </div>
                    <div class="client-form-buttons">
                        <button class="action-button-edit-button" id="bottom-edit-button">Salvar/Editar</button>
                        <button class="action-button-excluir-button" id="bottom-delete-button">Excluir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // =========================================================
    // VARIÁVEIS DE TESTE
    // =========================================================
    const clientesSimulados = [
        { id: 1, nome: "ANA MARIA DA SILVA", email: "ana.maria@email.com", genero: "Feminino", telefone: "(11) 9 8888-7777", dataNasc: "1995-10-20", plano: "Premium", objetivo: "Emagrecimento", obs: "Dieta sem carboidratos noturnos.", peso: 75.5, altura: 1.70 },
        { id: 2, nome: "JOÃO PEDRO SOUZA", email: "joao.souza@email.com", genero: "Masculino", telefone: "(21) 9 1234-5678", dataNasc: "1988-05-15", plano: "Basico", objetivo: "Ganho de Massa", obs: "Necessita de suplementação pós-treino.", peso: 88.0, altura: 1.85 },
        { id: 3, nome: "CARLA GOMES", email: "carla.gomes@email.com", genero: "Feminino", telefone: "(31) 9 9999-0000", dataNasc: "2001-01-01", plano: "Premium", objetivo: "Manutenção", obs: "Treino 3x por semana, foco em resistência.", peso: 60.2, altura: 1.63 }
    ];
    
    let clienteAtualId = null; 

    // =========================================================
    // FUNÇÕES DE UTILIDADE
    // =========================================================
    
    // Função para preencher o Datalist com sugestões de clientes
    function preencherDatalist() {
        const datalist = document.getElementById('client-suggestions');
        if (!datalist) return; 

        datalist.innerHTML = ''; 

        // Cria e adiciona opções para Nome e Email de cada cliente
        clientesSimulados.forEach(cliente => {
            let optionNome = document.createElement('option');
            optionNome.value = cliente.nome;
            datalist.appendChild(optionNome);
            
            let optionEmail = document.createElement('option');
            optionEmail.value = cliente.email;
            datalist.appendChild(optionEmail);
        });
    }

    window.calcularIMC = function() {
        const altura = parseFloat(document.getElementById('altura').value);
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

    function limparCampos(isNew = true) {
        document.getElementById('client-form').reset();
        document.getElementById('observacoes').value = ''; 
        
        // Limpa campos de dados físicos
        document.getElementById('peso').value = '';
        document.getElementById('altura').value = '';
        document.getElementById('gordura').value = '';
        document.getElementById('magra').value = '';
        document.getElementById('metaPeso').value = '';

        calcularIMC(); // Limpa o campo IMC
        
        if (isNew) {
            document.getElementById('client-page-title').textContent = 'Clientes: Novo Cadastro'; // Título original
            clienteAtualId = null; 
            document.querySelector('.search-input').value = ''; // Limpa a barra de busca
        }
    }
    
    function carregarCliente(cliente) {
        limparCampos(false); 
        
        document.getElementById('nome').value = cliente.nome;
        document.getElementById('email').value = cliente.email;
        document.getElementById('genero').value = cliente.genero;
        document.getElementById('telefone').value = cliente.telefone;
        document.getElementById('dataNasc').value = cliente.dataNasc;
        document.getElementById('plano').value = cliente.plano;
        document.getElementById('observacoes').value = cliente.obs;
        document.getElementById('objetivo').value = cliente.objetivo;

        document.getElementById('peso').value = cliente.peso;
        document.getElementById('altura').value = cliente.altura;
        // Campos gordura/massa magra não estão nos dados de teste, ficam vazios

        calcularIMC(); 
        
        document.getElementById('client-page-title').textContent = `Cliente: ${cliente.nome}`;
        clienteAtualId = cliente.id; 
        
        document.querySelector('.search-input').value = cliente.nome; // Preenche a barra de busca
    }

    // =========================================================
    // EVENT LISTENERS
    // =========================================================
    document.addEventListener('DOMContentLoaded', function () {
        // Inicializa com campos limpos e IMC calculado
        limparCampos(true); 
        calcularIMC();

        const searchInput = document.querySelector('.search-input');
        const bottomEditButton = document.getElementById('bottom-edit-button');
        const bottomDeleteButton = document.getElementById('bottom-delete-button');
        const clientNameInput = document.getElementById('nome');
        const pageTitleElement = document.getElementById('client-page-title');
        
        // Chama a função para preencher o datalist
        preencherDatalist();

        // --- Atualizar Título da Página ao Digitar o Nome ---
        function updatePageTitle() {
            const nome = clientNameInput.value.trim();
            if (nome && clienteAtualId === null) {
                pageTitleElement.textContent = `Novo Cliente: ${nome}`;
            } else if (clienteAtualId !== null) {
                pageTitleElement.textContent = `Cliente: ${nome}`;
            } else {
                pageTitleElement.textContent = 'Clientes: Novo Cadastro';
            }
        }
        clientNameInput.addEventListener('input', updatePageTitle);
        
        
        // --- 1. LÓGICA DE BUSCA (SIMULADA) ---
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const termo = this.value.toUpperCase().trim();
                
                const clienteEncontrado = clientesSimulados.find(c => 
                    c.nome.toUpperCase().includes(termo) || c.email.toUpperCase().includes(termo)
                );

                if (clienteEncontrado) {
                    carregarCliente(clienteEncontrado);
                    alert(`Cliente '${clienteEncontrado.nome}' carregado. (Simulado)`);
                } else {
                    limparCampos(true); 
                    alert(`Cliente com termo '${termo}' não encontrado. Iniciando novo cadastro.`);
                }
            }
        });
        
        // Busca também ao selecionar uma sugestão (evento 'change')
        searchInput.addEventListener('change', function(e) {
            const termo = this.value.toUpperCase().trim();
            
            const clienteEncontrado = clientesSimulados.find(c => 
                c.nome.toUpperCase() === termo || c.email.toUpperCase() === termo
            );
            
            // Só carrega se o termo digitado/selecionado corresponder exatamente a um cliente
            if (clienteEncontrado) {
                carregarCliente(clienteEncontrado);
            }
        });


        // --- 2. BOTÃO INFERIOR "EDITAR" (SALVAR/CONFIRMAR) ---
        bottomEditButton.addEventListener('click', function(e) {
            e.preventDefault();

            const nome = document.getElementById('nome').value.trim();
            if (!nome || !document.getElementById('email').value.trim()) {
                alert('Nome e E-mail são obrigatórios.');
                return;
            }
            
            const isCreating = clienteAtualId === null;
            const imc = document.getElementById('imc').value;
            
            alert(isCreating 
                ? `Cliente ${nome} cadastrado com sucesso! (IMC: ${imc})`
                : `Cliente ${nome} editado com sucesso! (IMC: ${imc})`
            );
            
            // Simulação da limpeza pós-salvamento
            limparCampos(true); 
            preencherDatalist(); // Atualiza a lista de sugestões após salvar/cadastrar
        });
        
        
        // --- 3. BOTÃO INFERIOR "EXCLUIR" ---
        bottomDeleteButton.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (clienteAtualId === null) {
                alert('Não há cliente carregado para exclusão. Formulário limpo.');
                limparCampos(true);
                return;
            }

            const nomeCliente = document.getElementById('nome').value;
            const confirmDelete = confirm(`ATENÇÃO! Tem certeza que deseja excluir o cliente ${nomeCliente}?`);
            
            if (confirmDelete) {
                // Simulação de exclusão: remove do array de teste
                const index = clientesSimulados.findIndex(c => c.id === clienteAtualId);
                if (index > -1) clientesSimulados.splice(index, 1);
                
                alert(`Cliente ${nomeCliente} excluído com sucesso! (Ação simulada)`);
                limparCampos(true);
                preencherDatalist(); // Atualiza a lista de sugestões após exclusão
            }
        });
        
        // Carrega cliente de exemplo ao iniciar
        const exampleClient = clientesSimulados.find(c => c.id === 1);
        if (exampleClient) {
            carregarCliente(exampleClient);
        } else {
            limparCampos(true);
        }
    });
    </script>
</body>

</html>