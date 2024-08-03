-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2024 at 09:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mystore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'Nike'),
(2, 'Puma'),
(3, 'Skechers');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(1, 'Formal Shoes'),
(2, 'Lifestyle Shoes'),
(3, 'Running Shoes'),
(4, 'Sandals'),
(5, 'Sneaker Shoes'),
(6, 'Trekking Shoes');

-- --------------------------------------------------------

--
-- Table structure for table `orders_pending`
--

CREATE TABLE `orders_pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_pending`
--

INSERT INTO `orders_pending` (`order_id`, `user_id`, `invoice_number`, `product_id`, `quantity`, `order_status`) VALUES
(1, 3, 78698776, 33, 1, 'Pending'),
(2, 3, 1370420672, 41, 1, 'Pending'),
(3, 3, 817216661, 33, 1, 'Pending'),
(4, 3, 265378175, 46, 1, 'Pending'),
(5, 3, 1741892717, 45, 1, 'Pending'),
(6, 3, 554039414, 47, 1, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_desc` varchar(255) NOT NULL,
  `product_keyword` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_title` varchar(100) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_desc`, `product_keyword`, `category_id`, `brand_title`, `product_image1`, `product_image2`, `product_image3`, `product_price`, `product_stock`, `status`, `date`) VALUES
(34, 'Electrify NITRO Women&#039;s Running Shoes - Blue', 'The perfect choice for runners just starting out, the Electrify NITRO 3 delivers the cushioning and reliability needed your daily jog. The dual midsole contains our lightweight, nitrogen-injected NITRO foam in the heel alongside our sturdier PROFOAMLITE t', 'women,electrify,nitro,women', 3, 'Puma', 'image_2024-08-03_214323102.png', 'image_2024-08-03_214329488.png', 'image_2024-08-03_214342694.png', '1.699.000', 5, 'true', '2024-08-03 16:46:30'),
(35, 'Scend Pro Eng Men&#039;s Running Shoes - Grey', 'Introducing the Scend Pro, PUMA s most exciting new performance essential shoe. This model is built on the same last as our Run PUMA running shoes, exactly what you need to go fast and go far. The outsole is made with our Protread rubber providing durabil', 'running,scend,pro,men', 3, 'Puma', 'image_2024-08-03_214548962.png', 'image_2024-08-03_214555326.png', 'image_2024-08-03_214602099.png', '1.099.000', 6, 'true', '2024-08-03 14:46:21'),
(36, 'Men Shibui Cat Lifestyle Sandals - Black ', 'Feel the extreme comfort and be a trend-setter with the new Shibui cat slider featuring a comfortable, fully injected IMEVA slide for a perfectly snug feel at home or where ever your feet may carry you', 'sandal,me,shibui,cat', 4, 'Puma', 'image_2024-08-03_214811955.png', 'image_2024-08-03_214818811.png', 'image_2024-08-03_214825155.png', '499.000', 3, 'true', '2024-08-03 14:48:45'),
(37, 'Air Max Portal Women&#039;s Sneakers Shoes - White', 'Transport your style with a new Air Max. The Portal is the perfect blend of chunky and sleek, combining the platform sole of 2000s with the minimalist upper of contemporary designs. We added an oval-shaped midsole with cloud-like cushioning for an elevate', 'air,max,sneaker,women', 2, 'Nike', 'image_2024-08-03_215123603.png', 'image_2024-08-03_215130063.png', 'image_2024-08-03_215135755.png', '1.729.000', 3, 'true', '2024-08-03 14:51:55'),
(38, 'Calm Men&#039;s Sandals - Grey', 'Enjoy a calm, comfortable experience—no matter where your day off takes you. Made with soft yet responsive foam, these versatile sandals feature an oversized design that’s easy to wear. And the top strap is adjustable to give you that perfect fit. Whether', 'calm,men,sandal,nike', 4, 'Nike', 'image_2024-08-03_215310140.png', 'image_2024-08-03_215318920.png', 'image_2024-08-03_215328659.png', '1.199.000', 5, 'true', '2024-08-03 14:53:41'),
(39, 'Vista Women&#039;s Sandals - Phantom', 'W NIKE VISTA SANDAL', 'vista,women,sandal', 4, 'Nike', 'image_2024-08-03_215439971.png', 'image_2024-08-03_215446997.png', 'image_2024-08-03_215453328.png', '759.000', 6, 'true', '2024-08-03 14:55:01'),
(40, 'ZoomX Invincible Run Flyknit 3 Women&#039;s Road Running Shoes - Black', 'Confide In A Shoe That&#039;S Designed To Reduce Injury And Keep You Running. Specifically Made To Offset The Wear And Tear Of Your Toughest Training Runs And Races, It Sports A Slab Of Thick Cushioning To Help You Stay On Your Feet Today, Tomorrow And Be', 'run,zoomx,women', 3, 'Nike', 'image_2024-08-03_215606092.png', 'image_2024-08-03_215631514.png', 'image_2024-08-03_215620750.png', '2.849.000', 3, 'true', '2024-08-03 14:56:39'),
(41, 'Air Max Solo Men&#039;s Sneakers Shoes - White', 'This early-aughts interpretation of classic elements is perfect for the Air Max superfan. Layers of breathable mesh and synthetic leathers make the Air Max Solo both durable and breathable. The heel cup is inspired by the AM90, while the AM180 influences ', 'air,max,solo,men', 5, 'Nike', 'image_2024-08-03_215804499.png', 'image_2024-08-03_215810595.png', 'image_2024-08-03_215816830.png', '1.239.599', 7, 'true', '2024-08-03 19:21:03'),
(42, 'Slip-Ins Bobs B Flex Men&#039;s Sneaker - Black', 'Engineer Mesh Slip On Slip-Ins', 'slip-ins,skecher', 5, 'Skechers', 'image_2024-08-03_220004696.png', 'image_2024-08-03_220012662.png', '', '999.000', 3, 'true', '2024-08-03 15:00:18'),
(43, 'Slip-Ins Equalizer 5.0 Men&#039;s Sneaker - Navy', 'Slip-Ins Relaxed Fit Yardage Mesh Twin Gore Sneaker W/ Acmf', 'skecher,sneaker,slip', 5, 'Skechers', 'image_2024-08-03_220116173.png', 'image_2024-08-03_220128140.png', '', '1.199.000', 3, 'true', '2024-08-03 15:01:42'),
(44, 'Arch Fit Cali Breeze 2.0 Women&#039;s Sandal - Lavender', 'Molded Double Band Sandal W/Buckles And Heel Strap', 'women,sandal', 4, 'Skechers', 'image_2024-08-03_220240605.png', 'image_2024-08-03_220252879.png', '', '559.000', 3, 'true', '2024-08-03 15:03:03'),
(45, 'Flex Advantage 5.0 Men&#039;s Sneaker - White', 'Leather Overlay Mesh Lace-Up Sneaker W/ Padded Collar &amp; Air-Cooled Mf', 'flex,skecher', 5, 'Skechers', 'image_2024-08-03_220720117.png', 'image_2024-08-03_220726898.png', 'image_2024-08-03_220735363.png', '899.000', 2, 'true', '2024-08-03 19:43:20'),
(47, 'Court Vision Low Women&#039;s Sneakers Shoes - White', 'The fast break style of &#039;80s basketball meets the fast-paced culture of today&#039;s game in the Nike Court Vision Low.', 'nike,court,vision,low,women,sneaker', 5, 'Nike', '1.jpg', '', '', '1.099.000', 0, 'true', '2024-08-03 19:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_products` int(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `invoice_number` varchar(255) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `user_id`, `total_products`, `order_date`, `invoice_number`, `status`) VALUES
(1, 3, 1, '2024-08-03 18:34:37', '78698776', 'Pending'),
(2, 3, 1, '2024-08-03 19:21:03', '1370420672', 'Pending'),
(3, 3, 1, '2024-08-03 19:25:42', '817216661', 'Pending'),
(4, 3, 1, '2024-08-03 19:29:46', '265378175', 'Pending'),
(5, 3, 1, '2024-08-03 19:43:20', '1741892717', 'Pending'),
(6, 3, 1, '2024-08-03 19:46:15', '554039414', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_ip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `user_name`, `user_email`, `user_password`, `user_ip`) VALUES
(3, 'giri', 'gs@gmail.com', '$2y$10$GwKqTRM3sEtdoDIZhkvv0u2Au4zMjFDJN34Pl8akfS/jYpjcgMAm6', '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders_pending`
--
ALTER TABLE `orders_pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders_pending`
--
ALTER TABLE `orders_pending`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
