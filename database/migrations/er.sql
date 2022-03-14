SELECT `火災保険料` FROM bds_system.fund;


ALTER TABLE bds_system.fund
ADD COLUMN `出資総額` DECIMAL(10, 2) 
GENERATED ALWAYS AS (`物件価格`) STORED;


ALTER TABLE bds_system.fund
ADD COLUMN `劣後出資額` DECIMAL(10, 2) 
GENERATED ALWAYS AS (`物件価格` - `募集金額`) STORED;

ALTER TABLE bds_system.fund
ADD COLUMN `合計` DECIMAL(10, 2) 
GENERATED ALWAYS AS (`維持管理費` + `修繕積立金` + `公租公課` + `火災保険料` + `PMフィー` + `税理士報酬` + `その他`) STORED;


ALTER TABLE bds_system.fund
ADD COLUMN `分配原資` DECIMAL(10, 2) 
GENERATED ALWAYS AS (`賃料収入` - `合計`) STORED;


ALTER TABLE bds_system.fund
ADD COLUMN `全体口数` DECIMAL(10, 2) 
GENERATED ALWAYS AS (`募集金額` / `投資単位（1口）`) STORED;


ALTER TABLE bds_system.fund
ADD COLUMN `優先出資分配金` DECIMAL(10, 2) 
GENERATED ALWAYS AS ((FLOOR((`募集金額` / `出資総額`) * `分配原資`))) STORED;


ALTER TABLE bds_system.fund
ADD COLUMN `劣後出資分配金（営業者）`  DECIMAL(10, 2) 
GENERATED ALWAYS AS (`分配原資` - `優先出資分配金`) STORED;


ALTER TABLE bds_system.fund
ADD COLUMN `1口あたり`  DECIMAL(10, 2)
GENERATED ALWAYS AS (`優先出資分配金` / `全体口数`) STORED;


ALTER TABLE `bds_system`.`fund` 
CHANGE COLUMN `優先出資分配金` `優先出資分配金` DECIMAL(10,2) GENERATED ALWAYS AS ((FLOOR((`募集金額` / `出資総額`) * `分配原資`))) STORED ;

ALTER TABLE bds_system.fund
ADD COLUMN `運用期間_interval` INT
GENERATED ALWAYS AS (TIMESTAMPDIFF(month, `運用期間_from`, `運用期間_to`)) STORED;


-- http://localhost:3000/admin/FD40
-- Import CSV 申込日, お名前, 申込金額, (申込口数)
-- data-for-calculating="true"

CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


CREATE TABLE `bds_system`.`fund_application` (
  `fund_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`fund_id`, `user_id`));


CREATE VIEW `v_user_list` AS 
SELECT 
	CONCAT(`お名前1`, `お名前2`) AS `お名前`,
    `固定電話`                  AS `固定電話番号`,
    `携帯電話`				   AS `携帯電話番号`,
	`本人確認日`			       AS `本人確認日`,
	DATE(`created_at`)		   AS `登録日`,
    0                          AS `申込数合計`,
    0						   AS `投資数合計`
FROM user
;



CREATE TABLE IF NOT EXISTS `deposit` (
  `user_id` INT NOT NULL,
  `fund_id` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`user_id`, `fund_id`),
  INDEX `fk_deposit_fund_idx` (`fund_id` ASC))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `withdrawal` (
  `user_id` INT NOT NULL,
  `fund_id` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`user_id`, `fund_id`),
  INDEX `fk_deposit_fund_idx` (`fund_id` ASC))
ENGINE = InnoDB;



CREATE TABLE IF NOT EXISTS `admin` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  `email` TEXT NULL,
  `password` TEXT NULL,
  `reset_password_token` TEXT NULL,
  `reset_password_token_expired_at` DATETIME NULL,
  `invitation_token` TEXT NULL,
  `invitation_token_expired_at` DATETIME NULL,
  `email_verified_at` DATETIME NULL,
  `is_allow_login` TINYINT NULL DEFAULT 0,
  `last_login_at` DATETIME NULL,
  `role` TEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- 抽選ステータス
-- 申込日
-- お名前
-- 申込金額（申込口数）
-- 当選金額（当選口数）
-- キャンセル日

-- Lottery status
-- Application date
-- name
-- Application amount (number of application units)
-- Winning amount (number of winning units)
-- Cancellation date

CREATE VIEW IF NOT EXISTS `v_fund_application_list` AS 
SELECT 
	 `抽選結果`                  AS `抽選ステータス`,
    DATE(`created_at`)        AS `申込日`,
    ( 
      SELECT
        CONCAT(`お名前1`, `お名前2`) 
      FROM `user` 
      WHERE 
        `user`.`id` = `fund_application`.`user_id`
      LIMIT 1
    )                         AS `お名前`,
	  0			                    AS `申込金額`,
    0                         AS `申込口数`,
    0                         AS `当選金額`,
    0                         AS `当選口数`,
    `キャンセル日`              AS `キャンセル日`
FROM `fund_application`;




-- =======
-- CORRECT SQL
-- =======

CREATE TABLE IF NOT EXISTS `fund` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  `投資単位（1口）` DECIMAL(10,2) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `fund_application` (
  `user_id` INT NOT NULL,
  `fund_id` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  `申込日` DATETIME NULL DEFAULT NOW() COMMENT 'Application date',
  `申込口数` INT(11) NULL DEFAULT 0 COMMENT 'Number of applications',
  `キャンセル日` DATE NULL DEFAULT NULL COMMENT 'Cancellation date',
  `抽選結果` TEXT NULL COMMENT 'Lottery result',
  `当選口数` INT(11) NULL DEFAULT 0 COMMENT 'Number of winning units',
  `入金期限日` DATE NULL COMMENT 'Payment deadline',
  `抽選日` DATE NULL COMMENT 'Lottery date',
  PRIMARY KEY (`user_id`, `fund_id`),
  INDEX `fk_fund_application_fund1_idx` (`fund_id` ASC),
  CONSTRAINT `fk_fund_application_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_fund_application_fund1`
    FOREIGN KEY (`fund_id`)
    REFERENCES `fund` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


DROP TRIGGER IF EXISTS `fund_application_BEFORE_UPDATE`;

DELIMITER $$
USE `bds_system`$$
CREATE DEFINER = CURRENT_USER TRIGGER `fund_application_BEFORE_UPDATE` BEFORE UPDATE ON `fund_application` FOR EACH ROW
BEGIN
     IF NEW.`抽選結果` <> OLD.`抽選結果` THEN
     SET NEW.`抽選日` = CURDATE();     
     END IF;
END$$
DELIMITER ;




CREATE TABLE IF NOT EXISTS `investor` (
  `user_id` INT NOT NULL,
  `fund_id` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  `入金状況` TEXT NULL COMMENT 'Payment status',
  `入金日` DATE NULL DEFAULT NULL COMMENT 'Payment day',
  `出金登録_摘要` TEXT NULL COMMENT 'Description',
  `出金登録_日付` DATE NULL COMMENT 'Date',
  `出金登録_金額` DECIMAL(10,2) NULL COMMENT 'Amount of money',
  PRIMARY KEY (`user_id`, `fund_id`),
  INDEX `fk_lottery_fund2_idx` (`fund_id` ASC),
  CONSTRAINT `fk_lottery_user2`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lottery_fund2`
    FOREIGN KEY (`fund_id`)
    REFERENCES `fund` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- SQL Dump Application
INSERT INTO `fund_application` (`user_id`, `fund_id`, `申込口数`) VALUES (1, 1, 7);

CREATE TABLE IF NOT EXISTS `notice` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `admin_id` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  `公開期間_from` DATE NULL,
  `公開期間_to` DATE NULL,
  `公開先` TEXT NULL,
  `タイトル` TEXT NULL,
  `添付ファイル` TEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_notice_admin1_idx` (`admin_id` ASC),
  CONSTRAINT `fk_notice_admin1`
    FOREIGN KEY (`admin_id`)
    REFERENCES `admin` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



CREATE TABLE IF NOT EXISTS `fund_message` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fund_id` INT NOT NULL,
  `admin_id` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  `送信日時` DATETIME NULL,
  `タイトル` TEXT NULL,
  INDEX `fk_message_admin1_idx` (`admin_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_message_fund1`
    FOREIGN KEY (`fund_id`)
    REFERENCES `fund` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_message_admin1`
    FOREIGN KEY (`admin_id`)
    REFERENCES `admin` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `user_message` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `admin_id` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  `タイトル` TEXT NULL,
  INDEX `fk_user_message_user1_idx` (`user_id` ASC),
  INDEX `fk_user_message_admin1_idx` (`admin_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_user_message_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_message_admin1`
    FOREIGN KEY (`admin_id`)
    REFERENCES `admin` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- ===============================================


-- CREATE OR REPLACE VIEW `v_fund_application_list` AS 
-- SELECT 
--     `fund_id`                                         AS `fund_id`,
--     `user_id`                                          AS `user_id`,       
--     COALESCE(`抽選結果`, '-')                           AS `抽選ステータス`,
--     DATE(`fund_application`.`created_at`)              AS `申込日`,
--     ( 
--         SELECT
--             CONCAT(`お名前1`, `お名前2`) 
--         FROM `user` 
--         WHERE
--             `user`.`id` = `fund_application`.`user_id`
--         LIMIT 1
--     )                            AS `お名前`,
--     FORMAT( `申込口数` * `fund`.`投資単位（1口）`, 'D', 'en-us')    AS `申込金額`,
--     `申込口数`                                                    AS `申込口数`,
--     FORMAT( `当選口数` * `fund`.`投資単位（1口）`, 'D', 'en-us')    AS `当選金額`,
--     `当選口数`                                                   AS `当選口数`,
--     COALESCE(`キャンセル日`, '-')  AS `キャンセル日`,
--     `fund_application`.`updated_at`                             AS `updated_at`
-- FROM 
--     `fund_application`
-- JOIN `fund` ON `fund_application`.`fund_id` = `fund`.`id`
-- WHERE 
--   `fund_application`.`deleted_at` IS NULL AND
--   `fund`.`deleted_at` IS NULL




-- SELECT
--   `investor`.`fund_id`,
--   `investor`.`user_id`,
--   `fund_application`.`申込日`                  AS `申込日`,
--   `fund_application`.`申込口数`                AS `申込口数`,
--   `fund_application`.`キャンセル日`             AS `キャンセル日`,

--   `fund_application`.`抽選結果`                AS `抽選結果`,
--   `fund_application`.`当選口数`                AS `当選口数`,
--   `fund_application`.`入金期限日`              AS  `入金期限日`,

--   `investor`.`入金状況`                        AS  `入金状況`,
--   `investor`.`入金日`                          AS  `入金日`,

--   `investor`.`摘要`                           AS `摘要`,
--   `investor`.`金額`                           AS `出金額（税引前）`,

--   CONCAT(
--       '¥', FORMAT( `fund_application`.`当選口数` * `fund`.`投資単位（1口）`, 'D', 'en-us')
--   )                                                           AS `投資金額`,
--   `fund`.`配当日`                               AS `分配日`
-- FROM `investor`
-- JOIN `fund_application` 
--   ON `fund_application`.`fund_id` = `investor`.`fund_id` AND `fund_application`.`user_id` = `investor`.`user_id`
-- JOIN `fund` 
--   ON `fund`.`id` = `investor`.`fund_id` AND `fund`.`deleted_at` IS NULL

-- JOIN `user` 
--   ON `user`.`id` = `investor`.`user_id`

CREATE TABLE `bds_system`.`temporary_register` (
  `invitation_token` VARCHAR(100) NOT NULL,
  `invitation_token_expired_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `created_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`invitation_token`));


CREATE TABLE `bds_system`.`user_contact` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `message_read` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message_type` varchar(50) DEFAULT NULL,
  `read_at` datetime DEFAULT NULL
) ENGINE=InnoDB;
