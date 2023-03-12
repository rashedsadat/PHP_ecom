-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 12, 2023 at 09:46 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `categories` varchar(255) NOT NULL,
  `status` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories`, `status`) VALUES
(8, 'Mobile', 1),
(9, 'Laptop', 1),
(10, 'Camera', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip` int NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `total_price` float NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `order_status` int NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address`, `city`, `zip`, `payment_type`, `total_price`, `payment_status`, `order_status`, `added_on`) VALUES
(8, 12, 'Noakhali', 'Maijdee', 1231, 'cod', 63220, 'success', 5, '2023-01-08 04:41:36'),
(9, 12, 'sdfscxdsf', 'dcsdefsdfs', 1231, 'cod', 89380, 'success', 1, '2023-01-11 01:17:24'),
(10, 12, 'Feni', 'feni', 1231, 'cod', 76845, 'success', 4, '2023-01-29 10:53:38'),
(11, 12, 'noakhali', 'maijdee', 1231, 'cod', 49050, 'success', 1, '2023-01-29 05:47:32'),
(12, 13, 'noakhali', 'maijdee', 1231, 'cod', 63220, 'success', 5, '2023-01-30 01:02:14');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(6, 8, 18, 1, 63220),
(7, 9, 20, 2, 89380),
(8, 10, 22, 1, 37060),
(9, 10, 19, 1, 39785),
(10, 11, 15, 3, 49050),
(11, 12, 18, 1, 63220);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Shipped'),
(4, 'Canceled'),
(5, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `categories_id` int NOT NULL,
  `sub_categories_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `mrp` float NOT NULL,
  `price` float NOT NULL,
  `quantity` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `best_seller` int NOT NULL DEFAULT '2' COMMENT '1 = best seller, 2 = No',
  `meta_title` varchar(2000) NOT NULL,
  `meta_desc` varchar(2000) NOT NULL,
  `meta_keyword` varchar(2000) NOT NULL,
  `status` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `categories_id`, `sub_categories_id`, `name`, `mrp`, `price`, `quantity`, `image`, `short_desc`, `description`, `best_seller`, `meta_title`, `meta_desc`, `meta_keyword`, `status`) VALUES
(14, 8, 10, 'Realme 10 Pro+', 41000, 38000, 10, '3571852797_Realme-10-Pro-Plus-Starlight.jpg', 'The Realme 10 Pro+ 5G is now available in two variants (128/256GB/8/12GB RAM). Now, Realme 10 Pro Plus 5G’s Price is 38000 taka Bangladesh. The 10 Pro Plus 5G has a 5000mAh battery with fast charging. This device is running with Android 12 and is powered by a MediaTek Dimensity 1080 chipset.', 'Realme 10 Pro+ 5G will be launched in November 2022. The 10 Pro Plus launched with model number RMX3687. Firstly, Its dimensional measure is 161.5 x 73.9 x 7.8 mm or 8 mm and the weight is 173 / 175 in grams. Secondly, the display of 10 Pro+ 5G is a 6.7-inch AMOLED panel with 1080 x 2412 pixels resolution. The display is protected from the unknown. Thirdly and most importantly, It is powered by the MediaTek Dimensity 1080 and runs with Android 12. Moreover, it has an Octa-core (2×2.6 GHz Cortex-A78 & 6×2.0 GHz Cortex-A55) CPU.\r\n\r\nThe Realme 10 Pro Plus phone has a three-camera setup on the back. This formation consists of a 108MP wide, 8MP macro, and 2MP depth camera. It has a 16MP selfie camera inside the notch of the display. The video recording capability is 1080p@30fps. According to its RAM and ROM, It has two (8/12GB/64/128/256GB) variants. On the other hand, it can support up to microSDXC using a dedicated slot. Certainly, 10 Pro+ 5G has a 5000mAh battery with 67W fast charging. It has a dual nano-SIM card slot. That is to say, 10 Pro+ 5G is 2G/3G/4G supportable. The fingerprint sensor is under the display.', 1, '', '', '', 1),
(15, 8, 9, 'Samsung Galaxy F04', 15000, 15000, 6, '2080003498_Samsung-Galaxy-F04-Jade-Purple.jpg', 'The Samsung Galaxy F04 is now available in one variant (64GB/4GB RAM). Now, Samsung Galaxy F04’s Price is 15000 taka in Bangladesh. Galaxy F04 has a 5000mAh battery with 15W fast charging. This device is running with Android 12 and is powered by the Mediatek MT6765 Helio P35 (12nm) chipset.', 'Samsung Galaxy F04 will be launched in January 2023. The Galaxy F04 launched with model numbers SM-E045F, SM-E045F/DS. Firstly, Its dimensional measure is 164.2 x 75.9 x 9.1 mm and the weight is unknown in grams. Secondly, the display of Galaxy F04 is a 6.5-inch PLS IPS panel with 720 x 1600 pixels resolution. The display is protecting from the unknown. Thirdly and most importantly, It is powered by the Mediatek MT6765 Helio P35 (12nm) and runs with Android 12. Moreover, it has an Octa-core (4×2.35 GHz Cortex-A53 & 4×1.8 GHz Cortex-A53) CPU.\r\n\r\nSamsung Galaxy F04 phone has a dual-camera setup on the back. This formation consists of a 13MP wide, and 2MP depth camera. It has an 5MP selfie camera inside the notch of the display. The video recording capability is 1080p@30fps. According to its RAM and ROM, It has two (4/6GB/64/128GB) variants. On the other hand, it can support up to microSDXC using a dedicated slot. Certainly, Galaxy F04 has a 5000mAh battery with 15-watt fast charging. It has a dual nano-SIM card slot. That is to say, Galaxy F04 is 2G/3G/4G supportable.', 2, '', '', '', 1),
(16, 8, 8, 'Xiaomi 12T', 70000, 68000, 8, '9223875215_Xiaomi-12T-Black.jpg', 'The Xiaomi 12T is now available in two variants (128/256GB/8GB RAM). Now, Xiaomi 12T’s Price is 68000 to Taka in Bangladesh. 12T has a 5000mAh battery with 120W fast charging. This device is running with Android 12 and powered by the MediaTek Dimensity 8100 Ultra chipset.', 'Xiaomi 12T will be launched in October 2022. The 12T launched with a model number unknown. Firstly, Its dimensional measure is 163.1 x 75.9 x 8.6 mm and the weight is 202 grams. Secondly, the display of 12T is a 6.67-inch OLED panel with 1220 x 2712 pixels resolution. The display is protected with Corning Gorilla Glass. Thirdly and most importantly, It is powered by the MediaTek Dimensity 8100 Ultra and runs with Android 12. Moreover, it has an Octa-core 2.85 GHz CPU.\r\n\r\nThe Xiaomi 12T phone has a triple-camera setup on the back. This formation consists of a 108MP wide, 8MP ultrawide, and 2MP macro camera. It has a 20MP selfie camera inside the punch hole of the display. The video recording capability is 8K@24/30fps,4K@30/60fps, and 1080p@30/60/120/240/480fps. According to its RAM and ROM, It has two (8GB/128/256GB) variants. On the other hand, it can support up to microSDXC using a shared SIM slot. Certainly, 12T has a 5000mAh battery with fast charging. It has a dual nano-SIM card slot. That is to say, 12T is 2G/3G/4G/5G supportable. The fingerprint sensor is under the display.', 1, '', '', '', 1),
(17, 8, 8, 'Xiaomi Redmi 10A', 12999, 10499, 4, '6455021008_Xiaomi-Redmi-10A-Silver.jpg', 'The Xiaomi Redmi 10A is now available in three variants (32/64/128GB/3/4/6GB RAM). Now, Xiaomi Redmi 10A’s Price is 10499 in Bangladesh. Redmi 10A has a 5000mAh battery with fast charging. This device is running with Android 11 and is powered by the Qualcomm SM6115 Snapdragon 662 chipset.', 'Xiaomi Redmi 10A will be launched in March 2022. The Redmi 10A launched with a model number unknown. Firstly, Its dimensional measure is 164.9 x 77 x 9 mm and the weight is 194 grams. Secondly, the display of the Redmi 10A is a 6.53-inch IPS LCD panel with 720 x 1600 pixels resolution. The display is protected with Corning Gorilla Glass 3. Thirdly and most importantly, It is powered by the MediaTek MT6762G Helio G25 (12 nm) and runs with Android 11. Moreover, it has up to an Octa-core (4×2.0 GHz Cortex-A53 & 4×1.5 GHz Cortex-A53) CPU.\r\n\r\nThe Xiaomi Redmi 10A phone has a single-camera setup on the back. This formation consists of a 13MP camera. It has a 5MP selfie camera inside the notch of the display. The video recording capability is 1080p@30fps. According to its RAM and ROM, It has three (3/4/6GB/32/64/128GB) variants. On the other hand, it can support up to microSDXC on using a dedicated slot. Certainly, Redmi 10A has a 5000mAh battery with fast charging. It has a dual nano-SIM card slot. That is to say, Redmi 10A is 2G/3G/4G supportable. The fingerprint sensor is side-mounted. You can get this in four colors-Black, Gray, and Blue.', 2, '', '', '', 1),
(18, 8, 7, 'OnePlus 11 Pro', 60000, 58000, 0, '8669946880_OnePlus-11-Green.jpg', 'The OnePlus 11 Pro is now available in three variants (128/256/512GB/8/12/16GB RAM). Now, the OnePlus 11 Pro’s Price is coming taka in Bangladesh. 11 Pro has a 5000mAh battery with fast charging. This device is running with Android 13 and powered by the Qualcomm Snapdragon 8 Gen 2 chipset.', 'OnePlus 11 Pro will be launched in September 2022. The 11 Pro launched with a model number unknown. Firstly, Its dimensional measure is unknown and the weight is unknown. Secondly, the display of the 11 Pro is a 6.62-inch AMOLED panel with 1080 x 2400 pixels resolution. The display is protected from the Glass front (Gorilla Glass), glass back (Gorilla Glass), and aluminum frame. Most importantly, It is powered by the Qualcomm Snapdragon 8 Gen 2 and runs Android 13. Moreover, it has up to an Octa-core CPU.\r\n\r\nThe onePlus 11 Pro phone has a three-camera setup on the back. This formation consists of a 50MP wide, 32MP telephoto, 48MP ultrawide camera. It has a 16MP selfie camera inside the notch of the display. The video recording capability is 1080p@30fps. Its RAM and ROM have three (8/12/16GB/128/256/512GB) variants. On the other hand, it can support up to microSDXC on using a dedicated slot. Certainly, the 11 Pro has a 5000mAh battery with fast charging. It has a dual nano-SIM card slot. That is to say, the 11 Pro is 2G/3G/4G/5G supportable. The fingerprint sensor is under the display.', 2, '', '', '', 1),
(19, 9, 6, 'Lenovo IdeaPad', 39600, 36500, 10, '4136710901_d330-1-500x500.jpg', 'MPN: 82H0001VIN\r\nModel: IdeaPad D330 10IGL\r\nProcessor: Intel Celeron N4020 (4M Cache,1.10 GHz up to 2.80 GHz)\r\nRAM: 4GB DDR4\r\nStorage: 128GB eMMC\r\nDisplay: 10.1\" (1280 x 800) HD Touchscreen', 'The Ideapad D330 has computing power and all the fun and mobility of a lightweight tablet. From multitasking to connecting with friends online and streaming shows. This Ideapad D330 featured 4GB DDR4 RAM, 128GB eMMC and Intel UHD 600 Graphics, and Windows 10 Home. The Lenovo Ideapad D330 comes with 10.1\" (1280 x 800) HD IPS WXGA LED Antiscratch Brightness: 300nits, Aspect Ratio: 16:10, Color Gamut: 50% NTSC Display. This Lenovo IdeaPad D330 has an abundance of ports, including a USB-C 3.1 to help you charge other devices or transfer data at speeds up to 10 Gbps. Its display can generate lifelike clarity with 2S stereo Speakers Dolby Premium Audio is the perfect combination for entertainment. This Lenovo IdeaPad D330 10IGL comes with 1 year Limited Warranty (1 year for Battery and Adapter, Terms & Conditions Apply As Per Lenovo)', 2, '', '', '', 1),
(20, 9, 4, 'Asus Vivobook', 43400, 41000, 4, '4672138985_vivobook-15-x515ea-01-500x500.jpg', 'MPN: BR763W\r\nModel: Vivobook X515MA\r\nProcessor: Intel Celeron N4020 (4M Cache, 1.10 GHz up to 2.80 GHz)\r\nMemory: 4GB DDR4 RAM\r\nStorage: 1TB 5400RPM HDD\r\nDisplay: 15.6\" HD (1366 x 768)', 'The Asus Vivobook X515MA laptop comes with Intel Celeron Processor N4020 (4M Cache, 1.10 GHz up to 2.80 GHz) and 4GB DDR4 RAM. It has a 1TB SATA 5400RPM 2.5\" HDD and it also comes with 1x M.2 2280 PCIe 3.0x2 Slot. This laptop has been integrated with Intel UHD Graphics 600 and it has a 15.6-inch HD (1366 x 768) display with a 16:9 aspect ratio. It runs on Windows 11 Home operating system. This whole system is powered by a 37WHrs, 2S1P, 2-cell Li-ion battery and comes with a Ã¸4.0, 33W AC Adapter, Output: 19V DC, 1.75A, 33W, Input: 100-240V AC 50/60Hz universal. This laptop has a VGA Webcam and Built-in speaker with SonicMaster. The Asus Vivobook X515MA offers Wi-Fi 5(802.11ac) and Bluetooth 4.1 (Dual band) 1*1 for wireless connectivity. The laptop is designed with 1x USB 3.0 Gen 1, 2x USB 2.0, 1 x HDMI ports. The Asus Vivobook X515MA Laptop comes with 2 years International Limited Warranty (Battery 1 year).', 1, '', '', '', 1),
(21, 9, 4, 'ASUS VivoBook Core i3', 52250, 49500, 5, '4045508817_15-x515ja-slate-grey-500x500.jpg', 'MPN: BQ3550-X515JA\r\nModel: VivoBook 15 X515JA\r\nProcessor: Intel Core i3-1005G1 (4M Cache,1.20 GHz up to 3.40 GHz)\r\nRAM: 4GB DDR4, Storage: 1TB HDD\r\nDisplay: 15.6\" FHD LED\r\nFeatures: SonicMaster, Type-C', 'ASUS VivoBook 15 X515JA FHD Laptop comes with Intel Core i3-1005G1 Processor (4M Cache, 1.20 GHz up to 3.40 GHz) and 4GB DDR4 SDRAM onboard. It features a 1TB SATA 5400RPM 2.5\" HDD. It is integrated with Intel UHD Graphics. It has a 15.6-inch, FHD (1920 x 1080) 16:9, Anti-glare display, LED Backlit, 200nits, NTSC: 45%, Screen-to-body ratio: 83 % Display. It is compatible with Windows 10 Home operating system. It has been designed with 1x USB 3.2 Gen 1 Type-A, 1x USB 3.2 Gen 1 Type-C, 2x USB 2.0 Type-A, 1x HDMI 1.4, 1x 3.5mm Combo Audio Jack, 1x DC-in, and a Micro SD card reader. It features a Chiclet Keyboard with Num-key and it has a 1.4mm Key-travel. It has a VGA camera and a built-in microphone. It comes with a built-in speaker and it features Audio by ICEpower. It is featured with Wi-Fi 5(802.11ac)+Bluetooth 4.1 (Dual-band) for better connectivity. It is powered by a 37WHrs, 2S1P, 2-cell Li-ion battery. The weight of the laptop is only 1.80 kg and it is very easy to carry anywhere. This laptop has a 2 years International Limited Warranty (Battery 1 year).', 2, '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sub_categories` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `sub_categories`, `status`) VALUES
(4, '9', 'Asus', 1),
(5, '9', 'HP', 1),
(6, '9', 'Lenovo', 1),
(7, '8', 'One Plus', 1),
(8, '8', 'Xiaomi', 1),
(9, '8', 'Samsung', 1),
(10, '8', 'Realme', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `mobile`, `added_on`) VALUES
(12, 'Rashed', 'rashed@gmail.com', 'rashed', '01675875019', '2023-01-08 04:41:02'),
(13, 'Shahadat Hossen', 'shahadathossen5019@gmail.com', 'shahadat', '01675875019', '2023-01-22 01:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `added_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `added_on`) VALUES
(11, 13, 19, '2023-01-28'),
(12, 12, 17, '2023-02-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
