-- Script SQL para popular as tabelas do SystemFy
-- Execute este script no seu banco de dados MySQL

-- ============================================================
-- CONFIGURAÇÕES INICIAIS
-- ============================================================
-- Desabilita temporariamente a verificação de chaves estrangeiras
SET FOREIGN_KEY_CHECKS = 0;

-- Reseta o AUTO_INCREMENT da tabela user para garantir IDs corretos
-- (Ajuste o valor inicial se necessário)
ALTER TABLE user AUTO_INCREMENT = 1;

-- ============================================================
-- POPULAÇÃO DA TABELA user (35 registros)
-- ============================================================
-- IMPORTANTE: Os IDs são especificados explicitamente para garantir
-- que as chaves estrangeiras nas tabelas menu e exercise funcionem corretamente

INSERT INTO user (id, nome_completo, data_nascimento, genero, telefone, senha, permissao, altura, peso, objetivos, status, observacao, massa, gordura, plano_id, email, foto, peso_meta) VALUES
(1, 'Ana Silva Santos', '1990-05-15', 'Feminino', '(11) 98765-4321', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.65, 68, 'Perder peso e ganhar massa magra', 1, 'Cliente dedicada, segue dieta rigorosamente', 45.5, 22.5, 1, 'ana.silva@email.com', NULL, 60.0),
(2, 'Carlos Eduardo Oliveira', '1985-08-22', 'Masculino', '(11) 97654-3210', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.78, 85, 'Ganhar massa muscular', 1, 'Treina 5x por semana', 60.0, 15.0, 2, 'carlos.oliveira@email.com', NULL, 90.0),
(3, 'Maria Fernanda Costa', '1992-11-30', 'Feminino', '(11) 96543-2109', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.60, 55, 'Manter forma física', 1, 'Pratica yoga além dos treinos', 40.0, 18.0, 1, 'maria.costa@email.com', NULL, 55.0),
(4, 'João Pedro Almeida', '1988-03-10', 'Masculino', '(11) 95432-1098', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.75, 78, 'Definição muscular', 1, 'Foco em hipertrofia', 58.0, 12.0, 2, 'joao.almeida@email.com', NULL, 80.0),
(5, 'Juliana Rodrigues', '1995-07-18', 'Feminino', '(11) 94321-0987', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.68, 72, 'Emagrecimento', 1, 'Iniciante, precisa de acompanhamento', 50.0, 25.0, 3, 'juliana.rodrigues@email.com', NULL, 65.0),
(6, 'Roberto Santos Lima', '1982-12-05', 'Masculino', '(11) 93210-9876', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.80, 92, 'Perder peso e melhorar condicionamento', 1, 'Tem problemas no joelho', 65.0, 20.0, 1, 'roberto.lima@email.com', NULL, 85.0),
(7, 'Fernanda Souza', '1991-04-25', 'Feminino', '(11) 92109-8765', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.62, 58, 'Ganhar massa magra', 1, 'Vegetariana', 42.0, 20.0, 2, 'fernanda.souza@email.com', NULL, 62.0),
(8, 'Paulo Henrique Martins', '1987-09-14', 'Masculino', '(11) 91098-7654', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.72, 80, 'Força e resistência', 1, 'Prepara para maratona', 62.0, 14.0, 2, 'paulo.martins@email.com', NULL, 82.0),
(9, 'Larissa Ferreira', '1993-06-08', 'Feminino', '(11) 90987-6543', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.70, 65, 'Definição e tonificação', 1, 'Treina funcional', 48.0, 19.0, 1, 'larissa.ferreira@email.com', NULL, 63.0),
(10, 'Ricardo Barbosa', '1984-01-20', 'Masculino', '(11) 89876-5432', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.76, 88, 'Hipertrofia', 1, 'Experiente, treina há 5 anos', 70.0, 10.0, 2, 'ricardo.barbosa@email.com', NULL, 90.0),
(11, 'Camila Araújo', '1996-02-12', 'Feminino', '(11) 88765-4321', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.64, 70, 'Emagrecimento saudável', 1, 'Iniciante', 52.0, 22.0, 3, 'camila.araujo@email.com', NULL, 62.0),
(12, 'Thiago Nunes', '1989-10-03', 'Masculino', '(11) 87654-3210', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.74, 82, 'Condicionamento físico', 1, 'Sedentário há 2 anos', 60.0, 18.0, 1, 'thiago.nunes@email.com', NULL, 78.0),
(13, 'Patricia Mendes', '1994-05-28', 'Feminino', '(11) 86543-2109', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.66, 64, 'Ganhar massa e força', 1, 'Interessada em powerlifting', 46.0, 20.0, 2, 'patricia.mendes@email.com', NULL, 68.0),
(14, 'Marcos Vinicius', '1986-07-16', 'Masculino', '(11) 85432-1098', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.79, 90, 'Perda de peso', 1, 'Pressão alta controlada', 65.0, 22.0, 1, 'marcos.vinicius@email.com', NULL, 82.0),
(15, 'Beatriz Gomes', '1997-09-22', 'Feminino', '(11) 84321-0987', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.63, 59, 'Manter peso e melhorar flexibilidade', 1, 'Faz pilates', 45.0, 19.0, 1, 'beatriz.gomes@email.com', NULL, 59.0),
(16, 'Felipe Rocha', '1983-04-07', 'Masculino', '(11) 83210-9876', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.77, 86, 'Ganhar massa e definir', 1, 'Treina há 3 anos', 68.0, 12.0, 2, 'felipe.rocha@email.com', NULL, 88.0),
(17, 'Gabriela Teixeira', '1990-12-19', 'Feminino', '(11) 82109-8765', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.67, 66, 'Emagrecimento pós-gravidez', 1, '6 meses pós-parto', 50.0, 21.0, 3, 'gabriela.teixeira@email.com', NULL, 60.0),
(18, 'André Luiz Silva', '1981-08-11', 'Masculino', '(11) 81098-7654', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.73, 84, 'Melhorar saúde cardiovascular', 1, 'Histórico familiar de problemas cardíacos', 62.0, 19.0, 1, 'andre.silva@email.com', NULL, 78.0),
(19, 'Isabela Campos', '1992-03-26', 'Feminino', '(11) 80987-6543', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.69, 71, 'Ganhar massa magra', 1, 'Atleta amadora', 52.0, 20.0, 2, 'isabela.campos@email.com', NULL, 73.0),
(20, 'Bruno Carvalho', '1988-11-09', 'Masculino', '(11) 79876-5432', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.81, 95, 'Perda de peso urgente', 1, 'Obesidade grau I', 70.0, 24.0, 1, 'bruno.carvalho@email.com', NULL, 85.0),
(21, 'Renata Dias', '1995-01-31', 'Feminino', '(11) 78765-4321', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.61, 57, 'Definição muscular', 1, 'Competidora de fitness', 44.0, 18.0, 2, 'renata.dias@email.com', NULL, 58.0),
(22, 'Leonardo Pereira', '1985-06-13', 'Masculino', '(11) 77654-3210', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.75, 79, 'Manter forma física', 1, 'Treina regularmente há 4 anos', 61.0, 15.0, 1, 'leonardo.pereira@email.com', NULL, 79.0),
(23, 'Vanessa Lopes', '1993-10-04', 'Feminino', '(11) 76543-2109', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.65, 63, 'Emagrecimento e tonificação', 1, 'Iniciante, muito motivada', 48.0, 21.0, 3, 'vanessa.lopes@email.com', NULL, 58.0),
(24, 'Gustavo Ribeiro', '1987-02-17', 'Masculino', '(11) 75432-1098', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.78, 87, 'Hipertrofia e força', 1, 'Foco em levantamento de peso', 70.0, 11.0, 2, 'gustavo.ribeiro@email.com', NULL, 92.0),
(25, 'Tatiana Monteiro', '1991-08-29', 'Feminino', '(11) 74321-0987', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.64, 61, 'Ganhar massa magra', 1, 'Vegetariana, precisa de atenção especial', 46.0, 19.0, 2, 'tatiana.monteiro@email.com', NULL, 65.0),
(26, 'Rodrigo Alves', '1984-12-21', 'Masculino', '(11) 73210-9876', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.76, 83, 'Condicionamento e perda de peso', 1, 'Volta aos treinos após lesão', 64.0, 17.0, 1, 'rodrigo.alves@email.com', NULL, 80.0),
(27, 'Amanda Ribeiro', '1996-05-06', 'Feminino', '(11) 72109-8765', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.67, 69, 'Emagrecimento', 1, 'Jovem, muito dedicada', 51.0, 23.0, 3, 'amanda.ribeiro@email.com', NULL, 62.0),
(28, 'Diego Moreira', '1989-09-24', 'Masculino', '(11) 71098-7654', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.74, 81, 'Ganhar massa muscular', 1, 'Ectomorfo, dificuldade para ganhar peso', 63.0, 14.0, 2, 'diego.moreira@email.com', NULL, 85.0),
(29, 'Cristina Freitas', '1994-07-02', 'Feminino', '(11) 70987-6543', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.68, 67, 'Definição e força', 1, 'Treina crossfit', 50.0, 20.0, 2, 'cristina.freitas@email.com', NULL, 68.0),
(30, 'Lucas Machado', '1986-03-15', 'Masculino', '(11) 69876-5432', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.80, 89, 'Perda de peso e condicionamento', 1, 'Sedentário há muito tempo', 66.0, 21.0, 1, 'lucas.machado@email.com', NULL, 82.0),
(31, 'Sandra Correia', '1992-11-27', 'Feminino', '(11) 68765-4321', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.62, 60, 'Manter peso e melhorar flexibilidade', 1, 'Faz yoga e pilates', 45.0, 18.0, 1, 'sandra.correia@email.com', NULL, 60.0),
(32, 'Rafael Torres', '1983-04-18', 'Masculino', '(11) 67654-3210', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.77, 85, 'Hipertrofia', 1, 'Experiente, busca novos desafios', 69.0, 13.0, 2, 'rafael.torres@email.com', NULL, 90.0),
(33, 'Marcos Silva', '1982-09-11', 'Masculino', '(11) 66543-2109', '$argon2id$v=19$m=65536,t=4,p=1$YVNqQ1E5V1cwTGx6RW1NVg$nc90ExUOYJEnESkEsx7GZHQ2ZdKoAySMzCuLPENnPks', 'cliente', 1.79, 88, 'Ganhar massa', 1, 'Treina há 6 anos', 71.0, 11.0, 2, 'marcos.silva@email.com', NULL, 92.0),
(34, 'Personal Trainer Admin', '1980-01-01', 'Masculino', '(11) 99999-9999', '$argon2id$v=19$m=65536,t=4,p=1$OW5wUEM5dEdMVktSR25CQQ$yDDeoIrHD1sc5eA0mIt8vEl35bqRN8HKxByRiKjll+M', 'admin', 1.75, 80, 'Administração do sistema', 1, 'Personal trainer responsável', 65.0, 12.0, NULL, 'admin@systemfy.com', NULL, NULL),
(35, 'Nutricionista Admin', '1985-06-15', 'Feminino', '(11) 88888-8888', '$argon2id$v=19$m=65536,t=4,p=1$VU82MHkwdnB5eDJmSGNVUA$/kBapdlf82RHueh9mgCtz79wMOf9IAUqIhvT+ADkqM8', 'admin', 1.65, 65, 'Administração do sistema', 1, 'Nutricionista responsável', 50.0, 18.0, NULL, 'nutri@systemfy.com', NULL, NULL);

-- ============================================================
-- POPULAÇÃO DA TABELA menu (35 registros)
-- ============================================================
-- Categoria: 1 = Geral, 2 = Livre

INSERT INTO menu (horario, categoria, observacao, id_user, id_nutri, titulo) VALUES
('07:00:00', 1, 'Café da manhã completo', (SELECT id FROM user WHERE email = 'ana.silva@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Aveia com frutas e iogurte'),
('12:30:00', 1, 'Almoço balanceado', (SELECT id FROM user WHERE email = 'ana.silva@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Arroz integral, frango grelhado e salada'),
('19:00:00', 1, 'Jantar leve', (SELECT id FROM user WHERE email = 'ana.silva@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Sopa de legumes e pão integral'),
('08:00:00', 1, 'Café da manhã pré-treino', (SELECT id FROM user WHERE email = 'carlos.oliveira@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Pão integral, ovos e banana'),
('13:00:00', 1, 'Almoço pós-treino', (SELECT id FROM user WHERE email = 'carlos.oliveira@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Batata doce, frango e brócolis'),
('20:00:00', 1, 'Jantar proteico', (SELECT id FROM user WHERE email = 'carlos.oliveira@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Salmão grelhado com quinoa'),
('07:30:00', 1, 'Café da manhã', (SELECT id FROM user WHERE email = 'maria.costa@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Iogurte grego com granola'),
('12:00:00', 1, 'Almoço', (SELECT id FROM user WHERE email = 'maria.costa@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Salada completa com grão-de-bico'),
('18:30:00', 1, 'Jantar', (SELECT id FROM user WHERE email = 'maria.costa@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Omelete com vegetais'),
('06:30:00', 1, 'Café da manhã', (SELECT id FROM user WHERE email = 'joao.almeida@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Whey protein com aveia'),
('14:00:00', 1, 'Almoço', (SELECT id FROM user WHERE email = 'joao.almeida@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Arroz, feijão, carne magra e salada'),
('21:00:00', 1, 'Jantar', (SELECT id FROM user WHERE email = 'joao.almeida@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Atum com batata doce'),
('08:30:00', 1, 'Café da manhã', (SELECT id FROM user WHERE email = 'juliana.rodrigues@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Panqueca de aveia com mel'),
('13:30:00', 1, 'Almoço', (SELECT id FROM user WHERE email = 'juliana.rodrigues@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Macarrão integral com molho de tomate'),
('19:30:00', 1, 'Jantar', (SELECT id FROM user WHERE email = 'juliana.rodrigues@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Peixe assado com legumes'),
('07:00:00', 1, 'Café da manhã', (SELECT id FROM user WHERE email = 'roberto.lima@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Frutas e iogurte'),
('12:00:00', 1, 'Almoço', (SELECT id FROM user WHERE email = 'roberto.lima@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Sopa de legumes e frango'),
('18:00:00', 1, 'Jantar', (SELECT id FROM user WHERE email = 'roberto.lima@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Salada verde com atum'),
('09:00:00', 1, 'Café da manhã vegetariano', (SELECT id FROM user WHERE email = 'fernanda.souza@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Tofu mexido com vegetais'),
('13:00:00', 1, 'Almoço vegetariano', (SELECT id FROM user WHERE email = 'fernanda.souza@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Lentilha com arroz integral'),
('19:00:00', 1, 'Jantar vegetariano', (SELECT id FROM user WHERE email = 'fernanda.souza@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Quinoa com legumes assados'),
('06:00:00', 1, 'Café da manhã pré-treino', (SELECT id FROM user WHERE email = 'paulo.martins@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Banana e café'),
('14:30:00', 1, 'Almoço pós-treino', (SELECT id FROM user WHERE email = 'paulo.martins@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Batata doce, frango e vegetais'),
('20:30:00', 1, 'Jantar', (SELECT id FROM user WHERE email = 'paulo.martins@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Omelete com queijo e vegetais'),
('08:00:00', 1, 'Café da manhã', (SELECT id FROM user WHERE email = 'larissa.ferreira@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Aveia com frutas vermelhas'),
('12:30:00', 1, 'Almoço', (SELECT id FROM user WHERE email = 'larissa.ferreira@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Frango grelhado com batata doce'),
('19:00:00', 1, 'Jantar', (SELECT id FROM user WHERE email = 'larissa.ferreira@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Salmão com arroz integral'),
('07:30:00', 1, 'Café da manhã', (SELECT id FROM user WHERE email = 'ricardo.barbosa@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Ovos mexidos com pão integral'),
('13:00:00', 1, 'Almoço', (SELECT id FROM user WHERE email = 'ricardo.barbosa@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Carne magra com arroz e feijão'),
('20:00:00', 1, 'Jantar', (SELECT id FROM user WHERE email = 'ricardo.barbosa@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Frango com legumes'),
('08:30:00', 2, 'Lanche da manhã', (SELECT id FROM user WHERE email = 'ana.silva@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Frutas e castanhas'),
('15:30:00', 2, 'Lanche da tarde', (SELECT id FROM user WHERE email = 'ana.silva@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Iogurte com mel'),
('10:00:00', 2, 'Lanche pré-treino', (SELECT id FROM user WHERE email = 'carlos.oliveira@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Banana e whey protein'),
('16:00:00', 2, 'Lanche pós-treino', (SELECT id FROM user WHERE email = 'carlos.oliveira@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Shake de proteína'),
('11:00:00', 2, 'Lanche', (SELECT id FROM user WHERE email = 'maria.costa@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Mix de frutas secas'),
('17:00:00', 2, 'Lanche', (SELECT id FROM user WHERE email = 'maria.costa@email.com'), (SELECT id FROM user WHERE email = 'nutri@systemfy.com'), 'Iogurte grego');

-- ============================================================
-- POPULAÇÃO DA TABELA exercise (35 registros)
-- ============================================================
-- Dia: 1=Domingo, 2=Segunda, 3=Terça, 4=Quarta, 5=Quinta, 6=Sexta, 7=Sábado
-- Categoria: Superiores, Inferiores, Core, Cardio

INSERT INTO exercise (id_user, peso, repeticao, tipo_exercicio, dia, observacao, categoria, id_personal, video) VALUES
((SELECT id FROM user WHERE email = 'ana.silva@email.com'), 5.0, '3x12', 'Agachamento', 2, 'Foco em técnica', 'Inferiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example1'),
((SELECT id FROM user WHERE email = 'ana.silva@email.com'), 3.0, '3x15', 'Leg Press', 2, 'Aumentar carga gradualmente', 'Inferiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example2'),
((SELECT id FROM user WHERE email = 'ana.silva@email.com'), NULL, '3x20', 'Abdominais', 2, 'Controle na descida', 'Core', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example3'),
((SELECT id FROM user WHERE email = 'carlos.oliveira@email.com'), 80.0, '4x8', 'Supino Reto', 2, 'Peso máximo', 'Superiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example4'),
((SELECT id FROM user WHERE email = 'carlos.oliveira@email.com'), 60.0, '4x10', 'Remada Curvada', 2, 'Mantém postura', 'Superiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example5'),
((SELECT id FROM user WHERE email = 'carlos.oliveira@email.com'), 40.0, '3x12', 'Desenvolvimento', 2, 'Cuidado com ombros', 'Superiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example6'),
((SELECT id FROM user WHERE email = 'maria.costa@email.com'), NULL, '30min', 'Corrida na Esteira', 3, 'Intensidade moderada', 'Cardio', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example7'),
((SELECT id FROM user WHERE email = 'maria.costa@email.com'), NULL, '20min', 'Bicicleta Ergométrica', 3, 'Ritmo constante', 'Cardio', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example8'),
((SELECT id FROM user WHERE email = 'maria.costa@email.com'), NULL, '3x15', 'Prancha', 3, 'Manter 45 segundos', 'Core', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example9'),
((SELECT id FROM user WHERE email = 'joao.almeida@email.com'), 100.0, '5x5', 'Agachamento Livre', 4, 'Peso pesado', 'Inferiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example10'),
((SELECT id FROM user WHERE email = 'joao.almeida@email.com'), 70.0, '4x8', 'Stiff', 4, 'Alongamento posterior', 'Inferiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example11'),
((SELECT id FROM user WHERE email = 'joao.almeida@email.com'), 50.0, '3x10', 'Extensão de Pernas', 4, 'Controle no movimento', 'Inferiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example12'),
((SELECT id FROM user WHERE email = 'juliana.rodrigues@email.com'), 10.0, '3x12', 'Rosca Direta', 5, 'Isolamento bíceps', 'Superiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example13'),
((SELECT id FROM user WHERE email = 'juliana.rodrigues@email.com'), 12.0, '3x12', 'Tríceps Pulley', 5, 'Extensão completa', 'Superiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example14'),
((SELECT id FROM user WHERE email = 'juliana.rodrigues@email.com'), NULL, '3x20', 'Abdominais Laterais', 5, 'Alternar lados', 'Core', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example15'),
((SELECT id FROM user WHERE email = 'roberto.lima@email.com'), NULL, '25min', 'Caminhada Inclinada', 6, 'Inclinação 5%', 'Cardio', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example16'),
((SELECT id FROM user WHERE email = 'roberto.lima@email.com'), NULL, '15min', 'Elíptico', 6, 'Baixo impacto', 'Cardio', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example17'),
((SELECT id FROM user WHERE email = 'roberto.lima@email.com'), 8.0, '3x15', 'Leg Curl', 6, 'Contração máxima', 'Inferiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example18'),
((SELECT id FROM user WHERE email = 'fernanda.souza@email.com'), 15.0, '4x10', 'Elevação Lateral', 2, 'Peso moderado', 'Superiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example19'),
((SELECT id FROM user WHERE email = 'fernanda.souza@email.com'), 20.0, '4x10', 'Elevação Frontal', 2, 'Controle no movimento', 'Superiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example20'),
((SELECT id FROM user WHERE email = 'fernanda.souza@email.com'), NULL, '3x30', 'Mountain Climber', 2, 'Ritmo acelerado', 'Cardio', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example21'),
((SELECT id FROM user WHERE email = 'paulo.martins@email.com'), 90.0, '4x8', 'Agachamento com Barra', 3, 'Peso máximo', 'Inferiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example22'),
((SELECT id FROM user WHERE email = 'paulo.martins@email.com'), 60.0, '4x10', 'Afundo', 3, 'Alternar pernas', 'Inferiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example23'),
((SELECT id FROM user WHERE email = 'paulo.martins@email.com'), NULL, '3x20', 'Prancha Lateral', 3, '30 segundos cada lado', 'Core', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example24'),
((SELECT id FROM user WHERE email = 'larissa.ferreira@email.com'), 25.0, '3x12', 'Crucifixo', 4, 'Alongamento peitoral', 'Superiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example25'),
((SELECT id FROM user WHERE email = 'larissa.ferreira@email.com'), 30.0, '3x10', 'Voador', 4, 'Contração máxima', 'Superiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example26'),
((SELECT id FROM user WHERE email = 'larissa.ferreira@email.com'), NULL, '20min', 'Esteira Intervalada', 4, '1min rápido, 2min lento', 'Cardio', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example27'),
((SELECT id FROM user WHERE email = 'ricardo.barbosa@email.com'), 120.0, '5x5', 'Levantamento Terra', 5, 'Peso máximo, técnica perfeita', 'Inferiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example28'),
((SELECT id FROM user WHERE email = 'ricardo.barbosa@email.com'), 85.0, '4x8', 'Agachamento Hack', 5, 'Foco em quadríceps', 'Inferiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example29'),
((SELECT id FROM user WHERE email = 'ricardo.barbosa@email.com'), 50.0, '3x12', 'Panturrilha em Pé', 5, 'Amplitude máxima', 'Inferiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example30'),
((SELECT id FROM user WHERE email = 'camila.araujo@email.com'), NULL, '30min', 'Spinning', 6, 'Intensidade alta', 'Cardio', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example31'),
((SELECT id FROM user WHERE email = 'camila.araujo@email.com'), NULL, '3x15', 'Burpee', 6, 'Exercício completo', 'Cardio', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example32'),
((SELECT id FROM user WHERE email = 'camila.araujo@email.com'), NULL, '3x20', 'Abdominais Infra', 6, 'Controle na descida', 'Core', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example33'),
((SELECT id FROM user WHERE email = 'thiago.nunes@email.com'), 35.0, '4x10', 'Remada Unilateral', 7, 'Um braço de cada vez', 'Superiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example34'),
((SELECT id FROM user WHERE email = 'thiago.nunes@email.com'), 40.0, '3x12', 'Puxada Frontal', 7, 'Costas largas', 'Superiores', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example35'),
((SELECT id FROM user WHERE email = 'thiago.nunes@email.com'), NULL, '3x30', 'Prancha com Toque', 7, 'Alternar mãos', 'Core', (SELECT id FROM user WHERE email = 'admin@systemfy.com'), 'https://www.youtube.com/watch?v=example36');

-- ============================================================
-- FINALIZAÇÃO
-- ============================================================
-- Reabilita a verificação de chaves estrangeiras
SET FOREIGN_KEY_CHECKS = 1;

-- Atualiza o AUTO_INCREMENT para o próximo ID disponível
ALTER TABLE user AUTO_INCREMENT = 36;
