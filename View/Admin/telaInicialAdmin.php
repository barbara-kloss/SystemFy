<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Administrador</title>
    <link rel="stylesheet" href="/css/telaInicialAdmin.css">
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
            <img src="/imgFy/logoSemfundoEscritaBranca.png" alt="Logo FY">
        </div>

        <!-- <div class="logoWhatsApp">
            <img src="/imgFy/whatsapp (3).png" alt="logoWhatsApp">
        </div> -->

        <div class="fundoSemiTransparente">

            <div class="main-content-grid">

                <div class="navBar">
                    <nav>
                        <ul class="navbar-nav">
                            <li class="nav-item"><a href="/admin" class="active">Home</a></li>
                            <li class="nav-item"><a href="/admin/menu/list">Nutricional</a></li>
                            <li class="nav-item"><a href="/admin/exercise/list">Treinos</a></li>
                            <li class="nav-item"><a href="/cadastro">Clientes</a></li>
                            <li class="nav-item"><a href="/admin/report/list">Relatorios</a></li>
                            <li class="nav-item"><a href="/admin/plano/list">Planos</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="profile-box-container">
                    <a href="/admin/cadastro"class="profile-link">
                        <div class="cardVerPerfil"><i class="fas fa-user"></i></div>
                        <div class="textocardVerPerfil"> Ver perfil</div>
                    </a>
                </div>

                <div class="calendar-api-container">
                    <!-- 
                    IMPORTANTE: Para o calendário aparecer, você precisa:
                    1. Tornar o calendário público no Google Calendar
                    2. Ir em Configurações > Integrar calendário e copiar o código iframe
                    3. Ou usar o email do calendário diretamente (substitua SEU_EMAIL@gmail.com abaixo)
                    -->
                    <iframe class="frame_agenda" 
                        src="https://calendar.google.com/calendar/embed?height=600&wkst=1&ctz=America%2FSao_Paulo&showPrint=0&mode=WEEK&src=thauanafeyth34%40gmail.com&color=%23039be5" 
                        style="border-width:0" 
                        width="100%" 
                        height="100%" 
                        frameborder="0" 
                        scrolling="no">
                    </iframe>
                </div>

                <div class="clientes-ativos-card">
                    <h2 class="card-title">Clientes Ativos</h2>
                    <p class="active-count">15</p>
                </div>

                <div class="notifications-container">
                    <h2 class="card-title">Notificações</h2>

                    <div id="notifications-list" class="dynamic-notifications-list">
                        </div>

                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // FUNÇÃO QUE CRIA E INSERE O HTML DAS NOTIFICAÇÕES
            function loadNotifications(data) {
                const listContainer = document.getElementById('notifications-list');

                listContainer.innerHTML = '';

                if (data.length === 0) {
                    listContainer.innerHTML = '<p class="cal-text" style="text-align: center;">Nenhuma notificação recente.</p>';
                    return;
                }

                data.forEach(notification => {
                    const item = document.createElement('div');
                    item.className = 'notification-item';

                    item.innerHTML = `
                        <span class="client-name">${notification.nome}</span>
                        <span class="notification-text">Registrou check-in em ${notification.treino}</span>
                    `;

                    listContainer.appendChild(item);
                });
            }

            // SIMULAÇÃO DE DADOS DO BANCO DE DADOS
            const notificationsFromDB = [
                { nome: "Shreck", treino: "Treino Superiores" },
                { nome: "Fiona", treino: "Cárdio Intenso" },
                { nome: "Gato de Botas", treino: "Yoga Matinal" }
            ];

            loadNotifications(notificationsFromDB);
        });
    </script>


</body>

</html>