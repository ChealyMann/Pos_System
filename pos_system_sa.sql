/*
 Navicat Premium Data Transfer

 Source Server         : Doctor
 Source Server Type    : MySQL
 Source Server Version : 90100
 Source Host           : localhost:3306
 Source Schema         : pos_system_sa

 Target Server Type    : MySQL
 Target Server Version : 90100
 File Encoding         : 65001

 Date: 26/10/2025 23:45:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache
-- ----------------------------

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `category_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`) USING BTREE,
  UNIQUE INDEX `categories_category_name_unique`(`category_name` ASC) USING BTREE,
  INDEX `categories_created_by_foreign`(`created_by` ASC) USING BTREE,
  CONSTRAINT `categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'Electronics', 'Electronic devices and accessories', 'active', 5, '2025-10-26 23:10:49', '2025-10-26 23:10:49');
INSERT INTO `categories` VALUES (2, 'Food & Beverages', 'Food items and drinks', 'active', 5, '2025-10-26 23:10:49', '2025-10-26 23:10:49');
INSERT INTO `categories` VALUES (3, 'Clothing', 'Apparel and fashion items', 'active', 5, '2025-10-26 23:10:49', '2025-10-26 23:10:49');
INSERT INTO `categories` VALUES (4, 'Home & Kitchen', 'Household items and kitchen appliances', 'active', 5, '2025-10-26 23:10:49', '2025-10-26 23:10:49');
INSERT INTO `categories` VALUES (5, 'Health & Beauty', 'Personal care and cosmetic products', 'active', 5, '2025-10-26 23:10:49', '2025-10-26 23:10:49');
INSERT INTO `categories` VALUES (6, 'Sports & Outdoors', 'Sports equipment and outdoor gear', 'active', 5, '2025-10-26 23:10:49', '2025-10-26 23:10:49');
INSERT INTO `categories` VALUES (7, 'Books & Stationery', 'Books, office supplies, and stationery', 'active', 5, '2025-10-26 23:10:49', '2025-10-26 23:10:49');
INSERT INTO `categories` VALUES (8, 'Toys & Games', 'Children toys and gaming products', 'active', 5, '2025-10-26 23:10:49', '2025-10-26 23:10:49');

-- ----------------------------
-- Table structure for countries
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries`  (
  `country_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`country_id`) USING BTREE,
  UNIQUE INDEX `countries_country_name_unique`(`country_name` ASC) USING BTREE,
  UNIQUE INDEX `countries_country_code_unique`(`country_code` ASC) USING BTREE,
  INDEX `countries_created_by_foreign`(`created_by` ASC) USING BTREE,
  CONSTRAINT `countries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES (1, 'Cambodia', 'KH', 'active', 5, '2025-10-26 23:10:49', '2025-10-26 23:10:49');
INSERT INTO `countries` VALUES (2, 'Thailand', 'TH', 'active', 5, '2025-10-26 23:10:49', '2025-10-26 23:10:49');
INSERT INTO `countries` VALUES (3, 'Vietnam', 'VN', 'active', 5, '2025-10-26 23:10:49', '2025-10-26 23:10:49');
INSERT INTO `countries` VALUES (4, 'China', 'CN', 'active', 5, '2025-10-26 23:10:49', '2025-10-26 23:10:49');
INSERT INTO `countries` VALUES (5, 'United States', 'US', 'active', 5, '2025-10-26 23:10:49', '2025-10-26 23:10:49');
INSERT INTO `countries` VALUES (6, 'Japan', 'JP', 'active', 5, '2025-10-26 23:10:49', '2025-10-26 23:10:49');
INSERT INTO `countries` VALUES (7, 'South Korea', 'KR', 'active', 5, '2025-10-26 23:10:49', '2025-10-26 23:10:49');
INSERT INTO `countries` VALUES (8, 'Singapore', 'SG', 'active', 5, '2025-10-26 23:10:49', '2025-10-26 23:10:49');
INSERT INTO `countries` VALUES (9, 'Malaysia', 'MY', 'active', 5, '2025-10-26 23:10:49', '2025-10-26 23:10:49');
INSERT INTO `countries` VALUES (10, 'Indonesia', 'ID', 'active', 5, '2025-10-26 23:10:49', '2025-10-26 23:10:49');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `cancelled_at` int NULL DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of job_batches
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED NULL DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2025_09_16_140953_create_categories_table', 1);
INSERT INTO `migrations` VALUES (5, '2025_09_16_141039_create_stocks_table', 1);
INSERT INTO `migrations` VALUES (6, '2025_09_16_141128_create_countries_table', 1);
INSERT INTO `migrations` VALUES (7, '2025_09_16_141159_create_products_table', 1);
INSERT INTO `migrations` VALUES (8, '2025_09_16_141240_create_roles_table', 1);
INSERT INTO `migrations` VALUES (9, '2025_09_16_141309_create_suppliers_table', 1);
INSERT INTO `migrations` VALUES (10, '2025_09_16_141402_create_stock_ins_table', 1);
INSERT INTO `migrations` VALUES (11, '2025_09_16_141508_create_purchases_table', 1);
INSERT INTO `migrations` VALUES (12, '2025_09_16_141546_create_purchases_details_table', 1);
INSERT INTO `migrations` VALUES (13, '2025_09_16_141615_create_sales_table', 1);
INSERT INTO `migrations` VALUES (14, '2025_09_16_141637_create_sale_items_table', 1);
INSERT INTO `migrations` VALUES (15, '2025_10_05_112938_create_reports_table', 2);
INSERT INTO `migrations` VALUES (16, '2025_10_05_113039_create_report_sales_table', 3);
INSERT INTO `migrations` VALUES (17, '2025_10_05_114722_create_report_stocks_table', 4);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `product_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `barcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `price` decimal(10, 2) NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `country_id` bigint UNSIGNED NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `min_stock` int NULL DEFAULT NULL,
  PRIMARY KEY (`product_id`) USING BTREE,
  UNIQUE INDEX `products_barcode_unique`(`barcode` ASC) USING BTREE,
  UNIQUE INDEX `products_product_name_unique`(`product_name` ASC) USING BTREE,
  INDEX `products_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `products_category_id_foreign`(`category_id` ASC) USING BTREE,
  INDEX `products_country_id_foreign`(`country_id` ASC) USING BTREE,
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `products_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `products_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'ELEC001', 'Wireless Mouse', 'Ergonomic wireless mouse with USB receiver', 15.99, 1, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 20);
INSERT INTO `products` VALUES (2, 'ELEC002', 'USB-C Cable 2m', 'Fast charging USB Type-C cable', 8.50, 1, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 50);
INSERT INTO `products` VALUES (3, 'ELEC003', 'Bluetooth Headphones', 'Noise-cancelling over-ear headphones', 79.99, 1, 6, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 15);
INSERT INTO `products` VALUES (4, 'ELEC004', 'Power Bank 20000mAh', 'Portable charger with dual USB ports', 35.00, 1, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 25);
INSERT INTO `products` VALUES (5, 'ELEC005', 'Smartphone Stand', 'Adjustable phone holder for desk', 12.99, 1, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 30);
INSERT INTO `products` VALUES (6, 'FOOD001', 'Instant Noodles Pack', 'Chicken flavor instant noodles - 5 pack', 3.99, 2, 2, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 100);
INSERT INTO `products` VALUES (7, 'FOOD002', 'Green Tea Box', 'Premium green tea bags - 25 count', 7.50, 2, 6, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 40);
INSERT INTO `products` VALUES (8, 'FOOD003', 'Coconut Water 330ml', 'Natural coconut water drink', 2.50, 2, 2, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 80);
INSERT INTO `products` VALUES (9, 'FOOD004', 'Mixed Nuts 500g', 'Roasted cashews, almonds, and peanuts', 12.99, 2, 3, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 30);
INSERT INTO `products` VALUES (10, 'FOOD005', 'Energy Drink 250ml', 'Sugar-free energy drink', 2.99, 2, 2, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 60);
INSERT INTO `products` VALUES (11, 'CLTH001', 'Cotton T-Shirt', 'Plain cotton t-shirt - Various colors', 9.99, 3, 1, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 40);
INSERT INTO `products` VALUES (12, 'CLTH002', 'Denim Jeans', 'Classic fit denim jeans', 29.99, 3, 1, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 25);
INSERT INTO `products` VALUES (13, 'CLTH003', 'Sports Socks 3-Pack', 'Comfortable athletic socks', 7.99, 3, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 50);
INSERT INTO `products` VALUES (14, 'CLTH004', 'Baseball Cap', 'Adjustable cotton baseball cap', 14.99, 3, 1, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 35);
INSERT INTO `products` VALUES (15, 'CLTH005', 'Hoodie Jacket', 'Warm fleece hoodie with pockets', 34.99, 3, 1, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 20);
INSERT INTO `products` VALUES (16, 'HOME001', 'Ceramic Mug Set', 'Coffee mugs - Set of 4', 16.99, 4, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 30);
INSERT INTO `products` VALUES (17, 'HOME002', 'Kitchen Knife Set', 'Stainless steel knife set with block', 45.00, 4, 6, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 15);
INSERT INTO `products` VALUES (18, 'HOME003', 'Plastic Food Container 5pcs', 'Microwave-safe food storage containers', 11.99, 4, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 40);
INSERT INTO `products` VALUES (19, 'HOME004', 'Digital Kitchen Scale', 'Accurate food scale up to 5kg', 19.99, 4, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 20);
INSERT INTO `products` VALUES (20, 'HOME005', 'Non-Stick Frying Pan', '28cm non-stick pan with handle', 24.99, 4, 2, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 25);
INSERT INTO `products` VALUES (21, 'HLTH001', 'Hand Sanitizer 500ml', 'Antibacterial hand sanitizer gel', 6.99, 5, 2, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 60);
INSERT INTO `products` VALUES (22, 'HLTH002', 'Face Mask 50pcs', 'Disposable 3-ply face masks', 12.99, 5, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 80);
INSERT INTO `products` VALUES (23, 'HLTH003', 'Shampoo 400ml', 'Moisturizing shampoo for all hair types', 8.99, 5, 2, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 45);
INSERT INTO `products` VALUES (24, 'HLTH004', 'Sunscreen SPF50+ 75ml', 'Water-resistant sun protection', 14.99, 5, 7, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 35);
INSERT INTO `products` VALUES (25, 'HLTH005', 'Vitamin C Tablets', 'Daily vitamin supplement - 60 tablets', 9.99, 5, 5, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 40);
INSERT INTO `products` VALUES (26, 'SPRT001', 'Yoga Mat', 'Non-slip exercise yoga mat with bag', 22.99, 6, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 25);
INSERT INTO `products` VALUES (27, 'SPRT002', 'Water Bottle 1L', 'Insulated stainless steel bottle', 18.99, 6, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 40);
INSERT INTO `products` VALUES (28, 'SPRT003', 'Resistance Bands Set', 'Exercise bands with 3 resistance levels', 15.99, 6, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 30);
INSERT INTO `products` VALUES (29, 'SPRT004', 'Jump Rope', 'Adjustable speed jump rope', 8.99, 6, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 35);
INSERT INTO `products` VALUES (30, 'SPRT005', 'Camping Backpack 40L', 'Waterproof hiking backpack', 49.99, 6, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 15);
INSERT INTO `products` VALUES (31, 'BOOK001', 'Notebook A5', 'Ruled notebook - 200 pages', 4.99, 7, 1, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 60);
INSERT INTO `products` VALUES (32, 'BOOK002', 'Ballpoint Pens 10pcs', 'Blue ink ballpoint pens', 5.99, 7, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 80);
INSERT INTO `products` VALUES (33, 'BOOK003', 'Highlighter Set', 'Fluorescent markers - 6 colors', 6.99, 7, 6, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 50);
INSERT INTO `products` VALUES (34, 'BOOK004', 'Sticky Notes Pack', 'Colorful sticky notes - Various sizes', 7.99, 7, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 70);
INSERT INTO `products` VALUES (35, 'BOOK005', 'Desk Organizer', 'Multi-compartment desk organizer', 14.99, 7, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 25);
INSERT INTO `products` VALUES (36, 'TOYS001', 'Building Blocks 500pcs', 'Creative building block set', 24.99, 8, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 20);
INSERT INTO `products` VALUES (37, 'TOYS002', 'Puzzle 1000 Pieces', 'Scenic landscape jigsaw puzzle', 16.99, 8, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 25);
INSERT INTO `products` VALUES (38, 'TOYS003', 'Remote Control Car', 'Fast RC car with rechargeable battery', 39.99, 8, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 15);
INSERT INTO `products` VALUES (39, 'TOYS004', 'Board Game - Strategy', 'Family strategy board game for 2-4 players', 29.99, 8, 5, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 20);
INSERT INTO `products` VALUES (40, 'TOYS005', 'Art Supply Set', 'Drawing and coloring kit for kids', 19.99, 8, 4, 5, 'active', '1761495367_feature-10 - Copy.jpg', '2025-10-26 23:10:49', '2025-10-26 23:10:49', 30);

-- ----------------------------
-- Table structure for purchases
-- ----------------------------
DROP TABLE IF EXISTS `purchases`;
CREATE TABLE `purchases`  (
  `purchase_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint UNSIGNED NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `purchase_date` date NOT NULL,
  `total_amount` decimal(10, 2) NOT NULL,
  `payment_method` enum('cash','aba','acleda','other_bank') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `status` enum('pending','completed','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`purchase_id`) USING BTREE,
  INDEX `purchases_supplier_id_foreign`(`supplier_id` ASC) USING BTREE,
  INDEX `purchases_created_by_foreign`(`created_by` ASC) USING BTREE,
  CONSTRAINT `purchases_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `purchases_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of purchases
-- ----------------------------

-- ----------------------------
-- Table structure for purchases_details
-- ----------------------------
DROP TABLE IF EXISTS `purchases_details`;
CREATE TABLE `purchases_details`  (
  `purchase_detail_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `purchase_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `unit_cost` decimal(10, 2) NOT NULL,
  `expiry_date` date NULL DEFAULT NULL,
  `total_cost` decimal(10, 2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`purchase_detail_id`) USING BTREE,
  INDEX `purchases_details_purchase_id_foreign`(`purchase_id` ASC) USING BTREE,
  INDEX `purchases_details_product_id_foreign`(`product_id` ASC) USING BTREE,
  CONSTRAINT `purchases_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `purchases_details_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`purchase_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of purchases_details
-- ----------------------------

-- ----------------------------
-- Table structure for report_sales
-- ----------------------------
DROP TABLE IF EXISTS `report_sales`;
CREATE TABLE `report_sales`  (
  `report_sale_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `report_id` bigint UNSIGNED NOT NULL,
  `sale_id` bigint UNSIGNED NOT NULL,
  `sale_date` date NOT NULL,
  `total_amount` double NOT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `discount_amount` double NOT NULL,
  `tax_amount` double NOT NULL,
  `subtotal_amount` double NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`report_sale_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of report_sales
-- ----------------------------

-- ----------------------------
-- Table structure for report_stocks
-- ----------------------------
DROP TABLE IF EXISTS `report_stocks`;
CREATE TABLE `report_stocks`  (
  `report_stock_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `report_id` bigint UNSIGNED NOT NULL,
  `stock_in_id` bigint UNSIGNED NOT NULL,
  `stock_in_date` date NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty_received` int NOT NULL,
  `cost_per_item` double NOT NULL,
  `expire_date` date NULL DEFAULT NULL,
  `create_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`report_stock_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of report_stocks
-- ----------------------------

-- ----------------------------
-- Table structure for reports
-- ----------------------------
DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports`  (
  `report_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `report_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `report_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `generate_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_records` int NOT NULL,
  `total_amount` double NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`report_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reports
-- ----------------------------
INSERT INTO `reports` VALUES (1, 'Monthly Sales', 'Orli Goodman', '1993-11-01', 'Mann123123', 0, 0, '2025-10-06 03:41:30', 'Mann123123');
INSERT INTO `reports` VALUES (2, 'Current Stock', 'Carly Mccray', '2010-05-01', 'Mann123123', 0, 0, '2025-10-06 03:41:34', 'Mann123123');
INSERT INTO `reports` VALUES (3, 'Monthly Sales', 'Filter', '2025-10-01', 'Mann', 1, 100, '2025-10-06 10:03:57', 'Mann');
INSERT INTO `reports` VALUES (4, 'Current Stock', 'Stock', '2025-10-01', 'Mann', 1, 0, '2025-10-06 10:05:07', 'Mann');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `role_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`) USING BTREE,
  UNIQUE INDEX `roles_role_name_unique`(`role_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'admin', '123', 'active', '2025-10-06 03:16:08', '2025-10-26 15:37:11');
INSERT INTO `roles` VALUES (2, 'cashier', 'Admin', 'active', '2025-10-06 07:35:08', '2025-10-26 15:49:49');

-- ----------------------------
-- Table structure for sale_items
-- ----------------------------
DROP TABLE IF EXISTS `sale_items`;
CREATE TABLE `sale_items`  (
  `sale_item_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sale_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `unit_price` decimal(10, 2) NOT NULL,
  `total_price` decimal(10, 2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sale_item_id`) USING BTREE,
  INDEX `sale_items_sale_id_foreign`(`sale_id` ASC) USING BTREE,
  INDEX `sale_items_product_id_foreign`(`product_id` ASC) USING BTREE,
  CONSTRAINT `sale_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `sale_items_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`sale_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sale_items
-- ----------------------------

-- ----------------------------
-- Table structure for sales
-- ----------------------------
DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales`  (
  `sale_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sale_by` bigint UNSIGNED NOT NULL,
  `total_amount` decimal(10, 2) NOT NULL,
  `payment_method` enum('cash','aba','acleda','other_bank') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `status` enum('paid','unpaid') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'paid',
  `sale_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sale_id`) USING BTREE,
  INDEX `sales_sale_by_foreign`(`sale_by` ASC) USING BTREE,
  CONSTRAINT `sales_sale_by_foreign` FOREIGN KEY (`sale_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sales
-- ----------------------------

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id` ASC) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('eQXeDzOMV1bLmRE1LgwRB0PAPf9ndEto3aBiAizB', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicWQ1cTlmMFRmRUU3MjlkOFpRTkg3T2tKbVpXcmlwd3ROcDJxcmQwYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Nzt9', 1761497095);

-- ----------------------------
-- Table structure for stock_ins
-- ----------------------------
DROP TABLE IF EXISTS `stock_ins`;
CREATE TABLE `stock_ins`  (
  `stock_in_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `purchase_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `cost_per_item` decimal(10, 2) NOT NULL,
  `expire_date` date NULL DEFAULT NULL,
  `qty_in_stock` int NOT NULL,
  `stock_in_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`stock_in_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stock_ins
-- ----------------------------
INSERT INTO `stock_ins` VALUES (1, 1, 2, 2, 100, 1.00, '2025-10-07', 100, '2025-10-06 07:34:43', '2025-10-06 07:34:43', '2025-10-06 07:34:43');
INSERT INTO `stock_ins` VALUES (2, 2, 3, 2, 100, 1.00, '2025-10-25', 100, '2025-10-06 10:08:23', '2025-10-06 10:08:23', '2025-10-06 10:08:23');

-- ----------------------------
-- Table structure for stocks
-- ----------------------------
DROP TABLE IF EXISTS `stocks`;
CREATE TABLE `stocks`  (
  `stock_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `avg_cost` decimal(10, 2) NOT NULL,
  `total_qty_in_stock` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`stock_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stocks
-- ----------------------------
INSERT INTO `stocks` VALUES (1, 2, 1.00, 100);
INSERT INTO `stocks` VALUES (2, 3, 1.00, 100);

-- ----------------------------
-- Table structure for suppliers
-- ----------------------------
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers`  (
  `supplier_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `alt_phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gender` enum('Male','Female') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_by` bigint UNSIGNED NOT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`supplier_id`) USING BTREE,
  UNIQUE INDEX `suppliers_supplier_code_unique`(`supplier_code` ASC) USING BTREE,
  UNIQUE INDEX `suppliers_email_unique`(`email` ASC) USING BTREE,
  INDEX `suppliers_created_by_foreign`(`created_by` ASC) USING BTREE,
  CONSTRAINT `suppliers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES (6, 'Et ducimus nostrum', 'Avram Boyle', '+1 (717) 787-8439', NULL, 'jaromogohe@mailinator.com', NULL, NULL, '1761488941_Generated Image October 24, 2025 - 9_39AM.png', 'Inactive', 5, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `usercode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female','other') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  UNIQUE INDEX `users_usercode_unique`(`usercode` ASC) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (5, 'admin123', 'admin', 'male', 'admin@gmail.com', '0123456789', '$2y$12$MM9MxEmhToCYUkPS0KyKHeEwBpARH1jWGdeRY1TZivUZnw8QpIEnu', 'active', '1759736198_20221107_150347.JPG.jpg', NULL, '2025-10-26 13:50:07', '2025-10-26 14:13:50', 1);
INSERT INTO `users` VALUES (6, 'Ad quaerat aliquid v', 'Cleaner', 'male', 'bogisobisi@mailinator.com', '01928323', '$2y$12$sWFSjpCsPfKEN5LZp.z8ROQRGUvjjgkdVlkqSgVsjRg/v11YOpRC6', 'inactive', '1761493200_how-to-install-apache2-on-ubuntu-16-04-18-04-18-10.jpg', NULL, '2025-10-26 15:39:38', '2025-10-26 15:40:00', 2);
INSERT INTO `users` VALUES (7, 'Est laboriosam dol', 'cashier', 'male', 'nijo@mailinator.com', '01028333', '$2y$12$yhfvoDgTK1yREmzC/jBqku0SJme0BBa0fqvbBecJclIvtHlZ4FwIW', 'active', '1761493824_OIP (1).jpg', NULL, '2025-10-26 15:50:24', '2025-10-26 15:57:31', 2);

SET FOREIGN_KEY_CHECKS = 1;
