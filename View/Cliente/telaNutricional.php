<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutricional</title>
    <link rel="stylesheet" href="../../public/css/telaNutricional.css">
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
                                <a href="telaInicial.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="active">Nutricional</a>
                            </li>
                            <li class="nav-item">
                                <a href="telaTreinos.php">Treinos</a>
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
                        <div class="cardVerPerfil"> </div>
                        <div class="textocardVerPerfil"> Ver perfil</div>
                    </div>
                </div>

                <div class="cards-refeicoes-container">

                    <div class="card-refeicoes card-refeicoes-geral">
                        <h3 class="card-titulo-refeicao">Refeições Geral</h3>

                        <div class="item-refeicao clickable-refeicao" data-horario="6h30" data-tipo="Ao acordar" data-detalhes="Beba 500ml de água, 1 copo de suco de limão.">
                            <span class="horario">6h30</span>
                            <span class="nome-refeicao">Ao acordar</span>
                        </div>
                        <div class="item-refeicao clickable-refeicao" data-horario="7h00" data-tipo="Café da Manhã" data-detalhes="Ovos mexidos com 2 fatias de pão integral e café sem açúcar.">
                            <span class="horario">7h00</span>
                            <span class="nome-refeicao">Café da Manhã</span>
                        </div>
                        <div class="item-refeicao clickable-refeicao" data-horario="10h00" data-tipo="Lanche da Manhã" data-detalhes="1 Maçã e 1 punhado de castanhas.">
                            <span class="horario">10h00</span>
                            <span class="nome-refeicao">Lanche da Manhã</span>
                        </div>
                        <div class="item-refeicao item-hidratacao clickable-refeicao" data-horario="7h - 13h" data-tipo="Hidratação" data-detalhes="Beber 1,5 litro de água neste período.">
                            <span class="horario">7h - 13h</span>
                            <span class="nome-refeicao">Hidratação</span>
                        </div>
                    </div>

                    <div class="card-refeicoes card-refeicoes-livre">
                        <h3 class="card-titulo-refeicao">Refeições livre</h3>

                        <div class="item-refeicao clickable-refeicao" data-horario="8h00" data-tipo="Ao acordar" data-detalhes="Suplemento pré-treino.">
                            <span class="horario">8h00</span>
                            <span class="nome-refeicao">Ao acordar</span>
                        </div>
                        <div class="item-refeicao clickable-refeicao" data-horario="8h30" data-tipo="Café da Manhã" data-detalhes="Pode escolher entre: tapioca com queijo ou panqueca de banana.">
                            <span class="horario">8h30</span>
                            <span class="nome-refeicao">Café da Manhã</span>
                        </div>
                        <div class="item-refeicao clickable-refeicao" data-horario="10h30" data-tipo="Lanche da Manhã" data-detalhes="Iogurte natural com granola.">
                            <span class="horario">10h30</span>
                            <span class="nome-refeicao">Lanche da Manhã</span>
                        </div>
                        <div class="item-refeicao item-hidratacao clickable-refeicao" data-horario="9h - 13h" data-tipo="Hidratação" data-detalhes="Beber 1 litro de água neste período.">
                            <span class="horario">9h - 13h</span>
                            <span class="nome-refeicao">Hidratação</span>
                        </div>
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
    const filterLinks = dropdownContent.querySelectorAll('a');
    const allItems = document.querySelectorAll('.item-refeicao:not(.item-hidratacao)'); // Exclui hidratação para a lógica de hora simples

    // Mapeamento dos períodos com base na hora de início da refeição (00h a 24h)
    const PERIOD_MAP = {
        'Manhã': { min: 3, max: 11.5 }, // 03:00 a 11:30
        'Tarde': { min: 11.5, max: 17.5 }, // 11:30 a 17:30
        'Noite': { min: 17.5, max: 2.9 } // 17:30 a 02:59
    };
    
    // Função auxiliar para converter o horário (ex: "7h00") para um número decimal (ex: 7.00)
    function parseTime(timeString) {
        if (!timeString) return 0;
        
        // Remove a letra 'h' e substitui ':' por '.'
        const numericTime = timeString.toLowerCase().replace('h', '.').split(' ')[0];
        
        // Se for um range (ex: 7h - 13h), pegamos a primeira hora para determinar o período
        const firstHour = numericTime.split('-')[0];
        
        return parseFloat(firstHour);
    }
    
    // Função principal para aplicar o filtro
    function applyFilter(periodo) {
        // Atualiza o texto do botão de filtro
        periodoBtn.innerHTML = `${periodo} <span class="dropdown-arrow">▼</span>`;
        
        const { min, max } = PERIOD_MAP[periodo];

        allItems.forEach(item => {
            const horarioStr = item.querySelector('.horario').textContent;
            const itemHour = parseTime(horarioStr);
            
            let isVisible = false;

            if (periodo === 'Todos') {
                // Caso especial para mostrar tudo (Se você adicionar essa opção)
                isVisible = true;
            } else if (periodo === 'Noite') {
                // Lógica especial para a noite (que atravessa a meia-noite)
                isVisible = itemHour >= min || itemHour <= max;
            } else {
                // Lógica para Manhã e Tarde
                isVisible = itemHour >= min && itemHour < max;
            }

            // A lógica de hidratação é mantida visível se estiver dentro do período
            const isHidratacao = item.classList.contains('item-hidratacao');
            const isHidratacaoVisible = isHidratacao && (itemHour >= min && itemHour < max) || isHidratacao && periodo === 'Noite';

            // Faz o item aparecer ou desaparecer
            if (isVisible || isHidratacaoVisible) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Adiciona o evento de clique a cada link do filtro
    filterLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const periodo = e.target.textContent.trim();
            applyFilter(periodo);
            // Fecha o dropdown após o clique
            dropdownContent.style.display = 'none';
        });
    });

    // Inicia a tela aplicando o filtro Manhã
    applyFilter('Manhã');

    // Torna o dropdown visual no clique (alterna o display)
    periodoBtn.addEventListener('click', () => {
        if (dropdownContent.style.display === 'block') {
             dropdownContent.style.display = 'none';
        } else {
             dropdownContent.style.display = 'block';
        }
    });
    
    // Fecha o dropdown se clicar fora
    window.addEventListener('click', (e) => {
        if (!periodoBtn.contains(e.target) && !dropdownContent.contains(e.target)) {
            dropdownContent.style.display = 'none';
        }
    });
});
</script>
</body>

</html>