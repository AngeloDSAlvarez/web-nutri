CREATE DATABASE IF NOT EXISTS nutri_db;

USE nutri_db;

CREATE TABLE alimentos_tbl(
	id_alimento INT PRIMARY KEY AUTO_INCREMENT,
    nome_alimento VARCHAR(255) NOT NULL,
    tipo_medida ENUM('gramas', 'kilos', 'ml', 'l', 'fatias', 'unidades') NOT NULL,
    quantidade FLOAT DEFAULT 100 NOT NULL 
);

CREATE TABLE nutrientes_tbl(
	id_nutriente INT PRIMARY KEY AUTO_INCREMENT,
    id_alimento INT NOT NULL,
    calorias FLOAT NOT NULL,
    carboidrato FLOAT NOT NULL,
    proteina FLOAT NOT NULL,
    gordura FLOAT NOT NULL,
    gordura_saturada FLOAT,
    acucares FLOAT,
    
    CONSTRAINT fk_nutri_do_alimento FOREIGN KEY (id_alimento) REFERENCES alimentos_tbl(id_alimento)
);
DESC nutrientes_tbl;



CREATE TABLE pacientes_tbl(
	id_pac INT PRIMARY KEY AUTO_INCREMENT,
    nome_pac VARCHAR(100) NOT NULL,
    sobrenome_pac VARCHAR(100) NOT NULL,
    telefone_pac VARCHAR(20) NOT NULL,
    cpf_pac VARCHAR(15),
    email_pac VARCHAR(30)
);

CREATE TABLE refeicoes_tbl(
	id_ref INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT NOT NULL,
    nome_ref VARCHAR(200) NOT NULL,
    info_adicional_ref VARCHAR(255),
    horario_ref VARCHAR(5),
    ali_um INT,
	quant_um FLOAT,
	ali_dois INT,
	quant_dois FLOAT,
	ali_tres INT,
	quant_tres FLOAT,
	ali_quatro INT,
	quant_quatro FLOAT,
	ali_cinco INT,
	quant_cinco FLOAT,
	ali_seis INT,
	quant_seis FLOAT,
	ali_sete INT,
	quant_sete FLOAT,
	ali_oito INT,
	quant_oito FLOAT,
	ali_nove INT,
	quant_nove FLOAT,
	ali_dez INT,
	quant_dez FLOAT,
    
    CONSTRAINT fk_id_cliente FOREIGN KEY (id_cliente) REFERENCES pacientes_tbl(id_pac),
    CONSTRAINT fk_ali_um FOREIGN KEY (ali_um) REFERENCES alimentos_tbl(id_alimento),
    CONSTRAINT fk_ali_dois FOREIGN KEY (ali_dois) REFERENCES alimentos_tbl(id_alimento),
    CONSTRAINT fk_ali_tres FOREIGN KEY (ali_tres) REFERENCES alimentos_tbl(id_alimento),
    CONSTRAINT fk_ali_quatro FOREIGN KEY (ali_quatro) REFERENCES alimentos_tbl(id_alimento),
    CONSTRAINT fk_ali_cinco FOREIGN KEY (ali_cinco) REFERENCES alimentos_tbl(id_alimento),
    CONSTRAINT fk_ali_seis FOREIGN KEY (ali_seis) REFERENCES alimentos_tbl(id_alimento),
    CONSTRAINT fk_ali_sete FOREIGN KEY (ali_sete) REFERENCES alimentos_tbl(id_alimento),
    CONSTRAINT fk_ali_oito FOREIGN KEY (ali_oito) REFERENCES alimentos_tbl(id_alimento),
    CONSTRAINT fk_ali_nove FOREIGN KEY (ali_nove) REFERENCES alimentos_tbl(id_alimento),
    CONSTRAINT fk_ali_dez FOREIGN KEY (ali_dez) REFERENCES alimentos_tbl(id_alimento)
);

DESC refeicoes_tbl;

SELECT * FROM refeicoes_tbl;

drop table refeicoes_tbl;
CREATE TABLE dieta_tbl(
	id_dieta INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT NOT NULL,
    refeicao_um INT,
    refeicao_dois INT,
    refeicao_tres INT,
    refeicao_quatro INT,
    refeicao_cinco INT,
    refeicao_seis INT,
    refeicao_sete INT,
    refeicao_oito INT,
    refeicao_nove INT,
    refeicao_dez INT,
    
    CONSTRAINT fk_ref_um FOREIGN KEY (refeicao_um) REFERENCES refeicoes_tbl(id_ref),
    CONSTRAINT fk_ref_dois FOREIGN KEY (refeicao_dois) REFERENCES refeicoes_tbl(id_ref),
    CONSTRAINT fk_ref_tres FOREIGN KEY (refeicao_tres) REFERENCES refeicoes_tbl(id_ref),
    CONSTRAINT fk_ref_quatro FOREIGN KEY (refeicao_quatro) REFERENCES refeicoes_tbl(id_ref),
    CONSTRAINT fk_ref_cinco FOREIGN KEY (refeicao_cinco) REFERENCES refeicoes_tbl(id_ref),
    CONSTRAINT fk_ref_seis FOREIGN KEY (refeicao_seis) REFERENCES refeicoes_tbl(id_ref),
    CONSTRAINT fk_ref_sete FOREIGN KEY (refeicao_sete) REFERENCES refeicoes_tbl(id_ref),
    CONSTRAINT fk_ref_oito FOREIGN KEY (refeicao_oito) REFERENCES refeicoes_tbl(id_ref),
    CONSTRAINT fk_ref_nove FOREIGN KEY (refeicao_nove) REFERENCES refeicoes_tbl(id_ref),
    CONSTRAINT fk_ref_dez FOREIGN KEY (refeicao_dez) REFERENCES refeicoes_tbl(id_ref)

);



desc alimentos_tbl;

ALTER TABLE alimentos_tbl
MODIFY COLUMN tipo_medida ENUM('gramas', 'kilos', 'ml', 'l', 'unidade', 'fatia') NOT NULL;

INSERT INTO alimentos_tbl (nome_alimento, tipo_medida, quantidade) VALUES
("Arroz", "gramas", 100),
("Feijão", "gramas", 100),
("Frango", "gramas", 100),
("Batata", "gramas", 100),
("Cenoura", "gramas", 100),
("Maçã", "unidade", 3),
("Pão", "fatia", 4),
("Leite", "ml", 250),
("Espinafre", "gramas", 60),
("Salmão", "gramas", 180),
("Abacaxi", "fatia", 6);

INSERT INTO alimentos_tbl (nome_alimento, tipo_medida, quantidade) VALUES
("Sassami", "gramas", 100);

	SELECT * FROM alimentos_tbl
	JOIN nutrientes_tbl
	ON alimentos_tbl.id_alimento = nutrientes_tbl.id_alimento; 


INSERT INTO pacientes_tbl (nome_pac, sobrenome_pac, telefone_pac, cpf_pac, email_pac) VALUES
("Angelo Daniel", "Alvarez", "49998080639", "1134131231","angelodaniel1221@gmail.com"),
("Raíssa", "Bruder", "499992090", "3290390239", "raissabruder@gmail.com");


INSERT INTO nutrientes_tbl (id_alimento, calorias, carboidrato, proteina, gordura, gordura_saturada, acucares) VALUES
(12, 200, 50, 2, 0, 0, 0),
(13, 220, 40, 4, 0, 0, 0),
(14, 130, 3, 33, 0, 0, 0),
(15, 160, 40, 1, 0, 0, 0),
(16, 70, 10, 1, 0, 0, 0),
(17, 105, 20, 1.5, 0, 0, 0);




INSERT INTO refeicoes_tbl 
(id_cliente, ali_um, quant_um, ali_dois, quant_dois, ali_tres, quant_tres, ali_quatro, quant_quatro, ali_cinco, quant_cinco, ali_seis, quant_seis, ali_sete, quant_sete, 
ali_oito, quant_oito, ali_nove, quant_nove, ali_dez, quant_dez) VALUES
(1, 12, 300, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

INSERT INTO refeicoes_tbl 
    (id_cliente, nome_ref, info_adicional_ref, ali_um, quant_um, ali_dois, quant_dois, ali_tres, quant_tres, ali_quatro, quant_quatro, 
    ali_cinco, quant_cinco, ali_seis, quant_seis, ali_sete, quant_sete, 
    ali_oito, quant_oito, ali_nove, quant_nove, ali_dez, quant_dez) VALUES
    (1, "Almoço", null, null, null, null, null, null, null, null, null, null, null, null, null, null, null ,null, null, null, null, null, null);

SELECT * FROM refeicoes_tbl;