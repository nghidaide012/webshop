-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2022 at 09:25 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sushi_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(8) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Bowl'),
(2, 'Curry'),
(3, 'Roll'),
(4, 'Sashimi vs Tataki'),
(10, 'Sushi'),
(11, 'Sushi box');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(8) NOT NULL,
  `customer_id` int(8) UNSIGNED DEFAULT NULL,
  `order_date` date NOT NULL,
  `total` int(11) NOT NULL,
  `order_status` tinyint(1) DEFAULT 0,
  `is_cart` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `order_date`, `total`, `order_status`, `is_cart`) VALUES
(8, 14, '2022-12-28', 60, 1, 1),
(11, 14, '0000-00-00', 0, 0, 0),
(14, 11, '2022-12-28', 24, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(8) NOT NULL,
  `product_id` int(8) NOT NULL,
  `quantity` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `product_id`, `quantity`) VALUES
(8, 20, 2),
(8, 21, 2),
(8, 24, 1),
(11, 21, 2),
(14, 19, 1),
(14, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(8) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` text DEFAULT NULL,
  `price` int(8) UNSIGNED NOT NULL,
  `quantity` int(8) UNSIGNED NOT NULL,
  `category_id` int(8) DEFAULT NULL,
  `image` blob DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `quantity`, `category_id`, `image`, `active`) VALUES
(18, 'Anchovy sushi mozz', 'fish and rice', 12, 5, 10, 0x616e63686f76792d73757368692d6d6f7a7a2e706e67, 1),
(19, 'Baltic sushi mozz', 'baltic sushi ?', 12, 5, 10, 0x62616c7469632d73757368692d6d6f7a7a2e706e67, 1),
(20, 'Mango dill sweet sushi', 'why is this even exist', 12, 5, 10, 0x6d616e676f2d64696c6c2d73776565742d73757368692e706e67, 1),
(21, 'Mayo chicken sushi roast', 'mayo and chicken', 12, 5, 10, 0x6d61796f2d636869636b656e2d73757368692d726f6173742e706e67, 1),
(22, 'Prawn', 'Its shrimp', 12, 5, 10, 0x707261776e2e706e67, 1),
(23, 'Salmon sushi', 'salmon and rice', 12, 5, 10, 0x73616c6d6f6e2e706e67, 1),
(24, 'Salmon roe', 'Bunch of eggs', 12, 6, 10, 0x73616c6d6f6e2d726f652e706e67, 1),
(25, 'Salmon teriyaki', 'Salmon with teriyaki sauce', 12, 5, 10, 0x73616c6d6f6e2d7465726979616b692e706e67, 1),
(26, 'Salmon tsukudani', 'No idea', 12, 5, 10, 0x7361756d6f6e2d7473756b7564616e692e706e67, 1),
(27, 'Sushi roast sardine', 'Roast sushi', 12, 5, 10, 0x73757368692d726f6173742d73617264696e652e706e67, 1),
(28, 'Teriyaki tahini beef sushi', 'Beef ', 12, 5, 10, 0x7465726979616b692d746168696e692d626565662d73757368692d726f612e706e67, 1),
(30, 'Yellowtail miso yuzu', 'Fish with yellowtail?', 12, 5, 10, 0x79656c6c6f777461696c2d6d69736f2d79757a752e706e67, 1),
(31, 'Yellowtail sushi', 'fish', 12, 5, 10, 0x79656c6c6f777461696c2d73757368692e706e67, 1),
(32, 'Beef takaki', 'Beef', 12, 6, 4, 0x626565662d746174616b692e706e67, 1),
(33, 'Salmon sashimi', 'Only salmon', 12, 6, 4, 0x73616c6d6f6e2e706e67, 1),
(34, 'Salmon takaki', 'Salmon', 12, 6, 4, 0x73616c6d6f6e2d746174616b692e706e67, 1),
(35, 'Tuna sashimi', 'Only tuna', 15, 6, 4, 0x74756e612e706e67, 1),
(36, 'Tuna and salmon', 'like the name', 12, 6, 4, 0x74756e612d616e642d73616c6d6f6e2d636f6d626f2e706e67, 1),
(37, 'Tuna tataki', 'Tuna', 12, 6, 4, 0x74756e612d746174616b692e706e67, 1),
(38, 'Yellow tail', 'From yellow fish', 12, 4, 4, 0x79656c6c6f772d7461696c2e706e67, 1),
(39, 'Avocado and cheese', 'like the name', 15, 10, 3, 0x61766f6361646f2d616e642d6368656573652e706e67, 1),
(40, 'Avocado wasabi maki roll', 'Avocado with wasabi', 10, 6, 3, 0x61766f6361646f2d7761736162692d6d616b692d726f6c6c2e706e67, 1),
(41, 'Beijing roll', 'No idea whats in it', 15, 12, 3, 0x6265696a696e672d726f6c2e706e67, 1),
(42, 'California yellowtail ponzu', 'have yellowtail', 12, 6, 3, 0x63616c69666f726e69612d79656c6c6f777461696c2d706f6e7a752e706e67, 1),
(43, 'California yellow veggie', 'dont have meat', 6, 6, 3, 0x63616c69666f726e69612d79656c6c6f772d7665676769652e706e67, 1),
(44, 'Carrot orange yellowtail roll', 'This roll have carrot', 12, 10, 3, 0x636172726f742d6f72616e67652d79656c6c6f777461696c2d726f6c6c2e706e67, 1),
(45, 'Cheese salmon maki', 'have cheese', 15, 8, 3, 0x6368656573652d73616c6d6f6e2d6d616b692e706e67, 1),
(46, 'Chicken dragon rool', 'Dont actually have dragon', 15, 10, 3, 0x636869636b656e2d647261676f6e2d726f6c6c2e706e67, 1),
(47, 'Chicken katsu', 'fried chicken', 12, 10, 3, 0x636869636b656e2d6b617473752e706e67, 1),
(48, 'Chicken katsu curry', 'curry fried chicken', 16, 1, 2, 0x636869636b656e2d6b617473752d63757272792e706e67, 1),
(49, 'Curry crevettes tempura', 'curry fried pork', 16, 1, 2, 0x63757272792d6372657665747465732d74656d707572612e706e67, 1),
(50, 'Detox salmon pokebowl', 'A whole bowl of salmon', 16, 1, 1, 0x6465746f782d73616c6d6f6e2d706f6b65626f776c2e706e67, 1),
(51, 'Marinated chirashi', 'Some random thing in this bowl', 16, 1, 1, 0x6d6172696e617465642d63686972617368692e706e67, 1),
(52, 'Poke bowl beef', 'bowl of beef', 16, 1, 1, 0x706f6b652d626f776c2d626f6575662e706e67, 1),
(53, 'Poke bowl chicken teriyaki', 'bowl of chicken', 16, 1, 1, 0x706f6b652d626f776c2d706f756c65742d7465726979616b692e706e67, 1),
(54, 'Salmon chirashi', 'Look like a lot of salmon', 16, 1, 1, 0x73616c6d6f6e2d63686972617368692e706e67, 1),
(56, 'Yellowtail ceviche with mango', 'Weird combination', 16, 1, 1, 0x79656c6c6f777461696c2d636576696368652d776974682d6d616e676f2e706e67, 1),
(57, 'Amateur mix', 'Basically a scam', 20, 1, 11, 0x616d61746575722d6d69782e706e67, 1),
(58, 'Black box classic', 'A box with a lot of sushi', 30, 1, 11, 0x626c61636b2d626f782d636c61737369632e706e67, 1),
(59, 'California dream', 'Not my dream', 25, 1, 11, 0x63616c69666f726e69612d647265616d2e706e67, 1),
(60, 'Happy sushi box', 'Look kinda happy', 30, 1, 11, 0x68617070792d73757368692d626f782e706e67, 1),
(61, 'Nom nom nom', 'nom nom nom', 40, 1, 11, 0x6e6f6d2e706e67, 1),
(62, 'Poke thon spicy', 'Kinda spicy', 16, 1, 1, 0x706f6b652d74686f6e2d73706963792e706e67, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(8) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permission` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `phone`, `email`, `password`, `permission`) VALUES
(11, 'chi bich', 'some where', '0918065254', 'bich@gmail.com', '$2y$10$V1C1zlTr8gd7bLTCYB2X0eyr5vrL/aO.OMjljJocRA528r4cQalPq', 1),
(14, '', '', '', 'nghi@gmail.com', '$2y$10$PWwObBRZUdoOmclAFCgrle14ur7ZFdJUN5x6JUi5ni9eoc7CC9G6e', 0),
(16, '', '', '', 'admin@gmail.com', '$2y$10$kvYkVjRR0HTfbPNBVVB.huxwwr.vyKivBpSQsVXiMP1Lr9woi5zpi', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_4` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
