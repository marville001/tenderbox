-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2021 at 08:59 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tenderbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `approved`
--

CREATE TABLE `approved` (
  `product` varchar(250) NOT NULL,
  `supplier` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE `bid` (
  `id` int(11) NOT NULL,
  `tender_id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `supplier_address` varchar(100) NOT NULL,
  `supplier_email` varchar(100) NOT NULL,
  `supplier_contact` varchar(100) NOT NULL,
  `supplier_location` varchar(100) NOT NULL,
  `supplier_desc` varchar(250) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`id`, `tender_id`, `supplier_name`, `status`, `supplier_address`, `supplier_email`, `supplier_contact`, `supplier_location`, `supplier_desc`, `supplier_id`) VALUES
(42, 26, 'Supplier One Company Limited', NULL, '347 Nyeri 101000', 'supplierone@gmail.com', '+2547023456789', 'Nyeri, Kenya', 'We offer table based company resources for all kind of business', 23),
(43, 22, 'Supplier One', NULL, '347 Murang\'a', 'supplierone@gmail.com', '0123456789', 'Nyeri, Kenya', 'We offer table based company resources for all kind of business', 23),
(44, 27, 'Supplier One', NULL, '347 Murang\'a', 'supplierone@gmail.com', '0123456789', 'Nyeri, Kenya', 'We offer table based company resources for all kind of business', 23),
(45, 27, 'Supplier Three', NULL, 'Wjhdjhjh fjf', 'supplierthree@gmail.com', '3456782822', 'Kinangop\'', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos temporibus similique consequuntur nobis deleniti illum aliquid numquam reiciendis commodi ipsam.', 25),
(46, 27, 'Supplier Two', NULL, 'Address 256', 'suppliertwo@gmail.com', '058787837676', 'Kimathi', 'We nered the tender please', 24);

-- --------------------------------------------------------

--
-- Table structure for table `bid_details`
--

CREATE TABLE `bid_details` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `tender_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'open',
  `duration` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bid_details`
--

INSERT INTO `bid_details` (`id`, `amount`, `tender_id`, `supplier_id`, `status`, `duration`) VALUES
(1, 120000, 22, 23, 'open', '18 months'),
(2, 250000, 27, 23, 'approved', '15 months'),
(3, 2000000, 27, 25, 'rejected', '7 years'),
(4, 256000, 27, 24, 'rejected', '2 years');

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE `organisation` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organisation`
--

INSERT INTO `organisation` (`id`, `name`, `email`, `password`) VALUES
(20, 'The Mars', 'org@themars.co.ke', 'e10adc3949ba59abbe56e057f20f883e'),
(21, 'Dedan Kimathi University', 'dekut@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(22, 'starhotel', 'starhotel@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(23, 'Organization one', 'organizationone@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `otherdocs`
--

CREATE TABLE `otherdocs` (
  `id` int(11) NOT NULL,
  `document` varchar(100) NOT NULL,
  `tender_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `otherdocs`
--

INSERT INTO `otherdocs` (`id`, `document`, `tender_id`, `supplier_id`, `name`) VALUES
(2, '1633940189tender1.pdf', 22, 23, 'kra_pin'),
(3, '163394025320th July.docx', 22, 23, 'bank_statement'),
(4, '1633946272Nursing Quality Indicator.pdf', 27, 23, 'doc_5'),
(5, '1633946279Nursing Quality Indicator.pdf', 27, 23, 'doc_4'),
(6, '1633946286Nursing Quality Indicator.pdf', 27, 23, 'doc_2'),
(7, '1633946291Nursing Quality Indicator.pdf', 27, 23, 'doc_1'),
(8, '1633946297Nursing Quality Indicator.pdf', 27, 23, 'doc_3'),
(9, '1634115173tcc.pdf', 27, 24, 'doc_2');

-- --------------------------------------------------------

--
-- Table structure for table `required_documents`
--

CREATE TABLE `required_documents` (
  `id` int(11) NOT NULL,
  `tender_id` int(11) NOT NULL,
  `document` varchar(100) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `required_documents`
--

INSERT INTO `required_documents` (`id`, `tender_id`, `document`, `marks`) VALUES
(1, 22, 'KRA PIN', 5),
(2, 22, 'Bank Statement', 10),
(3, 27, 'Doc 2', 5),
(4, 27, 'Doc 1', 3),
(5, 27, 'Doc 4', 10),
(6, 27, 'Doc 3', 3),
(7, 27, 'Doc 5', 5);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `startyear` int(11) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `email`, `password`, `phone`, `startyear`, `description`, `type`) VALUES
(22, 'The Wallers', 'wallers@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '+545463207054', 2013, 'We are the best selling company', 'public'),
(23, 'Supplier One', 'supplierone@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0123456789', 2007, 'We offer table based company resources for all kind of business', 'public'),
(24, 'Supplier Two', 'suppliertwo@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 0, '', ''),
(25, 'Supplier Three', 'supplierthree@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '3456782822', 2016, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos temporibus similique consequuntur nobis deleniti illum aliquid numquam reiciendis commodi ipsam.', 'private');

-- --------------------------------------------------------

--
-- Table structure for table `tender`
--

CREATE TABLE `tender` (
  `id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `tendername` varchar(250) NOT NULL,
  `minbudget` varchar(250) NOT NULL,
  `maxbudget` varchar(255) NOT NULL,
  `period` varchar(250) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `tenderno` varchar(200) NOT NULL,
  `opendate` date NOT NULL,
  `closedate` date NOT NULL,
  `tenderdoc` varchar(200) NOT NULL,
  `sector` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `enddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tender`
--

INSERT INTO `tender` (`id`, `org_id`, `tendername`, `minbudget`, `maxbudget`, `period`, `description`, `tenderno`, `opendate`, `closedate`, `tenderdoc`, `sector`, `category`, `enddate`) VALUES
(22, 21, 'Supply of Construction Wires', '90000', '150000', '12', 'We need supply of wires for our new building starting next month. If you can make it please submit a proposal through this website and we will take a look at it', 'T115-Z-2021-09-06-1630953295', '2021-09-08', '2021-09-30', '1630954512learn-tailwind-pdf.pdf', 'Public', 'Infrastructure-Building', '2022-09-30'),
(23, 21, 'Desks and Chairs', '23000', '45000', '20', 'Enter your industry/sector keywords and hit enter to find the open tenders you can apply for. You can also filter based on category, procuring entity, procurement method and even AGPO tenders.', 'T92-M-2021-09-07-1630997597', '2021-09-15', '2021-09-29', '1630997655Fr. Mathenge Memorial.pdf', 'Church', 'Consultancy--Health', '2021-09-22'),
(24, 21, 'desktop tender', '23000', '45000', '3', 'Enter your industry/sector keywords and hit enter to find the open tenders you can apply for. You can also filter based on category, procuring entity, procurement method and even AGPO tenders.\r\n\r\n', 'T94-Z-2021-09-07-1630997835', '2021-08-30', '2021-09-01', '1630997917Antisocial Personality Disorder.docx', 'Private', 'Consultancy--Health', '2021-12-09'),
(25, 23, 'Supply of Office Chairs', '90000', '300000', '18', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos temporibus similique consequuntur nobis deleniti illum aliquid numquam reiciendis commodi ipsam.', 'T199-Z-2021-09-12-1631440305', '2021-09-15', '2021-09-30', '1631440409Annotation Example.docx', 'Parastatal', 'Industry---Furniture', '2023-02-22'),
(26, 23, 'Lorem ipsum dolor sit amet consecte', '30000', '100000', '12', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos temporibus similique consequuntur nobis deleniti illum aliquid numquam reiciendis commodi ipsam.', 'T62-V-2021-09-12-1631440413', '2021-10-08', '2021-10-28', '1631440459Annotation Example.docx', 'Water-Company', 'Consultancy--Tourism', '2022-06-30'),
(27, 21, 'Testing Tender', '100000', '300000', '23', 'We need this and that for they and those in here and there ', 'T77-X-2021-10-11-1633942656', '2021-10-19', '2021-10-27', '1633942724tender1.pdf', 'Public', 'Consultancy--Oil-AND-Gas', '2021-10-20');

-- --------------------------------------------------------

--
-- Table structure for table `tenderdocs`
--

CREATE TABLE `tenderdocs` (
  `id` int(11) NOT NULL,
  `doc` varchar(100) NOT NULL,
  `tender_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tenderdocs`
--

INSERT INTO `tenderdocs` (`id`, `doc`, `tender_id`, `supplier_id`) VALUES
(3, '1633768395MagPi109v2.pdf', 22, 23),
(4, '1633946210tender1.pdf', 27, 23),
(5, '1634106210tender1.pdf', 27, 24),
(6, '1634116787tcc.pdf', 27, 25);

-- --------------------------------------------------------

--
-- Table structure for table `tendermdocs`
--

CREATE TABLE `tendermdocs` (
  `id` int(11) NOT NULL,
  `kra_pin` varchar(100) NOT NULL,
  `coi` varchar(100) NOT NULL,
  `cor` varchar(100) NOT NULL,
  `tcc` varchar(100) NOT NULL,
  `c_act` varchar(100) NOT NULL,
  `ctl` varchar(100) NOT NULL,
  `tender_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tendermdocs`
--

INSERT INTO `tendermdocs` (`id`, `kra_pin`, `coi`, `cor`, `tcc`, `c_act`, `ctl`, `tender_id`, `supplier_id`) VALUES
(2, '1633771281Kra_pin.pdf', '1633771281coi.pdf', '1633771281cor.pdf', '1633771281tcc.pdf', '1633771281c_act.pdf', '1633771281ctl.pdf', 22, 23),
(3, '1633946239Kra_pin.pdf', '1633946239coi.pdf', '1633946239cor.pdf', '1633946239tcc.pdf', '1633946239c_act.pdf', '1633946239ctl.pdf', 27, 23),
(4, '1634115158Kra_pin.pdf', '1634115158coi.pdf', '1634115158cor.pdf', '1634115158tcc.pdf', '1634115158c_act.pdf', '1634115158ctl.pdf', 27, 24),
(5, '1634116835Kra_pin.pdf', '1634116835coi.pdf', '1634116835cor.pdf', '1634116835tcc.pdf', '1634116835c_act.pdf', '1634116835ctl.pdf', 27, 25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bid_details`
--
ALTER TABLE `bid_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organisation`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `otherdocs`
--
ALTER TABLE `otherdocs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `required_documents`
--
ALTER TABLE `required_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tender`
--
ALTER TABLE `tender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenderdocs`
--
ALTER TABLE `tenderdocs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tendermdocs`
--
ALTER TABLE `tendermdocs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bid`
--
ALTER TABLE `bid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `bid_details`
--
ALTER TABLE `bid_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `organisation`
--
ALTER TABLE `organisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `otherdocs`
--
ALTER TABLE `otherdocs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `required_documents`
--
ALTER TABLE `required_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tender`
--
ALTER TABLE `tender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tenderdocs`
--
ALTER TABLE `tenderdocs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tendermdocs`
--
ALTER TABLE `tendermdocs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
