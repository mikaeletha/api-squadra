insert into tb_uf (codigo_uf, sigla, nome, status ) values (02,'RJ', 'Rio de Janeiro', 1);
insert into tb_municipio (codigo_municipio, codigo_uf, nome, status ) values (01, 01, 'BH', 1);
insert into tb_bairro ( codigo_bairro, codigo_municipio, nome, status ) values (01, 01, 'Lourdes', 1);