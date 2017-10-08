USE `db_mvc`;
INSERT INTO `super_users` VALUES ('1', 'root', 'supassword');
-- --------------------------------------------------------
--
-- Extraindo dados da tabela `course`
--

INSERT INTO `course` (`id`, `name`, `duration`, `code`) VALUES
(1, 'Engenharia da Computacao', 350, 'ENGCOMP'),
(2, 'Engenharia de Controle e AutomaCAo', 350, 'ENGAUTO'),
(3, 'Ciencia da Computacao', 320, 'CC'),
(4, 'Sistemas de Informacao', 300, 'SI');