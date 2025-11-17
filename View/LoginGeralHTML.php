<?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == 0): ?>
    <div style="
        background-color: #ffdddd;
        border-left: 5px solid #ff4444;
        padding: 12px;
        margin-bottom: 15px;
        color: #b30000;
        font-weight: bold;
        border-radius: 4px;
    ">
        ❌ Email ou senha incorretos. Tente novamente.
    </div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Login - Usuário</title>
    <link rel="stylesheet" href="css/LoginGeral.css">
    </head>
<body>
    <div class="background">
        <div class="bolinha bolinha1"></div>
        <div class="bolinha bolinha2"></div>
        <div class="bolinha bolinha3"></div>
        <div class="bolinha bolinha4"></div>
        <div class="bolinha bolinha5"></div>
        <div class="bolinha bolinha6"></div>

        <div class="container">
            <div class="logo-box">
                <img src="/imgFy/logoSemfundoEscritaBranca.png" alt="Logo" class="logo">
            </div>

            <div class="login-box">
                <form action="/login" method="POST">
                    <h1>Login</h1>
                    <input type="email" placeholder="E-mail" name="email" required>
                    <input type="password" placeholder="Senha" name="senha" required>
                    <a href="/admin" class="forgot">Esqueci a senha</a>
                    <button type="submit"> Entrar </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>