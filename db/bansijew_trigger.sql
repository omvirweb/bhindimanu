-- Shailesh : 2020_02_08 03:45 PM
DROP TRIGGER IF EXISTS `manufacture_delete_after_trigger`; CREATE DEFINER=`root`@`localhost` TRIGGER `manufacture_delete_after_trigger` AFTER DELETE ON `manufacture` FOR EACH ROW INSERT INTO 
  bansijew_log.`manufacture_log` 
SET 
  trigger_status = 'DELETE',
  `trigger_run_at`=NOW(),
  `manufacture_id`=OLD.manufacture_id,
  `job_card_id`=OLD.job_card_id,
  `process_id`=OLD.process_id,
  `remark`=OLD.remark,
  `close_to_calculate_loss`=OLD.close_to_calculate_loss,
  `balance_weight`=OLD.balance_weight,
  `balance_net_weight`=OLD.balance_net_weight,
  `balance_fine`=OLD.balance_fine,
  `balance_pcs`=OLD.balance_pcs,
  `balance_alloy`=OLD.balance_alloy,
  `count_loss_on`=OLD.count_loss_on,
  `on_how_much`=OLD.on_how_much,
  `allowed_loss`=OLD.allowed_loss,
  `total_receive_finish_pcs`=OLD.total_receive_finish_pcs,
  `total_receive_finish_ad_pcs`=OLD.total_receive_finish_ad_pcs,
  `total_receive_finish_pcs_with_ad`=OLD.total_receive_finish_pcs_with_ad,
  `total_receive_finish_net_weight`=OLD.total_receive_finish_net_weight,
  `total_receive_finish_ad_weight`=OLD.total_receive_finish_ad_weight,
  `total_receive_finish_net_weight_with_ad`=OLD.total_receive_finish_net_weight_with_ad,
  `total_allowed_loss`=OLD.total_allowed_loss,
  `loss`=OLD.loss,
  `created_by`=OLD.created_by,
  `created_at`=OLD.created_at,
  `updated_by`=OLD.updated_by,
  `updated_at`=OLD.updated_at,
  `ir_deleted_by`=OLD.ir_deleted_by,
  `ir_deleted_at`=OLD.ir_deleted_at;


DROP TRIGGER IF EXISTS `manufacture_insert_after_trigger`; CREATE DEFINER=`root`@`localhost` TRIGGER `manufacture_insert_after_trigger` AFTER INSERT ON `manufacture` FOR EACH ROW INSERT INTO 
  bansijew_log.`manufacture_log` 
SET 
  trigger_status = 'INSERT',
  `trigger_run_at`=NOW(),
  `manufacture_id`=NEW.manufacture_id,
  `job_card_id`=NEW.job_card_id,
  `process_id`=NEW.process_id,
  `remark`=NEW.remark,
  `close_to_calculate_loss`=NEW.close_to_calculate_loss,
  `balance_weight`=NEW.balance_weight,
  `balance_net_weight`=NEW.balance_net_weight,
  `balance_fine`=NEW.balance_fine,
  `balance_pcs`=NEW.balance_pcs,
  `balance_alloy`=NEW.balance_alloy,
  `count_loss_on`=NEW.count_loss_on,
  `on_how_much`=NEW.on_how_much,
  `allowed_loss`=NEW.allowed_loss,
  `total_receive_finish_pcs`=NEW.total_receive_finish_pcs,
  `total_receive_finish_ad_pcs`=NEW.total_receive_finish_ad_pcs,
  `total_receive_finish_pcs_with_ad`=NEW.total_receive_finish_pcs_with_ad,
  `total_receive_finish_net_weight`=NEW.total_receive_finish_net_weight,
  `total_receive_finish_ad_weight`=NEW.total_receive_finish_ad_weight,
  `total_receive_finish_net_weight_with_ad`=NEW.total_receive_finish_net_weight_with_ad,
  `total_allowed_loss`=NEW.total_allowed_loss,
  `loss`=NEW.loss,
  `created_by`=NEW.created_by,
  `created_at`=NEW.created_at,
  `updated_by`=NEW.updated_by,
  `updated_at`=NEW.updated_at,
  `ir_deleted_by`=NEW.ir_deleted_by,
  `ir_deleted_at`=NEW.ir_deleted_at;


DROP TRIGGER IF EXISTS `manufacture_update_after_trigger`; CREATE DEFINER=`root`@`localhost` TRIGGER `manufacture_update_after_trigger` AFTER UPDATE ON `manufacture` FOR EACH ROW INSERT INTO 
  bansijew_log.`manufacture_log` 
SET 
  trigger_status = 'UPDATE',
  `trigger_run_at`=NOW(),
  `manufacture_id`=NEW.manufacture_id,
  `job_card_id`=NEW.job_card_id,
  `process_id`=NEW.process_id,
  `remark`=NEW.remark,
  `close_to_calculate_loss`=NEW.close_to_calculate_loss,
  `balance_weight`=NEW.balance_weight,
  `balance_net_weight`=NEW.balance_net_weight,
  `balance_fine`=NEW.balance_fine,
  `balance_pcs`=NEW.balance_pcs,
  `balance_alloy`=NEW.balance_alloy,
  `count_loss_on`=NEW.count_loss_on,
  `on_how_much`=NEW.on_how_much,
  `allowed_loss`=NEW.allowed_loss,
  `total_receive_finish_pcs`=NEW.total_receive_finish_pcs,
  `total_receive_finish_ad_pcs`=NEW.total_receive_finish_ad_pcs,
  `total_receive_finish_pcs_with_ad`=NEW.total_receive_finish_pcs_with_ad,
  `total_receive_finish_net_weight`=NEW.total_receive_finish_net_weight,
  `total_receive_finish_ad_weight`=NEW.total_receive_finish_ad_weight,
  `total_receive_finish_net_weight_with_ad`=NEW.total_receive_finish_net_weight_with_ad,
  `total_allowed_loss`=NEW.total_allowed_loss,
  `loss`=NEW.loss,
  `created_by`=NEW.created_by,
  `created_at`=NEW.created_at,
  `updated_by`=NEW.updated_by,
  `updated_at`=NEW.updated_at,
  `ir_deleted_by`=NEW.ir_deleted_by,
  `ir_deleted_at`=NEW.ir_deleted_at;

DROP TRIGGER IF EXISTS `manufacture_issue_receive_delete_after_trigger`; CREATE DEFINER=`root`@`localhost` TRIGGER `manufacture_issue_receive_delete_after_trigger` AFTER DELETE ON `manufacture_issue_receive` FOR EACH ROW INSERT INTO 
  bansijew_log.`manufacture_issue_receive_log` 
SET 
  trigger_status = 'DELETE',
  `trigger_run_at`=NOW(),
  `manufacture_ir_id`=OLD.manufacture_ir_id,
  `manufacture_id`=OLD.manufacture_id,
  `type_id`=OLD.type_id,
  `ir_date`=OLD.ir_date,
  `weight`=OLD.weight,
  `item_id`=OLD.item_id,
  `job_worker_id`=OLD.job_worker_id,
  `remark`=OLD.remark,
  `pcs`=OLD.pcs,
  `ad_weight`=OLD.ad_weight,
  `ad_pcs`=OLD.ad_pcs,
  `less`=OLD.less,
  `net_weight`=OLD.net_weight,
  `tunch`=OLD.tunch,
  `fine`=OLD.fine,
  `created_by`=OLD.created_by,
  `created_at`=OLD.created_at,
  `updated_by`=OLD.updated_by,
  `updated_at`=OLD.updated_at;


DROP TRIGGER IF EXISTS `manufacture_issue_receive_insert_after_trigger`; CREATE DEFINER=`root`@`localhost` TRIGGER `manufacture_issue_receive_insert_after_trigger` AFTER INSERT ON `manufacture_issue_receive` FOR EACH ROW INSERT INTO 
  bansijew_log.`manufacture_issue_receive_log` 
SET 
  trigger_status = 'INSERT',
  `trigger_run_at`=NOW(),
  `manufacture_ir_id`=NEW.manufacture_ir_id,
  `manufacture_id`=NEW.manufacture_id,
  `type_id`=NEW.type_id,
  `ir_date`=NEW.ir_date,
  `weight`=NEW.weight,
  `item_id`=NEW.item_id,
  `job_worker_id`=NEW.job_worker_id,
  `remark`=NEW.remark,
  `pcs`=NEW.pcs,
  `ad_weight`=NEW.ad_weight,
  `ad_pcs`=NEW.ad_pcs,
  `less`=NEW.less,
  `net_weight`=NEW.net_weight,
  `tunch`=NEW.tunch,
  `fine`=NEW.fine,
  `created_by`=NEW.created_by,
  `created_at`=NEW.created_at,
  `updated_by`=NEW.updated_by,
  `updated_at`=NEW.updated_at;


DROP TRIGGER IF EXISTS `manufacture_issue_receive_update_after_trigger`; CREATE DEFINER=`root`@`localhost` TRIGGER `manufacture_issue_receive_update_after_trigger` AFTER UPDATE ON `manufacture_issue_receive` FOR EACH ROW INSERT INTO 
  bansijew_log.`manufacture_issue_receive_log` 
SET 
  trigger_status = 'UPDATE',
  `trigger_run_at`=NOW(),
  `manufacture_ir_id`=NEW.manufacture_ir_id,
  `manufacture_id`=NEW.manufacture_id,
  `type_id`=NEW.type_id,
  `ir_date`=NEW.ir_date,
  `weight`=NEW.weight,
  `item_id`=NEW.item_id,
  `job_worker_id`=NEW.job_worker_id,
  `remark`=NEW.remark,
  `pcs`=NEW.pcs,
  `ad_weight`=NEW.ad_weight,
  `ad_pcs`=NEW.ad_pcs,
  `less`=NEW.less,
  `net_weight`=NEW.net_weight,
  `tunch`=NEW.tunch,
  `fine`=NEW.fine,
  `created_by`=NEW.created_by,
  `created_at`=NEW.created_at,
  `updated_by`=NEW.updated_by,
  `updated_at`=NEW.updated_at;

