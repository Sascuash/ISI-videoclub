-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 22, 2014 at 01:00 PM
-- Server version: 5.1.63-community-log
-- PHP Version: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `patolin_isi`
--

-- --------------------------------------------------------

--
-- Table structure for table `video_alquiler`
--

CREATE TABLE `video_alquiler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_recogida` date NOT NULL,
  `fecha_devolucion` date NOT NULL,
  `pago` double NOT NULL,
  `id_socio` int(11) NOT NULL,
  `id_peliculas` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `video_alquiler`
--

INSERT INTO `video_alquiler` (`id`, `fecha_recogida`, `fecha_devolucion`, `pago`, `id_socio`, `id_peliculas`) VALUES
(1, '2014-09-16', '2014-09-24', 2.54, 1, '234'),
(2, '2014-09-16', '2014-09-24', 2.54, 1, '234'),
(3, '2014-09-16', '2014-09-24', 2.54, 1, '234'),
(4, '2014-09-21', '2014-09-29', 9.924, 3, '99|82|71|'),
(5, '2014-09-22', '2014-09-30', 13.056, 5, '12|48|53|54|'),
(6, '2014-09-22', '2014-09-30', 9.847, 3, '103|21|70|');

-- --------------------------------------------------------

--
-- Table structure for table `video_estadistica`
--

CREATE TABLE `video_estadistica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_socio` int(11) NOT NULL,
  `fecha_generacion` date NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `video_estadistica`
--

INSERT INTO `video_estadistica` (`id`, `id_socio`, `fecha_generacion`, `total`) VALUES
(1, 5, '2014-09-22', 13.056),
(2, 6, '2014-09-22', 0),
(3, 5, '2014-09-22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `video_pelicula`
--

CREATE TABLE `video_pelicula` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(255) NOT NULL,
  `director` char(255) NOT NULL,
  `fecha_estreno` date NOT NULL,
  `precio` double NOT NULL,
  `id_videoclub` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=105 ;

--
-- Dumping data for table `video_pelicula`
--

INSERT INTO `video_pelicula` (`id`, `nombre`, `director`, `fecha_estreno`, `precio`, `id_videoclub`) VALUES
(8, 'Witness for the Prosecution', 'George Lucas', '2000-02-04', 3.88, 1),
(7, 'Rome', 'Quentin Tarantino', '2010-01-05', 3.77, 1),
(6, 'Empire Records', 'George Lucas', '2000-02-03', 3.66, 1),
(5, 'A Few Good Men', 'Quentin Tarantino', '2010-01-04', 3.55, 1),
(9, 'Girl, Interrupted', 'Quentin Tarantino', '2010-01-06', 3.99, 1),
(10, 'Ong-bak', 'George Lucas', '2000-02-05', 3.11, 2),
(11, 'The Lookout', 'Quentin Tarantino', '2010-01-07', 3.121, 2),
(12, '21', 'George Lucas', '2000-02-06', 3.132, 2),
(13, 'Unfaithful', 'Quentin Tarantino', '2010-01-08', 3.143, 2),
(14, 'The Limey', 'George Lucas', '2000-02-07', 3.154, 2),
(15, 'Fever Pitch', 'Quentin Tarantino', '2010-01-09', 3.165, 3),
(16, 'Star Trek', 'George Lucas', '2000-02-08', 3.176, 3),
(17, 'Outlander', 'Quentin Tarantino', '2010-01-10', 3.187, 3),
(18, 'Pathfinder', 'George Lucas', '2000-02-09', 3.198, 3),
(19, 'The Covenant', 'Quentin Tarantino', '2010-01-11', 3.209, 4),
(20, 'Universal Soldier', 'George Lucas', '2000-02-10', 3.22, 4),
(21, 'Breaking the Waves', 'Quentin Tarantino', '2010-01-12', 3.231, 4),
(22, 'The Producers', 'George Lucas', '2000-02-11', 3.242, 4),
(23, 'The Grapes of Wrath', 'Quentin Tarantino', '2010-01-13', 3.253, 1),
(24, 'Femme Fatale', 'George Lucas', '2000-02-12', 3.264, 1),
(25, 'Two for the Money', 'Quentin Tarantino', '2010-01-14', 3.275, 1),
(26, 'Just Like Heaven', 'George Lucas', '2000-02-13', 3.286, 1),
(27, 'Oldeuboi', 'Quentin Tarantino', '2010-01-15', 3.297, 1),
(28, 'Cannibal Holocaust', 'George Lucas', '2000-02-14', 3.308, 2),
(29, 'BrÃ¼no', 'George Lucas', '2000-02-14', 3.308, 2),
(30, 'Summer of Sam', 'Quentin Tarantino', '2010-01-16', 3.297, 2),
(31, 'Pirates of the Caribbean: At World''s End', 'George Lucas', '2000-02-14', 3.308, 2),
(32, 'The Graduate', 'George Lucas', '2000-02-14', 3.308, 2),
(33, 'The Rocketeer', 'Quentin Tarantino', '2010-01-17', 3.297, 3),
(34, 'Chaplin', 'George Lucas', '2000-02-14', 3.308, 3),
(35, 'The Legend of Zorro', 'George Lucas', '2000-02-14', 3.308, 3),
(36, 'Rounders', 'Quentin Tarantino', '2010-01-18', 3.297, 3),
(37, 'Mercury Rising', 'George Lucas', '2000-02-14', 3.308, 4),
(38, 'Contact', 'George Lucas', '2000-02-14', 3.308, 4),
(39, 'Jurassic Park III', 'Quentin Tarantino', '2010-01-19', 3.297, 4),
(40, 'AVP: Alien vs. Predator', 'George Lucas', '2000-02-14', 3.308, 4),
(41, 'Before the Devil Knows You''re Dead', 'George Lucas', '2000-02-14', 3.308, 1),
(42, 'Tsotsi', 'Quentin Tarantino', '2010-01-20', 3.297, 1),
(43, 'BloodRayne', 'George Lucas', '2000-02-14', 3.308, 1),
(44, 'Black Sheep', '2006', '0000-00-00', 3.308, 1),
(45, 'Scary Movie', '2000', '0000-00-00', 3.308, 1),
(46, 'Once Upon a Time in Mexico', '2003', '0000-00-00', 3.308, 2),
(47, 'Following', '1998', '0000-00-00', 3.308, 2),
(48, 'Alias', '2001', '0000-00-00', 3.308, 2),
(49, 'Hairspray', '2007', '0000-00-00', 3.308, 2),
(50, 'Touch of Evil', '1958', '0000-00-00', 3.308, 2),
(51, 'So I Married an Axe Murderer', '1993', '0000-00-00', 3.308, 3),
(52, 'White Noise', '2005', '0000-00-00', 3.308, 3),
(53, 'Anything Else', '2003', '0000-00-00', 3.308, 3),
(54, 'Batman: Mask of the Phantasm', '1993', '0000-00-00', 3.308, 3),
(55, 'Sweeney Todd: The Demon Barber of Fleet Street', '2007', '0000-00-00', 3.308, 4),
(56, 'The Hurt Locker', '2008', '0000-00-00', 3.308, 4),
(57, 'War', '2007', '0000-00-00', 3.308, 4),
(58, 'Stick It', '2006', '0000-00-00', 3.308, 4),
(59, 'Virtuosity', '1995', '0000-00-00', 3.308, 1),
(60, 'Gomorra', '2008', '0000-00-00', 3.308, 1),
(61, 'Everybody''s Fine', '2009', '0000-00-00', 3.308, 1),
(62, 'My Big Fat Greek Wedding', '2002', '0000-00-00', 3.308, 1),
(63, 'Barbershop', '2002', '0000-00-00', 3.308, 1),
(64, 'Bugsy', '1991', '0000-00-00', 3.308, 2),
(65, 'Poltergeist', '1982', '0000-00-00', 3.308, 2),
(66, 'Highlander', '1986', '0000-00-00', 3.308, 2),
(67, 'The Opposite of Sex', '1998', '0000-00-00', 3.308, 2),
(68, 'The Office', '2005', '0000-00-00', 3.308, 2),
(69, 'New Jack City', '1991', '0000-00-00', 3.308, 3),
(70, 'French Kiss', '1995', '0000-00-00', 3.308, 3),
(71, 'Instinct', '1999', '0000-00-00', 3.308, 3),
(72, 'Le samouraÃ¯', '1967', '0000-00-00', 3.308, 3),
(73, 'Derailed', '2005', '0000-00-00', 3.308, 4),
(74, 'Cube', '1997', '0000-00-00', 3.308, 4),
(75, 'High Plains Drifter', '1973', '0000-00-00', 3.308, 4),
(76, 'Enemy at the Gates', '2001', '0000-00-00', 3.308, 4),
(77, 'Nosferatu, eine Symphonie des Grauens', '1922', '0000-00-00', 3.308, 1),
(78, 'Sherlock Holmes', '2009', '0000-00-00', 3.308, 1),
(79, 'We Were Soldiers', '2002', '0000-00-00', 3.308, 1),
(80, 'Elegy', '2008', '0000-00-00', 3.308, 1),
(81, 'Taegukgi hwinalrimyeo', '2004', '0000-00-00', 3.308, 1),
(82, 'Jay and Silent Bob Strike Back', '2001', '0000-00-00', 3.308, 2),
(83, 'The Karate Kid, Part III', '1989', '0000-00-00', 3.308, 2),
(84, 'Mean Streets', '1973', '0000-00-00', 3.308, 2),
(85, 'Inkheart', '2008', '0000-00-00', 3.308, 2),
(86, 'Desperado', '1995', '0000-00-00', 3.308, 2),
(87, 'Appaloosa', '2008', '0000-00-00', 3.308, 3),
(88, 'The Thin Red Line', '1998', '0000-00-00', 3.308, 3),
(89, 'Death Proof', '2007', '0000-00-00', 3.308, 3),
(90, 'Swingers', '1996', '0000-00-00', 3.308, 3),
(91, 'Titan A.E.', '2000', '0000-00-00', 3.308, 4),
(92, 'Dead Poets Society', '1989', '0000-00-00', 3.308, 4),
(93, 'Kagemusha', '1980', '0000-00-00', 3.308, 4),
(94, 'The Mission', '1986', '0000-00-00', 3.308, 4),
(95, 'Ultimo tango a Parigi', '1972', '0000-00-00', 3.308, 1),
(96, 'The Savages', '2007', '0000-00-00', 3.308, 1),
(97, 'Beethoven', '1992', '0000-00-00', 3.308, 1),
(98, 'John Tucker Must Die', '2006', '0000-00-00', 3.308, 1),
(99, 'Ice Age', '2002', '0000-00-00', 3.308, 2),
(100, 'Corpse Bride', '2005', '0000-00-00', 3.308, 2),
(101, 'Fido', '2006', '0000-00-00', 3.308, 2),
(102, 'Dan in Real Life', '2007', '0000-00-00', 3.308, 2),
(103, 'Boogie Nights', '1997', '0000-00-00', 3.308, 3),
(104, 'Roger & Me', '1989', '0000-00-00', 3.308, 3);

-- --------------------------------------------------------

--
-- Table structure for table `video_socio`
--

CREATE TABLE `video_socio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(255) NOT NULL,
  `edad` int(11) NOT NULL,
  `id_videoclub` int(11) NOT NULL,
  `codigo` char(25) NOT NULL,
  `clave` char(25) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `video_socio`
--

INSERT INTO `video_socio` (`id`, `nombre`, `edad`, `id_videoclub`, `codigo`, `clave`, `admin`) VALUES
(2, 'Patricio', 36, 1, 'usr', '12345', 1),
(3, 'Alberto', 36, 1, 'usr', '12345', 1),
(4, 'Juan', 36, 1, 'usr', '12345', 1),
(5, 'Jose', 36, 1, 'usr', '12345', 1),
(6, 'Pedro', 36, 1, 'usr', '12345', 1);

-- --------------------------------------------------------

--
-- Table structure for table `video_videoclub`
--

CREATE TABLE `video_videoclub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gerente` char(255) NOT NULL,
  `ciudad` char(255) NOT NULL,
  `calle` char(255) NOT NULL,
  `cp` char(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `video_videoclub`
--

INSERT INTO `video_videoclub` (`id`, `gerente`, `ciudad`, `calle`, `cp`) VALUES
(1, 'Juan Perez', 'valencia', 'Serpis #80', '44567'),
(2, 'Jose Perez', 'Madrid', 'Av. primera 2-500', '44543'),
(3, 'Jose Mendez', 'Cuenca', 'Pedro Carbo 1-65', '28933'),
(4, 'Manuel Lopez', 'Quito', '10 de agosto 5-600', '39323');
