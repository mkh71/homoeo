

CREATE TABLE `complains` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO complains VALUES("8","10","jor","","2022-07-07 00:40:48","2022-07-07 00:40:48");
INSERT INTO complains VALUES("9","10","fdgsfd","","2022-07-07 01:37:36","2022-07-07 01:37:36");



CREATE TABLE `doses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO doses VALUES("1","1-1-0","2022-07-03 12:09:05","2022-07-07 01:43:50");
INSERT INTO doses VALUES("2","1-0-1","2022-07-03 12:09:14","2022-07-03 12:09:14");
INSERT INTO doses VALUES("3","0-0-1","2022-07-03 12:09:23","2022-07-03 12:09:23");



CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `medicines` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO medicines VALUES("1","napa","2022-07-03 12:09:38","2022-07-03 12:09:38");
INSERT INTO medicines VALUES("2","napa Extra","2022-07-03 12:09:49","2022-07-03 12:09:49");
INSERT INTO medicines VALUES("3","paracetamol","2022-07-03 12:10:03","2022-07-03 12:10:03");



CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES("1","2014_10_12_000000_create_users_table","1");
INSERT INTO migrations VALUES("2","2014_10_12_100000_create_password_resets_table","1");
INSERT INTO migrations VALUES("3","2019_08_19_000000_create_failed_jobs_table","1");
INSERT INTO migrations VALUES("4","2019_12_14_000001_create_personal_access_tokens_table","1");
INSERT INTO migrations VALUES("5","2022_06_04_021639_create_patients_table","1");
INSERT INTO migrations VALUES("6","2022_06_04_121354_create_complains_table","1");
INSERT INTO migrations VALUES("7","2022_06_10_014638_create_powers_table","1");
INSERT INTO migrations VALUES("8","2022_06_10_014901_create_doses_table","1");
INSERT INTO migrations VALUES("9","2022_06_10_180727_create_medicines_table","1");
INSERT INTO migrations VALUES("10","2022_06_29_012553_create_purpose_medicines_table","1");



CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `patients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `serial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` double(8,1) DEFAULT NULL,
  `dues` int(11) DEFAULT NULL,
  `last_complain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `patients_serial_unique` (`serial`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO patients VALUES("1","201","Maynuddin","01835193038","satkani","26.0","2000","wertwertwer","2022-07-03 12:14:27","2022-07-05 12:18:10");
INSERT INTO patients VALUES("4","63","Larissa Crawford","Distinctio Exercita","Est quisquam officia","49.0","3","In autem qui tempora","2022-07-06 23:39:03","2022-07-06 23:39:03");
INSERT INTO patients VALUES("7","42","Mollie Taylor","Incidunt est repreh","Deserunt odit ut con","5.0","65","Deserunt sit totam v","2022-07-06 23:50:38","2022-07-06 23:50:38");
INSERT INTO patients VALUES("10","95","Lucy Dawson","Inventore molestiae","Velit in sed cupida","2.0","50","fdgsfd","2022-07-06 23:54:25","2022-07-07 01:37:36");



CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `powers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO powers VALUES("1","100","2022-07-03 12:08:41","2022-07-03 12:08:41");
INSERT INTO powers VALUES("2","200","2022-07-03 12:08:46","2022-07-03 12:08:46");
INSERT INTO powers VALUES("3","50","2022-07-03 12:08:51","2022-07-03 12:08:51");



CREATE TABLE `purpose_medicines` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `complain_id` bigint(20) unsigned NOT NULL,
  `medicine_id` bigint(20) unsigned NOT NULL,
  `power_id` bigint(20) unsigned NOT NULL,
  `dose_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO purpose_medicines VALUES("11","10","10","2","2","2","2022-07-07 00:40:48","2022-07-07 00:40:48");
INSERT INTO purpose_medicines VALUES("12","10","10","1","1","3","2022-07-07 00:40:48","2022-07-07 00:40:48");
INSERT INTO purpose_medicines VALUES("13","10","9","1","1","1","2022-07-07 01:37:36","2022-07-07 01:37:36");
INSERT INTO purpose_medicines VALUES("14","10","9","2","2","2","2022-07-07 01:37:36","2022-07-07 01:37:36");



CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_mobile_unique` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES("1","Dr. Jahid Hossain","admin@gmail.com","01711265003","","$2y$10$7b4LVVMVwWNv8bzfREJW0u7IOcXJwZxnyFjuftH4Pn0ClGLnN4cwG","","2022-07-03 12:07:10","2022-07-03 12:07:10");

