<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="/css/telaPerfilAdmin.css">
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


                <div class="profile-box-container">

                    <label for="profileImageUpload" class="cardVerPerfil">
                        <img id="profileImage" src="<?= !empty($user->getFoto()) ? htmlspecialchars($user->getFoto()) : '' ?>" alt="Foto de Perfil">
                        <i class="fas fa-pencil-alt edit-icon" id="lapis"></i>
                    </label>

                    <input type="file" id="profileImageUpload" accept="image/*" style="display: none;">

                    <div class="profile-field">
                        <div class="minicardNometit"> Nome completo </div>
                        <div class="minicardNome"> <?= htmlspecialchars($user->getNome()) ?> </div>
                    </div>

                    <div class="profile-field">
                        <div class="minicardEmailtit"> E-mail </div>
                        <div class="minicarEmail"> <?= htmlspecialchars($user->getEmail()) ?> </div>
                    </div>

                    <button class="bt_editar"> Editar Perfil </button>

                </div>


                <div class="dashboard-area">
                    <h2 class="area-title"> Atividade Recente do Sistema</h2>
                    
                    <div class="recent-actions-container">
                        <div class="action-item">
                            <i class="fas fa-user-check icon-log success"></i>
                            <p class="action-text">Cliente **Maria Souza** adicionado ao plano **Premium**.</p>
                            <span class="action-time">2 minutos atrás</span>
                        </div>
                        <div class="action-item">
                            <i class="fas fa-dumbbell icon-log info"></i>
                            <p class="action-text">Treino **Glúteos Avançado** foi criado e salvo como modelo.</p>
                            <span class="action-time">1 hora atrás</span>
                        </div>
                        <div class="action-item">
                            <i class="fas fa-sign-out-alt icon-log default"></i>
                            <p class="action-text">Logout automático por inatividade do sistema.</p>
                            <span class="action-time">Ontem, 18:30h</span>
                        </div>
                        <div class="action-item">
                            <i class="fas fa-chart-line icon-log info"></i>
                            <p class="action-text">Gerou Relatório de Desempenho do mês de **Outubro**.</p>
                            <span class="action-time">1 semana atrás</span>
                        </div>
                        <div class="action-item">
                            <i class="fas fa-utensils icon-log info"></i>
                            <p class="action-text">Dieta de **João Silva** foi atualizada e enviada.</p>
                            <span class="action-time">3 semanas atrás</span>
                        </div>
                        <div class="action-item">
                            <i class="fas fa-user-plus icon-log success"></i>
                            <p class="action-text">Novo cliente **Pedro Almeida** se cadastrou.</p>
                            <span class="action-time">1 mês atrás</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageUploadInput = document.getElementById('profileImageUpload');
            const profileImage = document.getElementById('profileImage');
            const editIcon = document.getElementById('lapis');

            // 1. Funcionalidade de clique no ícone
            editIcon.addEventListener('click', function(e) {
                e.preventDefault();
                imageUploadInput.click();
            });

            // 2. Pré-visualização da imagem
            imageUploadInput.addEventListener('change', function(event) {
                const file = event.target.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        profileImage.src = e.target.result;
                        profileImage.style.display = 'block';
                    }

                    reader.readAsDataURL(file);
                }
            });

            // 3. Ocultar fundo inicial se não houver imagem
            if (!profileImage.src || profileImage.src === window.location.href) {
                profileImage.style.display = 'none';
            }
        });
    </script>
</body>

</html>