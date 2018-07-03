-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2018 at 12:45 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `phone` varchar(175) NOT NULL,
  `purpose` text NOT NULL,
  `choice` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `name`, `age`, `phone`, `purpose`, `choice`, `address`, `time`) VALUES
(1, 'Akash Singh', 25, '9557741705', '', '', '', '2018-02-13 19:09:43'),
(2, 'Ashutosh khurana', 25, '9687452158', '', '', '', '2018-02-15 18:13:38'),
(3, 'Siddharth godela', 23, '9685231542', '', '', '', '2018-02-26 17:45:39');

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` int(11) NOT NULL,
  `sr` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `dosage` text NOT NULL,
  `precautions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `sr`, `name`, `price`, `quantity`, `description`, `deleted`, `dosage`, `precautions`) VALUES
(14, 'Br-101', 'Paracetamol', '1', '600', 'Idle for body pain and Cold relief(Doctor prescription required)', 0, '', ''),
(16, 'F-45', 'Dristan (5mg/2mg/30mg/325mg)  Tablet', '1', '582', 'Phenylephrine Hydrochloride 5mg+Chlorpheniramine Maleate 2mg+Anhydrous caffeine 30mg+Acetylsalicylic Acid 325mg', 0, '', ''),
(17, 'Cipla-102', ' Synthivan (300mg/100mg)  Tablet', '300', '150', 'Initial &ndash; Adult- the recommended dose is 300 mg with ritonavir 100 mg once daily as single dose. \r\nThe recommended dose is 400 mg (without ritonavir) once daily.', 0, '', ''),
(18, 'Olcare-222', ' Olcarbos  Tablet', '4', '693', 'Type 2 diabetes in a dose of 25 to 100 mg three times a day', 0, '', ''),
(19, '3050', ' Diabose (50mg)  Tablet', '7', '552', 'Micro Labs Ltd (Cardicare)\r\nGeneric : Acarbose\r\nStore it at room temperature in a tight container. Protect from moisture.\r\n&bull; Charcoal and digestive enzymes may decrease the effect of acarbose when taken together.', 0, 'Type 2 diabetes in a dose of 25 to 100 mg three times a day.\r\nTablet to take by mouth, just before the first bite of each meal.\r\n', 'Known allergy to acarbose \r\nDiabetic ketoacidosis \r\nSevere liver disease \r\nIntestinal conditions like inflammatory bowel disease \r\nSevere kidney disease\r\n&bull; Use with caution during pregnancy and breastfeeding.\r\n&bull; Avoid alcohol intake as it leads to low blood sugar level.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(175) NOT NULL,
  `address` text NOT NULL,
  `sex` varchar(20) NOT NULL,
  `doa` date NOT NULL,
  `ward` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `discharge` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `token`, `name`, `dob`, `phone`, `address`, `sex`, `doa`, `ward`, `deleted`, `discharge`) VALUES
(1, '0001', 'Shubham Dobriyal', '1996-06-06', '9557741705', 'Dehradun', 'male', '2017-07-19', '13', 0, '2018-02-17'),
(4, '0002', 'Akash Singh', '1996-10-12', '9678452102', 'Indore', 'Male', '2017-12-15', '003', 0, '0000-00-00'),
(5, '213', 'Asmita mandal', '1995-04-03', '9874854789', 'Kolkata', 'Male', '2017-12-03', '124', 1, '2018-02-17'),
(6, '0025', 'Richa Munola', '1994-06-03', '9874852154', 'Pithoragarh', 'Male', '2017-12-12', 'CH101', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `phone` varchar(120) NOT NULL,
  `email` varchar(255) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `permissions` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `address` text NOT NULL,
  `sex` varchar(40) NOT NULL,
  `image` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `age`, `phone`, `email`, `speciality`, `permissions`, `deleted`, `address`, `sex`, `image`, `password`, `last_login`) VALUES
(5, 'Avneet Kaur', 21, '9874852154', 'virkavneet58@gmail.com', 'Physician', 'admin,staff', 0, 'Haldwani Uttrakhand', 'Male', '', 'avneet', '2018-03-08 18:28:42'),
(33, 'Shubham Dobriyal', 22, '9557741705', 'shubham.dobriyal.123@gmail.com', 'Cardiologist', 'admin,staff', 0, 'Dehradun', 'Male', '/hospital/images/staff/42bfc1225002740450fe92416167b5af.jpg', 'shubham', '2018-03-15 10:47:47'),
(34, 'Alexandre debieve', 74, '9635821078', 'alex@gmail.com', 'Neurologist', 'staff', 0, 'West bengal', 'Male', '/hospital/images/staff/41b4b7c8e699a54edb3e8d67f0f22c16.jpg', 'alex', '2018-03-08 18:40:29'),
(35, 'Brooke cagle', 39, '8965471254', 'bkcage@gmail.com', 'Physician', 'staff', 0, 'New Delhi', 'Male', '/hospital/images/staff/84bbb4f058b962438a17a8d4bd31940d.jpg', 'cage', '0000-00-00 00:00:00'),
(36, 'David lew', 64, '963256324', 'lewD@gmail.com', 'Cardiologist', 'staff', 0, 'New delhi', 'Male', '/hospital/images/staff/67c1a92b74ace9ba9b32f95c9d9d8c25.jpeg', 'lew', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `seller` varchar(255) NOT NULL,
  `buyer` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `dosage` text NOT NULL,
  `precautions` text NOT NULL,
  `sell_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sr` varchar(255) NOT NULL,
  `transid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `name`, `price`, `quantity`, `seller`, `buyer`, `phone`, `address`, `description`, `dosage`, `precautions`, `sell_date`, `sr`, `transid`) VALUES
(3, 'Paracetamol', '1', '6', 'Shubham Dobriyal', 'Ashish singh', '9875825412', 'Haldwani', 'Idle for body pain and Cold relief(Doctor prescription required)', '', '', '2018-02-24 19:24:49', 'Br-101', 'QG39BiuVeemNG'),
(4, 'Paracetamol', '1', '6', 'Shubham Dobriyal', 'Ashish singh', '9875825412', 'Haldwani', 'Idle for body pain and Cold relief(Doctor prescription required)', '', '', '2018-02-24 19:25:58', 'Br-101', 'ait5tTfXdi8D2'),
(5, 'Paracetamol', '1', '6', 'Shubham Dobriyal', 'Ashish singh', '9875825412', 'Haldwani', 'Idle for body pain and Cold relief(Doctor prescription required)', '', '', '2018-02-24 19:31:03', 'Br-101', 'iNvMwg2odseFy'),
(6, 'Paracetamol', '1', '6', 'Shubham Dobriyal', 'Ashish singh', '9875825412', 'Haldwani', 'Idle for body pain and Cold relief(Doctor prescription required)', '', '', '2018-02-24 19:31:23', 'Br-101', 'YQtQTPuW0rBNM'),
(7, 'Paracetamol', '1', '6', 'Shubham Dobriyal', 'Ashish singh', '9875825412', 'Haldwani', 'Idle for body pain and Cold relief(Doctor prescription required)', '', '', '2018-02-24 19:38:16', 'Br-101', 'wU8Nud0VX6T4v'),
(8, 'Paracetamol', '1', '6', 'Shubham Dobriyal', 'Ashish singh', '9875825412', 'Haldwani', 'Idle for body pain and Cold relief(Doctor prescription required)', '', '', '2018-02-24 19:41:04', 'Br-101', '0w87u3zkwlnY5'),
(9, 'Dristan (5mg/2mg/30mg/325mg)  Tablet', '26', '26', 'Shubham Dobriyal', 'Ashish singh', '9875825412', 'Haldwani', 'Phenylephrine Hydrochloride 5mg+Chlorpheniramine Maleate 2mg+Anhydrous caffeine 30mg+Acetylsalicylic Acid 325mg', '', '', '2018-02-25 17:34:50', 'F-45', '6tIx32M1l07px'),
(10, ' Diabose (50mg)  Tablet', '77', '11', 'Avneet kaur', 'Abhishek mehra', '9632221547', 'Karol Bagh \r\nDelhi', 'Micro Labs Ltd (Cardicare)\r\nGeneric : Acarbose\r\nStore it at room temperature in a tight container. Protect from moisture.\r\n&bull; Charcoal and digestive enzymes may decrease the effect of acarbose when taken together.', 'Type 2 diabetes in a dose of 25 to 100 mg three times a day.\r\nTablet to take by mouth, just before the first bite of each meal.\r\n', 'Known allergy to acarbose \r\nDiabetic ketoacidosis \r\nSevere liver disease \r\nIntestinal conditions like inflammatory bowel disease \r\nSevere kidney disease\r\n&bull; Use with caution during pregnancy and breastfeeding.\r\n&bull; Avoid alcohol intake as it leads to low blood sugar level.\r\n', '2018-02-25 17:45:46', '3050', 'kT90JVFrT0LQ1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sr` (`sr`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transid` (`transid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
