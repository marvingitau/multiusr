BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "migrations" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"migration"	varchar NOT NULL,
	"batch"	integer NOT NULL
);
CREATE TABLE IF NOT EXISTS "users" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"username"	varchar,
	"email"	varchar NOT NULL,
	"first_name"	varchar,
	"last_name"	varchar,
	"phone"	varchar,
	"dob"	date,
	"address"	text,
	"sex"	varchar NOT NULL DEFAULT 'M' CHECK("sex" in ('M','F','O')),
	"picture"	varchar,
	"password"	varchar,
	"deleted_at"	datetime,
	"marital_status_id"	integer,
	"country_id"	integer,
	"state_id"	integer,
	"city_id"	integer,
	"nid_no"	varchar,
	"experience_id"	integer,
	"career_level_id"	integer,
	"industry_id"	integer,
	"functional_area_id"	integer,
	"current_salary"	float NOT NULL DEFAULT '0',
	"expected_salary"	float NOT NULL DEFAULT '0',
	"currency_id"	integer,
	"father_name"	varchar,
	"mother_name"	varchar,
	"permanent_address"	text,
	"nationality"	varchar,
	"cv_summary"	text,
	"vsent"	varchar,
	"email_verified"	tinyint(1) NOT NULL DEFAULT '0',
	"email_send"	tinyint(1) NOT NULL DEFAULT '0',
	"email_verified_code"	tinyint(1) NOT NULL DEFAULT '0',
	"sms_verified"	tinyint(1) NOT NULL DEFAULT '0',
	"sms_verified_code"	tinyint(1) NOT NULL DEFAULT '0',
	"sms_send"	tinyint(1) NOT NULL DEFAULT '0',
	"status"	tinyint(1) NOT NULL DEFAULT '1',
	"remember_token"	varchar,
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "password_resets" (
	"email"	varchar NOT NULL,
	"token"	varchar NOT NULL,
	"created_at"	datetime
);
CREATE TABLE IF NOT EXISTS "admins" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"username"	varchar NOT NULL,
	"email"	varchar NOT NULL,
	"first_name"	varchar,
	"last_name"	varchar,
	"phone"	varchar,
	"address"	text,
	"sex"	varchar NOT NULL DEFAULT 'M' CHECK("sex" in ('M','F','O')),
	"picture"	varchar,
	"status"	tinyint(1) NOT NULL DEFAULT '1',
	"role_id"	integer NOT NULL DEFAULT '1',
	"password"	varchar NOT NULL,
	"remember_token"	varchar,
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "general_settings" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"title"	varchar,
	"color"	varchar,
	"cur"	varchar,
	"cur_sym"	varchar,
	"reg"	tinyint(1) NOT NULL DEFAULT '1',
	"ev"	tinyint(1) NOT NULL DEFAULT '1',
	"mv"	tinyint(1) NOT NULL DEFAULT '1',
	"en"	tinyint(1) NOT NULL DEFAULT '1',
	"mn"	tinyint(1) NOT NULL DEFAULT '1',
	"sender_email"	varchar,
	"email_message"	text,
	"sms_api"	text,
	"meta_key_word"	text,
	"meta_description"	text,
	"meta_author"	varchar,
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "advertisements" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"size"	integer,
	"type"	integer,
	"image"	varchar,
	"click"	integer,
	"script"	text,
	"redirect_url"	text,
	"is_active"	tinyint(1) NOT NULL DEFAULT '1',
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "web_settings" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "gateways" (
	"id"	integer NOT NULL,
	"main_name"	varchar NOT NULL,
	"name"	varchar,
	"minamo"	float NOT NULL DEFAULT '0',
	"maxamo"	float NOT NULL DEFAULT '0',
	"fixed_charge"	float NOT NULL DEFAULT '0',
	"percent_charge"	float NOT NULL DEFAULT '0',
	"rate"	float NOT NULL DEFAULT '0',
	"val1"	varchar,
	"val2"	varchar,
	"val3"	varchar,
	"val4"	varchar,
	"val5"	varchar,
	"val6"	varchar,
	"val7"	varchar,
	"status"	tinyint(1) NOT NULL DEFAULT '1',
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "payments" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"model_type"	varchar NOT NULL,
	"model_id"	integer NOT NULL,
	"gateway_id"	integer NOT NULL,
	"amount"	float NOT NULL DEFAULT '0',
	"usd_amo"	float NOT NULL DEFAULT '0',
	"trx"	varchar NOT NULL,
	"note"	text,
	"meta_data"	text,
	"status"	tinyint(1) NOT NULL DEFAULT '0',
	"try"	tinyint(1) NOT NULL DEFAULT '0',
	"btc_amo"	float NOT NULL DEFAULT '0',
	"btc_wallet"	float NOT NULL DEFAULT '0',
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "transactions" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"user_id"	varchar,
	"gateway_id"	varchar,
	"amount"	varchar,
	"remarks"	varchar,
	"trx"	varchar,
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "countries" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"short_by"	integer,
	"name"	varchar NOT NULL,
	"full_name"	varchar,
	"flag"	varchar,
	"status"	tinyint(1) NOT NULL,
	"deleted_at"	datetime,
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "states" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"country_id"	integer NOT NULL,
	"short_by"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"status"	tinyint(1) NOT NULL DEFAULT '1',
	"deleted_at"	datetime,
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "cities" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"state_id"	integer NOT NULL,
	"short_by"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"status"	tinyint(1) NOT NULL DEFAULT '1',
	"deleted_at"	datetime,
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "packages" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"short_by"	integer,
	"title"	varchar NOT NULL,
	"price"	float NOT NULL DEFAULT '0',
	"days"	integer NOT NULL DEFAULT '0',
	"num_of_listing"	integer NOT NULL DEFAULT '0',
	"package_for"	varchar NOT NULL DEFAULT 'seeker' CHECK("package_for" in ('seeker','employer')),
	"status"	tinyint(1) NOT NULL DEFAULT '1',
	"deleted_at"	datetime,
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "employers" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"username"	varchar NOT NULL,
	"password"	varchar NOT NULL,
	"email"	varchar,
	"company_name"	varchar,
	"industry_id"	integer,
	"ownership_type_id"	integer,
	"number_of_employee_id"	integer,
	"description"	text,
	"number_of_office"	integer,
	"web"	varchar,
	"establish_year"	integer,
	"fax"	varchar,
	"phone"	varchar,
	"country_id"	integer,
	"state_id"	integer,
	"city_id"	integer,
	"address"	text,
	"company_logo"	varchar,
	"social_address"	text,
	"map_script"	text,
	"status"	tinyint(1) NOT NULL DEFAULT '1',
	"subscribe"	tinyint(1) NOT NULL DEFAULT '1',
	"membership_expired"	datetime,
	"remaining_job"	integer NOT NULL DEFAULT '0',
	"email_verified"	tinyint(1) NOT NULL DEFAULT '0',
	"email_verified_code"	varchar,
	"sms_verified"	tinyint(1) NOT NULL DEFAULT '0',
	"sms_verified_code"	varchar,
	"is_featured"	tinyint(1) NOT NULL DEFAULT '0',
	"deleted_at"	datetime,
	"remember_token"	varchar,
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "post_jobs" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"employer_id"	integer NOT NULL,
	"title"	varchar NOT NULL,
	"description"	text,
	"country_id"	integer,
	"state_id"	integer,
	"city_id"	integer,
	"salary_from"	float NOT NULL DEFAULT '0',
	"salary_to"	float NOT NULL DEFAULT '0',
	"currency_id"	integer,
	"salary_period_id"	integer,
	"career_level_id"	integer,
	"functional_area_id"	integer,
	"job_type_id"	integer,
	"job_shift_id"	integer,
	"degree_level_id"	integer,
	"experience_id"	integer,
	"preference"	varchar CHECK("preference" in ('M','F')),
	"number_of_position"	integer NOT NULL DEFAULT '0',
	"expired_date"	date,
	"salary_hide"	tinyint(1) NOT NULL DEFAULT '1',
	"status"	tinyint(1) NOT NULL DEFAULT '1',
	"skills"	text,
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "job_post_pivot_skill" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"job_post_id"	integer NOT NULL,
	"skill_id"	integer NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "employer_packages" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"employer_id"	integer NOT NULL,
	"package_id"	integer NOT NULL,
	"before_expired_date"	datetime,
	"after_expired_date"	datetime,
	"before_job_remaining"	integer NOT NULL DEFAULT '0',
	"after_job_remaining"	integer NOT NULL DEFAULT '0',
	"meta_data"	text,
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "socials" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"model_type"	varchar,
	"model_id"	integer,
	"name"	varchar,
	"color"	varchar,
	"icon"	varchar,
	"link"	varchar,
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "apply_jobs" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"job_id"	integer NOT NULL,
	"user_id"	integer NOT NULL,
	"cv_type"	varchar NOT NULL DEFAULT 'online' CHECK("cv_type" in ('online','pdf')),
	"expected_salary"	float NOT NULL DEFAULT '0',
	"status"	tinyint(1) NOT NULL DEFAULT '1',
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "cv_experiences" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"title"	varchar NOT NULL,
	"company"	varchar,
	"user_id"	integer NOT NULL,
	"country_id"	integer,
	"city_id"	integer,
	"state_id"	integer,
	"start_date"	date,
	"end_date"	date,
	"currently_work"	tinyint(1) NOT NULL DEFAULT '1',
	"description"	text,
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "cv_educations" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"user_id"	integer NOT NULL,
	"country_id"	integer,
	"city_id"	integer,
	"state_id"	integer,
	"degree_level_id"	integer,
	"major_subject_id"	integer,
	"degree_title"	varchar,
	"institute"	varchar,
	"passing_year"	integer,
	"result"	varchar,
	"result_type_id"	integer,
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "cv_skills" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"user_id"	integer NOT NULL,
	"skills_id"	integer NOT NULL,
	"experience_id"	integer NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "cv_languages" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"user_id"	integer NOT NULL,
	"language_id"	integer NOT NULL,
	"language_level_id"	integer NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "web_setting_items" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"model_type"	varchar NOT NULL,
	"model_id"	integer NOT NULL,
	"val_1"	text,
	"val_2"	text,
	"val_3"	text,
	"val_4"	text,
	"val_5"	text,
	"val_6"	text,
	"status"	tinyint(1) NOT NULL DEFAULT '1',
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "social_logins" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"model_type"	varchar NOT NULL,
	"model_id"	integer NOT NULL,
	"provider"	varchar NOT NULL,
	"provider_id"	varchar NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "posts" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"cat_id"	integer,
	"title"	varchar,
	"image"	varchar,
	"thumb"	varchar,
	"details"	varchar,
	"status"	integer NOT NULL DEFAULT '1',
	"hit"	integer NOT NULL DEFAULT '0',
	"created_at"	datetime,
	"updated_at"	datetime
);
CREATE TABLE IF NOT EXISTS "job_attributs" (
	"id"	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	"type"	varchar NOT NULL CHECK("type" in ('language_level','career_level','functional_area','industry','experience','skills','type','shift','degree_level','degree_types','major_subject','result_type','marital_status','ownership_types','salary_periods','number_of_employee','currency','language')),
	"name"	varchar NOT NULL,
	"status"	tinyint(1) NOT NULL DEFAULT '1',
	"deleted_at"	datetime,
	"created_at"	datetime,
	"updated_at"	datetime,
	"image"	TEXT
);
INSERT INTO "migrations" ("id","migration","batch") VALUES (1,'2014_10_12_000000_create_users_table',1),
 (2,'2014_10_12_100000_create_password_resets_table',1),
 (3,'2018_11_17_074545_create_admins_table',1),
 (4,'2018_11_17_092751_create_general_settings_table',1),
 (5,'2018_12_02_120018_create_advertisements_table',1),
 (6,'2019_01_17_144645_create_web_settings_table',1),
 (7,'2019_02_05_100910_create_gateways_table',1),
 (8,'2019_02_05_121238_create_payments_table',1),
 (9,'2019_03_14_095400_create_transactions_table',1),
 (10,'2019_03_20_132917_create_job_attributs_table',1),
 (11,'2019_03_21_064637_create_countries_table',1),
 (12,'2019_03_21_064713_create_states_table',1),
 (13,'2019_03_21_064725_create_cities_table',1),
 (14,'2019_03_21_114928_create_packages_table',1),
 (15,'2019_03_23_053856_create_employers_table',1),
 (16,'2019_03_24_130558_create_post_jobs_table',1),
 (17,'2019_03_25_060736_create_job_post_pivot_skill_table',1),
 (18,'2019_03_25_113814_create_employer_packages_table',1),
 (19,'2019_04_25_073754_create_socials_table',1),
 (20,'2019_04_28_132842_create_apply_jobs_table',1),
 (21,'2019_04_29_122916_create_cv_experiences_table',1),
 (22,'2019_04_30_064001_create_cv_educations_table',1),
 (23,'2019_04_30_091253_create_cv_skills_table',1),
 (24,'2019_04_30_095325_create_cv_languages_table',1),
 (25,'2019_05_02_080654_create_web_setting_items_table',1),
 (26,'2019_05_05_052217_create_social_logins_table',1),
 (27,'2020_01_21_123500_create_posts_table',1);
INSERT INTO "users" ("id","username","email","first_name","last_name","phone","dob","address","sex","picture","password","deleted_at","marital_status_id","country_id","state_id","city_id","nid_no","experience_id","career_level_id","industry_id","functional_area_id","current_salary","expected_salary","currency_id","father_name","mother_name","permanent_address","nationality","cv_summary","vsent","email_verified","email_send","email_verified_code","sms_verified","sms_verified_code","sms_send","status","remember_token","created_at","updated_at") VALUES (3,NULL,'marvin@gmail.com','marion','wanjiku','76356786',NULL,NULL,'M',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.0,0.0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,0,0,1,NULL,'2020-01-22 12:25:32','2020-01-22 12:25:32'),
 (4,NULL,'marvin00@gmail.com','marion','wanjiku','7635678600',NULL,NULL,'M',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.0,0.0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,0,0,1,NULL,'2020-01-22 12:27:05','2020-01-22 12:27:05'),
 (5,NULL,'walibora@gmail.com','ken','walibora','7635678600',NULL,NULL,'M',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.0,0.0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,0,0,1,NULL,'2020-01-22 12:34:50','2020-01-22 12:34:50'),
 (6,NULL,'vichi@gmail.com','kenvichi','walibora','8762345678',NULL,NULL,'M',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.0,0.0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,0,0,1,NULL,'2020-01-22 12:40:10','2020-01-22 12:40:10'),
 (7,NULL,'vichiii@gmail.com','kenvichii','waliborai','87623456780',NULL,NULL,'M',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,0.0,0.0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,0,0,1,NULL,'2020-01-22 12:42:23','2020-01-22 12:42:23'),
 (8,NULL,'email@email.com','hello','world','987654321',NULL,NULL,'M',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,0.0,0.0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,0,0,1,NULL,'2020-01-22 13:37:29','2020-01-22 13:37:29'),
 (9,NULL,'m@m.mo0000','oijoij','ijioji','0909',NULL,NULL,'M',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.0,0.0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,0,0,1,NULL,'2020-01-22 14:02:49','2020-01-22 14:02:49'),
 (10,NULL,'msdwjdwo@sdsd.com','marfiosfwij','iuhiuuihiu','uihuniuniuhnui',NULL,NULL,'M',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,0.0,0.0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,0,0,1,NULL,'2020-01-22 14:08:04','2020-01-22 14:08:04');
INSERT INTO "admins" ("id","username","email","first_name","last_name","phone","address","sex","picture","status","role_id","password","remember_token","created_at","updated_at") VALUES (1,'Hr','admin@example.com',NULL,NULL,NULL,NULL,'M',NULL,1,2,'$2y$10$Qkfa/amZwiok..1wMX.Vl.YbhPB2oQ2LPmtkLHbjeeUDBPVPecyJu',NULL,NULL,NULL),
 (2,'Admin','admin@example.com',NULL,NULL,NULL,NULL,'M',NULL,1,1,'$2y$10$Tpqv2zv4qOX9.TdifJF8Eec0h5c3kb8Isz.rUN6l8nviFF7PcLlUi',NULL,NULL,NULL),
 (3,'kmrc','admin@example.com',NULL,NULL,NULL,NULL,'M',NULL,1,3,'$2y$10$Xn6GeQr9ZIV/1lirT57nUunsHsU23nL.Mb62i4Cl7SLgcgkAdR5w2',NULL,NULL,NULL);
INSERT INTO "general_settings" ("id","title","color","cur","cur_sym","reg","ev","mv","en","mn","sender_email","email_message","sms_api","meta_key_word","meta_description","meta_author","created_at","updated_at") VALUES (1,'TSK','37c071',NULL,NULL,1,1,1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,'2020-01-22 11:17:28','2020-01-22 11:17:28');
INSERT INTO "employers" ("id","username","password","email","company_name","industry_id","ownership_type_id","number_of_employee_id","description","number_of_office","web","establish_year","fax","phone","country_id","state_id","city_id","address","company_logo","social_address","map_script","status","subscribe","membership_expired","remaining_job","email_verified","email_verified_code","sms_verified","sms_verified_code","is_featured","deleted_at","remember_token","created_at","updated_at") VALUES (1,'employee','$2y$10$xHkcjfCtJfvDGlyDR5yQt.4PZFAo/ahjIE9UMNgSebcyNrraj3wxS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,0,0,NULL,0,NULL,0,NULL,NULL,'2020-01-22 11:17:31','2020-01-22 11:17:31');
INSERT INTO "post_jobs" ("id","employer_id","title","description","country_id","state_id","city_id","salary_from","salary_to","currency_id","salary_period_id","career_level_id","functional_area_id","job_type_id","job_shift_id","degree_level_id","experience_id","preference","number_of_position","expired_date","salary_hide","status","skills","created_at","updated_at") VALUES (1,0,'cicada','sacsdcsdcsd',NULL,NULL,NULL,0.0,0.0,NULL,NULL,7,15,NULL,NULL,4,2,'M',27,'2020-02-01',1,1,'dssdcscsc','2020-01-22 13:36:20','2020-01-22 13:36:20');
INSERT INTO "apply_jobs" ("id","job_id","user_id","cv_type","expected_salary","status","created_at","updated_at") VALUES (1,1,9,'pdf',0.0,1,'2020-01-22 14:02:49','2020-01-22 14:02:49'),
 (2,1,10,'pdf',0.0,1,'2020-01-22 14:08:04','2020-01-22 14:08:04');
INSERT INTO "cv_educations" ("id","user_id","country_id","city_id","state_id","degree_level_id","major_subject_id","degree_title","institute","passing_year","result","result_type_id","created_at","updated_at") VALUES (8,10,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,'2020-01-22 14:08:04','2020-01-22 14:08:04');
INSERT INTO "job_attributs" ("id","type","name","status","deleted_at","created_at","updated_at","image") VALUES (1,'experience','1 year',1,NULL,'2020-01-22 12:04:00','2020-01-22 12:04:51',NULL),
 (2,'experience','2 years',1,NULL,'2020-01-22 12:04:26','2020-01-22 12:04:26',NULL),
 (3,'experience','3 years',1,NULL,'2020-01-22 12:04:38','2020-01-22 12:04:38',NULL),
 (4,'degree_level','PhD',1,NULL,'2020-01-22 12:09:52','2020-01-22 12:09:52',NULL),
 (5,'degree_level','Masters',1,NULL,'2020-01-22 12:10:04','2020-01-22 12:10:04',NULL),
 (6,'career_level','intern',1,NULL,'2020-01-22 12:53:00','2020-01-22 12:53:00',NULL),
 (7,'career_level','junior staff',1,NULL,'2020-01-22 12:53:21','2020-01-22 12:53:21',NULL),
 (8,'career_level','senior staff',1,NULL,'2020-01-22 12:53:37','2020-01-22 12:53:37',NULL),
 (9,'career_level','CEO',1,NULL,'2020-01-22 12:53:47','2020-01-22 12:53:47',NULL),
 (10,'language_level','kiswahili',1,'2020-01-22 12:54:39','2020-01-22 12:54:06','2020-01-22 12:54:39',NULL),
 (11,'language_level','intermediate',1,NULL,'2020-01-22 12:54:32','2020-01-22 12:54:32',NULL),
 (12,'language_level','expert',1,NULL,'2020-01-22 12:55:05','2020-01-22 12:55:05',NULL),
 (13,'skills','SPSS',1,NULL,'2020-01-22 12:58:29','2020-01-22 12:58:29',NULL),
 (14,'skills','Tableue',1,NULL,'2020-01-22 12:58:47','2020-01-22 12:58:47',NULL),
 (15,'functional_area','Backend',1,NULL,'2020-01-22 13:04:44','2020-01-22 13:24:23','functional_area1579699463.jpg');
CREATE UNIQUE INDEX IF NOT EXISTS "users_email_unique" ON "users" (
	"email"
);
CREATE INDEX IF NOT EXISTS "password_resets_email_index" ON "password_resets" (
	"email"
);
CREATE UNIQUE INDEX IF NOT EXISTS "admins_username_unique" ON "admins" (
	"username"
);
CREATE UNIQUE INDEX IF NOT EXISTS "gateways_main_name_unique" ON "gateways" (
	"main_name"
);
CREATE UNIQUE INDEX IF NOT EXISTS "countries_name_unique" ON "countries" (
	"name"
);
CREATE UNIQUE INDEX IF NOT EXISTS "employers_username_unique" ON "employers" (
	"username"
);
COMMIT;
