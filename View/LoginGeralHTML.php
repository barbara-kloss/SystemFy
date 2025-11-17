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
                <img src="/public/imgFy/logoSemfundoEscritaBranca.png" alt="Logo" class="logo">
            </div>

            <div class="login-box">
                <form action="" method="POST">
                    <h1>Login</h1>
                    <input type="email" placeholder="E-mail" name="email">
                    <input type="password" placeholder="Senha" name="password">
                    <a href="/admin" class="forgot">Esqueci a senha</a>
                    <button type="submit"> Entrar </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>