<?php

use Systemfy\App\Model\Agenda;

/** @var Agenda|null $agenda */
$agenda ??= null;

$feedback = filter_input(INPUT_GET, 'sucesso', FILTER_VALIDATE_INT);
$formAction = $agenda ? '/client/agenda/edit' : '/client/agenda/save';
$userId = $_SESSION['user_id'] ?? null;

// Valores padrão
$dataReuniao = '';
$horario = '';
$assunto = '';
$titulo = '';
$personalId = '';
$nutriId = '';

if ($agenda) {
    // Acessa as propriedades diretamente como o repositório faz
    $dataReuniao = $agenda->data_reuniao ?? '';
    $horario = $agenda->horario ?? '';
    $assunto = $agenda->assunto ?? '';
    $titulo = $agenda->titulo ?? '';
    $personalId = $agenda->id_personal ?? '';
    $nutriId = $agenda->id_nutri ?? '';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $agenda ? 'Editar Consulta' : 'Nova Consulta'; ?></title>
    <link rel="stylesheet" href="/css/telaInicial.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .form-container {
            grid-area: main;
            background-color: white;
            border-radius: 28px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .form-title {
            font-size: 28px;
            font-weight: 700;
            color: #2A2A2A;
            margin-bottom: 25px;
            font-family: 'Alata', sans-serif;
        }

        .agenda-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .input-group label {
            font-size: 16px;
            font-weight: 600;
            color: #2A2A2A;
            font-family: 'Alata', sans-serif;
        }

        .input-group input,
        .input-group textarea,
        .input-group select {
            padding: 12px;
            border: 2px solid #D4D2C8;
            border-radius: 10px;
            font-size: 16px;
            font-family: 'Alata', sans-serif;
            transition: border-color 0.3s ease;
        }

        .input-group input:focus,
        .input-group textarea:focus,
        .input-group select:focus {
            outline: none;
            border-color: #DDB35E;
        }

        .input-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 20px;
            font-size: 16px;
            font-weight: 700;
            font-family: 'Alata', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: #DDB35E;
            color: #2A2A2A;
        }

        .btn-primary:hover {
            background-color: #c9a04d;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-secondary {
            background-color: #D4D2C8;
            color: #2A2A2A;
        }

        .btn-secondary:hover {
            background-color: #c0beb4;
        }

        .alerta-feedback {
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alerta-sucesso {
            background-color: #d4edda;
            color: #155724;
        }

        .alerta-erro {
            background-color: #f8d7da;
            color: #721c24;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
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

                <div class="profile-box-container">
                    <a href="/client/cadastro" class="profile-link">
                        <div class="cardVerPerfil"><i class="fas fa-user"></i></div>
                        <div class="textocardVerPerfil"> Ver perfil</div>
                    </a>
                </div>

                <div class="form-container">
                    <h2 class="form-title">
                        <?= $agenda ? 'Editar Consulta' : 'Nova Consulta'; ?>
                    </h2>

                    <?php if ($feedback !== null): ?>
                        <div class="alerta-feedback <?= $feedback === 1 ? 'alerta-sucesso' : 'alerta-erro'; ?>">
                            <?php if ($feedback === 1): ?>
                                ✓ Operação realizada com sucesso.
                            <?php else: ?>
                                ✗ Não foi possível concluir a operação.
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <form class="agenda-form" method="post" action="<?= $formAction; ?>">
                        <?php if ($agenda): ?>
                            <input type="hidden" name="id" value="<?= htmlspecialchars((string) $agenda->getId()); ?>">
                        <?php endif; ?>

                        <input type="hidden" name="usuario_id" value="<?= htmlspecialchars((string) $userId); ?>">

                        <div class="input-group">
                            <label for="titulo">Título da Consulta *</label>
                            <input type="text" id="titulo" name="titulo" required
                                value="<?= htmlspecialchars($titulo); ?>"
                                placeholder="Ex: Consulta com Personal">
                        </div>

                        <div class="form-row">
                            <div class="input-group">
                                <label for="data_reuniao">Data *</label>
                                <input type="date" id="data_reuniao" name="data_reuniao" required
                                    value="<?= htmlspecialchars($dataReuniao); ?>">
                            </div>

                            <div class="input-group">
                                <label for="horario">Horário *</label>
                                <input type="time" id="horario" name="horario" required
                                    value="<?= htmlspecialchars($horario); ?>">
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="assunto">Assunto/Descrição *</label>
                            <textarea id="assunto" name="assunto" required
                                placeholder="Descreva o motivo da consulta..."><?= htmlspecialchars($assunto); ?></textarea>
                        </div>

                        <div class="form-row">
                            <div class="input-group">
                                <label for="personal_id">Personal Trainer (ID)</label>
                                <input type="number" id="personal_id" name="personal_id"
                                    value="<?= htmlspecialchars($personalId); ?>"
                                    placeholder="ID do personal (opcional)">
                            </div>

                            <div class="input-group">
                                <label for="nutri_id">Nutricionista (ID)</label>
                                <input type="number" id="nutri_id" name="nutri_id"
                                    value="<?= htmlspecialchars($nutriId); ?>"
                                    placeholder="ID do nutricionista (opcional)">
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="/client" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <?= $agenda ? 'Salvar Alterações' : 'Criar Consulta'; ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

