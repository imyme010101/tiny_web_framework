-- --------------------------------------------------------
-- 호스트:                          127.0.0.1
-- 서버 버전:                        5.7.24 - MySQL Community Server (GPL)
-- 서버 OS:                        Win64
-- HeidiSQL 버전:                  12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- shop 데이터베이스 구조 내보내기
CREATE DATABASE IF NOT EXISTS `shop` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `shop`;

-- 테이블 shop.board 구조 내보내기
CREATE TABLE IF NOT EXISTS `board` (
  `id` char(10) NOT NULL,
  `subject` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.board:~0 rows (대략적) 내보내기

-- 테이블 shop.board_comment 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_comment` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `board_write_idx` int(11) NOT NULL,
  `parent_idx` int(11) NOT NULL,
  `member_id` char(12) NOT NULL,
  `parent_member_id` char(12) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.board_comment:~0 rows (대략적) 내보내기

-- 테이블 shop.board_file 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_file` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `type` char(1) NOT NULL COMMENT 'C: comment W: write',
  `parent_idx` int(11) NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `org_file_name` varchar(200) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.board_file:~0 rows (대략적) 내보내기

-- 테이블 shop.board_write 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_write` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.board_write:~0 rows (대략적) 내보내기

-- 테이블 shop.campaign_apply 구조 내보내기
CREATE TABLE IF NOT EXISTS `campaign_apply` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(50) NOT NULL DEFAULT '0',
  `campaign_idx` int(11) NOT NULL DEFAULT '0',
  `campaign_reward` int(11) NOT NULL DEFAULT '0',
  `write` enum('Y','N') NOT NULL DEFAULT 'N',
  `status` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'Y 선정',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.campaign_apply:~0 rows (대략적) 내보내기
INSERT INTO `campaign_apply` (`idx`, `member_id`, `campaign_idx`, `campaign_reward`, `write`, `status`, `created_at`) VALUES
	(2, 'imyme', 1, 2000, 'N', 'N', '2023-09-14 02:44:16');

-- 테이블 shop.campaign_category 구조 내보내기
CREATE TABLE IF NOT EXISTS `campaign_category` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `parent_idx` int(11) NOT NULL DEFAULT '0',
  `no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.campaign_category:~14 rows (대략적) 내보내기
INSERT INTO `campaign_category` (`idx`, `name`, `parent_idx`, `no`) VALUES
	(1, '체험형', 0, 0),
	(2, '상품형', 0, 0),
	(3, '맛집', 1, 0),
	(4, '뷰티', 1, 0),
	(5, '숙박', 1, 0),
	(6, '문화', 1, 0),
	(7, '기타', 1, 0),
	(8, '식품', 2, 0),
	(9, '뷰티', 2, 0),
	(10, '도서', 2, 0),
	(11, '생활', 2, 0),
	(12, '반려동물', 2, 0),
	(13, '기자단', 2, 0),
	(14, '기타', 2, 0),
	(15, '기자단', 0, 0);

-- 테이블 shop.campaign_list 구조 내보내기
CREATE TABLE IF NOT EXISTS `campaign_list` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `memo` text,
  `stock` int(11) DEFAULT '0' COMMENT '모집인원/갯수',
  `apply` int(11) DEFAULT '0',
  `point` int(11) DEFAULT '0' COMMENT '기자단 포인트',
  `category_depth` varchar(8) DEFAULT NULL,
  `media` varchar(50) DEFAULT NULL COMMENT 'naver:네이버블로그,instagram:인스타,receipt:영수증',
  `start_date` timestamp NULL DEFAULT NULL COMMENT '캠페인 신청 시작 일',
  `end_date` timestamp NULL DEFAULT NULL COMMENT '캠페인 신청 끝 일',
  `pick_date` timestamp NULL DEFAULT NULL COMMENT '리뷰어 선정일',
  `write_start_date` timestamp NULL DEFAULT NULL COMMENT '콘텐츠 등록 시작 ',
  `write_end_date` timestamp NULL DEFAULT NULL COMMENT '콘텐츠 등록 끝',
  `main_img` varchar(255) DEFAULT NULL COMMENT '상품설명 이미지',
  `m_main_img` varchar(255) DEFAULT NULL COMMENT '모바일 상품설명 이미지',
  `thumb_img` varchar(255) DEFAULT NULL COMMENT '썸네일 이미지',
  `m_thumb_img` varchar(255) DEFAULT NULL COMMENT '모바일 썸네일 이미지',
  `detail_contents` text COMMENT '제공내역',
  `info` text COMMENT '방문및예약안내',
  `mission` text COMMENT '캠페인미션',
  `title_tags` text COMMENT '제목태그',
  `contents_tags` text COMMENT '내용태그',
  `guide` text COMMENT '가이드라인',
  `caution` text COMMENT '주의사항',
  `zip_code` char(7) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address_detail` varchar(255) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `md` enum('Y','N') DEFAULT 'N',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.campaign_list:~1 rows (대략적) 내보내기
INSERT INTO `campaign_list` (`idx`, `title`, `memo`, `stock`, `apply`, `point`, `category_depth`, `media`, `start_date`, `end_date`, `pick_date`, `write_start_date`, `write_end_date`, `main_img`, `m_main_img`, `thumb_img`, `m_thumb_img`, `detail_contents`, `info`, `mission`, `title_tags`, `contents_tags`, `guide`, `caution`, `zip_code`, `address`, `address_detail`, `area`, `md`, `created_at`) VALUES
	(1, 'ㅈㄷㄹ', 'ㅈㄷㄹ', 1, 1, 2000, '001003', 'naver', '2023-09-04 15:00:00', '2023-09-04 15:00:00', '2023-09-04 15:00:00', '2023-09-04 15:00:00', '2023-09-04 15:00:00', '/uploads/cp/64f6c0e88d345.jpg', '/uploads/cp/64f6c0e88d391.jpg', '/uploads/cp/64f6a2304e04a.png', '/uploads/cp/64f6a2304e052.png', 'ㅈㄷㄹㅈㄷㄹㄷㅈㄹ', '123', '123', '테스트 키워드', 'ㅇㅇㅇ', 'ㅇㅇㅇ', 'ㅂㅂㅂ', '13944', '경기 안양시 동안구 관악대로 276', '123123', '강원도', 'Y', '2023-09-05 03:38:14');

-- 테이블 shop.campaign_review 구조 내보내기
CREATE TABLE IF NOT EXISTS `campaign_review` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(50) NOT NULL DEFAULT '0',
  `campaign_idx` int(11) NOT NULL DEFAULT '0',
  `url` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- 테이블 데이터 shop.campaign_review:~1 rows (대략적) 내보내기
INSERT INTO `campaign_review` (`idx`, `member_id`, `campaign_idx`, `url`, `created_at`) VALUES
	(2, 'imyme', 1, 'https://velog.io/@dongwon/Uncaught-Error-Call-to-a-member-function-query-on-null-in', '2023-09-14 00:53:08');

-- 테이블 shop.cart 구조 내보내기
CREATE TABLE IF NOT EXISTS `cart` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` char(12) NOT NULL,
  `item_idx` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '1' COMMENT '카트 수량',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`),
  KEY `member_id` (`member_id`),
  KEY `item_idx` (`item_idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.cart:~0 rows (대략적) 내보내기

-- 테이블 shop.coupon 구조 내보내기
CREATE TABLE IF NOT EXISTS `coupon` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` varchar(50) NOT NULL,
  `discount_rate` int(11) NOT NULL DEFAULT '0',
  `discount_price` int(11) NOT NULL DEFAULT '0',
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('ENABLE','DISABLE') NOT NULL DEFAULT 'ENABLE',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.coupon:~2 rows (대략적) 내보내기
INSERT INTO `coupon` (`idx`, `title`, `content`, `discount_rate`, `discount_price`, `start_date`, `end_date`, `status`, `created_at`) VALUES
	(1, '할인쿠폰 퍼센트', '할인쿠폰', 20, 0, '2019-01-01 00:00:00', '0000-00-00 00:00:00', 'ENABLE', '2023-08-23 06:33:36'),
	(2, '할인쿠폰 가격', '할인쿠폰', 0, 1000, '2019-01-01 00:00:00', '2019-01-01 00:00:00', 'ENABLE', '2023-08-23 06:33:36');

-- 테이블 shop.flyway_schema_history 구조 내보내기
CREATE TABLE IF NOT EXISTS `flyway_schema_history` (
  `installed_rank` int(11) NOT NULL,
  `version` varchar(50) DEFAULT NULL,
  `description` varchar(200) NOT NULL,
  `type` varchar(20) NOT NULL,
  `script` varchar(1000) NOT NULL,
  `checksum` int(11) DEFAULT NULL,
  `installed_by` varchar(100) NOT NULL,
  `installed_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `execution_time` int(11) NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`installed_rank`),
  KEY `flyway_schema_history_s_idx` (`success`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.flyway_schema_history:~0 rows (대략적) 내보내기
INSERT INTO `flyway_schema_history` (`installed_rank`, `version`, `description`, `type`, `script`, `checksum`, `installed_by`, `installed_on`, `execution_time`, `success`) VALUES
	(1, '1', 'init', 'SQL', 'V1__init.sql', -86951482, 'root', '2023-08-23 06:33:37', 962, 1);

-- 테이블 shop.member 구조 내보내기
CREATE TABLE IF NOT EXISTS `member` (
  `id` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL,
  `roles` varchar(9) NOT NULL DEFAULT 'U,WH,P0' COMMENT 'U:유저, C:카페, A:관리자 role 테이블 참죠',
  `name` char(20) DEFAULT NULL,
  `nick` char(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone_number` varchar(13) DEFAULT NULL,
  `email` char(32) DEFAULT NULL,
  `zip_code` varchar(7) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address_detail` varchar(100) DEFAULT NULL,
  `gender` enum('','MALE','FEMALE') DEFAULT '',
  `use_sns` varchar(100) DEFAULT NULL,
  `sns` varchar(255) DEFAULT NULL,
  `marketing` enum('Y','N') DEFAULT 'N',
  `point` int(11) DEFAULT '0',
  `status` enum('ENABLE','DISABLE') NOT NULL DEFAULT 'ENABLE',
  `delete_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `phone_number` (`phone_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.member:~3 rows (대략적) 내보내기
INSERT INTO `member` (`id`, `password`, `roles`, `name`, `nick`, `date_of_birth`, `phone_number`, `email`, `zip_code`, `address`, `address_detail`, `gender`, `use_sns`, `sns`, `marketing`, `point`, `status`, `delete_at`, `created_at`) VALUES
	('imyme', '*A290D05B59657677BD96771F3149D098FAAE2047', 'U,WH,P1', '장진수', 'imyme', NULL, '01083791634', 'imyme@gmail.com', '13947', '경기 안양시 동안구 관악대로 376', '1', 'MALE', 'instagram,naver,youtube,tiktok', '{"instagram":"","naver":"imyme","youtube":"imyme","tiktok":""}', 'Y', 10000, 'ENABLE', '0000-00-00 00:00:00', '2023-09-05 01:25:54'),
	('imyme010101', '*A290D05B59657677BD96771F3149D098FAAE2047', 'U,PR,P1', '장진수', '관리자', '0000-00-00', '00000000000', 'test', '000000', 'test', '88', 'MALE', 'instagram,naver,tiktok', '{"instagram": "test", "naver": "test", "tiktok": "test"}', 'N', 0, 'ENABLE', '0000-00-00 00:00:00', '2023-08-23 06:33:36'),
	('imyme01010101', '*A290D05B59657677BD96771F3149D098FAAE2047', 'U,WH,P0', '장진수', '아이마이미', NULL, '123', 'imyme01010101@gmail.com', '1234123', '경기도', '2', 'MALE', 'instagrame', '{"instagrame":"imyme01010101"}', 'Y', 0, 'DISABLE', '2023-09-04 06:01:53', '2023-09-04 05:09:34');

-- 테이블 shop.member_addr 구조 내보내기
CREATE TABLE IF NOT EXISTS `member_addr` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(12) NOT NULL,
  `zip_code` varchar(7) NOT NULL,
  `addr` varchar(100) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.member_addr:~0 rows (대략적) 내보내기

-- 테이블 shop.member_coupon 구조 내보내기
CREATE TABLE IF NOT EXISTS `member_coupon` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_idx` int(11) NOT NULL,
  `member_id` char(12) NOT NULL,
  `used_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.member_coupon:~0 rows (대략적) 내보내기
INSERT INTO `member_coupon` (`idx`, `coupon_idx`, `member_id`, `used_at`, `created_at`) VALUES
	(1, 1, 'test', '0000-00-00 00:00:00', '2023-08-23 06:33:36');

-- 테이블 shop.member_penalty_log 구조 내보내기
CREATE TABLE IF NOT EXISTS `member_penalty_log` (
  `member_id` varchar(12) NOT NULL,
  `penalty` varchar(12) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.member_penalty_log:~2 rows (대략적) 내보내기
INSERT INTO `member_penalty_log` (`member_id`, `penalty`, `comment`, `created_at`) VALUES
	('imyme', 'P3', '888', '2023-09-13 02:21:04'),
	('imyme', 'P0', '', '2023-09-13 02:28:55'),
	('imyme', 'P1', '테스트', '2023-09-13 02:29:25');

-- 테이블 shop.member_point_log 구조 내보내기
CREATE TABLE IF NOT EXISTS `member_point_log` (
  `member_id` varchar(12) NOT NULL,
  `point` int(11) NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.member_point_log:~0 rows (대략적) 내보내기
INSERT INTO `member_point_log` (`member_id`, `point`, `comment`, `created_at`) VALUES
	('imyme', -100, 'ㄷㄷㄷㄷㄷㄷ', '2023-09-13 10:18:09'),
	('imyme', 2000, '캠페인 포인트 지급.', '2023-09-14 02:46:17');

-- 테이블 shop.member_role 구조 내보내기
CREATE TABLE IF NOT EXISTS `member_role` (
  `type` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '1',
  `role` varchar(2) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL,
  `cnt` int(11) NOT NULL DEFAULT '0',
  `point` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.member_role:~14 rows (대략적) 내보내기
INSERT INTO `member_role` (`type`, `sort`, `role`, `name`, `cnt`, `point`) VALUES
	(1, 1, 'WH', 'WHITE', 0, 1000),
	(1, 2, 'BR', 'BRONZE', 10, 3000),
	(1, 3, 'SI', 'SILVER', 30, 5000),
	(1, 4, 'GO', 'GOLD', 50, 7000),
	(1, 5, 'PL', 'PLATINUM', 80, 10000),
	(1, 6, 'DI', 'DIAMOND', 120, 30000),
	(1, 7, 'PR', 'PREMIER', 9999, 10000),
	(0, 1, 'U', '유저', 0, 0),
	(2, 2, 'P1', '패널티 LV1', 0, 0),
	(2, 3, 'P2', '패널티 LV2', 0, 0),
	(2, 4, 'P3', '패널티 LV3', 0, 0),
	(2, 5, 'P4', '패널티 LV4', 0, 0),
	(2, 6, 'P5', '패널티 LV5', 0, 0),
	(2, 1, 'P0', '패널티 LV0', 0, 0);

-- 테이블 shop.member_wallet 구조 내보내기
CREATE TABLE IF NOT EXISTS `member_wallet` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(50) NOT NULL,
  `point` int(11) NOT NULL DEFAULT '0',
  `status` enum('Y','N') NOT NULL DEFAULT 'N',
  `created_ap` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 테이블 데이터 shop.member_wallet:~0 rows (대략적) 내보내기

-- 테이블 shop.orders 구조 내보내기
CREATE TABLE IF NOT EXISTS `orders` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` char(12) NOT NULL,
  `item_idx` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `order_memo` varchar(255) DEFAULT NULL,
  `addressee` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `number` varchar(13) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'ORDER' COMMENT 'ORDER, CANCEL',
  `delivery_status` varchar(20) NOT NULL DEFAULT 'READY' COMMENT 'DELIVERED, WAIT, READY, PLAY, COMPLETED',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`),
  KEY `member_id` (`member_id`),
  KEY `item_idx` (`item_idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.orders:~0 rows (대략적) 내보내기

-- 테이블 shop.product_category 구조 내보내기
CREATE TABLE IF NOT EXISTS `product_category` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `depth` varchar(15) NOT NULL,
  `status` enum('ENABLE','DISABLE') NOT NULL DEFAULT 'ENABLE',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.product_category:~0 rows (대략적) 내보내기

-- 테이블 shop.product_file 구조 내보내기
CREATE TABLE IF NOT EXISTS `product_file` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `type` char(1) NOT NULL COMMENT 'P: 상품 O: 옵션',
  `parent_idx` int(11) NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `org_file_name` varchar(200) NOT NULL,
  `sort` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.product_file:~0 rows (대략적) 내보내기

-- 테이블 shop.product_info 구조 내보내기
CREATE TABLE IF NOT EXISTS `product_info` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `content` text,
  `info` text,
  `status` enum('ENABLE','DISABLE') NOT NULL DEFAULT 'ENABLE',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.product_info:~0 rows (대략적) 내보내기
INSERT INTO `product_info` (`idx`, `title`, `content`, `info`, `status`, `created_at`) VALUES
	(1, '청바지', '리바이스 청바지 입니다.', '{company:"리바이스}', 'ENABLE', '2023-08-23 06:33:36');

-- 테이블 shop.product_item 구조 내보내기
CREATE TABLE IF NOT EXISTS `product_item` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `info_idx` int(11) NOT NULL COMMENT '상품 idx',
  `option_idx` int(11) DEFAULT '0' COMMENT '카테고리 idx',
  `price` int(11) DEFAULT '0' COMMENT '상품인 경우 가격 옵션인 경우 0~ 옵션 가격',
  `discount_rate` int(11) NOT NULL DEFAULT '0',
  `discount_price` int(11) NOT NULL DEFAULT '0',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT '재고 수량',
  `status` enum('ENABLE','DISABLE') NOT NULL DEFAULT 'ENABLE',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`),
  KEY `info_idx` (`info_idx`),
  KEY `option_idx` (`option_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.product_item:~0 rows (대략적) 내보내기
INSERT INTO `product_item` (`idx`, `info_idx`, `option_idx`, `price`, `discount_rate`, `discount_price`, `stock`, `status`, `created_at`) VALUES
	(1, 1, 0, 20000, 0, 0, 100, 'ENABLE', '2023-08-23 06:58:32');

-- 테이블 shop.product_option 구조 내보내기
CREATE TABLE IF NOT EXISTS `product_option` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `info_idx` int(11) NOT NULL COMMENT '상품 idx',
  `name` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `depth` varchar(150) NOT NULL DEFAULT '00' COMMENT '00000000 2자리씩 뎁스 표현',
  `type` char(1) NOT NULL COMMENT 'I: 개별 옵션, R: 필수',
  `status` enum('ENABLE','DISABLE') NOT NULL DEFAULT 'ENABLE',
  PRIMARY KEY (`idx`),
  KEY `info_idx` (`info_idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.product_option:~0 rows (대략적) 내보내기

-- 테이블 shop.redis 구조 내보내기
CREATE TABLE IF NOT EXISTS `redis` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.redis:~4 rows (대략적) 내보내기
INSERT INTO `redis` (`idx`, `name`, `data`, `created_at`) VALUES
	(1, 'test_access_token', 'eyJhbGciOiJzaGEyNTYiLCJ0eXAiOiJKV1QifS57ImV4cCI6MTY5MzI3MDM0MCwiaWF0IjoxNjkzMjU5NTQwLCJpZCI6InRlc3QiLCJlbWFpbCI6InRlc3QiLCJwYXNzd29yZCI6Iio5NEJEQ0VCRTE5MDgzQ0UyQTFGOTU5RkQwMkY5NjRDN0FGNENGQzI5IiwicnVsZXMiOlsiVSJdfS40NjYzOWI0NDI2MzQyM2Q2NzY0NTI5M2Y3MTE2ZWVlZGNhZWRlMGNiN2QyM2FlMzNjNTc0ZjNmZGUxNWE2MjU4', '2023-08-28 21:52:20'),
	(2, 'test_refresh_token', 'eyJhbGciOiJzaGEyNTYiLCJ0eXAiOiJKV1QifS57ImV4cCI6MCwiaWF0IjoxNjkzMjU5NTQwLCJpZCI6InRlc3QiLCJlbWFpbCI6InRlc3QiLCJwYXNzd29yZCI6Iio5NEJEQ0VCRTE5MDgzQ0UyQTFGOTU5RkQwMkY5NjRDN0FGNENGQzI5IiwicnVsZXMiOlsiVSJdfS45M2YxOTZkZDNjY2UzYWUwMWMyZWY0YTU2MzU4ZmU3MmZmZDY1YzVkYzUwY2I0ZGUyZGYyY2JjZDRjNWFiZDhk', '2023-08-28 21:52:20'),
	(7, 'imyme010101_access_token', 'eyJhbGciOiJzaGEyNTYiLCJ0eXAiOiJKV1QifS57ImV4cCI6MTY5MzgzMDIwNiwiaWF0IjoxNjkzODE5NDA2LCJpZCI6ImlteW1lMDEwMTAxIiwiZW1haWwiOiJ0ZXN0IiwicGFzc3dvcmQiOiIqQTI5MEQwNUI1OTY1NzY3N0JEOTY3NzFGMzE0OUQwOThGQUFFMjA0NyIsInJ1bGVzIjpbIlUiLCJQUiIsIlAxIl19LmFlMjBiOGFmYmM0NDhlNzFkNWIxZTYzYzcxNDRhYzhjMDI4NDlmYWQwNTZhY2JhYjk2NjIxZGYxNWJkN2MwOWU=', '2023-09-04 09:23:26'),
	(8, 'imyme010101_refresh_token', 'eyJhbGciOiJzaGEyNTYiLCJ0eXAiOiJKV1QifS57ImV4cCI6MCwiaWF0IjoxNjkzODE5NDA2LCJpZCI6ImlteW1lMDEwMTAxIiwiZW1haWwiOiJ0ZXN0IiwicGFzc3dvcmQiOiIqQTI5MEQwNUI1OTY1NzY3N0JEOTY3NzFGMzE0OUQwOThGQUFFMjA0NyIsInJ1bGVzIjpbIlUiLCJQUiIsIlAxIl19LjljNTAxM2RiZjA2YWQ0YWQ3MjUwYjA4ZDlmZGI4NDdlM2M4NTM5YzVmNzNjNGEwZGUwYzU5N2EzYmY2MGM1MmM=', '2023-09-04 09:23:26');

-- 테이블 shop.review 구조 내보내기
CREATE TABLE IF NOT EXISTS `review` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` char(12) NOT NULL,
  `item_idx` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` enum('ENABLE','DISABLE') NOT NULL DEFAULT 'DISABLE',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyd_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.review:~0 rows (대략적) 내보내기

-- 테이블 shop.wish 구조 내보내기
CREATE TABLE IF NOT EXISTS `wish` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` char(12) NOT NULL,
  `campaign_idx` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`),
  KEY `member_id` (`member_id`),
  KEY `item_idx` (`campaign_idx`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- 테이블 데이터 shop.wish:~2 rows (대략적) 내보내기
INSERT INTO `wish` (`idx`, `member_id`, `campaign_idx`, `created_at`) VALUES
	(1, 'test', 1, '2023-09-12 04:20:39'),
	(2, 'test', 1, '2023-09-12 04:20:49');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
