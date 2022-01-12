-- Shailesh : 2020_02_08 03:45 PM
--
-- Table structure for table `manufacture_log`
--

CREATE TABLE IF NOT EXISTS `manufacture_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trigger_status` varchar(255) DEFAULT NULL,
  `trigger_run_at` datetime DEFAULT NULL,
  `manufacture_id` int(11) DEFAULT NULL,
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
  `ir_deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `manufacture_issue_receive_log`
--

CREATE TABLE IF NOT EXISTS `manufacture_issue_receive_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trigger_status` varchar(255) DEFAULT NULL,
  `trigger_run_at` datetime DEFAULT NULL,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

