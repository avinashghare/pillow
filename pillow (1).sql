-- phpMyAdmin SQL Dump
-- version 4.4.1.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2015 at 06:20 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pillow`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesslevel`
--

CREATE TABLE IF NOT EXISTS `accesslevel` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accesslevel`
--

INSERT INTO `accesslevel` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'Operator'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `logintype`
--

CREATE TABLE IF NOT EXISTS `logintype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logintype`
--

INSERT INTO `logintype` (`id`, `name`) VALUES
(1, 'Facebook'),
(2, 'Twitter'),
(3, 'Email'),
(4, 'Google');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `linktype` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `isactive` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `keyword`, `url`, `linktype`, `parent`, `isactive`, `order`, `icon`) VALUES
(1, 'Users', '', '', 'site/viewusers', 1, 0, 1, 1, 'icon-user'),
(4, 'Dashboard', '', '', 'site/index', 1, 0, 1, 0, 'icon-dashboard'),
(6, 'Pillow Size', '', '', 'site/viewproduct', 1, 0, 1, 1, 'icon-user'),
(7, 'Orders', '', '', 'site/vieworder', 1, 0, 1, 1, 'icon-user'),
(8, 'Order Product', '', '', 'site/vieworderproduct', 1, 0, 1, 1, 'icon-user'),
(9, 'Order Product Images', '', '', 'site/vieworderproductimage', 1, 0, 1, 1, 'icon-user');

-- --------------------------------------------------------

--
-- Table structure for table `menuaccess`
--

CREATE TABLE IF NOT EXISTS `menuaccess` (
  `menu` int(11) NOT NULL,
  `access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuaccess`
--

INSERT INTO `menuaccess` (`menu`, `access`) VALUES
(1, 1),
(4, 1),
(2, 1),
(3, 1),
(5, 1),
(6, 1),
(7, 1),
(7, 3),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderstatus`
--

CREATE TABLE IF NOT EXISTS `orderstatus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderstatus`
--

INSERT INTO `orderstatus` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Shipping'),
(4, 'Delivered'),
(5, 'Cancel');

-- --------------------------------------------------------

--
-- Table structure for table `pillow_order`
--

CREATE TABLE IF NOT EXISTS `pillow_order` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `billingaddress` text NOT NULL,
  `billingcity` varchar(255) NOT NULL,
  `billingstate` varchar(255) NOT NULL,
  `billingcountry` varchar(255) NOT NULL,
  `shippingaddress` text NOT NULL,
  `shippingcity` varchar(255) NOT NULL,
  `shippingcountry` varchar(255) NOT NULL,
  `shippingstate` varchar(255) NOT NULL,
  `shippingpincode` varchar(255) NOT NULL,
  `defaultcurrency` varchar(255) NOT NULL,
  `totalamount` varchar(255) NOT NULL,
  `discountamount` varchar(255) NOT NULL,
  `finalamount` varchar(255) NOT NULL,
  `discountcoupon` varchar(255) NOT NULL,
  `paymentmethod` varchar(255) NOT NULL,
  `orderstatus` int(11) NOT NULL,
  `currancy` varchar(255) NOT NULL,
  `trackingcode` varchar(255) NOT NULL,
  `billingpincode` varchar(255) NOT NULL,
  `shippingmethod` varchar(255) NOT NULL,
  `shippingname` varchar(255) NOT NULL,
  `shippingtel` varchar(255) NOT NULL,
  `iscushion` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pillow_order`
--

INSERT INTO `pillow_order` (`id`, `user`, `firstname`, `Lastname`, `email`, `billingaddress`, `billingcity`, `billingstate`, `billingcountry`, `shippingaddress`, `shippingcity`, `shippingcountry`, `shippingstate`, `shippingpincode`, `defaultcurrency`, `totalamount`, `discountamount`, `finalamount`, `discountcoupon`, `paymentmethod`, `orderstatus`, `currancy`, `trackingcode`, `billingpincode`, `shippingmethod`, `shippingname`, `shippingtel`, `iscushion`) VALUES
(1, 1, '1', '1', '1@1.com', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 1, '1', '1', '1', '1', '1', '1', 0),
(2, 1, '1', '1', '1@a.cooommm', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 1, '1', '1', '1', '1', '1', '1', 0),
(3, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', 0),
(4, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '', '', '', '', '', 0),
(5, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '', '', '', '', '', 0),
(6, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '', '', '', '', '', 0),
(7, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '', '', '', '', '', 0),
(8, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pillow_orderproduct`
--

CREATE TABLE IF NOT EXISTS `pillow_orderproduct` (
  `id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `finalprice` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pillow_orderproduct`
--

INSERT INTO `pillow_orderproduct` (`id`, `order`, `product`, `quantity`, `price`, `discount`, `finalprice`, `thumbnail`) VALUES
(1, 1, 1, '1', '100', '0', '100', ''),
(2, 1, 1, '1', '100', '0', '100', ''),
(3, 1, 1, '1', '100', '0', '100', ''),
(4, 2, 1, '1', '1000', '0', '1000', ''),
(5, 4, 0, '', '', '', '', ''),
(6, 5, 0, '', '', '', '', ''),
(7, 6, 0, '', '', '', '', ''),
(8, 7, 0, '', '', '', '', ''),
(9, 8, 0, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pillow_orderproductimage`
--

CREATE TABLE IF NOT EXISTS `pillow_orderproductimage` (
  `id` int(11) NOT NULL,
  `orderproduct` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  `left` double NOT NULL,
  `top` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pillow_orderproductimage`
--

INSERT INTO `pillow_orderproductimage` (`id`, `orderproduct`, `image`, `order`, `left`, `top`) VALUES
(2, 1, 'Nature_at_its_Best!!!.png', 1, 0, 0),
(3, 1, 'Nature_at_its_Best!!!1.png', 2, 0, 0),
(4, 3, 'Nature_at_its_Best!!!2.png', 1, 0, 0),
(6, 4, 'Nature_at_its_Best!!!4.png', 2, 0, 0),
(7, 4, 'Nature_at_its_Best!!!5.png', 1, 0, 0),
(23, 1, '', 0, 0, 0),
(24, 1, 'image-927371439289889.jpg', 1, 0, 0),
(25, 1, 'image-147371439289892.jpg', 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pillow_product`
--

CREATE TABLE IF NOT EXISTS `pillow_product` (
  `id` int(11) NOT NULL,
  `xsize` varchar(255) NOT NULL,
  `ysize` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pillow_product`
--

INSERT INTO `pillow_product` (`id`, `xsize`, `ysize`, `status`, `image`, `name`) VALUES
(1, '1', '1', 0, 'topic-1350661050.jpg', 'Demo');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'inactive'),
(2, 'Active'),
(3, 'Waiting'),
(4, 'Active Waiting'),
(5, 'Blocked');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `accesslevel` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `socialid` varchar(255) NOT NULL,
  `logintype` int(11) NOT NULL,
  `json` text NOT NULL,
  `dob` date NOT NULL,
  `street` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `google` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `dob`, `street`, `address`, `city`, `state`, `country`, `pincode`, `facebook`, `google`, `twitter`) VALUES
(1, 'wohlig', 'a63526467438df9566c508027d9cb06b', 'wohlig@wohlig.com', 1, '0000-00-00 00:00:00', 1, NULL, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', ''),
(4, 'pratik', '0cb2b62754dfd12b6ed0161d4b447df7', 'pratik@wohlig.com', 1, '2014-05-12 06:52:44', 1, NULL, 'pratik', '1', 1, '', '0000-00-00', '', '', '', '', '', '', '', '', ''),
(5, 'wohlig123', 'wohlig123', 'wohlig1@wohlig.com', 1, '2014-05-12 06:52:44', 1, NULL, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', ''),
(6, 'wohlig1', 'a63526467438df9566c508027d9cb06b', 'wohlig2@wohlig.com', 1, '2014-05-12 06:52:44', 1, NULL, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', ''),
(7, 'Avinash', '7b0a80efe0d324e937bbfc7716fb15d3', 'avinash@wohlig.com', 1, '2014-10-17 06:22:29', 1, NULL, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', ''),
(9, 'avinash', 'a208e5837519309129fa466b0c68396b', 'a@email.com', 2, '2014-12-03 11:06:19', 3, '', '', '123', 1, 'demojson', '0000-00-00', '', '', '', '', '', '', '', '', ''),
(13, 'aaa', 'a208e5837519309129fa466b0c68396b', 'aaa3@email.com', 3, '2014-12-04 06:55:42', 3, NULL, '', '1', 2, 'userjson', '0000-00-00', '', '', '', '', '', '', '', '', ''),
(14, 'Rohan Patil', 'aeae5b2f900e84d784a0f0111e650835', 'rohan@gmail.com', 1, '2015-01-04 10:20:37', 2, '', '', '1', 1, 'demojson', '2015-01-15', 'kacheri street', 'yashodatt apt', 'karjat', 'Maharashtra', 'India', '410201', 'rohan09@fb.com', 'rohan@google.com', '#rohand'),
(16, 'aaa', 'pass', 'avi@aaa.aaa', NULL, '2015-03-23 11:35:02', NULL, NULL, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', ''),
(17, 'chin', 'f3abbf3960a3c7683c1a14eb176d1a28', 'chi@chi.com', 2, '2015-03-23 11:43:08', NULL, NULL, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', ''),
(18, 'Avinash Ghare', '', '', 3, '2015-07-13 06:58:39', 1, 'https://graph.facebook.com/846541392081594/picture?width=150&height=150', '', '846541392081594', 0, '', '0000-00-00', '', ',', '', '', '', '', '846541392081594', '', ''),
(19, 'ambest media', '', 'ambestmediacloud@gmail.com', 3, '2015-07-13 07:15:31', 1, 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg', '', '103739122467358278817', 0, '', '0000-00-00', '', ',', '', '', '', '', '', '103739122467358278817', ''),
(20, 'avinash_ghare', '', '', 3, '2015-07-13 07:22:56', 1, 'http://abs.twimg.com/sticky/default_profile_images/default_profile_1_normal.png', '', '2478104798', 0, '', '0000-00-00', '', ',', '', '', '', '', '', '', '2478104798'),
(21, NULL, 'a208e5837519309129fa466b0c68396b', 'a@aaa.com', 3, '2015-08-11 06:17:58', NULL, NULL, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', ''),
(22, NULL, 'a208e5837519309129fa466b0c68396b', 'a23@aaa.com', 3, '2015-08-11 06:18:16', NULL, NULL, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', ''),
(25, 'Avinash Ghare', '', 'avinash@wohlig.com', 3, '2015-08-11 11:01:24', 1, 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg', '', '118313183524893739637', 4, '', '0000-00-00', '', ',', '', '', '', '', '', '118313183524893739637', '');

-- --------------------------------------------------------

--
-- Table structure for table `usercart`
--

CREATE TABLE IF NOT EXISTS `usercart` (
  `user` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE IF NOT EXISTS `userlog` (
  `id` int(11) NOT NULL,
  `onuser` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `onuser`, `status`, `description`, `timestamp`) VALUES
(1, 1, 1, 'User Address Edited', '2014-05-12 06:50:21'),
(2, 1, 1, 'User Details Edited', '2014-05-12 06:51:43'),
(3, 1, 1, 'User Details Edited', '2014-05-12 06:51:53'),
(4, 4, 1, 'User Created', '2014-05-12 06:52:44'),
(5, 4, 1, 'User Address Edited', '2014-05-12 12:31:48'),
(6, 23, 2, 'User Created', '2014-10-07 06:46:55'),
(7, 24, 2, 'User Created', '2014-10-07 06:48:25'),
(8, 25, 2, 'User Created', '2014-10-07 06:49:04'),
(9, 26, 2, 'User Created', '2014-10-07 06:49:16'),
(10, 27, 2, 'User Created', '2014-10-07 06:52:18'),
(11, 28, 2, 'User Created', '2014-10-07 06:52:45'),
(12, 29, 2, 'User Created', '2014-10-07 06:53:10'),
(13, 30, 2, 'User Created', '2014-10-07 06:53:33'),
(14, 31, 2, 'User Created', '2014-10-07 06:55:03'),
(15, 32, 2, 'User Created', '2014-10-07 06:55:33'),
(16, 33, 2, 'User Created', '2014-10-07 06:59:32'),
(17, 34, 2, 'User Created', '2014-10-07 07:01:18'),
(18, 35, 2, 'User Created', '2014-10-07 07:01:50'),
(19, 34, 2, 'User Details Edited', '2014-10-07 07:04:34'),
(20, 18, 2, 'User Details Edited', '2014-10-07 07:05:11'),
(21, 18, 2, 'User Details Edited', '2014-10-07 07:05:45'),
(22, 18, 2, 'User Details Edited', '2014-10-07 07:06:03'),
(23, 7, 6, 'User Created', '2014-10-17 06:22:29'),
(24, 7, 6, 'User Details Edited', '2014-10-17 06:32:22'),
(25, 7, 6, 'User Details Edited', '2014-10-17 06:32:37'),
(26, 8, 6, 'User Created', '2014-11-15 12:05:52'),
(27, 9, 6, 'User Created', '2014-12-02 10:46:36'),
(28, 9, 6, 'User Details Edited', '2014-12-02 10:47:34'),
(29, 4, 6, 'User Details Edited', '2014-12-03 10:34:49'),
(30, 4, 6, 'User Details Edited', '2014-12-03 10:36:34'),
(31, 4, 6, 'User Details Edited', '2014-12-03 10:36:49'),
(32, 8, 6, 'User Details Edited', '2014-12-03 10:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `userproductcart`
--

CREATE TABLE IF NOT EXISTS `userproductcart` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `discount` double NOT NULL,
  `finalprice` double NOT NULL,
  `thumbnail` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userproductcart`
--

INSERT INTO `userproductcart` (`id`, `user`, `product`, `quantity`, `price`, `discount`, `finalprice`, `thumbnail`) VALUES
(1, 1, 0, 0, 0, 0, 0, ''),
(2, 1, 0, 0, 0, 0, 0, ''),
(3, 1, 0, 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `userproductimagecart`
--

CREATE TABLE IF NOT EXISTS `userproductimagecart` (
  `id` int(11) NOT NULL,
  `userproductcart` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  `left` double NOT NULL,
  `top` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userproductimagecart`
--

INSERT INTO `userproductimagecart` (`id`, `userproductcart`, `image`, `order`, `left`, `top`) VALUES
(1, 1, '', 0, 0, 0),
(2, 1, 'image-224611439290112.jpg', 1, 0, 0),
(3, 1, 'image-859161439290113.jpg', 2, 0, 0),
(4, 2, '', 0, 0, 0),
(5, 2, 'image-538451439290220.jpg', 1, 0, 0),
(6, 2, 'image-880531439290222.jpg', 2, 0, 0),
(7, 3, 'imag.jpg', 0, 0, 0),
(8, 3, 'image-411621439293460.jpg', 1, 0, 0),
(9, 3, 'image-493441439293464.jpg', 2, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesslevel`
--
ALTER TABLE `accesslevel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `logintype`
--
ALTER TABLE `logintype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderstatus`
--
ALTER TABLE `orderstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pillow_order`
--
ALTER TABLE `pillow_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pillow_orderproduct`
--
ALTER TABLE `pillow_orderproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pillow_orderproductimage`
--
ALTER TABLE `pillow_orderproductimage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pillow_product`
--
ALTER TABLE `pillow_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userproductcart`
--
ALTER TABLE `userproductcart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userproductimagecart`
--
ALTER TABLE `userproductimagecart`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesslevel`
--
ALTER TABLE `accesslevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `logintype`
--
ALTER TABLE `logintype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `orderstatus`
--
ALTER TABLE `orderstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pillow_order`
--
ALTER TABLE `pillow_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pillow_orderproduct`
--
ALTER TABLE `pillow_orderproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pillow_orderproductimage`
--
ALTER TABLE `pillow_orderproductimage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `pillow_product`
--
ALTER TABLE `pillow_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `userproductcart`
--
ALTER TABLE `userproductcart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `userproductimagecart`
--
ALTER TABLE `userproductimagecart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
