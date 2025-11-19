<?php

namespace Systemfy\App\Controller;

use Systemfy\App\Repository\UserRepository;
use Systemfy\App\Repository\PlanoRepository;
use Systemfy\App\Model\User;
use Systemfy\App\Model\Date;

class EditPerfilClienteController implements Controller
{
    function __construct(
        private UserRepository $userRepository,
        private PlanoRepository $planoRepository
    ) {}

    public function processaRequisicao(): void
    {
        $userId = $_SESSION['user_id'] ?? null;
        
        if (!$userId) {
            header('Location: /login');
            exit();
        }

        $user = $this->userRepository->find((int) $userId);
        
        if (!$user) {
            header('Location: /client/perfil?erro=' . urlencode('Usuário não encontrado'));
            exit();
        }

        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING) ?? $user->getNome();
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ?? $user->getEmail();
        $genero = filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_STRING) ?? $user->getGenero();
        $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING) ?? $user->getTelefone();
        $data_nasc = filter_input(INPUT_POST, 'data-nascimento', FILTER_SANITIZE_STRING) ?? $user->getDataNasc()->getDate();
        $altura_raw = filter_input(INPUT_POST, 'altura');
        $altura = $altura_raw ? (float) str_replace(',', '.', $altura_raw) : $user->getAltura();
        $peso_raw = filter_input(INPUT_POST, 'peso');
        $peso = $peso_raw ? (int) $peso_raw : $user->getPeso();
        $objetivo = filter_input(INPUT_POST, 'objetivo', FILTER_SANITIZE_STRING) ?? $user->getObjetivo();
        $observacao = filter_input(INPUT_POST, 'observacoes', FILTER_SANITIZE_STRING) ?? $user->getObservacao();
        $massa_raw = filter_input(INPUT_POST, 'massa-magra');
        $massa = $massa_raw ? (float) str_replace(',', '.', $massa_raw) : $user->getMassa();
        $gordura_raw = filter_input(INPUT_POST, 'gordura');
        $gordura = $gordura_raw ? (float) str_replace(',', '.', $gordura_raw) : $user->getGordura();
        $peso_meta_raw = filter_input(INPUT_POST, 'peso-meta') ?? filter_input(INPUT_POST, 'peso_meta');
        $peso_meta = $peso_meta_raw ? (float) str_replace(',', '.', $peso_meta_raw) : $user->getPesoMeta();
        
        // Processar upload de foto
        $foto = $user->getFoto();
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['foto'];
            
            // Validar tipo de arquivo
            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);
            
            if (in_array($mimeType, $allowedTypes)) {
                // Validar tamanho (máximo 5MB)
                if ($file['size'] <= 5 * 1024 * 1024) {
                    // Ler o conteúdo do arquivo para salvar como BLOB
                    $foto = file_get_contents($file['tmp_name']);
                } else {
                    header('Location: /client/perfil?erro=' . urlencode('A imagem deve ter no máximo 5MB'));
                    exit();
                }
            } else {
                header('Location: /client/perfil?erro=' . urlencode('Tipo de arquivo não permitido. Use apenas imagens (JPEG, PNG, GIF, WEBP)'));
                exit();
            }
        }

        $dataNascObj = new Date($data_nasc);
        $planoId = $user->getPlanoId();

        $senha = filter_input(INPUT_POST, 'senha');
        $senhaFinal = $user->getSenha();
        if (!empty($senha)) {
            $senhaInfo = @password_get_info($senha);
            if (!isset($senhaInfo['algo']) || $senhaInfo['algo'] === false || $senhaInfo['algo'] === null) {
                $senhaFinal = password_hash($senha, PASSWORD_ARGON2ID);
            } else {
                $senhaFinal = $senha;
            }
        }

        $userAtualizado = new User(
            $user->getId(),
            $nome,
            $dataNascObj,
            $genero,
            $telefone,
            $senhaFinal,
            $user->getPermissao(),
            $altura,
            $peso,
            $objetivo,
            $user->getStatus(),
            $observacao,
            $massa,
            $gordura,
            $planoId,
            $email,
            $foto,
            $peso_meta
        );

        try {
            $result = $this->userRepository->update($userAtualizado);
            
            if ($result) {
                header('Location: /client/perfil?sucesso=1');
            } else {
                $errorInfo = $this->userRepository->getLastError();
                header('Location: /client/perfil?erro=' . urlencode($errorInfo ?? 'Erro ao atualizar perfil'));
            }
        } catch (\Exception $e) {
            header('Location: /client/perfil?erro=' . urlencode('Erro ao atualizar: ' . $e->getMessage()));
        }
    }
}

