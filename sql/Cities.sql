-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 31, 2018 at 02:55 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id5970972_fpdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cities`
--

CREATE TABLE `Cities` (
  `City` varchar(254) NOT NULL,
  `Province` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Cities`
--

INSERT INTO `Cities` (`City`, `Province`) VALUES
('Andong', 'North Gyeongsang'),
('Ansan', 'Gyeonggi'),
('Anseong', 'Gyeonggi'),
('Anyang', 'Gyeonggi'),
('Asan', 'South Chungcheong'),
('Boryeong', 'South Chungcheong'),
('Bucheon', 'Gyeonggi'),
('Busan Metropolitan City', 'none'),
('Changwon', 'South Gyeongsang'),
('Cheonan', 'South Chungcheong'),
('Cheongju', 'South Chungcheong'),
('Chuncheon', 'Gangwon'),
('Chungju', 'North Chungcheong'),
('Daegu Metropolitan City', 'none'),
('Daejeon Metropolitan City', 'none'),
('Dangjin', 'South Chungcheong'),
('Dongducheon', 'Gyeonggi'),
('Donghae', 'Gangwon'),
('Gangneung', 'Gangwon'),
('Geoje', 'South Gyeongsang'),
('Gimcheon', 'North Gyeongsang'),
('Gimhae', 'South Gyeongsang'),
('Gimje', 'North Jeolla'),
('Gimpo', 'Gyeonggi'),
('Gongju', 'South Chungcheong'),
('Goyang', 'Gyeonggi'),
('Gumi', 'North Gyeongsang'),
('Gunpo', 'Gyeonggi'),
('Gunsan', 'North Jeolla'),
('Guri', 'Gyeonggi'),
('Gwacheon', 'Gyeonggi'),
('Gwangju Metropolitan City', 'none'),
('Gwangju', 'Gyeonggi'),
('Gwangmyeong', 'Gyeonggi'),
('Gwangyang', 'South Jeolla'),
('Gyeongju', 'North Gyeongsang'),
('Gyeongsan', 'North Gyeongsang'),
('Gyeryong', 'South Chungcheong'),
('Hanam', 'Gyeonggi'),
('Hwaseong', 'Gyeonggi'),
('Icheon', 'Gyeonggi'),
('Iksan', 'North Jeolla'),
('Incheon Metropolitan City', 'none'),
('Jecheon', 'North Chungcheong'),
('Jeongeup', 'North Jeolla'),
('Jeonju', 'North Jeolla'),
('Jeju', 'Jeju'),
('Jinju', 'South Gyeongsang'),
('Naju', 'South Jeolla'),
('Namyangju', 'Gyeonggi'),
('Namwon', 'North Jeolla'),
('Nonsan', 'South Chungcheong'),
('Miryang', 'South Gyeongsang'),
('Mokpo', 'South Jeolla'),
('Mungyeong', 'North Gyeongsang'),
('Osan', 'Gyeonggi'),
('Paju', 'Gyeonggi'),
('Pocheon', 'Gyeonggi'),
('Pohang', 'North Gyeongsang'),
('Pyeongtaek', 'Gyeonggi'),
('Sacheon', 'South Gyeongsang'),
('Sangju', 'North Gyeongsang'),
('Samcheok', 'Gangwon'),
('Sejong Metropolitan Autonomous City', 'none'),
('Seogwipo', 'Jeju'),
('Seongnam', 'Gyeonggi'),
('Seosan', 'South Chungcheong'),
('Seoul Special Metropolitan City', 'none'),
('Siheung', 'Gyeonggi'),
('Sokcho', 'Gangwon'),
('Suncheon', 'South Jeolla'),
('Suwon', 'Gyeonggi'),
('Taebaek', 'Gangwon'),
('Tongyeong', 'South Gyeongsang'),
('Uijeongbu', 'Gyeonggi'),
('Uiwang', 'Gyeonggi'),
('Ulsan Metropolitan City', 'none'),
('Wonju', 'Gangwon'),
('Yangju', 'Gyeonggi'),
('Yangsan', 'South Gyeongsang'),
('Yeoju', 'Gyeonggi'),
('Yeongcheon', 'North Gyeongsang'),
('Yeongju', 'North Gyeongsang'),
('Yeosu', 'South Jeolla'),
('Yongin', 'Gyeonggi');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
