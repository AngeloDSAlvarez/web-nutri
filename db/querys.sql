use nutri_db;
insert into refeicoes_tbl (id_ref, id_cliente, nome_ref, info_adicional_ref, horario_ref) values
(null, 1, "Testando", "info adicional", "13:00");
select * from refeicoes_tbl
where id_ref = LAST_INSERT_ID();

SELECT id_ref FROM refeicoes_tbl
WHERE id_ref = LAST_INSERT_ID();

SELECT * FROM refeicoes_tbl
WHERE id_ref = 10;

show tables;
