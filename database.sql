-- database.sql

DROP TABLE IF EXISTS filmes;
DROP TABLE IF EXISTS generos;

-- Entidade Secundária: generos
CREATE TABLE generos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE,
    descricao TEXT
);

-- Entidade Principal: filmes
CREATE TABLE filmes (
    id SERIAL PRIMARY KEY,
    destaque boolean NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    sinopse TEXT,
    ano_lancamento INT,
    duracao_minutos INT,
    caminho_imagem VARCHAR(255) NOT NULL,
    genero_id INT,

    CONSTRAINT fk_genero
        FOREIGN KEY(genero_id)
        REFERENCES generos(id)
        ON DELETE SET NULL
);

INSERT INTO generos (nome, descricao) VALUES
('Ação', 'Filmes com foco em sequências de ação, como lutas e perseguições.'),
('Comédia', 'Filmes que buscam provocar o riso no espectador.'),
('Ficção Científica', 'Filmes que exploram conceitos científicos e tecnológicos futuristas.'),
('Drama', 'Filmes com foco no desenvolvimento emocional e relacional dos personagens.');