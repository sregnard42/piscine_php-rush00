-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 31, 2019 at 08:39 AM
-- Server version: 5.6.43
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `miniboutique`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id_user` int(11) NOT NULL COMMENT 'User ID',
  `address_1` varchar(120) NOT NULL COMMENT 'Primary Address',
  `adress_2` varchar(120) DEFAULT NULL COMMENT 'Secondary Address',
  `adress_3` varchar(120) DEFAULT NULL COMMENT 'Tertiary Address',
  `city` varchar(100) NOT NULL COMMENT 'City',
  `country` varchar(100) NOT NULL COMMENT 'Country',
  `postal_code` varchar(20) NOT NULL COMMENT 'Postal Code'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Store address(es) of users';

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL COMMENT 'Category ID',
  `name` tinytext NOT NULL COMMENT 'Category Name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Special Offer'),
(2, 'Green');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL COMMENT 'Order ID',
  `id_user` int(11) NOT NULL COMMENT 'User ID',
  `id_product` int(11) NOT NULL COMMENT 'Product ID',
  `quantity` int(11) NOT NULL COMMENT 'Quantity of product',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date of Order '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `id_product`, `quantity`, `date`) VALUES
(1, 1, 2, 1, '2019-03-31 15:38:39');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL COMMENT 'id product',
  `name` tinytext NOT NULL COMMENT 'product name',
  `description` mediumtext NOT NULL COMMENT 'product description',
  `price` int(11) NOT NULL COMMENT 'product price',
  `stock` int(11) NOT NULL COMMENT 'nimber of product in stock',
  `img` mediumtext NOT NULL COMMENT 'path to img',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `img`, `date`) VALUES
(1, 'Broccoli', 'Broccoli, our best-seller.', 3, 100, 'logo.png', '2019-03-24 08:46:33'),
(2, 'Pumping-Kal', 'Pumping-Kal, really green. And fresh.', 4, 100, 'kal.png', '2019-03-24 08:52:22'),
(3, 'Red Cabbage', 'Red Cabbage, also known as purple cabbage.', 8, 48, 'red.png', '2019-03-24 08:54:24'),
(4, 'Chinese Cabbage', 'Chinese Cabbage, often used in Chinese cuisine.', 1, 420, 'chinese.png', '2019-03-24 08:56:10'),
(5, 'Cauliflower', 'Cauliflower heads resemble those in broccoli, which differs in having flower buds as the edible portion.', 5, 23, 'cauliflower.png', '2019-03-24 08:58:33'),
(6, 'White Cabbage', 'Cabbage is a good source of vitamin K, vitamin C and dietary fiber.', 3, 74, 'white.png', '2019-03-24 08:59:49'),
(7, 'Romanesco Broccoli', 'Romanesco Broccoli, the best fractal in brocostore.', 42, 4200, 'romanesco.png', '2019-03-24 09:01:33'),
(9, 'Bruxelles Cabbage', 'Bruxelles Cabbage, the worst of our store ! For the bold ! (Please buy it)', 0, 0, 'bruxelle.png', '2019-03-24 09:04:31');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id_product` int(11) NOT NULL COMMENT 'Product ID',
  `id_category` int(11) NOT NULL COMMENT 'Category ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id_product`, `id_category`) VALUES
(9, 1),
(1, 2),
(2, 2),
(4, 2),
(7, 2),
(9, 2),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'superuser', '$2y$10$LLgTvF/vjGHLHluSHKFekeQHyA8bd9RGUkOroimawDx2HoUSmmueG', '2019-03-30 13:41:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD KEY `id` (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_order` (`id_order`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Category ID', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id product', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `ID Admin` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_category_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
