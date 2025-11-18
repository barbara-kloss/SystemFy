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

            <div class="navBar top-floating-nav">
                <nav>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/client" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="/client/menu/list" class="nav-link">Nutricional</a>
                        </li>
                        <li class="nav-item">
                            <a href="/client/exercise/list" class="nav-link active">Treinos</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="user-profile-and-content">
                <div class="user-info">
                    <img src="https://placehold.co/60x60" alt="Avatar Shrek" class="user-avatar" />
                    <span class="user-name">User</span>
                </div>

                <div class="profile-main-content">

                    <div class="personal-data-column">

                        <div class="row-group">
                            <div class="input-group">
                                <label for="nome">Nome completo</label>
                                <input type="text" id="nome" value="Shreck" readonly>
                            </div>
                            <div class="input-group">
                                <label for="email">E-mail</label>
                                <input type="email" id="email" value="shreck@gmail.com" readonly>
                            </div>
                        </div>

                        <div class="row-group">
                            <div class="input-group">
                                <label for="genero">Gênero</label>
                                <div class="custom-select-wrapper">
                                    <select id="genero" disabled>
                                        <option value="lista">Lista Suspensa</option>
                                    </select>
                                    <span class="select-arrow"></span>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="telefone">Telefone</label>
                                <input type="text" id="telefone" value="(00) 0 0000-0000" readonly>
                            </div>
                        </div>

                        <div class="row-group">
                            <div class="input-group">
                                <label for="data-nascimento">Data Nascimento</label>
                                <input type="text" id="data-nascimento" value="01/12/1600" readonly>
                            </div>
                            <div class="input-group">
                                <label for="plano">Plano</label>
                                <input type="text" id="plano" value="Premium" readonly>
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
                                <input type="text" id="objetivo" value="Ganho de Massa" readonly>
                            </div>
                            <div class="input-group">
                                <label for="imc">IMC</label>
                                <input type="text" id="imc" value="20.0" readonly>
                            </div>
                        </div>
                        <div class="row-group-half">
                            <div class="input-group">
                                <label for="peso">Peso</label>
                                <div class="input-with-unit">
                                    <input type="text" id="peso" value="50" readonly>
                                    <span class="unit-label">Kg</span>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="altura">Altura</label>
                                <input type="text" id="altura" value="1,68" readonly>
                            </div>
                        </div>

                        <div class="row-group-half">
                            <div class="input-group">
                                <label for="gordura">% Gordura Corporal:</label>
                                <input type="text" id="gordura" value="%50" readonly>
                            </div>
                            <div class="input-group">
                                <label for="massa-magra">% Massa Magra:</label>
                                <input type="text" id="massa-magra" value="%15" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>