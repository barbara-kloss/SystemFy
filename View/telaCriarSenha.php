<?php 
$feedback = isset($_GET['sucesso']) ? (int)$_GET['sucesso'] : null;
$erro = isset($_GET['erro']) ? $_GET['erro'] : null;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Tela Criar Senha</title>
    <link rel="stylesheet" href="/css/telaCriarSenha.css">
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
            
            <div class="login-box">
                <h1>Criar Senha</h1>
                
                <?php if ($feedback !== null): ?>
                    <div style="
                        margin-bottom: 15px;
                        padding: 12px;
                        border-radius: 8px;
                        background: <?= $feedback === 1 ? '#d4edda' : '#f8d7da'; ?>;
                        border: 1px solid <?= $feedback === 1 ? '#c3e6cb' : '#f5c6cb'; ?>;
                        color: <?= $feedback === 1 ? '#155724' : '#721c24'; ?>;
                        font-weight: bold;
                    ">
                        <?php if ($feedback === 1): ?>
                            ✓ Senha criada com sucesso!
                        <?php else: ?>
                            ✗ <?= $erro ? htmlspecialchars($erro) : 'Erro ao criar senha'; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="/criar-senha" id="senha-form">
                    <input type="password" name="senha" id="senha" placeholder="Digite aqui a nova senha" required minlength="6">
                    <input type="password" name="senha_confirmar" id="senha_confirmar" placeholder="Repita a senha" required minlength="6">
                    <div id="senha-match" style="display: none; color: #721c24; font-size: 14px; margin: -10px 0 10px 0;">
                        As senhas não coincidem
                    </div>
                    <button type="submit">Cadastrar</button>
                </form>
            </div>
            
            <div class="logo-box">
                <img src="/imgFy/logoSemfundoEscritaBranca.png" alt="Logo" class="logo">
            </div>

        </div>
    </div>
    
    <script>
        document.getElementById('senha-form').addEventListener('submit', function(e) {
            const senha = document.getElementById('senha').value;
            const senhaConfirmar = document.getElementById('senha_confirmar').value;
            const senhaMatch = document.getElementById('senha-match');
            
            if (senha !== senhaConfirmar) {
                e.preventDefault();
                senhaMatch.style.display = 'block';
                return false;
            }
            
            if (senha.length < 6) {
                e.preventDefault();
                showToast('A senha deve ter no mínimo 6 caracteres', 'warning', 3000);
                return false;
            }
            
            senhaMatch.style.display = 'none';
        });
        
        document.getElementById('senha_confirmar').addEventListener('input', function() {
            const senha = document.getElementById('senha').value;
            const senhaConfirmar = this.value;
            const senhaMatch = document.getElementById('senha-match');
            
            if (senhaConfirmar.length > 0 && senha !== senhaConfirmar) {
                senhaMatch.style.display = 'block';
            } else {
                senhaMatch.style.display = 'none';
            }
        });
    </script>
</body>
</html>