<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutricional</title>
    <link rel="stylesheet" href="../../public/css/telaNutricionalAdmin.css">
    <link href="https://fonts.googleapis.com/css2?family=Alata&family=Akshar:wght@700&display=swap" rel="stylesheet">
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
                                <a href="telaInicialAdmin.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="telaNutricionalAdmin.php" class="active">Nutricional</a>
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
                                <a href="telaPlanos.php">Planos</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="top-right-bar">

                    <div class="search-bar search-cliente">
                        <input type="text" placeholder="Buscar Cliente (Nome ou Email)" class="search-input" id="clienteSearchInput">
                        <i class="fas fa-search search-icon" id="searchIcon"></i>
                        <div id="suggestionsList" class="suggestions-dropdown"></div> 
                    </div>

                    <div class="profile-box-container">

                        <a href="telaPerfilAdmin.php" class="profile-link">
                            <div class="cardVerPerfil"> <i class="fas fa-user"></i> </div>
                            <div class="textocardVerPerfil"> Ver perfil </div>
                        </a>

                    </div>
                </div>

                <div class="content-cards-wrapper">

                    <div class="card-edicao-refeicao">

                        <h3 class="cliente-nome" id="clienteNomeDisplay">(Nenhum Cliente Carregado)</h3>

                        <form class="refeicao-form">

                            <div class="input-group-grid-row">

                                <div class="input-group half-width-field">
                                    <label for="tipoRefeicao">Tipo de Refeição</label>
                                    <select id="tipoRefeicao">
                                        <option value="Geral" selected>Refeições Geral</option>
                                        <option value="Livre">Refeições Livre</option>
                                    </select>
                                </div>

                                <div class="input-group half-width-field">
                                    <label for="horario">Horário</label>
                                    <input type="time" id="horario" value="08:00">
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="categoriaNome">Nome da Refeição</label>
                                <input type="text" id="categoriaNome" value="">
                            </div>

                            <div class="input-group">
                                <label for="observacao">Observação</label>
                                <textarea id="observacao"></textarea>
                            </div>
                        </form>

                        <button type="submit" class="btn-confirmar">Confirmar</button>
                    </div>

                    <div class="card-lista-refeicoes">

                        <div class="lista-header">
                            <h3 class="lista-titulo">Refeições</h3>

                            <select id="filtroRefeicao" class="filtro-refeicao-select">
                                <option value="Geral">Refeições Geral</option>
                                <option value="Livre">Refeições Livre</option>
                            </select>
                        </div>

                        <div class="lista-itens-scroll">
                            <div class="refeicao-item clickable-item" data-id="1" data-tipo="Geral">
                                <span class="refeicao-horario">6:00</span>
                                <span class="refeicao-nome">Ao acordar</span>
                                <button class="btn-excluir"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="refeicao-item clickable-item" data-id="2" data-tipo="Geral">
                                <span class="refeicao-horario">7:00</span>
                                <span class="refeicao-nome">Café da Manhã</span>
                                <button class="btn-excluir"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="refeicao-item clickable-item" data-id="3" data-id="3" data-tipo="Livre">
                                <span class="refeicao-horario">8:00</span>
                                <span class="refeicao-nome">Lanche da Manhã</span>
                                <button class="btn-excluir"><i class="fas fa-times"></i></button>
                            </div>
                        </div>

                        <button class="btn-adicionar-refeicao" title="Adicionar Nova Refeição">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // =========================================================
        // DADOS SIMULADOS PARA BUSCA
        // =========================================================
        const clientesSimulados = [
            { id: 1, nome: "ANA MARIA DA SILVA", email: "ana.maria@email.com", refeicoes: [] },
            { id: 2, nome: "JOÃO PEDRO SOUZA", email: "joao.pedro@email.com", refeicoes: [] },
            { id: 3, nome: "PEDRO ALMEIDA", email: "pedro.almeida@email.com", refeicoes: [] },
            { id: 4, nome: "MARCIA FAGUNDES", email: "marcia.fagundes@email.com", refeicoes: [] },
        ];

        let clienteCarregadoId = null; 

        // =========================================================
        // FUNÇÕES DE BUSCA E UI
        // =========================================================
        
        /**
         * Busca o cliente por substring no nome ou email.
         * @param {string} termo Termo de busca.
         * @returns {Array} Array de clientes correspondentes.
         */
        function buscarClientesParcial(termo) {
            const termoUpper = termo.toUpperCase().trim();

            return clientesSimulados.filter(cliente => {
                const nomeUpper = cliente.nome.toUpperCase();
                const emailUpper = cliente.email.toUpperCase();

                // Lógica de substring (LIKE %TERMO%)
                return nomeUpper.includes(termoUpper) || emailUpper.includes(termoUpper);
            });
        }
        
        /**
         * Retorna o primeiro cliente encontrado com base no termo.
         * Usado para a busca final (Enter ou clique no ícone).
         */
        function buscarCliente(termo) {
            const resultados = buscarClientesParcial(termo);
            return resultados.length > 0 ? resultados[0] : null;
        }


        // FUNÇÃO PARA CARREGAR DADOS DO CLIENTE (Simulação)
        function carregarDadosCliente(cliente) {
            document.getElementById('clienteNomeDisplay').textContent = `Cliente: ${cliente.nome}`;
            clienteCarregadoId = cliente.id;
            // Aqui você adicionaria a lógica para carregar as refeições do cliente ID
            console.log(`Cliente ${cliente.nome} (ID: ${cliente.id}) carregado. Carregando refeições...`);
            // Limpa o campo de busca
            document.getElementById('clienteSearchInput').value = cliente.nome;
        }


        // FUNÇÃO PARA RENDERIZAR E EXIBIR A LISTA DE SUGESTÕES
        function renderSuggestions(matches) {
            const listContainer = document.getElementById('suggestionsList');
            listContainer.innerHTML = ''; // Limpa sugestões antigas
            
            if (matches.length > 0) {
                matches.forEach(cliente => {
                    const item = document.createElement('div');
                    item.className = 'suggestion-item';
                    item.textContent = `${cliente.nome} (${cliente.email.split('@')[0]}...)`;
                    
                    // CRÍTICO: Adiciona evento para carregar o cliente ao clicar na sugestão
                    item.addEventListener('click', function() {
                        carregarDadosCliente(cliente);
                        listContainer.style.display = 'none';
                    });
                    
                    listContainer.appendChild(item);
                });
                listContainer.style.display = 'block';
            } else {
                listContainer.style.display = 'none';
            }
        }


        // FUNÇÃO PRINCIPAL DE BUSCA/INPUT (CHAMADA EM TEMPO REAL)
        function handleAutocomplete(event) {
            const termo = event.target.value.trim();
            const listContainer = document.getElementById('suggestionsList');

            if (termo.length < 2) { // Começa a sugerir após 2 caracteres
                listContainer.style.display = 'none';
                return;
            }

            const resultados = buscarClientesParcial(termo);

            renderSuggestions(resultados);
        }
        
        // FUNÇÃO PARA LIDAR COM BUSCA COMPLETA (ENTER ou ÍCONE)
        function handleSearch() {
            const searchInput = document.getElementById('clienteSearchInput');
            const termo = searchInput.value;
            
            if (termo.length < 2) {
                 alert("Digite um nome ou e-mail para buscar.");
                 return;
            }

            const cliente = buscarCliente(termo); 

            document.getElementById('suggestionsList').style.display = 'none'; // Esconde a lista

            if (cliente) {
                carregarDadosCliente(cliente);
                alert(`Cliente encontrado: ${cliente.nome}`);
            } else {
                document.getElementById('clienteNomeDisplay').textContent = '(Cliente Não Encontrado)';
                clienteCarregadoId = null;
                alert(`Nenhum cliente encontrado para o termo: "${termo}"`);
            }
        }


        // =========================================================
        // EVENT LISTENERS
        // =========================================================
        document.addEventListener('DOMContentLoaded', function () {

            const searchInput = document.getElementById('clienteSearchInput');
            const searchIcon = document.getElementById('searchIcon');

            // 1. Disparar autocompletar em tempo real
            searchInput.addEventListener('input', handleAutocomplete);

            // 2. Disparar a busca completa (Enter ou Ícone)
            searchIcon.addEventListener('click', handleSearch);
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault(); 
                    handleSearch();
                }
            });

            // 3. Ocultar sugestões quando clicar fora do campo (boa prática de UX)
            document.addEventListener('click', function(e) {
                const searchBar = document.querySelector('.search-bar');
                if (!searchBar.contains(e.target)) {
                    document.getElementById('suggestionsList').style.display = 'none';
                }
            });


            // --- CÓDIGO ORIGINAL DAS REFEIÇÕES (Mantido) ---
            const listaItensScroll = document.querySelector('.lista-itens-scroll');
            const filtroRefeicao = document.getElementById('filtroRefeicao'); 

            function applyFilter(filterValue) {
                const itens = document.querySelectorAll('.refeicao-item');
                itens.forEach(item => {
                    const tipo = item.getAttribute('data-tipo');
                    if (filterValue === 'todos' || tipo === filterValue) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }

            function attachEventListeners(itemElement) {
                // 1. Exclusão
                itemElement.querySelector('.btn-excluir').addEventListener('click', function (e) {
                    e.stopPropagation();
                    const nomeRefeicao = itemElement.querySelector('.refeicao-nome').textContent.trim();
                    const confirmExclusao = confirm(`Tem certeza que deseja excluir a refeição "${nomeRefeicao}"?`);
                    if (confirmExclusao) {
                        itemElement.remove();
                        alert('Refeição excluída com sucesso! (Ação simulada)');
                    }
                });

                // 2. Edição
                itemElement.addEventListener('click', function () {
                    const nome = this.querySelector('.refeicao-nome').textContent.trim();
                    const horaString = this.querySelector('.refeicao-horario').textContent.trim();
                    const tipo = this.getAttribute('data-tipo');
                    const hora = horaString.padStart(5, '0');

                    document.getElementById('categoriaNome').value = nome;
                    document.getElementById('horario').value = hora;
                    document.getElementById('tipoRefeicao').value = tipo;
                    document.querySelector('.cliente-nome').textContent = `(Editando: ${nome})`;
                });
            }

            document.querySelectorAll('.refeicao-item.clickable-item').forEach(attachEventListeners);
            
            filtroRefeicao.addEventListener('change', function() {
                applyFilter(this.value);
            });

            const confirmButton = document.querySelector('.btn-confirmar');
            const refeicaoForm = document.querySelector('.refeicao-form');

            confirmButton.addEventListener('click', function (e) {
                e.preventDefault();
                // Simulação da lógica de confirmação...
                alert('Ação registrada: Confirmar Edição/Criação (Simulado)');
                refeicaoForm.reset();
            });

            document.querySelector('.btn-adicionar-refeicao').addEventListener('click', function () {
                const form = document.querySelector('.refeicao-form');
                form.reset();
                document.querySelector('.cliente-nome').textContent = '(Cadastrando Nova Refeição)';
                alert('Pronto para cadastrar uma nova refeição!');
            });
        });
    </script>
</body>

</html>