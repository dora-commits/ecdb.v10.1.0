SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(2, 'Giang', 'Pham', 'giang@gmail.com', '88888888'),
(3, 'Truong Giang', 'Pham', 'truong@gmail.com', '88888888'),
(4, 'Truong Giang', 'Pham', 'truonggiang@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Mobiles'),
(2, 'Cameras'),
(3, 'Books');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `pquantity` varchar(255) NOT NULL,
  `productprice` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`id`, `pid`, `orderid`, `pquantity`, `productprice`) VALUES
(1, 4, 1, '5', '16'),
(2, 4, 2, '5', '16'),
(3, 1, 2, '2', '20990'),
(4, 1, 3, '1', '20990'),
(5, 5, 3, '10', '99'),
(6, 3, 4, '1', '12890'),
(7, 6, 4, '1', '75'),
(8, 2, 5, '1', '7590'),
(9, 4, 5, '10', '16'),
(10, 4, 7, '1', '16'),
(11, 6, 7, '1', '75'),
(12, 5, 7, '2', '99');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `totalprice` varchar(255) NOT NULL,
  `orderstatus` varchar(255) NOT NULL,
  `paymentmode` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `uid`, `totalprice`, `orderstatus`, `paymentmode`, `timestamp`) VALUES
(1, 2, '50000', 'Order Placed', 'cod', '2024-08-18 12:22:36'),
(2, 2, '42060', 'Order Placed', 'cod', '2024-08-18 12:27:16'),
(3, 2, '21980', 'Cancelled', 'cod', '2024-08-18 14:25:23'),
(4, 2, '12965', 'In Progress', 'cod', '2024-08-18 14:28:29'),
(5, 2, '7750', 'In Progress', 'cod', '2024-08-19 19:40:34'),
(7, 2, '12000', 'Order Placed', 'on', '2024-08-19 23:12:18'),
(8, 1, '70000', 'Order Placed', 'cod', '2024-08-19 12:22:36'),
(9, 3, '25000', 'Order Placed', 'cod', '2024-08-20 12:22:36');

-- --------------------------------------------------------

--
-- Table structure for table `ordertracking`
--

CREATE TABLE `ordertracking` (
  `id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ordertracking`
--

INSERT INTO `ordertracking` (`id`, `orderid`, `status`, `message`, `timestamp`) VALUES
(1, 3, 'Cancelled', 'I do not want this item now.', '2024-08-16 17:54:18'),
(2, 4, 'In Progress', ' Order is in Progress', '2024-08-16 13:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `catid` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `catid`, `price`, `thumb`, `description`) VALUES
(1, 'Canon EOS 1300D 18MP Digital SLR Camera (Black) with 18-55mm ISII Lens, 16GB Card and Carry Case', 2, '1000', 'Canon EOS 200D 24 2MP.jpg', 'The EOSG 1300D packs in all the fun of photography, which is why we recommend it to users looking for their very first EOS DSLR camera. It uses an 18-megapixel APS-C size sensor and the DIGIC 4+ image processor.'),
(2, 'Sony DSC W830 Cyber-shot 20.1 MP Point and Shoot Camera (Black) with 8x Optical Zoom, Memory Card and Camera Case', 2, '7590', 'Sony Alpha a6000 Mirrorless Digital.jpg', 'The Sony DSC W830 Cyber-shot 20.1 MP Point and Shoot Camera (Black) with 8x Optical Zoom is a powerful camera full of features that put it at par with any professional DSLR. It is packed with a super HAD CCD sensor that comes with 20.1 effective megapixel'),
(3, 'Sony Cyber-shot DSC-H300/BC E32 point & Shoot Digital camera.', 2, '12891', 'Sony Alpha ILCA-77M2Q 24 3MP.jpg', 'The High zoom camera Sony Cyber-shot H300, with a powerful 35x optical zoom, brings your subject to you for beautiful, precise pictures. A 20.1MP sensor, HD video and creative features, let you capture detailed images and movies with ease. A DSLR-style bo'),
(4, 'General Knowledge 2018', 3, '16', 'General Knowledge 2018.jpg', 'An editorial team of highly skilled professionals at Arihant, works hand in glove to ensure that the students receive the best and accurate content through our books. From inception till the book comes out from print, the whole team comprising of authors,'),
(5, 'The Power of your Subconscious Mind', 3, '99', 'The Power of your Subconscious Mind.jpg', 'It\'s a very good n very useful book n it should be read by each n every one ...to knw the things that are not aware and know about the mind power .. Super duper book --ByAmazon Customeron 19 March 2018'),
(6, 'Think and Grow Rich', 3, '75', 'Think and Grow Rich.jpg', 'An American journalist, lecturer and author, Napoleon Hill is one of the earliest producers of \'personal-success literature . As an author of self-help books, Hill has always abided by and promoted principle of intense and burning passion being the sole k'),
(7, '38 Letters from Rockerfeller to his son', 3, '8888888', '38 Letters Rockerfeller for his son.png', 'The 38 Letters from J.D. Rockefeller to His Son\" offers an intimate and profound glimpse into the extraordinary mind and life of one of history\'s most influential figures, John D. Rockefeller, as he imparts his perspectives, ideology, and timeless wisdom ');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `review` text NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `pid`, `uid`, `review`, `timestamp`) VALUES
(1, 1, 2, 'It is an awesome Product!', '2024-08-16 15:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `timestamp`) VALUES
(1, 'userGiang@gmail.com', '1f32aa4c9a1d2ea010adcf2348166a04', '2024-08-20 08:02:00'),
(2, 'user2@gmail.com', '58b1216b06850385d9a4eadbedc806c4', '2024-08-16 08:03:00'),
(3, 'hihi@Giang.me', '26e0eca228b42a520565415246513c0d', '2024-08-19 12:05:10');

-- --------------------------------------------------------

--
-- Table structure for table `usersmeta`
--

CREATE TABLE `usersmeta` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `usersmeta`
--

INSERT INTO `usersmeta` (`id`, `uid`, `firstname`, `lastname`, `company`, `address1`, `address2`, `city`, `state`, `country`, `zip`, `mobile`) VALUES
(1, 2, 'Giang', 'Pham', 'MVC', '47A Woodgate Road', 'District 1', 'HCM', 'HCM', 'VN', '11111', '012344555');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `pid`, `uid`, `timestamp`) VALUES
(1, 1, 2, '2024-08-16 16:36:45'),
(2, 2, 2, '2024-08-16 16:38:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_idx` (`email`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pid_products_id_idx` (`pid`),
  ADD KEY `fk_orderid_orders_id_idx` (`orderid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_uid_users_id_idx` (`uid`);

--
-- Indexes for table `ordertracking`
--
ALTER TABLE `ordertracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orderid_orders_id_idx` (`orderid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_catid_category_id_idx` (`catid`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pid_products_id_idx` (`pid`),
  ADD KEY `fk_uid_users_id_idx` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_idx` (`email`);

--
-- Indexes for table `usersmeta`
--
ALTER TABLE `usersmeta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_uid_users_id_idx` (`uid`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_uid_users_id_idx` (`uid`),
  ADD KEY `fk_pid_products_id_idx` (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ordertracking`
--
ALTER TABLE `ordertracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usersmeta`
--
ALTER TABLE `usersmeta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `fk_orderitems_orderid_orders_id` FOREIGN KEY (`orderid`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `fk_orderitems_pid_products_id` FOREIGN KEY (`pid`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_uid_users_id` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `ordertracking`
--
ALTER TABLE `ordertracking`
  ADD CONSTRAINT `fk_ordertracking_orderid_orders_id` FOREIGN KEY (`orderid`) REFERENCES `orders` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_catid_category_id` FOREIGN KEY (`catid`) REFERENCES `category` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_pid_products_id` FOREIGN KEY (`pid`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_reviews_uid_users_id` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `usersmeta`
--
ALTER TABLE `usersmeta`
  ADD CONSTRAINT `fk_usersmeta_uid_users_id` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_wishlist_pid_products_id` FOREIGN KEY (`pid`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_wishlist_uid_users_id` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
