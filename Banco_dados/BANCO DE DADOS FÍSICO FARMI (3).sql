CREATE DATABASE IF NOT EXISTS BD_FAZENDA_INTELIGENTE;
USE BD_FAZENDA_INTELIGENTE;

CREATE TABLE USUARIOS (
    CPF VARCHAR(14) PRIMARY KEY UNIQUE,
    NOME VARCHAR(100) NOT NULL,
    EMAIL VARCHAR(100) UNIQUE NOT NULL,
    SENHA VARCHAR(255) NOT NULL,
    PERFIL VARCHAR(50),
    DATA_CADASTRO DATETIME DEFAULT CURRENT_TIMESTAMP,
    STATUS VARCHAR(20)
);


CREATE TABLE FAZENDA (
    ID_FAZENDA INT PRIMARY KEY AUTO_INCREMENT,
    NOME VARCHAR(100) NOT NULL,
    LATITUDE DECIMAL(10, 8),
    LONGITUDE DECIMAL(11, 8),
    LOGRADOURO VARCHAR(150),
    NUMERO VARCHAR(10),
    CEP VARCHAR(10),
    AREA_TOTAL DECIMAL(10, 2)
);


CREATE TABLE USUARIOS_FAZENDA (
    ID_USUARIO_FAZENDA INT AUTO_INCREMENT PRIMARY KEY,

    ID_CPF_USUARIOS VARCHAR(14),
    ID_FAZENDA INT,

    CONSTRAINT FK_USUARIO
        FOREIGN KEY (ID_CPF_USUARIOS)
        REFERENCES USUARIOS(CPF)
        ON DELETE CASCADE,

    CONSTRAINT FK_FAZENDA
        FOREIGN KEY (ID_FAZENDA)
        REFERENCES FAZENDA(ID_FAZENDA)
        ON DELETE CASCADE,

    CONSTRAINT UK_USUARIO_FAZENDA
        UNIQUE(ID_CPF_USUARIOS, ID_FAZENDA)
); 

CREATE TABLE CULTURA (
    ID_CULTURA INT PRIMARY KEY AUTO_INCREMENT,
    NOME_CULTURA VARCHAR(100) NOT NULL,
    DATA_PLANTIO DATE,
    CICLO_PRODUTIVO VARCHAR(50),
    AREA_CULTIVADA VARCHAR(50),
    TIPO_CULTURA VARCHAR(50),
    SENSOR_LUZ VARCHAR(50),
    SENSOR_CLIMA_TEMPO VARCHAR(50),
    SENSOR_CLIMA_UMIDADE VARCHAR(50),
    SENSOR_SOLO VARCHAR(50),
    STATUS VARCHAR(20),
    FK_ID_FAZENDA INT,
    FOREIGN KEY (FK_ID_FAZENDA) REFERENCES FAZENDA(ID_FAZENDA) ON DELETE CASCADE
);

CREATE TABLE SENSOR (
    ID_SENSOR INT PRIMARY KEY AUTO_INCREMENT,
    NOME_SENSOR VARCHAR(100) NOT NULL,
    TIPO_SENSOR VARCHAR(50) NOT NULL,
    UNIDADE_MEDIDA VARCHAR(20),
    STATUS VARCHAR(20),
    DATA_INSTALACAO DATE,
    FK_ID_CULTURA INT,
    FOREIGN KEY (FK_ID_CULTURA) REFERENCES CULTURA(ID_CULTURA) ON DELETE CASCADE
);

CREATE TABLE LEITURA_SENSOR (
    ID_LEITURA INT PRIMARY KEY AUTO_INCREMENT,
    VALOR VARCHAR(50),
    DATA_HORA DATETIME,
    FK_ID_SENSOR INT,
    FOREIGN KEY (FK_ID_SENSOR) REFERENCES SENSOR(ID_SENSOR) ON DELETE CASCADE
);

-- Tabela de Alertas
CREATE TABLE ALERTA (
    ID_ALERTA INT PRIMARY KEY AUTO_INCREMENT,
    TIPO_ALERTA VARCHAR(50),
    DESCRICAO TEXT,
    NIVEL_GRAVIDADE VARCHAR(20),
    DATA_HORA DATETIME,
    STATUS VARCHAR(20),
    FK_ID_SENSOR INT,
    FOREIGN KEY (FK_ID_SENSOR) REFERENCES SENSOR(ID_SENSOR)  ON DELETE CASCADE
);

-- -----------------------------------------------------
-- 2. INSERÇÃO DE DADOS (DML) - 30 REGISTROS POR TABELA
-- -----------------------------------------------------

-- Tabela: USUARIOS
INSERT INTO USUARIOS (CPF, NOME, EMAIL, SENHA, PERFIL, DATA_CADASTRO, STATUS) VALUES
('986.940.159-98', 'Carlos Henrique Souza', 'carlos.souza@farmi.com', '$2a$12$hash1', 'Funcionário', '2026-01-01', 'Inativo'),
('466.779.302-89', 'Mariana Oliveira Lima', 'mariana.lima@farmi.com', '$2a$12$hash2', 'Funcionário', '2026-01-02', 'Inativo'),
('392.915.914-76', 'João Pedro Martins', 'joao.martins@farmi.com', '$2a$12$hash3', 'Funcionário', '2026-01-03', 'Ativo'),
('773.195.818-52', 'Fernanda Almeida Costa', 'fernanda.costa@farmi.com', '$2a$12$hash4', 'Gestor', '2026-01-04', 'Inativo'),
('586.141.736-80', 'Lucas Gabriel Rocha', 'lucas.rocha@farmi.com', '$2a$12$hash5', 'Funcionário', '2026-01-05', 'Inativo'),
('546.234.640-58', 'Patrícia Mendes Silva', 'patricia.silva@farmi.com', '$2a$12$hash6', 'Gestor', '2026-01-06', 'Ativo'),
('842.360.936-87', 'Ricardo Fernandes', 'ricardo.fernandes@farmi.com', '$2a$12$hash7', 'Funcionário', '2026-01-07', 'Inativo'),
('627.748.774-47', 'Juliana Batista', 'juliana.batista@farmi.com', '$2a$12$hash8', 'Funcionário', '2026-01-08', 'Ativo'),
('918.993.566-11', 'Eduardo Ribeiro', 'eduardo.ribeiro@farmi.com', '$2a$12$hash9', 'Gestor', '2026-01-09', 'Inativo'),
('363.933.686-89', 'Camila Ferreira', 'camila.ferreira@farmi.com', '$2a$12$hash10', 'Gestor', '2026-01-10', 'Inativo'),
('567.259.586-67', 'Gustavo Carvalho', 'gustavo.carvalho@farmi.com', '$2a$12$hash11', 'Funcionário', '2026-01-11', 'Inativo'),
('644.787.283-94', 'Larissa Moraes', 'larissa.moraes@farmi.com', '$2a$12$hash12', 'Funcionário', '2026-01-12', 'Inativo'),
('212.842.910-25', 'Felipe Barbosa', 'felipe.barbosa@farmi.com', '$2a$12$hash13', 'Funcionário', '2026-01-13', 'Inativo'),
('426.340.598-36', 'Aline Gonçalves', 'aline.goncalves@farmi.com', '$2a$12$hash14', 'Funcionário', '2026-01-14', 'Inativo'),
('776.569.645-89', 'Thiago Moreira', 'thiago.moreira@farmi.com', '$2a$12$hash15', 'Funcionário', '2026-01-15', 'Ativo'),
('581.664.202-16', 'Renata Cardoso', 'renata.cardoso@farmi.com', '$2a$12$hash16', 'Gestor', '2026-01-16', 'Ativo'),
('965.599.515-20', 'Vinícius Teixeira', 'vinicius.teixeira@farmi.com', '$2a$12$hash17', 'Funcionário', '2026-01-17', 'Ativo'),
('921.626.431-50', 'Bruna Nascimento', 'bruna.nascimento@farmi.com', '$2a$12$hash18', 'Funcionário', '2026-01-18', 'Inativo'),
('867.656.578-49', 'André Luiz Santos', 'andre.santos@farmi.com', '$2a$12$hash19', 'Gestor', '2026-01-19', 'Ativo'),
('348.966.387-97', 'Paula Cristina Melo', 'paula.melo@farmi.com', '$2a$12$hash20', 'Gestor', '2026-01-20', 'Ativo'),
('892.647.747-34', 'Rafael Vieira', 'rafael.vieira@farmi.com', '$2a$12$hash21', 'Funcionário', '2026-01-21', 'Inativo'),
('293.896.546-68', 'Daniela Freitas', 'daniela.freitas@farmi.com', '$2a$12$hash22', 'Gestor', '2026-01-22', 'Inativo'),
('744.421.414-61', 'Marcelo Pires', 'marcelo.pires@farmi.com', '$2a$12$hash23', 'Gestor', '2026-01-23', 'Inativo'),
('736.769.435-87', 'Beatriz Cavalcante', 'beatriz.cavalcante@farmi.com', '$2a$12$hash24', 'Funcionário', '2026-01-24', 'Inativo'),
('135.295.763-96', 'Leonardo Azevedo', 'leonardo.azevedo@farmi.com', '$2a$12$hash25', 'Gestor', '2026-01-25', 'Inativo'),
('600.256.208-56', 'Natália Rodrigues', 'natalia.rodrigues@farmi.com', '$2a$12$hash26', 'Funcionário', '2026-01-26', 'Ativo'),
('132.914.641-47', 'Roberto Falcão', 'roberto.falcao@farmi.com', '$2a$12$hash27', 'Gestor', '2026-01-27', 'Ativo'),
('126.194.159-23', 'Priscila Andrade', 'priscila.andrade@farmi.com', '$2a$12$hash28', 'Gestor', '2026-01-28', 'Inativo'),
('601.164.162-84', 'Henrique Duarte', 'henrique.duarte@farmi.com', '$2a$12$hash29', 'Funcionário', '2026-01-29', 'Ativo'),
('673.853.598-38', 'Isabela Martins', 'isabela.martins@farmi.com', '$2a$12$hash30', 'Funcionário', '2026-01-30', 'Ativo'),
('986.940.169-98', 'Teste 2', 'farmi@farmi.com', '$2y$10$RmP6i.sLMmNN8LMLefhAteMJIXnR/Fjwk6s3av8iIJc8ugaIXGIHa', 'Funcionário', '2026-01-01', 'Inativo'),
('916.940.169-98', 'Teste 3', 'admin@farmi.com', '$2a$10$VZHo.f8rlCHqE25pKWseM.QABlDbAwYIZdsyt1wreHEXrbfU826H.', 'Gestor', '2026-01-01', 'Inativo');


-- Tabela: FAZENDA
INSERT INTO FAZENDA (ID_FAZENDA, NOME, LATITUDE, LONGITUDE, LOGRADOURO, NUMERO, CEP, AREA_TOTAL) VALUES
(1, 'Fazenda Santa Helena', -15.665, -49.062, 'Rodovia GO-080', 1200, '76380-000', 514.29),
(2, 'Fazenda Boa Esperança', -20.120, -47.491, 'Estrada Municipal Barreto', 450, '14780-000', 378.36),
(3, 'Fazenda Vale Verde', -22.291, -53.542, 'Rodovia MS-276', 980, '79750-000', 340.52),
(4, 'Fazenda Rio Dourado', -17.301, -53.303, 'Estrada da Serra', 320, '75900-000', 210.87),
(5, 'Fazenda Recanto Feliz', -15.771, -45.800, 'Rodovia BR-251', 2100, '39400-000', 395.15),
(6, 'Fazenda Horizonte Azul', -22.941, -45.278, 'Estrada do Ribeirão', 150, '12570-000', 260.06),
(7, 'Fazenda Campo Belo', -20.916, -47.768, 'Avenida Rural Sul', 890, '14600-000', 295.16),
(8, 'Fazenda São Joaquim', -18.576, -53.013, 'Rodovia BR-060', 640, '75830-000', 510.36),
(9, 'Fazenda Primavera', -15.379, -49.719, 'Estrada do Cedro', 740, '75400-000', 412.00),
(10, 'Fazenda Bela Vista', -22.235, -47.420, 'Rodovia Anhanguera', 3000, '13600-000', 482.88),
(11, 'Fazenda Ouro Branco', -17.029, -47.038, 'Estrada da Lagoa', 580, '73850-000', 523.55),
(12, 'Fazenda Água Limpa', -24.595, -46.084, 'Rua das Palmeiras', 75, '11750-000', 586.39),
(13, 'Fazenda Santa Rita', -23.533, -50.122, 'Estrada do Café', 430, '86300-000', 55.84),
(14, 'Fazenda Lago Azul', -16.322, -49.502, 'Rodovia GO-020', 920, '75120-000', 403.46),
(15, 'Fazenda Nova União', -19.037, -52.678, 'Estrada Boa Vista', 640, '79560-000', 216.87),
(16, 'Fazenda Serra Verde', -17.206, -52.112, 'Rodovia GO-174', 1550, '75930-000', 541.43),
(17, 'Fazenda Palmeiras', -16.171, -48.932, 'Estrada do Ipê', 220, '72900-000', 290.74),
(18, 'Fazenda Sol Nascente', -22.061, -51.294, 'Avenida Rural Norte', 510, '19000-000', 312.98),
(19, 'Fazenda Pôr do Sol', -24.274, -54.278, 'Estrada Santa Cruz', 840, '85960-000', 543.48),
(20, 'Fazenda Recanto Verde', -20.349, -51.343, 'Rodovia BR-158', 1730, '79600-000', 426.01),
(21, 'Fazenda Monte Alegre', -17.509, -49.664, 'Estrada do Campo', 370, '75690-000', 594.74),
(22, 'Fazenda São Pedro', -16.255, -51.940, 'Rodovia GO-164', 1410, '76200-000', 260.52),
(23, 'Fazenda Esperança do Sul', -21.179, -51.477, 'Estrada Santa Luzia', 210, '16200-000', 60.80),
(24, 'Fazenda Rio Verde', -19.027, -50.915, 'Rodovia BR-364', 2220, '75800-000', 508.27),
(25, 'Fazenda Alto da Serra', -24.073, -50.921, 'Estrada da Colina', 95, '84200-000', 285.09),
(26, 'Fazenda Cachoeira', -19.067, -53.996, 'Rodovia MS-395', 1770, '79480-000', 337.42),
(27, 'Fazenda Santa Clara', -16.763, -50.796, 'Estrada Horizonte', 615, '76190-000', 420.33),
(28, 'Fazenda Estrela do Norte', -19.176, -52.222, 'Rodovia GO-210', 1080, '75860-000', 181.64),
(29, 'Fazenda Três Lagoas', -21.163, -51.870, 'Estrada Municipal Oeste', 260, '79640-000', 59.71),
(30, 'Fazenda Vista Alegre', -18.129, -46.918, 'Rodovia MG-188', 980, '38700-000', 525.76);


-- Tabela: CULTURA
INSERT INTO CULTURA (ID_CULTURA, NOME_CULTURA, DATA_PLANTIO, CICLO_PRODUTIVO, AREA_CULTIVADA, TIPO_CULTURA, SENSOR_LUZ, SENSOR_CLIMA_TEMPO, SENSOR_CLIMA_UMIDADE, SENSOR_SOLO, STATUS, FK_ID_FAZENDA) VALUES
(1, 'Milho', '2026-03-01', 120, 18, 'Grãos', 500, 28, 65, 70, 'Ativa', 1),
(2, 'Soja', '2026-03-02', 110, 22, 'Grãos', 450, 26, 70, 68, 'Ativa', 2),
(3, 'Tomate', '2026-03-03', 90, 12, 'Hortaliças', 700, 24, 75, 80, 'Ativa', 3),
(4, 'Alface', '2026-03-04', 60, 8, 'Folhosas', 350, 22, 80, 60, 'Ativa', 4),
(5, 'Melancia', '2026-03-05', 130, 25, 'Frutas', 600, 27, 85, 90, 'Ativa', 5),
(6, 'Feijão', '2026-03-06', 100, 15, 'Leguminosas', 480, 25, 68, 65, 'Ativa', 6),
(7, 'Batata', '2026-03-07', 95, 10, 'Tubérculos', 400, 20, 72, 75, 'Ativa', 7),
(8, 'Mandioca', '2026-03-08', 365, 40, 'Tubérculos', 800, 30, 60, 55, 'Ativa', 8),
(9, 'Ervilha', '2026-03-09', 115, 20, 'Leguminosas', 520, 21, 58, 50, 'Ativa', 9),
(10, 'Morango', '2026-03-10', 150, 16, 'Frutas', 650, 29, 55, 45, 'Ativa', 10),
(11, 'Milho', '2026-03-11', 120, 19, 'Grãos', 500, 28, 65, 70, 'Ativa', 11),
(12, 'Soja', '2026-03-12', 110, 23, 'Grãos', 450, 26, 70, 68, 'Ativa', 12),
(13, 'Tomate', '2026-03-13', 90, 13, 'Hortaliças', 700, 24, 75, 80, 'Ativa', 13),
(14, 'Repolho', '2026-03-14', 80, 14, 'Folhosas', 350, 22, 80, 60, 'Ativa', 14),
(15, 'Melão', '2026-03-15', 130, 26, 'Frutas', 600, 27, 85, 90, 'Ativa', 15),
(16, 'Feijão', '2026-03-16', 100, 16, 'Leguminosas', 480, 25, 68, 65, 'Ativa', 16),
(17, 'Batata', '2026-03-17', 95, 11, 'Tubérculos', 400, 20, 72, 75, 'Ativa', 17),
(18, 'Mandioca', '2026-03-18', 365, 41, 'Tubérculos', 800, 30, 60, 55, 'Ativa', 18),
(19, 'Ervilha', '2026-03-19', 115, 21, 'Leguminosas', 520, 21, 58, 50, 'Ativa', 19),
(20, 'Mamão', '2026-03-20', 150, 17, 'Frutas', 650, 29, 55, 45, 'Ativa', 20),
(21, 'Milho', '2026-03-21', 120, 20, 'Grãos', 500, 28, 65, 70, 'Ativa', 21),
(22, 'Soja', '2026-03-22', 110, 24, 'Grãos', 450, 26, 70, 68, 'Ativa', 22),
(23, 'Tomate', '2026-03-23', 90, 14, 'Hortaliças', 700, 24, 75, 80, 'Ativa', 23),
(24, 'Alface', '2026-03-24', 60, 9, 'Folhosas', 350, 22, 80, 60, 'Ativa', 24),
(25, 'Melancia', '2026-03-25', 130, 27, 'Frutas', 600, 27, 85, 90, 'Ativa', 25),
(26, 'Feijão', '2026-03-26', 100, 17, 'Leguminosas', 480, 25, 68, 65, 'Ativa', 26),
(27, 'Batata', '2026-03-27', 95, 12, 'Tubérculos', 400, 20, 72, 75, 'Ativa', 27),
(28, 'Mandioca', '2026-03-28', 365, 42, 'Tubérculos', 800, 30, 60, 55, 'Ativa', 28),
(29, 'Ervilha', '2026-03-29', 115, 22, 'Leguminosas', 520, 21, 58, 50, 'Ativa', 29),
(30, 'Morango', '2026-03-30', 150, 18, 'Frutas', 650, 29, 55, 45, 'Ativa', 30);


-- Tabela: SENSOR
INSERT INTO SENSOR (ID_SENSOR, NOME_SENSOR, TIPO_SENSOR, UNIDADE_MEDIDA, STATUS, DATA_INSTALACAO, FK_ID_CULTURA) VALUES
(1,  'Sensor Umidade 01',     'Umidade',     '%',   'Ativo',   '2023-01-10', 26),
(2,  'Sensor Luz 02',         'Luz',         'Lux', 'Ativo',   '2023-01-10', 15),
(3,  'Sensor Luz 03',         'Luz',         'Lux', 'Inativo', '2023-01-10', 8),
(4,  'Sensor Umidade 04',     'Umidade',     '%',   'Ativo',   '2023-01-10', 2),
(5,  'Sensor Umidade 05',     'Umidade',     '%',   'Inativo', '2023-01-10', 7),
(6,  'Sensor Temperatura 06', 'Temperatura', 'Cº',  'Ativo',   '2023-01-10', 15),
(7,  'Sensor Umidade 07',     'Umidade',     '%',   'Ativo',   '2023-01-10', 25),
(8,  'Sensor Luz 08',         'Luz',         'Lux', 'Ativo',   '2023-01-10', 13),
(9,  'Sensor Solo 09',        'Solo',        '%',   'Ativo',   '2023-01-10', 24),
(10, 'Sensor Solo 10',        'Solo',        '%',   'Inativo', '2023-01-10', 9),
(11, 'Sensor Solo 11',        'Solo',        '%',   'Ativo',   '2023-01-10', 30),
(12, 'Sensor Luz 12',         'Luz',         'Lux', 'Ativo',   '2023-01-10', 15),
(13, 'Sensor Umidade 13',     'Umidade',     '%',   'Ativo',   '2023-01-10', 1),
(14, 'Sensor Luz 14',         'Luz',         'Lux', 'Inativo', '2023-01-10', 21),
(15, 'Sensor Luz 15',         'Luz',         'Lux', 'Ativo',   '2023-01-10', 12),
(16, 'Sensor Umidade 16',     'Umidade',     '%',   'Ativo',   '2023-01-10', 22),
(17, 'Sensor Solo 17',        'Solo',        '%',   'Ativo',   '2023-01-10', 10),
(18, 'Sensor Umidade 18',     'Umidade',     '%',   'Inativo', '2023-01-10', 10),
(19, 'Sensor Solo 19',        'Solo',        '%',   'Ativo',   '2023-01-10', 9),
(20, 'Sensor Luz 20',         'Luz',         'Lux', 'Ativo',   '2023-01-10', 6),
(21, 'Sensor Solo 21',        'Solo',        '%',   'Inativo', '2023-01-10', 4),
(22, 'Sensor Umidade 22',     'Umidade',     '%',   'Ativo',   '2023-01-10', 6),
(23, 'Sensor Temperatura 23', 'Temperatura', 'Cº',  'Ativo',   '2023-01-10', 26),
(24, 'Sensor Luz 24',         'Luz',         'Lux', 'Ativo',   '2023-01-10', 21),
(25, 'Sensor Temperatura 25', 'Temperatura', 'Cº',  'Inativo', '2023-01-10', 27),
(26, 'Sensor Temperatura 26', 'Temperatura', 'Cº',  'Ativo',   '2023-01-10', 2),
(27, 'Sensor Temperatura 27', 'Temperatura', 'Cº',  'Ativo',   '2023-01-10', 5),
(28, 'Sensor Umidade 28',     'Umidade',     '%',   'Inativo', '2023-01-10', 20),
(29, 'Sensor Temperatura 29', 'Temperatura', 'Cº',  'Ativo',   '2023-01-10', 4),
(30, 'Sensor Umidade 30',     'Umidade',     '%',   'Ativo',   '2023-01-10', 7);

-- Tabela: LEITURA_SENSOR
INSERT INTO LEITURA_SENSOR (VALOR, DATA_HORA, FK_ID_SENSOR) VALUES
('23.5', '2026-05-01 08:00:00', 3),
('24.1', '2026-05-01 09:00:00', 3),
('22.8', '2026-05-01 10:00:00', 3),
('25.0', '2026-05-01 11:00:00', 3),
('26.3', '2026-05-01 12:00:00', 3),
('21.9', '2026-05-01 13:00:00', 3),
('27.4', '2026-05-01 14:00:00', 4),
('28.0', '2026-05-01 15:00:00', 4),
('20.7', '2026-05-01 16:00:00', 5),
('19.5', '2026-05-01 17:00:00', 5),
('30.1', '2026-05-02 08:00:00', 6),
('29.8', '2026-05-02 09:00:00', 10),
('31.2', '2026-05-02 10:00:00', 10),
('32.5', '2026-05-02 11:00:00', 10),
('18.4', '2026-05-02 12:00:00', 3),
('17.9', '2026-05-02 13:00:00', 3),
('16.8', '2026-05-02 14:00:00', 4),
('15.7', '2026-05-02 15:00:00', 4),
('14.9', '2026-05-02 16:00:00', 5),
('13.5', '2026-05-02 17:00:00', 5),
('40.2', '2026-05-03 08:00:00', 1),
('39.7', '2026-05-03 09:00:00', 1),
('38.1', '2026-05-03 10:00:00', 2),
('37.6', '2026-05-03 11:00:00', 2),
('36.0', '2026-05-03 12:00:00', 3),
('35.5', '2026-05-03 13:00:00', 3),
('34.2', '2026-05-03 14:00:00', 4),
('33.8', '2026-05-03 15:00:00', 4),
('32.1', '2026-05-03 16:00:00', 5),
('31.4', '2026-05-03 17:00:00', 5);

SELECT * FROM USUARIOS_FAZENDA;
SELECT CPF FROM USUARIOS;

-- Tabela: ALERTA
INSERT INTO ALERTA (ID_ALERTA, TIPO_ALERTA, DESCRICAO, NIVEL_GRAVIDADE, DATA_HORA, STATUS, FK_ID_SENSOR) VALUES
(1, 'Umidade Baixa', 'Solo seco detectado', 'Médio', '2026-03-10 08:00', 'Ativo', 11),
(2, 'Temperatura Alta', 'Risco de estresse térmico', 'Baixo', '2026-03-10 09:00', 'Ativo', 22),
(3, 'Alerta 3', 'Descricao do alerta genérico', 'Baixo', '2026-03-10 10:00', 'Ativo', 20),
(4, 'Crítico', 'Falha na irrigação detectada', 'Alto', '2026-03-10 11:00', 'Ativo', 8),
(5, 'PH Solo', 'Acidez acima do limite', 'Médio', '2026-03-11 07:00', 'Inativo', 16),
(6, 'Vento Forte', 'Risco para estrutura de estufas', 'Alto', '2026-03-11 14:00', 'Ativo', 5),
(7, 'Falta de Luz', 'Sensor de luminosidade obstruído', 'Baixo', '2026-03-12 18:00', 'Ativo', 19),
(8, 'Superaquecimento', 'Painel solar com alta temperatura', 'Alto', '2026-03-12 12:00', 'Ativo', 24),
(9, 'Invasão', 'Movimento detectado em área restrita', 'Alto', '2026-03-13 02:00', 'Ativo', 17),
(10, 'Geada', 'Risco de geada na madrugada', 'Alto', '2026-03-14 04:00', 'Ativo', 15),
(11, 'Urgente', 'Nível de PH instável', 'Alto', '2026-03-10 08:30', 'Ativo', 4),
(12, 'Conexão', 'Sensor offline há mais de 1 hora', 'Baixo', '2026-03-15 10:00', 'Inativo', 2),
(13, 'Umidade Alta', 'Risco de fungos na cultura', 'Médio', '2026-03-15 15:00', 'Ativo', 10),
(14, 'Nível de Água', 'Reservatório abaixo de 10%', 'Baixo', '2026-03-16 09:00', 'Ativo', 26),
(15, 'Calibração', 'Sensor necessita calibração anual', 'Médio', '2026-03-16 11:00', 'Ativo', 5),
(16, 'Bateria', 'Troca de bateria recomendada', 'Médio', '2026-03-16 14:00', 'Ativo', 24),
(17, 'Nitrogênio', 'Baixo nível de nutrientes detectado', 'Médio', '2026-03-17 08:00', 'Ativo', 21),
(18, 'Obstrução', 'Limpeza do sensor necessária', 'Baixo', '2026-03-17 09:00', 'Ativo', 24),
(19, 'Fogo', 'Fumaça detectada em área de mata', 'Alto', '2026-03-17 13:00', 'Ativo', 6),
(20, 'Pressão Baixa', 'Pressão do sistema abaixo do ideal', 'Médio', '2026-03-18 08:00', 'Ativo', 12),
(21, 'Excesso de Chuva', 'Volume de chuva acima do esperado', 'Médio', '2026-03-18 11:00', 'Ativo', 3),
(22, 'Sensor Danificado', 'Possível dano físico no equipamento', 'Alto', '2026-03-18 15:00', 'Ativo', 18),
(23, 'Oscilação', 'Leituras inconsistentes detectadas', 'Baixo', '2026-03-19 09:00', 'Inativo', 9),
(24, 'Energia', 'Queda de energia no setor agrícola', 'Alto', '2026-03-19 20:00', 'Ativo', 14),
(25, 'Irrigação', 'Fluxo de água interrompido', 'Alto', '2026-03-20 06:00', 'Ativo', 1),
(26, 'Temperatura Baixa', 'Temperatura abaixo do recomendado', 'Médio', '2026-03-20 07:30', 'Ativo', 13),
(27, 'Falha Mecânica', 'Motor do sistema apresentou falhas', 'Alto', '2026-03-20 13:00', 'Ativo', 7),
(28, 'Atualização', 'Firmware do sensor desatualizado', 'Baixo', '2026-03-21 10:00', 'Inativo', 23),
(29, 'Pragas', 'Movimentação incomum identificada na plantação', 'Médio', '2026-03-21 17:00', 'Ativo', 27),
(30, 'Manutenção', 'Bateria do sensor fraca', 'Baixo', '2026-03-10 15:00', 'Ativo', 29);

-- Tabela: USUARIOS_FAZENDA
INSERT INTO USUARIOS_FAZENDA (ID_CPF_USUARIOS, ID_FAZENDA) VALUES
('126.194.159-23', 1),
('132.914.641-47', 2),
('135.295.763-96', 3),
('212.842.910-25', 4),
('293.896.546-68', 5),
('348.966.387-97', 6),
('363.933.686-89', 7),
('392.915.914-76', 8),
('426.340.598-36', 9),
('466.779.302-89', 10),
('546.234.640-58', 11),
('567.259.586-67', 12),
('581.664.202-16', 13),
('586.141.736-80', 14),
('600.256.208-56', 15),
('601.164.162-84', 16),
('627.748.774-47', 17),
('644.787.283-94', 18),
('673.853.598-38', 19),
('736.769.435-87', 20),
('744.421.414-61', 21),
('773.195.818-52', 22),
('776.569.645-89', 23),
('842.360.936-87', 24),
('867.656.578-49', 25),
('892.647.747-34', 26),
('918.993.566-11', 27),
('921.626.431-50', 28),
('965.599.515-20', 29),
('986.940.159-98', 30);

 -- USUARIOS
SELECT * FROM USUARIOS;
SELECT COUNT(*) FROM USUARIOS;
SELECT * FROM USUARIOS LIMIT 5;
SELECT * FROM USUARIOS ORDER BY 1 DESC;
SELECT * FROM USUARIOS WHERE STATUS = 'Ativo';
SELECT * FROM USUARIOS WHERE PERFIL = 'Admin';
SELECT NOME, EMAIL FROM USUARIOS;
SELECT * FROM USUARIOS WHERE DATA_CADASTRO > '2026-01-15';
SELECT DISTINCT PERFIL FROM USUARIOS;
SELECT * FROM USUARIOS WHERE EMAIL LIKE '%farmi.com';


-- FAZENDA
SELECT * FROM FAZENDA;
SELECT COUNT(*) FROM FAZENDA;
SELECT * FROM FAZENDA LIMIT 5;
SELECT * FROM FAZENDA ORDER BY 1 DESC;
SELECT NOME FROM FAZENDA WHERE AREA_TOTAL > 100;
SELECT * FROM FAZENDA WHERE CEP LIKE '77%';
SELECT AVG(AREA_TOTAL) FROM FAZENDA;
SELECT MAX(AREA_TOTAL) FROM FAZENDA;
SELECT NOME FROM FAZENDA WHERE NOME LIKE 'Fazenda%';
SELECT * FROM FAZENDA WHERE NUMERO > 100;

-- CULTURA
SELECT * FROM CULTURA;
SELECT COUNT(*) FROM CULTURA;
SELECT * FROM CULTURA LIMIT 5;
SELECT * FROM CULTURA ORDER BY 1 DESC;
SELECT * FROM CULTURA WHERE TIPO_CULTURA = 'Grão';
SELECT * FROM CULTURA WHERE NOME_CULTURA = 'Soja';
SELECT * FROM CULTURA WHERE AREA_CULTIVADA > '10';
SELECT DISTINCT TIPO_CULTURA FROM CULTURA;
SELECT * FROM CULTURA WHERE FK_ID_FAZENDA = 1;
SELECT NOME_CULTURA, TIPO_CULTURA FROM CULTURA WHERE NOME_CULTURA LIKE '%a';

-- SENSOR
SELECT * FROM SENSOR;
SELECT COUNT(*) FROM SENSOR;
SELECT * FROM SENSOR LIMIT 5;
SELECT * FROM SENSOR ORDER BY 1 DESC;
SELECT * FROM SENSOR WHERE STATUS = 'Ativo';
SELECT * FROM SENSOR WHERE TIPO_SENSOR = 'Solo';
SELECT * FROM SENSOR WHERE DATA_INSTALACAO > '2026-01-01';
SELECT DISTINCT TIPO_SENSOR FROM SENSOR;
SELECT * FROM SENSOR WHERE FK_ID_CULTURA IS NOT NULL;
SELECT * FROM SENSOR WHERE STATUS = 'Inativo';

-- LEITURA_SENSOR
SELECT * FROM LEITURA_SENSOR;
SELECT COUNT(*) FROM LEITURA_SENSOR;
SELECT * FROM LEITURA_SENSOR LIMIT 5;
SELECT * FROM LEITURA_SENSOR ORDER BY 1 DESC;
SELECT * FROM LEITURA_SENSOR WHERE DATA_HORA > '2026-03-01';
SELECT * FROM LEITURA_SENSOR WHERE VALOR > '50';
SELECT AVG(CAST(VALOR AS DECIMAL)) FROM LEITURA_SENSOR;
SELECT * FROM LEITURA_SENSOR WHERE FK_ID_SENSOR = 1;
SELECT MAX(VALOR) FROM LEITURA_SENSOR;
SELECT * FROM LEITURA_SENSOR ORDER BY DATA_HORA ASC;

-- ALERTA
SELECT * FROM ALERTA;
SELECT COUNT(*) FROM ALERTA;
SELECT * FROM ALERTA LIMIT 5;
SELECT * FROM ALERTA ORDER BY 1 DESC;
SELECT * FROM ALERTA WHERE NIVEL_GRAVIDADE = 'Alto';
SELECT * FROM ALERTA WHERE STATUS = 'Ativo';
SELECT * FROM ALERTA WHERE DATA_HORA >= CURRENT_TIMESTAMP;
SELECT DISTINCT TIPO_ALERTA FROM ALERTA;
SELECT * FROM ALERTA WHERE FK_ID_SENSOR = 1;
SELECT * FROM ALERTA WHERE DESCRICAO LIKE '%critico%';

SELECT C.NOME_CULTURA, F.NOME FROM CULTURA C JOIN FAZENDA F ON C.FK_ID_FAZENDA = F.ID_FAZENDA;
SELECT S.TIPO_SENSOR, C.NOME_CULTURA FROM SENSOR S JOIN CULTURA C ON S.FK_ID_CULTURA = C.ID_CULTURA;
SELECT L.VALOR, S.TIPO_SENSOR FROM LEITURA_SENSOR L JOIN SENSOR S ON L.FK_ID_SENSOR = S.ID_SENSOR;
SELECT A.TIPO_ALERTA, F.NOME FROM ALERTA A JOIN SENSOR S ON A.FK_ID_SENSOR = S.ID_SENSOR JOIN CULTURA C ON S.FK_ID_CULTURA = C.ID_CULTURA JOIN FAZENDA F ON C.FK_ID_FAZENDA = F.ID_FAZENDA;
SELECT C.NOME_CULTURA, AVG(CAST(L.VALOR AS DECIMAL)) FROM LEITURA_SENSOR L JOIN SENSOR S ON L.FK_ID_SENSOR = S.ID_SENSOR JOIN CULTURA C ON S.FK_ID_CULTURA = C.ID_CULTURA GROUP BY C.NOME_CULTURA;
SELECT F.NOME, COUNT(S.ID_SENSOR) FROM FAZENDA F JOIN CULTURA C ON F.ID_FAZENDA = C.FK_ID_FAZENDA JOIN SENSOR S ON C.ID_CULTURA = S.FK_ID_CULTURA WHERE S.STATUS = 'Ativo' GROUP BY F.NOME;
SELECT F.NOME, MAX(L.DATA_HORA) FROM FAZENDA F JOIN CULTURA C ON F.ID_FAZENDA = C.FK_ID_FAZENDA JOIN SENSOR S ON C.ID_CULTURA = S.FK_ID_CULTURA JOIN LEITURA_SENSOR L ON S.ID_SENSOR = L.FK_ID_SENSOR GROUP BY F.NOME;
SELECT A.DESCRICAO, C.NOME_CULTURA FROM ALERTA A JOIN SENSOR S ON A.FK_ID_SENSOR = S.ID_SENSOR JOIN CULTURA C ON S.FK_ID_CULTURA = C.ID_CULTURA WHERE A.NIVEL_GRAVIDADE = 'Alto';
SELECT DISTINCT F.NOME FROM FAZENDA F JOIN CULTURA C ON F.ID_FAZENDA = C.FK_ID_FAZENDA WHERE C.TIPO_CULTURA = 'Grão';
SELECT S.TIPO_SENSOR, F.LOGRADOURO, F.NUMERO FROM SENSOR S JOIN CULTURA C ON S.FK_ID_CULTURA = C.ID_CULTURA JOIN FAZENDA F ON C.FK_ID_FAZENDA = F.ID_FAZENDA;


SELECT F.NOME,
       SUM(CAST(REPLACE(C.AREA_CULTIVADA, 'ha', '') AS DECIMAL))
FROM FAZENDA F
JOIN CULTURA C ON F.ID_FAZENDA = C.FK_ID_FAZENDA
GROUP BY F.NOME;


SELECT S.ID_SENSOR FROM SENSOR S LEFT JOIN LEITURA_SENSOR L ON S.ID_SENSOR = L.FK_ID_SENSOR WHERE L.ID_LEITURA IS NULL;
SELECT S.TIPO_SENSOR, A.TIPO_ALERTA, A.DATA_HORA FROM SENSOR S JOIN ALERTA A ON S.ID_SENSOR = A.FK_ID_SENSOR ORDER BY S.TIPO_SENSOR;
SELECT C.NOME_CULTURA FROM CULTURA C JOIN SENSOR S ON C.ID_CULTURA = S.FK_ID_CULTURA WHERE S.TIPO_SENSOR = 'Solo';
SELECT DISTINCT F.NOME FROM FAZENDA F JOIN CULTURA C ON F.ID_FAZENDA = C.FK_ID_FAZENDA JOIN SENSOR S ON C.ID_CULTURA = S.FK_ID_CULTURA JOIN ALERTA A ON S.ID_SENSOR = A.FK_ID_SENSOR WHERE A.STATUS = 'Inativo';
SELECT AVG(F.AREA_TOTAL) FROM FAZENDA F JOIN CULTURA C ON F.ID_FAZENDA = C.FK_ID_FAZENDA WHERE C.NOME_CULTURA = 'Soja';
SELECT S.DATA_INSTALACAO, F.NOME FROM SENSOR S JOIN CULTURA C ON S.FK_ID_CULTURA = C.ID_CULTURA JOIN FAZENDA F ON C.FK_ID_FAZENDA = F.ID_FAZENDA;
SELECT F.NOME, A.NIVEL_GRAVIDADE, COUNT(*) FROM FAZENDA F JOIN CULTURA C ON F.ID_FAZENDA = C.FK_ID_FAZENDA JOIN SENSOR S ON C.ID_CULTURA = S.FK_ID_CULTURA JOIN ALERTA A ON S.ID_SENSOR = A.FK_ID_SENSOR GROUP BY F.NOME, A.NIVEL_GRAVIDADE;
SELECT C.NOME_CULTURA, S.STATUS FROM CULTURA C JOIN SENSOR S ON C.ID_CULTURA = S.FK_ID_CULTURA WHERE S.TIPO_SENSOR = 'Luminosidade';
SELECT F.NOME, C.NOME_CULTURA, S.TIPO_SENSOR, L.VALOR FROM FAZENDA F JOIN CULTURA C ON F.ID_FAZENDA = C.FK_ID_FAZENDA JOIN SENSOR S ON C.ID_CULTURA = S.FK_ID_CULTURA JOIN LEITURA_SENSOR L ON S.ID_SENSOR = L.FK_ID_SENSOR;

