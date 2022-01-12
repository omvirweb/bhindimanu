-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2020 at 01:11 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `bansijew`
--

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `charges_id` int(11) NOT NULL,
  `charges_name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deleted_manufacture_issue_receive`
--

CREATE TABLE `deleted_manufacture_issue_receive` (
  `id` int(11) NOT NULL,
  `manufacture_ir_id` int(11) DEFAULT NULL,
  `manufacture_id` int(11) DEFAULT NULL,
  `type_id` tinyint(1) DEFAULT NULL COMMENT '1=Issue Finish, 2 = Issue Scrap, 3= Receive Finish, 4 = Receive Scrap',
  `ir_date` date DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `job_worker_id` int(11) DEFAULT NULL,
  `remark` text,
  `pcs` double DEFAULT NULL,
  `ad_weight` double DEFAULT NULL,
  `ad_pcs` double DEFAULT NULL,
  `less` double DEFAULT NULL,
  `net_weight` double DEFAULT NULL,
  `tunch` double DEFAULT NULL,
  `fine` double DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ir_deleted_by` int(11) DEFAULT NULL,
  `ir_deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `design_no`
--

CREATE TABLE `design_no` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `design_no` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_card`
--

CREATE TABLE `job_card` (
  `job_card_id` int(11) NOT NULL,
  `job_card_no` int(11) DEFAULT NULL,
  `party_id` int(11) DEFAULT NULL,
  `melting` double DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `peck_tar` text,
  `latkan` text,
  `remark` text,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_card_items`
--

CREATE TABLE `job_card_items` (
  `job_card_item_id` int(11) NOT NULL,
  `job_card_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total_qty` double DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `total_weight` double DEFAULT NULL,
  `remark` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_card_items_designs`
--

CREATE TABLE `job_card_items_designs` (
  `job_card_item_design_id` int(11) NOT NULL,
  `job_card_item_id` int(11) DEFAULT NULL,
  `job_card_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `design_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_worker`
--

CREATE TABLE `job_worker` (
  `id` int(11) NOT NULL,
  `job_worker` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manufacture`
--

CREATE TABLE `manufacture` (
  `manufacture_id` int(11) NOT NULL,
  `job_card_id` int(11) DEFAULT NULL,
  `process_id` int(11) DEFAULT NULL,
  `remark` text,
  `close_to_calculate_loss` tinyint(1) DEFAULT NULL,
  `balance_weight` double DEFAULT NULL,
  `balance_net_weight` double DEFAULT NULL,
  `balance_fine` double DEFAULT NULL,
  `balance_pcs` double DEFAULT NULL,
  `balance_alloy` double DEFAULT NULL,
  `count_loss_on` tinyint(1) DEFAULT NULL COMMENT '1-Weight , 2-Pcs',
  `on_how_much` double DEFAULT NULL,
  `allowed_loss` double DEFAULT NULL,
  `total_receive_finish_pcs` int(11) DEFAULT NULL,
  `total_receive_finish_ad_pcs` int(11) DEFAULT NULL,
  `total_receive_finish_pcs_with_ad` int(11) DEFAULT NULL,
  `total_receive_finish_net_weight` double DEFAULT NULL,
  `total_receive_finish_ad_weight` double DEFAULT NULL,
  `total_receive_finish_net_weight_with_ad` double DEFAULT NULL,
  `total_allowed_loss` double DEFAULT NULL,
  `loss` double DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ir_deleted_by` int(11) DEFAULT NULL,
  `ir_deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manufacture_issue_receive`
--

CREATE TABLE `manufacture_issue_receive` (
  `manufacture_ir_id` int(11) NOT NULL,
  `manufacture_id` int(11) DEFAULT NULL,
  `type_id` tinyint(1) DEFAULT NULL COMMENT '1=Issue Finish, 2 = Issue Scrap, 3= Receive Finish, 4 = Receive Scrap',
  `ir_date` date DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `job_worker_id` int(11) DEFAULT NULL,
  `remark` text,
  `pcs` double DEFAULT NULL,
  `ad_weight` double DEFAULT NULL,
  `ad_pcs` double DEFAULT NULL,
  `less` double DEFAULT NULL,
  `net_weight` double DEFAULT NULL,
  `tunch` double DEFAULT NULL,
  `fine` double DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `module_roles`
--

CREATE TABLE `module_roles` (
  `module_role_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `website_module_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_roles`
--

INSERT INTO `module_roles` (`module_role_id`, `title`, `role_name`, `website_module_id`) VALUES
(1, 'view', 'view', 1),
(2, 'view', 'view', 2),
(3, 'add', 'add', 2),
(4, 'edit', 'edit', 2),
(5, 'delete', 'delete', 2),
(6, 'view', 'view', 3),
(7, 'add', 'add', 3),
(8, 'edit', 'edit', 3),
(9, 'delete', 'delete', 3),
(10, 'view', 'view', 4),
(11, 'add', 'add', 4),
(12, 'edit', 'edit', 4),
(13, 'delete', 'delete', 4),
(14, 'view', 'view', 5),
(15, 'add', 'add', 5),
(16, 'edit', 'edit', 5),
(17, 'delete', 'delete', 5),
(18, 'view', 'view', 6),
(19, 'add', 'add', 6),
(20, 'edit', 'edit', 6),
(21, 'delete', 'delete', 6),
(26, 'view', 'view', 8),
(27, 'add', 'add', 8),
(28, 'edit', 'edit', 8),
(29, 'delete', 'delete', 8),
(30, 'allow', 'allow', 9),
(31, 'view', 'view', 10),
(32, 'add', 'add', 10),
(33, 'edit', 'edit', 10),
(34, 'delete', 'delete', 10),
(35, 'view', 'view', 11),
(36, 'add', 'add', 11),
(37, 'edit', 'edit', 11),
(38, 'delete', 'delete', 11),
(39, 'view', 'view', 12),
(40, 'view', 'view', 13),
(41, 'allow', 'allow', 14),
(42, 'view', 'view', 15),
(43, 'add', 'add', 15),
(44, 'edit', 'edit', 15),
(45, 'delete', 'delete', 15),
(46, 'view', 'view', 16),
(47, 'add', 'add', 16),
(48, 'edit', 'edit', 16),
(49, 'delete', 'delete', 16);

-- --------------------------------------------------------

--
-- Table structure for table `moti`
--

CREATE TABLE `moti` (
  `moti_id` int(11) NOT NULL,
  `moti_name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `party`
--

CREATE TABLE `party` (
  `party_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text,
  `mobile_no` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `process_item_labor`
--

CREATE TABLE `process_item_labor` (
  `id` int(11) NOT NULL,
  `process_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `labor` double DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `process_master`
--

CREATE TABLE `process_master` (
  `id` int(11) NOT NULL,
  `process_name` varchar(255) DEFAULT NULL,
  `print_columns` text COMMENT 'comma separated ',
  `sequence` tinyint(6) DEFAULT NULL,
  `count_loss_on` tinyint(1) DEFAULT NULL COMMENT '1-Weight , 2-Pcs',
  `on_how_much` double DEFAULT NULL,
  `allowed_loss` double DEFAULT NULL,
  `labor_on` tinyint(1) DEFAULT NULL COMMENT '1-Pcs, 2-AD Pcs',
  `labor_on_how_much` double DEFAULT NULL,
  `labor_all_item` double DEFAULT NULL COMMENT 'If any item have not labor then use this',
  `delete_allow` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 = Not allow, 1 = Allow',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_pass` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `user_name`, `user_email`, `user_pass`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, NULL, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_role_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `website_module_id` int(11) DEFAULT NULL,
  `role_type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_role_id`, `user_id`, `website_module_id`, `role_type_id`) VALUES
(349, 1, 1, 1),
(350, 1, 9, 30);

-- --------------------------------------------------------

--
-- Table structure for table `website_modules`
--

CREATE TABLE `website_modules` (
  `website_module_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `main_module` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `website_modules`
--

INSERT INTO `website_modules` (`website_module_id`, `title`, `main_module`) VALUES
(1, 'Master', '1'),
(2, 'Master >> Party', '1.1'),
(3, 'Master >> Item', '1.2'),
(4, 'Master >> Design No', '1.3'),
(5, 'Master >> Process Master', '1.4'),
(6, 'Master >> Job Worker', '1.5'),
(8, 'Master >> User', '1.7'),
(9, 'Master >> User Rights', '1.8'),
(10, 'Job Cart Entry', '2'),
(11, 'Manufacture', '3'),
(12, 'Report', '9'),
(13, 'Report >> Ad Pcs Report', '9.1'),
(14, 'Backup', '10'),
(15, 'Master >> Moti', '1.6'),
(16, 'Master >> Charges', '1.6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`charges_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `deleted_manufacture_issue_receive`
--
ALTER TABLE `deleted_manufacture_issue_receive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `job_worker_id` (`job_worker_id`),
  ADD KEY `job_worker_id_2` (`job_worker_id`);

--
-- Indexes for table `design_no`
--
ALTER TABLE `design_no`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `job_card`
--
ALTER TABLE `job_card`
  ADD PRIMARY KEY (`job_card_id`),
  ADD KEY `party_id` (`party_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `job_card_items`
--
ALTER TABLE `job_card_items`
  ADD PRIMARY KEY (`job_card_item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `job_card_items_designs`
--
ALTER TABLE `job_card_items_designs`
  ADD PRIMARY KEY (`job_card_item_design_id`),
  ADD KEY `design_id` (`design_id`);

--
-- Indexes for table `job_worker`
--
ALTER TABLE `job_worker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `manufacture`
--
ALTER TABLE `manufacture`
  ADD PRIMARY KEY (`manufacture_id`),
  ADD KEY `process_id` (`process_id`),
  ADD KEY `job_card_id` (`job_card_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `manufacture_issue_receive`
--
ALTER TABLE `manufacture_issue_receive`
  ADD PRIMARY KEY (`manufacture_ir_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `job_worker_id` (`job_worker_id`);

--
-- Indexes for table `module_roles`
--
ALTER TABLE `module_roles`
  ADD PRIMARY KEY (`module_role_id`);

--
-- Indexes for table `moti`
--
ALTER TABLE `moti`
  ADD PRIMARY KEY (`moti_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `party`
--
ALTER TABLE `party`
  ADD PRIMARY KEY (`party_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `process_item_labor`
--
ALTER TABLE `process_item_labor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `process_master`
--
ALTER TABLE `process_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_role_id`);

--
-- Indexes for table `website_modules`
--
ALTER TABLE `website_modules`
  ADD PRIMARY KEY (`website_module_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `charges`
--
ALTER TABLE `charges`
  MODIFY `charges_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deleted_manufacture_issue_receive`
--
ALTER TABLE `deleted_manufacture_issue_receive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `design_no`
--
ALTER TABLE `design_no`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_card`
--
ALTER TABLE `job_card`
  MODIFY `job_card_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_card_items`
--
ALTER TABLE `job_card_items`
  MODIFY `job_card_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_card_items_designs`
--
ALTER TABLE `job_card_items_designs`
  MODIFY `job_card_item_design_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_worker`
--
ALTER TABLE `job_worker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manufacture`
--
ALTER TABLE `manufacture`
  MODIFY `manufacture_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manufacture_issue_receive`
--
ALTER TABLE `manufacture_issue_receive`
  MODIFY `manufacture_ir_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module_roles`
--
ALTER TABLE `module_roles`
  MODIFY `module_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `moti`
--
ALTER TABLE `moti`
  MODIFY `moti_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `party`
--
ALTER TABLE `party`
  MODIFY `party_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `process_item_labor`
--
ALTER TABLE `process_item_labor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `process_master`
--
ALTER TABLE `process_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=351;

--
-- AUTO_INCREMENT for table `website_modules`
--
ALTER TABLE `website_modules`
  MODIFY `website_module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `design_no`
--
ALTER TABLE `design_no`
  ADD CONSTRAINT `Fk_UserIddesign_no` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `Fk_ItemUserId` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `job_card`
--
ALTER TABLE `job_card`
  ADD CONSTRAINT `Fk_JobCardParty` FOREIGN KEY (`party_id`) REFERENCES `party` (`party_id`),
  ADD CONSTRAINT `Fk_UserIdjob_card` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `job_card_items`
--
ALTER TABLE `job_card_items`
  ADD CONSTRAINT `Fk_JobCardItem` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

--
-- Constraints for table `job_card_items_designs`
--
ALTER TABLE `job_card_items_designs`
  ADD CONSTRAINT `Fk_JobcardItemDesignId` FOREIGN KEY (`design_id`) REFERENCES `design_no` (`id`);

--
-- Constraints for table `job_worker`
--
ALTER TABLE `job_worker`
  ADD CONSTRAINT `Fk_UserIdjob_worker` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `manufacture`
--
ALTER TABLE `manufacture`
  ADD CONSTRAINT `Fk_ManufactureJobCardId` FOREIGN KEY (`job_card_id`) REFERENCES `job_card` (`job_card_id`),
  ADD CONSTRAINT `Fk_ManufactureProcessId` FOREIGN KEY (`process_id`) REFERENCES `process_master` (`id`),
  ADD CONSTRAINT `Fk_manufacture_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `manufacture_issue_receive`
--
ALTER TABLE `manufacture_issue_receive`
  ADD CONSTRAINT `Fk_ManufactureItem` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`),
  ADD CONSTRAINT `Fk_ManufactureWorkerId` FOREIGN KEY (`job_worker_id`) REFERENCES `job_worker` (`id`);

--
-- Constraints for table `party`
--
ALTER TABLE `party`
  ADD CONSTRAINT `Fk_UserIdparty` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `process_master`
--
ALTER TABLE `process_master`
  ADD CONSTRAINT `Fk_process_masterUserId` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`);
COMMIT;
