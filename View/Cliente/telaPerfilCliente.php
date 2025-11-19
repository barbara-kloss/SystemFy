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
                    <img src="<?= !empty($user->getFoto()) ? htmlspecialchars($user->getFoto()) : 'https://placehold.co/60x60' ?>" alt="Usuário" class="user-avatar" />
                    <span class="user-name"><?= htmlspecialchars($user->getNome()) ?></span>
                </div>

                <div class="profile-main-content">

                    <div class="personal-data-column">

                        <div class="row-group">
                            <div class="input-group">
                                <label for="nome">Nome completo</label>
                                <input type="text" id="nome" value="<?= htmlspecialchars($user->getNome()) ?>" readonly>
                            </div>
                            <div class="input-group">
                                <label for="email">E-mail</label>
                                <input type="email" id="email" value="<?= htmlspecialchars($user->getEmail()) ?>" readonly>
                            </div>
                        </div>

                        <div class="row-group">
                            <div class="input-group">
                                <label for="genero">Gênero</label>
                                <input type="text" id="genero" value="<?= htmlspecialchars($user->getGenero() ?? '') ?>" readonly>
                            </div>
                            <div class="input-group">
                                <label for="telefone">Telefone</label>
                                <input type="text" id="telefone" value="<?= htmlspecialchars($user->getTelefone()) ?>" readonly>
                            </div>
                        </div>

                        <div class="row-group">
                            <div class="input-group">
                                <label for="data-nascimento">Data Nascimento</label>
                                <input type="text" id="data-nascimento" value="<?= htmlspecialchars($user->getDataNasc()->getDate()) ?>" readonly>
                            </div>
                            <div class="input-group">
                                <label for="plano">Plano</label>
                                <input type="text" id="plano" value="<?= $user->getPlanoId() ? htmlspecialchars($user->getPlanoId()->getCategoria()) : 'Sem plano' ?>" readonly>
                            </div>
                        </div>

                        <div class="textarea-group">
                            <label for="observacoes">Observações</label>
                            <textarea id="observacoes" readonly><?= htmlspecialchars($user->getObservacao()) ?></textarea>
                        </div>
                    </div>

                    <div class="metrics-column">

                        <label class="section-title-metrics" for="objetivo">Dados Físicos</label>

                        <?php
                        $imc = 0;
                        if ($user->getAltura() > 0 && $user->getPeso() > 0) {
                            $alturaMetros = $user->getAltura() / 100;
                            $imc = $user->getPeso() / ($alturaMetros * $alturaMetros);
                            $imc = number_format($imc, 2, '.', '');
                        }
                        ?>
                        <div class="row-group-half">
                            <div class="input-group">
                                <label for="objetivo">Objetivo</label>
                                <input type="text" id="objetivo" value="<?= htmlspecialchars($user->getObjetivo()) ?>" readonly>
                            </div>
                            <div class="input-group">
                                <label for="imc">IMC</label>
                                <input type="text" id="imc" value="<?= $imc > 0 ? $imc : '' ?>" readonly>
                            </div>
                        </div>
                        <div class="row-group-half">
                            <div class="input-group">
                                <label for="peso">Peso</label>
                                <div class="input-with-unit">
                                    <input type="text" id="peso" value="<?= $user->getPeso() > 0 ? $user->getPeso() : '' ?>" readonly>
                                    <span class="unit-label">Kg</span>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="altura">Altura</label>
                                <input type="text" id="altura" value="<?= $user->getAltura() > 0 ? number_format($user->getAltura(), 2, ',', '') : '' ?>" readonly>
                            </div>
                        </div>

                        <div class="row-group-half">
                            <div class="input-group">
                                <label for="gordura">% Gordura Corporal:</label>
                                <input type="text" id="gordura" value="<?= $user->getGordura() > 0 ? number_format($user->getGordura(), 2, ',', '') : '' ?>" readonly>
                            </div>
                            <div class="input-group">
                                <label for="massa-magra">% Massa Magra:</label>
                                <input type="text" id="massa-magra" value="<?= $user->getMassa() > 0 ? number_format($user->getMassa(), 2, ',', '') : '' ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>