-- Avinash : 2020_12_15 05:00 PM
INSERT INTO `website_modules` (`website_module_id`, `title`, `main_module`) VALUES (17, 'Payment / Receipt', '4');
INSERT INTO `module_roles` (`module_role_id`, `title`, `role_name`, `website_module_id`) VALUES (NULL, 'view', 'view', 17), (NULL, 'add', 'add', 17), (NULL, 'edit', 'edit', 17), (NULL, 'delete', 'delete', 17);

-- Avinash : 2020_12_15 06:15 PM
ALTER TABLE `job_card_items` ADD `item_photo` VARCHAR(255) NULL DEFAULT NULL AFTER `remark`;

DROP TABLE `deleted_manufacture_issue_receive`;

-- --------------------------------------------------------
--
-- Table structure for table `payment_receipt`
--

CREATE TABLE `payment_receipt` (
  `payment_receipt_id` int(11) NOT NULL,
  `job_worker_id` int(11) DEFAULT NULL,
  `payment_receipt_date` date DEFAULT NULL,
  `remark` text,
  `item_id` int(11) DEFAULT NULL,
  `weight_jama_udhar` int(1) DEFAULT NULL COMMENT '1 = Jama 2 = Udhar',
  `weight` double NOT NULL DEFAULT '0',
  `touch` double NOT NULL DEFAULT '0',
  `fine` double NOT NULL DEFAULT '0',
  `amount_jama_udhar` int(1) NOT NULL COMMENT '1 = Jama 2 = Udhar',
  `amount` double DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `payment_receipt`
--
ALTER TABLE `payment_receipt`
  ADD PRIMARY KEY (`payment_receipt_id`);

--
-- AUTO_INCREMENT for table `payment_receipt`
--
ALTER TABLE `payment_receipt`
  MODIFY `payment_receipt_id` int(11) NOT NULL AUTO_INCREMENT;

-- Avinash : 2020_12_17 07:30 PM
DROP TABLE `process_item_labor`;
ALTER TABLE `process_master` DROP `count_loss_on`, DROP `labor_on`, DROP `labor_on_how_much`, DROP `labor_all_item`;

-- Avinash : 2020_12_18 09:45 AM
ALTER TABLE `process_master` ADD `process_issue_fields` TEXT NOT NULL COMMENT 'Comma Separated' AFTER `allowed_loss`, ADD `process_receive_fields` TEXT NOT NULL COMMENT 'Comma Separated' AFTER `process_issue_fields`;
INSERT INTO `process_master` (`id`, `process_name`, `print_columns`, `sequence`, `on_how_much`, `allowed_loss`, `process_issue_fields`, `process_receive_fields`, `delete_allow`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'KAARIGAR', '', 1, NULL, NULL, 'pif_wastage,pif_stone_pcs,pif_stone_wt', 'prf_wastage,prf_stone_pcs,prf_stone_wt', 0, '2020-12-18 05:42:59', 1, '2020-12-18 14:46:40', 1),
(2, 'POLISH', '', 2, 100, 0.3, '', 'prf_loss,prf_loss_fine,prf_allowed_loss', 0, '2020-12-18 05:44:29', 1, '2020-12-18 14:46:40', 1),
(3, 'SETTINGS', '', 3, 100, NULL, 'pif_ad_weight,pif_ad_pcs', 'prf_ad_weight,prf_ad_pcs,prf_loss,prf_loss_fine,prf_allowed_loss', 0, '2020-12-18 05:54:12', 1, '2020-12-18 14:46:40', 1),
(4, 'MEENA', '', 4, 100, 4.5, '', 'prf_before_meena,prf_meena_wt,prf_other_charges,prf_loss,prf_loss_fine,prf_allowed_loss', 0, '2020-12-18 06:06:45', 1, '2020-12-18 14:46:40', 1),
(5, 'JADTAR', '', 5, NULL, NULL, '', 'prf_item_weight,prf_kundan,prf_sm,prf_stone_pcs,prf_stone_charges,prf_other_charges', 0, '2020-12-18 06:08:48', 1, '2020-12-18 14:46:40', 1),
(6, 'BANDHANU', '', 6, NULL, NULL, 'pif_v_pcs,pif_moti,pif_moti_amount', 'prf_vetran,prf_v_pcs,prf_moti,prf_moti_amount,prf_other_charges', 0, '2020-12-18 06:17:24', 1, '2020-12-18 14:46:40', 1);

ALTER TABLE `manufacture` DROP `balance_weight`, DROP `balance_net_weight`, DROP `balance_fine`, DROP `balance_pcs`, DROP `balance_alloy`, DROP `count_loss_on`, DROP `on_how_much`, DROP `allowed_loss`, DROP `total_receive_finish_pcs`, DROP `total_receive_finish_ad_pcs`, DROP `total_receive_finish_pcs_with_ad`, DROP `total_receive_finish_net_weight`, DROP `total_receive_finish_ad_weight`, DROP `total_receive_finish_net_weight_with_ad`, DROP `total_allowed_loss`, DROP `loss`;
ALTER TABLE `manufacture_issue_receive` ADD `job_card_id` INT(11) NULL DEFAULT NULL AFTER `manufacture_id`, ADD `process_id` INT(11) NULL DEFAULT NULL AFTER `job_card_id`;
ALTER TABLE `manufacture_issue_receive` DROP `weight`;
ALTER TABLE `manufacture_issue_receive` DROP `remark`, DROP `pcs`, DROP `ad_weight`, DROP `ad_pcs`, DROP `less`, DROP `net_weight`, DROP `tunch`;
ALTER TABLE `manufacture_issue_receive` ADD `gross` DOUBLE NULL DEFAULT NULL AFTER `job_worker_id`, ADD `touch` DOUBLE NULL DEFAULT NULL AFTER `gross`, ADD `wastage` DOUBLE NULL DEFAULT NULL AFTER `touch`;
ALTER TABLE `manufacture_issue_receive`  ADD `ad_weight` DOUBLE NULL DEFAULT NULL  AFTER `fine`,  ADD `ad_pcs` DOUBLE NULL DEFAULT NULL  AFTER `ad_weight`,  ADD `before_meena` DOUBLE NULL DEFAULT NULL  AFTER `ad_pcs`,  ADD `meena_wt` DOUBLE NULL DEFAULT NULL  AFTER `before_meena`,  ADD `item_weight` DOUBLE NULL DEFAULT NULL  AFTER `meena_wt`,  ADD `kundan` DOUBLE NULL DEFAULT NULL  AFTER `item_weight`,  ADD `sm` DOUBLE NULL DEFAULT NULL  AFTER `kundan`,  ADD `vetran` DOUBLE NULL DEFAULT NULL  AFTER `sm`,  ADD `v_pcs` DOUBLE NULL DEFAULT NULL  AFTER `vetran`,  ADD `stone_pcs` DOUBLE NULL DEFAULT NULL  AFTER `v_pcs`,  ADD `stone_weight` DOUBLE NULL DEFAULT NULL  AFTER `stone_pcs`,  ADD `stone_charges` DOUBLE NULL DEFAULT NULL  AFTER `stone_weight`,  ADD `moti` DOUBLE NULL DEFAULT NULL  AFTER `stone_charges`,  ADD `moti_amount` DOUBLE NULL DEFAULT NULL  AFTER `moti`,  ADD `other_charges` DOUBLE NULL DEFAULT NULL  AFTER `moti_amount`,  ADD `loss` DOUBLE NULL DEFAULT NULL  AFTER `other_charges`,  ADD `loss_fine` DOUBLE NULL DEFAULT NULL  AFTER `loss`,  ADD `item_remark` TEXT NULL DEFAULT NULL  AFTER `loss_fine`;
ALTER TABLE `manufacture_issue_receive` ADD `image` VARCHAR(255) NULL DEFAULT NULL AFTER `item_remark`;

-- --------------------------------------------------------
-- Table structure for table `manufacture_ir_stone_pcs_details`
--

CREATE TABLE `manufacture_ir_stone_pcs_details` (
  `stone_pcs_details_id` int(11) NOT NULL,
  `manufacture_id` int(11) DEFAULT NULL,
  `manufacture_ir_id` int(11) DEFAULT NULL,
  `stone_detail_pcs` double DEFAULT NULL,
  `stone_detail_weight` double DEFAULT NULL,
  `stone_detail_rate` double DEFAULT NULL,
  `stone_detail_amount` double DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `manufacture_ir_stone_pcs_details`
--
ALTER TABLE `manufacture_ir_stone_pcs_details`
  ADD PRIMARY KEY (`stone_pcs_details_id`);

--
-- AUTO_INCREMENT for table `manufacture_ir_stone_pcs_details`
--
ALTER TABLE `manufacture_ir_stone_pcs_details`
  MODIFY `stone_pcs_details_id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------
-- Table structure for table `manufacture_ir_moti_details`
--

CREATE TABLE `manufacture_ir_moti_details` (
  `moti_details_id` int(11) NOT NULL,
  `manufacture_id` int(11) DEFAULT NULL,
  `manufacture_ir_id` int(11) DEFAULT NULL,
  `moti_id` int(11) DEFAULT NULL,
  `moti_weight` double DEFAULT NULL,
  `moti_rate` double DEFAULT NULL,
  `moti_detail_amount` double DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `manufacture_ir_moti_details`
--
ALTER TABLE `manufacture_ir_moti_details`
  ADD PRIMARY KEY (`moti_details_id`);

--
-- AUTO_INCREMENT for table `manufacture_ir_moti_details`
--
ALTER TABLE `manufacture_ir_moti_details`
  MODIFY `moti_details_id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------
-- Table structure for table `manufacture_ir_other_charges_details`
--

CREATE TABLE `manufacture_ir_other_charges_details` (
  `other_charges_details_id` int(11) NOT NULL,
  `manufacture_id` int(11) DEFAULT NULL,
  `manufacture_ir_id` int(11) DEFAULT NULL,
  `charges_id` int(11) DEFAULT NULL,
  `charges_amount` double DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `manufacture_ir_other_charges_details`
--
ALTER TABLE `manufacture_ir_other_charges_details`
  ADD PRIMARY KEY (`other_charges_details_id`);

--
-- AUTO_INCREMENT for table `manufacture_ir_other_charges_details`
--
ALTER TABLE `manufacture_ir_other_charges_details`
  MODIFY `other_charges_details_id` int(11) NOT NULL AUTO_INCREMENT;

-- Avinash : 2020_12_22 12:20 PM
INSERT INTO `item` (`item_id`, `item_name`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(5, 'Vetran', 1, '2020-12-21 12:07:21', 1, '2020-12-21 12:07:21');

-- Avinash : 2020_12_22 07:30 PM
-- --------------------------------------------------------
-- Table structure for table `item_stock`
--

CREATE TABLE `item_stock` (
  `item_stock_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `gross` double DEFAULT NULL,
  `touch` double DEFAULT NULL,
  `fine` double DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `item_stock`
--
ALTER TABLE `item_stock`
  ADD PRIMARY KEY (`item_stock_id`);

--
-- AUTO_INCREMENT for table `item_stock`
--
ALTER TABLE `item_stock`
  MODIFY `item_stock_id` int(11) NOT NULL AUTO_INCREMENT;

-- Avinash : 2020_12_23 01:45 PM
INSERT INTO `website_modules` (`website_module_id`, `title`, `main_module`) VALUES (18, 'Report >> Item Stock Status', '9.2');
INSERT INTO `module_roles` (`module_role_id`, `title`, `role_name`, `website_module_id`) VALUES (NULL, 'view', 'view', 18);

-- Avinash : 2020_12_23 03:30 PM
ALTER TABLE `job_worker` ADD `current_fine` DOUBLE NOT NULL DEFAULT '0' AFTER `job_worker`, ADD `current_amount` DOUBLE NOT NULL DEFAULT '0' AFTER `current_fine`;
ALTER TABLE `job_worker` ADD `balance_date` DATE NULL DEFAULT NULL AFTER `current_amount`;

-- Avinash : 2020_12_24 04:00 PM
-- --------------------------------------------------------
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `job_card_id` int(11) DEFAULT NULL,
  `tag_date` date DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `gross` double DEFAULT NULL,
  `item_weight` double DEFAULT NULL,
  `less` double DEFAULT NULL,
  `moti` double DEFAULT NULL,
  `net` double DEFAULT NULL,
  `other_charges` double DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `patch` double DEFAULT NULL,
  `patch_wastage` double DEFAULT NULL,
  `remark` text,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Table structure for table `tags_other_charges_details`
--

CREATE TABLE `tags_other_charges_details` (
  `other_charges_details_id` int(11) NOT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `charges_id` int(11) DEFAULT NULL,
  `charges_weight` double DEFAULT NULL,
  `charges_rate` double DEFAULT NULL,
  `charges_amount` double DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `tags_other_charges_details`
--
ALTER TABLE `tags_other_charges_details`
  ADD PRIMARY KEY (`other_charges_details_id`);

--
-- AUTO_INCREMENT for table `tags_other_charges_details`
--
ALTER TABLE `tags_other_charges_details`
  MODIFY `other_charges_details_id` int(11) NOT NULL AUTO_INCREMENT;

-- Avinash : 2020_12_24 04:30 PM
ALTER TABLE `job_worker` ADD `wastage_loss_allowed` DOUBLE NOT NULL DEFAULT '0' AFTER `job_worker`;

-- Avinash : 2020_12_25 06:20 PM
-- --------------------------------------------------------
-- Table structure for table `sells`
--

CREATE TABLE `sells` (
  `sell_id` int(11) NOT NULL,
  `job_card_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `sell_date` date DEFAULT NULL,
  `gross` double DEFAULT NULL,
  `touch` double DEFAULT NULL,
  `wastage` double DEFAULT NULL,
  `fine` double DEFAULT NULL,
  `other_charges` double DEFAULT NULL,
  `remark` text,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sells`
--
ALTER TABLE `sells`
  ADD PRIMARY KEY (`sell_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sells`
--
ALTER TABLE `sells`
  MODIFY `sell_id` int(11) NOT NULL AUTO_INCREMENT;

-- Avinash : 2020_12_26 02:30 PM
DELETE FROM `website_modules` WHERE `website_module_id` = 4;
DELETE FROM `module_roles` WHERE `website_module_id` = 4;
ALTER TABLE `item` ADD `short_name` VARCHAR(255) NULL DEFAULT NULL AFTER `item_name`;
ALTER TABLE `job_card_items` ADD `design_text` VARCHAR(50) NULL DEFAULT NULL AFTER `item_id`, ADD `design_no` INT(11) NULL DEFAULT NULL AFTER `design_text`;

-- Avinash : 2020_12_26 04:45 PM
ALTER TABLE `charges` ADD `effect_person_ledger` INT(11) NOT NULL DEFAULT '0' COMMENT '0 = No, 1 = Yes' AFTER `charges_name`, ADD `rate_on_ct` INT(11) NOT NULL DEFAULT '0' COMMENT '0 = No, 1 = Yes' AFTER `effect_person_ledger`;

-- Avinash : 2020_12_26 05:45 PM
ALTER TABLE `tags` ADD `tag_no` VARCHAR(255) NULL DEFAULT NULL AFTER `job_card_id`;
ALTER TABLE `tags` ADD `stone_wt` DOUBLE NULL DEFAULT NULL AFTER `less`;

-- Avinash : 2020_12_26 06:40 PM
ALTER TABLE `sells` ADD `net` DOUBLE NULL DEFAULT NULL AFTER `gross`;

-- Avinash : 2020_12_28 10:15 AM
-- --------------------------------------------------------
-- Table structure for table `manufacture_ir_gross_details`
--

CREATE TABLE `manufacture_ir_gross_details` (
  `gross_details_id` int(11) NOT NULL,
  `manufacture_id` int(11) DEFAULT NULL,
  `manufacture_ir_id` int(11) DEFAULT NULL,
  `gross_detail_item_id` int(11) DEFAULT NULL,
  `gross_detail_weight` double DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `manufacture_ir_gross_details`
--
ALTER TABLE `manufacture_ir_gross_details`
  ADD PRIMARY KEY (`gross_details_id`);

--
-- AUTO_INCREMENT for table `manufacture_ir_gross_details`
--
ALTER TABLE `manufacture_ir_gross_details`
  MODIFY `gross_details_id` int(11) NOT NULL AUTO_INCREMENT;

-- Avinash : 2020_12_29 01:30 PM
ALTER TABLE `manufacture` ADD `used_vetran` DOUBLE NULL DEFAULT NULL AFTER `close_to_calculate_loss`, ADD `used_moti` DOUBLE NULL DEFAULT NULL AFTER `used_vetran`;

-- Avinash : 2020_12_29 06:45 PM
INSERT INTO `website_modules` (`website_module_id`, `title`, `main_module`) VALUES (19, 'Report >> Person Ledger', '9.3');
INSERT INTO `module_roles` (`module_role_id`, `title`, `role_name`, `website_module_id`) VALUES (NULL, 'view', 'view', 19);

-- Avinash : 2021_06_11 10:00 AM
ALTER TABLE `job_card` ADD `reference_total` DOUBLE NOT NULL DEFAULT '0' AFTER `remark`, ADD `total_costing_fine` DOUBLE NOT NULL DEFAULT '0' AFTER `reference_total`, ADD `total_costing_amount` DOUBLE NOT NULL DEFAULT '0' AFTER `total_costing_fine`, ADD `profit_loss_fine` DOUBLE NOT NULL DEFAULT '0' AFTER `total_costing_amount`, ADD `profit_loss_amount` DOUBLE NOT NULL DEFAULT '0' AFTER `profit_loss_fine`;

-- Avinash : 2021_07_15 10:00 AM
INSERT INTO `item` (`item_id`, `item_name`, `short_name`, `created_by`, `created_at`, `updated_by`, `updated_at`)
SELECT * FROM (SELECT '16' AS `item_id`, 'Chol' AS `item_name`, 'Chol' AS `short_name`, '1' AS `created_by`, '2021-07-13 09:30:00' AS `created_at`, '1' AS `updated_by`, '2021-07-13 09:30:00' as `updated_at`) AS tmp
WHERE NOT EXISTS (
    SELECT `item_id` FROM `item` WHERE `item_id` = 16
) LIMIT 1;

ALTER TABLE `sells` ADD `sell_party_id` INT(11) NULL DEFAULT NULL AFTER `other_charges`, ADD INDEX `sell_party_id` (`sell_party_id`);
ALTER TABLE `sells` ADD CONSTRAINT `FK_Sell_Party` FOREIGN KEY (`sell_party_id`) REFERENCES `party`(`party_id`);

-- Avinash : 2020_07_21 10:30 AM
ALTER TABLE `job_worker` ADD `used_moti_on` INT(11) NOT NULL DEFAULT '0' COMMENT '0 = Not Checked, 1 = Checked' AFTER `wastage_loss_allowed`;
