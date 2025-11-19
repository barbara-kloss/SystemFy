<?php 
$feedback = isset($_GET['sucesso']) ? (int)$_GET['sucesso'] : null;
$erro = isset($_GET['erro']) ? $_GET['erro'] : null;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Login - Usuário</title>
    <link rel="stylesheet" href="css/LoginGeral.css">
    <link rel="stylesheet" href="/css/notifications.css">
    <script src="/js/notifications.js"></script>
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
                <form action="/login" method="POST" id="login-form">
                    <h1>Login</h1>
                    <input type="email" placeholder="E-mail" name="email" id="email" value="<?= isset($_GET['email']) ? htmlspecialchars($_GET['email']) : (isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''); ?>" required autocomplete="email" autofocus>
                    <input type="password" placeholder="Senha" name="senha" id="senha" value="" required autocomplete="current-password">
                    <a href="/criar-senha" class="forgot">Criar/Redefinir Senha</a>
                    <button type="submit"> Entrar </button>
                    <?php if ($feedback === 0): ?>
                        <div class="error-message" id="error-message">
                            ❌ <?= $erro ? htmlspecialchars($erro) : 'Email ou senha incorretos. Tente novamente.'; ?>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        // Garantir que o formulário funcione após erros
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('login-form');
            const emailInput = document.getElementById('email');
            const senhaInput = document.getElementById('senha');
            
            // Limpar mensagem de erro após começar a digitar
            const errorMessage = document.getElementById('error-message');
            if (emailInput && errorMessage) {
                emailInput.addEventListener('input', function() {
                    errorMessage.style.opacity = '0.5';
                });
            }
            
            if (senhaInput && errorMessage) {
                senhaInput.addEventListener('input', function() {
                    errorMessage.style.opacity = '0.5';
                });
            }
            
            // Validação antes de enviar
            if (form) {
                form.addEventListener('submit', function(e) {
                    const email = emailInput.value.trim();
                    const senha = senhaInput.value.trim();
                    
                    // Remover qualquer mensagem de erro anterior
                    if (errorMessage) {
                        errorMessage.style.display = 'none';
                    }
                    
                    if (!email) {
                        e.preventDefault();
                        showToast('Por favor, digite seu email', 'warning', 3000);
                        emailInput.focus();
                        return false;
                    }
                    
                    if (!senha) {
                        e.preventDefault();
                        showToast('Por favor, digite sua senha', 'warning', 3000);
                        senhaInput.focus();
                        return false;
                    }
                    
                    // Permitir envio normal
                    return true;
                });
            }
            
            // Focar no campo de senha se houver erro e email já preenchido
            <?php if ($feedback === 0 && isset($_GET['email'])): ?>
            if (senhaInput) {
                setTimeout(function() {
                    senhaInput.focus();
                }, 100);
            }
            <?php endif; ?>
        });
    </script>
</body>
</html>