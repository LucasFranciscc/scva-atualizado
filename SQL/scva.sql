-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Out-2020 às 02:15
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `scva2`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `P001_USERS_CREATE` (IN `pregistration` VARCHAR(10), IN `pname` VARCHAR(50), IN `ptelephone` CHAR(15), IN `pemail` VARCHAR(30), IN `ppassword` VARCHAR(100), IN `pfk_level_access` INT)  BEGIN

	DECLARE Vid_user INT;

	INSERT INTO users (registration, name, telephone, email, password, fk_level_access)
    VALUES (pregistration, pname, ptelephone, pemail, ppassword, pfk_level_access);
    
    SET Vid_user = LAST_INSERT_ID();
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P002_USERS_UPDATE` (IN `pid_user` INT, IN `pregistration` VARCHAR(10), IN `pname` VARCHAR(50), IN `ptelephone` CHAR(15), IN `pemail` VARCHAR(30), IN `pfk_level_access` INT)  BEGIN 

	UPDATE users
		SET
			registration = pregistration,
            name = pname,
            telephone = ptelephone,
            email = pemail,
            fk_level_access = pfk_level_access
		WHERE id_user = pid_user;
        
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P003_USERS_DELETE` (IN `pid_user` INT)  BEGIN
	DELETE FROM users WHERE id_user = pid_user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P004_USERS_PASSWORD_UPDATE` (IN `pid_user` INT, IN `ppassword` VARCHAR(100))  BEGIN
	
    UPDATE users
		SET
			password = ppassword
		WHERE id_user = pid_user;
        
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P005_REGION_CREATE` (IN `pregion` VARCHAR(50))  BEGIN

	DECLARE Vid_region INT;
    
    INSERT INTO regions (region)
    VALUES (pregion);
    
    SET Vid_region = LAST_INSERT_ID();
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P006_REGION_UPDATE` (IN `pid_region` INT, IN `pregion` VARCHAR(50))  BEGIN
	
    UPDATE regions
		SET
			region = pregion
		WHERE id_region = pid_region;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P007_REGION_DELETE` (IN `pid_region` INT)  BEGIN 
	DELETE FROM regions WHERE id_region = pid_region;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P008_VALVE_CREATE` (IN `pvalve` VARCHAR(50))  BEGIN

	DECLARE Vid_valve INT;

	INSERT INTO valves (valve)
    VALUES (pvalve);
    
    SET Vid_valve = LAST_INSERT_ID();
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P009_VALVE_UPDATE` (IN `pid_valve` INT, IN `pvalve` VARCHAR(50))  BEGIN 
	UPDATE valves
		SET
			valve = pvalve
		WHERE id_valve = pid_valve;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P010_VALVE_DELETE` (IN `pid_valve` INT)  BEGIN
	DELETE FROM valves WHERE id_valve = pid_valve;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P011_GROUP_CREATE` (IN `p_grupo` VARCHAR(50), IN `pfk_valve` INT)  BEGIN

	DECLARE Vid_group INT;

	INSERT INTO grupos (_grupo, fk_valve)
    VALUES (p_grupo, pfk_valve);
    
    SET Vid_group = LAST_INSERT_ID();
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P012_GROUP_UPDATE` (IN `pid_group` INT, IN `p_grupo` VARCHAR(50), IN `pfk_valve` INT)  BEGIN
 UPDATE grupos
	SET
		_grupo = p_grupo,
        fk_valve = pfk_valve
	WHERE id_group = pid_group;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P013_GROUP_DELETE` (IN `pid_group` INT)  BEGIN
	DELETE FROM grupos WHERE id_group = pid_group;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P014_ADD_REGION` (IN `pfk_group` INT, IN `pfk_region` INT)  BEGIN 
	
    DECLARE Vid_group_region INT;
    
    INSERT INTO group_region (fk_group, fk_region)
    VALUES (pfk_group, pfk_region);
    
    SET Vid_group_region = LAST_INSERT_ID();
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P015_REMOVE_REGION` (IN `pfk_group` INT, IN `pfk_region` INT)  BEGIN

	DELETE FROM group_region WHERE fk_group = pfk_group AND fk_region = pfk_region;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P016_EVENTS_CREATE` (IN `ptitle` VARCHAR(50), IN `pfk_group` INT, IN `pcolor` VARCHAR(10), IN `pstart` VARCHAR(20), IN `pend` VARCHAR(20))  BEGIN
	
    DECLARE Vid_events INT;
    
    INSERT INTO events (title, fk_group, color, start, end)
    VALUES (ptitle, pfk_group, pcolor, pstart, pend);
    
    SET Vid_events = LAST_INSERT_ID();
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P017_EVENTS_START_UPDATE` (IN `pid_events` INT, IN `pstatus` TINYINT(4))  begin
	update events
		set
			status = pstatus
		where id_events = pid_events;
        
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P018_EVENTS_UPDATE` (IN `pid_events` INT, IN `ptitle` VARCHAR(50), IN `pfk_group` INT, IN `pcolor` VARCHAR(10), IN `pstart` VARCHAR(20), IN `pend` VARCHAR(20))  begin
		update events
			set
				title = ptitle,
                fk_group = pfk_group,
                color = pcolor,
                start = pstart,
                end = pend
			where id_events = pid_events;
            
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P019_EVENTS_DELETAR` (IN `pid_events` INT)  begin

	delete from events where id_events = pid_events;
    
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P020_CALLED_CREATE` (IN `pregistration` CHAR(6), IN `pname` VARCHAR(50), IN `pupdate_date` DATETIME, IN `pfk_group` INT, IN `pdescription` TEXT)  begin 

	declare Vid_called int;

	insert into called (registration, name, update_date, fk_group, description)
    values (pregistration, pname, pupdate_date, pfk_group, pdescription);
    
    set Vid_called = LAST_INSERT_ID();
    
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P021_CALLED_UPDATE` (IN `pid_called` INT, IN `pfk_group` INT, IN `pdescription` TEXT, IN `pfk_status` INT)  begin
	
    update called
		set 
			fk_group = pfk_group,
			description = pdescription,
			fk_status = pfk_status
		where id_called = pid_called;
        
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P022_CALLED_DELETE` (IN `pid_called` INT)  begin

	delete from called where id_called = pid_called;
    
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `P023_CALLED_UPDATE_STATUS` (IN `pid_called` INT, IN `pfk_status` INT)  begin

	update called
		set
         fk_status = pfk_status
	where id_called = pid_called;
    
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `answers`
--

CREATE TABLE `answers` (
  `id_answer` int(11) NOT NULL,
  `fk_called` int(11) NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `answers`
--

INSERT INTO `answers` (`id_answer`, `fk_called`, `answer`, `created_at`) VALUES
(1, 3, 'hgsdfafasdfa', '2020-10-22 13:56:22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `called`
--

CREATE TABLE `called` (
  `id_called` int(11) NOT NULL,
  `registration` char(6) NOT NULL,
  `name` varchar(50) NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fk_group` int(11) NOT NULL,
  `description` text NOT NULL,
  `fk_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `called`
--

INSERT INTO `called` (`id_called`, `registration`, `name`, `update_date`, `registration_date`, `fk_group`, `description`, `fk_status`) VALUES
(3, 'TEC001', 'Técnico teste', '2020-10-22 10:28:33', '2020-10-22 13:56:22', 9, 'hdfgsdgsd', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `events`
--

CREATE TABLE `events` (
  `id_events` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `fk_group` int(11) NOT NULL,
  `color` varchar(10) NOT NULL,
  `start` varchar(20) NOT NULL,
  `end` varchar(50) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `events`
--

INSERT INTO `events` (`id_events`, `title`, `fk_group`, `color`, `start`, `end`, `status`, `registration_date`) VALUES
(1, 'fsdggsd', 9, '#FFD700', '2020-09-29 00:00:00', '1969-12-31 21:00:00', b'0', '2020-10-22 13:02:18'),
(2, 'fdgsdfdf', 9, '#0071c5', '2020-09-28 00:00:00', '1969-12-31 21:00:00', b'0', '2020-10-22 13:25:56'),
(3, 'dghd', 9, '#FFD700', '2020-10-05 00:00:00', '', b'1', '2020-10-21 21:24:01'),
(4, 'fgdsgf', 9, '#FF4500', '2020-10-20 00:00:00', '', b'1', '2020-10-21 21:24:22'),
(5, 'hfsdf', 9, '#FFD700', '2020-10-22 00:00:00', '', b'1', '2020-10-21 21:24:49'),
(6, 'Testeeee', 9, '#FFD700', '2020-10-16 23:00:00', '', b'1', '2020-10-21 21:29:51'),
(8, 'RRRRR', 9, '#FFD700', '2020-10-03 22:00:00', '2020-10-05 13:00:00', b'1', '2020-10-22 12:45:19');

-- --------------------------------------------------------

--
-- Estrutura da tabela `group_region`
--

CREATE TABLE `group_region` (
  `id_group_region` int(11) NOT NULL,
  `fk_group` int(11) NOT NULL,
  `fk_region` int(11) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupos`
--

CREATE TABLE `grupos` (
  `id_group` int(11) NOT NULL,
  `_grupo` varchar(50) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fk_valve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `grupos`
--

INSERT INTO `grupos` (`id_group`, `_grupo`, `registration_date`, `fk_valve`) VALUES
(9, 'A', '2020-10-21 21:12:12', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `level_access`
--

CREATE TABLE `level_access` (
  `id_level_access` int(11) NOT NULL,
  `level` varchar(20) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `level_access`
--

INSERT INTO `level_access` (`id_level_access`, `level`, `registration_date`) VALUES
(1, 'ADMINISTRADOR', '2020-01-31 17:13:12'),
(2, 'TÉCNICO', '2020-02-01 01:45:36'),
(3, 'OPERADOR', '2020-01-31 17:13:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `regions`
--

CREATE TABLE `regions` (
  `id_region` int(11) NOT NULL,
  `region` varchar(50) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `regions`
--

INSERT INTO `regions` (`id_region`, `region`, `registration_date`) VALUES
(10, 'DF', '2020-10-21 20:49:12'),
(11, 'DF', '2020-10-21 20:54:29'),
(12, 'DF', '2020-10-21 20:54:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`id_status`, `status`, `registration_date`) VALUES
(1, 'Aberto', '2020-02-03 01:45:55'),
(2, 'Fechado', '2020-02-03 01:45:55');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `registration` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `telephone` char(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fk_level_access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id_user`, `registration`, `name`, `telephone`, `email`, `password`, `registration_date`, `fk_level_access`) VALUES
(1, 'ADM001', 'Administrador Teste', '(00) 00000-0000', 'administrador@gmail.com', '$2y$10$p5hVVcztd.9uM/Gcq9AwBOp5VtLkm5dXVRVzOEiJpvcH2q/rVidKK', '2020-10-14 05:56:01', 1),
(3, 'TEC001', 'Técnico teste', '(99) 99999-9999', 'tecnico@gmail.com', '$2y$10$p5hVVcztd.9uM/Gcq9AwBOp5VtLkm5dXVRVzOEiJpvcH2q/rVidKK', '2020-10-21 21:28:34', 2),
(4, 'OPR001', 'Operador Teste', '(00) 00000-0000', 'operador@gmail.com', '$2y$10$p5hVVcztd.9uM/Gcq9AwBOp5VtLkm5dXVRVzOEiJpvcH2q/rVidKK', '2020-10-22 13:27:36', 3),
(17, 'Admin123', 'Lucas Francisco', '(99) 99999-9999', 'lucasfrancisco1318@gmail.com', '$2y$12$JU8VLwOp0O/39p0yovFj7.aby46q87YxzOi9nQADMywMluA3QsTRu', '2020-10-24 05:00:46', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `valves`
--

CREATE TABLE `valves` (
  `id_valve` int(11) NOT NULL,
  `valve` varchar(50) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `valves`
--

INSERT INTO `valves` (`id_valve`, `valve`, `registration_date`) VALUES
(7, 'Teste', '2020-10-21 21:05:57'),
(8, 'sadfdsafas', '2020-10-24 01:35:59');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id_answer`),
  ADD KEY `fk_called` (`fk_called`);

--
-- Índices para tabela `called`
--
ALTER TABLE `called`
  ADD PRIMARY KEY (`id_called`),
  ADD KEY `fk_group` (`fk_group`),
  ADD KEY `called_ibfk_2` (`fk_status`);

--
-- Índices para tabela `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_events`),
  ADD KEY `fk_group` (`fk_group`);

--
-- Índices para tabela `group_region`
--
ALTER TABLE `group_region`
  ADD PRIMARY KEY (`id_group_region`),
  ADD KEY `fk_group` (`fk_group`),
  ADD KEY `fk_region` (`fk_region`);

--
-- Índices para tabela `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_group`),
  ADD KEY `fk_valve` (`fk_valve`);

--
-- Índices para tabela `level_access`
--
ALTER TABLE `level_access`
  ADD PRIMARY KEY (`id_level_access`);

--
-- Índices para tabela `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id_region`);

--
-- Índices para tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_level_access` (`fk_level_access`);

--
-- Índices para tabela `valves`
--
ALTER TABLE `valves`
  ADD PRIMARY KEY (`id_valve`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `answers`
--
ALTER TABLE `answers`
  MODIFY `id_answer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `called`
--
ALTER TABLE `called`
  MODIFY `id_called` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `events`
--
ALTER TABLE `events`
  MODIFY `id_events` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `group_region`
--
ALTER TABLE `group_region`
  MODIFY `id_group_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `level_access`
--
ALTER TABLE `level_access`
  MODIFY `id_level_access` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `regions`
--
ALTER TABLE `regions`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `valves`
--
ALTER TABLE `valves`
  MODIFY `id_valve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`fk_called`) REFERENCES `called` (`id_called`);

--
-- Limitadores para a tabela `called`
--
ALTER TABLE `called`
  ADD CONSTRAINT `called_ibfk_1` FOREIGN KEY (`fk_group`) REFERENCES `grupos` (`id_group`),
  ADD CONSTRAINT `called_ibfk_2` FOREIGN KEY (`fk_status`) REFERENCES `status` (`id_status`);

--
-- Limitadores para a tabela `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`fk_group`) REFERENCES `grupos` (`id_group`);

--
-- Limitadores para a tabela `group_region`
--
ALTER TABLE `group_region`
  ADD CONSTRAINT `group_region_ibfk_1` FOREIGN KEY (`fk_group`) REFERENCES `grupos` (`id_group`),
  ADD CONSTRAINT `group_region_ibfk_2` FOREIGN KEY (`fk_region`) REFERENCES `regions` (`id_region`);

--
-- Limitadores para a tabela `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupos_ibfk_1` FOREIGN KEY (`fk_valve`) REFERENCES `valves` (`id_valve`);

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fk_level_access`) REFERENCES `level_access` (`id_level_access`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
