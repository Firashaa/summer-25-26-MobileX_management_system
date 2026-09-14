-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2026 at 11:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` enum('open','resolved') DEFAULT 'open',
  `reply` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `customer_id`, `message`, `status`, `reply`, `created_at`) VALUES
(1, 21, 'Charger not working - case 1. Order related issue, need support.', 'resolved', 'We have resolved your complaint #1. Please visit service center or contact support. Thank you for choosing MobiTrack.', '2026-09-12 07:39:27'),
(2, 18, 'Phone heating issue - case 2. Order related issue, need support.', 'resolved', 'We have resolved your complaint #2. Please visit service center or contact support. Thank you for choosing MobiTrack.', '2026-09-12 07:39:27'),
(3, 18, 'Late delivery complaint - case 3. Order related issue, need support.', 'open', NULL, '2026-09-12 07:39:27'),
(4, 24, 'Battery draining fast - case 4. Order related issue, need support.', 'resolved', 'We have resolved your complaint #4. Please visit service center or contact support. Thank you for choosing MobiTrack.', '2026-09-12 07:39:27'),
(5, 18, 'Charger not working - case 5. Order related issue, need support.', 'resolved', 'We have resolved your complaint #5. Please visit service center or contact support. Thank you for choosing MobiTrack.', '2026-09-12 07:39:27'),
(6, 6, 'Screen flickering after update - case 6. Order related issue, need support.', 'resolved', 'We have resolved your complaint #6. Please visit service center or contact support. Thank you for choosing MobiTrack.', '2026-09-12 07:39:27'),
(7, 21, 'Late delivery complaint - case 7. Order related issue, need support.', 'open', NULL, '2026-09-12 07:39:27'),
(8, 15, 'Payment not reflected - case 8. Order related issue, need support.', 'open', NULL, '2026-09-12 07:39:27'),
(9, 6, 'Battery draining fast - case 9. Order related issue, need support.', 'resolved', 'We have resolved your complaint #9. Please visit service center or contact support. Thank you for choosing MobiTrack.', '2026-09-12 07:39:27'),
(10, 30, 'Camera blurry - case 10. Order related issue, need support.', 'resolved', 'We have resolved your complaint #10. Please visit service center or contact support. Thank you for choosing MobiTrack.', '2026-09-12 07:39:27'),
(11, 24, 'Wrong product received - case 11. Order related issue, need support.', 'resolved', 'We have resolved your complaint #11. Please visit service center or contact support. Thank you for choosing MobiTrack.', '2026-09-12 07:39:27'),
(12, 6, 'Battery draining fast - case 12. Order related issue, need support.', 'resolved', 'We have resolved your complaint #12. Please visit service center or contact support. Thank you for choosing MobiTrack.', '2026-09-12 07:39:27'),
(13, 3, 'Network dropping frequently - case 13. Order related issue, need support.', 'open', NULL, '2026-09-12 07:39:27'),
(14, 9, 'Camera blurry - case 14. Order related issue, need support.', 'open', NULL, '2026-09-12 07:39:27'),
(15, 24, 'Charger not working - case 15. Order related issue, need support.', 'open', NULL, '2026-09-12 07:39:27'),
(16, 30, 'Network dropping frequently - case 16. Order related issue, need support.', 'open', NULL, '2026-09-12 07:39:27'),
(17, 27, 'Charger not working - case 17. Order related issue, need support.', 'open', NULL, '2026-09-12 07:39:27'),
(18, 18, 'Camera blurry - case 18. Order related issue, need support.', 'open', NULL, '2026-09-12 07:39:27'),
(19, 6, 'Screen flickering after update - case 19. Order related issue, need support.', 'open', NULL, '2026-09-12 07:39:27'),
(20, 9, 'Screen flickering after update - case 20. Order related issue, need support.', 'open', NULL, '2026-09-12 07:39:27'),
(21, 9, 'Network dropping frequently - case 21. Order related issue, need support.', 'resolved', 'We have resolved your complaint #21. Please visit service center or contact support. Thank you for choosing MobiTrack.', '2026-09-12 07:39:27'),
(22, 12, 'Speaker low volume - case 22. Order related issue, need support.', 'open', NULL, '2026-09-12 07:39:27'),
(23, 21, 'Speaker low volume - case 23. Order related issue, need support.', 'open', NULL, '2026-09-12 07:39:27'),
(24, 6, 'Network dropping frequently - case 24. Order related issue, need support.', 'open', NULL, '2026-09-12 07:39:27'),
(25, 9, 'Phone heating issue - case 25. Order related issue, need support.', 'open', NULL, '2026-09-12 07:39:27'),
(26, 24, 'Wrong product received - case 26. Order related issue, need support.', 'resolved', 'We have resolved your complaint #26. Please visit service center or contact support. Thank you for choosing MobiTrack.', '2026-09-12 07:39:27'),
(27, 6, 'Phone heating issue - case 27. Order related issue, need support.', 'open', NULL, '2026-09-12 07:39:27'),
(28, 33, 'Speaker low volume - case 28. Order related issue, need support.', 'open', NULL, '2026-09-12 07:39:27'),
(29, 30, 'Late delivery complaint - case 29. Order related issue, need support.', 'resolved', 'OK', '2026-09-12 07:39:27'),
(30, 27, 'Screen flickering after update - case 30. Order related issue, need support.', 'resolved', 'We have resolved your complaint #30. Please visit service center or contact support. Thank you for choosing MobiTrack.', '2026-09-12 07:39:27');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `target_role` enum('seller','vendor','all') DEFAULT 'all',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `admin_id`, `message`, `target_role`, `created_at`) VALUES
(1, 1, 'System maintenance on Sunday 10PM-2AM. Please save your work. (Notice #1)', 'vendor', '2026-09-12 07:39:27'),
(2, 1, 'MobiTrack festival sale starts next week - prepare inventory! (Notice #2)', 'seller', '2026-09-12 07:39:27'),
(3, 1, 'System maintenance on Sunday 10PM-2AM. Please save your work. (Notice #3)', 'vendor', '2026-09-12 07:39:27'),
(4, 1, 'Vendor pricing audit scheduled - ensure all prices updated. (Notice #4)', 'all', '2026-09-12 07:39:27'),
(5, 1, 'All vendors must update return policy by month end. (Notice #5)', 'seller', '2026-09-12 07:39:27'),
(6, 1, 'Security update: Please change passwords every 90 days. (Notice #6)', 'all', '2026-09-12 07:39:27'),
(7, 1, 'All vendors must update return policy by month end. (Notice #7)', 'vendor', '2026-09-12 07:39:27'),
(8, 1, 'Seller rating update: Top 10 sellers will get bonus this quarter. (Notice #8)', 'seller', '2026-09-12 07:39:27'),
(9, 1, 'Customer review campaign: Encourage buyers to leave reviews. (Notice #9)', 'seller', '2026-09-12 07:39:27'),
(10, 1, 'Security update: Please change passwords every 90 days. (Notice #10)', 'vendor', '2026-09-12 07:39:27'),
(11, 1, 'MobiTrack festival sale starts next week - prepare inventory! (Notice #11)', 'seller', '2026-09-12 07:39:27'),
(12, 1, 'Welcome to MobiTrack - A Reliable Management System. Updated policies available. (Notice #12)', 'all', '2026-09-12 07:39:27'),
(13, 1, 'Reminder: Monthly sales report submission deadline is 5th. (Notice #13)', 'seller', '2026-09-12 07:39:27'),
(14, 1, 'Vendor pricing audit scheduled - ensure all prices updated. (Notice #14)', 'vendor', '2026-09-12 07:39:27'),
(15, 1, 'All vendors must update return policy by month end. (Notice #15)', 'seller', '2026-09-12 07:39:27'),
(16, 1, 'MobiTrack festival sale starts next week - prepare inventory! (Notice #16)', 'vendor', '2026-09-12 07:39:27'),
(17, 1, 'Security update: Please change passwords every 90 days. (Notice #17)', 'seller', '2026-09-12 07:39:27'),
(18, 1, 'Reminder: Monthly sales report submission deadline is 5th. (Notice #18)', 'seller', '2026-09-12 07:39:27'),
(19, 1, 'Reminder: Monthly sales report submission deadline is 5th. (Notice #19)', 'vendor', '2026-09-12 07:39:27'),
(20, 1, 'Seller rating update: Top 10 sellers will get bonus this quarter. (Notice #20)', 'vendor', '2026-09-12 07:39:27'),
(21, 1, 'Customer review campaign: Encourage buyers to leave reviews. (Notice #21)', 'all', '2026-09-12 07:39:27'),
(22, 1, 'All vendors must update return policy by month end. (Notice #22)', 'vendor', '2026-09-12 07:39:27'),
(23, 1, 'Customer review campaign: Encourage buyers to leave reviews. (Notice #23)', 'all', '2026-09-12 07:39:27'),
(24, 1, 'Welcome to MobiTrack - A Reliable Management System. Updated policies available. (Notice #24)', 'seller', '2026-09-12 07:39:27'),
(25, 1, 'System maintenance on Sunday 10PM-2AM. Please save your work. (Notice #25)', 'all', '2026-09-12 07:39:27'),
(26, 1, 'Reminder: Monthly sales report submission deadline is 5th. (Notice #26)', 'seller', '2026-09-12 07:39:27'),
(27, 1, 'Seller rating update: Top 10 sellers will get bonus this quarter. (Notice #27)', 'vendor', '2026-09-12 07:39:27'),
(28, 1, 'Welcome to MobiTrack - A Reliable Management System. Updated policies available. (Notice #28)', 'vendor', '2026-09-12 07:39:27'),
(29, 1, 'Welcome to MobiTrack - A Reliable Management System. Updated policies available. (Notice #29)', 'all', '2026-09-12 07:39:27'),
(30, 1, 'Customer review campaign: Encourage buyers to leave reviews. (Notice #30)', 'vendor', '2026-09-12 07:39:27'),
(31, 1, 'Mobile Noshto', 'seller', '2026-09-14 05:31:37');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `delivery_status` enum('pending','shipped','delivered','cancelled') DEFAULT 'pending',
  `assigned_vendor_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `total_amount`, `delivery_status`, `assigned_vendor_id`, `created_at`) VALUES
(1, 33, 326976.00, 'shipped', NULL, '2026-09-12 07:39:27'),
(2, 9, 115751.00, 'shipped', NULL, '2026-09-12 07:39:27'),
(3, 6, 153970.00, 'cancelled', NULL, '2026-09-12 07:39:27'),
(4, 21, 58436.00, 'shipped', NULL, '2026-09-12 07:39:27'),
(5, 18, 161993.00, 'shipped', 25, '2026-09-12 07:39:27'),
(6, 27, 176076.00, 'cancelled', 31, '2026-09-12 07:39:27'),
(7, 15, 126403.00, 'cancelled', 19, '2026-09-12 07:39:27'),
(8, 15, 149888.00, 'delivered', 25, '2026-09-12 07:39:27'),
(9, 12, 30458.00, 'cancelled', NULL, '2026-09-12 07:39:27'),
(10, 6, 35562.00, 'pending', NULL, '2026-09-12 07:39:27'),
(11, 9, 354915.00, 'shipped', 34, '2026-09-12 07:39:27'),
(12, 30, 226479.00, 'shipped', 7, '2026-09-12 07:39:27'),
(13, 3, 87554.00, 'delivered', NULL, '2026-09-12 07:39:27'),
(14, 27, 143818.00, 'delivered', NULL, '2026-09-12 07:39:27'),
(15, 27, 65786.00, 'shipped', NULL, '2026-09-12 07:39:27'),
(16, 9, 71038.00, 'delivered', 10, '2026-09-12 07:39:27'),
(17, 3, 233625.00, 'delivered', NULL, '2026-09-12 07:39:27'),
(18, 33, 95313.00, 'pending', 16, '2026-09-12 07:39:27'),
(19, 3, 31771.00, 'pending', NULL, '2026-09-12 07:39:27'),
(20, 9, 37101.00, 'cancelled', NULL, '2026-09-12 07:39:27'),
(21, 9, 21530.00, 'cancelled', NULL, '2026-09-12 07:39:27'),
(22, 3, 70294.00, 'cancelled', NULL, '2026-09-12 07:39:27'),
(23, 18, 96027.00, 'shipped', NULL, '2026-09-12 07:39:27'),
(24, 9, 106557.00, 'cancelled', NULL, '2026-09-12 07:39:27'),
(25, 24, 55628.00, 'pending', NULL, '2026-09-12 07:39:27'),
(26, 27, 153543.00, 'cancelled', 16, '2026-09-12 07:39:27'),
(27, 6, 116394.00, 'shipped', 25, '2026-09-12 07:39:27'),
(28, 24, 313201.00, 'pending', 28, '2026-09-12 07:39:27'),
(29, 9, 92768.00, 'pending', NULL, '2026-09-12 07:39:27'),
(30, 33, 102066.00, 'delivered', 40, '2026-09-12 07:39:27'),
(31, 42, 23948.00, 'pending', NULL, '2026-09-14 08:47:33');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `seller_id`, `qty`, `price`) VALUES
(1, 17, 17, 29, 2, 35562.00),
(2, 23, 12, 20, 3, 32009.00),
(3, 28, 4, 17, 1, 25572.00),
(4, 2, 21, 23, 2, 35987.00),
(5, 29, 26, 26, 1, 38798.00),
(6, 14, 21, 23, 2, 35987.00),
(7, 9, 5, 35, 1, 30458.00),
(8, 11, 9, 8, 3, 30021.00),
(9, 12, 2, 29, 3, 29218.00),
(10, 16, 16, 14, 2, 35519.00),
(11, 7, 8, 5, 3, 26985.00),
(12, 14, 1, 32, 3, 23948.00),
(13, 26, 9, 8, 2, 30021.00),
(14, 6, 30, 17, 1, 43777.00),
(15, 3, 24, 35, 2, 37149.00),
(16, 17, 23, 14, 3, 38907.00),
(17, 28, 11, 5, 1, 29071.00),
(18, 18, 10, 35, 3, 31771.00),
(19, 28, 32, 32, 3, 45780.00),
(20, 26, 7, 11, 3, 31167.00),
(21, 13, 30, 17, 2, 43777.00),
(22, 27, 26, 26, 3, 38798.00),
(23, 1, 17, 29, 2, 35562.00),
(24, 11, 8, 5, 2, 26985.00),
(25, 4, 2, 29, 2, 29218.00),
(26, 22, 5, 35, 1, 30458.00),
(27, 2, 30, 17, 1, 43777.00),
(28, 15, 14, 2, 2, 32893.00),
(29, 24, 16, 14, 3, 35519.00),
(30, 20, 19, 14, 1, 37101.00),
(31, 8, 30, 17, 2, 43777.00),
(32, 12, 35, 2, 3, 46275.00),
(33, 19, 10, 35, 1, 31771.00),
(34, 3, 29, 2, 2, 39836.00),
(35, 30, 13, 8, 3, 34022.00),
(36, 5, 27, 20, 3, 40719.00),
(37, 10, 17, 29, 1, 35562.00),
(38, 6, 26, 26, 1, 38798.00),
(39, 1, 29, 2, 3, 39836.00),
(40, 28, 31, 35, 3, 40406.00),
(41, 5, 29, 2, 1, 39836.00),
(42, 7, 34, 23, 1, 45448.00),
(43, 22, 29, 2, 1, 39836.00),
(44, 29, 8, 5, 2, 26985.00),
(45, 11, 29, 2, 3, 39836.00),
(46, 8, 7, 11, 2, 31167.00),
(47, 1, 34, 23, 3, 45448.00),
(48, 6, 7, 11, 3, 31167.00),
(49, 17, 32, 32, 1, 45780.00),
(50, 11, 5, 35, 3, 30458.00),
(51, 31, 1, 32, 1, 23948.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `cost_price` decimal(10,2) NOT NULL,
  `profit_margin` decimal(5,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stock_qty` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `seller_id`, `name`, `selling_price`, `cost_price`, `profit_margin`, `image`, `stock_qty`, `description`, `created_at`) VALUES
(1, 32, 'Realme Narzo 1', 23948.00, 18986.00, 20.72, NULL, 52, 'Brand new Realme Narzo 1 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 1, imported via MobiTrack. Stock available at seller #32. Ideal for retail.', '2026-09-12 07:39:27'),
(2, 29, 'Redmi Power 2', 29218.00, 21793.00, 25.41, NULL, 11, 'Brand new Redmi Power 2 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 2, imported via MobiTrack. Stock available at seller #29. Ideal for retail.', '2026-09-12 07:39:27'),
(3, 11, 'Vivo V 3', 28038.00, 21019.00, 25.03, 'uploads/product_3.jpg', 74, 'Brand new Vivo V 3 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 3, imported via MobiTrack. Stock available at seller #11. Ideal for retail.', '2026-09-12 07:39:27'),
(4, 17, 'MobiTrack Pro 4', 25572.00, 21849.00, 14.56, NULL, 55, 'Brand new MobiTrack Pro 4 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 4, imported via MobiTrack. Stock available at seller #17. Ideal for retail.', '2026-09-12 07:39:27'),
(5, 35, 'Pixel Force 5', 30458.00, 23267.00, 23.61, NULL, 69, 'Brand new Pixel Force 5 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 5, imported via MobiTrack. Stock available at seller #35. Ideal for retail.', '2026-09-12 07:39:27'),
(6, 32, 'MobiTrack Pro 6', 29630.00, 23398.00, 21.03, NULL, 61, 'Brand new MobiTrack Pro 6 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 6, imported via MobiTrack. Stock available at seller #32. Ideal for retail.', '2026-09-12 07:39:27'),
(7, 11, 'Realme Narzo 7', 31167.00, 24843.00, 20.29, 'uploads/product_7.jpg', 65, 'Brand new Realme Narzo 7 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 7, imported via MobiTrack. Stock available at seller #11. Ideal for retail.', '2026-09-12 07:39:27'),
(8, 5, 'MobiTrack Pro 8', 26985.00, 23729.00, 12.07, 'uploads/product_8.jpg', 42, 'Brand new MobiTrack Pro 8 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 8, imported via MobiTrack. Stock available at seller #5. Ideal for retail.', '2026-09-12 07:39:27'),
(9, 8, 'Redmi Power 9', 30021.00, 23634.00, 21.28, NULL, 65, 'Brand new Redmi Power 9 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 9, imported via MobiTrack. Stock available at seller #8. Ideal for retail.', '2026-09-12 07:39:27'),
(10, 35, 'Pixel Force 10', 31771.00, 24360.00, 23.33, NULL, 13, 'Brand new Pixel Force 10 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 10, imported via MobiTrack. Stock available at seller #35. Ideal for retail.', '2026-09-12 07:39:27'),
(11, 5, 'OnePlus Nord 11', 29071.00, 24841.00, 14.55, NULL, 37, 'Brand new OnePlus Nord 11 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 11, imported via MobiTrack. Stock available at seller #5. Ideal for retail.', '2026-09-12 07:39:27'),
(12, 20, 'Realme Narzo 12', 32009.00, 27177.00, 15.10, NULL, 43, 'Brand new Realme Narzo 12 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 12, imported via MobiTrack. Stock available at seller #20. Ideal for retail.', '2026-09-12 07:39:27'),
(13, 8, 'OnePlus Nord 13', 34022.00, 26219.00, 22.94, NULL, 9, 'Brand new OnePlus Nord 13 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 13, imported via MobiTrack. Stock available at seller #8. Ideal for retail.', '2026-09-12 07:39:27'),
(14, 2, 'Vivo V 14', 32893.00, 27943.00, 15.05, NULL, 19, 'Brand new Vivo V 14 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 14, imported via MobiTrack. Stock available at seller #2. Ideal for retail.', '2026-09-12 07:39:27'),
(15, 26, 'Realme Narzo 15', 34964.00, 27935.00, 20.10, NULL, 62, 'Brand new Realme Narzo 15 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 15, imported via MobiTrack. Stock available at seller #26. Ideal for retail.', '2026-09-12 07:39:27'),
(16, 14, 'MobiTrack Lite 16', 35519.00, 29006.00, 18.34, 'uploads/product_16.jpg', 66, 'Brand new MobiTrack Lite 16 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 16, imported via MobiTrack. Stock available at seller #14. Ideal for retail.', '2026-09-12 07:39:27'),
(17, 29, 'MobiTrack Lite 17', 35562.00, 30411.00, 14.48, NULL, 39, 'Brand new MobiTrack Lite 17 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 17, imported via MobiTrack. Stock available at seller #29. Ideal for retail.', '2026-09-12 07:39:27'),
(18, 14, 'Realme Narzo 18', 39205.00, 31629.00, 19.32, NULL, 24, 'Brand new Realme Narzo 18 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 18, imported via MobiTrack. Stock available at seller #14. Ideal for retail.', '2026-09-12 07:39:27'),
(19, 14, 'Realme Narzo 19', 37101.00, 30828.00, 16.91, NULL, 5, 'Brand new Realme Narzo 19 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 19, imported via MobiTrack. Stock available at seller #14. Ideal for retail.', '2026-09-12 07:39:27'),
(20, 23, 'Realme Narzo 20', 34246.00, 30172.00, 11.90, 'uploads/product_20.jpg', 22, 'Brand new Realme Narzo 20 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 20, imported via MobiTrack. Stock available at seller #23. Ideal for retail.', '2026-09-12 07:39:27'),
(21, 23, 'Oppo Reno 21', 35987.00, 30892.00, 14.16, 'uploads/product_21.jpg', 57, 'Brand new Oppo Reno 21 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 21, imported via MobiTrack. Stock available at seller #23. Ideal for retail.', '2026-09-12 07:39:27'),
(22, 23, 'Redmi Power 22', 37775.00, 33205.00, 12.10, 'uploads/product_22.jpg', 14, 'Brand new Redmi Power 22 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 22, imported via MobiTrack. Stock available at seller #23. Ideal for retail.', '2026-09-12 07:39:27'),
(23, 14, 'MobiTrack Lite 23', 38907.00, 33026.00, 15.12, 'uploads/product_23.jpg', 63, 'Brand new MobiTrack Lite 23 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 23, imported via MobiTrack. Stock available at seller #14. Ideal for retail.', '2026-09-12 07:39:27'),
(24, 35, 'MobiTrack Pro 24', 37149.00, 33641.00, 9.44, 'uploads/product_24.jpg', 44, 'Brand new MobiTrack Pro 24 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 24, imported via MobiTrack. Stock available at seller #35. Ideal for retail.', '2026-09-12 07:39:27'),
(25, 32, 'MobiTrack Lite 25', 43736.00, 35754.00, 18.25, NULL, 77, 'Brand new MobiTrack Lite 25 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 25, imported via MobiTrack. Stock available at seller #32. Ideal for retail.', '2026-09-12 07:39:27'),
(26, 26, 'Galaxy Edge 26', 38798.00, 34701.00, 10.56, 'uploads/product_26.jpg', 62, 'Brand new Galaxy Edge 26 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 26, imported via MobiTrack. Stock available at seller #26. Ideal for retail.', '2026-09-12 07:39:27'),
(27, 20, 'Pixel Force 27', 40719.00, 36542.00, 10.26, NULL, 35, 'Brand new Pixel Force 27 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 27, imported via MobiTrack. Stock available at seller #20. Ideal for retail.', '2026-09-12 07:39:27'),
(28, 11, 'Galaxy Edge 28', 41025.00, 36232.00, 11.68, NULL, 69, 'Brand new Galaxy Edge 28 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 28, imported via MobiTrack. Stock available at seller #11. Ideal for retail.', '2026-09-12 07:39:27'),
(29, 2, 'Redmi Power 29', 39836.00, 35891.00, 9.90, NULL, 49, 'Brand new Redmi Power 29 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 29, imported via MobiTrack. Stock available at seller #2. Ideal for retail.', '2026-09-12 07:39:27'),
(30, 17, 'Realme Narzo 30', 43777.00, 37308.00, 14.78, NULL, 44, 'Brand new Realme Narzo 30 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 30, imported via MobiTrack. Stock available at seller #17. Ideal for retail.', '2026-09-12 07:39:27'),
(31, 35, 'MobiTrack Pro 31', 40406.00, 36763.00, 9.02, NULL, 50, 'Brand new MobiTrack Pro 31 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 31, imported via MobiTrack. Stock available at seller #35. Ideal for retail.', '2026-09-12 07:39:27'),
(32, 32, 'Pixel Force 32', 45780.00, 39397.00, 13.94, 'uploads/product_32.jpg', 7, 'Brand new Pixel Force 32 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 32, imported via MobiTrack. Stock available at seller #32. Ideal for retail.', '2026-09-12 07:39:27'),
(33, 35, 'MobiTrack Pro 33', 42327.00, 38099.00, 9.99, NULL, 23, 'Brand new MobiTrack Pro 33 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 33, imported via MobiTrack. Stock available at seller #35. Ideal for retail.', '2026-09-12 07:39:27'),
(34, 23, 'Oppo Reno 34', 45448.00, 40230.00, 11.48, 'uploads/product_34.jpg', 8, 'Brand new Oppo Reno 34 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 34, imported via MobiTrack. Stock available at seller #23. Ideal for retail.', '2026-09-12 07:39:27'),
(35, 2, 'MobiTrack Lite 35', 46275.00, 39344.00, 14.98, NULL, 7, 'Brand new MobiTrack Lite 35 with official warranty. Features 6.5\" AMOLED, 5000mAh battery, 108MP camera. Model 35, imported via MobiTrack. Stock available at seller #2. Ideal for retail.', '2026-09-12 07:39:27');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `customer_id`, `product_id`, `rating`, `comment`, `created_at`) VALUES
(1, 9, 32, 5, 'Outstanding build quality! (Review 1)', '2026-09-12 07:39:27'),
(2, 6, 26, 5, 'Fast delivery, product as described. (Review 2)', '2026-09-12 07:39:27'),
(3, 18, 29, 2, 'Outstanding build quality! (Review 3)', '2026-09-12 07:39:27'),
(4, 12, 11, 3, 'Fast delivery, product as described. (Review 4)', '2026-09-12 07:39:27'),
(5, 24, 14, 5, 'Best in this price range! (Review 5)', '2026-09-12 07:39:27'),
(6, 18, 9, 1, 'Not as expected, but okay. (Review 6)', '2026-09-12 07:39:27'),
(7, 33, 4, 2, 'Average product, expected better. (Review 7)', '2026-09-12 07:39:27'),
(8, 12, 27, 5, 'Average product, expected better. (Review 8)', '2026-09-12 07:39:27'),
(9, 9, 34, 4, 'Outstanding build quality! (Review 9)', '2026-09-12 07:39:27'),
(10, 24, 21, 3, 'Excellent phone, highly recommended! (Review 10)', '2026-09-12 07:39:27'),
(11, 9, 19, 5, 'Amazing display and speed! (Review 11)', '2026-09-12 07:39:27'),
(12, 21, 33, 5, 'Average product, expected better. (Review 12)', '2026-09-12 07:39:27'),
(13, 21, 11, 3, 'Fast delivery, product as described. (Review 15)', '2026-09-12 07:39:27'),
(14, 21, 24, 3, 'Value for money, good performance. (Review 16)', '2026-09-12 07:39:27'),
(15, 15, 20, 5, 'Excellent phone, highly recommended! (Review 17)', '2026-09-12 07:39:27'),
(16, 3, 16, 5, 'Value for money, good performance. (Review 18)', '2026-09-12 07:39:27'),
(17, 6, 27, 2, 'Fast delivery, product as described. (Review 19)', '2026-09-12 07:39:27'),
(18, 18, 13, 5, 'Average product, expected better. (Review 20)', '2026-09-12 07:39:27'),
(19, 12, 28, 3, 'Fast delivery, product as described. (Review 21)', '2026-09-12 07:39:27'),
(20, 6, 16, 2, 'Amazing display and speed! (Review 22)', '2026-09-12 07:39:27'),
(21, 3, 10, 3, 'Outstanding build quality! (Review 23)', '2026-09-12 07:39:27'),
(22, 24, 34, 3, 'Not as expected, but okay. (Review 24)', '2026-09-12 07:39:27'),
(23, 15, 23, 2, 'Excellent phone, highly recommended! (Review 25)', '2026-09-12 07:39:27'),
(24, 30, 24, 1, 'Amazing display and speed! (Review 26)', '2026-09-12 07:39:27'),
(25, 21, 23, 1, 'Best in this price range! (Review 27)', '2026-09-12 07:39:27'),
(26, 12, 6, 4, 'Best in this price range! (Review 28)', '2026-09-12 07:39:27'),
(27, 18, 24, 5, 'Best in this price range! (Review 29)', '2026-09-12 07:39:27'),
(28, 24, 31, 5, 'Value for money, good performance. (Review 30)', '2026-09-12 07:39:27'),
(29, 9, 33, 1, 'Satisfied with purchase. (Review 29)', '2026-09-12 07:39:31'),
(30, 30, 19, 5, 'Fast delivery, product as described. (Review 30)', '2026-09-12 07:39:31');

-- --------------------------------------------------------

--
-- Table structure for table `seller_stock`
--

CREATE TABLE `seller_stock` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `vendor_product_id` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `cost_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller_stock`
--

INSERT INTO `seller_stock` (`id`, `seller_id`, `vendor_product_id`, `qty`, `cost_price`) VALUES
(1, 26, 11, 84, 13597.00),
(2, 5, 33, 28, 9551.00),
(3, 35, 29, 21, 15251.00),
(4, 8, 19, 80, 20437.00),
(5, 8, 3, 71, 12418.00),
(6, 32, 5, 22, 19527.00),
(7, 5, 26, 47, 17249.00),
(8, 35, 4, 22, 15559.00),
(9, 35, 30, 99, 18431.00),
(10, 17, 25, 85, 20479.00),
(11, 11, 22, 28, 13511.00),
(12, 17, 21, 17, 15017.00),
(13, 20, 27, 82, 11928.00),
(14, 29, 3, 49, 20053.00),
(15, 17, 27, 45, 15588.00),
(16, 14, 27, 71, 12581.00),
(17, 17, 31, 80, 12500.00),
(18, 8, 33, 52, 20051.00),
(19, 17, 20, 93, 14623.00),
(20, 8, 28, 89, 16197.00),
(21, 17, 21, 61, 23883.00),
(22, 5, 7, 92, 17483.00),
(23, 14, 1, 86, 17988.00),
(24, 11, 2, 93, 11807.00),
(25, 20, 14, 83, 17736.00),
(26, 23, 22, 68, 12343.00),
(27, 2, 5, 72, 13097.00),
(28, 26, 21, 42, 21955.00),
(29, 17, 4, 67, 15882.00),
(30, 23, 19, 16, 22879.00),
(31, 32, 19, 45, 15366.00),
(32, 8, 26, 58, 12780.00),
(33, 2, 9, 85, 15211.00),
(34, 11, 35, 88, 15618.00),
(35, 23, 5, 76, 13715.00);

-- --------------------------------------------------------

--
-- Table structure for table `store_visits`
--

CREATE TABLE `store_visits` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `message` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store_visits`
--

INSERT INTO `store_visits` (`id`, `customer_id`, `seller_id`, `visit_date`, `message`, `status`, `created_at`) VALUES
(1, 30, 5, '2026-10-04', 'Visit request #1 to see stock and discuss bulk purchase. Preferred time: 12:00.', 'rejected', '2026-09-12 07:39:27'),
(2, 21, 32, '2026-09-05', 'Visit request #2 to see stock and discuss bulk purchase. Preferred time: 10:00.', 'rejected', '2026-09-12 07:39:27'),
(3, 24, 29, '2026-09-09', 'Visit request #3 to see stock and discuss bulk purchase. Preferred time: 12:00.', 'pending', '2026-09-12 07:39:27'),
(4, 33, 32, '2026-09-09', 'Visit request #4 to see stock and discuss bulk purchase. Preferred time: 13:00.', 'rejected', '2026-09-12 07:39:27'),
(5, 9, 8, '2026-09-19', 'Visit request #5 to see stock and discuss bulk purchase. Preferred time: 13:00.', 'approved', '2026-09-12 07:39:27'),
(6, 6, 17, '2026-09-30', 'Visit request #6 to see stock and discuss bulk purchase. Preferred time: 12:00.', 'approved', '2026-09-12 07:39:27'),
(7, 3, 17, '2026-10-09', 'Visit request #7 to see stock and discuss bulk purchase. Preferred time: 18:00.', 'approved', '2026-09-12 07:39:27'),
(8, 9, 11, '2026-09-07', 'Visit request #8 to see stock and discuss bulk purchase. Preferred time: 17:00.', 'approved', '2026-09-12 07:39:27'),
(9, 18, 14, '2026-09-16', 'Visit request #9 to see stock and discuss bulk purchase. Preferred time: 16:00.', 'rejected', '2026-09-12 07:39:27'),
(10, 30, 35, '2026-09-21', 'Visit request #10 to see stock and discuss bulk purchase. Preferred time: 13:00.', 'rejected', '2026-09-12 07:39:27'),
(11, 9, 11, '2026-09-05', 'Visit request #11 to see stock and discuss bulk purchase. Preferred time: 14:00.', 'pending', '2026-09-12 07:39:27'),
(12, 3, 17, '2026-09-06', 'Visit request #12 to see stock and discuss bulk purchase. Preferred time: 13:00.', 'approved', '2026-09-12 07:39:27'),
(13, 3, 8, '2026-09-04', 'Visit request #13 to see stock and discuss bulk purchase. Preferred time: 15:00.', 'approved', '2026-09-12 07:39:27'),
(14, 12, 2, '2026-09-19', 'Visit request #14 to see stock and discuss bulk purchase. Preferred time: 13:00.', 'approved', '2026-09-12 07:39:27'),
(15, 27, 5, '2026-10-04', 'Visit request #15 to see stock and discuss bulk purchase. Preferred time: 17:00.', 'approved', '2026-09-12 07:39:27'),
(16, 24, 23, '2026-09-23', 'Visit request #16 to see stock and discuss bulk purchase. Preferred time: 11:00.', 'pending', '2026-09-12 07:39:28'),
(17, 12, 26, '2026-09-17', 'Visit request #17 to see stock and discuss bulk purchase. Preferred time: 10:00.', 'pending', '2026-09-12 07:39:28'),
(18, 12, 17, '2026-10-11', 'Visit request #18 to see stock and discuss bulk purchase. Preferred time: 10:00.', 'pending', '2026-09-12 07:39:28'),
(19, 6, 35, '2026-09-12', 'Visit request #19 to see stock and discuss bulk purchase. Preferred time: 15:00.', 'pending', '2026-09-12 07:39:28'),
(20, 12, 32, '2026-10-11', 'Visit request #20 to see stock and discuss bulk purchase. Preferred time: 13:00.', 'rejected', '2026-09-12 07:39:28'),
(21, 6, 26, '2026-09-26', 'Visit request #21 to see stock and discuss bulk purchase. Preferred time: 16:00.', 'rejected', '2026-09-12 07:39:28'),
(22, 9, 26, '2026-09-24', 'Visit request #22 to see stock and discuss bulk purchase. Preferred time: 17:00.', 'pending', '2026-09-12 07:39:28'),
(23, 3, 35, '2026-09-03', 'Visit request #23 to see stock and discuss bulk purchase. Preferred time: 18:00.', 'pending', '2026-09-12 07:39:28'),
(24, 24, 29, '2026-09-06', 'Visit request #24 to see stock and discuss bulk purchase. Preferred time: 12:00.', 'approved', '2026-09-12 07:39:28'),
(25, 15, 35, '2026-09-30', 'Visit request #25 to see stock and discuss bulk purchase. Preferred time: 18:00.', 'pending', '2026-09-12 07:39:28'),
(26, 18, 32, '2026-10-03', 'Visit request #26 to see stock and discuss bulk purchase. Preferred time: 15:00.', 'rejected', '2026-09-12 07:39:28'),
(27, 27, 26, '2026-10-12', 'Visit request #27 to see stock and discuss bulk purchase. Preferred time: 14:00.', 'rejected', '2026-09-12 07:39:28'),
(28, 30, 14, '2026-09-30', 'Visit request #28 to see stock and discuss bulk purchase. Preferred time: 16:00.', 'pending', '2026-09-12 07:39:28'),
(29, 12, 35, '2026-10-05', 'Visit request #29 to see stock and discuss bulk purchase. Preferred time: 11:00.', 'approved', '2026-09-12 07:39:28'),
(30, 24, 32, '2026-09-17', 'Visit request #30 to see stock and discuss bulk purchase. Preferred time: 10:00.', 'rejected', '2026-09-12 07:39:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','vendor','seller','customer') NOT NULL,
  `shop_name` varchar(150) DEFAULT NULL,
  `business_name` varchar(150) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `shop_name`, `business_name`, `address`, `status`, `created_at`) VALUES
(1, 'Admin', 'admin@shop.local', '$2y$10$hF16VNojlOneff3F/E6iDehZo0elTb0ONnR10Vj5qapjNqsVDnn1S', 'admin', NULL, NULL, NULL, 'active', '2026-09-12 07:39:24'),
(2, 'Seller User 2', 'seller_2@test.local', '$2y$10$IazpwzINgLZiOYoJjlWmPeyNr2f7U6C5R9vRGrispV/KpwDuPzbPi', 'seller', 'Seller Shop 2 - Farmgate', 'Seller Business Ltd. 2', 'House 2, Road 30, Farmgate, Dhaka-1259, Bangladesh', 'active', '2026-09-12 07:39:24'),
(3, 'Customer User 3', 'customer_3@test.local', '$2y$10$h.tmQ96KibAbQu3LLJqDr.9oALob2aMAPBEaHgHt/HrFGJ4PvJdDm', 'customer', NULL, NULL, 'House 3, Road 39, Farmgate, Dhaka-1295, Bangladesh', 'active', '2026-09-12 07:39:24'),
(4, 'Vendor User 4', 'vendor_4@test.local', '$2y$10$YhC.DdPhbFmLv0GplXZb.u289yEXgNTqHJ6olHvooS3NPY6mwG7l.', 'vendor', 'Vendor Shop 4 - Mirpur', 'Vendor Business Ltd. 4', 'House 4, Road 40, Mirpur, Dhaka-1005, Bangladesh', 'active', '2026-09-12 07:39:24'),
(5, 'Seller User 5', 'seller_5@test.local', '$2y$10$3CudWQgHPo/.Byze1MJd3unT0RjVb17NpnixNCopQbB6XqbKoBt3.', 'seller', 'Seller Shop 5 - Mohakhali', 'Seller Business Ltd. 5', 'House 5, Road 48, Mohakhali, Dhaka-1177, Bangladesh', 'inactive', '2026-09-12 07:39:24'),
(6, 'Customer User 6', 'customer_6@test.local', '$2y$10$R3Z3e8gasoGdILh/ohVXqesTcnAHvotzdjZgQUxLO4R.CpDBi28My', 'customer', NULL, NULL, 'House 6, Road 1, Banani, Dhaka-1112, Bangladesh', 'inactive', '2026-09-12 07:39:24'),
(7, 'Vendor User 7', 'vendor_7@test.local', '$2y$10$LFRihMBW0DuXlIox8acFz.Okwx3Y/qcyMkZdnz2wyCxpAId2sTmwa', 'vendor', 'Vendor Shop 7 - Uttara', 'Vendor Business Ltd. 7', 'House 7, Road 17, Uttara, Dhaka-1019, Bangladesh', 'active', '2026-09-12 07:39:24'),
(8, 'Seller User 8', 'seller_8@test.local', '$2y$10$DVbSWw9W7jYLC18gHxPe9e1CkPQPiL7I.Sx6exIr2rjs2gq3QN0vC', 'seller', 'Seller Shop 8 - Mohakhali', 'Seller Business Ltd. 8', 'House 8, Road 22, Mohakhali, Dhaka-1271, Bangladesh', 'active', '2026-09-12 07:39:25'),
(9, 'Customer User 9', 'customer_9@test.local', '$2y$10$VGW7mnLxCl2qJ10Sj1MC6OWDnE7GqTMlotKKNjq/.eu1xyuuwuA/u', 'customer', NULL, NULL, 'House 9, Road 16, Mohakhali, Dhaka-1280, Bangladesh', 'active', '2026-09-12 07:39:25'),
(10, 'Vendor User 10', 'vendor_10@test.local', '$2y$10$GBM2/LwYx5ahcFnkmFEtqOD1v6iACLDe1YX1szInyGNEjXJgNAqI.', 'vendor', 'Vendor Shop 10 - Farmgate', 'Vendor Business Ltd. 10', 'House 10, Road 11, Farmgate, Dhaka-1132, Bangladesh', 'active', '2026-09-12 07:39:25'),
(11, 'Seller User 11', 'seller_11@test.local', '$2y$10$cfYNbG/W04oumzw3f5odr.Hw/Y1HxKP7ywrkXrofe2uBxwharsaKK', 'seller', 'Seller Shop 11 - Gulshan', 'Seller Business Ltd. 11', 'House 11, Road 5, Gulshan, Dhaka-1161, Bangladesh', 'active', '2026-09-12 07:39:25'),
(12, 'Customer User 12', 'customer_12@test.local', '$2y$10$nIX0BHwVGHrpZMYF7qdzjuf8yOfou4lrEd6oMwhrjJ8cce1xNACDu', 'customer', NULL, NULL, 'House 12, Road 38, Uttara, Dhaka-1038, Bangladesh', 'active', '2026-09-12 07:39:25'),
(13, 'Vendor User 13', 'vendor_13@test.local', '$2y$10$8dRg5l8CgbVORZJMPutdduugLYJDMemfUfn61GxvaQJVJZnUnzvyW', 'vendor', 'Vendor Shop 13 - Farmgate', 'Vendor Business Ltd. 13', 'House 13, Road 23, Farmgate, Dhaka-1117, Bangladesh', 'active', '2026-09-12 07:39:25'),
(14, 'Seller User 14', 'seller_14@test.local', '$2y$10$21QtADwdneQWfeVn/bOCC.vkYzRJaOGCiuwhx5r6rsV1AIQAElknq', 'seller', 'Seller Shop 14 - Mohakhali', 'Seller Business Ltd. 14', 'House 14, Road 31, Mohakhali, Dhaka-1249, Bangladesh', 'active', '2026-09-12 07:39:25'),
(15, 'Customer User 15', 'customer_15@test.local', '$2y$10$gw8dnNpMZ4ZyA9LYUiy6cOHyjhG3MIU7E3M3qpD1gdkLhQEHxjh4m', 'customer', NULL, NULL, 'House 15, Road 6, Dhanmondi, Dhaka-1136, Bangladesh', 'active', '2026-09-12 07:39:25'),
(16, 'Vendor User 16', 'vendor_16@test.local', '$2y$10$CsJ791Sg74.Af5SD9MLCQeMe2UVYhc/UbH/M1GXhSGUDI51Qv5CFW', 'vendor', 'Vendor Shop 16 - Mirpur', 'Vendor Business Ltd. 16', 'House 16, Road 35, Mirpur, Dhaka-1279, Bangladesh', 'active', '2026-09-12 07:39:25'),
(17, 'Seller User 17', 'seller_17@test.local', '$2y$10$/wUwZWlMZ0EnBjdWdgzAQOQC2z.6o99ksOBhYMkRvpQWnj9AgoJdW', 'seller', 'Seller Shop 17 - Banani', 'Seller Business Ltd. 17', 'House 17, Road 17, Banani, Dhaka-1082, Bangladesh', 'active', '2026-09-12 07:39:25'),
(18, 'Customer User 18', 'customer_18@test.local', '$2y$10$vo9KBQ3HV1OAJMmvGBGIkObh3k0vyw45Z26XmI6mj/KYWxRSdKsjW', 'customer', NULL, NULL, 'House 18, Road 26, Mohakhali, Dhaka-1260, Bangladesh', 'active', '2026-09-12 07:39:26'),
(19, 'Vendor User 19', 'vendor_19@test.local', '$2y$10$Vpi9T6VZd4NnsDoVH.CstuLauSrHYM9HiX5VVA8DJy7n0SYsMKI6i', 'vendor', 'Vendor Shop 19 - Mohakhali', 'Vendor Business Ltd. 19', 'House 19, Road 41, Mohakhali, Dhaka-1039, Bangladesh', 'active', '2026-09-12 07:39:26'),
(20, 'Seller User 20', 'seller_20@test.local', '$2y$10$mi8ZzyvIHXPbm380byN6L.mK.MLFp2uOgWUJ1jQ9hTM1uzgcrKM4O', 'seller', 'Seller Shop 20 - Mohakhali', 'Seller Business Ltd. 20', 'House 20, Road 42, Mohakhali, Dhaka-1001, Bangladesh', 'active', '2026-09-12 07:39:26'),
(21, 'Customer User 21', 'customer_21@test.local', '$2y$10$2OROKH3epFotx/jsXlPF.OJrh/W7f2epYk1KfB2ucEc3r9b0/ob6q', 'customer', NULL, NULL, 'House 21, Road 15, Dhanmondi, Dhaka-1168, Bangladesh', 'active', '2026-09-12 07:39:26'),
(22, 'Vendor User 22', 'vendor_22@test.local', '$2y$10$0Jul7Dqj9RZ.1KTIufJBB.CqFBV6snZn8i.w0XXvkmxGcWKSSzBx.', 'vendor', 'Vendor Shop 22 - Mirpur', 'Vendor Business Ltd. 22', 'House 22, Road 50, Mirpur, Dhaka-1070, Bangladesh', 'active', '2026-09-12 07:39:26'),
(23, 'Seller User 23', 'seller_23@test.local', '$2y$10$.6GBzpaOGqY9DICEBHdXYuVp9EIBvyRvL8jHel2fN8JE6AQ4dVKua', 'seller', 'Seller Shop 23 - Banani', 'Seller Business Ltd. 23', 'House 23, Road 46, Banani, Dhaka-1283, Bangladesh', 'active', '2026-09-12 07:39:26'),
(24, 'Customer User 24', 'customer_24@test.local', '$2y$10$NwZeApxqyEC8whtdS7HaJe15eDoqfXP0JqtHVj/50/i7KCNOZieE.', 'customer', NULL, NULL, 'House 24, Road 38, Mohakhali, Dhaka-1274, Bangladesh', 'active', '2026-09-12 07:39:26'),
(25, 'Vendor User 25', 'vendor_25@test.local', '$2y$10$28QGTmtWkhRs1Ukaj6jtLOx0Ouqdjjzn2JPmxsUf52A2BQREohaUu', 'vendor', 'Vendor Shop 25 - Dhanmondi', 'Vendor Business Ltd. 25', 'House 25, Road 41, Dhanmondi, Dhaka-1166, Bangladesh', 'active', '2026-09-12 07:39:26'),
(26, 'Seller User 26', 'seller_26@test.local', '$2y$10$CYTMeoQT0qHg26eVTNl.wupS/N2Na1x8l.DACniGyl2lUPDv3H2V.', 'seller', 'Seller Shop 26 - Dhanmondi', 'Seller Business Ltd. 26', 'House 26, Road 50, Dhanmondi, Dhaka-1295, Bangladesh', 'active', '2026-09-12 07:39:26'),
(27, 'Customer User 27', 'customer_27@test.local', '$2y$10$5RIPZ4kxanr18jXS8wsNQO3XuCijOrhZSV0yY03ZkGSLv9dle85dW', 'customer', NULL, NULL, 'House 27, Road 4, Dhanmondi, Dhaka-1091, Bangladesh', 'active', '2026-09-12 07:39:26'),
(28, 'Vendor User 28', 'vendor_28@test.local', '$2y$10$LxcN7rT1xPFn5kfRKfaLQeiJlo/ThW1GzfayKy4QU8OoHGbq4iJ9O', 'vendor', 'Vendor Shop 28 - Farmgate', 'Vendor Business Ltd. 28', 'House 28, Road 32, Farmgate, Dhaka-1040, Bangladesh', 'inactive', '2026-09-12 07:39:26'),
(29, 'Seller User 29', 'seller_29@test.local', '$2y$10$uhbrlOvM/TxMpjEitydDP.P2rP4G3oeuFiMl5SVi6RkqsR5u6SPGW', 'seller', 'Seller Shop 29 - Mirpur', 'Seller Business Ltd. 29', 'House 29, Road 31, Mirpur, Dhaka-1098, Bangladesh', 'active', '2026-09-12 07:39:26'),
(30, 'Customer User 30', 'customer_30@test.local', '$2y$10$0/j3guKljhS2nqR5.kQa5uQHuOCfevpztyPl7MJ6ZGu/I3vxYgYoG', 'customer', NULL, NULL, 'House 30, Road 17, Banani, Dhaka-1090, Bangladesh', 'active', '2026-09-12 07:39:27'),
(31, 'Vendor User 31', 'vendor_31@test.local', '$2y$10$BD7xbzHHQmLgf2reQQ/Z6e9IYV70tElQv5Lsxr90a3cmQIv4eUhva', 'vendor', 'Vendor Shop 31 - Mirpur', 'Vendor Business Ltd. 31', 'House 31, Road 4, Mirpur, Dhaka-1161, Bangladesh', 'active', '2026-09-12 07:39:27'),
(32, 'Seller User 32', 'seller_32@test.local', '$2y$10$ZWZMIhrR1SSm3Sv77fLTeeFtoAdu4OFbsqhYBs4mn6zdf0QMBVotq', 'seller', 'Seller Shop 32 - Uttara', 'Seller Business Ltd. 32', 'House 32, Road 38, Uttara, Dhaka-1220, Bangladesh', 'inactive', '2026-09-12 07:39:27'),
(33, 'Customer User 33', 'customer_33@test.local', '$2y$10$bL9SQx3B9oJBe8wKIwdDtujAEkQUQZYw52SC71.tSvwdk4wuYiSrC', 'customer', NULL, NULL, 'House 33, Road 17, Farmgate, Dhaka-1089, Bangladesh', 'active', '2026-09-12 07:39:27'),
(34, 'Vendor User 34', 'vendor_34@test.local', '$2y$10$bXPRZo9Zb/zzo61L.jfBlOEA0w7w0pUNNT1bZ6vQEjGS9M9i9QUl6', 'vendor', 'Vendor Shop 34 - Mohakhali', 'Vendor Business Ltd. 34', 'House 34, Road 30, Mohakhali, Dhaka-1048, Bangladesh', 'active', '2026-09-12 07:39:27'),
(35, 'Seller User 35', 'seller_35@test.local', '$2y$10$Z0rM3.GJXkEBNgDXBMNkVunjtU9Q7uVgLc/OMdDZ2t965mp95CNUq', 'seller', 'Seller Shop 35 - Uttara', 'Seller Business Ltd. 35', 'House 35, Road 21, Uttara, Dhaka-1156, Bangladesh', 'active', '2026-09-12 07:39:27'),
(36, 'Samaun Islam Ikra', 'samaunislam29@gmail.com', '$2y$10$o9GJmJFX4NOB.CQBz3E8SuN3q5KtkrPy1wWPuXEaXBX3N8otmc5W.', 'vendor', 'null', NULL, NULL, 'active', '2026-09-12 16:22:44'),
(37, 'Samaun Ikra', 'Samaun12@gmail.com', '$2y$10$T5G8Ve8nLlEFVk.q38Go/upeKGEe.cDsEq/4SFcijDdPcqwyJzYdC', 'seller', 'null', NULL, NULL, 'active', '2026-09-12 16:32:39'),
(38, 'Samaun Ikra', 'samaunikra10@gmail.com', '$2y$10$TgiROvMzB87t83uEL7i9wuih3QfxxImQ3x2Xn9X2LdV7iUJRQp0xm', 'customer', NULL, NULL, NULL, 'active', '2026-09-12 16:36:25'),
(39, 'Samaun Ikra', 'samaunikra19@gmail.com', '$2y$10$tLOm7QAUyANf10ScoHQE/.Ru1MaF5xdm5Nyku7esWDUHnIWWdMUQ6', 'customer', NULL, NULL, NULL, 'active', '2026-09-12 16:37:51'),
(40, 'Firasha Islam', 'fir123@gmail.com', '$2y$10$NM8oSO.UFp4IAoFOWePngO3Ay28rJGv1d33CJRS0xwW2GC5ZXQvEy', 'vendor', 'fir', NULL, NULL, 'active', '2026-09-14 05:33:01'),
(41, 'Samaun Ikra', 'ikra123@gmail.com', '$2y$10$1NariSSr1Yw2KkaK6Wf1ru7RKoCD3ePN6ctDkMEV0f15pAgohPDVe', 'seller', '123', NULL, NULL, 'active', '2026-09-14 05:37:07'),
(42, 'bhuban', 'bhuban123@gmail.com', '$2y$10$ntVliH6/4jTnwvSzZHXvRO6fTkkj7TRBbgmHw3krN5h6ond92RxU2', 'customer', NULL, NULL, NULL, 'active', '2026-09-14 06:34:54');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_products`
--

CREATE TABLE `vendor_products` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `return_policy` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor_products`
--

INSERT INTO `vendor_products` (`id`, `vendor_id`, `name`, `price`, `return_policy`, `created_at`) VALUES
(1, 4, 'Pixel 8 Pro - Model 1 128GB', 19983.00, '1 year brand warranty, 7 days return', '2026-09-12 07:39:27'),
(2, 16, 'Oppo Find X6 - Model 2 128GB', 20150.00, 'Sealed pack only return, 7 days', '2026-09-12 07:39:27'),
(3, 34, 'Tecno Camon 20 - Model 3 128GB', 18554.00, '7 days return, 15 days replacement for manufacturing defect', '2026-09-12 07:39:27'),
(4, 22, 'iPhone 15 Pro - Model 4 128GB', 19800.00, '30 days vendor warranty, return within 7 days if defective', '2026-09-12 07:39:27'),
(5, 7, 'Infinix Note 30 - Model 5 128GB', 21749.00, 'Damage must be reported within 24h, 15 days money back', '2026-09-12 07:39:27'),
(6, 34, 'Redmi Note 13 - Model 6 128GB', 21464.00, '7 days return, 15 days replacement for manufacturing defect', '2026-09-12 07:39:27'),
(7, 10, 'Vivo X90 - Model 7 128GB', 25328.00, '7 days replacement if sealed box', '2026-09-12 07:39:27'),
(8, 25, 'Infinix Note 30 - Model 8 128GB', 21744.00, '7 days return, 15 days replacement for manufacturing defect', '2026-09-12 07:39:27'),
(9, 22, 'OnePlus 11 - Model 9 128GB', 22285.00, 'No return after opening, 1 year service warranty', '2026-09-12 07:39:27'),
(10, 7, 'Oppo Find X6 - Model 10 128GB', 24484.00, '1 year brand warranty, 7 days return', '2026-09-12 07:39:27'),
(11, 7, 'Oppo Find X6 - Model 11 128GB', 28254.00, '1 year brand warranty, 7 days return', '2026-09-12 07:39:27'),
(12, 19, 'Vivo X90 - Model 12 128GB', 25993.00, 'No return after opening, 1 year service warranty', '2026-09-12 07:39:27'),
(13, 19, 'Redmi Note 13 - Model 13 128GB', 29434.00, '7 days replacement if sealed box', '2026-09-12 07:39:27'),
(14, 34, 'Infinix Note 30 - Model 14 128GB', 27298.00, '30 days vendor warranty, return within 7 days if defective', '2026-09-12 07:39:27'),
(15, 22, 'Tecno Camon 20 - Model 15 128GB', 30594.00, '1 year brand warranty, 7 days return', '2026-09-12 07:39:27'),
(16, 10, 'Oppo Find X6 - Model 16 128GB', 28694.00, 'Damage must be reported within 24h, 15 days money back', '2026-09-12 07:39:27'),
(17, 7, 'Oppo Find X6 - Model 17 128GB', 29634.00, '15 days warranty + 3 days return', '2026-09-12 07:39:27'),
(18, 34, 'Galaxy S24 Ultra - Model 18 128GB', 32778.00, 'No return after opening, 1 year service warranty', '2026-09-12 07:39:27'),
(19, 28, 'Redmi Note 13 - Model 19 128GB', 35014.00, '1 year brand warranty, 7 days return', '2026-09-12 07:39:27'),
(20, 25, 'Tecno Camon 20 - Model 20 128GB', 34230.00, 'Sealed pack only return, 7 days', '2026-09-12 07:39:27'),
(21, 10, 'OnePlus 11 - Model 21 128GB', 32344.00, '30 days vendor warranty, return within 7 days if defective', '2026-09-12 07:39:27'),
(22, 28, 'Realme GT 5 - Model 22 128GB', 36457.00, '7 days replacement if sealed box', '2026-09-12 07:39:27'),
(23, 7, 'Tecno Camon 20 - Model 23 128GB', 37109.00, 'Damage must be reported within 24h, 15 days money back', '2026-09-12 07:39:27'),
(24, 34, 'iPhone 15 Pro - Model 24 128GB', 34751.00, '7 days replacement if sealed box', '2026-09-12 07:39:27'),
(25, 16, 'iPhone 15 Pro - Model 25 128GB', 36495.00, 'Sealed pack only return, 7 days', '2026-09-12 07:39:27'),
(26, 34, 'Infinix Note 30 - Model 26 128GB', 37768.00, 'Damage must be reported within 24h, 15 days money back', '2026-09-12 07:39:27'),
(27, 25, 'iPhone 15 Pro - Model 27 128GB', 40253.00, 'No return after opening, 1 year service warranty', '2026-09-12 07:39:27'),
(28, 10, 'Realme GT 5 - Model 28 128GB', 38601.00, 'No return after opening, 1 year service warranty', '2026-09-12 07:39:27'),
(29, 13, 'Infinix Note 30 - Model 29 128GB', 41401.00, '30 days vendor warranty, return within 7 days if defective', '2026-09-12 07:39:27'),
(30, 16, 'Realme GT 5 - Model 30 128GB', 41951.00, '7 days return, 15 days replacement for manufacturing defect', '2026-09-12 07:39:27'),
(31, 25, 'Realme GT 5 - Model 31 128GB', 40597.00, 'Sealed pack only return, 7 days', '2026-09-12 07:39:27'),
(32, 28, 'Pixel 8 Pro - Model 32 128GB', 41696.00, '15 days warranty + 3 days return', '2026-09-12 07:39:27'),
(33, 7, 'Vivo X90 - Model 33 128GB', 42382.00, '1 year brand warranty, 7 days return', '2026-09-12 07:39:27'),
(34, 4, 'OnePlus 11 - Model 34 128GB', 46110.00, '15 days warranty + 3 days return', '2026-09-12 07:39:27'),
(35, 34, 'Oppo Find X6 - Model 35 128GB', 44112.00, '7 days replacement if sealed box', '2026-09-12 07:39:27'),
(36, 36, 'Samaun Ikra', 0.01, NULL, '2026-09-12 16:23:24'),
(37, 36, 'Samaun Ikra', 0.01, NULL, '2026-09-12 16:23:31'),
(38, 40, 'iphone 15 pro max', 890000.00, '356 days', '2026-09-14 05:34:23');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `vendor_product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `seller_id`, `vendor_product_id`, `created_at`) VALUES
(1, 20, 9, '2026-09-12 07:39:28'),
(2, 26, 10, '2026-09-12 07:39:28'),
(3, 5, 9, '2026-09-12 07:39:28'),
(4, 8, 30, '2026-09-12 07:39:28'),
(5, 32, 9, '2026-09-12 07:39:28'),
(6, 26, 15, '2026-09-12 07:39:28'),
(7, 17, 25, '2026-09-12 07:39:28'),
(8, 32, 24, '2026-09-12 07:39:28'),
(9, 11, 20, '2026-09-12 07:39:28'),
(10, 32, 31, '2026-09-12 07:39:28'),
(11, 5, 13, '2026-09-12 07:39:28'),
(12, 35, 24, '2026-09-12 07:39:28'),
(13, 32, 30, '2026-09-12 07:39:28'),
(14, 20, 5, '2026-09-12 07:39:28'),
(15, 5, 15, '2026-09-12 07:39:28'),
(16, 5, 33, '2026-09-12 07:39:28'),
(17, 2, 3, '2026-09-12 07:39:28'),
(18, 5, 14, '2026-09-12 07:39:28'),
(19, 14, 5, '2026-09-12 07:39:28'),
(20, 35, 21, '2026-09-12 07:39:28'),
(21, 23, 29, '2026-09-12 07:39:28'),
(22, 23, 5, '2026-09-12 07:39:28'),
(23, 35, 9, '2026-09-12 07:39:28'),
(24, 11, 14, '2026-09-12 07:39:28'),
(25, 23, 30, '2026-09-12 07:39:28'),
(26, 23, 9, '2026-09-12 07:39:28'),
(27, 17, 9, '2026-09-12 07:39:28'),
(28, 35, 3, '2026-09-12 07:39:28'),
(29, 17, 34, '2026-09-12 07:39:28'),
(30, 17, 32, '2026-09-12 07:39:28'),
(31, 41, 38, '2026-09-14 08:45:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `assigned_vendor_id` (`assigned_vendor_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `seller_stock`
--
ALTER TABLE `seller_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `vendor_product_id` (`vendor_product_id`);

--
-- Indexes for table `store_visits`
--
ALTER TABLE `store_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vendor_products`
--
ALTER TABLE `vendor_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_seller_vendor` (`seller_id`,`vendor_product_id`),
  ADD KEY `vendor_product_id` (`vendor_product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller_stock`
--
ALTER TABLE `seller_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `store_visits`
--
ALTER TABLE `store_visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `vendor_products`
--
ALTER TABLE `vendor_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notices`
--
ALTER TABLE `notices`
  ADD CONSTRAINT `notices_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`assigned_vendor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `seller_stock`
--
ALTER TABLE `seller_stock`
  ADD CONSTRAINT `seller_stock_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `seller_stock_ibfk_2` FOREIGN KEY (`vendor_product_id`) REFERENCES `vendor_products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `store_visits`
--
ALTER TABLE `store_visits`
  ADD CONSTRAINT `store_visits_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `store_visits_ibfk_2` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vendor_products`
--
ALTER TABLE `vendor_products`
  ADD CONSTRAINT `vendor_products_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`vendor_product_id`) REFERENCES `vendor_products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
