DROP TABLE IF EXISTS cargos CASCADE;
CREATE TABLE cargos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS pessoas CASCADE;
CREATE TABLE pessoas (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telefone VARCHAR(20),
    data_nascimento DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS historico_cargos CASCADE;
CREATE TABLE historico_cargos (
    id SERIAL PRIMARY KEY,
    pessoa_id INTEGER NOT NULL,
    cargo_id INTEGER NOT NULL,
    data_inicio DATE NOT NULL,
    data_fim DATE, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    CONSTRAINT fk_pessoa
        FOREIGN KEY (pessoa_id)
        REFERENCES pessoas (id)
        ON DELETE CASCADE,
        
    CONSTRAINT fk_cargo
        FOREIGN KEY (cargo_id)
        REFERENCES cargos (id)
        ON DELETE RESTRICT 
);

INSERT INTO cargos (nome, descricao) VALUES
('Desenvolvedor Júnior', 'Responsável por correções de bugs e features simples.'),
('Desenvolvedor Pleno', 'Responsável por desenvolvimento de módulos completos.'),
('Tech Lead', 'Líder técnico da equipe e arquiteto de software.'),
('Product Owner', 'Responsável pelo backlog e regras de negócio.'),
('Designer UI/UX', 'Responsável pela prototipação e interfaces.');

INSERT INTO pessoas (nome, email, telefone, data_nascimento) VALUES
('Marcos Belato', 'marcos@email.com', '(11) 99999-0001', '1995-05-20'),
('André Diretor', 'andre@abe3.com.br', '(11) 99999-0002', '1985-10-10'),
('Maria Silva', 'maria@email.com', '(21) 98888-1234', '1998-01-15'),
('João Souza', 'joao@email.com', '(31) 97777-5555', '2000-12-25');

INSERT INTO historico_cargos (pessoa_id, cargo_id, data_inicio, data_fim) VALUES
(1, 1, '2023-01-01', '2024-01-01'), -- Jr (Passado)
(1, 2, '2024-01-02', NULL);        -- Pleno (Atual)

INSERT INTO historico_cargos (pessoa_id, cargo_id, data_inicio, data_fim) VALUES
(3, 5, '2024-06-01', NULL);

INSERT INTO historico_cargos (pessoa_id, cargo_id, data_inicio, data_fim) VALUES
(2, 3, '2022-01-01', NULL);