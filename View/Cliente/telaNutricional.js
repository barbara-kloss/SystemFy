// document.addEventListener('DOMContentLoaded', () => {
//     // 1. Obter referências para os elementos da modal
//     const modal = document.getElementById('modalDetalhes');
//     const closeButton = document.querySelector('.close-button');
//     const modalTitulo = document.getElementById('modalTitulo');
//     const modalHorario = document.getElementById('modalHorario');
//     const modalDetalhesRefeicao = document.getElementById('modalDetalhesRefeicao');
    
//     // 2. Obter todos os itens de refeição clicáveis
//     const refeicaoItems = document.querySelectorAll('.clickable-refeicao');

//     // --- LÓGICA DE ABRIR A MODAL ---
//     refeicaoItems.forEach(item => {
//         item.addEventListener('click', () => {
//             // Simulação de puxar dados do histórico da tela admin (usando data-attributes)
//             const horario = item.getAttribute('data-horario');
//             const tipo = item.getAttribute('data-tipo');
//             const detalhes = item.getAttribute('data-detalhes');
            
//             // Preencher a modal com os dados
//             modalTitulo.textContent = tipo;
//             modalHorario.textContent = `Horário: ${horario}`;
//             modalDetalhesRefeicao.textContent = detalhes;
            
//             // Mostrar a modal
//             modal.style.display = 'flex';
//         });
//     });

//     // --- LÓGICA DE FECHAR A MODAL ---
    
//     // 1. Pelo botão X
//     closeButton.addEventListener('click', () => {
//         modal.style.display = 'none';
//     });

//     // 2. Clicando fora da modal
//     window.addEventListener('click', (event) => {
//         if (event.target == modal) {
//             modal.style.display = 'none';
//         }
//     });
// });