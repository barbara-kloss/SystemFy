<?php
use Systemfy\App\Model\Exercise;

/** @var Exercise[] $exerciseList */
$exerciseList ??= [];

$diasSemana = [
    1 => 'Domingo',
    2 => 'Segunda-feira',
    3 => 'Terça-feira',
    4 => 'Quarta-feira',
    5 => 'Quinta-feira',
    6 => 'Sexta-feira',
    7 => 'Sábado'
];

// Agrupar exercícios por dia da semana
$exerciciosPorDia = [];
foreach ($exerciseList as $exercise) {
    if ($exercise instanceof Exercise && $exercise->dia) {
        $dia = (int) $exercise->dia;
        if (!isset($exerciciosPorDia[$dia])) {
            $exerciciosPorDia[$dia] = [];
        }
        $exerciciosPorDia[$dia][] = $exercise;
    }
}

// Preparar dados para JavaScript (apenas IDs e informações básicas)
$exerciciosPorDiaJS = [];
foreach ($exerciciosPorDia as $dia => $exercicios) {
    $exerciciosPorDiaJS[$dia] = array_map(function($ex) {
        return [
            'id' => $ex->getId(),
            'tipo_exercicio' => $ex->tipo_exercicio ?? '',
            'video' => $ex->video ?? ''
        ];
    }, $exercicios);
}

// Obter o dia selecionado via GET ou usar o dia atual
$diaSelecionado = filter_input(INPUT_GET, 'dia', FILTER_VALIDATE_INT);
if ($diaSelecionado && $diaSelecionado >= 1 && $diaSelecionado <= 7) {
    // Se um dia específico foi selecionado via GET, usar esse dia (mesmo que não tenha exercícios)
    $diaAtual = $diaSelecionado;
} else {
    // Obter o dia atual (1 = Domingo, 7 = Sábado)
    $diaAtual = (int) date('w'); // 0 = Domingo, 6 = Sábado
    $diaAtual = $diaAtual === 0 ? 7 : $diaAtual; // Converter para 1-7
    
    // Se não houver exercícios para o dia atual E não foi selecionado via GET, usar o primeiro dia disponível
    if (empty($exerciciosPorDia[$diaAtual]) && !empty($exerciciosPorDia)) {
        $diaAtual = array_key_first($exerciciosPorDia);
    }
}

// Obter exercícios do dia atual (pode estar vazio se não houver exercícios para esse dia)
$exerciciosDoDia = $exerciciosPorDia[$diaAtual] ?? [];
$primeiroExercicioComVideo = null;
foreach ($exerciciosDoDia as $ex) {
    if ($ex instanceof Exercise && $ex->video) {
        $primeiroExercicioComVideo = $ex;
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Treinos</title>
    <link rel="stylesheet" href="/css/telaTreinos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>


<body>

    <body>
        <div class="background">
            <div class="bolinha bolinha1"></div>
            <div class="bolinha bolinha2"></div>
            <div class="bolinha bolinha3"></div>
            <div class="bolinha bolinha4"></div>
            <div class="bolinha bolinha5"></div>
            <div class="bolinha bolinha6"></div>

            <!-- <div class="logoWhatsApp">
                <img src="/imgFy/whatsapp (3).png" alt="logoWhatsApp">
            </div> -->

            <div class="logoCantoInferior">
            <img src="/imgFy/logoSemfundoEscritaBranca.png" alt="Logo">
        </div>

            <div class="fundoSemiTransparente">

                <div class="header-content-grid">
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
                                    <a href="/client/exercise/list" class="active">Treinos</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <div class="profile-box-container">
                        <a href="/client/cadastro" class="profile-link">
                            <div class="cardVerPerfil"><i class="fas fa-user"></i></div>
                            <div class="textocardVerPerfil"> Ver perfil</div>
                        </a>
                    </div>
                </div>
                <div class="main-screen-box">

                    <div class="check-in-box">
                        <div class="checkbox-wrapper">
                            <input type="checkbox" id="checkin" checked>
                            <label for="checkin">Check-in</label>
                        </div>
                    </div>

                    <div class="day-selector" id="daySelector">
                        <?php 
                        $abreviacoes = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'];
                        $diaSemanaAtual = (int) date('w'); // 0 = Domingo
                        $diaSemanaAtual = $diaSemanaAtual === 0 ? 7 : $diaSemanaAtual;
                        
                        for ($dia = 1; $dia <= 7; $dia++): 
                            $temExercicios = isset($exerciciosPorDia[$dia]);
                            $isActive = $dia === $diaAtual;
                            // Calcular o número do dia baseado no dia da semana atual
                            $diasDiferenca = $dia - $diaSemanaAtual;
                            $diaNumero = date('d', strtotime("$diasDiferenca days"));
                        ?>
                            <div class="day-item <?= $isActive ? 'active-day' : ''; ?> <?= !$temExercicios ? 'no-exercises' : ''; ?>" 
                                 data-dia="<?= $dia; ?>">
                                <span class="day-name"><?= $abreviacoes[$dia - 1]; ?></span>
                                <span class="day-number"><?= $diaNumero; ?></span>
                            </div>
                        <?php endfor; ?>
                    </div>

                    <div class="training-content-grid">
                        <?php if (empty($exerciciosDoDia)): ?>
                            <div class="training-list-box">
                                <div class="training-group-title">
                                    <div class="indicator-bar"></div>
                                    <span>Nenhum treino cadastrado</span>
                                </div>
                                <div style="padding: 20px; text-align: center; color: #999;">
                                    Não há exercícios cadastrados para este dia.
                                </div>
                            </div>
                            <div class="video-container">
                                <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: #999;">
                                    Nenhum vídeo disponível
                                </div>
                            </div>
                        <?php else: ?>
                            <?php 
                            // Agrupar exercícios por categoria
                            $exerciciosPorCategoria = [];
                            foreach ($exerciciosDoDia as $ex) {
                                if ($ex instanceof Exercise) {
                                    $categoria = $ex->categoria ?? 'Outros';
                                    if (!isset($exerciciosPorCategoria[$categoria])) {
                                        $exerciciosPorCategoria[$categoria] = [];
                                    }
                                    $exerciciosPorCategoria[$categoria][] = $ex;
                                }
                            }
                            ?>
                            
                            <div class="training-list-box">
                                <?php foreach ($exerciciosPorCategoria as $categoria => $exercicios): ?>
                                    <div class="training-group-title">
                                        <div class="indicator-bar"></div>
                                        <span>Treino <?= htmlspecialchars($categoria); ?></span>
                                    </div>
                                    
                                    <?php foreach ($exercicios as $exercise): ?>
                                        <?php if (!$exercise instanceof Exercise) { continue; } ?>
                                        <?php
                                            $detalhes = $exercise->tipo_exercicio ?? '';
                                            if ($exercise->repeticao) {
                                                $detalhes .= ' : ' . htmlspecialchars($exercise->repeticao);
                                            }
                                            if ($exercise->peso) {
                                                $detalhes .= ' > ' . number_format($exercise->peso, 2, ',', '.') . 'kg';
                                            }
                                            $temVideo = !empty($exercise->video);
                                            $observacao = $exercise->observacao ?? '';
                                        ?>
                                        <div class="exercise-item" 
                                             data-video="<?= htmlspecialchars($exercise->video ?? ''); ?>"
                                             data-observacao="<?= htmlspecialchars($observacao); ?>"
                                             style="cursor: <?= $temVideo ? 'pointer' : 'default'; ?>;">
                                            <?php if ($temVideo): ?>
                                                <span class="play-icon">▶</span>
                                            <?php else: ?>
                                                <span class="play-icon" style="opacity: 0.3;">▶</span>
                                            <?php endif; ?>
                                            <span class="exercise-details"><?= htmlspecialchars($detalhes); ?></span>
                                            <?php if ($observacao): ?>
                                                <span class="info-icon" title="<?= htmlspecialchars($observacao); ?>">ⓘ</span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </div>

                            <div class="video-container">
                                <?php if ($primeiroExercicioComVideo && $primeiroExercicioComVideo->video): ?>
                                    <?php
                                        // Extrair ID do YouTube se for URL do YouTube
                                        $videoUrl = $primeiroExercicioComVideo->video;
                                        $videoId = '';
                                        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^&\n?#]+)/', $videoUrl, $matches)) {
                                            $videoId = $matches[1];
                                        } else {
                                            $videoId = $videoUrl; // Se já for um ID ou outro formato
                                        }
                                    ?>
                                    <iframe width="100%" height="100%"
                                        src="https://www.youtube.com/embed/<?= htmlspecialchars($videoId); ?>?controls=1" 
                                        title="YouTube video player"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin" 
                                        allowfullscreen
                                        id="exerciseVideo">
                                    </iframe>
                                <?php else: ?>
                                    <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: #999;">
                                        Selecione um exercício com vídeo
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</body>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dayItems = document.querySelectorAll('.day-item[data-dia]');
    const exerciseItems = document.querySelectorAll('.exercise-item[data-video]');
    const videoFrame = document.getElementById('exerciseVideo');
    
    // Dados dos exercícios por dia (vindos do PHP)
    const exerciciosPorDia = <?= json_encode($exerciciosPorDiaJS, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE); ?>;
    
    // Função para extrair ID do YouTube
    function extractYouTubeId(url) {
        if (!url) return '';
        const match = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^&\n?#]+)/);
        return match ? match[1] : url;
    }
    
    // Função para atualizar vídeo
    function updateVideo(videoUrl) {
        if (!videoFrame || !videoUrl) return;
        const videoId = extractYouTubeId(videoUrl);
        videoFrame.src = `https://www.youtube.com/embed/${videoId}?controls=1`;
    }
    
    // Clique nos dias (para trocar de dia - recarregar página)
    dayItems.forEach(item => {
        item.addEventListener('click', function() {
            const dia = this.getAttribute('data-dia');
            // Sempre permitir clicar, mesmo que não tenha exercícios (para mostrar mensagem)
            const url = new URL(window.location);
            url.searchParams.set('dia', dia);
            window.location.href = url.toString();
        });
    });
    
    // Adicionar estilo visual para dias clicáveis
    dayItems.forEach(item => {
        const dia = item.getAttribute('data-dia');
        const temExercicios = exerciciosPorDia && exerciciosPorDia[dia] && exerciciosPorDia[dia].length > 0;
        
        // Todos os dias são clicáveis
        item.style.cursor = 'pointer';
        item.addEventListener('mouseenter', function() {
            if (!this.classList.contains('active-day')) {
                this.style.opacity = '0.7';
                this.style.transform = 'scale(1.05)';
            }
        });
        item.addEventListener('mouseleave', function() {
            this.style.opacity = '1';
            this.style.transform = 'scale(1)';
        });
        
        // Adicionar indicador visual se não tiver exercícios
        if (!temExercicios && !item.classList.contains('active-day')) {
            item.style.opacity = '0.6';
        }
    });
    
    // Clique nos exercícios para trocar o vídeo
    exerciseItems.forEach(item => {
        item.addEventListener('click', function() {
            const videoUrl = this.getAttribute('data-video');
            if (videoUrl) {
                updateVideo(videoUrl);
            }
        });
    });
});
</script>

</html>