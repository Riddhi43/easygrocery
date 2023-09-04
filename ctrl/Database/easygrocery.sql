-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2023 at 10:26 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easygrocery`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertData` ()   BEGIN
    DECLARE customerId INT;
    DECLARE productId INT;
    DECLARE counter INT DEFAULT 1;

    WHILE counter <= 10 DO
        SET customerId = FLOOR(RAND() * 45) + 1; -- Random customer ID between 1 and 45
        SET productId = FLOOR(RAND() * 120) + 1; -- Random product ID between 1 and 120

        -- Insert the data into the `customer_cart` table
        INSERT INTO customer_cart (fkCustomerId, fkProductId, qty)
        VALUES (customerId, productId, 2);

        SET counter = counter + 1;
    END WHILE;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` char(3) DEFAULT 'I'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `image`, `description`, `status`) VALUES
(1, 'Fruits', 'Fruits.jpg', 'Fresh and delicious fruits                                                                                                            ', 'A'),
(2, 'Vegetables', 'Vegetables.eggi', 'Nutritious and healthy vegetables                                    ', 'A'),
(3, 'Dairy Products', 'Dairy Products.jpg', 'Milk, cheese, and other dairy items                                                                                                                                                                                                                        ', 'A'),
(4, 'Bakery', 'Bakery.jpg', 'Breads, pastries, and baked goods                                    ', 'A'),
(5, 'Meat and Poultry', 'Meat and Poultry.jpg', 'Fresh meat and poultry products                                                                                                                                                                                                                                                                                                ', 'A'),
(6, 'Seafood', 'Seafood.ea', 'Fresh seafood items                                    ', 'A'),
(7, 'Canned Goods', 'Canned Goods.jpg', 'Canned fruits, vegetables, and soups                                                                                                                                                                                    ', 'A'),
(8, 'Snacks', 'Snacks.n', 'Chips, cookies, and other snacks                                                                                                            ', 'A'),
(9, 'Beverages', 'Beverages.jpg', 'Soft drinks, juices, and energy drinks                                    ', 'A'),
(10, 'Frozen Foods', 'Frozen Foods.jpg', 'Frozen fruits, vegetables, and meals                                                                                                                                                                                    ', 'A'),
(11, 'Condiments', 'Condiments.jpg', 'Sauces, dressings, and spices                                    ', 'A'),
(12, 'Household Supplies', 'Household Supplies.jpg', 'Cleaning and paper products                                                                                                                                                                                    ', 'A'),
(13, 'Spices and Seasonings', 'Spices and Seasonings.jpg', 'All types of Spices and Seasonings', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `couponCode` varchar(50) NOT NULL,
  `couponValue` varchar(50) NOT NULL,
  `minCartValue` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `couponCode`, `couponValue`, `minCartValue`, `status`) VALUES
(1, 'SAVE20', '20', 20, 'A'),
(2, 'SUM50', '50', 50, 'I');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `custName` varchar(255) DEFAULT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `custNumber` varchar(255) DEFAULT NULL,
  `custEmail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `custName`, `userName`, `password`, `custNumber`, `custEmail`) VALUES
(1, 'John Smith', 'johnsmith', 'cd4388c0c62e65ac8b99e3ec49fd9409', NULL, 'johnsmith@example.com'),
(2, 'Jane Doe', 'janedoe', 'a8c0d2a9d332574951a8e4a0af7d516f', NULL, 'janedoe@example.com'),
(3, 'Mark Johnson', 'markjohnson', 'e0006c0a6fee25ddec28c49ec2086815', NULL, 'markjohnson@example.com'),
(4, 'Emily Brown', 'emilybrown', '067032973d73da6c81ed4787d93a0c9c', NULL, 'emilybrown@example.com'),
(5, 'James Lee', 'jameslee', '2703d27376d81a4421a7381820b6258d', NULL, 'jameslee@example.com'),
(6, 'Sophia Kim', 'sophiakim', 'acb49fe09972f3e51fb1fce05c1ae606', NULL, 'sophiakim@example.com'),
(7, 'Daniel Clark', 'danielclark', '84bf041704d78602b766313def3bff52', NULL, 'danielclark@example.com'),
(8, 'Olivia Davis', 'oliviadavis', '0e1922728c1f233420b4f7c78c412a06', NULL, 'oliviadavis@example.com'),
(9, 'William Wright', 'williamwright', '2775a0165a8a2115f7c742837e35951d', NULL, 'williamwright@example.com'),
(10, 'Ava Thomas', 'avathomas', '86c385658bc591108bece32ca151dd33', NULL, 'avathomas@example.com'),
(11, 'Michael Hernandez', 'michaelhernandez', '8c97a69a1806445556336b32ec3fa4ae', NULL, 'michaelhernandez@example.com'),
(12, 'Isabella Anderson', 'isabellaanderson', '64f7881a6ba68d2d752d4f6e96f447b8', NULL, 'isabellaanderson@example.com'),
(13, 'David Taylor', 'davidtaylor', 'ce5e9782b1f8817dd620ed090b54b7cc', NULL, 'davidtaylor@example.com'),
(14, 'Mia Jackson', 'miajackson', '9437caaea34b21e00b49d8988c746b14', NULL, 'miajackson@example.com'),
(15, 'Christopher Martinez', 'christophermartinez', '6dd39864bedc6445bd2447f243a0f2c9', NULL, 'christophermartinez@example.com'),
(16, 'Emma Wilson', 'emmawilson', '1ece2de0839ffacb713716a1c064d3d9', NULL, 'emmawilson@example.com'),
(17, 'Matthew Anderson', 'matthewanderson', '5de2210affdb0b69d07fe2b56148ea8e', NULL, 'matthewanderson@example.com'),
(18, 'Avery Brown', 'averybrown', '6de592c14926774c9dc187f63d627e18', NULL, 'averybrown@example.com'),
(19, 'Alexander Johnson', 'alexanderjohnson', 'fcee0a77a3fc76adf2523bf2950554bf', NULL, 'alexanderjohnson@example.com'),
(20, 'Madison Garcia', 'madisongarcia', '27c748198201c2be686ee53497e8385a', NULL, 'madisongarcia@example.com'),
(21, 'Ethan Rodriguez', 'ethanrodriguez', 'cb233bc12a67068f7915196f24cbed1d', NULL, 'ethanrodriguez@example.com'),
(22, 'Abigail Smith', 'abigailsmith', 'eccb6e38c55aae4785fb952d8e78d167', NULL, 'abigailsmith@example.com'),
(23, 'Joshua Davis', 'joshuadavis', 'd2c021696f8593ed1e38bf0087d4d960', NULL, 'joshuadavis@example.com'),
(24, 'Chloe Martin', 'chloemartin', 'e42a9b3a8b2ece9cac7442b205d1dbc0', NULL, 'chloemartin@example.com'),
(25, 'Andrew Thomas', 'andrewthomas', '8715d25d1e208212eb87654c7ba11367', NULL, 'andrewthomas@example.com'),
(26, 'Grace Wilson', 'gracewilson', 'f89869d32a5694b8bc0be4b417f34976', NULL, 'gracewilson@example.com'),
(27, 'Christopher Hernandez', 'christopherhernandez', '29f025f272a6734e4515c64ed9cfc648', NULL, 'christopherhernandez@example.com'),
(28, 'Sofia Adams', 'sofiadams', '607c85347c8d84f07b881c09f5b48fef', NULL, 'sofiadams@example.com'),
(29, 'Ryan Lee', 'ryanlee', '0dde25378c139aa2580954968c0581c8', NULL, 'ryanlee@example.com'),
(30, 'Victoria Turner', 'victoriaturner', 'aca8298fefd4354ead919ad10b54e8e0', NULL, 'victoriaturner@example.com'),
(31, 'Jacob Martinez', 'jacobmartinez', 'f92fd5f984543203672253b65dccea65', NULL, 'jacobmartinez@example.com'),
(32, 'Aaliyah Scott', 'aaliyahscott', '20e4f50f22c99b3bd7199f8d5abda6e6', NULL, 'aaliyahscott@example.com'),
(33, 'Elijah Garcia', 'elijahgarcia', 'b55a981ccee532eacf7b73d75d3bcf8d', NULL, 'elijahgarcia@example.com'),
(34, 'Gabriella Wright', 'gabriellawright', '51f56c6d146bb8e1f988917313793849', NULL, 'gabriellawright@example.com'),
(35, 'Caleb Turner', 'calebturner', '5cc4ee81f81b18f32be8013fc7747cd3', NULL, 'calebturner@example.com'),
(36, 'Aria Anderson', 'ariaanderson', '8d4e0e76903eda97a9b5850808db31f0', NULL, 'ariaanderson@example.com'),
(37, 'Benjamin Wilson', 'benjaminwilson', '6912c75b29a2aee6393c889341a36f13', NULL, 'benjaminwilson@example.com'),
(38, 'Evelyn Davis', 'evelyndavis', '4854b3e3b357e501c34675fbbf942b44', NULL, 'evelyndavis@example.com'),
(39, 'Logan Rodriguez', 'loganrodriguez', '5510679901097aa70fe903c7272f3f8e', NULL, 'loganrodriguez@example.com'),
(40, 'Addison Martin', 'addisonmartin', 'cf71ae66cf7dcb6b54b0d4e9ce0a2c82', NULL, 'addisonmartin@example.com'),
(41, 'Gulger Mallik', 'gulzar', '1a00c02a21550953468822a503524ee7', '', 'gulgermallik@user.com'),
(42, 'Veda Salkar', 'veda', '6bbb59950bf85bc2413fe9754e584027', '', 'veda@user.com'),
(43, 'Riddhi Tailor', 'riddhi', '25f9e794323b453885f5181f1b624d0b', '', 'u2273114@unimail.hud.ac.uk'),
(44, 'Abhishek tailor', 'Abhishek', '827ccb0eea8a706c4c34a16891f84e7b', '', 'abhi@gmail.com'),
(45, 'Krishna Mistry', 'krishna', '81dc9bdb52d04dc20036dbd8313ed055', '', 'krishnat@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `id` int(11) NOT NULL,
  `fkCustomerId` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`id`, `fkCustomerId`, `address`, `title`) VALUES
(1, 1, '1234 Main St, Seattle, WA 98101', 'Home'),
(2, 1, '5678 Pine Rd, Seattle, WA 98101', 'Work'),
(3, 2, '9101 Elm St, San Francisco, CA 94107', 'Home'),
(4, 3, '2345 Maple Ave, New York, NY 10001', 'Work'),
(5, 3, '6789 Oak Blvd, New York, NY 10001', 'Home'),
(6, 3, '1111 Cedar St, New York, NY 10001', 'Work'),
(7, 4, '5555 Magnolia Dr, Los Angeles, CA 90001', 'Home'),
(8, 5, '7777 Spruce St, Boston, MA 02101', 'Home'),
(9, 5, '8888 Walnut Rd, Boston, MA 02101', 'Work'),
(10, 6, '9999 Cedar Ave, Houston, TX 77001', 'Home'),
(11, 7, '2222 Pine St, San Diego, CA 92101', 'Home'),
(12, 8, '4444 Oak Rd, San Francisco, CA 94107', 'Home'),
(13, 8, '3333 Cedar Ln, San Francisco, CA 94107', 'Work'),
(14, 9, '7777 Magnolia Way, Chicago, IL 60601', 'Home'),
(15, 9, '6666 Oak Blvd, Chicago, IL 60601', 'Work'),
(16, 10, '1111 Maple St, Denver, CO 80201', 'Home'),
(17, 10, '2222 Pine Ave, Denver, CO 80201', 'Work'),
(18, 10, '3333 Cedar Rd, Denver, CO 80201', 'Other'),
(19, 11, '5555 Walnut St, Las Vegas, NV 89101', 'Home'),
(20, 11, '4444 Pine Rd, Las Vegas, NV 89101', 'Work'),
(21, 12, '7777 Cedar Ave, Austin, TX 78701', 'Home'),
(22, 12, '8888 Magnolia Blvd, Austin, TX 78701', 'Work'),
(23, 13, '3333 Elm St, Miami, FL 33101', 'Home'),
(24, 13, '4444 Pine Ln, Miami, FL 33101', 'Work'),
(25, 14, '1111 Oak Dr, Atlanta, GA 30301', 'Home'),
(26, 15, '2222 Cedar St, Philadelphia, PA 19101', 'Home'),
(27, 16, '4444 Elm Rd, Seattle, WA 98101', 'Home'),
(28, 17, '6666 Magnolia Ln, Los Angeles, CA 90001', 'Home'),
(29, 17, '5555 Pine Way, Los Angeles, CA 90001', 'Work'),
(30, 18, '7777 Cedar Dr, New York, NY 10001', 'Home'),
(31, 19, '9999 Oak Blvd, San Francisco, CA 94107', 'Home'),
(32, 19, '8888 Pine Ave, San Francisco, CA 94107', 'Work'),
(33, 20, '3333 Maple Ln, Los Angeles, CA 90001', 'Home'),
(34, 21, '4444 Pine Rd, Boston, MA 02101', 'Home'),
(35, 22, '6666 Elm Ave, San Diego, CA 92101', 'Home'),
(36, 22, '5555 Oak Blvd, San Diego, CA 92101', 'Work'),
(37, 23, '7777 Cedar Ln, Houston, TX 77001', 'Home'),
(38, 24, '9999 Elm Rd, New York, NY 10001', 'Home'),
(39, 24, '8888 Oak Way, New York, NY 10001', 'Work'),
(40, 25, '3333 Pine Dr, Los Angeles, CA 90001', 'Home'),
(41, 26, '4444 Maple Ln, Boston, MA 02101', 'Home'),
(42, 26, '5555 Cedar Ave, Boston, MA 02101', 'Work'),
(43, 27, '7777 Pine Rd, Houston, TX 77001', 'Home'),
(44, 27, '6666 Elm Way, Houston, TX 77001', 'Work'),
(45, 28, '1111 Oak Ln, San Diego, CA 92101', 'Home'),
(46, 29, '2222 Pine Rd, San Francisco, CA 94107', 'Home'),
(47, 29, '3333 Cedar Ave, San Francisco, CA 94107', 'Work'),
(48, 30, '4444 Magnolia Dr, Los Angeles, CA 90001', 'Home'),
(49, 30, '5555 Elm Way, Los Angeles, CA 90001', 'Work'),
(50, 30, '6666 Oak Blvd, Los Angeles, CA 90001', 'Other'),
(51, 31, '7777 Elm Rd, Boston, MA 02101', 'Home'),
(52, 32, '8888 Cedar Ave, San Diego, CA 92101', 'Home'),
(53, 33, '4444 Pine Ave, Houston, TX 77001', 'Home'),
(54, 34, '5555 Magnolia Dr, New York, NY 10001', 'Home'),
(55, 34, '6666 Cedar Ln, New York, NY 10001', 'Work'),
(56, 35, '7777 Pine Ave, San Francisco, CA 94107', 'Home'),
(57, 36, '8888 Cedar Rd, Los Angeles, CA 90001', 'Home'),
(58, 36, '9999 Magnolia Ln, Los Angeles, CA 90001', 'Work'),
(59, 36, '5555 Oak Way, Los Angeles, CA 90001', 'Other'),
(60, 37, '4444 Cedar Rd, Boston, MA 02101', 'Home'),
(61, 38, '1111 Elm Rd, Seattle, WA 98101', 'Home'),
(62, 38, '2222 Oak Blvd, Seattle, WA 98101', 'Work'),
(63, 38, '3333 Cedar Ave, Seattle, WA 98101', 'Other'),
(64, 39, '4444 Pine Rd, Miami, FL 33101', 'Home'),
(65, 39, '5555 Oak Blvd, Miami, FL 33101', 'Work'),
(66, 39, '6666 Elm Ave, Miami, FL 33101', 'Other'),
(67, 40, '7777 Pine Ave, Phoenix, AZ 85001', 'Home'),
(68, 40, '8888 Magnolia Dr, Phoenix, AZ 85001', 'Work'),
(69, 40, '9999 Cedar Rd, Phoenix, AZ 85001', 'Other'),
(70, 40, '5555 Oak Ln, Phoenix, AZ 85001', 'Other'),
(71, 41, 'Storthes Hall Lane, Storthes Hall Park, Kirkburton, Huddersfield, HD8 0WN', 'Default'),
(72, 42, 'Storthes Hall Lane,\r\nStorthes Hall Park Myers B.3\r\nKirkburton, Huddersfield\r\nHD8 0WN', 'Default'),
(74, 43, 'Moorbottom Road, Huddersfield', 'HOME'),
(75, 44, 'Paddock, Huddersfield', 'Default'),
(77, 45, 'Paddock, Huddersfield', 'Home'),
(78, 45, 'Wakefield, UK', 'Office');

-- --------------------------------------------------------

--
-- Table structure for table `customer_cart`
--

CREATE TABLE `customer_cart` (
  `id` int(11) NOT NULL,
  `fkCustomerId` int(11) NOT NULL,
  `fkProductId` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_cart`
--

INSERT INTO `customer_cart` (`id`, `fkCustomerId`, `fkProductId`, `qty`) VALUES
(323, 11, 54, 2),
(324, 23, 21, 2),
(325, 17, 42, 2),
(326, 28, 118, 2),
(327, 5, 68, 2),
(328, 23, 96, 2),
(329, 22, 3, 2),
(330, 31, 34, 2),
(331, 18, 10, 2),
(332, 12, 9, 2),
(333, 43, 12, 3),
(334, 43, 48, 2),
(335, 43, 60, 1),
(336, 45, 56, 2),
(337, 45, 5, 1),
(338, 45, 26, 2);

-- --------------------------------------------------------

--
-- Table structure for table `customer_feedback`
--

CREATE TABLE `customer_feedback` (
  `id` int(11) NOT NULL,
  `custName` varchar(50) NOT NULL,
  `custEmail` varchar(100) NOT NULL,
  `custMsg` varchar(300) NOT NULL,
  `adminReply` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_feedback`
--

INSERT INTO `customer_feedback` (`id`, `custName`, `custEmail`, `custMsg`, `adminReply`) VALUES
(1, 'Abhishek', 'abhi@gmail.com', 'I am happy with your Services                                    ', 'Thank you for your valuable feedback'),
(2, 'Riddhi', 'u2273114@unimail.hud.ac.uk', 'Please contact me by email.', ''),
(3, 'kesar', 'kesar@gmail.com', 'this is a nice website', ''),
(4, 'shital', 'stailor@gmail.com', 'sfsepjrwe', ''),
(5, 'krishna', 'krishnat@gmail.com', 'I love this website', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer_wishlist`
--

CREATE TABLE `customer_wishlist` (
  `id` int(11) NOT NULL,
  `fkCustomerId` int(11) NOT NULL,
  `fkProductId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_wishlist`
--

INSERT INTO `customer_wishlist` (`id`, `fkCustomerId`, `fkProductId`) VALUES
(1, 12, 45),
(2, 23, 78),
(3, 34, 105),
(4, 17, 62),
(5, 39, 92),
(6, 7, 14),
(7, 30, 101),
(8, 21, 67),
(9, 10, 30),
(11, 15, 51),
(12, 27, 85),
(13, 38, 118),
(14, 6, 11),
(15, 20, 65),
(16, 33, 107),
(17, 25, 79),
(18, 8, 23),
(19, 31, 97),
(20, 14, 49),
(21, 3, 8),
(22, 16, 54),
(23, 29, 94),
(24, 41, 117),
(25, 24, 75),
(26, 37, 110),
(27, 19, 58),
(28, 32, 100),
(29, 9, 27),
(30, 42, 112),
(31, 13, 42),
(32, 26, 84),
(33, 40, 111),
(34, 18, 57),
(35, 1, 4),
(36, 28, 89),
(37, 11, 37),
(38, 36, 109),
(39, 22, 69),
(40, 35, 104),
(41, 2, 6),
(42, 40, 105),
(43, 4, 10),
(44, 17, 55),
(45, 39, 96),
(46, 7, 15),
(47, 30, 93),
(48, 21, 70),
(49, 10, 31),
(51, 3, 12),
(52, 28, 76),
(53, 9, 29),
(54, 40, 111),
(55, 22, 67),
(56, 35, 100),
(57, 2, 5),
(58, 40, 104),
(59, 4, 9),
(60, 17, 58),
(61, 39, 95),
(62, 7, 16),
(63, 30, 90),
(64, 21, 71),
(65, 10, 32),
(67, 15, 53),
(68, 27, 87),
(69, 38, 116),
(70, 6, 13),
(71, 20, 63),
(72, 33, 106),
(73, 25, 81),
(74, 8, 22),
(75, 31, 98),
(76, 14, 47),
(77, 41, 115),
(78, 24, 74),
(79, 37, 108),
(80, 19, 61),
(81, 32, 99),
(82, 9, 26),
(83, 42, 113),
(84, 13, 41),
(85, 26, 83),
(86, 40, 12),
(87, 18, 56),
(88, 1, 3),
(89, 28, 86),
(90, 11, 36),
(91, 36, 107),
(92, 22, 68),
(93, 35, 102),
(94, 2, 7),
(95, 4, 103),
(96, 4, 11),
(97, 17, 60),
(98, 39, 98),
(99, 7, 17),
(100, 30, 91),
(101, 21, 72),
(102, 10, 33),
(104, 15, 52),
(105, 27, 89),
(106, 38, 119),
(107, 6, 15),
(108, 20, 65),
(109, 33, 110),
(110, 25, 79),
(111, 8, 23),
(112, 31, 97),
(113, 14, 46),
(114, 41, 114),
(115, 24, 75),
(116, 37, 109),
(117, 19, 59),
(118, 32, 100),
(119, 9, 27),
(120, 42, 112),
(121, 13, 40),
(122, 26, 82),
(123, 40, 11),
(124, 18, 55),
(125, 1, 2),
(126, 28, 85),
(127, 11, 35),
(128, 36, 106),
(129, 22, 69),
(130, 35, 101),
(131, 2, 6),
(132, 5, 102),
(133, 4, 10),
(134, 17, 59),
(135, 39, 97),
(136, 7, 16),
(137, 30, 90),
(138, 21, 73),
(139, 10, 34),
(141, 15, 51),
(142, 27, 88),
(143, 38, 117),
(144, 6, 14),
(145, 20, 64),
(146, 33, 109),
(147, 25, 80),
(148, 8, 24),
(149, 31, 96),
(150, 14, 45),
(151, 41, 113),
(152, 24, 76),
(153, 37, 107),
(154, 19, 60),
(155, 32, 101),
(156, 9, 28),
(157, 43, 111),
(158, 43, 39),
(159, 45, 81),
(160, 45, 120);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `fkCustomerId` int(11) NOT NULL,
  `orderType` char(10) NOT NULL,
  `orderDate` date DEFAULT NULL,
  `fkCouponId` int(11) NOT NULL,
  `couponCode` varchar(50) NOT NULL,
  `couponValue` decimal(11,2) NOT NULL,
  `totalAmount` decimal(11,2) DEFAULT NULL,
  `shippingAddress` varchar(255) DEFAULT NULL,
  `paymentMethod` varchar(255) DEFAULT NULL,
  `status` char(3) DEFAULT 'I'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `fkCustomerId`, `orderType`, `orderDate`, `fkCouponId`, `couponCode`, `couponValue`, `totalAmount`, `shippingAddress`, `paymentMethod`, `status`) VALUES
(1, 43, 'ORD', '2023-08-16', 0, '', 0.00, 23.26, 'Moorbottom Road, Huddersfield', 'CARD', 'DEL'),
(2, 43, 'ORD', '2023-08-17', 0, '', 0.00, 4.96, 'Moorbottom Road, Huddersfield', 'PAL', 'A'),
(4, 43, 'ORD', '2023-08-27', 0, '', 0.00, 29.45, 'Moorbottom Road, Huddersfield', 'COD', 'A'),
(5, 43, 'ORD', '2023-08-27', 0, '', 0.00, 55.58, 'Moorbottom Road, Huddersfield', 'PAL', 'A'),
(8, 45, 'ORD', '2023-09-04', 0, '', 0.00, 20.68, 'Wakefield, UK', 'PAL', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `fkOrderId` int(11) NOT NULL,
  `fkProductId` int(11) NOT NULL,
  `unitPrice` decimal(11,2) DEFAULT NULL,
  `itemQuantity` int(11) DEFAULT NULL,
  `totalPrice` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `fkOrderId`, `fkProductId`, `unitPrice`, `itemQuantity`, `totalPrice`) VALUES
(55973, 1, 1, 1.59, 1, 1.59),
(55974, 1, 113, 10.19, 1, 10.19),
(55975, 1, 114, 8.99, 1, 8.99),
(55976, 1, 103, 2.49, 1, 2.49),
(55978, 2, 2, 1.49, 2, 2.98),
(55979, 2, 3, 0.99, 2, 1.98),
(56007, 4, 1, 1.59, 1, 1.59),
(56008, 4, 5, 3.49, 1, 3.49),
(56009, 4, 116, 7.69, 2, 15.38),
(56010, 4, 114, 8.99, 1, 8.99),
(56021, 5, 54, 19.89, 1, 19.89),
(56022, 5, 38, 19.99, 1, 19.99),
(56023, 5, 55, 15.70, 1, 15.70),
(56073, 8, 34, 2.00, 3, 6.00),
(56074, 8, 28, 2.00, 2, 4.00),
(56075, 8, 78, 1.69, 1, 1.69),
(56076, 8, 45, 8.99, 1, 8.99);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `fkOrderId` int(11) NOT NULL,
  `orderStatusName` varchar(255) DEFAULT NULL,
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `fkOrderId`, `orderStatusName`, `comments`) VALUES
(1, 1, 'DELIV', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `productQty` int(11) NOT NULL,
  `productPrice` decimal(11,2) DEFAULT NULL,
  `salePrice` decimal(11,2) DEFAULT NULL,
  `productDesc` text DEFAULT NULL,
  `productImg` varchar(255) DEFAULT NULL,
  `dateCreated` date DEFAULT NULL,
  `useridCreated` int(11) NOT NULL,
  `dateUpdated` varchar(255) DEFAULT NULL,
  `useridUpdated` varchar(255) DEFAULT NULL,
  `status` char(3) DEFAULT 'I',
  `productMoreDesc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categoryId`, `productName`, `productQty`, `productPrice`, `salePrice`, `productDesc`, `productImg`, `dateCreated`, `useridCreated`, `dateUpdated`, `useridUpdated`, `status`, `productMoreDesc`) VALUES
(1, 1, 'Apple', 49, 1.99, 1.59, 'Fresh and juicy apple                                                                                                            ', 'Apple.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                Gala are a sweet flavoured apple with a firm fleshy texture. It is an exciting range of high-quality food products at great prices. We offer a wide range of staples such as British milk, fresh produce, British meat, responsibly sourced fish and a growing selection of store cupboard ingredients and every day favourites. You will also find a wide range of delicious cheeses, cooked &amp; continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our products to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        '),
(2, 1, 'Orange', 50, 1.49, NULL, 'Sweet and citrusy orange                                                                        ', 'Orange.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Sweet and citrusy orange. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(3, 1, 'Banana', 50, 0.99, NULL, 'Yellow and nutritious banana                                                                                                            ', 'Banana.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', '                                                                                Yellow and nutritious banana.It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked &amp; continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.                                                                        '),
(4, 1, 'Grapes', 50, 2.99, 2.59, 'Juicy and refreshing grapes                                                                                                            ', 'Grapes.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Juicy and refreshing grapes. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(5, 1, 'Strawberries', 60, 3.49, NULL, 'Plump and sweet strawberries                                    ', 'Strawberries.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Plump and sweet strawberries. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(6, 1, 'Watermelon', 50, 4.99, NULL, 'Large and juicy watermelon                                    ', 'Watermelon.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Large and juicy watermelon. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(7, 1, 'Mango', 50, 2.49, NULL, 'Tropical and flavorful mango                                    ', 'Mango.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Tropical and flavorful mango. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(8, 1, 'Pineapple', 50, 3.99, 3.00, 'Sweet and tangy pineapple                                    ', 'Pineapple.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Sweet and tangy pineapple. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(9, 1, 'Kiwi', 50, 1.79, NULL, 'Tart and refreshing kiwi                                    ', 'Kiwi.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Tart and refreshing kiwi. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(10, 1, 'Peach', 50, 2.29, NULL, 'Juicy and fragrant peach                                                                        ', 'Peach.each1', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Juicy and fragrant peach. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(11, 2, 'Carrot', 50, 0.99, NULL, '                                                                                Crunchy and nutritious carrot                                                                        ', 'Carrot.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Expertly selected Organic Sweet and tasty carrots. It offers a source of Vitamin A and beta-carotene. These sweet tasty carrots are lovely eaten raw or cooked.'),
(12, 2, 'Broccoli', 50, 1.49, NULL, '                                                                                Healthy and versatile broccoli                                                                        ', 'Broccoli.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Broccoli is a good source of vitamin C and K as well as fibre. With an earthy robust flavour and can be eaten cooked or raw. IT is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our products to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(13, 2, 'Tomato', 50, 0.79, 0.59, '                                                                                Juicy and flavorful tomato                                                                        ', 'Tomato.oma', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Firm and juicy medium sized tomatoes, perfect thickly sliced and layered with mozzarella and basil for a delicious salad. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(14, 2, 'Spinach', 50, 1.29, NULL, 'Nutrient-rich and leafy spinach                                    ', 'Spinach.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Mild and delicate baby spinach leaves, washed and ready to eat. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(15, 2, 'Cucumber', 50, 0.89, NULL, 'Cool and refreshing cucumber                                    ', 'Cucumber.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Cool and refreshing cucumber. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(16, 2, 'Bell Pepper', 50, 1.99, NULL, 'Crisp and colorful bell pepper                                                                                                                                                                                                                        ', 'Bell Pepper.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Crisp and colorful bell pepper. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(17, 2, 'Lettuce', 50, 1.49, NULL, 'Crisp and fresh lettuce                                    ', 'Lettuce.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Crisp and fresh lettuce. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(18, 2, 'Zucchini', 50, 1.29, NULL, 'Versatile and tender zucchini                                    ', 'Zucchini.avif', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Versatile and tender zucchini. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(19, 2, 'Cabbage', 50, 1.79, NULL, 'Crisp and leafy cabbage                                    ', 'Cabbage.webp', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Crisp and leafy cabbage. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(20, 2, 'Asparagus', 50, 2.49, NULL, 'Delicate and tender asparagus                                                                        ', 'Asparagus.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Delicate and tender asparagus. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(21, 3, 'Milk', 50, 2.99, 2.31, 'Fresh and nutritious milk                                    ', 'Milk.ilk', '2023-06-04', 1, '2023-06-04', '1', 'A', 'British Semi Skimmed Milk, from British Farms.All our milk is British sourced through Arla via a farmer owned co-operative with over 2,500 British dairy farmers supplying fresh milk for our delicious products. This ensures our milk is nutritious and sourced responsibly.Arla operates to some of the highest animal welfare and sustainability standards in the world; the quality of the milk is controlled all the way from the cow to the shelf.'),
(22, 3, 'Cheese', 50, 4.99, NULL, 'Variety of cheese options                                    ', 'Cheese.heese', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Made in the UK and extra matured to give a rich flavour, using pasturised whole milk from farm assured cows. Makes a perfect addition to any cheeseboard. Our Selection is by Amazons\' premium offer. It is a curated selection of products that focus on the very best varietal sourcing, authentic ingredients and traditional processes to bring you delicious tasting food.'),
(23, 3, 'Yogurt', 50, 1.49, NULL, 'Creamy and delicious yogurt                                    ', 'Yogurt.jpeg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Yeo Valley Organic Natural Yogurt is 100% natural. Bio live yogurt that contains no added sugar, is full of organic goodness and is suitable for vegetarians. Yeo Valley have been farming in Somerset since 1961 and are 100% Yeoganic. What\'s Yeoganic? It\'s their way of being organic & a little bit more - they go the extra country mile when it comes to keeping their land & livestock healthy.'),
(24, 3, 'Butter', 50, 3.49, NULL, 'Rich and flavorful butter                                                                        ', 'Butter.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Genuine excellence and mouth-watering flavour don’t just come out of nowhere, and Lurpak has had an uncompromising approach to making real, quality butter since 1901. It takes a special something to create a butter that’s, well, better, and therefore Lurpak is only made with the highest quality of ingredients.Ideal for all your food adventures, be it baking, spreading, drizzling, mixing, frying… we have a range of butter and spreadables to meet your needs. With Lurpak by your side you’re always ready to start cooking. Now sleeves up. Today we cook bold.'),
(25, 3, 'Eggs', 50, 2.99, NULL, 'Fresh and organic eggs                                    ', 'Eggs.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', '12 Large, class A, British free range eggs. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(26, 3, 'Cream', 50, 2.00, NULL, 'Whipped and heavy cream                                    ', 'Cream.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Rich and Indulgent Double Cream. Serve whipped or as it is on desserts, perfect to make mousses, crème brulées and cheesecakes or whipped to decorate cakes.'),
(27, 3, 'Yogurt Drink', 50, 2.00, NULL, 'Refreshing and probiotic drink                                                                                                            ', 'Yogurt Drink.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Petits Filous is a kids Yogurt and fromage frais brand. Petits Filous mess free drinking yogurt, perfect for an on the go snack for little ones. Petits Filous drinking yogurt in Strawberry, Peach, Raspberry or Vanilla, a perfect kids yogurt with no mess. Each bottle of Petits Filous drinking yogurt has a slow release cap, a perfect kids snack and no mess. Made with 100 percent fresh milk.'),
(28, 3, 'Sour Cream', 50, 2.00, NULL, 'Tangy and creamy sour cream                                                                        ', 'Sour Cream.png', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Soured Cream is the perfect topped on chilli or nachos.It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(29, 3, 'Cottage Cheese', 50, 2.00, NULL, 'Light and fluffy cottage cheese                                    ', 'Cottage Cheese.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Light and fluffy cottage cheese. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(30, 3, 'Whipped Cream', 50, 3.00, NULL, 'Fluffy and sweet whipped cream                                                                                                            ', 'Whipped Cream.ipped cream', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Fluffy and sweet whipped cream. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(31, 4, 'Bread', 50, 2.00, NULL, 'Freshly baked bread                                                                        ', 'Bread.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Freshly baked bread. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(32, 4, 'Baguette', 50, 2.00, NULL, 'Crusty and delicious baguette                                                                        ', 'Baguette.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Crusty and delicious baguette. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(33, 4, 'Croissant', 50, 1.00, NULL, 'Buttery and flaky croissant                                                                        ', 'Croissant.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Buttery and flaky croissant. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(34, 4, 'Muffin', 50, 2.00, NULL, 'Moist and flavorful muffin                                    ', 'Muffin.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Moist and flavorful muffin. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(35, 4, 'Cupcake', 50, 1.00, NULL, 'Decorative and sweet cupcake                                    ', 'Cupcake.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Decorative and sweet cupcake. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(36, 4, 'Cookies', 50, 3.00, NULL, 'Variety of delicious cookies                                                                                                                                                ', 'Cookies.webp', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Delicious & Nutritious Snack Bar - We never compromise on taste, our bars are always tasty and nutritious. The perfect blend!'),
(37, 4, 'Pastry', 50, 2.49, NULL, 'Flaky and indulgent pastry                                    ', 'Pastry.jpeg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Ready to Bake at Home, these classic Cinnamon Swirls are made with 24 layers of light flaky pastry, a deliciously soft centre and swirled with sweet cinnamon. Icing included to decorate.'),
(38, 4, 'Cake', 50, 19.99, 0.00, 'Celebratory and delectable cake                                    ', 'Cake.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', '                                                                                Rich chocolate sponge cake generously filled and topped with a Belgian milk chocolate ganache buttercream. Fudgy, indulgent and irresistible. The perfect treat for any day of the week.                                                                         '),
(39, 4, 'Pretzel', 50, 1.79, NULL, 'Salty and twisted pretzel                                    ', 'Pretzel.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Penn State Original Salted Pretzels is perfectly baked delicious pretzel knots. It can be enjoyed as part of a balanced diet and healthy lifestyle. It is suitable for vegetarians. It contains gluten and wheat. It is approved by vegetarian society. It is baked in the oven and great combination, an all-time favourite.'),
(40, 4, 'Pie', 50, 12.99, NULL, 'Homemade and delicious pie                                    ', 'Pie.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Great taste 2018. A 100% British beef steak and craft ale pie. Pieminister\'s Moo pie is a best-selling pie and has been awarded multiple Great Taste Awards.'),
(41, 5, 'Chicken Breast', 50, 7.99, NULL, 'Skinless and boneless chicken breast                                                                        ', 'Chicken Breast.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Skinless and boneless chicken breast. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(42, 5, 'Ground Beef', 50, 5.99, NULL, 'Premium quality ground beef                                    ', 'Ground Beef.b', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Premium quality ground beef. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(43, 5, 'Pork Chops', 50, 6.49, NULL, 'Juicy and tender pork chops                                    ', 'Pork Chops.s', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Juicy and tender pork chops. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(44, 5, 'Lamb Rack', 50, 12.99, NULL, 'Tasty and succulent lamb rack                                    ', 'Lamb Rack.r', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Tasty and succulent lamb rack. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(45, 5, 'Turkey Breast', 50, 8.99, NULL, 'Lean and flavorful turkey breast                                    ', 'Turkey Breast.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Lean and flavorful turkey breast. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(46, 5, 'Beef Steak', 50, 9.99, NULL, 'Grilled and tender beef steak                                    ', 'Beef Steak.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Grilled and tender beef steak. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(47, 5, 'Lamb Chops', 50, 13.49, NULL, 'Savory and succulent lamb chops                                    ', 'Lamb Chops.c', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Savory and succulent lamb chops. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(48, 5, 'Pork Ribs', 50, 11.79, NULL, 'Smoky and delicious pork ribs                                    ', 'Pork Ribs.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Smoky and delicious pork ribs. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(49, 5, 'Chicken Thighs', 50, 9.89, NULL, 'Moist and flavorful chicken thighs                                    ', 'Chicken Thighs.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Moist and flavorful chicken thighs. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(50, 5, 'Ground Turkey', 50, 8.49, NULL, 'Lean and versatile ground turkey                                    ', 'Ground Turkey.t', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Lean and versatile ground turkey. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(51, 6, 'Salmon Fillet', 50, 10.49, NULL, 'Fresh and flaky salmon fillet                                    ', 'Salmon Fillet.png', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Fresh and flaky salmon fillet. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(52, 6, 'Shrimp', 50, 12.89, NULL, 'Jumbo and succulent shrimp                                    ', 'Shrimp.h', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Jumbo and succulent shrimp. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(53, 6, 'Tuna Steak', 50, 12.80, NULL, 'Grilled and flavorful tuna steak                                    ', 'Tuna Steak.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Grilled and flavorful tuna steak. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(54, 6, 'Lobster Tail', 50, 19.89, NULL, 'Deluxe and buttery lobster tail                                    ', 'Lobster Tail.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Deluxe and buttery lobster tail. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(55, 6, 'Scallops', 50, 15.70, NULL, 'Plump and tender scallops                                    ', 'Scallops.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Plump and tender scallops. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(56, 6, 'Cod Fillet', 50, 8.59, NULL, 'Mild and flaky cod fillet                                    ', 'Cod Fillet.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Mild and flaky cod fillet. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(57, 6, 'Crab Legs', 50, 17.49, NULL, 'Sweet and succulent crab legs                                    ', 'Crab Legs.l', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Sweet and succulent crab legs. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(58, 6, 'Mahi Mahi', 50, 10.69, NULL, 'Delicate and flavorful mahi mahi                                    ', 'Mahi Mahi.jpeg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Made with craft ghost peppers (bhut jolokia)'),
(59, 6, 'Swordfish Steak', 50, 13.99, NULL, 'Robust and meaty swordfish steak                                    ', 'Swordfish Steak.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Robust and meaty swordfish steak. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(60, 6, 'Crawfish', 50, 6.79, NULL, 'Louisiana-style boiled crawfish                                    ', 'Crawfish.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Louisiana-style boiled crawfish. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(61, 7, 'Canned Soup', 50, 2.59, NULL, 'Variety of delicious canned soups                                    ', 'Canned Soup.s', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Heinz Classic Cream of Tomato Soup is packed with tomatoes to create a delicious soup that\'s bursting with flavour. It is 1 of your 5 a day in a can when eaten as part of a balanced diet. It contains 179 calories per can. It is low in fat and sugar. It is suitable for vegetarians.'),
(62, 7, 'Canned Beans', 50, 1.99, NULL, 'Assorted canned beans for cooking                                    ', 'Canned Beans.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Heinz Baked Beanz in a deliciously rich tomato sauce are naturally high in fibre and low in fat. It is virtually fat free and gluten free. They also contain no artificial colours, flavours or preservatives, which makes them an ideal snack or accompaniment to any meal. It is suitable for vegetarians. 1 of your 5 a day in half a can when eaten as part of balanced diet.'),
(63, 7, 'Canned Vegetables', 50, 1.39, NULL, 'Preserved vegetables in cans                                    ', 'Canned Vegetables.png', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Picked and packed at the peak of perfection and then gently steam cooked in the can to keep the corn sweet, juicy and full of flavour. Enjoy the naturally sweet taste of our delicious Salt Free variety.'),
(64, 7, 'Canned Tuna', 50, 1.59, NULL, 'Flavorful canned tuna                                    ', 'Canned Tuna.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Naturally high in protein tuna chunks, the perfect companion for muscle growth or fat loss. This versatile tuna is great for adding healthy, natural protein to your snacks, post gym or mid-week meals.'),
(65, 7, 'Canned Fruit', 50, 2.79, NULL, 'Assortment of canned fruits                                    ', 'Canned Fruit.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Del Monte fruit cocktail in light syrup only picks fruit once it has reached the moment of perfect ripeness. The fruit is packed within hours with the upmost care to ensure that each and every can of Del Monte fruit only contains the freshest, tastiest and juiciest fruit. It can be used in desserts, as an ice cream topping or as an essential ingredient in fruit salads. It is a tasty combo of preservative and fat-free peaches, pears, grapes, pineapple, and cherries mixed, sliced, and diced for your convenience. It is suitable for vegetarians.'),
(66, 7, 'Canned Tomatoes', 50, 1.49, NULL, 'Rich and tangy canned tomatoes                                    ', 'Canned Tomatoes.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Chopped Tomatoes in Tomato Juice made from fresh and ripe Italian tomatoes, delicately cut and dipped in slightly concentrated tomato juice. Naturally sweet with no added salt. Suitable for vegetarian and vegan diets.'),
(67, 7, 'Canned Chicken', 50, 3.49, NULL, 'Convenient canned chicken meat                                    ', 'Canned Chicken.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Bart Hot Chilli Powder, add some chilli spice to your dishes. Use as a seasoning to prepare meat and vegan proteins or to boost the heat in sauces and marinades. Packaged with Innovative Spoonkler Cap - Herbs and Spices - 36g Jar.'),
(68, 7, 'Canned Corn', 50, 1.79, NULL, 'Sweet and tender canned corn                                    ', 'Canned Corn.k', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Picked and packed at the peak of perfection and then gently steam cooked in the can to keep the corn sweet, juicy and full of flavour. Their Original variety is simply delicious. Containing 100% natural ingredients, it’s made with fresh sweet corn and just a little water and salt, nothing else added. Delicious hot or cold. Green Giant sweetcorn provides you with 1 of your 5 a day. Green Giant sweetcorn is corn on the cob put in a tin in less than 8 hours. Green Giant sweetcorn is made out of 100% natural ingredients.');
INSERT INTO `product` (`id`, `categoryId`, `productName`, `productQty`, `productPrice`, `salePrice`, `productDesc`, `productImg`, `dateCreated`, `useridCreated`, `dateUpdated`, `useridUpdated`, `status`, `productMoreDesc`) VALUES
(69, 7, 'Canned Sardines', 50, 1.79, NULL, 'Flavorful canned sardines                                    ', 'Canned Sardines.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Located on Spain\'s north coast, Conservas Ortiz have processed fish by artisan methods since 1891. All their sardines are sustainably fished. Ortiz Sardines \"a la Antiqua\" are made to a 19th century recipe. Large plump sardines are fried in olive oil and hand packed. These sardines are some of the very finest. Omega-3s rarely taste so delicious. Sardines \"a la Antiqua\" take pride of place in main course salads and make special tapas. With sardines of this quality the flavour gets even better with time.'),
(70, 7, 'Canned Pasta', 50, 2.59, NULL, 'Ready-to-eat canned pasta                                    ', 'Canned Pasta.p', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Heinz Macaroni Cheese Pasta is made with a creamy cheese sauce. It is free from artificial colours or flavours and preservatives. It is low in fat and sugar. It is suitable for vegetarians.'),
(71, 8, 'Potato Chips', 50, 1.99, NULL, 'Classic and crunchy potato chips                                    ', 'Potato Chips.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Crispy on the outside and fluffy on the inside – our chunky straight cut Home Chips taste as delicious as chips should. Using the very best potatoes and our special crispy coating, they’re a taste sensation.'),
(72, 8, 'Pretzels', 50, 0.99, NULL, 'Salty and twisted pretzels                                    ', 'Pretzels.ret', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Penn State Original Salted Pretzels is perfectly baked delicious pretzel knots. It can be enjoyed as part of a balanced diet and healthy lifestyle. It is suitable for vegetarians. It contains gluten and wheat. It is approved by vegetarian society. It is baked in the oven and great combination, an all-time favourite.'),
(73, 8, 'Popcorn', 50, 1.59, NULL, 'Buttery and addictive popcorn                                    ', 'Popcorn.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Butterkist Popcorn Crunch Toffee. Whilst every effort to remove unpopped corn is taken, some hard kernels may remain which could damage your teeth.'),
(74, 8, 'Crackers', 50, 0.89, NULL, 'Variety of crispy crackers                                    ', 'Crackers.ra', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Jacob\'s Savours Salt and Cracked Black Pepper Bakes 200 g.'),
(75, 8, 'Nuts', 50, 2.99, NULL, 'Assorted nuts for snacking                                    ', 'Nuts.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'This share bag contains 15 x 250g Unsalted peanuts in a reclosable share bag. Peanuts make the perfect snack choice when enjoyed as part of a varied diet and healthy lifestyle, including regular exercise.\r\nPeanuts provide a source of protein in the diet and are high in fibre as well as containing essential vitamins and minerals.\r\nWe should eat a balanced diet including some fat and nearly 80% of the fat in peanuts are unsaturated fat.'),
(76, 8, 'Chocolate Bars', 50, 1.59, NULL, 'Indulgent chocolate bars                                    ', 'Chocolate Bars.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Feel the twirling ribbons of delicious Dairy Milk chocolate melt in your mouth with Cadbury favourite flaky, crumbly chocolate finger bar. This pack includes 5 single chocolate bars. Suitable for vegetarians.'),
(77, 8, 'Gummy Candies', 50, 1.99, NULL, 'Chewy and fruity gummy candies                                    ', 'Gummy Candies.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Sugar, glucose syrup, modified starch, 6% strawberry juice from concentrate, dextrose, 4% coconut water from concentrate, acids (malic acid, citric acid, lactic acid), potato protein, acidity regulators: sodium malates and calcium carbonate, natural flavouring, fruit and plant concentrates (sweet potato, apple, black carrot), hydrolysed pea protein.'),
(78, 8, 'Cookies', 50, 1.69, NULL, 'Delicious assorted cookies                                    ', 'Cookies.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Delicious cookies crammed with smooth and creamy Galaxy chocolate chunks!...'),
(79, 8, 'Granola Bars', 50, 1.89, NULL, 'Nutritious and filling granola bars                                    ', 'Granola Bars.bGranola Bars', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Crunchy cereal bars made with whole grain rolled oats and Canadian maple syrup. Ingredients: Whole grain rolled OATS (60%), sugar, sunflower oil, Canadian maple syrup (2%), honey, natural flavouring, salt, emulsifier (sunflower lecithin), raising agent (sodium bicarbonate), molasses. For allergens, see ingredients in bold.'),
(80, 8, 'Candy Bars', 50, 3.59, NULL, 'Classic and delightful candy bars                                    ', 'Candy Bars.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'It is a milk chocolate bar with fruit flavour jellies, sugar coated cocoa candies, and popping candy. It is a heavenly combination of Cadbury\'s Dairy Milk chocolate, sharp and crisp popping candy and the occasional jelly bean that lights your mouth on fire with flavour. This 160g bar is ideal for sharing with friends. It is made with a glass and a half of fresh milk in every half pound bar of chocolate. It is perfect for an afternoon treat.'),
(81, 9, 'Cola', 50, 1.99, NULL, 'Refreshing cola drink                                    ', 'Cola.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Sparkling low calorie soft drink with vegetable extracts with sweeteners. No calories or sugar. Only natural flavours. No added preservatives. This product is GMO free. This product is gluten free. This product is allergen free. This product is suitable for vegetarians/vegans. '),
(82, 9, 'Juice', 50, 1.89, NULL, 'Variety of fruit juices                                    ', 'Juice.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Morrisons 100% Fruit Juice has fruit pressed squeezed with 3 and a half of crisp apples, 3 clementines, half a pineapple, half a juicy mango and half a passion fruit. It has no added water and preservatives and contains naturally occurring sugars. It is totally smooth and is just a natural great tasting juice.'),
(83, 9, 'Coffee', 50, 4.59, NULL, 'Rich and aromatic coffee                                    ', 'Coffee.png', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Experience barista-style coffee moments at home. NESCAFÉ AZERA Americano is a carefully crafted blend of Arabica and Robusta beans that have been made into a premium instant coffee. Directions for Use: Add one heaped teaspoon (1.8 g) into your favourite mugPour in 200 ml of hot (but not boiling) waterEnjoy your barista-style coffee'),
(84, 9, 'Tea', 50, 1.69, NULL, 'Assorted tea flavors                                    ', 'Tea.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'We get to visit tea gardens all over the world to find the best teas for our English Breakfast. Full-bodied Assams picked during the summer months go perfectly with the fresh taste of high quality African teas.'),
(85, 9, 'Energy Drink', 50, 2.59, NULL, 'Boost of energy drink                                                                        ', 'Energy Drink.d', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Tear into a can of Monster Energy wherever your journey takes you The meanest energy drink on the planet. The Monster Energy blend combined with caffeine gives you the energy you need in a smooth easy drinking flavour Carbonated energy drink with taurine, L-carnitine, caffeine, ginseng and B vitamins. Athletes, gamers, musicians, students, road warriors, metal heads, geeks, hipsters, and bikers dig it - you will too. Monster is… A LIFE STYLE IN A CAN Unleash the Beast!'),
(86, 9, 'Sports Drink', 50, 0.79, NULL, 'Hydrating sports drink                                    ', 'Sports Drink.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Originally launched in 1927 by chemist William Hunter, ‘Glucozade’, as it was then known, was used to replace lost energy in bouts of sickness. '),
(87, 9, 'Ice Tea', 50, 0.89, NULL, 'Refreshing and sweet ice tea                                    ', 'Ice Tea.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Lipton Ice Tea is a simple yet perfect blend of real tea that brings you a delicious taste of sunshine whatever the weather. Enjoy a lovely sweet and fresh sensation from the very first sip to beyond the last drop. Lipton Ice Teas are low in calories, so you can indulge without feeling guilty'),
(88, 9, 'Smoothie', 50, 1.80, NULL, 'Healthy and fruity smoothie                                    ', 'Smoothie.png', '2023-06-04', 1, '2023-06-04', '1', 'A', '100 percent pure fruit and juices. We never add sugar, contains only naturally ocurring sugars.'),
(89, 9, 'Hot Chocolate', 50, 2.90, NULL, 'Rich and indulgent hot chocolate                                    ', 'Hot Chocolate.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', '\r\nCadbury instant hot chocolate drink is instant hot chocolate drink. It is a more convenient version of your favourite Cadbury hot chocolate. It is fairtrade certified.'),
(90, 9, 'Milkshake', 50, 2.90, NULL, 'Creamy and flavorful milkshake                                    ', 'Milkshake.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Semi Skimmed MILK (92%), Sugar, Cornflour, Dried Skimmed MILK, Banana Juice from Concentrate, Stabilisers (Cellulose, Carboxy Methyl Cellulose, Guar Gum), Flavouring, Dextrose, Colour (Carotenes)'),
(91, 10, 'Frozen Pizza', 50, 1.80, NULL, 'Delicious frozen pizza                                    ', 'Frozen Pizza.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Watch the Cheesy Stuffed Crust! Rise before your eyes!Get the ultimate takeaway taste hit with our Loaded Cheese Stuffed Crust!Melted mozzarella, Monterey Jack, mature Cheddar and Emmental cheeses on our unique cheesy sauce stuffed crust pizza base.'),
(92, 10, 'Ice Cream', 50, 2.90, NULL, 'Assorted ice cream flavors                                    ', 'Ice Cream.png', '2023-06-04', 1, '2023-06-04', '1', 'A', 'The Ben & Jerry\'s Oh My! Banoffee Pie! Sundae frozen dessert features banana ice cream with chocolatey caramel cups and cookie swirls topped with creamy whipped ice cream, caramel swirls, and chocolatey chunks. '),
(93, 10, 'Frozen Vegetables', 50, 1.89, NULL, 'Variety of frozen vegetables                                    ', 'Frozen Vegetables.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Where products are marked as organic, please note that Amazon EU is certified for retail and fulfillment of organic food, according to EU Organic Food regulations, issued by control body LU-BIO-04.'),
(94, 10, 'Frozen Fries', 50, 1.79, NULL, 'Crispy and delicious fries                                    ', 'Frozen Fries.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Crispy on the outside and fluffy on the inside – our chunky straight cut Home Chips taste as delicious as chips should. Using the very best potatoes and our special crispy coating, they’re a taste sensation.\r\n\r\n'),
(95, 10, 'Frozen Fish', 50, 3.79, NULL, 'Assorted frozen fish options                                    ', 'Frozen Fish.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Golden baked oaty bars with an apple flavoured filling. The perfect bake and snack. 128 kcal per bake. Source of Fibre. No artificial colours or flavours. Suitable for Vegetarians.They believe that snacking doesn\'t have to be dull or complicated. That\'s why they are committed here at Go Ahead to create delicious fruity snacks, to bring a little smile to your day.'),
(96, 10, 'Frozen Chicken Nuggets', 50, 2.70, NULL, 'Tasty and crispy chicken nuggets                                    ', 'Frozen Chicken Nuggets.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Why does it say made from 100% chicken breast if it\'s 51% chicken breast? Made from 100% chicken breast means the brand uses only chicken breast meat in their range. The other 49% relates to the other tasty ingredients such as the coating.'),
(97, 10, 'Frozen Burritos', 50, 2.60, NULL, 'Convenient and delicious burritos                                    ', 'Frozen Burritos.b', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Ready Baked Jackets that taste of an oven baked jacket but take a fraction of the time to cook.'),
(98, 10, 'Frozen Pies', 50, 1.79, NULL, 'Variety of frozen pies                                    ', 'Frozen Pies.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Calling all the nation\'s hot dessert lovers! Dig into Aunt Bessie\'s Apple Pie, an all-time British favourite. This pudding hits the spot.'),
(99, 10, 'Frozen Shrimp', 50, 3.29, NULL, 'Tasty and succulent shrimp                                    ', 'Frozen Shrimp.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Tasty and succulent shrimp. It is an exciting new range of fresh, high-quality food products at great prices. We offer everyday staples such as British milk, free range eggs, fresh produce and responsibly sourced British fresh meat. You will also find a wide range of delicious cheeses, cooked & continental meats, desserts, pizzas and ready meals. Our team of experts have sourced and developed all our to bring you quality and convenience you can rely on, every day. We want you to love our products but if you are not completely satisfied, please contact customer service via the website.'),
(100, 10, 'Frozen Desserts', 50, 2.89, NULL, 'Assorted frozen desserts                                    ', 'Frozen Desserts.png', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Treat yourself with our delicious Viennetta Vanilla ice cream dessert. This classic flavour is an indulgent combination of creamy vanilla flavour ice cream layered with crisp chocolate in between, and is the perfect addition to any dessert to share with family and friends.'),
(101, 11, 'Ketchup', 50, 2.50, NULL, 'Classic tomato ketchup                                                                        ', 'Ketchup.png', '2023-06-04', 1, '2023-06-04', '1', 'A', 'The classic Heinz Tomato Ketchup has been a staple at mealtimes since 1886. It’s the unmistakable taste of the sun-ripened tomatoes, along with the passion and knowledge that gives the recipe its unique flavour - the irresistible rich thick taste of Heinz you know and love. Grown not made, the tomato ketchup goes ideally with just about anything. With absolutely no artificial colours, flavours, preservatives or thickeners, no other ketchup tastes quite like it.'),
(102, 11, 'Mustard', 50, 1.50, NULL, 'Tangy and flavorful mustard                                    ', 'Mustard.ustrurd', '2023-06-04', 1, '2023-06-04', '1', 'A', 'No#1 American Mustard The Classic Yellow Mustard is the perfect condiments for adding to burgers, hot dogs and sandwiches. It\'s also a key ingredient in delicious recipes including potato salad, jalapeno popper dip & cheeseburger burritos. French\'s American mustard is a must have in every condiments selection. Free from artificial colours and preservatives Suitable for vegetarians and vegans.'),
(103, 11, 'Mayonnaise', 49, 2.49, NULL, 'Creamy and versatile mayonnaise                                    ', 'Mayonnaise.png', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Hellmann\'s to bring out the best of your sandwich, burger or salad. Mayo is made using quality ingredients like free range eggs and sustainably sourced oils. Real Mayonnaise is a good natural source of Omega 3 and suitable for vegetarians.'),
(104, 11, 'Soy Sauce', 50, 0.89, NULL, 'Traditional soy sauce                                                                        ', 'Soy Sauce.webp', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Whole soya beans blended with salt and wheat. Amoy soy sauce is brewed and blended for a smooth and clean flavour. Add when frying or grilling meat or vegetables to bring out the flavor or add a splash to enrich casseroles, soups or stews.'),
(105, 11, 'BBQ Sauce', 50, 1.20, NULL, 'Sweet and smoky BBQ sauce                                    ', 'BBQ Sauce.bq', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Heinz Classic Barbecue Sauce adds a tongue-tingling barbecue flavour to a variety of easy family meals. Thick enough for dipping whilst also being light enough to marinade, this rich and Smokey sauce will be loved by the whole family, especially when combined with chips, chicken or pizza. It is free from artificial colours or preservatives. It is suitable for vegetarians. It is available in a 480g squeezy top down bottle.'),
(106, 11, 'Hot Sauce', 50, 1.89, NULL, 'Spicy and flavorful hot sauce                                    ', 'Hot Sauce.ot', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Started the fire in 1985, now serving up full-bodied flavours with a kick of heat – introducing Bull’s-Eye’s new American hot sauces This one’s extra hot and balances the bold heat of the Carolina Reaper with the earthy flavours of black garlic. There’s hot. Then there’s the world’s hottest chilli, blended with garlic for that full-on heat you crave. Try adding this one to your beef burger straight off the BBQ to give it a delicious zing.'),
(107, 11, 'Vinegar', 50, 0.79, NULL, 'Versatile cooking vinegar                                    ', 'Vinegar.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Versatile cooking vinegar     '),
(108, 11, 'Salad Dressing', 50, 1.99, NULL, 'Assorted salad dressings                                    ', 'Salad Dressing.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Newman\'s Own Italian Dressing is a salad dressing with extra virgin olive oil, red wine vinegar and garlic. It has no added preservatives, artificial colours or flavours. It is suitable for vegetarians. Its shelf life is 12 months.'),
(109, 11, 'Salsa', 50, 1.29, NULL, 'Spicy and flavorful salsa                                    ', 'Salsa.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Complete your mexican feast with lashings of Mexican Thick & Chunky Mild Salsa, a blend of fresh juicy tomatoes, tasty onions and mild guajillo peppers that will add a kick of mexican flavour to anything from sizzling chicken fajitas to beef burritos to crunchy Nachips.'),
(110, 11, 'Honey', 50, 2.89, NULL, 'Natural and sweet honey                                    ', 'Honey.png', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Natural and sweet honey. For Best Before End, see neck of bottle. Store in a dry place.'),
(111, 12, 'Sponges', 50, 1.79, NULL, 'Versatile and durable cleaning sponges                                    ', 'Sponges.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Spontex Washups are versatile and strong, ideal for washing up and wiping surfaces. With exclusive anti-grease technology, the scourer does not retain grease and so stays cleaner and efficient for even longer! Designed with a specially contoured nail-guard for improved grip. Do not use on non stick pans or any delicate surfaces.'),
(112, 12, 'Paper Plates', 50, 2.59, NULL, 'Convenient and disposable paper plates                                                                        ', 'Paper Plates.webp', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Convenient and disposable paper plates'),
(113, 12, 'Trash Can', 49, 10.19, NULL, 'Sturdy and spacious trash can                                    ', 'Trash Can.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Sturdy and spacious trash can   '),
(114, 12, 'Dish Rack', 49, 8.99, NULL, 'Convenient and space-saving dish rack                                    ', 'Dish Rack.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'High Grade Extra Large Plastic Dish Drainer Plate and Cutlery Rack in Silver'),
(115, 12, 'Broom', 50, 4.29, NULL, 'Effective and durable cleaning broom                                    ', 'Broom.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Long Handle Dustpan and Brush – No more back aches! The 103cm long sweeping broom and the 89.5cm tall dustpan are a perfect house cleaning set to make your life easier. The ideal height of the dust pan and brush will ease the strain of bending while cleaning the floorings.'),
(116, 12, 'Mop', 50, 7.69, NULL, 'Versatile and efficient cleaning mop                                    ', 'Mop.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'NEWEST SPRAY MOP, SAVE TIME AND LABOR - Are you struggling to find a proper mop to clean the floor? Different from the traditional mops, MANGOTIME spray mop features with fine mist sprayer and a bottle, which sprays mist evenly and fast and stores adequate water/cleaning solution. You can spray mist and mop the floor at the same time without carrying a heavy and bulky bucket of water around and worrying the floor mop become dry. Try this wet mop and make the cleaning simple and efficient!'),
(117, 12, 'Toilet Brush', 50, 2.89, NULL, 'Effective and hygienic toilet brush                                    ', 'Toilet Brush.b1', '2023-06-04', 1, '2023-06-04', '1', 'A', 'The brush head is made of a special TPR material, which will not be frizzy and worn and is friendly to tiles.Compared with the ordinary traditional toilet brush, the contact area of the brush head is larger, the cleaning force is stronger, and it is easy to clean dead corners....Make your bathroom brighter and cleaner.'),
(118, 12, 'Dustpan and Brush Set', 50, 3.99, NULL, 'Convenient and efficient dustpan and brush set                                    ', 'Dustpan and Brush Set.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Dustpan and Brush Set - Ideal for use in and around the home for cleaning up spills'),
(119, 12, 'Hand Soap', 50, 1.99, NULL, 'Gentle and moisturizing hand soap                                    ', 'Hand Soap.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'An aromatic hand wash infused with a relaxing scent of Lavender, Ylang Ylang, Vanilla, Tangerine and Clary Sage. Black Pepper, Geranium and Cedarwood Oils gently remove impurities and dead skin cells, while keep skin balanced. Aloe hydrates, revitalizes and nourishes, leaving hands soft, smooth and moisturized.'),
(120, 12, 'Fabric Softener', 50, 3.89, NULL, 'Softens and freshens laundry                                    ', 'Fabric Softener.jpg', '2023-06-04', 1, '2023-06-04', '1', 'A', 'Comfort Pure Ultra-Concentrated Fabric Conditioner is the number one fabric conditioner for sensitive skin in the UK* and this XXL mega pack lasts for 160 washes in total'),
(121, 13, 'Salt', 10, 1.29, 0.00, 'Daily uses salt', 'Salt.webp', NULL, 1, NULL, '1', 'A', '                                                                                                                                                                <div><span style=\"color: rgb(15, 17, 17); font-family: \" amazon=\"\" ember\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">Saxa Table Salt Drum is fine flowing and ideal for both cooking and table use</span><br></div>                                                                                                                                                                                                                            ');

-- --------------------------------------------------------

--
-- Table structure for table `product_ratings`
--

CREATE TABLE `product_ratings` (
  `id` int(11) NOT NULL,
  `fkProductId` int(11) NOT NULL,
  `fkCustomerID` int(11) NOT NULL,
  `ratings` decimal(11,1) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_ratings`
--

INSERT INTO `product_ratings` (`id`, `fkProductId`, `fkCustomerID`, `ratings`, `review`, `status`) VALUES
(2, 68, 21, 3.5, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(3, 103, 14, 5.0, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(4, 25, 40, 5.0, 'The product is as described. I am happy with the overall performance.', 'A'),
(5, 2, 10, 2.0, 'This product didnot meet my expectations. I was hoping for better quality.', 'A'),
(6, 73, 32, 4.5, 'This product exceeded my expectations. It is top-notch quality and highly recommended.', 'A'),
(7, 17, 4, 1.2, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(8, 111, 22, 3.9, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(9, 19, 25, 2.7, 'The product is as described. I am happy with the overall performance.', 'A'),
(10, 53, 39, 1.4, 'This product didn\'t meet my expectations. I was hoping for better quality.', 'A'),
(11, 2, 38, 3.0, 'This product exceeded my expectations. It is top-notch quality and highly recommended.', 'A'),
(12, 9, 15, 3.2, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(13, 47, 22, 3.0, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(14, 32, 11, 3.2, 'The product is as described. I am happy with the overall performance.', 'A'),
(15, 70, 22, 3.6, 'This product did not meet my expectations. I was hoping for better quality.', 'A'),
(16, 98, 5, 2.6, 'This product exceeded my expectations. It is top-notch quality and highly recommended.', 'A'),
(17, 111, 21, 3.4, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(18, 82, 24, 3.5, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(19, 82, 18, 2.6, 'The product is as described. I am happy with the overall performance.', 'A'),
(20, 117, 31, 3.4, 'This product didn\'t meet my expectations. I was hoping for better quality.', 'A'),
(21, 1, 7, 3.6, 'This product exceeded my expectations. It is top-notch quality and highly recommended.', 'A'),
(22, 15, 20, 3.9, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(23, 50, 8, 3.5, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(24, 96, 42, 3.2, 'The product is as described. I am happy with the overall performance.', 'A'),
(25, 43, 19, 2.6, 'This product didn\'t meet my expectations. I was hoping for better quality.', 'A'),
(26, 5, 43, 3.8, 'This product exceeded my expectations. It is top-notch quality and highly recommended.', 'A'),
(27, 29, 28, 3.3, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(28, 95, 13, 2.6, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(29, 56, 5, 2.8, 'The product is as described. I am happy with the overall performance.', 'A'),
(30, 69, 14, 3.7, 'This product didn\'t meet my expectations. I was hoping for better quality.', 'A'),
(31, 22, 19, 3.4, 'This product exceeded my expectations. It is top-notch quality and highly recommended.', 'A'),
(32, 103, 17, 3.1, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(33, 99, 40, 2.6, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(34, 79, 2, 2.8, 'The product is as described. I am happy with the overall performance.', 'A'),
(35, 115, 6, 3.7, 'This product didn\'t meet my expectations. I was hoping for better quality.', 'A'),
(36, 65, 15, 2.6, 'This product exceeded my expectations. It is top-notch quality and highly recommended.', 'A'),
(37, 23, 37, 3.5, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(38, 87, 29, 2.6, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(39, 66, 18, 3.1, 'The product is as described. I am happy with the overall performance.', 'A'),
(40, 110, 13, 3.5, 'This product didn\'t meet my expectations. I was hoping for better quality.', 'A'),
(41, 73, 40, 3.7, 'This product exceeded my expectations. It is top-notch quality and highly recommended.', 'A'),
(42, 42, 12, 2.9, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(43, 75, 12, 3.2, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(44, 66, 15, 2.5, 'The product is as described. I am happy with the overall performance.', 'A'),
(45, 10, 15, 3.2, 'This product didn\'t meet my expectations. I was hoping for better quality.', 'A'),
(46, 24, 30, 3.7, 'This product exceeded my expectations. It is top-notch quality and highly recommended.', 'A'),
(47, 113, 14, 3.6, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(48, 86, 16, 3.6, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(49, 50, 42, 3.3, 'The product is as described. I am happy with the overall performance.', 'A'),
(50, 107, 34, 2.9, 'This product didn\'t meet my expectations. I was hoping for better quality.', 'A'),
(51, 2, 10, 2.7, 'This product exceeded my expectations. It is top-notch quality and highly recommended.', 'A'),
(52, 103, 42, 2.9, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(53, 41, 41, 3.6, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(54, 101, 43, 3.1, 'The product is as described. I am happy with the overall performance.', 'A'),
(55, 118, 32, 3.7, 'This product didn\'t meet my expectations. I was hoping for better quality.', 'A'),
(56, 93, 39, 2.8, 'This product exceeded my expectations. It is top-notch quality and highly recommended.', 'A'),
(57, 34, 35, 2.7, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(58, 36, 4, 3.2, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(59, 25, 24, 2.8, 'The product is as described. I am happy with the overall performance.', 'A'),
(60, 23, 18, 3.2, 'This product didn\'t meet my expectations. I was hoping for better quality.', 'A'),
(61, 28, 30, 3.5, 'This product exceeded my expectations. It is top-notch quality and highly recommended.', 'A'),
(62, 54, 7, 3.1, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(63, 62, 18, 3.2, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(64, 31, 34, 2.7, 'The product is as described. I am happy with the overall performance.', 'A'),
(65, 49, 25, 3.5, 'This product didn\'t meet my expectations. I was hoping for better quality.', 'A'),
(66, 61, 27, 3.3, 'This product exceeded my expectations. It is top-notch quality and highly recommended.', 'A'),
(67, 83, 41, 3.5, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(68, 60, 21, 3.9, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(69, 12, 33, 3.2, 'The product is as described. I am happy with the overall performance.', 'A'),
(70, 9, 42, 3.5, 'This product didn\'t meet my expectations. I was hoping for better quality.', 'A'),
(71, 40, 31, 3.3, 'This product exceeded my expectations. It is top-notch quality and highly recommended.', 'A'),
(72, 52, 27, 3.8, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(73, 41, 8, 3.8, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(74, 88, 5, 2.9, 'The product is as described. I am happy with the overall performance.', 'A'),
(75, 15, 33, 3.1, 'This product didn\'t meet my expectations. I was hoping for better quality.', 'A'),
(76, 79, 7, 3.7, 'This product exceeded my expectations. It is top-notch quality and highly recommended.', 'A'),
(77, 60, 4, 4.0, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(78, 70, 1, 2.9, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(79, 41, 38, 3.0, 'The product is as described. I am happy with the overall performance.', 'A'),
(80, 18, 29, 3.8, 'This product didn\'t meet my expectations. I was hoping for better quality.', 'A'),
(81, 39, 2, 2.8, 'This product exceeded my expectations. It is top-notch quality and highly recommended.', 'A'),
(82, 92, 13, 2.8, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(83, 22, 11, 3.5, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(84, 91, 30, 2.7, 'The product is as described. I am happy with the overall performance.', 'A'),
(85, 89, 9, 3.7, 'This product didn\'t meet my expectations. I was hoping for better quality.', 'A'),
(86, 36, 8, 3.9, 'This product exceeded my expectations. It is top-notch quality and highly recommended.', 'A'),
(87, 12, 32, 3.1, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(88, 98, 37, 3.7, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(89, 57, 41, 2.9, 'The product is as described. I am happy with the overall performance.', 'A'),
(90, 71, 5, 3.7, 'This product didn\'t meet my expectations. I was hoping for better quality.', 'A'),
(91, 75, 32, 3.7, 'This product exceeded my expectations. It is top-notch quality and highly recommended.', 'A'),
(92, 110, 4, 3.5, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(93, 25, 41, 2.6, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(94, 78, 42, 3.8, 'The product is as described. I am happy with the overall performance.', 'A'),
(95, 60, 37, 3.6, 'This product didn\'t meet my expectations. I was hoping for better quality.', 'A'),
(96, 9, 9, 3.7, 'This product exceeded my expectations. It is top-notch quality and highly recommended.', 'A'),
(97, 40, 14, 3.3, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(98, 88, 2, 2.6, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(99, 11, 14, 2.9, 'The product is as described. I am happy with the overall performance.', 'A'),
(100, 55, 20, 3.9, 'This product didn\'t meet my expectations. I was hoping for better quality.', 'A'),
(101, 21, 6, 2.7, 'This product exceeded my expectations. It is top-notch quality and highly recommended.', 'A'),
(102, 17, 17, 3.3, 'I am satisfied with my purchase. The product arrived on time and in excellent condition.', 'A'),
(103, 51, 24, 3.2, 'Great value for the price. I would buy this product again without hesitation.', 'A'),
(104, 87, 8, 3.6, 'The product is as described. I am happy with the overall performance.', 'A'),
(105, 8, 7, 3.4, 'This product didn\'t meet my expectations. I was hoping for better quality.', 'A'),
(106, 13, 43, 5.0, 'I am happy with the product quality and price', 'A'),
(107, 7, 43, 3.5, 'This is the best fruit ever I purchased', 'A'),
(108, 17, 43, 3.0, 'I am not satisfied with my purchase.', 'A'),
(109, 11, 43, 2.5, 'This is the medium product.', 'A'),
(110, 91, 43, 5.0, 'I am happy with the product quality and price', 'A'),
(111, 2, 43, 5.0, 'I am happy with the product quality and price', 'A'),
(112, 3, 43, 5.0, 'I am happy with the product quality and price', 'A'),
(113, 2, 45, 2.5, 'this is an average product', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `product_stock`
--

CREATE TABLE `product_stock` (
  `id` int(11) NOT NULL,
  `fkProductId` int(11) NOT NULL,
  `fkVendorId` int(11) NOT NULL,
  `qtyOnHand` int(11) DEFAULT NULL,
  `newQty` int(11) DEFAULT NULL,
  `totalQty` int(11) DEFAULT NULL,
  `dateOfPruch` date DEFAULT NULL,
  `status` char(3) DEFAULT 'I'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_stock`
--

INSERT INTO `product_stock` (`id`, `fkProductId`, `fkVendorId`, `qtyOnHand`, `newQty`, `totalQty`, `dateOfPruch`, `status`) VALUES
(1, 1, 2, 49, 0, 49, '2023-08-23', 'A'),
(2, 2, 2, 50, 0, 50, '2023-08-07', 'A'),
(3, 3, 3, 50, 0, 50, '2023-08-07', 'A'),
(4, 4, 4, 50, 0, 50, '2023-08-07', 'A'),
(5, 5, 1, 50, 10, 60, '2023-08-29', 'A'),
(6, 6, 2, 50, 0, 50, '2023-08-07', 'A'),
(7, 7, 3, 50, 0, 50, '2023-08-07', 'A'),
(8, 8, 4, 50, 0, 50, '2023-08-07', 'A'),
(9, 9, 1, 50, 0, 50, '2023-08-07', 'A'),
(10, 10, 2, 50, 0, 50, '2023-08-07', 'A'),
(11, 11, 3, 50, 0, 50, '2023-08-07', 'A'),
(12, 12, 4, 50, 0, 50, '2023-08-07', 'A'),
(13, 13, 1, 50, 0, 50, '2023-08-07', 'A'),
(14, 14, 2, 50, 0, 50, '2023-08-07', 'A'),
(15, 15, 3, 50, 0, 50, '2023-08-07', 'A'),
(16, 16, 4, 50, 0, 50, '2023-08-07', 'A'),
(17, 17, 1, 50, 0, 50, '2023-08-07', 'A'),
(18, 18, 2, 50, 0, 50, '2023-08-07', 'A'),
(19, 19, 3, 50, 0, 50, '2023-08-07', 'A'),
(20, 20, 4, 50, 0, 50, '2023-08-07', 'A'),
(21, 21, 1, 50, 0, 50, '2023-08-07', 'A'),
(22, 22, 2, 50, 0, 50, '2023-08-07', 'A'),
(23, 23, 3, 50, 0, 50, '2023-08-07', 'A'),
(24, 24, 4, 50, 0, 50, '2023-08-07', 'A'),
(25, 25, 1, 50, 0, 50, '2023-08-07', 'A'),
(26, 26, 2, 50, 0, 50, '2023-08-07', 'A'),
(27, 27, 3, 50, 0, 50, '2023-08-07', 'A'),
(28, 28, 4, 50, 0, 50, '2023-08-07', 'A'),
(29, 29, 1, 50, 0, 50, '2023-08-07', 'A'),
(30, 30, 2, 50, 0, 50, '2023-08-07', 'A'),
(31, 31, 3, 50, 0, 50, '2023-08-07', 'A'),
(32, 32, 4, 50, 0, 50, '2023-08-07', 'A'),
(33, 33, 1, 50, 0, 50, '2023-08-07', 'A'),
(34, 34, 2, 50, 0, 50, '2023-08-07', 'A'),
(35, 35, 3, 50, 0, 50, '2023-08-07', 'A'),
(36, 36, 4, 50, 0, 50, '2023-08-07', 'A'),
(37, 37, 1, 50, 0, 50, '2023-08-07', 'A'),
(38, 38, 2, 50, 0, 50, '2023-08-07', 'A'),
(39, 39, 3, 50, 0, 50, '2023-08-07', 'A'),
(40, 40, 4, 50, 0, 50, '2023-08-07', 'A'),
(41, 41, 1, 50, 0, 50, '2023-08-07', 'A'),
(42, 42, 2, 50, 0, 50, '2023-08-07', 'A'),
(43, 43, 3, 50, 0, 50, '2023-08-07', 'A'),
(44, 44, 4, 50, 0, 50, '2023-08-07', 'A'),
(45, 45, 1, 50, 0, 50, '2023-08-07', 'A'),
(46, 46, 2, 50, 0, 50, '2023-08-07', 'A'),
(47, 47, 3, 50, 0, 50, '2023-08-07', 'A'),
(48, 48, 4, 50, 0, 50, '2023-08-07', 'A'),
(49, 49, 1, 50, 0, 50, '2023-08-07', 'A'),
(50, 50, 2, 50, 0, 50, '2023-08-07', 'A'),
(51, 51, 1, 50, 0, 50, '2023-08-07', 'A'),
(52, 52, 2, 50, 0, 50, '2023-08-07', 'A'),
(53, 53, 3, 50, 0, 50, '2023-08-07', 'A'),
(54, 54, 4, 50, 0, 50, '2023-08-07', 'A'),
(55, 55, 1, 50, 0, 50, '2023-08-07', 'A'),
(56, 56, 2, 50, 0, 50, '2023-08-07', 'A'),
(57, 57, 3, 50, 0, 50, '2023-08-07', 'A'),
(58, 58, 4, 50, 0, 50, '2023-08-07', 'A'),
(59, 59, 1, 50, 0, 50, '2023-08-07', 'A'),
(60, 60, 2, 50, 0, 50, '2023-08-07', 'A'),
(61, 61, 3, 50, 0, 50, '2023-08-07', 'A'),
(62, 62, 4, 50, 0, 50, '2023-08-07', 'A'),
(63, 63, 1, 50, 0, 50, '2023-08-07', 'A'),
(64, 64, 2, 50, 0, 50, '2023-08-07', 'A'),
(65, 65, 3, 50, 0, 50, '2023-08-07', 'A'),
(66, 66, 4, 50, 0, 50, '2023-08-07', 'A'),
(67, 67, 1, 50, 0, 50, '2023-08-07', 'A'),
(68, 68, 2, 50, 0, 50, '2023-08-07', 'A'),
(69, 69, 3, 50, 0, 50, '2023-08-07', 'A'),
(70, 70, 4, 50, 0, 50, '2023-08-07', 'A'),
(71, 71, 1, 50, 0, 50, '2023-08-07', 'A'),
(72, 72, 2, 50, 0, 50, '2023-08-07', 'A'),
(73, 73, 3, 50, 0, 50, '2023-08-07', 'A'),
(74, 74, 4, 50, 0, 50, '2023-08-07', 'A'),
(75, 75, 1, 50, 0, 50, '2023-08-07', 'A'),
(76, 76, 2, 50, 0, 50, '2023-08-07', 'A'),
(77, 77, 3, 50, 0, 50, '2023-08-07', 'A'),
(78, 78, 4, 50, 0, 50, '2023-08-07', 'A'),
(79, 79, 1, 50, 0, 50, '2023-08-07', 'A'),
(80, 80, 2, 50, 0, 50, '2023-08-07', 'A'),
(81, 81, 3, 50, 0, 50, '2023-08-07', 'A'),
(82, 82, 4, 50, 0, 50, '2023-08-07', 'A'),
(83, 83, 1, 50, 0, 50, '2023-08-07', 'A'),
(84, 84, 2, 50, 0, 50, '2023-08-07', 'A'),
(85, 85, 3, 50, 0, 50, '2023-08-07', 'A'),
(86, 86, 4, 50, 0, 50, '2023-08-07', 'A'),
(87, 87, 1, 50, 0, 50, '2023-08-07', 'A'),
(88, 88, 2, 50, 0, 50, '2023-08-07', 'A'),
(89, 89, 3, 50, 0, 50, '2023-08-07', 'A'),
(90, 90, 4, 50, 0, 50, '2023-08-07', 'A'),
(91, 91, 1, 50, 0, 50, '2023-08-07', 'A'),
(92, 92, 2, 50, 0, 50, '2023-08-07', 'A'),
(93, 93, 3, 50, 0, 50, '2023-08-07', 'A'),
(94, 94, 4, 50, 0, 50, '2023-08-07', 'A'),
(95, 95, 1, 50, 0, 50, '2023-08-07', 'A'),
(96, 96, 2, 50, 0, 50, '2023-08-07', 'A'),
(97, 97, 3, 50, 0, 50, '2023-08-07', 'A'),
(98, 98, 4, 50, 0, 50, '2023-08-07', 'A'),
(99, 99, 1, 50, 0, 50, '2023-08-07', 'A'),
(100, 100, 2, 50, 0, 50, '2023-08-07', 'A'),
(101, 101, 2, 50, 0, 50, '2023-08-07', 'A'),
(102, 102, 2, 50, 0, 50, '2023-08-07', 'A'),
(103, 103, 2, 49, 0, 49, '2023-08-07', 'A'),
(104, 104, 2, 50, 0, 50, '2023-08-07', 'A'),
(105, 105, 2, 50, 0, 50, '2023-08-07', 'A'),
(106, 106, 2, 50, 0, 50, '2023-08-07', 'A'),
(107, 107, 2, 50, 0, 50, '2023-08-07', 'A'),
(108, 108, 2, 50, 0, 50, '2023-08-07', 'A'),
(109, 109, 2, 50, 0, 50, '2023-08-07', 'A'),
(110, 110, 2, 50, 0, 50, '2023-08-07', 'A'),
(111, 111, 2, 50, 0, 50, '2023-08-07', 'A'),
(112, 112, 2, 50, 0, 50, '2023-08-07', 'A'),
(113, 113, 2, 49, 0, 49, '2023-08-07', 'A'),
(114, 114, 2, 49, 0, 49, '2023-08-07', 'A'),
(115, 115, 2, 50, 0, 50, '2023-08-07', 'A'),
(116, 116, 2, 50, 0, 50, '2023-08-07', 'A'),
(117, 117, 2, 50, 0, 50, '2023-08-07', 'A'),
(118, 118, 2, 50, 0, 50, '2023-08-07', 'A'),
(119, 119, 2, 50, 0, 50, '2023-08-07', 'A'),
(120, 120, 2, 50, 0, 50, '2023-08-07', 'A'),
(121, 121, 3, 10, 0, 10, '2023-08-29', 'A');

--
-- Triggers `product_stock`
--
DELIMITER $$
CREATE TRIGGER `update_product_qty_after_insert` AFTER INSERT ON `product_stock` FOR EACH ROW BEGIN
    UPDATE product
    SET productQty = productQty + NEW.totalQty
    WHERE id = NEW.fkProductId;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `site_seo`
--

CREATE TABLE `site_seo` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_seo`
--

INSERT INTO `site_seo` (`id`, `title`, `keyword`, `description`) VALUES
(1, 'Groceries on Demand: Order Online, Save Time', 'Grocery store, Supermarket, Fresh produce, Organic food, Local groceries, Online grocery shopping, Grocery delivery, Specialty foods, Bulk foods, Gourmet ingredients, Health food store, International foods, Farm-to-table, Gluten-free products, Vegan optio', 'Shop for fresh groceries online at Easy Grocery. Enjoy convenient delivery, wide product selection, and exceptional quality for all your food needs                                                                                                            ');

-- --------------------------------------------------------

--
-- Table structure for table `stock_request`
--

CREATE TABLE `stock_request` (
  `id` int(11) NOT NULL,
  `fkProductId` int(11) NOT NULL,
  `requestDate` date DEFAULT NULL,
  `noOfItems` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_request`
--

INSERT INTO `stock_request` (`id`, `fkProductId`, `requestDate`, `noOfItems`) VALUES
(32, 5, '2023-08-29', 10);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `name` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fkRoleId` int(11) DEFAULT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `status` char(3) DEFAULT 'I'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `fkRoleId`, `lastLogin`, `status`) VALUES
(1, 'System Admin', 'sysadmin', '4acb4bc224acbbe3c2bfdcaa39a4324e', 1, NULL, 'A'),
(2, 'Riddhi', 'riddhi', '3060ba030d3b90371f4f14151fd4932d', 2, '2023-09-04 10:22:08', 'A'),
(3, 'Kiya', 'kiya', '639382e15be3829c0c236ca7fae45521', 3, '2023-09-04 09:55:14', 'A'),
(4, 'Joan', 'joan', 'f30c65212f01a5819a904d9a1631e44f', 4, '2023-09-04 09:56:10', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `user_preference`
--

CREATE TABLE `user_preference` (
  `id` int(11) NOT NULL,
  `fkCustId` int(11) NOT NULL,
  `fkProductId` int(11) NOT NULL,
  `productRating` decimal(10,0) NOT NULL,
  `isPurchase` tinyint(1) NOT NULL,
  `click_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_preference`
--

INSERT INTO `user_preference` (`id`, `fkCustId`, `fkProductId`, `productRating`, `isPurchase`, `click_timestamp`) VALUES
(77, 43, 2, 0, 0, '2023-08-07 09:58:08'),
(78, 43, 3, 0, 0, '2023-08-07 09:58:12'),
(79, 43, 9, 0, 0, '2023-08-07 10:01:14'),
(80, 43, 6, 0, 0, '2023-08-07 16:10:29'),
(82, 43, 8, 0, 0, '2023-08-08 08:55:02'),
(83, 43, 1, 0, 0, '2023-08-16 14:38:43'),
(84, 43, 113, 0, 0, '2023-08-16 14:51:05'),
(85, 43, 114, 0, 0, '2023-08-16 14:51:09'),
(86, 43, 103, 0, 0, '2023-08-16 14:51:15'),
(87, 43, 38, 0, 0, '2023-08-17 15:13:51'),
(88, 43, 5, 0, 0, '2023-08-17 15:21:43'),
(89, 43, 118, 0, 0, '2023-08-17 18:29:09'),
(90, 43, 54, 0, 0, '2023-08-17 18:38:28'),
(91, 43, 57, 0, 0, '2023-08-17 18:38:30'),
(92, 43, 21, 0, 0, '2023-08-17 18:46:13'),
(93, 43, 25, 0, 0, '2023-08-17 18:46:29'),
(94, 43, 40, 0, 0, '2023-08-18 14:38:58'),
(95, 43, 55, 0, 0, '2023-08-23 09:02:12'),
(96, 43, 59, 0, 0, '2023-08-23 09:02:13'),
(97, 43, 116, 0, 0, '2023-08-27 08:17:25'),
(98, 43, 4, 0, 0, '2023-08-27 08:20:37'),
(99, 43, 13, 0, 0, '2023-08-27 08:20:42'),
(100, 43, 111, 0, 0, '2023-08-27 09:03:55'),
(101, 43, 112, 0, 0, '2023-08-27 09:03:55'),
(102, 45, 1, 0, 0, '2023-08-29 08:29:34'),
(103, 45, 2, 0, 0, '2023-08-29 08:29:34'),
(105, 45, 5, 0, 0, '2023-08-29 08:29:51'),
(106, 45, 113, 0, 0, '2023-08-29 08:42:01'),
(107, 45, 3, 0, 0, '2023-08-29 09:07:34'),
(108, 45, 38, 0, 0, '2023-08-29 09:07:42');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` char(3) DEFAULT 'I'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `title`, `status`) VALUES
(1, 'System Administrator', 'A'),
(2, 'Admin', 'A'),
(3, 'Manager', 'A'),
(4, 'Customer Support', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `vendorName` varchar(255) DEFAULT NULL,
  `vendorAddress` varchar(255) DEFAULT NULL,
  `vendorPhone` varchar(255) DEFAULT NULL,
  `vendorEmail` varchar(255) DEFAULT NULL,
  `status` char(3) DEFAULT 'I'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `vendorName`, `vendorAddress`, `vendorPhone`, `vendorEmail`, `status`) VALUES
(1, 'Carissa Nigel', 'Huddersfield', '09878767654', 'carissa@gmail.com', 'A'),
(2, 'Nicholas Yu', 'Verem Bardez Goa', '08987878976', 'nicholas@gmail.com', 'A'),
(3, 'Douglass Coburn', 'London', '09865665434', 'douglass@gmail.com', 'A'),
(4, 'Karrie Akers', 'Punjab', '09852424251', 'karrie@gmail.com', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkCustomerId` (`fkCustomerId`);

--
-- Indexes for table `customer_cart`
--
ALTER TABLE `customer_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkCustomerId` (`fkCustomerId`),
  ADD KEY `fkProductId` (`fkProductId`);

--
-- Indexes for table `customer_feedback`
--
ALTER TABLE `customer_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_wishlist`
--
ALTER TABLE `customer_wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkCustomerId` (`fkCustomerId`),
  ADD KEY `fkProductId` (`fkProductId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkCustomerId` (`fkCustomerId`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkOrderId` (`fkOrderId`),
  ADD KEY `fkProductId` (`fkProductId`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkOrderId` (`fkOrderId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkProductId` (`fkProductId`),
  ADD KEY `fkCustomerID` (`fkCustomerID`) USING BTREE;

--
-- Indexes for table `product_stock`
--
ALTER TABLE `product_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkProductId` (`fkProductId`),
  ADD KEY `fkVendorId` (`fkVendorId`);

--
-- Indexes for table `site_seo`
--
ALTER TABLE `site_seo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_request`
--
ALTER TABLE `stock_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_ibfk_1` (`fkRoleId`);

--
-- Indexes for table `user_preference`
--
ALTER TABLE `user_preference`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_preference_ibfk_1` (`fkCustId`),
  ADD KEY `user_preference_ibfk_2` (`fkProductId`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `customer_cart`
--
ALTER TABLE `customer_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=340;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56091;

--
-- AUTO_INCREMENT for table `product_stock`
--
ALTER TABLE `product_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `stock_request`
--
ALTER TABLE `stock_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_preference`
--
ALTER TABLE `user_preference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`fkCustomerId`) REFERENCES `customer` (`id`);

--
-- Constraints for table `customer_cart`
--
ALTER TABLE `customer_cart`
  ADD CONSTRAINT `customer_cart_ibfk_1` FOREIGN KEY (`fkCustomerId`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `customer_cart_ibfk_2` FOREIGN KEY (`fkProductId`) REFERENCES `product` (`id`);

--
-- Constraints for table `customer_wishlist`
--
ALTER TABLE `customer_wishlist`
  ADD CONSTRAINT `customer_wishlist_ibfk_1` FOREIGN KEY (`fkCustomerId`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `customer_wishlist_ibfk_2` FOREIGN KEY (`fkProductId`) REFERENCES `product` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`fkCustomerId`) REFERENCES `customer` (`id`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`fkOrderId`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`fkProductId`) REFERENCES `product` (`id`);

--
-- Constraints for table `order_status`
--
ALTER TABLE `order_status`
  ADD CONSTRAINT `order_status_ibfk_1` FOREIGN KEY (`fkOrderId`) REFERENCES `orders` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`);

--
-- Constraints for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD CONSTRAINT `product_ratings_ibfk_1` FOREIGN KEY (`fkProductId`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `product_ratings_ibfk_2` FOREIGN KEY (`fkCustomerID`) REFERENCES `customer` (`id`);

--
-- Constraints for table `product_stock`
--
ALTER TABLE `product_stock`
  ADD CONSTRAINT `product_stock_ibfk_1` FOREIGN KEY (`fkProductId`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `product_stock_ibfk_2` FOREIGN KEY (`fkVendorId`) REFERENCES `vendor` (`id`);

--
-- Constraints for table `stock_request`
--
ALTER TABLE `stock_request`
  ADD CONSTRAINT `stock_request_ibfk_2` FOREIGN KEY (`fkProductId`) REFERENCES `product` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`fkRoleId`) REFERENCES `user_role` (`id`);

--
-- Constraints for table `user_preference`
--
ALTER TABLE `user_preference`
  ADD CONSTRAINT `user_preference_ibfk_1` FOREIGN KEY (`fkCustId`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `user_preference_ibfk_2` FOREIGN KEY (`fkProductId`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
