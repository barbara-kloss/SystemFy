<?php

use Systemfy\App\Model\Menu;

/** @var Menu|null $menu */
/** @var Menu[] $menuList */

$menu ??= null;
$menuList ??= [];
$nomeCliente ??= '';

$feedback = filter_input(INPUT_GET, 'sucesso', FILTER_VALIDATE_INT);
$formAction = $menu ? '/admin/menu/edit' : '/admin/menu/save';

function getCategoriaNome(int $id): string {
    return $id == 1 ? 'Geral' : 'Livre';
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutricional</title>
    <link rel="stylesheet" href="/css/telaNutricionalAdmin.css">
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
                                <a href="/admin/menu/list" class="active">Nutricional</a>
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
                                <a href="/admin/plano/list">Planos</a>
                            </li>
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

                    <div class="card-edicao-refeicao">
                        <h3 class="cliente-nome">
                            <?= $menu ? 'Editar Refeição #' . htmlspecialchars((string) $menu->getId()) : 'Cadastrar Nova Refeição'; ?>
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

                        <form class="refeicao-form" method="post" action="<?= $formAction; ?>">
                            <?php if ($menu): ?>
                                <input type="hidden" name="id" value="<?= htmlspecialchars((string) $menu->getId()); ?>">
                            <?php endif; ?>

                            <div class="input-group">
                                <label for="buscaCliente">Buscar Cliente</label>
                                <div style="position: relative;">
                                    <input type="text" id="buscaCliente" placeholder="Digite o nome ou email do cliente..." 
                                        autocomplete="off" style="width: 100%; padding: 8px;"
                                        value="<?= htmlspecialchars($nomeCliente ?? ''); ?>">
                                    <input type="hidden" name="id_user" id="id_user" required
                                        value="<?= htmlspecialchars((string) ($menu->id_user ?? '')); ?>">
                                    <div id="suggestionsList" style="position: absolute; top: 100%; left: 0; right: 0; background: white; border: 1px solid #ddd; border-top: none; max-height: 200px; overflow-y: auto; z-index: 1000; display: none;"></div>
                                </div>
                            </div>

                            <div class="input-group-grid-row">
                                <div class="input-group half-width-field">
                                    <label for="tipoRefeicao">Tipo de Refeição</label>
                                    <select name="categoria" id="tipoRefeicao" required>
                                        <option value="1" <?= ($menu?->categoria ?? 1) == 1 ? 'selected' : ''; ?>>Refeições Geral</option>
                                        <option value="2" <?= ($menu?->categoria ?? 1) == 2 ? 'selected' : ''; ?>>Refeições Livre</option>
                                    </select>
                                </div>

                                <div class="input-group half-width-field">
                                    <label for="horario">Horário</label>
                                    <input type="time" name="horario" id="horario" required
                                        value="<?= $menu?->horario ?? ''; ?>">
                                </div>
                            </div>

                            <div class="input-group">
                                <label for="categoriaNome">Nome da Refeição</label>
                                <input type="text" name="titulo" id="categoriaNome" required
                                    value="<?= htmlspecialchars($menu?->titulo ?? ''); ?>">
                            </div>

                            <div class="input-group">
                                <label for="observacao">Observação</label>
                                <textarea name="observacao" id="observacao" rows="3"><?= htmlspecialchars($menu?->observacao ?? ''); ?></textarea>
                            </div>
                            
                            <button type="submit" class="btn-confirmar">
                                <?= $menu ? 'Salvar Alterações' : 'Cadastrar Refeição'; ?>
                            </button>
                        </form>
                    </div>

                    <div class="card-lista-refeicoes">
                        <div class="lista-header">
                            <h3 class="lista-titulo">Refeições cadastradas</h3>
                            <a class="btn-adicionar-refeicao" href="/admin/menu/save" title="Adicionar Nova Refeição">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>

                        <div class="lista-itens-scroll" id="listaRefeicoes">
                            <p style="padding: 24px; text-align:center; color:#555;">Selecione um cliente para ver as refeições cadastradas.</p>
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
        const listaRefeicoes = document.getElementById('listaRefeicoes');
        let searchTimeout;

        function getCategoriaNome(categoria) {
            return categoria == 1 ? 'Geral' : 'Livre';
        }

        function carregarMenus(idUser) {
            if (!idUser) {
                listaRefeicoes.innerHTML = '<p style="padding: 24px; text-align:center; color:#555;">Selecione um cliente para ver as refeições cadastradas.</p>';
                return;
            }

            listaRefeicoes.innerHTML = '<p style="padding: 24px; text-align:center; color:#555;">Carregando...</p>';

            fetch(`/admin/menu/busca-menu?id_user=${encodeURIComponent(idUser)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        console.error('Erro na busca:', data.error);
                        listaRefeicoes.innerHTML = '<p style="padding: 24px; text-align:center; color:#d32f2f;">Erro ao carregar refeições.</p>';
                        return;
                    }

                    if (data.length === 0) {
                        listaRefeicoes.innerHTML = '<p style="padding: 24px; text-align:center; color:#555;">Nenhuma refeição cadastrada para este cliente.</p>';
                        return;
                    }

                    let html = '';
                    data.forEach(item => {
                        const horario = item.horario ? item.horario.substring(0, 5) : '';
                        const titulo = (item.titulo || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                        const observacao = item.observacao ? `<span style="display: block; font-size: 0.85em; color: #666; margin-top: 4px;">${(item.observacao || '').replace(/</g, '&lt;').replace(/>/g, '&gt;')}</span>` : '';
                        html += `
                            <div class="refeicao-item">
                                <div style="flex: 1;">
                                    <span class="refeicao-horario">${horario}</span>
                                    <span class="refeicao-nome">${titulo} (${getCategoriaNome(item.categoria)})</span>
                                    ${observacao}
                                </div>
                                <div style="display: flex; gap: 8px;">
                                    <a href="/admin/menu/edit?id=${item.id}" style="padding: 4px 8px; background: #3498db; color: white; text-decoration: none; border-radius: 4px; font-size: 0.85em;">Editar</a>
                                    <a href="/admin/menu/delete?id=${item.id}" style="padding: 4px 8px; background: #e74c3c; color: white; text-decoration: none; border-radius: 4px; font-size: 0.85em;" onclick="return confirm('Tem certeza que deseja excluir esta refeição?');">Excluir</a>
                                </div>
                            </div>
                        `;
                    });
                    listaRefeicoes.innerHTML = html;
                })
                .catch(err => {
                    console.error('Erro na busca:', err);
                    listaRefeicoes.innerHTML = '<p style="padding: 24px; text-align:center; color:#d32f2f;">Erro ao carregar refeições.</p>';
                });
        }

        buscaClienteInput.addEventListener('input', function() {
            const termo = this.value.trim();
            
            clearTimeout(searchTimeout);
            
            if (termo.length < 2) {
                suggestionsList.style.display = 'none';
                idUserInput.value = '';
                carregarMenus('');
                return;
            }

            searchTimeout = setTimeout(() => {
                fetch(`/admin/menu/busca-cliente?q=${encodeURIComponent(termo)}`)
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
                                carregarMenus(cliente.id);
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

        // Carregar menus se já houver um usuário selecionado (caso de edição)
        <?php if ($menu && $menu->id_user): ?>
            carregarMenus(<?= $menu->id_user; ?>);
        <?php endif; ?>
    </script>
</body>

</html>
