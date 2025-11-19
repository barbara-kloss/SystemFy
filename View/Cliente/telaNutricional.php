<?php
use Systemfy\App\Model\Menu;

/** @var Menu[] $menuList */
$menuList ??= [];

function getCategoriaNome(int $id): string {
    return $id == 1 ? 'Geral' : 'Livre';
}

function formatarHorario(?string $horario): string {
    if (!$horario) return '';
    $parts = explode(':', $horario);
    if (count($parts) >= 2) {
        return $parts[0] . 'h' . $parts[1];
    }
    return $horario;
}

// Separar menus por categoria
$menusGeral = array_filter($menuList, fn($m) => $m instanceof Menu && $m->categoria == 1);
$menusLivre = array_filter($menuList, fn($m) => $m instanceof Menu && $m->categoria == 2);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutricional</title>
    <link rel="stylesheet" href="/css/telaNutricional.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Alata&family=Akshar:wght@700&display=swap" rel="stylesheet">
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

        <div class="logoutCantoInferior">
            <a href="/logout" class="logout-link">
                <div class="cardLogout"><i class="fas fa-sign-out-alt"></i></div>
            </a>
        </div>
        
        <!-- <div class="logoWhatsApp">
            <img src="/imgFy/whatsapp (3).png" alt="logoWhatsApp">
        </div> -->
        
        <div class="fundoSemiTransparente">
            <div class="main-content-grid">

                <div class="navBar">
                    <nav>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="/client">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="/client/menu/list" class="active">Nutricional</a>
                            </li>
                            <li class="nav-item">
                                <a href="/client/exercise/list">Treinos</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="header-right-container">
                    <div class="seletor-periodo">
                        <div class="periodo-btn">
                            Manhã
                            <span class="dropdown-arrow">▼</span>
                        </div>

                        <div class="dropdown-content">
                            <a href="#">Manhã</a>
                            <a href="#">Tarde</a>
                            <a href="#">Noite</a>
                        </div>
                    </div>
                    <div class="profile-box-container">
                        <a href="/client/perfil" class="profile-link">
                            <div class="cardVerPerfil"><i class="fas fa-user"></i></div>
                            <div class="textocardVerPerfil"> Ver perfil</div>
                        </a>
                    </div>
                </div>

                <div class="cards-refeicoes-container">

                    <div class="card-refeicoes card-refeicoes-geral">
                        <h3 class="card-titulo-refeicao">Refeições Geral</h3>

                        <?php if (count($menusGeral) === 0): ?>
                            <div class="item-refeicao">
                                <span class="nome-refeicao" style="color: #999;">Nenhuma refeição cadastrada</span>
                            </div>
                        <?php else: ?>
                            <?php foreach ($menusGeral as $menu): ?>
                                <?php if (!$menu instanceof Menu) { continue; } ?>
                                <?php 
                                    $horarioFormatado = formatarHorario($menu->horario);
                                    $detalhes = $menu->observacao ? htmlspecialchars($menu->observacao) : 'Sem observações.';
                                ?>
                                <div class="item-refeicao clickable-refeicao" 
                                     data-horario="<?= htmlspecialchars($horarioFormatado); ?>" 
                                     data-tipo="<?= htmlspecialchars($menu->titulo ?? ''); ?>" 
                                     data-detalhes="<?= htmlspecialchars($detalhes); ?>">
                                    <span class="horario"><?= htmlspecialchars($horarioFormatado); ?></span>
                                    <span class="nome-refeicao"><?= htmlspecialchars($menu->titulo ?? ''); ?></span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="card-refeicoes card-refeicoes-livre">
                        <h3 class="card-titulo-refeicao">Refeições livre</h3>

                        <?php if (count($menusLivre) === 0): ?>
                            <div class="item-refeicao">
                                <span class="nome-refeicao" style="color: #999;">Nenhuma refeição cadastrada</span>
                            </div>
                        <?php else: ?>
                            <?php foreach ($menusLivre as $menu): ?>
                                <?php if (!$menu instanceof Menu) { continue; } ?>
                                <?php 
                                    $horarioFormatado = formatarHorario($menu->horario);
                                    $detalhes = $menu->observacao ? htmlspecialchars($menu->observacao) : 'Sem observações.';
                                ?>
                                <div class="item-refeicao clickable-refeicao" 
                                     data-horario="<?= htmlspecialchars($horarioFormatado); ?>" 
                                     data-tipo="<?= htmlspecialchars($menu->titulo ?? ''); ?>" 
                                     data-detalhes="<?= htmlspecialchars($detalhes); ?>">
                                    <span class="horario"><?= htmlspecialchars($horarioFormatado); ?></span>
                                    <span class="nome-refeicao"><?= htmlspecialchars($menu->titulo ?? ''); ?></span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="modalDetalhes" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2 id="modalTitulo"></h2>
            <p id="modalHorario"></p>
            <div class="modal-body">
                <p class="modal-label">Detalhes da Refeição:</p>
                <p id="modalDetalhesRefeicao"></p>
            </div>
        </div>
    </div>
    
    <!-- <script src="telaNutricional.js"></script> -->

    <script>
     document.addEventListener('DOMContentLoaded', () => {
    // === LÓGICA DA MODAL (MANTIDA) ===
    const modal = document.getElementById('modalDetalhes');
    const closeButton = document.querySelector('.close-button');
    const modalTitulo = document.getElementById('modalTitulo');
    const modalHorario = document.getElementById('modalHorario');
    const modalDetalhesRefeicao = document.getElementById('modalDetalhesRefeicao');
    const refeicaoItems = document.querySelectorAll('.clickable-refeicao');

    refeicaoItems.forEach(item => {
        item.addEventListener('click', () => {
            const horario = item.getAttribute('data-horario');
            const tipo = item.getAttribute('data-tipo');
            const detalhes = item.getAttribute('data-detalhes');
            
            modalTitulo.textContent = tipo;
            modalHorario.textContent = `Horário: ${horario}`;
            modalDetalhesRefeicao.textContent = detalhes;
            
            modal.style.display = 'flex';
        });
    });

    closeButton.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });

    // === LÓGICA DO FILTRO POR HORÁRIO (NOVA) ===
    const periodoBtn = document.querySelector('.periodo-btn');
    const dropdownContent = document.querySelector('.dropdown-content');
    const filterLinks = dropdownContent ? dropdownContent.querySelectorAll('a') : [];
    const allItems = document.querySelectorAll('.item-refeicao:not(.item-hidratacao)'); // Exclui hidratação para a lógica de hora simples
    
    // Verificar se os elementos existem
    if (!periodoBtn || !dropdownContent || filterLinks.length === 0) {
        console.warn('Elementos do filtro de período não encontrados');
    }

    // Mapeamento dos períodos com base na hora de início da refeição (00h a 24h)
    const PERIOD_MAP = {
        'Manhã': { min: 3, max: 11.5 }, // 03:00 a 11:30
        'Tarde': { min: 11.5, max: 17.5 }, // 11:30 a 17:30
        'Noite': { min: 17.5, max: 2.9 } // 17:30 a 02:59
    };
    
    // Função auxiliar para converter o horário (ex: "7h48" ou "18:48") para um número decimal (ex: 7.8 ou 18.8)
    function parseTime(timeString) {
        if (!timeString) return 0;
        
        // Remove espaços e converte para minúsculas
        let time = timeString.trim().toLowerCase();
        
        // Se já estiver no formato "HH:MM", converter para decimal
        if (time.includes(':')) {
            const parts = time.split(':');
            const hours = parseFloat(parts[0]) || 0;
            const minutes = parseFloat(parts[1]) || 0;
            return hours + (minutes / 60);
        }
        
        // Se estiver no formato "7h48" ou "18h48"
        if (time.includes('h')) {
            const parts = time.split('h');
            const hours = parseFloat(parts[0]) || 0;
            const minutes = parseFloat(parts[1]) || 0;
            return hours + (minutes / 60);
        }
        
        // Se for um range (ex: 7h - 13h), pegamos a primeira hora
        if (time.includes('-')) {
            const firstHour = time.split('-')[0].trim();
            return parseTime(firstHour);
        }
        
        // Tentar parse direto
        return parseFloat(time) || 0;
    }
    
    // Função principal para aplicar o filtro
    function applyFilter(periodo) {
        if (!periodoBtn) return;
        
        // Atualiza o texto do botão de filtro
        periodoBtn.innerHTML = `${periodo} <span class="dropdown-arrow">▼</span>`;
        
        const periodConfig = PERIOD_MAP[periodo];
        if (!periodConfig) {
            console.warn('Período não encontrado:', periodo);
            return;
        }
        
        const { min, max } = periodConfig;

        allItems.forEach(item => {
            const horarioElement = item.querySelector('.horario');
            if (!horarioElement) return;
            
            const horarioStr = horarioElement.textContent.trim();
            const itemHour = parseTime(horarioStr);
            
            let isVisible = false;

            if (periodo === 'Todos') {
                // Caso especial para mostrar tudo
                isVisible = true;
            } else if (periodo === 'Noite') {
                // Lógica especial para a noite (que atravessa a meia-noite)
                // Noite: 17:30 (17.5) até 02:59 (2.98)
                isVisible = itemHour >= min || itemHour <= max;
            } else {
                // Lógica para Manhã e Tarde
                isVisible = itemHour >= min && itemHour < max;
            }

            // A lógica de hidratação é mantida visível se estiver dentro do período
            const isHidratacao = item.classList.contains('item-hidratacao');
            let isHidratacaoVisible = false;
            if (isHidratacao) {
                if (periodo === 'Noite') {
                    isHidratacaoVisible = itemHour >= min || itemHour <= max;
                } else {
                    isHidratacaoVisible = itemHour >= min && itemHour < max;
                }
            }

            // Faz o item aparecer ou desaparecer
            if (isVisible || isHidratacaoVisible) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Adiciona o evento de clique a cada link do filtro
    if (filterLinks.length > 0) {
        filterLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const periodo = e.target.textContent.trim();
                applyFilter(periodo);
                // Fecha o dropdown após o clique
                if (dropdownContent) {
                    dropdownContent.style.display = 'none';
                }
            });
        });
    }

    // Inicia a tela aplicando o filtro Manhã
    if (periodoBtn && allItems.length > 0) {
        applyFilter('Manhã');
    }

    // Torna o dropdown visual no clique (alterna o display)
    if (periodoBtn && dropdownContent) {
        periodoBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            if (dropdownContent.style.display === 'block') {
                dropdownContent.style.display = 'none';
            } else {
                dropdownContent.style.display = 'block';
            }
        });
        
        // Fecha o dropdown se clicar fora
        window.addEventListener('click', (e) => {
            if (periodoBtn && dropdownContent && 
                !periodoBtn.contains(e.target) && 
                !dropdownContent.contains(e.target)) {
                dropdownContent.style.display = 'none';
            }
        });
    }
});
</script>
</body>

</html>