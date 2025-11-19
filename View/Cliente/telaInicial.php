<?php
use Systemfy\App\Model\User;

/** @var User|null $user */
$user ??= null;

// Calcular valores para o dashboard
$pesoAtual = $user ? $user->getPeso() : 0;
$pesoMeta = $user ? $user->getPesoMeta() : 0;
$massa = $user ? $user->getMassa() : 0;
$gordura = $user ? $user->getGordura() : 0;

// Calcular progresso do peso (percentual de 0 a 100)
$progressoPeso = 0;
$pesoMin = 0;
$pesoMax = 0;
$pesoAtualDisplay = $pesoAtual;

if ($pesoMeta > 0 && $pesoAtual > 0) {
    // Se está ganhando peso (meta > atual)
    if ($pesoMeta > $pesoAtual) {
        $pesoMin = max(0, $pesoAtual - 10); // 10kg abaixo do atual
        $pesoMax = $pesoMeta + 5; // 5kg acima da meta
        $progressoPeso = (($pesoAtual - $pesoMin) / ($pesoMeta - $pesoMin)) * 100;
    } else {
        // Se está perdendo peso (meta < atual)
        $pesoMin = max(0, $pesoMeta - 5); // 5kg abaixo da meta
        $pesoMax = $pesoAtual + 10; // 10kg acima do atual
        $progressoPeso = (($pesoMax - $pesoAtual) / ($pesoMax - $pesoMeta)) * 100;
    }
    $progressoPeso = max(0, min(100, $progressoPeso)); // Limitar entre 0 e 100
} else {
    // Valores padrão se não houver dados
    $pesoMin = max(0, $pesoAtual - 10);
    $pesoMax = $pesoAtual + 10;
}

// Calcular percentuais
$percentualMassaCorporal = 0;
$percentualMassaMagra = 0;

if ($pesoAtual > 0) {
    // Massa Corporal (gordura corporal em %)
    if ($gordura > 0) {
        $percentualMassaCorporal = ($gordura / $pesoAtual) * 100;
    }
    
    // Massa Magra (peso - gordura)
    if ($massa > 0) {
        $percentualMassaMagra = ($massa / $pesoAtual) * 100;
    } elseif ($gordura > 0) {
        $massaMagra = $pesoAtual - $gordura;
        $percentualMassaMagra = ($massaMagra / $pesoAtual) * 100;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/telaInicial.css">
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
                                <a href="/client" class="active">Home</a>
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

                <div class="profile-box-container">
                    <a href="/client/perfil" class="profile-link">
                        <div class="cardVerPerfil"><i class="fas fa-user"></i></div>
                        <div class="textocardVerPerfil"> Ver perfil</div>
                    </a>
                </div>

                <div class="calendar-api-container">
                    <div class="calendar-header">
                        <a href="/client/agenda/save" class="btn-novo-evento">
                            <i class="fas fa-plus"></i> Criar Evento
                        </a>
                    </div>
                    <!-- 
                    IMPORTANTE: Para o calendário aparecer, você precisa:
                    1. Tornar o calendário público no Google Calendar
                    2. Ir em Configurações > Integrar calendário e copiar o código iframe
                    3. Ou usar o email do calendário diretamente (substitua SEU_EMAIL@gmail.com abaixo)
                    -->
                    <iframe class="frame_agenda" 
                        src="https://calendar.google.com/calendar/embed?src=thauanafeyth34%40gmail.com&ctz=America%2FSao_Paulo" 
                        style="border: 0" 
                        width="100%" 
                        height="100%" 
                        frameborder="0" 
                        scrolling="no">
                    </iframe>
                </div>

                <div class="cardMetaPeso">
                    <h3 class="titulo_peso"> Progresso Meta de Peso</h3>
                    
                    
                    <div class="gauge-container">
                        <div class="scale-label mid" style="color: #1E1E1E; top: 90px; font-size: 2.5em; font-weight: 700;">
                            <div><?= $pesoAtualDisplay > 0 ? number_format($pesoAtualDisplay, 1, ',', '.') : '--'; ?></div> 
                        </div>

                        <div class="gauge-bg">
                            <div class="gauge-track"></div>
                            <div class="gauge-fill" id="gauge-fill-percentual" style="transform: rotate(<?= -135 + ($progressoPeso * 2.7); ?>deg);"></div> 
                        </div>

                        <div class="scale-label min" style="font-size: 1.2em;">
                            <div><?= number_format($pesoMin, 0, ',', '.'); ?></div> 
                        </div>
                        <div class="scale-label max" style="font-size: 1.2em;">
                            <div><?= number_format($pesoMax, 0, ',', '.'); ?></div> 
                        </div>
                    </div>
                    </div>
                <div class="cardProgressoMetaPeso">
                    <h3 class="titulo_percentual"> Percentuais </h3>
                    
                    <div class="percentual-container">
                        
                        <div class="percentual-card">
                            <div class="percentual-titulo">Massa Corporal</div>
                            <div class="percentual-valor"><?= $percentualMassaCorporal > 0 ? '%' . number_format($percentualMassaCorporal, 1, ',', '.') : '--%'; ?></div>
                        </div>
                        
                        <div class="percentual-card">
                            <div class="percentual-titulo">Massa Magra</div>
                            <div class="percentual-valor"><?= $percentualMassaMagra > 0 ? '%' . number_format($percentualMassaMagra, 1, ',', '.') : '--%'; ?></div>
                        </div>
                        
                    </div>
                </div>
                </div>
        </div>
    </div>
    
    <script>
        // Atualizar o gauge com animação
        document.addEventListener('DOMContentLoaded', function() {
            const gaugeFill = document.getElementById('gauge-fill-percentual');
            if (gaugeFill) {
                const progresso = <?= $progressoPeso; ?>;
                // A rotação já está definida no PHP, mas podemos adicionar animação
                const rotation = -135 + (progresso * 2.7);
                gaugeFill.style.transition = 'transform 1s ease-out';
                gaugeFill.style.transform = `rotate(${rotation}deg)`;
            }
        });
    </script>
</body>

</html>
