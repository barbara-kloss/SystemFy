<?php

use Systemfy\App\Model\Exercise;

/** @var Exercise|null $exercise */
/** @var Exercise[] $exerciseList */

$exercise ??= null;
$exerciseList ??= [];
$nomeCliente ??= '';

$feedback = filter_input(INPUT_GET, 'sucesso', FILTER_VALIDATE_INT);
$formAction = $exercise ? '/admin/exercise/edit' : '/admin/exercise/save';
$categorias = ['Superiores', 'Inferiores', 'Core', 'Cardio'];
$diasSemana = [
    1 => 'Domingo',
    2 => 'Segunda-feira',
    3 => 'Terça-feira',
    4 => 'Quarta-feira',
    5 => 'Quinta-feira',
    6 => 'Sexta-feira',
    7 => 'Sábado'
];
$selectedCategoria = $exercise?->categoria ?? $categorias[0];
$selectedDia = $exercise?->dia ?? 2;
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treinos</title>
    <link rel="stylesheet" href="/css/telaPersonal.css">
    <link rel="stylesheet" href="/css/notifications.css">
    <link href="https://fonts.googleapis.com/css2?family=Alata&family=Akshar:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
                    <div class="profile-box-container">
                        <a href="/admin/cadastro" class="profile-link">
                            <div class="cardVerPerfil"> <i class="fas fa-user"></i> </div>
                            <div class="textocardVerPerfil"> Ver perfil </div>
                        </a>
                    </div>
                </div>

                <div class="content-cards-wrapper">

                    <div class="card-edicao-treino">
                        <h3 class="cliente-nome">
                            <?= $exercise ? 'Editar Exercício #' . htmlspecialchars((string) $exercise->getId()) : 'Cadastrar Novo Exercício'; ?>
                        </h3>

                        <?php if ($feedback !== null): ?>
                            <div class="alerta-feedback" style="margin-bottom: 16px; padding: 12px; border-radius: 4px; background: <?= $feedback === 1 ? '#d4edda' : '#f8d7da'; ?>;">
                                <?php if ($feedback === 1): ?>
                                    <span style="color: #155724;">✓ Operação realizada com sucesso.</span>
                                <?php else: ?>
                                    <span style="color: #721c24;">✗ Não foi possível concluir a operação.</span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <form class="exercicio-form" method="post" action="<?= $formAction; ?>">
                            <?php if ($exercise): ?>
                                <input type="hidden" name="id" value="<?= htmlspecialchars((string) $exercise->getId()); ?>">
                            <?php endif; ?>

                            <div class="input-group">
                                <label for="buscaCliente">Buscar Cliente</label>
                                <div style="position: relative;">
                                    <input type="text" id="buscaCliente" placeholder="Digite o nome ou email do cliente..." 
                                        autocomplete="off" style="width: 100%; padding: 8px;"
                                        value="<?= htmlspecialchars($nomeCliente ?? ''); ?>">
                                    <input type="hidden" name="id_user" id="id_user" required
                                        value="<?= htmlspecialchars((string) ($exercise->id_user ?? '')); ?>">
                                    <div id="suggestionsList" style="position: absolute; top: 100%; left: 0; right: 0; background: white; border: 1px solid #ddd; border-top: none; max-height: 200px; overflow-y: auto; z-index: 1000; display: none;"></div>
                                </div>
                            </div>

                            <div class="input-group">
                                <label for="nomeExercicio">Nome do Exercício</label>
                                <input name="tipo_exercicio" type="text" id="nomeExercicio" required
                                    value="<?= htmlspecialchars($exercise->tipo_exercicio ?? ''); ?>">
                            </div>

                            <div class="input-group-grid-row">
                                <div class="input-group half-width-field">
                                    <label for="categoriaSelect">Categoria</label>
                                    <select name="categoria" id="categoriaSelect" required>
                                        <?php foreach ($categorias as $categoria): ?>
                                            <option value="<?= $categoria; ?>" <?= $selectedCategoria === $categoria ? 'selected' : ''; ?>>
                                                <?= $categoria; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="input-group half-width-field">
                                    <label for="diaSemanaSelect">Dia da Semana</label>
                                    <select name="dia" id="diaSemanaSelect" required>
                                        <?php foreach ($diasSemana as $valor => $nome): ?>
                                            <option value="<?= $valor; ?>" <?= (int) $selectedDia === $valor ? 'selected' : ''; ?>>
                                                <?= $nome; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="input-group">
                                <label for="observacao">Observações</label>
                                <textarea name="observacao" id="observacao" rows="3"><?= htmlspecialchars($exercise->observacao ?? ''); ?></textarea>
                            </div>

                            <div class="input-group-grid-row">
                                <div class="input-group half-width-field">
                                    <label for="series">Séries</label>
                                    <input name="repeticao" type="text" id="series" required
                                        value="<?= htmlspecialchars((string) ($exercise->repeticao ?? '')); ?>">
                                </div>

                                <div class="input-group half-width-field peso-input-group">
                                    <label for="peso">Peso (KG)</label>
                                    <div class="peso-wrapper">
                                        <input name="peso" type="number" id="peso" step="0.5" min="0" value="<?= htmlspecialchars((string) ($exercise->peso ?? '0')); ?>">
                                        <span class="kg-unit">KG</span>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group">
                                <label for="video">Link do Vídeo</label>
                                <input name="video" type="url" id="video" placeholder="https://"
                                    value="<?= htmlspecialchars($exercise->video ?? ''); ?>">
                            </div>

                            <button type="submit" class="btn-confirmar">
                                <?= $exercise ? 'Salvar Alterações' : 'Cadastrar Exercício'; ?>
                            </button>
                        </form>
                    </div>

                    <div class="card-lista-treinos">
                        <div class="lista-header">
                            <h3 class="lista-titulo">Treinos cadastrados</h3>
                            <a class="btn-adicionar-treino" href="/admin/exercise/save" title="Adicionar Novo Treino">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>

                        <div class="lista-itens-scroll" id="listaTreinos">
                            <p style="padding: 24px; text-align:center; color:#555;">Selecione um cliente para ver os treinos cadastrados.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const buscaClienteInput = document.getElementById('buscaCliente');
        const idUserInput = document.getElementById('id_user');
        const suggestionsList = document.getElementById('suggestionsList');
        const listaTreinos = document.getElementById('listaTreinos');
        let searchTimeout;

        const diasSemana = {
            1: 'Domingo',
            2: 'Segunda-feira',
            3: 'Terça-feira',
            4: 'Quarta-feira',
            5: 'Quinta-feira',
            6: 'Sexta-feira',
            7: 'Sábado'
        };

        function formatarPeso(peso) {
            if (!peso) return '0,00';
            return parseFloat(peso).toFixed(2).replace('.', ',');
        }

        function carregarExercicios(idUser) {
            if (!idUser) {
                listaTreinos.innerHTML = '<p style="padding: 24px; text-align:center; color:#555;">Selecione um cliente para ver os treinos cadastrados.</p>';
                return;
            }

            listaTreinos.innerHTML = '<p style="padding: 24px; text-align:center; color:#555;">Carregando...</p>';

            fetch(`/admin/exercise/busca-exercise?id_user=${encodeURIComponent(idUser)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        console.error('Erro na busca:', data.error);
                        listaTreinos.innerHTML = '<p style="padding: 24px; text-align:center; color:#d32f2f;">Erro ao carregar treinos.</p>';
                        return;
                    }

                    if (data.length === 0) {
                        listaTreinos.innerHTML = '<p style="padding: 24px; text-align:center; color:#555;">Nenhum treino cadastrado para este cliente.</p>';
                        return;
                    }

                    let html = '';
                    data.forEach(item => {
                        const diaNome = diasSemana[item.dia] || item.dia;
                        const tipoExercicio = (item.tipo_exercicio || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                        const categoria = (item.categoria || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                        const repeticao = (item.repeticao || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                        html += `
                            <div class="treino-item">
                                <div style="flex: 1;">
                                    <span class="treino-label">${diaNome}</span>
                                    <span class="treino-nome">${tipoExercicio} (${categoria})</span>
                                    <span style="display: block; font-size: 0.85em; color: #666; margin-top: 4px;">
                                        Séries: ${repeticao} | 
                                        Peso: ${formatarPeso(item.peso)} kg
                                    </span>
                                </div>
                                <div style="display: flex; gap: 8px;">
                                    <a href="/admin/exercise/edit?id=${item.id}" style="padding: 4px 8px; background: #3498db; color: white; text-decoration: none; border-radius: 4px; font-size: 0.85em;">Editar</a>
                                    <a href="/admin/exercise/delete?id=${item.id}" style="padding: 4px 8px; background: #e74c3c; color: white; text-decoration: none; border-radius: 4px; font-size: 0.85em;" onclick="return confirm('Tem certeza que deseja excluir este exercício?');">Excluir</a>
                                </div>
                            </div>
                        `;
                    });
                    listaTreinos.innerHTML = html;
                })
                .catch(err => {
                    console.error('Erro na busca:', err);
                    listaTreinos.innerHTML = '<p style="padding: 24px; text-align:center; color:#d32f2f;">Erro ao carregar treinos.</p>';
                });
        }

        buscaClienteInput.addEventListener('input', function() {
            const termo = this.value.trim();
            
            clearTimeout(searchTimeout);
            
            if (termo.length < 2) {
                suggestionsList.style.display = 'none';
                idUserInput.value = '';
                carregarExercicios('');
                return;
            }

            searchTimeout = setTimeout(() => {
                fetch(`/admin/exercise/busca-cliente?q=${encodeURIComponent(termo)}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        suggestionsList.innerHTML = '';
                        if (data.error) {
                            console.error('Erro na busca:', data.error);
                            suggestionsList.style.display = 'none';
                            return;
                        }
                        if (data.length === 0) {
                            suggestionsList.style.display = 'none';
                            return;
                        }
                        
                        data.forEach(cliente => {
                            const item = document.createElement('div');
                            item.style.cssText = 'padding: 10px; cursor: pointer; border-bottom: 1px solid #eee;';
                            const nome = cliente.nome_completo || 'Sem nome';
                            const email = cliente.email || 'Sem email';
                            item.textContent = `${nome} (${email})`;
                            item.addEventListener('mouseenter', () => item.style.background = '#f0f0f0');
                            item.addEventListener('mouseleave', () => item.style.background = 'white');
                            item.addEventListener('click', () => {
                                idUserInput.value = cliente.id;
                                buscaClienteInput.value = cliente.nome_completo || cliente.email || '';
                                suggestionsList.style.display = 'none';
                                carregarExercicios(cliente.id);
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
            if (!buscaClienteInput.contains(e.target) && !suggestionsList.contains(e.target)) {
                suggestionsList.style.display = 'none';
            }
        });

        // Carregar exercícios se já houver um usuário selecionado (caso de edição)
        <?php if ($exercise && $exercise->id_user): ?>
            carregarExercicios(<?= $exercise->id_user; ?>);
        <?php endif; ?>
    </script>
</body>

</html>
