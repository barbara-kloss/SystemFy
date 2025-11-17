<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treinos</title>
    <link rel="stylesheet" href="../../public/css/telaPersonal.css">
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
                                <a href="telaNutricionalAdmin.php">Nutricional</a>
                            </li>
                            <li class="nav-item">
                                <a href="telaPersonal.php" class="active">Treinos</a>
                            </li>
                            <li class="nav-item">
                                <a href="telaNewCliente.php">Clientes</a>
                            </li>
                            <li class="nav-item">
                                <a href="telaRelatorios.php">Relatorios</a>
                            </li>
                            <li class="nav-item">
                                <a href="telaPlanos.php">Planos</a>
                        </ul>
                    </nav>
                </div>

                <div class="top-right-bar">

                    <div class="search-bar search-cliente">
                        <input type="text" placeholder="Cliente" class="search-input">
                        <i class="fas fa-search search-icon"></i>
                    </div>

                    <div class="profile-box-container">
                        <a href="telaPerfilAdmin.php" class="profile-link">
                            <div class="cardVerPerfil"> <i class="fas fa-user"></i> </div>
                            <div class="textocardVerPerfil"> Ver perfil </div>
                        </a>
                    </div>
                </div>

                <div class="content-cards-wrapper">

                    <div class="card-edicao-treino">

                        <h3 class="cliente-nome">(Nome do Cliente)</h3>

                        <form class="exercicio-form">

                            <div class="input-group-grid-row">
                                <div class="input-group half-width-field">
                                    <label for="nomeExercicio">Nome do Exercício</label>
                                    <input type="text" id="nomeExercicio" value="Rosca">
                                </div>
                                <div class="input-group half-width-field">
                                    <label for="linkVideo">Link</label>
                                    <input type="url" id="linkVideo"
                                        value="https://youtu.be/nC-US9v0hz8?si=3JSXeeklb9ICMKh">
                                </div>
                            </div>


                            <div class="input-group-grid-row">
                                <div class="input-group half-width-field">
                                    <label for="categoria">Categoria</label>
                                    <select id="tipoTreino">
                                        <option value="1" selected>Superiores</option>
                                        <option value="2">Inferiores</option>
                                        <option value="3">Core</option>
                                        <option value="4">Cardio</option>

                                    </select>
                                </div>

                                <div class="input-group half-width-field">
                                    <label for="tipoRefeicao">Dia da Semana</label>
                                    <select id="tipoRefeicao">
                                        <option value="2" selected>Segunda-Feira</option>
                                        <option value="3">Terça-Feira</option>
                                        <option value="4">Quarta-Feira</option>
                                        <option value="5">Quinta-Feira</option>
                                        <option value="6">Sexta-Feira</option>
                                        <option value="7">Sabado</option>
                                        <option value="1">Domingo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="observacao">Observações</label>
                                <textarea id="observacao">Descanso de 15 segundos entre series</textarea>
                            </div>


                            <div class="input-group-grid-row">
                                <div class="input-group half-width-field">
                                    <label for="series">Séries</label>
                                    <input type="text" id="series" value="3x12">
                                </div>

                                <div class="input-group half-width-field peso-input-group">
                                    <label for="peso">Peso</label>
                                    <div class="peso-wrapper">
                                        <input type="number" id="peso" value="5" min="0">
                                        <span class="kg-unit">KG</span>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <button type="submit" class="btn-confirmar">Confirmar</button>
                    </div>

                    <div class="card-lista-treinos">

                        <div class="lista-header">
                            <h3 class="lista-titulo">Treinos Recomendados</h3>
                        </div>

                        <div class="lista-itens-scroll" id="listaTreinosScroll">
                            <div class="treino-item clickable-item" data-id="1" data-nome-treino="Rosca"
                                data-categoria="Superiores" data-dia="2" data-link="link1" data-obs="obs1"
                                data-series="3x12" data-peso="10">
                                <span class="treino-label">Segunda</span>
                                <span class="treino-nome">Rosca (Superiores)</span>
                                <button class="btn-excluir"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="treino-item clickable-item" data-id="2" data-nome-treino="Agachamento"
                                data-categoria="Inferiores" data-dia="4" data-link="link2" data-obs="obs2"
                                data-series="3x15" data-peso="20">
                                <span class="treino-label">Quarta</span>
                                <span class="treino-nome">Agachamento (Inferiores)</span>
                                <button class="btn-excluir"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="treino-item clickable-item" data-id="3" data-nome-treino="Corrida"
                                data-categoria="Cardio" data-dia="6" data-link="link3" data-obs="obs3"
                                data-series="4x10" data-peso="0">
                                <span class="treino-label">Sexta</span>
                                <span class="treino-nome">Corrida (Cardio)</span>
                                <button class="btn-excluir"><i class="fas fa-times"></i></button>
                            </div>
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
        document.addEventListener('DOMContentLoaded', function () {

            // --- MAPA PARA TRADUÇÃO DE NÚMERO PARA NOME DO DIA ---
            const diaMap = {
                '2': 'Segunda', // Respeitando a ordem do seu HTML
                '1': 'Domingo', // Corrigido a ordem para o valor (value) do HTML
                '3': 'Terça',
                '4': 'Quarta',
                '5': 'Quinta',
                '6': 'Sexta',
                '7': 'Sábado'
            };

            function getDiaName(diaValue) {
                return diaMap[diaValue] || 'Dia Indefinido';
            }

            // Elementos principais
            const listaItensScroll = document.getElementById('listaTreinosScroll');
            const confirmButton = document.querySelector('.btn-confirmar');
            const exercicioForm = document.querySelector('.exercicio-form');
            const btnAdicionarTreino = document.querySelector('.btn-adicionar-treino');

            // IDs para os campos do formulário (Bloco Único e Completo)
            const nomeExercicioInput = document.getElementById('nomeExercicio');
            const observacaoTextarea = document.getElementById('observacao');
            const linkVideoInput = document.getElementById('linkVideo');
            // Observação: 'categoria' e 'tipoRefeicao' (Dia da Semana) não existem no HTML,
            // mas vamos tentar usar os IDs disponíveis: 'categoria' e 'tipoRefeicao'
            const categoriaInput = document.getElementById('categoria');
            const diaSemanaSelect = document.getElementById('tipoRefeicao');
            const seriesInput = document.getElementById('series');
            const pesoInput = document.getElementById('peso');

            // Variável de controle para o modo de edição
            let currentEditingItem = null;

            // --- FUNÇÃO PARA RESETAR O FORMULÁRIO E O MODO ---
            function resetForm() {
                exercicioForm.reset();
                nomeExercicioInput.value = 'Rosca';
                observacaoTextarea.value = 'Descanso de 15 segundos entre series';
                linkVideoInput.value = 'https://youtu.be/nC-US9v0hz8?si=3JSXeeklb9ICMKh';
                categoriaInput.value = 'Superiores';
                diaSemanaSelect.value = '2';
                seriesInput.value = '3x12';
                pesoInput.value = '5';
                document.querySelector('.cliente-nome').textContent = '(Nome do Cliente)';
                currentEditingItem = null;
            }

            // --- FUNÇÃO PARA ADICIONAR EVENT LISTENERS (USADA NA CRIAÇÃO E CARREGAMENTO INICIAL) ---
            function attachEventListeners(itemElement) {
                // 1. Exclusão
                const excluirBtn = itemElement.querySelector('.btn-excluir');
                if (excluirBtn) {
                    excluirBtn.addEventListener('click', function (e) {
                        e.stopPropagation();
                        const nomeTreino = itemElement.querySelector('.treino-nome').textContent.trim();
                        const confirmExclusao = confirm(`Tem certeza que deseja excluir o treino "${nomeTreino}"?`);
                        if (confirmExclusao) {
                            itemElement.remove();
                            alert('Treino excluído com sucesso! (Ação simulada)');
                            if (itemElement === currentEditingItem) {
                                resetForm();
                            }
                        }
                    });
                }


                // 2. Edição (Clique no item)
                itemElement.addEventListener('click', function () {
                    currentEditingItem = this; // Define o item atual para edição

                    // Captura os dados do atributo data-*
                    const nome = this.getAttribute('data-nome-treino');
                    const link = this.getAttribute('data-link');
                    const obs = this.getAttribute('data-obs');
                    const categoria = this.getAttribute('data-categoria');
                    const dia = this.getAttribute('data-dia');
                    const series = this.getAttribute('data-series');
                    const peso = this.getAttribute('data-peso');

                    // Preenche o formulário
                    nomeExercicioInput.value = nome || '';
                    observacaoTextarea.value = obs || '';
                    linkVideoInput.value = link || '';
                    categoriaInput.value = categoria || 'Superiores';
                    diaSemanaSelect.value = dia || '2';
                    seriesInput.value = series || '';
                    pesoInput.value = peso || '';

                    document.querySelector('.cliente-nome').textContent = `(Editando Exercício: ${nome})`;
                });
            }

            // Anexar listeners aos itens existentes ao carregar
            document.querySelectorAll('.treino-item.clickable-item').forEach(attachEventListeners);

            // --- AÇÃO DE CONFIRMAR (Edição/Criação) ---
            confirmButton.addEventListener('click', function (e) {
                e.preventDefault();

                const nomeExercicio = nomeExercicioInput.value.trim();
                const observacao = observacaoTextarea.value.trim();
                const linkVideo = linkVideoInput.value.trim();
                const categoria = categoriaInput.value.trim();
                const dia = diaSemanaSelect.value;
                const diaDisplayName = getDiaName(dia);
                const series = seriesInput.value.trim();
                const peso = pesoInput.value.trim();

                let message;

                if (currentEditingItem === null) {
                    // === AÇÃO DE CRIAÇÃO (Novo Treino ou Exercício) ===

                    const novoItem = document.createElement('div');
                    const novoId = listaItensScroll.children.length + 1;

                    const novoTreinoNome = nomeExercicio || categoria;

                    novoItem.className = 'treino-item clickable-item';
                    novoItem.setAttribute('data-id', novoId);
                    novoItem.setAttribute('data-nome-treino', novoTreinoNome);
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

                    message = `Novo exercício '${novoTreinoNome}' cadastrado com sucesso!`;

                    // Não reseta automaticamente para manter o foco
                    // resetForm(); 

                } else {
                    // Lógica de Edição: Atualiza os atributos do item da lista

                    currentEditingItem.setAttribute('data-nome-treino', nomeExercicio);
                    currentEditingItem.setAttribute('data-categoria', categoria);
                    currentEditingItem.setAttribute('data-dia', dia);
                    currentEditingItem.setAttribute('data-link', linkVideo);
                    currentEditingItem.setAttribute('data-obs', observacao);
                    currentEditingItem.setAttribute('data-series', series);
                    currentEditingItem.setAttribute('data-peso', peso);

                    // Atualiza o nome exibido na lista com o nome do dia por extenso
                    currentEditingItem.querySelector('.treino-label').textContent = diaDisplayName;
                    currentEditingItem.querySelector('.treino-nome').textContent = `${nomeExercicio} (${categoria})`;

                    message = `Exercício '${nomeExercicio}' atualizado com sucesso!`;
                    // resetForm();
                }

                alert('Ação registrada: ' + message);
            });

            // --- Funcionalidade do Botão Adicionar (+) ---
            btnAdicionarTreino.addEventListener('click', function () {
                resetForm();
                document.querySelector('.cliente-nome').textContent = '(Cadastrando Novo Exercício)';
                alert('Pronto para cadastrar um novo exercício!');
            });
        });
    </script>
</body>

</html>