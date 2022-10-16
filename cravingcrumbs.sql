-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2022 at 06:01 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cravingcrumbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(11) NOT NULL,
  `Username` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Username`, `Email`, `Password`) VALUES
(1, 'admin', 'admin@gmail.com', '123'),
(2, 'max', 'max@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `User_ID` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Logout_Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`User_ID`, `Username`, `Email`, `Password`, `Logout_Status`) VALUES
(53, 'max', 'max@gmail.com', '$2y$10$qzkTJkk8DNS7a70IczPXDuQSm6pnO0n.tm1dDrlu9L0UaLs22DQRa', 0),
(54, 'jack', 'jack@gmail.com', '$2y$10$qzkTJkk8DNS7a70IczPXDuQSm6pnO0n.tm1dDrlu9L0UaLs22DQRa', 1),
(57, 'alex', 'alex@gmail.com', '$2y$10$qzkTJkk8DNS7a70IczPXDuQSm6pnO0n.tm1dDrlu9L0UaLs22DQRa', 0),
(58, 'rudy', 'rudy@gmail.com', '$2y$10$qzkTJkk8DNS7a70IczPXDuQSm6pnO0n.tm1dDrlu9L0UaLs22DQRa', 0),
(59, 'jake', 'jake@gmail.com', '$2y$10$qzkTJkk8DNS7a70IczPXDuQSm6pnO0n.tm1dDrlu9L0UaLs22DQRa', 0),
(60, 'smith', 'smith@gmail.com', '$2y$10$qzkTJkk8DNS7a70IczPXDuQSm6pnO0n.tm1dDrlu9L0UaLs22DQRa', 0),
(61, 'james', 'james@gmail.com', '$2y$10$qzkTJkk8DNS7a70IczPXDuQSm6pnO0n.tm1dDrlu9L0UaLs22DQRa', 0),
(62, 'olive', 'olive@gmail.com', '$2y$10$qzkTJkk8DNS7a70IczPXDuQSm6pnO0n.tm1dDrlu9L0UaLs22DQRa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cakes`
--

CREATE TABLE `cakes` (
  `Cake_ID` int(11) NOT NULL,
  `Cake_Img` text NOT NULL,
  `Cake_Name` varchar(100) NOT NULL,
  `Price` int(11) NOT NULL,
  `PriceOf1` int(11) NOT NULL,
  `PriceOf1_5` int(11) NOT NULL,
  `PriceOf2` int(11) NOT NULL,
  `Cake_Flavors` varchar(100) NOT NULL,
  `Cake_Type` varchar(100) NOT NULL,
  `Cream_Type` varchar(100) NOT NULL,
  `Toppings` varchar(100) NOT NULL,
  `Bread_Type` varchar(100) NOT NULL,
  `Cake_Shape` varchar(100) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `Order_Time` int(11) NOT NULL,
  `Tags` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cakes`
--

INSERT INTO `cakes` (`Cake_ID`, `Cake_Img`, `Cake_Name`, `Price`, `PriceOf1`, `PriceOf1_5`, `PriceOf2`, `Cake_Flavors`, `Cake_Type`, `Cream_Type`, `Toppings`, `Bread_Type`, `Cake_Shape`, `Category`, `Order_Time`, `Tags`) VALUES
(39, 'Amazing Black Forest Cake.webp', 'Amazing Black Forest Cake', 150, 200, 250, 300, 'wad wafwaf', 'xyz agag', 'cream abgaw', 'ab,cs,aw,aw', 'bread bacwfa', 'Round', 'Best-Seller', 1, 'Amazing Black Forest Cake,round-cake,chocolate cake, cherry'),
(40, 'Cake.png', 'Cake', 151, 230, 250, 300, 'wad wafwaf awfw', 'xyz gwig', 'cream dnjwa', 'ab,cs,aw,aw,afwf', 'bread wagwg', 'Round', 'Best-Seller', 1, ',round-cake,chocolate cake, cherry'),
(41, 'Choco cake.webp', 'Choco cake', 160, 199, 261, 299, 'wad wafwaf awfw', 'xyz gwig', 'cream dnjwa', 'ab,cs,aw,aw,afwf', 'bread wagwg', 'Round', 'Best-Seller', 1, 'Choco cake,round-cake,chocolate cake, cherry,bBest-Seller'),
(42, 'Choco Nova Cake.webp', 'Choco Nova Cake', 170, 199, 261, 299, 'wad wafwaf ag', 'xyz gwagwwig', 'cream wagw', 'ab,cs,aw,aw,wag', 'bread wagwgs', 'Round', 'Best-Seller', 1, 'Choco Nova Cake,round-cake,chocolate cake, cherry,birthday-cakes'),
(43, 'fruit.jpg', 'fruit', 200, 250, 300, 400, 'wad wafwaf wga', 'xyz awgth', 'cream wagwagsgw', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Best-Seller', 2, 'fruit cake ,round-cake,chocolate cake, cherry,birthday-cakes'),
(44, 'Tempting Ferrero Rocher Cake.webp', 'Tempting Ferrero Rocher Cake', 200, 250, 300, 400, 'wad wafwaf wga', 'xyz awgth', 'cream wagwagsgw', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Best-Seller', 2, 'Tempting Ferrero Rocher Cake ,round-cake,chocolate cake, cherry,birthday-cakes'),
(45, 'Delicious Butterscotch Cake.jpeg', 'Delicious Butterscotch Cake', 150, 200, 250, 300, 'awg faf ', 'xyz wagwa', 'cream jhkujjgm', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Anniversary-Cake', 2, 'Tempting Ferrero Rocher Cake ,round-cake,Butterscotch cake, cherry,birthday-cakes'),
(46, 'Delicious Chocolate Cake.webp', 'Delicious Chocolate Cake', 150, 200, 250, 300, 'awg faf ', 'xyz wagwa', 'cream jhkujjgm', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Anniversary-Cake', 2, 'Delicious Chocolate Cake ,round-cake,Butterscotch cake, cherry,birthday-cakes'),
(47, 'Mango Maharaja Cake.webp', 'Mango Maharaja Cake', 170, 200, 230, 280, 'awg faf ', 'xyz wagwa', 'cream jhkujjgm', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Anniversary-Cake', 1, 'Mango Maharaja Cake ,round-cake,Butterscotch cake, cherry\r\n'),
(48, 'Mango Vanilla Cake.webp', 'Mango Vanilla Cake', 170, 200, 230, 280, 'awg faf ', 'xyz wagwa', 'cream jhkujjgm', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Anniversary-Cake', 1, 'Mango Vanilla Cake ,round-cake,vinillacake, cherry\r\n'),
(49, 'Stunning cream cake.webp', 'Stunning cream cake', 180, 230, 280, 300, 'awg faf ', 'xyz wagwa', 'cream jhkujjgm', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Anniversary-Cake', 1, 'Stunning cream cake ,round-cake,vinillacake, cherry\r\n'),
(50, 'Vanilla Cake.webp', 'Vanilla Cake', 180, 230, 280, 300, 'awg faf ', 'xyz wagwa', 'cream jhkujjgm', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Anniversary-Cake', 1, 'Vanilla Cake ,round-cake,vinillacake, cherry\r\n'),
(51, 'Birthday Butterscotch Cake.webp', 'Birthday Butterscotch Cake', 180, 230, 280, 300, 'awg faf ', 'xyz wagwa', 'cream jhkujjgm', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Birthday-Cakes', 1, 'Birthday Butterscotch Cake ,round-cake, chocolate cake, cherry, Birthday-cake, mango\r\n'),
(52, 'Choco cake.webp', 'Choco cake', 140, 200, 280, 300, 'awg faf ', 'xyz wagwa', 'cream jhkujjgm', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Birthday-Cakes', 1, 'Choco cake ,round-cake, chocolate cake, cherry, birthday-cake, birthday cake\r\n'),
(53, 'Scrummy Red Velvet Cake.webp', 'Scrummy Red Velvet Cake', 150, 200, 280, 350, 'awg faf ', 'xyz wagwa', 'cream jhkujjgm', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Birthday-Cakes', 2, 'Scrummy Red Velvet Cake ,round-cake, chocolate cake, cherry\r\n'),
(54, 'Vinila.webp', 'Vinila extra cream', 150, 200, 280, 350, 'awg faf ', 'xyz wagwa', 'cream jhkujjgm', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Birthday-Cakes', 2, 'Vinila ,round-cake, chocolate cake, cherry\r\n'),
(55, 'Bombshell Butterscotch Cake.webp', 'Bombshell Butterscotch Cake', 180, 230, 280, 350, 'awg faf ', 'xyz wagwa', 'cream jhkujjgm', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Premium-Cakes', 2, 'Bombshell Butterscotch Cake\r\n ,round-cake, chocolate cake, cherry\r\n'),
(56, 'Chocolaty Black Forest Cake.webp', 'Chocolaty Black Forest Cake', 150, 250, 280, 300, 'awg faf ', 'xyz wagwa', 'cream jhkujjgm', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Premium-Cakes', 1, 'Chocolaty Black Forest Cake\r\n ,round-cake, chocolate cake, cherry\r\n'),
(57, 'Crunchy and Juicy Fruit Cake.webp', 'Crunchy and Juicy Fruit Cake', 150, 250, 280, 300, 'awg faf ', 'xyz wagwa', 'cream jhkujjgm', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Premium-Cakes', 1, 'Crunchy and Juicy Fruit Cake\r\n ,round-cake, chocolate cake, cherry\r\n'),
(58, 'Crunchy Ferrero Chocolate cake.webp', 'Crunchy Ferrero Chocolate cake', 150, 220, 250, 300, 'awg faf ', 'xyz wagwa', 'cream jhkujjgm', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Premium-Cakes', 2, 'Crunchy Ferrero Chocolate cake\r\n ,round-cake, chocolate cake, cherry\r\n'),
(59, 'Delightful Kitkat Gems Cake.jpeg', 'Delightful Kitkat Gems Cake', 160, 200, 250, 300, 'awg faf ', 'xyz wagwa', 'cream jhkujjgm', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Premium-Cakes', 2, 'Delightful Kitkat Gems Cake\r\n ,round-cake, chocolate cake, cherry\r\n'),
(60, 'Trending Blackforest Bomb Cake.webp', 'Trending Blackforest Bomb Cake', 200, 250, 300, 350, 'awg faf ', 'xyz wagwa', 'cream jhkujjgm', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Premium-Cakes', 1, 'Trending Blackforest Bomb Cake\r\n ,round-cake, chocolate cake, cherry\r\n'),
(62, 'Three-layered Cake.jpg', 'Three-layered Cake', 230, 250, 330, 300, 'abc', 'xyz wagwa', 'cream jhkujjgm hwadiua cream', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Wedding-Cakes', 2, 'Three-layered Cake, wedding cake'),
(63, 'Vanilla Beauty Cake.webp', 'Vanilla Beauty Cake', 220, 260, 280, 350, 'abc', 'xyz wagwa', 'cream jhkujjgm', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Wedding-Cakes', 1, 'Vanilla Beauty Cake, wedding cake, vinilla cake'),
(64, 'White Rose Flowers.jpg', 'White Rose Flowers', 220, 260, 280, 350, 'abc', 'xyz wagwa', 'cream jhkujjgm', 'ab,cs,aw,aw,agawg', 'bread wagwagasawgs', 'Round', 'Wedding-Cakes', 1, 'White Rose Flowers, wedding cake, vinilla cake'),
(65, 'Black Round Cake.jpg', 'uwgdaiuwgfwa', 123, 200, 300, 350, 'awaf', 'wfafa', 'wdad', 'waafawf', 'wadad', 'Round', 'Wedding-Cakes', 1, 'wedding cake, round cake');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Cart_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Cake_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customcakeorders`
--

CREATE TABLE `customcakeorders` (
  `Custom_Cake_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Cake_Photo` text NOT NULL,
  `Cake_Flavors` text NOT NULL,
  `Cake_Type` text NOT NULL,
  `Cream_Type` text NOT NULL,
  `Toppings` text NOT NULL,
  `Bread_Type` text NOT NULL,
  `Cake_Shape` text NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Size` text NOT NULL,
  `Message` text NOT NULL,
  `Price` int(11) NOT NULL,
  `Payment_Status` text NOT NULL,
  `Status` text NOT NULL,
  `Arriving` text NOT NULL,
  `TimeOfOrder` text NOT NULL,
  `Delivery_Status` text NOT NULL,
  `Cancel_Status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customcakeorders`
--

INSERT INTO `customcakeorders` (`Custom_Cake_ID`, `User_ID`, `Cake_Photo`, `Cake_Flavors`, `Cake_Type`, `Cream_Type`, `Toppings`, `Bread_Type`, `Cake_Shape`, `Quantity`, `Size`, `Message`, `Price`, `Payment_Status`, `Status`, `Arriving`, `TimeOfOrder`, `Delivery_Status`, `Cancel_Status`) VALUES
(45, 57, 'User-57-62c2e5628a0db9.97131787.jpg', 'Cream', 'Cream', 'Round', 'awafa af', 'chocalote', 'Round', 1, '500gram', 'happy birthday', 200, 'completed', 'Accepted', '2022-07-17', '2022-07-04 18:35:13', 'Delivered', 'none'),
(50, 54, 'User-54-62c3e1144ebfc3.00365474.png', 'Cream', 'Cream', 'Round', 'wdawd awaw f', 'chocalote', 'Round', 1, '500gram', 'happy birthday', 200, 'completed', 'Accepted', '2022-07-06', '2022-07-05 12:29:40', 'Delivered', 'none'),
(51, 53, 'User-53-62c83892f344c4.90499064.png', 'Cream', 'Cream', 'Round', 'gawtd adwg', 'chocalote', 'Round', 1, '500gram', 'happy birthday', 200, 'pending', 'Accepted', '2022-08-07', '2022-07-08 19:30:50', 'pending', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Cake_id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Size` varchar(50) NOT NULL,
  `Message` varchar(100) NOT NULL,
  `Amt` int(11) NOT NULL,
  `TimeOfOrder` text NOT NULL,
  `Arriving` text NOT NULL,
  `Delivery_Status` text NOT NULL,
  `Cancel_Status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_ID`, `User_ID`, `Cake_id`, `Quantity`, `Size`, `Message`, `Amt`, `TimeOfOrder`, `Arriving`, `Delivery_Status`, `Cancel_Status`) VALUES
(83, 53, 43, 1, '1kg', 'happy birthday', 250, '2022-07-04 17:47:13', '6-07-2022', 'Delivered', 'none'),
(84, 53, 39, 2, '500gram', 'happy birthday', 300, '2022-07-04 17:47:27', '5-07-2022', 'Delivered', 'none'),
(85, 53, 60, 1, '1.5kg', 'happy birthday', 300, '2022-07-04 17:47:41', '5-07-2022', 'Delivered', 'none'),
(86, 53, 54, 1, '500gram', 'happy birthday', 150, '2022-07-04 17:48:03', '6-07-2022', 'Delivered', 'none'),
(87, 53, 42, 1, '500gram', 'happy birthday', 170, '2022-07-04 17:52:42', '5-07-2022', 'Pending', 'cancelled'),
(88, 54, 43, 1, '1kg', 'happy birthday', 250, '2022-07-04 17:55:30', '6-07-2022', 'Delivered', 'none'),
(89, 54, 54, 1, '1.5kg', 'happy birthday', 280, '2022-07-04 17:56:05', '6-07-2022', 'Delivered', 'none'),
(90, 54, 40, 1, '500gram', 'happy birthday', 151, '2022-07-04 17:56:16', '5-07-2022', 'Delivered', 'none'),
(91, 54, 39, 1, '500gram', 'happy birthday', 150, '2022-07-04 17:56:29', '5-07-2022', 'Delivered', 'none'),
(92, 54, 64, 2, '500gram', 'happy birthday', 440, '2022-07-04 17:56:46', '5-07-2022', 'Delivered', 'none'),
(93, 54, 54, 1, '500gram', 'happy birthday', 150, '2022-07-04 18:02:29', '6-07-2022', 'Delivered', 'none'),
(94, 54, 54, 1, '1.5kg', 'happy birthday', 280, '2022-07-04 18:03:34', '6-07-2022', 'Pending', 'cancelled'),
(95, 54, 42, 1, '1.5kg', 'happy birthday', 261, '2022-07-04 18:04:08', '5-07-2022', 'Delivered', 'none'),
(96, 54, 42, 1, '1.5kg', 'happy birthday', 261, '2022-07-04 18:04:09', '5-07-2022', 'Pending', 'cancelled'),
(97, 57, 43, 1, '2kg', 'happy birthday', 400, '2022-07-04 18:08:34', '6-07-2022', 'Delivered', 'none'),
(98, 57, 40, 1, '2kg', 'happy birthday', 300, '2022-07-04 18:09:53', '5-07-2022', 'Delivered', 'none'),
(99, 57, 44, 1, '500gram', 'happy birthday', 200, '2022-07-04 18:32:10', '6-07-2022', 'Pending', 'cancelled'),
(102, 54, 42, 1, '500gram', 'happy birthday', 170, '2022-07-05 12:25:33', '6-07-2022', 'Delivered', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `refund`
--

CREATE TABLE `refund` (
  `Refund_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Cake_ID` int(11) DEFAULT NULL,
  `Custom_Cake_ID` int(11) DEFAULT NULL,
  `Order_ID` int(11) DEFAULT NULL,
  `Amt` int(11) NOT NULL,
  `Status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `refund`
--

INSERT INTO `refund` (`Refund_ID`, `User_ID`, `Cake_ID`, `Custom_Cake_ID`, `Order_ID`, `Amt`, `Status`) VALUES
(32, 54, 54, NULL, 94, 280, 'completed'),
(33, 54, 42, NULL, 96, 261, 'completed'),
(34, 57, 44, NULL, 99, 200, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `refunddetails`
--

CREATE TABLE `refunddetails` (
  `RD_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Acc_Name` text DEFAULT NULL,
  `Acc_No` int(11) DEFAULT NULL,
  `IFSC` text DEFAULT NULL,
  `UPI` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `refunddetails`
--

INSERT INTO `refunddetails` (`RD_ID`, `User_ID`, `Acc_Name`, `Acc_No`, `IFSC`, `UPI`) VALUES
(5, 54, 'wdawdad', 123124124, '1312412', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `Review_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Cake_ID` int(11) NOT NULL,
  `Order_ID` int(11) NOT NULL,
  `Review` text NOT NULL,
  `Rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`Review_ID`, `User_ID`, `Cake_ID`, `Order_ID`, `Review`, `Rating`) VALUES
(12, 53, 54, 86, 'it was great cake', 3),
(13, 53, 39, 84, 'it was nice cake', 2),
(14, 53, 43, 83, 'great one ', 4),
(15, 54, 64, 92, 'it was great try it', 4),
(16, 54, 39, 91, 'it was nice...', 3),
(17, 54, 40, 90, 'bit poor', 2),
(18, 54, 43, 88, 'it is great....', 4),
(19, 54, 54, 89, 'bit poor improve plz', 2),
(20, 54, 42, 95, 'great cake', 4),
(21, 57, 43, 97, 'awesome cake', 4),
(22, 57, 40, 98, 'go for it..', 3);

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `UD_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Profile_Img` text NOT NULL,
  `Phone_No` int(11) NOT NULL,
  `Address` text NOT NULL,
  `City` text NOT NULL,
  `State` text NOT NULL,
  `Pincode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`UD_ID`, `User_ID`, `Profile_Img`, `Phone_No`, `Address`, `City`, `State`, `Pincode`) VALUES
(14, 53, 'none', 123456789, 'wafaf waafawf awfa ', 'waga', 'wagwag', 123214),
(15, 54, 'none', 123456789, 'awg wgawg awga wg', 'waga afgw', 'afawg', 12124),
(16, 57, '57.jpg', 123456789, 'waa afwa f afa', 'waga', 'wagwag2', 1234);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `cakes`
--
ALTER TABLE `cakes`
  ADD PRIMARY KEY (`Cake_ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Cart_ID`),
  ADD KEY `Cake_ID` (`Cake_ID`),
  ADD KEY `cart_ibfk_1` (`User_ID`);

--
-- Indexes for table `customcakeorders`
--
ALTER TABLE `customcakeorders`
  ADD PRIMARY KEY (`Custom_Cake_ID`),
  ADD KEY `customcakeorders_ibfk_1` (`User_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_ID`),
  ADD KEY `Cake_id` (`Cake_id`),
  ADD KEY `orders_ibfk_1` (`User_ID`);

--
-- Indexes for table `refund`
--
ALTER TABLE `refund`
  ADD PRIMARY KEY (`Refund_ID`),
  ADD KEY `Cake_ID` (`Cake_ID`),
  ADD KEY `refund_ibfk_1` (`User_ID`),
  ADD KEY `refund_ibfk_3` (`Custom_Cake_ID`),
  ADD KEY `refund_ibfk_4` (`Order_ID`);

--
-- Indexes for table `refunddetails`
--
ALTER TABLE `refunddetails`
  ADD PRIMARY KEY (`RD_ID`),
  ADD KEY `refunddetails_ibfk_1` (`User_ID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`Review_ID`),
  ADD KEY `Cake_ID` (`Cake_ID`),
  ADD KEY `review_ibfk_2` (`User_ID`),
  ADD KEY `review_ibfk_3` (`Order_ID`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`UD_ID`),
  ADD KEY `userdetails_ibfk_1` (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `cakes`
--
ALTER TABLE `cakes`
  MODIFY `Cake_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Cart_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `customcakeorders`
--
ALTER TABLE `customcakeorders`
  MODIFY `Custom_Cake_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `refund`
--
ALTER TABLE `refund`
  MODIFY `Refund_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `refunddetails`
--
ALTER TABLE `refunddetails`
  MODIFY `RD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `Review_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `UD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `auth` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`Cake_ID`) REFERENCES `cakes` (`Cake_ID`);

--
-- Constraints for table `customcakeorders`
--
ALTER TABLE `customcakeorders`
  ADD CONSTRAINT `customcakeorders_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `auth` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `auth` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`Cake_id`) REFERENCES `cakes` (`Cake_ID`);

--
-- Constraints for table `refund`
--
ALTER TABLE `refund`
  ADD CONSTRAINT `refund_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `auth` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `refund_ibfk_2` FOREIGN KEY (`Cake_ID`) REFERENCES `cakes` (`Cake_ID`),
  ADD CONSTRAINT `refund_ibfk_3` FOREIGN KEY (`Custom_Cake_ID`) REFERENCES `customcakeorders` (`Custom_Cake_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `refund_ibfk_4` FOREIGN KEY (`Order_ID`) REFERENCES `orders` (`Order_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `refunddetails`
--
ALTER TABLE `refunddetails`
  ADD CONSTRAINT `refunddetails_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `auth` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`Cake_ID`) REFERENCES `cakes` (`Cake_ID`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `auth` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_3` FOREIGN KEY (`Order_ID`) REFERENCES `orders` (`Order_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD CONSTRAINT `userdetails_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `auth` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
