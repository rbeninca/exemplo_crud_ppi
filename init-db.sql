-- create database if not exists `test` default charset utf8 collate utf8_general_ci;
CREATE DATABASE IF NOT EXISTS `crud_ppi` DEFAULT CHARSET utf8 COLLATE utf8_general_ci;
GRANT ALL PRIVILEGES ON crud_ppi.* TO 'user'@'%'; -- concede permissoes para qualquer usuario acessar o banco criado
FLUSH PRIVILEGES; -- atualiza as permissoes
USE `crud_ppi`;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- Carga de datos de inicial para teste
INSERT INTO `usuarios` (`nome`, `email`, `senha`) VALUES
('admin', 'admin@gmail.com' , '123456'),
('user', 'user@hotmail.com', '123456'),
('Ana Silva', 'ana.silva@example.com', 'senha123'),
('Bruno Gomes', 'bruno.gomes@example.com', 'senha123'),
('Carla Dias', 'carla.dias@example.com', 'senha123'),
('David Sousa', 'david.sousa@example.com', 'senha123'),
('Elena Ramos', 'elena.ramos@example.com', 'senha123'),
('Fábio Oliveira', 'fabio.oliveira@example.com', 'senha123'),
('Gisele Martins', 'gisele.martins@example.com', 'senha123'),
('Hugo Lima', 'hugo.lima@example.com', 'senha123'),
('Iris Fernandes', 'iris.fernandes@example.com', 'senha123'),
('João Pereira', 'joao.pereira@example.com', 'senha123'),
('Karla Costa', 'karla.costa@example.com', 'senha123'),
('Luis Rocha', 'luis.rocha@example.com', 'senha123'),
('Mariana Santos', 'mariana.santos@example.com', 'senha123'),
('Nuno Teixeira', 'nuno.teixeira@example.com', 'senha123'),
('Olívia Carvalho', 'olivia.carvalho@example.com', 'senha123'),
('Paulo Ribeiro', 'paulo.ribeiro@example.com', 'senha123'),
('Quintino Barros', 'quintino.barros@example.com', 'senha123'),
('Rita Moreira', 'rita.moreira@example.com', 'senha123'),
('Sofia Correia', 'sofia.correia@example.com', 'senha123'),
('Tiago Nunes', 'tiago.nunes@example.com', 'senha123');

```