-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2021 at 07:43 AM
-- Server version: 10.5.12-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id18079144_finalssip`
--

-- --------------------------------------------------------

--
-- Table structure for table `vmm_cart`
--

CREATE TABLE `vmm_cart` (
  `idcart` int(11) NOT NULL,
  `orderid` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  `orderdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT 'Cart'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vmm_cart`
--

INSERT INTO `vmm_cart` (`idcart`, `orderid`, `userid`, `orderdate`, `status`) VALUES
(26, '167uwCVVAxU3E', 14, '2021-10-18 05:34:42', 'Cart'),
(27, '16QoK3ftklTtM', 1, '2021-10-18 06:04:29', 'Completed'),
(28, '16vjtjCFl2FVs', 1, '2021-10-18 06:05:23', 'Completed'),
(29, '16TCE.tEN7k2w', 1, '2021-10-18 06:10:09', 'Completed'),
(30, '16dru5fYuw49g', 1, '2021-10-18 06:21:27', 'Payment'),
(31, '16EdZI6ecTeos', 1, '2021-11-30 08:12:45', 'Confirmed'),
(32, '16Np/QI8zgYY6', 1, '2021-12-06 18:30:24', 'Cart'),
(33, '16rC.jcYTZTeM', 16, '2021-12-13 08:57:11', 'Confirmed'),
(34, '16qlvbo1agDNw', 17, '2021-12-13 10:13:41', 'Confirmed'),
(35, '16EtUl8ZwfiWI', 18, '2021-12-13 11:46:50', 'Confirmed'),
(36, '16J7qbag4gjW6', 18, '2021-12-13 12:38:22', 'Confirmed'),
(37, '16abh8E.Wqqro', 20, '2021-12-14 01:48:45', 'Cart'),
(38, '16UpoZHn5meDw', 18, '2021-12-14 06:05:48', 'Confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `vmm_confirmation`
--

CREATE TABLE `vmm_confirmation` (
  `idconfirmation` int(11) NOT NULL,
  `orderid` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  `payment` varchar(10) NOT NULL,
  `accountname` varchar(25) NOT NULL,
  `paydate` date NOT NULL,
  `tglsubmit` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vmm_confirmation`
--

INSERT INTO `vmm_confirmation` (`idconfirmation`, `orderid`, `userid`, `payment`, `accountname`, `paydate`, `tglsubmit`) VALUES
(7, '16QoK3ftklTtM', 1, 'Bank BCA', 'vanes', '2002-10-22', '2021-10-18 06:05:15'),
(8, '16vjtjCFl2FVs', 1, 'Bank Mandi', 'asdas', '2020-12-12', '2021-11-30 08:13:27'),
(9, '16EdZI6ecTeos', 1, 'Bank BCA', 'asads', '2222-02-12', '2021-12-07 07:55:49'),
(10, '16rC.jcYTZTeM', 16, 'Bank BCA', 'Vanes', '2021-12-13', '2021-12-13 08:57:39'),
(11, '16qlvbo1agDNw', 17, 'Bank BCA', 'name', '2021-12-14', '2021-12-13 10:52:54'),
(12, '16EtUl8ZwfiWI', 18, 'Bank BCA', 'Arif', '2000-04-08', '2021-12-13 11:59:11'),
(13, '16J7qbag4gjW6', 18, 'Bank BCA', 'Arif', '2021-12-12', '2021-12-14 06:02:44'),
(14, '16UpoZHn5meDw', 18, 'Bank BCA', 'Arif', '2021-12-14', '2021-12-14 06:07:13');

-- --------------------------------------------------------

--
-- Table structure for table `vmm_detailorder`
--

CREATE TABLE `vmm_detailorder` (
  `detailid` int(11) NOT NULL,
  `orderid` varchar(100) NOT NULL,
  `idproduct` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vmm_detailorder`
--

INSERT INTO `vmm_detailorder` (`detailid`, `orderid`, `idproduct`, `qty`) VALUES
(43, '167uwCVVAxU3E', 1, 2),
(44, '167uwCVVAxU3E', 2, 1),
(45, '167uwCVVAxU3E', 3, 1),
(46, '16QoK3ftklTtM', 2, 1),
(47, '16QoK3ftklTtM', 1, 1),
(48, '16QoK3ftklTtM', 4, 1),
(49, '16vjtjCFl2FVs', 2, 1),
(50, '16TCE.tEN7k2w', 2, 1),
(51, '16dru5fYuw49g', 3, 1),
(52, '16dru5fYuw49g', 2, 2),
(53, '16EdZI6ecTeos', 1, 3),
(54, '16Np/QI8zgYY6', 2, 1),
(55, '16rC.jcYTZTeM', 101, 1),
(56, '16qlvbo1agDNw', 4, 2),
(57, '16EtUl8ZwfiWI', 2, 2),
(58, '16J7qbag4gjW6', 101, 1),
(59, '16J7qbag4gjW6', 102, 2),
(60, '16abh8E.Wqqro', 2, 2),
(61, '16UpoZHn5meDw', 2, 1),
(62, '16UpoZHn5meDw', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vmm_payment`
--

CREATE TABLE `vmm_payment` (
  `no` int(11) NOT NULL,
  `method` varchar(25) NOT NULL,
  `norek` varchar(25) NOT NULL,
  `logo` text DEFAULT NULL,
  `an` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vmm_payment`
--

INSERT INTO `vmm_payment` (`no`, `method`, `norek`, `logo`, `an`) VALUES
(1, 'Bank BCA', '24125781275', 'img/bca.jpg', 'VMM-SSIP2021'),
(2, 'Bank Mandiri', '94481045843', 'img/mandiri.jpg', 'VMM-SSIP2021'),
(3, 'DANA', '088801234567', 'img/dana.png', 'VMM-SSIP2021');

-- --------------------------------------------------------

--
-- Table structure for table `vmm_product`
--

CREATE TABLE `vmm_product` (
  `idproduct` int(11) NOT NULL,
  `productname` varchar(30) NOT NULL,
  `image` varchar(100) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vmm_product`
--

INSERT INTO `vmm_product` (`idproduct`, `productname`, `image`, `deskripsi`, `price`, `datecreated`) VALUES
(1, 'Pancake', 'img/pancake.jpg', 'Really good pancake', 19000, '2019-12-20 09:10:26'),
(2, 'Toast', 'img/toast.jpg', 'Yes', 19500, '2019-12-20 09:24:13'),
(3, 'Good soup', 'img/img3.jpg', 'really good soup', 15000, '2020-03-16 12:16:53'),
(4, 'Fries', 'img/img4.jpg', 'Fried potato', 100000, '2021-10-12 19:21:37'),
(101, 'Steak Beef', 'img/steak.jpg', 'nice!', 100000, '2021-12-07 07:08:09'),
(102, 'Tofu', 'img/16aj.Ikc5W9Ss.jpeg', 'Vegetarian', 17000, '2021-12-13 08:54:58');

-- --------------------------------------------------------

--
-- Table structure for table `vmm_sign`
--

CREATE TABLE `vmm_sign` (
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `phonenum` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `role` varchar(7) NOT NULL DEFAULT 'Member',
  `joindate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vmm_sign`
--

INSERT INTO `vmm_sign` (`userid`, `username`, `password`, `phonenum`, `address`, `email`, `role`, `joindate`) VALUES
(1, 'admin', '$2y$10$GJVGd4ji3QE8ikTBzNyA0uLQhiGd6MirZeSJV1O6nUpjSVp1eaKzS', '01234567890', 'Indonesia', '', 'Admin', '2021-10-13 09:12:14'),
(2, 'guest', '$2y$10$xXEMgj5pMT9EE0QAx3QW8uEn155Je.FHH5SuIATxVheOt0Z4rhK6K', '01234567890', 'Indonesia', '', 'Member', '2021-10-13 09:12:14'),
(16, 'vanes', '$2y$10$TwIShgp70mmTeuGTz6UshOWMwf3x5f2TWTt3ou9dZsjsOOnAnPViu', '088801246263', 'Indonesia', 'vanesliu16@gmail.com', 'Member', '2021-12-13 08:56:18'),
(17, 'name', '$2y$10$iiHyGpjdCu8P6GWVT9cJ.OCTzEepdsrCrsA7BuhX/lHDVp/y/wRJi', '23232', 'ds', 'aa@gmail.com', 'Member', '2021-12-13 10:13:25'),
(18, 'arifghiffari', '$2y$10$XN3g.FdnXw/CRpQEXZ.8kOLKNNFIP2H8Lc5I5rwE7WqkWYJRvzenS', 'arifghiffari7', 'Jl.Sutera Buana V no.23', 'maghiffari20@gmail.com', 'Member', '2021-12-13 11:46:23'),
(20, 'test', '$2y$10$paaw05GhYup6HRym2y8Iv.ZiwMYxQQ3mqDVdM5Z.TPrRvy2Ag1bES', '1234', 'test', 'test@gmail.com', 'Member', '2021-12-14 01:48:30');

-- --------------------------------------------------------

--
-- Table structure for table `vmm_slider`
--

CREATE TABLE `vmm_slider` (
  `sliderid` int(100) NOT NULL,
  `image` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vmm_slider`
--

INSERT INTO `vmm_slider` (`sliderid`, `image`, `title`, `content`) VALUES
(1, 'img/steak.jpg', 'Steak', 'Special Offer'),
(2, 'img/img2.jpg', 'Family Meal', 'Cheaper!'),
(3, 'img/img3.jpg', 'Soup', 'Tasty'),
(4, 'img/img4.jpg', 'Large French fries', 'Crispy'),
(5, 'img/img5.jpeg', 'Upcoming Meal', 'Always check our website');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vmm_cart`
--
ALTER TABLE `vmm_cart`
  ADD PRIMARY KEY (`idcart`),
  ADD UNIQUE KEY `orderid` (`orderid`);

--
-- Indexes for table `vmm_confirmation`
--
ALTER TABLE `vmm_confirmation`
  ADD PRIMARY KEY (`idconfirmation`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `vmm_detailorder`
--
ALTER TABLE `vmm_detailorder`
  ADD PRIMARY KEY (`detailid`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `idproduk` (`idproduct`);

--
-- Indexes for table `vmm_payment`
--
ALTER TABLE `vmm_payment`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `vmm_product`
--
ALTER TABLE `vmm_product`
  ADD PRIMARY KEY (`idproduct`);

--
-- Indexes for table `vmm_sign`
--
ALTER TABLE `vmm_sign`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `vmm_slider`
--
ALTER TABLE `vmm_slider`
  ADD PRIMARY KEY (`sliderid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vmm_cart`
--
ALTER TABLE `vmm_cart`
  MODIFY `idcart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `vmm_confirmation`
--
ALTER TABLE `vmm_confirmation`
  MODIFY `idconfirmation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vmm_detailorder`
--
ALTER TABLE `vmm_detailorder`
  MODIFY `detailid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `vmm_payment`
--
ALTER TABLE `vmm_payment`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vmm_product`
--
ALTER TABLE `vmm_product`
  MODIFY `idproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `vmm_sign`
--
ALTER TABLE `vmm_sign`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `vmm_slider`
--
ALTER TABLE `vmm_slider`
  MODIFY `sliderid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
