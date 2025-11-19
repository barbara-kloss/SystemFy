<?php

namespace Systemfy\App\ControllerLogin;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Model\User;
use Systemfy\App\Model\Date;
use Systemfy\App\Repository\UserRepository;
use Systemfy\App\Repository\PlanoRepository;

class NewUserController implements Controller
{

    function __construct(
        private UserRepository $userRepository,
        private PlanoRepository $planoRepository
    ) {}
    public function processaRequisicao(): void
    {
        // Verificar se é POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /cadastro?sucesso=0&erro=' . urlencode('Método não permitido'));
            exit();
        }
        
        // Debug: Log dos dados recebidos
        $debugInfo = [];
        $debugInfo['POST'] = $_POST;
        $debugInfo['method'] = $_SERVER['REQUEST_METHOD'] ?? 'UNKNOWN';
        
        $nome = filter_input(INPUT_POST, 'nome_completo');
        if ($nome === null || $nome === '') {
            header('Location: /cadastro?sucesso=0&erro=' . urlencode('Nome é obrigatório'));
            exit();
        }
        $data_nasc = filter_input(INPUT_POST, 'data_nascimento');
        if ($data_nasc === false || $data_nasc === null || $data_nasc === '') {
            header('Location: /cadastro?sucesso=0&erro=' . urlencode('Data de nascimento é obrigatória'));
            exit();
        }
        $genero = filter_input(INPUT_POST, 'genero') ?? '';
        if ($genero === '') {
            header('Location: /cadastro?sucesso=0&erro=' . urlencode('Gênero é obrigatório'));
            exit();
        }
        $telefone = filter_input(INPUT_POST, 'telefone') ?? '';
        $permissao = filter_input(INPUT_POST, 'permissao');
        if ($permissao === false || $permissao === null) {
            $permissao = 'cliente';
        }
        $altura_raw = filter_input(INPUT_POST, 'altura');
        // Converter vírgula para ponto e validar
        if ($altura_raw) {
            $altura_raw = str_replace(',', '.', $altura_raw);
            $altura = filter_var($altura_raw, FILTER_VALIDATE_FLOAT);
            if ($altura === false || $altura === null) {
                $altura = 0.0;
            }
        } else {
            $altura = 0.0;
        }
        $peso_raw = filter_input(INPUT_POST, 'peso');
        $peso = 0;
        if ($peso_raw !== null && $peso_raw !== '') {
            $peso = filter_var($peso_raw, FILTER_VALIDATE_INT);
            if ($peso === false || $peso === null) {
                $peso = 0;
            }
        }
        $objetivos = filter_input(INPUT_POST, 'objetivo') ?? filter_input(INPUT_POST, 'objetivos') ?? '';
        $status_input = filter_input(INPUT_POST, 'status');
        $status = ($status_input !== null && $status_input !== false) ? true : false;
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
        
        // Verificar se é edição (tem ID)
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $isEdit = ($id !== null && $id > 0);

        $senha = filter_input(INPUT_POST, 'senha') ?? 'senha123'; // Senha padrão temporária
        $observacao = filter_input(INPUT_POST, 'observacoes') ?? filter_input(INPUT_POST, 'observacao') ?? '';
        $massa_raw = filter_input(INPUT_POST, 'magra');
        $massa = 0.0;
        if ($massa_raw !== null && $massa_raw !== '') {
            $massa_raw = str_replace(',', '.', $massa_raw);
            $massa = filter_var($massa_raw, FILTER_VALIDATE_FLOAT);
            if ($massa === false || $massa === null) {
                $massa = 0.0;
            }
        }
        $gordura_raw = filter_input(INPUT_POST, 'gordura');
        $gordura = 0.0;
        if ($gordura_raw !== null && $gordura_raw !== '') {
            $gordura_raw = str_replace(',', '.', $gordura_raw);
            $gordura = filter_var($gordura_raw, FILTER_VALIDATE_FLOAT);
            if ($gordura === false || $gordura === null) {
                $gordura = 0.0;
            }
        }
        
        $plano_id_raw = filter_input(INPUT_POST, 'plano');
        $plano_id = null;
        if ($plano_id_raw && $plano_id_raw !== '') {
            // Buscar plano pelo ID ou categoria
            $plano = $this->planoRepository->find((int) $plano_id_raw);
            if ($plano === null) {
                // Tentar buscar por categoria
                $planos = $this->planoRepository->all();
                foreach ($planos as $p) {
                    if ($p->getCategoria() === $plano_id_raw) {
                        $plano_id = $p;
                        break;
                    }
                }
            } else {
                $plano_id = $plano;
            }
        }

        $foto = filter_input(INPUT_POST, 'foto') ?? '';

        $peso_meta_raw = filter_input(INPUT_POST, 'metaPeso');
        $peso_meta = 0.0;
        if ($peso_meta_raw !== null && $peso_meta_raw !== '') {
            $peso_meta_raw = str_replace(',', '.', $peso_meta_raw);
            $peso_meta = filter_var($peso_meta_raw, FILTER_VALIDATE_FLOAT);
            if ($peso_meta === false || $peso_meta === null) {
                $peso_meta = 0.0;
            }
        }

        // Criar objeto Date
        $dataNascObj = new Date($data_nasc);

        // Se for edição, buscar o usuário existente para manter a senha se não foi alterada
        $senhaFinal = $senha;
        if ($isEdit) {
            $userExistente = $this->userRepository->find($id);
            if ($userExistente) {
                // Se a senha não foi preenchida, manter a senha atual
                if (empty($senha) || $senha === 'senha123') {
                    $senhaFinal = $userExistente->getSenha(); // Manter hash atual
                }
            }
        }

        // Criar User
        $user = new User(
            $isEdit ? $id : 0, // id do usuário (0 para novo, id para edição)
            $nome,
            $dataNascObj,
            $genero,
            $telefone,
            $senhaFinal,
            $permissao,
            $altura,
            $peso,
            $objetivos,
            $status,
            $observacao,
            $massa,
            $gordura,
            $plano_id,
            $email,
            $foto,
            $peso_meta
        );

        try {
            // Debug: Preparar informações para log
            $debugInfo['user_data'] = [
                'id' => $id,
                'isEdit' => $isEdit,
                'nome' => $nome,
                'email' => $email,
                'genero' => $genero,
                'telefone' => $telefone,
                'data_nasc' => $data_nasc,
                'plano_id' => $plano_id ? $plano_id->getId() : null,
                'altura' => $altura,
                'peso' => $peso,
                'status' => $status
            ];
            
            if ($isEdit) {
                // Atualizar usuário existente
                $result = $this->userRepository->update($user);
                $action = 'atualizar';
            } else {
                // Criar novo usuário
                $result = $this->userRepository->add($user);
                $action = 'cadastrar';
            }
            
            if ($result === false) {
                $errorInfo = $this->userRepository->getLastError();
                $errorMsg = "Erro ao {$action}: " . ($errorInfo ?? 'Erro desconhecido');
                $errorMsg .= ' | Debug: ' . json_encode($debugInfo);
                header('Location: /cadastro?sucesso=0&erro=' . urlencode($errorMsg));
            } else {
                $msg = $isEdit ? 'Cliente atualizado com sucesso!' : 'Cliente cadastrado com sucesso!';
                header('Location: /cadastro?sucesso=1');
            }
        } catch (\Exception $e) {
            $errorMsg = $e->getMessage() . ' | Linha: ' . $e->getLine() . ' | Arquivo: ' . basename($e->getFile());
            $errorMsg .= ' | Debug: ' . json_encode($debugInfo);
            header('Location: /cadastro?sucesso=0&erro=' . urlencode($errorMsg));
        }
    }
}
