-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2020 at 03:12 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `attr_id` int(11) NOT NULL,
  `attr_name` varchar(255) NOT NULL,
  `attr_desc` text NOT NULL,
  `parent_attr_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`attr_id`, `attr_name`, `attr_desc`, `parent_attr_id`) VALUES
(1, 'Size', '', 0),
(2, 'small', '', 1),
(3, 'Medium', '', 1),
(4, 'Color', '', 0),
(5, 'Red', '', 4),
(6, 'Blue', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `item_id` int(255) NOT NULL,
  `qty` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `item_id`, `qty`) VALUES
(1, 26, 7, 0),
(2, 26, 6, 0),
(5, 64, 5, 0),
(7, 24, 6, 0),
(11, 51, 4, 0),
(15, 14, 7, 4),
(19, 30, 6, 0),
(23, 29, 3, 0),
(24, 1, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_desc` text NOT NULL,
  `cat_img` text NOT NULL,
  `parent_cat_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_desc`, `cat_img`, `parent_cat_id`) VALUES
(4, 'Shoes', 'All kinds of shoes', 'p_5e2564c2a14d6.jpg', 0),
(5, 'Watches', 'All kinds of watches', 'p_5e25650200dd8.jpg', 0),
(6, 'Shirts', 'All branded shirts', 'p_5e25651781671.jpg', 0),
(7, 'Pants', 'Jeans and shorts', 'p_5e2565231ba0f.jpg', 0),
(8, 'Bag', 'Shoulder bags, School bags, etc', 'p_5e256536450ef.jpg', 0),
(9, 'Converse', '', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `c_abbr` text NOT NULL,
  `c_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `c_abbr`, `c_name`) VALUES
(3, 'US', 'United States'),
(4, 'AF', 'Afghanistan'),
(5, 'AX', 'Åland Islands'),
(7, 'AL', 'Albania'),
(8, 'DZ', 'Algeria'),
(9, 'AS', 'American Samoa'),
(10, 'AD', 'Andorra'),
(11, 'AO', 'Angola'),
(12, 'AI', 'Anguilla'),
(13, 'AQ', 'Antartica'),
(14, 'AG', 'Antigua and Barbuda'),
(15, 'AR', 'Argentina'),
(16, 'AM', 'Armenia'),
(17, 'AW', 'Aruba'),
(18, 'AU', 'Australia'),
(19, 'AT', 'Austria'),
(20, 'AZ', 'Azerbaijan'),
(21, 'BS', 'Bahamas'),
(22, 'BH', 'Bahrain'),
(23, 'BD', 'Bangladesh'),
(24, 'BB', 'Barbados'),
(25, 'BY', 'Belarus'),
(26, 'BE', 'Belgium'),
(27, 'BZ', 'Belize'),
(28, 'BJ', 'Benin'),
(29, 'BM', 'Bermuda'),
(30, 'BT', 'Bhutan'),
(31, 'BO', 'Bolivia, Plurinational State of'),
(32, 'BQ', 'Bonaire, Sint Eustatius and Saba'),
(33, 'BA', 'Bosnia and Herzegovina'),
(34, 'BW', 'Botswana'),
(35, 'BV', 'Bouvet Island'),
(36, 'BR', 'Brazil'),
(37, 'IO', 'British Indian Ocean Territory'),
(38, 'BN', 'Brunei Darussalam'),
(39, 'BG', 'Bulgaria'),
(40, 'BF', 'Burkina Faso'),
(41, 'BI', 'Burundi'),
(42, 'KH', 'Cambodia'),
(43, 'CM', 'Cameron'),
(44, 'CA', 'Canada'),
(45, 'CV', 'Cape Verde'),
(46, 'KY', 'Cayman Islands'),
(47, 'CF', 'Central African Republic'),
(48, 'TD', 'Chad'),
(49, 'CL', 'Chile'),
(50, 'CN', 'China'),
(51, 'CX', 'Christmas Island'),
(52, 'CC', 'Cocos (Keeling) Islands'),
(53, 'CO', 'Colombia'),
(54, 'KM', 'Comoros'),
(55, 'CG', 'Congo'),
(56, 'CD', 'Congo, the Democratic Republic of the'),
(57, 'CK', 'Cook Islands'),
(58, 'CR', 'Costa Rica'),
(59, 'CI', 'Côte d\'Ivoire'),
(60, 'HR', 'Croatia'),
(61, 'CU', 'Cuba'),
(63, 'CW', 'Curacao'),
(64, 'CY', 'Cyprus'),
(65, 'CZ', 'Czech Republic'),
(66, 'DK', 'Denmark'),
(67, 'DJ', 'Djibouti'),
(68, 'DM', 'Dominica'),
(69, 'DO', 'Dominican Republic'),
(70, 'EC', 'Ecuador'),
(71, 'EG', 'Egypt'),
(72, 'SV', 'El Salvador'),
(73, 'GQ', 'Equatorial Guinea'),
(74, 'ER', 'Eritrea'),
(75, 'EE', 'Estonia'),
(76, 'ET', 'Ethiopia'),
(77, 'FK', 'Falkland Islands (Malvinas)'),
(78, 'FO', 'Faroe Islands'),
(79, 'FJ', 'Fiji'),
(80, 'FI', 'Finland'),
(81, 'FR', 'France'),
(82, 'GF', 'French Guiana'),
(83, 'PF', 'French Polynesia'),
(84, 'TF', 'French Southern Territories'),
(85, 'GA', 'Gabon'),
(86, 'GM', 'Gambia'),
(87, 'GE', 'Georgia'),
(88, 'DE', 'Germany'),
(89, 'GH', 'Ghana'),
(91, 'GI', 'Gibraltar'),
(92, 'GR', 'Greece'),
(93, 'GL', 'Greenland'),
(94, 'GD', 'Grenada'),
(95, 'GP', 'Guadeloupe'),
(96, 'GU', 'Guam'),
(97, 'GT', 'Guatemala'),
(98, 'GG', 'Guernsey'),
(99, 'GN', 'Guinea'),
(100, 'GW', 'Guinea-Bissau'),
(101, 'GY', 'Guyana'),
(102, 'HT', 'Haiti'),
(103, 'HM', 'Heard Island and McDonald Islands'),
(104, 'VA', 'Holy See (Vatican City State)'),
(105, 'HN', 'Honduras'),
(106, 'HK', 'Hong Kong'),
(107, 'HU', 'Hungary'),
(108, 'IS', 'Iceland'),
(109, 'IN', 'India'),
(110, 'ID', 'Indonesia'),
(111, 'IR', 'Iran, Islamic Republic of'),
(112, 'IQ', 'Iraq'),
(113, 'IE', 'Ireland'),
(114, 'IM', 'Isle of Man'),
(115, 'IL', 'Israel'),
(116, 'IT', 'Italy'),
(117, 'JM', 'Jamaica'),
(118, 'JP', 'Japan'),
(119, 'JE', 'Jersey'),
(120, 'JO', 'Jordan'),
(121, 'KZ', 'Kazakhstan'),
(122, 'KE', 'Kenya'),
(123, 'KI', 'Kiribati'),
(124, 'KP', 'Korea, Democratic People\'s Republic of'),
(126, 'KR', 'Korea, Republic of'),
(127, 'XK', 'Kosovo'),
(128, 'KW', 'Kuwait'),
(129, 'KG', 'Kyrgyzstan'),
(130, 'LA', 'Lao People\'s Democratic Republic'),
(131, 'LV', 'Latvia'),
(132, 'LB', 'Lebanon'),
(133, 'LS', 'Lesotho'),
(134, 'LR', 'Liberia'),
(135, 'LY', 'Libya'),
(136, 'LI', 'Liechtenstein'),
(137, 'LT', 'Lithuania'),
(138, 'LU', 'Luxembourg'),
(139, 'MO', 'Macao'),
(140, 'MK', 'Macedonia, the former Yugoslav Republic of'),
(141, 'MG', 'Madagascar'),
(142, 'MW', 'Malawi'),
(143, 'MY', 'Malaysia'),
(144, 'MV', 'Maldives'),
(145, 'ML', 'Mali'),
(146, 'MT', 'Malta'),
(147, 'MH', 'Marshall Islands'),
(148, 'MQ', 'Martinique'),
(149, 'MR', 'Mauritania'),
(150, 'MU', 'Mauritius'),
(151, 'YT', 'Mayotte'),
(152, 'MX', 'Mexico'),
(153, 'FM', 'Micronesia, Federated States of'),
(154, 'MD', 'Moldova, Republic of'),
(155, 'MC', 'Monaco'),
(156, 'MN', 'Mongolia'),
(157, 'ME', 'Montenegro'),
(158, 'MS', 'Monteserrat'),
(159, 'MA', 'Morocco'),
(160, 'MZ', 'Mozambique'),
(161, 'MM', 'Myanmar'),
(162, 'NA', 'Namibia'),
(163, 'NR', 'Nauru'),
(164, 'NP', 'Nepal'),
(165, 'NL', 'Netherlands'),
(166, 'NC', 'New Caledonia'),
(167, 'NZ', 'New Zealand'),
(168, 'NI', 'Nicaragua'),
(169, 'NE', 'Niger'),
(170, 'NG', 'Nigeria'),
(171, 'NU', 'Niue'),
(172, 'NF', 'Norfolk Island'),
(173, 'MP', 'Northern Mariana Islands'),
(174, 'NO', 'Norway'),
(175, 'OM', 'Oman'),
(176, 'PK', 'Pakistan'),
(177, 'PW', 'Palau'),
(178, 'PS', 'Palestinian Territory, Occupied'),
(179, 'PA', 'Panama'),
(180, 'PG', 'Papua New Guinea'),
(181, 'PY', 'Paraguay'),
(182, 'PE', 'Peru'),
(183, 'PH', 'Philippines'),
(184, 'PN', 'Pitcairn'),
(185, 'PL', 'Poland'),
(186, 'PT', 'Portugal'),
(187, 'PR', 'Puerto Rico'),
(188, 'QA', 'Qatar'),
(189, 'RE', 'Réunion'),
(190, 'RO', 'Romania'),
(191, 'RU', 'Russian Federation'),
(192, 'RW', 'Rwanda'),
(193, 'BL', 'Saint Barthélemy'),
(194, 'SH', 'Saint Helena, Ascension and Tristan da Cunha'),
(195, 'KN', 'Saint Kitts and Nevis'),
(196, 'LC', 'Saint Lucia'),
(197, 'MF', 'Saint Martin (French part)'),
(198, 'PM', 'Saint Pierre and Miquelon'),
(199, 'VC', 'Saint Vincent and the Grenadines'),
(200, 'WS', 'Samoa'),
(201, 'SM', 'San Marino'),
(202, 'ST', 'Sao Tome and Principe'),
(203, 'SA', 'Saudi Arabia'),
(204, 'SN', 'Senegal'),
(205, 'RS', 'Serbia'),
(206, 'SC', 'Seychelles'),
(207, 'SL', 'Sierra Leone'),
(208, 'SG', 'Singapore'),
(209, 'SX', 'Sint Maarten (Dutch part)'),
(210, 'SK', 'Slovakia'),
(211, 'SI', 'Slovenia'),
(212, 'SB', 'Solomon Islands'),
(213, 'SO', 'Somalia'),
(214, 'ZA', 'South Africa'),
(215, 'GS', 'South Georgia and the South Sandwich Islands'),
(216, 'SS', 'South Sudan'),
(217, 'ES', 'Spain'),
(218, 'LK', 'Sri Lanka'),
(219, 'SD', 'Sudan'),
(220, 'SR', 'Suriname'),
(221, 'SJ', 'Svalbard and Jan Mayen'),
(222, 'SZ', 'Swaziland'),
(223, 'SE', 'Sweden'),
(224, 'CH', 'Switzerland'),
(225, 'SY', 'Syrian Arab Republic'),
(226, 'TW', 'Taiwan, Republic of China'),
(227, 'TJ', 'Tajikistan'),
(228, 'TZ', 'Tanzania,United Republic of'),
(229, 'TH', 'Thailand'),
(230, 'TL', 'Timor-Leste'),
(231, 'TG', 'Togo'),
(232, 'TK', 'Tokelau'),
(233, 'TO', 'Tonga'),
(234, 'TT', 'Trinidad and Tobago'),
(235, 'TN', 'Tunisia'),
(236, 'TR', 'Turkey'),
(238, 'TM', 'Turkmenistan'),
(239, 'TC', 'Turks and Caicos  Islands'),
(240, 'TV', 'Tuvalu'),
(241, 'UG', 'Uganda'),
(242, 'UA', 'Ukraine'),
(243, 'AE', 'United Arab Emirates'),
(244, 'GB', 'United Kingdom'),
(245, 'UM', 'United States Minor Outlying Islands'),
(246, 'UY', 'Uruguay'),
(247, 'UZ', 'Uzbekistan'),
(248, 'VU', 'Vanuatu'),
(249, 'VE', 'Venezuela, Bolivarian Republic of'),
(250, 'VN', 'Viet Nam'),
(251, 'VG', 'Virgin Islands, British'),
(252, 'VI', 'Virgin Islands, U.S.'),
(253, 'WF', 'Wallis and Futuna'),
(254, 'EH', 'Western Sahara'),
(255, 'YE', 'Yemen'),
(256, 'ZM', 'Zambia'),
(257, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `product_id` text NOT NULL,
  `quantity` int(255) NOT NULL,
  `payment_type` int(255) NOT NULL COMMENT '1 Paypal, 2 Authorize, 3 COD',
  `order_status` int(255) NOT NULL COMMENT '1 Awaiting Check Payment, 2 Awaiting COD validation, 3 Awaiting check payment, 4 Cancelled, 5 Delivered, 6 Payment accepted, 7 Payment Error, 8 Processing in progress, 9 Refunded, 10 Shipped',
  `sales_tax` varchar(255) NOT NULL,
  `shipping_rate` varchar(255) NOT NULL,
  `total_paid` varchar(255) NOT NULL,
  `date_ordered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tracking_number` varchar(50) NOT NULL,
  `service_type` varchar(3) NOT NULL,
  `graphic_img` varchar(255) NOT NULL,
  `shipping_firstname` varchar(255) NOT NULL,
  `shipping_lastname` varchar(255) NOT NULL,
  `shipping_address` text NOT NULL,
  `shipping_address_unit` text NOT NULL,
  `shipping_city` text NOT NULL,
  `shipping_country` text NOT NULL,
  `shipping_state` varchar(255) NOT NULL,
  `shipping_zip_code` varchar(255) NOT NULL,
  `shipping_phone` varchar(255) NOT NULL,
  `billing_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `product_id`, `quantity`, `payment_type`, `order_status`, `sales_tax`, `shipping_rate`, `total_paid`, `date_ordered`, `tracking_number`, `service_type`, `graphic_img`, `shipping_firstname`, `shipping_lastname`, `shipping_address`, `shipping_address_unit`, `shipping_city`, `shipping_country`, `shipping_state`, `shipping_zip_code`, `shipping_phone`, `billing_address`) VALUES
(2, 27, '[\"4\",\"3\"]', 1, 1, 1, '0.095', '0', '2.19', '2020-04-24 17:20:20', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `ps_id` int(11) NOT NULL,
  `paypal_sandbox` text NOT NULL,
  `paypal_email` text NOT NULL,
  `paypal_client_id` text NOT NULL,
  `stripe_testmode` int(20) NOT NULL,
  `stripe_test_skey` text NOT NULL,
  `stripe_test_pubkey` text NOT NULL,
  `stripe_live_skey` text NOT NULL,
  `stripe_live_pubkey` text NOT NULL,
  `tax_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ship_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sendgrid_key` text NOT NULL,
  `taxjar_key` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ups_mode` int(1) NOT NULL DEFAULT '0' COMMENT '0 - Test, 1 - Production',
  `ups_access_key` varchar(50) NOT NULL,
  `ups_shipper_number` varchar(50) NOT NULL,
  `ups_user_id` varchar(255) NOT NULL,
  `ups_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_settings`
--

INSERT INTO `payment_settings` (`ps_id`, `paypal_sandbox`, `paypal_email`, `paypal_client_id`, `stripe_testmode`, `stripe_test_skey`, `stripe_test_pubkey`, `stripe_live_skey`, `stripe_live_pubkey`, `tax_rate`, `ship_rate`, `sendgrid_key`, `taxjar_key`, `created_at`, `ups_mode`, `ups_access_key`, `ups_shipper_number`, `ups_user_id`, `ups_password`) VALUES
(1, '1', 'billing-facilitator@tbldevelopmentfirm.com', 'ARZEOYBKIZk-UVoC70dh4rO84VJN6jsj2k3MMUaegnt-zBGplbKoW9i8cRfJCQiqt5wwooIGjf0bBXQj', 0, '', '', '', '', '12.00', '12.23', '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', '464bfbbade313bdcb03d8f613d719f75', '2020-01-17 16:27:36', 0, 'AD7DC633168D7ABD', '940F71', 'scaraus', 'ups_2020_dev');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `reg_price` decimal(7,2) NOT NULL,
  `sale_price` decimal(7,2) NOT NULL,
  `is_featured` int(10) NOT NULL,
  `product_sku` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `length` decimal(5,2) NOT NULL,
  `width` decimal(5,2) NOT NULL,
  `height` decimal(5,2) NOT NULL,
  `product_primary_pic` text NOT NULL,
  `categories` text NOT NULL,
  `shipping_id` int(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `description`, `reg_price`, `sale_price`, `is_featured`, `product_sku`, `quantity`, `weight`, `length`, `width`, `height`, `product_primary_pic`, `categories`, `shipping_id`, `date_added`) VALUES
(2, 'Converse ', 'Black Converse', '1.00', '0.00', 1, '123', 52, '2.00', '10.00', '2.00', '3.00', 'prod_5e25662549a6e.jpg', '[\"4\"]', 0, '2020-01-20 08:33:52'),
(3, 'Travel Backpack', 'Gray Backpack', '1.00', '0.00', 1, 'b-124', 51, '1.00', '1.00', '1.00', '1.00', 'prod_5e25669414ddc.jpg', '[\"8\"]', 0, '2020-01-20 08:36:36'),
(4, 'Brown Watch', 'Brown Watch', '1.00', '0.00', 0, 'w-123', 48, '2.00', '1.00', '1.00', '1.00', 'prod_5e2566cb79573.jpg', '[\"5\"]', 0, '2020-01-20 08:37:31'),
(5, 'Girl Pants', 'Girl Pants', '1.00', '0.00', 0, '', 48, '2.00', '2.00', '3.00', '3.00', 'prod_5e25670e4d740.jpg', '[\"7\"]', 0, '2020-01-20 08:38:38'),
(6, 'Dress', 'Girl\'s Dress', '1.00', '0.00', 1, '', 52, '1.00', '13.00', '2.00', '1.00', 'prod_5e2567707ab12.jpg', '[\"6\"]', 0, '2020-01-20 08:39:35'),
(7, 'Black Bag', '', '1.00', '0.00', 1, '', 61, '1.40', '2.00', '4.00', '8.00', 'prod_5e2567a16b09e.jpg', '[\"8\"]', 0, '2020-01-20 08:41:05'),
(8, 'Sample product', '', '23.00', '0.00', 0, '', 1, '21.90', '18.90', '19.90', '20.90', '', '[\"7\"]', 0, '2020-05-05 08:21:11');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `img_id` int(11) NOT NULL,
  `img_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`img_id`, `img_name`, `product_id`, `date_added`) VALUES
(4, 'prod_5e25677086411.jpg', 6, '2020-01-20 08:40:16'),
(5, 'prod_5e2567a179472.jpg', 7, '2020-01-20 08:41:05'),
(6, 'prod_5e2567a182fab.jpg', 7, '2020-01-20 08:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `address_unit` text NOT NULL,
  `city` text NOT NULL,
  `country` text NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `user_img` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(10) NOT NULL COMMENT '1 Admin, 2 Customers, 3 Guest',
  `data_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `address`, `address_unit`, `city`, `country`, `state`, `zip_code`, `phone`, `user_img`, `email`, `password`, `role`, `data_created`) VALUES
(2, 'Thomas', 'UU', 'Drive', 'Drive', 'La Jolla', 'US', 'CA', '92037', '7736326557', 'p_5e5a717240304.png', 'admin_shop@yopmail.com', '202cb962ac59075b964b07152d234b70', 1, '2020-01-21 12:12:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`attr_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`ps_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `attr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `ps_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
