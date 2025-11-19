<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tela Perfil - Usuário</title>
    <link rel="stylesheet" href="/css/telaPerfilCliente.css">
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

        <div class="fundoSemiTransparente profile-screen">

            <div class="navBar">
                <nav>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/client">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="/client/menu/list">Nutricional</a>
                        </li>
                        <li class="nav-item">
                            <a href="/client/exercise/list">Treinos</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="user-profile-and-content">
                <div class="user-info">
                    <img src="https://placehold.co/60x60" alt="Usuário" class="user-avatar" />
                    <span class="user-name">Nome do Usuário</span>
                </div>

                <div class="profile-main-content">

                    <div class="personal-data-column">

                        <div class="row-group">
                            <div class="input-group">
                                <label for="nome">Nome completo</label>
                                <input type="text" id="nome" value="" readonly>
                            </div>
                            <div class="input-group">
                                <label for="email">E-mail</label>
                                <input type="email" id="email" value="" readonly>
                            </div>
                        </div>

                        <div class="row-group">
                            <div class="input-group">
                                <label for="genero">Gênero</label>
                                <div class="custom-select-wrapper">
                                    <select id="genero" disabled>
                                        <option value="" selected>Selecione</option>
                                    </select>
                                    <span class="select-arrow"></span>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="telefone">Telefone</label>
                                <input type="text" id="telefone" value="" readonly>
                            </div>
                        </div>

                        <div class="row-group">
                            <div class="input-group">
                                <label for="data-nascimento">Data Nascimento</label>
                                <input type="text" id="data-nascimento" value="" readonly>
                            </div>
                            <div class="input-group">
                                <label for="plano">Plano</label>
                                <input type="text" id="plano" value="" readonly>
                            </div>
                        </div>

                        <div class="textarea-group">
                            <label for="observacoes">Observações</label>
                            <textarea id="observacoes" readonly></textarea>
                        </div>
                    </div>

                    <div class="metrics-column">

                        <label class="section-title-metrics" for="objetivo">Dados Físicos</label>

                        <div class="row-group-half">
                            <div class="input-group">
                                <label for="objetivo">Objetivo</label>
                                <input type="text" id="objetivo" value="" readonly>
                            </div>
                            <div class="input-group">
                                <label for="imc">IMC</label>
                                <input type="text" id="imc" value="" readonly>
                            </div>
                        </div>
                        <div class="row-group-half">
                            <div class="input-group">
                                <label for="peso">Peso</label>
                                <div class="input-with-unit">
                                    <input type="text" id="peso" value="" readonly>
                                    <span class="unit-label">Kg</span>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="altura">Altura</label>
                                <input type="text" id="altura" value="" readonly>
                            </div>
                        </div>

                        <div class="row-group-half">
                            <div class="input-group">
                                <label for="gordura">% Gordura Corporal:</label>
                                <input type="text" id="gordura" value="" readonly>
                            </div>
                            <div class="input-group">
                                <label for="massa-magra">% Massa Magra:</label>
                                <input type="text" id="massa-magra" value="" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>