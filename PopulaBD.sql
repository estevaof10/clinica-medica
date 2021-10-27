--insert BD

INSERT INTO pessoa(codigo,nome,sexo,email,telefone,cep,logradouro,cidade,estado)
VALUES('1','Cleide Pureza Torquato','Feminino','cleide@medica.com',3434343,
'38510-123','Rua Teste 3','Uberlândia','Distrito Federal');

INSERT INTO pessoa(codigo,nome,sexo,email,telefone,cep,logradouro,cidade,estado)
VALUES('2','Duarte Avelar Cangueiro','Masculino','duarte@medico.com',3434345,'38510-123',
'Rua Teste 3','Uberlândia','Distrito Federal');

INSERT INTO pessoa(codigo,nome,sexo,email,telefone,cep,logradouro,cidade,estado)
  VALUES('3','Rúbia Saltão Granja','Feminino','rubia@medica.com',34343434,
'38510-123','Rua Teste 3','Uberlândia','Distrito Federal');

INSERT INTO pessoa(codigo,nome,sexo,email,telefone,cep,logradouro,cidade,estado)
  VALUES('4','Álvaro Cotrim Orriça','Masculino','alvaro@medico.com',34343436,
'38510-123','Rua Teste 3','Uberlândia','Distrito Federal');

INSERT INTO pessoa(codigo,nome,sexo,email,telefone,cep,logradouro,cidade,estado)
  VALUES('5','Nélson Carvalheiro Espargosa','Masculino','nelson@medico.com',34343437,
'38510-123','Rua Teste 3','Uberlândia','Distrito Federal');


INSERT INTO pessoa(codigo,nome,sexo,email,telefone,cep,logradouro,cidade,estado)
  VALUES('6','Jeremias Canejo Fiães','Feminino','jeremias@medico.com',34343431,
'38510-123','Rua Teste 3','Uberlândia','Distrito Federal');

INSERT INTO pessoa(codigo,nome,sexo,email,telefone,cep,logradouro,cidade,estado)
  VALUES('7','Milena Leiria Tigre ','Feminino','maria@medica.com',34343432,
'38510-123','Rua Teste 3','Uberlândia','Distrito Federal');


INSERT INTO pessoa(codigo,nome,sexo,email,telefone,cep,logradouro,cidade,estado)
  VALUES('8','Oséias Miguéis Serpa','Masculino','oseias@medico.com',34343438,
'38510-123','Rua Teste 3','Uberlândia','Distrito Federal');

INSERT INTO pessoa(codigo,nome,sexo,email,telefone,cep,logradouro,cidade,estado)
  VALUES('9','Rose Teles Prada','Feminino','rose@medica.com',34343439,
'38510-123','Rua Teste 3','Uberlândia','Distrito Federal');

INSERT INTO pessoa(codigo,nome,sexo,email,telefone,cep,logradouro,cidade,estado)
  VALUES('10','Mayara Gago Leão','Feminino','mayara@medica.com',34343430,
'38510-123','Rua Teste 3','Uberlândia','Distrito Federal');

  INSERT INTO pessoa(codigo,nome,sexo,email,telefone,cep,logradouro,cidade,estado)
  VALUES('11','Luiz Regodeiro Carvalheira','Masculino','luiz@medica.com',34343433,
'38510-123','Rua Teste 3','Uberlândia','Distrito Federal');

-- INSERT PESSOA

INSERT INTO `pessoa` (`codigo`, `nome`, `sexo`, `email`, `telefone`, `cep`, `logradouro`, `cidade`, `estado`) VALUES
('109', 'Luiz Regodeiro Carvalheira', 'Masculino', 'luiz@medico.com', '346589752', '38510-321', 'Rua Teste 2', 'Uberlândia', 'Acre'),
('19', 'Cleide Pureza Torquato', 'Selecione', 'cleide@medica.com', '3434343', '38510-123', 'Rua Teste 3', 'Uberlândia', 'Distrito Federal'),
('29', 'Duarte Avelar Cangueiro', 'Masculino', 'duarte@medico.com', '3499898985', '38510-123', 'Rua Teste 3', 'Uberlândia', 'Distrito Federal'),
('297', 'Mayara Gago Leão', 'Feminino', 'mayara@medica.com', '34568712', '38510-123', 'Rua Teste 3', 'Uberlândia', 'Distrito Federal'),
('299', 'Medico Teste', 'Masculino', 'medico@teste.com', '3498987545', '38510-123', 'Rua Teste 3', 'Uberlândia', 'Distrito Federal'),
('39', 'Rúbia Saltão Granja', 'Feminino', 'rubia@medica.com', '34985678952', '38510-321', 'Rua Teste 2', 'Uberlândia', 'Acre'),
('49', 'Álvaro Cotrim Orriça', 'Masculino', 'alvaro@medico.com', '34567894123', '38510-123', 'Rua Teste 3', 'Uberlândia', 'Distrito Federal'),
('59', 'Nélson Carvalheiro Espargosa', 'Masculino', 'nelson@medico.com', '3456127854', '38510-213', 'Rua Teste 1', 'Uberlândia', 'Alagoas'),
('69', 'Jeremias Canejo Fiães', 'Masculino', 'jeremias@medico.com', '345612378', '38510-321', 'Rua Teste 2', 'Uberlândia', 'Acre'),
('79', 'Milena Leiria Tigre ', 'Masculino', 'milena@medica.com', '345612387', '38510-123', 'Rua Teste 3', 'Uberlândia', 'Distrito Federal'),
('89', 'Oséias Miguéis Serpa', 'Masculino', 'oseias@medico.com', '345612789', '38510-321', 'Rua Teste 2', 'Uberlândia', 'Acre'),
('99', 'Rose Teles Prada', 'Feminino', 'rose@medica.com', '34565121541', '38510-321', 'Rua Teste 2', 'Uberlândia', 'Acre');

--INSERT FUNCIONARIO

INSERT INTO `funcionario` (`codigo`, `salario`, `senhaHash`, `dataContrato`) VALUES
('19', 1000, '$2y$10$bJwjjf4VVMTBO9ALE1CsC.yOkCMNsE.G1Qh2b3mtnpZT.JTOs.NAi', '2021-08-10'),
('29', 10005, '$2y$10$6y92EYeTK8MtM6swlE2aCeXuyS9UAq77gjPzWOgEVuWFNw9F3k7lS', '2021-08-04'),
('39', 11000, '$2y$10$IH1aupO2UMV1j.8HbxIWJuiRF.kLd7kekWpaZC7OD0EaC7Hgd.b3K', '2021-02-23'),
('49', 12000, '$2y$10$RnnwxSwFcy6JbqFd8S29l.57ffGJsTqlHt.3Eq2ywHWaOay6423l2', '2021-07-14'),
('59', 56400, '$2y$10$mAIViAWgl66mNwXKHzvXCuKBE6kB/jHttgm1hfsC1a1OCBc5GtuIq', '2021-06-29'),
('69', 10003, '$2y$10$KMP1qpyqrAxnwCka7RKaau0nmPTt99FMagOCqGld94UeIxIhSBL0K', '2021-06-09'),
('79', 1100000, '$2y$10$LKIAim7at/dGeC0tDbBUIu8oSFchgBaDcXqYZN6KUJLEfzHAcC4CC', '2021-01-07'),
('89', 100056, '$2y$10$eor5uX0EeH8gwdRpsDA3m.g8c7O36pc.Z3/gMV1O0jny55Z3y1xca', '2021-06-16'),
('99', 21000, '$2y$10$.92qZGVgak/zl.jzZXdC3.s5xyIH7fBxVnWznu2wgaueaJGGsYP7.', '2020-09-10'),
('109', 102153, '$2y$10$sE9DWh5qSTCHpBghcHo55.NKB/Enunod1a1zDQJ9LqOy8kPCLdi9C', '2020-12-24'),
('297', 1210310, '$2y$10$HR7GtUVBONdY0awB7TsGT.6A9589aavxLsjMD6obCcy46f80Tkrt.', '2021-09-15'),
('299', 10, '$2y$10$CfaSXlV3lc48G9715M.QkOlPZ3HfMQikYvYJySI8QGoH/5e7a/Ypm', '2021-08-17');


-- INSERT MEDICO 

INSERT INTO `medico` (`codigo`, `especialidade`, `crm`) VALUES
('19', 'Cardiologia', '0012345'),
('29', 'Cirurgia Geral', '123451'),
('39', 'Dermatologia', '4521354'),
('49', 'Endocrinologia', '54873165'),
('59', 'Ginecologia e Obstetrícia', '01235461'),
('69', 'Medico do Trabalho', '45781232'),
('79', 'Neurologia', '32145687'),
('89', 'Otorrinolaringologia', '3254105'),
('99', 'Pediatria', '12354006'),
('109', 'Radioterapia', '5642318'),
('297', 'Psiquiatria', '1235423'),
('299', 'Psicologo', '0213546');

-- INSERT AGENDA

INSERT INTO `agenda` (`codigo`, `data_agenda`, `horario`, `nome`, `sexo`, `email`, `codigoMedico`) VALUES
(12, '2021-10-26', '10', 'Gabriel Couve de Alface', 'Masculino', 'gabriel@email.com', '19'),
(13, '2021-10-26', '10', 'aaaa', 'Masculino', 'a@a.com', '29'),
(14, '2021-10-26', '10', 'aaaaa', 'Masculino', 'a@aa.com', '19'),
(15, '2021-10-26', '10', 'Gabriel Couve de Alface', 'Masculino', 'gabi@email.com', '19'),
(16, '2021-10-26', '9', 'AAAAAA', 'Masculino', 'a@a.a', '19'),
(17, '2021-10-26', '9', 'b', 'Masculino', 'b@b', '19'),
(18, '2021-10-26', '10', 'c', 'Masculino', 'c@c.com', '19');

-- INSERT BASEAJAX

INSERT INTO `baseAjax` (`id`, `cep`, `logradouro`, `cidade`, `estado`) VALUES
(1, '38510-321', 'Rua Teste 2', 'Uberlândia', 'Acre'),
(2, '38510-213', 'Rua Teste 1', 'Uberlândia', 'Alagoas'),
(3, '38510-123', 'Rua Teste 3', 'Uberlândia', 'Distrito Federal'),
(4, '38510-456', 'Rua Teste 4', 'Udia', 'Alagoas');
