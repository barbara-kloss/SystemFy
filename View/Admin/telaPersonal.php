<?php

use Systemfy\App\Model\Exercise;

/** @var Exercise|null $exercise */

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treinos</title>
    <link rel="stylesheet" href="/css/telaPersonal.css">
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
                                <a href="/admin/exercise/list" class="active">Treinos</a>
                            </li>
                            <li class="nav-item">
                                <a href="/cadastro">Clientes</a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/report/list">Relatorios</a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/plano/list">Planos</a>
                        </ul>
                    </nav>
                </div>

                <div class="top-right-bar">
                    <div class="search-bar search-cliente">
                        <input type="text" placeholder="Cliente" class="search-input" id="clienteSearchInput">
                        <i class="fas fa-search search-icon" id="searchIcon"></i>
                        <div id="suggestionsList" class="suggestions-dropdown"></div>
                    </div>
                    <div class="profile-box-container">
                        <a href="/admin/cadastro" class="profile-link">
                            <div class="cardVerPerfil"> <i class="fas fa-user"></i> </div>
                            <div class="textocardVerPerfil"> Ver perfil </div>
                        </a>
                    </div>
                </div>

                <div class="content-cards-wrapper">

                    <div class="card-edicao-treino" data-cliente-id="">

                        <h3 class="cliente-nome">(Nenhum Cliente Carregado)</h3>

                        <form class="exercicio-form" method="post">

                            <div class="input-group-grid-row">
                                <div class="input-group half-width-field">
                                    <label for="nomeExercicio">Nome do Exercício</label>
                                    <input name="tipo_exercicio" type="text" id="nomeExercicio"
                                        value="<?= $exercise?->tipo_exercicio; ?>">
                                </div>
                                <div class="input-group half-width-field">
                                    <label for="linkVideo">Link</label>
                                    <input name="video" type="url" id="linkVideo" value="<?= $exercise?->video; ?>">
                                </div>
                            </div>

                            <div class="input-group-grid-row">
                                <div class="input-group half-width-field">
                                    <label for="categoriaSelect">Categoria</label>
                                    <select name="categoria" id="categoriaSelect">
                                        <option  value="<?= $exercise?->categoria; ?>" selected>
                                            Superiores</option>
                                        <option  value="<?= $exercise?->categoria; ?>">Inferiores
                                        </option>
                                        <option value="<?= $exercise?->categoria; ?>">Core</option>
                                        <option value="<?= $exercise?->categoria; ?>">Cardio</option>
                                    </select>
                                </div>

                                <div class="input-group half-width-field">
                                    <label for="diaSemanaSelect">Dia da Semana</label>
                                    <select name="dia" id="diaSemanaSelect">
                                        <option  value="<?= $exercise?->dia; ?>" selected>Segunda-Feira
                                        </option>
                                        <option value="<?= $exercise?->dia; ?>">Terça-Feira</option>
                                        <option value="<?= $exercise?->dia; ?>">Quarta-Feira</option>
                                        <option value="<?= $exercise?->dia; ?>">Quinta-Feira</option>
                                        <option value="<?= $exercise?->dia; ?>">Sexta-Feira</option>
                                        <option value="<?= $exercise?->dia; ?>">Sabado</option>
                                        <option value="<?= $exercise?->dia; ?>">Domingo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="observacao">Observações</label>
                                <textarea name="observacao" id="observacao"><?= $exercise?->observacao; ?></textarea>
                            </div>


                            <div class="input-group-grid-row">
                                <div class="input-group half-width-field">
                                    <label for="series">Séries</label>
                                    <input name="repeticao" type="text" id="series" value="<?= $exercise?->repeticao; ?>">
                                </div>

                                <div class="input-group half-width-field peso-input-group">
                                    <label for="peso">Peso</label>
                                    <div class="peso-wrapper">
                                        <input name="peso" type="number" id="peso" value="<?= $exercise?->peso; ?>" min="0">
                                        <span class="kg-unit">KG</span>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn-confirmar">Confirmar</button>
                        </div>
                    </form>

                    <div class="card-lista-treinos">

                        <div class="lista-header">
                            <h3 class="lista-titulo">Treinos Recomendados</h3>
                        </div>

                        <div class="lista-itens-scroll" id="listaTreinosScroll">
                        </div>

                        <button class="btn-adicionar-treino" title="Adicionar Novo Treino">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // CÓDIGO JAVASCRIPT ORIGINAL DE TREINOS (Mantido)
        // =========================================================
        // DADOS SIMULADOS PARA BUSCA DE CLIENTE
        // =========================================================
        const clientesSimulados = [
            { id: 1, nome: "ANA MARIA DA SILVA", email: "ana.maria@email.com", treinos: [] },
            { id: 2, nome: "JOÃO PEDRO SOUZA", email: "joao.pedro@email.com", treinos: [] },
            { id: 3, nome: "PEDRO ALMEIDA", email: "pedro.almeida@email.com", treinos: [] },
            { id: 4, nome: "MARCIA FAGUNDES", email: "marcia.fagundes@email.com", treinos: [] },
        ];

        let clienteCarregadoId = null;
        const clienteNomeDisplay = document.querySelector('.cliente-nome');
        const cardEdicaoTreino = document.querySelector('.card-edicao-treino');

        // Simulação de Treinos por Cliente ID
        const treinosSimulados = {
            1: [
                { id: 1, nome: 'Agachamento', categoria: 'Inferiores', dia: '4', link: 'link_ana1', obs: '10 segundos isometria', series: '3x15', peso: '25' },
                { id: 2, nome: 'Flexão', categoria: 'Superiores', dia: '2', link: 'link_ana2', obs: 'Até a falha', series: '3xMAX', peso: '0' },
            ],
            2: [
                { id: 3, nome: 'Corrida', categoria: 'Cardio', dia: '1', link: 'link_joao1', obs: '40 minutos', series: '1x40', peso: '0' },
                { id: 4, nome: 'Supino', categoria: 'Superiores', dia: '3', link: 'link_joao2', obs: 'Progressão de carga', series: '4x10', peso: '40' },
            ],
        };

        // =========================================================
        // FUNÇÕES DE BUSCA DE CLIENTE
        // =========================================================

        function buscarClientesParcial(termo) {
            const termoUpper = termo.toUpperCase().trim();
            return clientesSimulados.filter(cliente => {
                const nomeUpper = cliente.nome.toUpperCase();
                const emailUpper = cliente.email.toUpperCase();
                return nomeUpper.includes(termoUpper) || emailUpper.includes(termoUpper);
            });
        }

        function buscarCliente(termo) {
            const resultados = buscarClientesParcial(termo);
            return resultados.length > 0 ? resultados[0] : null;
        }

        function renderSuggestions(matches) {
            const listContainer = document.getElementById('suggestionsList');
            listContainer.innerHTML = '';

            if (matches.length > 0) {
                matches.forEach(cliente => {
                    const item = document.createElement('div');
                    item.className = 'suggestion-item';
                    item.textContent = `${cliente.nome} (${cliente.email.split('@')[0]}...)`;

                    item.addEventListener('click', function () {
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

        function handleAutocomplete(event) {
            const termo = event.target.value.trim();
            const listContainer = document.getElementById('suggestionsList');

            if (termo.length < 2) {
                listContainer.style.display = 'none';
                return;
            }

            const resultados = buscarClientesParcial(termo);
            renderSuggestions(resultados);
        }

        function handleSearch() {
            const searchInput = document.getElementById('clienteSearchInput');
            const termo = searchInput.value;

            if (termo.length < 2) {
                alert("Digite um nome ou e-mail para buscar.");
                return;
            }

            const cliente = buscarCliente(termo);
            document.getElementById('suggestionsList').style.display = 'none';

            if (cliente) {
                carregarDadosCliente(cliente);
            } else {
                clienteNomeDisplay.textContent = '(Cliente Não Encontrado)';
                cardEdicaoTreino.setAttribute('data-cliente-id', '');
                clienteCarregadoId = null;
                renderTreinosList(0);
                alert(`Nenhum cliente encontrado para o termo: "${termo}"`);
            }
        }

        // =========================================================
        // FUNÇÕES DE TREINOS
        // =========================================================

        // Mapeamento de Dia da Semana
        const diaMap = {
            '2': 'Segunda', '1': 'Domingo', '3': 'Terça', '4': 'Quarta',
            '5': 'Quinta', '6': 'Sexta', '7': 'Sábado'
        };

        function getDiaName(diaValue) {
            return diaMap[diaValue] || 'Dia Indefinido';
        }

        // Elementos principais
        const listaItensScroll = document.getElementById('listaTreinosScroll');
        const confirmButton = document.querySelector('.btn-confirmar');
        const exercicioForm = document.querySelector('.exercicio-form');
        const btnAdicionarTreino = document.querySelector('.btn-adicionar-treino');

        // Campos do formulário (IDs corrigidos/unificados)
        const nomeExercicioInput = document.getElementById('nomeExercicio');
        const observacaoTextarea = document.getElementById('observacao');
        const linkVideoInput = document.getElementById('linkVideo');
        const categoriaSelect = document.getElementById('categoriaSelect'); // USANDO categoriaSelect
        const diaSemanaSelect = document.getElementById('diaSemanaSelect'); // USANDO diaSemanaSelect
        const seriesInput = document.getElementById('series');
        const pesoInput = document.getElementById('peso');

        let currentEditingItem = null;

        // --- FUNÇÃO PARA RENDERIZAR A LISTA DE TREINOS DE UM CLIENTE ---
        function renderTreinosList(clienteId) {
            const treinos = treinosSimulados[clienteId] || [];
            listaItensScroll.innerHTML = '';
            resetForm();

            if (treinos.length === 0 && clienteId !== 0) {
                listaItensScroll.innerHTML = '<p style="text-align: center; color: #504f4f; padding: 20px;">Nenhum treino cadastrado para este cliente.</p>';
                return;
            }

            treinos.forEach((plano) => {
                const diaDisplay = getDiaName(plano.dia);
                const itemElement = document.createElement('div');
                itemElement.className = 'treino-item clickable-item';

                for (const key in plano) {
                    if (key !== 'id') {
                        itemElement.setAttribute(`data-${key.toLowerCase()}`, plano[key]);
                    }
                }
                itemElement.setAttribute('data-id', plano.id);

                itemElement.innerHTML = `
                <span class="treino-label">${diaDisplay}</span>
                <span class="treino-nome">${plano.nome} (${plano.categoria})</span>
                <button class="btn-excluir"><i class="fas fa-times"></i></button>
            `;

                listaItensScroll.appendChild(itemElement);
                attachEventListeners(itemElement);
            });
        }

        // --- FUNÇÃO PARA CARREGAR O CLIENTE E INICIAR A TELA ---
        function carregarDadosCliente(cliente) {
            clienteNomeDisplay.textContent = `Cliente: ${cliente.nome}`;
            clienteCarregadoId = cliente.id;
            cardEdicaoTreino.setAttribute('data-cliente-id', cliente.id);

            renderTreinosList(cliente.id);

            document.getElementById('clienteSearchInput').value = cliente.nome;
        }


        function resetForm() {
            exercicioForm.reset();
            // Removi os valores iniciais para não poluir o formulário ao carregar um cliente
            nomeExercicioInput.value = '';
            observacaoTextarea.value = '';
            linkVideoInput.value = '';
            categoriaSelect.value = 'Superiores';
            diaSemanaSelect.value = '2';
            seriesInput.value = '';
            pesoInput.value = '';

            if (clienteCarregadoId) {
                const clienteAtual = clientesSimulados.find(c => c.id === clienteCarregadoId);
                clienteNomeDisplay.textContent = `Cliente: ${clienteAtual.nome}`;
            } else {
                clienteNomeDisplay.textContent = '(Nenhum Cliente Carregado)';
            }
            currentEditingItem = null;
        }

        function attachEventListeners(itemElement) {
            // 1. Exclusão
            const excluirBtn = itemElement.querySelector('.btn-excluir');
            if (excluirBtn) {
                excluirBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    if (!clienteCarregadoId) { alert('Carregue um cliente primeiro!'); return; }

                    const nomeTreino = itemElement.getAttribute('data-nome');
                    const confirmExclusao = confirm(`Tem certeza que deseja excluir o treino "${nomeTreino}"?`);
                    if (confirmExclusao) {
                        itemElement.remove();
                        const treinoId = parseInt(itemElement.getAttribute('data-id'));
                        const treinos = treinosSimulados[clienteCarregadoId];
                        if (treinos) {
                            treinosSimulados[clienteCarregadoId] = treinos.filter(t => t.id !== treinoId);
                        }

                        alert('Treino excluído com sucesso! (Ação simulada)');
                        if (itemElement === currentEditingItem) {
                            resetForm();
                        }
                    }
                });
            }

            // 2. Edição (Clique no item)
            itemElement.addEventListener('click', function () {
                if (!clienteCarregadoId) { alert('Carregue um cliente primeiro!'); return; }

                currentEditingItem = this;

                const nome = this.getAttribute('data-nome');
                const link = this.getAttribute('data-link');
                const obs = this.getAttribute('data-obs');
                const categoria = this.getAttribute('data-categoria');
                const dia = this.getAttribute('data-dia');
                const series = this.getAttribute('data-series');
                const peso = this.getAttribute('data-peso');

                nomeExercicioInput.value = nome || '';
                observacaoTextarea.value = obs || '';
                linkVideoInput.value = link || '';
                categoriaSelect.value = categoria || 'Superiores';
                diaSemanaSelect.value = dia || '2';
                seriesInput.value = series || '';
                pesoInput.value = peso || '';

                clienteNomeDisplay.textContent = `${clienteNomeDisplay.textContent.split(':')[0]}: (Editando Exercício: ${nome})`;
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            // --- LISTENERS DE BUSCA DE CLIENTE ---
            const searchInput = document.getElementById('clienteSearchInput');
            const searchIcon = document.getElementById('searchIcon');

            searchInput.addEventListener('input', handleAutocomplete);
            searchIcon.addEventListener('click', handleSearch);
            searchInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    handleSearch();
                }
            });

            document.addEventListener('click', function (e) {
                const searchBar = document.querySelector('.search-bar');
                const listContainer = document.getElementById('suggestionsList');
                if (searchBar && listContainer && !searchBar.contains(e.target)) {
                    listContainer.style.display = 'none';
                }
            });

            // Inicializa a lista e o formulário
            renderTreinosList(0);

            // --- LISTENERS DE TREINOS ---
            confirmButton.addEventListener('click', function (e) {
                e.preventDefault();

                if (!clienteCarregadoId) {
                    alert('Selecione um cliente antes de confirmar!');
                    return;
                }

                const nomeExercicio = nomeExercicioInput.value.trim();
                const observacao = observacaoTextarea.value.trim();
                const linkVideo = linkVideoInput.value.trim();
                const categoria = categoriaSelect.value;
                const dia = diaSemanaSelect.value;
                const diaDisplayName = getDiaName(dia);
                const series = seriesInput.value.trim();
                const peso = pesoInput.value.trim();

                let message;

                if (currentEditingItem === null) {
                    // AÇÃO DE CRIAÇÃO
                    const treinos = treinosSimulados[clienteCarregadoId] || [];
                    const novoId = treinos.length > 0 ? Math.max(...treinos.map(t => t.id)) + 1 : 1;

                    const novoItem = document.createElement('div');
                    const novoTreinoNome = nomeExercicio || categoria;

                    novoItem.className = 'treino-item clickable-item';
                    novoItem.setAttribute('data-id', novoId);
                    novoItem.setAttribute('data-nome', novoTreinoNome);
                    novoItem.setAttribute('data-categoria', categoria);
                    novoItem.setAttribute('data-dia', dia);
                    novoItem.setAttribute('data-link', linkVideo);
                    novoItem.setAttribute('data-obs', observacao);
                    novoItem.setAttribute('data-series', series);
                    novoItem.setAttribute('data-peso', peso);

                    novoItem.innerHTML = `
                <span class="treino-label">${diaDisplayName}</span> 
                <span class="treino-nome">${novoTreinoNome} (${categoria})</span>
                <button class="btn-excluir"><i class="fas fa-times"></i></button>
                `;

                    listaItensScroll.prepend(novoItem);
                    attachEventListeners(novoItem);

                    if (!treinosSimulados[clienteCarregadoId]) { treinosSimulados[clienteCarregadoId] = []; }
                    treinosSimulados[clienteCarregadoId].push({
                        id: novoId, nome: novoTreinoNome, categoria, dia, link: linkVideo, obs: observacao, series, peso
                    });

                    message = `Novo exercício '${novoTreinoNome}' cadastrado com sucesso!`;

                } else {
                    // AÇÃO DE EDIÇÃO
                    currentEditingItem.setAttribute('data-nome', nomeExercicio);
                    currentEditingItem.setAttribute('data-categoria', categoria);
                    currentEditingItem.setAttribute('data-dia', dia);
                    currentEditingItem.setAttribute('data-link', linkVideo);
                    currentEditingItem.setAttribute('data-obs', observacao);
                    currentEditingItem.setAttribute('data-series', series);
                    currentEditingItem.setAttribute('data-peso', peso);

                    currentEditingItem.querySelector('.treino-label').textContent = diaDisplayName;
                    currentEditingItem.querySelector('.treino-nome').textContent = `${nomeExercicio} (${categoria})`;

                    message = `Exercício '${nomeExercicio}' atualizado com sucesso!`;
                }

                alert('Ação registrada: ' + message);
            });

            btnAdicionarTreino.addEventListener('click', function () {
                if (!clienteCarregadoId) {
                    alert('Selecione um cliente primeiro!');
                    return;
                }
                resetForm();
                clienteNomeDisplay.textContent = `${clienteNomeDisplay.textContent.split(':')[0]}: (Cadastrando Novo Exercício)`;
                alert('Pronto para cadastrar um novo exercício!');
            });
        });
    </script>
</body>

</html>