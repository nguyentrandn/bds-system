CREATE SCHEMA IF NOT EXISTS `matching_system` DEFAULT CHARACTER SET utf8mb4 ;
USE `matching_system` ;

CREATE TABLE IF NOT EXISTS `role` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` NVARCHAR(45) NOT NULL,
  `description` VARCHAR(100) NULL,
  `created_at` DATETIME NOT NULL,
  `created_by` INT NULL,
  `updated_at` DATETIME NULL,
  `updated_by` INT NULL,
  `deleted_at` DATETIME NULL,
  `deleted_by` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO `role` (`id`, `name`, `description`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES (1, '管理者', 'system admin', '2021-12-12 07:00:00', 1, '2021-12-12 07:00:00', 1, NULL, NULL);

CREATE TABLE IF NOT EXISTS `admin` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `fullname` NVARCHAR(100) NOT NULL,
  `password` VARCHAR(45) NULL,
  `role_id` INT NOT NULL,
  `reset_password_token` VARCHAR(100) NULL,
  `verify_email_token` VARCHAR(100) NULL,
  `is_email_verified` TINYINT NOT NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL,
  `created_by` INT NULL,
  `updated_at` DATETIME NULL,
  `updated_by` INT NULL,
  `deleted_at` DATETIME NULL,
  `deleted_by` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_role_idx` (`role_id` ASC),
  UNIQUE INDEX `unique_email` (`email` ASC),
  CONSTRAINT `fk_role`
    FOREIGN KEY (`role_id`)
    REFERENCES `role` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `plan_master` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` NVARCHAR(45) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO `plan_master` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'Free', '2021-12-12 07:00:00', '2021-12-12 07:00:00', NULL);
INSERT INTO `plan_master` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 'スタンダード', '2021-12-12 07:00:00', '2021-12-12 07:00:00', NULL);
INSERT INTO `plan_master` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 'プレミアム', '2021-12-12 07:00:00', '2021-12-12 07:00:00', NULL);

CREATE TABLE IF NOT EXISTS `plan_detail` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `plan_master_id` INT NOT NULL,
  `name` NVARCHAR(45) NOT NULL,
  `period` TINYINT NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `target_object` CHAR(1) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_plan_master_idx` (`plan_master_id` ASC),
  CONSTRAINT `fk_plan_master`
    FOREIGN KEY (`plan_master_id`)
    REFERENCES `plan_master` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `coupon_master` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `coupon_code` VARCHAR(45) NOT NULL,
  `discount_rate` DECIMAL(10,2) NULL,
  `discount_cash` DECIMAL(10,2) NULL,
  `plan_detail_id` INT NOT NULL,
  `validity_period_from` DATE NOT NULL,
  `validity_period_to` DATE NOT NULL,
  `available_months` INT NOT NULL,
  `admin_id` INT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  `updated_by` INT NULL,
  `deleted_at` DATETIME NULL,
  `deleted_by` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_coupon_master_admin1_idx` (`admin_id` ASC),
  INDEX `fk_coupon_plan_master_idx` (`plan_detail_id` ASC),
  UNIQUE INDEX `unique_coupon_code` (`coupon_code` ASC),
  CONSTRAINT `fk_coupon_master_admin`
    FOREIGN KEY (`admin_id`)
    REFERENCES `admin` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_coupon_plan_master`
    FOREIGN KEY (`plan_detail_id`)
    REFERENCES `matching_system`.`plan_detail` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE `area` (
  `area_code` int NOT NULL,
  `name_jp` varchar(45) NOT NULL,
  `name_en` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`area_code`)
) ENGINE=InnoDB;

INSERT INTO `area` (`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (1,'北海道','Hokkaido',NULL,NULL,NULL);
INSERT INTO `area` (`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (2,'東北地方','Tōhoku',NULL,NULL,NULL);
INSERT INTO `area` (`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (3,'関東地方','Kantō',NULL,NULL,NULL);
INSERT INTO `area` (`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (4,'中部地方','Chūbu',NULL,NULL,NULL);
INSERT INTO `area` (`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (5,'関西地方','Kansai',NULL,NULL,NULL);
INSERT INTO `area` (`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (6,' 中国地方','Chūgoku',NULL,NULL,NULL);
INSERT INTO `area` (`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (7,'四国','Shikoku',NULL,NULL,NULL);
INSERT INTO `area` (`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (8,'九州','Kyushu',NULL,NULL,NULL);


CREATE TABLE `prefecture` (
  `prefecture_code` int NOT NULL,
  `area_code` int NOT NULL,
  `name_jp` varchar(45) NOT NULL,
  `name_en` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`prefecture_code`),
  KEY `fk_area_idx` (`area_code`),
  CONSTRAINT `fk_area` FOREIGN KEY (`area_code`) REFERENCES `area` (`area_code`)
) ENGINE=InnoDB;
​
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (1,1,'北海道','Hokkaido',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (2,2,'青森県','Aomori ',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (3,2,'岩手県','Iwate',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (4,2,'宮城県','Miyagi',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (5,2,'秋田県','Akita',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (6,2,'山形県','Yamagata',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (7,2,'福島県','Fukushima',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (8,3,'茨城県','Ibaraki',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (9,3,'栃木県  ','Tochigi',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (10,3,'群馬県','Gunma',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (11,3,'埼玉県 ','Saitama',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (12,3,'千葉県','Chiba',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (13,3,'東京都','Tokyo',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (14,3,'神奈川県','Kanagawa',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (15,4,'新潟県','Niigata',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (16,4,'富山県','Toyama',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (17,4,'石川県','Ishikawa',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (18,4,'福井県','Fukui',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (19,4,'山梨県','Yamanashi',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (20,4,'長野県','Nagano',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (21,4,'岐阜県','Gifu',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (22,4,'静岡県','Shizuoka',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (23,4,'愛知県','Aichi',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (24,5,'三重県 ','Mie',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (25,5,'滋賀県','Shiga',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (26,5,'京都府','Kyoto',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (27,5,'大阪府','Osaka',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (28,5,'兵庫県','Hyogo',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (29,5,'奈良県','Nara',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (30,5,'和歌山県','Wakayama',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (31,6,'鳥取県','Tottori',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (32,6,'島根県','Shimane',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (33,6,'岡山県','Okayama',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (34,6,'広島県','Hiroshima',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (35,6,'山口県','Yamaguchi',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (36,7,'徳島県','Tokushima',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (37,7,'香川県','Kagawa',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (38,7,'愛媛県','Ehime',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (39,7,'高知県','Kōchi',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (40,8,'福岡県','Fukuoka',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (41,8,'佐賀県','Saga',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (42,8,'長崎県','Nagasaki',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (43,8,'熊本県','Kumamoto',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (44,8,'大分県','Ōita',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (45,8,'宮崎県','Miyazaki',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (46,8,'鹿児島県','Kagoshima',NULL,NULL,NULL);
INSERT INTO `prefecture` (`prefecture_code`,`area_code`,`name_jp`,`name_en`,`created_at`,`updated_at`,`deleted_at`) VALUES (47,8,'沖縄県','Okinawa',NULL,NULL,NULL);

CREATE TABLE `user` (
  `id` int NOT NULL COMMENT '0 : free, 1: standard, 2: premium',
  `nickname` varchar(15) NOT NULL COMMENT 'Requied | Max: 15',
  `email` varchar(45) NOT NULL COMMENT 'Unique | required\n',
  `password` varchar(45) NOT NULL,
  `email_verified_at` datetime NOT NULL,
  `member_type` varchar(45) NOT NULL DEFAULT '0' COMMENT 'Required',
  `gender` int NOT NULL COMMENT 'Required',
  `date_of_birth` date NOT NULL COMMENT 'Required',
  `avatar_url` varchar(200) DEFAULT NULL,
  `introduction_content` text COMMENT 'Min: 100 | Max: 4000',
  `slogan` varchar(30) DEFAULT NULL COMMENT 'Max: 30',
  `prefecture_code` int NOT NULL COMMENT 'Required',
  `scope_public` int NOT NULL COMMENT 'Required',
  `known_by_channel` varchar(45) NOT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `emaill_UNIQUE` (`emaill`),
  KEY `fk_user_prefecture_idx` (`prefecture_code`),
  CONSTRAINT `fk_user_prefecture` FOREIGN KEY (`prefecture_code`) REFERENCES `prefecture` (`prefecture_code`)
) ENGINE=InnoDB;
​


CREATE TABLE `user_attribute_master` (
  `id` int NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
​
INSERT INTO `user_attribute_master` (`id`,`name`) VALUES (1,'educational_background');
INSERT INTO `user_attribute_master` (`id`,`name`) VALUES (2,'height');
INSERT INTO `user_attribute_master` (`id`,`name`) VALUES (3,'body_shape');
INSERT INTO `user_attribute_master` (`id`,`name`) VALUES (4,'smoking');
INSERT INTO `user_attribute_master` (`id`,`name`) VALUES (5,'drinking');
INSERT INTO `user_attribute_master` (`id`,`name`) VALUES (6,'job');
INSERT INTO `user_attribute_master` (`id`,`name`) VALUES (7,'annual_income');
INSERT INTO `user_attribute_master` (`id`,`name`) VALUES (8,'motion');
INSERT INTO `user_attribute_master` (`id`,`name`) VALUES (9,'language');
INSERT INTO `user_attribute_master` (`id`,`name`) VALUES (10,'view_of_politics');
INSERT INTO `user_attribute_master` (`id`,`name`) VALUES (11,'faith');

CREATE TABLE `user_attribute` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `attribute_master_id` int NOT NULL,
  `value` varchar(45) NOT NULL,
  `logical_deleted_flag` tinyint DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_profile_idx` (`user_id`),
  KEY `fk_attribute_master_idx` (`attribute_master_id`),
  CONSTRAINT `fk_attribute_master` FOREIGN KEY (`attribute_master_id`) REFERENCES `user_attribute_master` (`id`),
  CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB;

CREATE TABLE `hobbies` (
  `id` int NOT NULL,
  `name` varchar(45) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
​
​
CREATE TABLE `user_has_hobbies` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `hobbies_id` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_hobbies_idx` (`hobbies_id`),
  KEY `fk_user_hobbies_idx` (`user_id`),
  CONSTRAINT `fk_hobbies` FOREIGN KEY (`hobbies_id`) REFERENCES `hobbies` (`id`),
  CONSTRAINT `fk_user_hobbies` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB;
​
​
CREATE TABLE `like` (
  `id` int NOT NULL,
  `from_user_id` int NOT NULL,
  `to_user_id` int NOT NULL,
  `logical_deleted_flag` tinyint DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_matching_user1_idx` (`from_user_id`),
  KEY `fk_user_matching_user2_idx` (`to_user_id`),
  CONSTRAINT `fk_user_like_user1` FOREIGN KEY (`from_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `fk_user_like_user2` FOREIGN KEY (`to_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB;
​

CREATE TABLE `matching` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_one` int NOT NULL,
  `user_two` int NOT NULL,
  `logical_deleted_flag` tinyint DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_matching_user_one_idx` (`user_one`),
  KEY `fk_matching_user_two_idx` (`user_two`),
  CONSTRAINT `fk_matching_user_one` FOREIGN KEY (`user_one`) REFERENCES `user` (`id`),
  CONSTRAINT `fk_matching_user_two` FOREIGN KEY (`user_two`) REFERENCES `user` (`id`)
) ENGINE=InnoDB;
​
​
CREATE TABLE `user_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `approval_at` datetime DEFAULT NULL,
  `approval_by` int DEFAULT NULL,
  `forced_withdrawal_at` varchar(45) DEFAULT NULL,
  `forced_withdrawal_by` varchar(45) DEFAULT NULL,
  `forced_withdrawal_reason` varchar(45) DEFAULT NULL,
  `withdrawal_at` datetime DEFAULT NULL,
  `withdrawal_reason` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_status_idx` (`user_id`),
  CONSTRAINT `fk_user_status` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB;

CREATE TABLE `subscription` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `plan_detail_id` int NOT NULL,
  `coupon_id` int DEFAULT NULL,
  `period` int NOT NULL,
  `subscription_date` date NOT NULL,
  `last_payment_date` date NOT NULL,
  `next_payment_date` date NOT NULL,
  `is_expired` tinyint DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `is_cancel` tinyint DEFAULT NULL,
  `cancel_at` datetime DEFAULT NULL,
  KEY `fk_user_subscription_user1_idx` (`user_id`),
  KEY `fk_user_subscription_plan_master1_idx` (`plan_detail_id`),
  CONSTRAINT `fk_user_subscription_plan_master1` FOREIGN KEY (`plan_detail_id`) REFERENCES `plan_detail` (`id`),
  CONSTRAINT `fk_user_subscription_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB;


CREATE TABLE `payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subscription_id` int NOT NULL,
  `stripe_payment_intent_id` varchar(100) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `tax` varchar(45) NOT NULL,
  `payment_with_tax` decimal(10,2) NOT NULL,
  `payment_method` varchar(45) NOT NULL,
  `payment_date` date NOT NULL,
  `number_payments` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payment_subscription_idx` (`subscription_id`),
  CONSTRAINT `fk_payment_subscription` FOREIGN KEY (`subscription_id`) REFERENCES `subscription` (`id`)
) ENGINE=InnoDB;

CREATE TABLE `identify_image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `url` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_identify_image_idx` (`user_id`),
  CONSTRAINT `fk_user_identify_image` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB;

CREATE TABLE `profile_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `url` text NOT NULL,
  `flag_public` tinyint DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `logical_deleted_flag` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_image_idx` (`user_id`),
  CONSTRAINT `fk_user_image` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB;

ALTER TABLE `user` CHANGE COLUMN `avatar_url` `avatar_url` TEXT NULL DEFAULT NULL ;

CREATE TABLE `withdraw` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `forced_withdrawal_at` datetime DEFAULT NULL,
  `forced_withdrawal_by` int DEFAULT NULL,
  `forced_withdrawal_reason` varchar(100) DEFAULT NULL,
  `withdrawal_at` datetime DEFAULT NULL,
  `withdrawal_reason` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_idx` (`user_id`),
  CONSTRAINT `fk_user_withdraw` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB;

ALTER TABLE `user`
ADD COLUMN `identify_image_src` TEXT NULL AFTER `last_login_at`,
ADD COLUMN `identify_image_name` NVARCHAR(45) NULL AFTER `identify_image_src`,
ADD COLUMN `identify_flag` TINYINT NULL AFTER `identify_image_name`;

ALTER TABLE `user`
ADD COLUMN `notes_by_admin` TEXT NULL AFTER `identify_flag`,
ADD COLUMN `approval_by` INT NULL AFTER `notes_by_admin`,
ADD COLUMN `approval_at` DATETIME NULL AFTER `approval_by`;

ALTER TABLE `user`
CHANGE COLUMN `avatar_url` `avatar` TEXT NULL DEFAULT NULL ;

DROP TABLE `matching_system`.`user_status`;



ALTER TABLE `matching_system`.`withdraw`
RENAME TO  `matching_system`.`member_status` ;

ALTER TABLE `matching_system`.`member_status`
ADD COLUMN `approval_at` DATETIME NULL AFTER `user_id`,
ADD COLUMN `approval_by` INT NULL AFTER `approval_at`;

ALTER TABLE `matching_system`.`subscription`
ADD COLUMN `member_status_id` INT NOT NULL AFTER `user_id`;

ALTER TABLE `matching_system`.`user`
DROP COLUMN `approval_at`,
DROP COLUMN `approval_by`,
DROP COLUMN `identify_flag`;

CREATE TABLE `user_reaction_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `from_user_id` int NOT NULL,
  `to_user_id` int NOT NULL,
  `reaction` varchar(45) NOT NULL,
  `reason_violation_report` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reaction_from_user_idx` (`from_user_id`),
  KEY `fk_reaction_to_user_idx` (`to_user_id`),
  CONSTRAINT `fk_reaction_from_user` FOREIGN KEY (`from_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `fk_reaction_to_user` FOREIGN KEY (`to_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB;

DROP TABLE `matching_system`.`violation_report_list`;
DROP TABLE `matching_system`.`footprint`;
DROP TABLE `matching_system`.`like`;

CREATE TABLE `user_invitation_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `invitation_token` varchar(100) NOT NULL,
  `invitation_token_expired_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

ALTER TABLE `matching_system`.`user`
ADD COLUMN `reset_password_token` VARCHAR(100) NULL AFTER `notes_by_admin`,
ADD COLUMN `reset_password_token_expired_at` DATETIME NULL AFTER `reset_password_token`,
ADD COLUMN `reset_password_at` DATETIME NULL AFTER `reset_password_token_expired_at`;

ALTER TABLE `matching_system`.`user_reaction_user`
ADD COLUMN `liked_at` DATETIME NULL AFTER `reason_violation_report`,
ADD COLUMN `report_at` DATETIME NULL AFTER `liked_at`,
ADD COLUMN `blocked_at` DATETIME NULL AFTER `report_at`,
ADD COLUMN `footstep_at` DATETIME NULL AFTER `blocked_at`;

CREATE TABLE `publishing_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `from_user_id` int NOT NULL,
  `to_user_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_image_idx` (`from_user_id`),
  KEY `fk_user_2_idx` (`to_user_id`),
  CONSTRAINT `fk_user_10` FOREIGN KEY (`from_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `fk_user_20` FOREIGN KEY (`to_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB;

ALTER TABLE `matching_system`.`user_reaction_user`
ADD COLUMN `flag_matching` TINYINT NULL AFTER `reaction`;
