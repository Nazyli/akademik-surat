
ALTER TABLE dashboard_news ADD category varchar(100) NULL;

UPDATE dashboard_news SET  category='SIPA' WHERE category is null 

ALTER TABLE `users` ADD `class` VARCHAR(191) NULL DEFAULT NULL AFTER `phone`, ADD `class_year` VARCHAR(191) NULL DEFAULT NULL AFTER `class`, ADD `semester_graduate` VARCHAR(191) NULL DEFAULT NULL AFTER `class_year`, ADD `whatsapp` VARCHAR(191) NULL DEFAULT NULL AFTER `semester_graduate`;

  CreateDiplomaRequirementTypesTable ........................................................................................................  
 create table `diploma_requirement_types` (`id` varchar(191) not null, `requirement` varchar(191) null, `description` longtext null, `degree` varchar(191) null, `status` varchar(191) null, `created_by` varchar(191) null, `updated_by` varchar(191) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci' ENGINE=MyISAM;
 alter table `diploma_requirement_types` add primary key (`id`);
  CreateDiplomaRetrievalRequestsTable .......................................................................................................  
 create table `diploma_retrieval_requests` (`id` varchar(191) not null, `user_id` varchar(191) null, `form_status` varchar(191) null, `submission_date` timestamp null, `processed_date` timestamp null, `user_note` longtext null, `comment` longtext null, `processed_by` varchar(191) null, `created_by` varchar(191) null, `updated_by` varchar(191) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci' ENGINE=MyISAM;
 
 alter table `diploma_retrieval_requests` add constraint `diploma_retrieval_requests_user_id_foreign` foreign key (`user_id`) references `users` (`id`);
 
 alter table `diploma_retrieval_requests` add primary key (`id`);
  CreateDiplomaRetrievalRequestsDetailsTable ................................................................................................  
 create table `diploma_retrieval_requests_details` (`id` varchar(191) not null, `user_id` varchar(191) null, `request_id` varchar(191) null, `requirement` varchar(191) null, `user_notes` longtext null, `size_file` varchar(191) null, `url_file` varchar(500) null, `form_status` varchar(191) null, `submission_date` timestamp null, `processed_date` timestamp null, `processed_by` varchar(191) null, `comment` longtext null, `created_by` varchar(191) null, `updated_by` varchar(191) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci' ENGINE=MyISAM;
 
 alter table `diploma_retrieval_requests_details` add constraint `diploma_retrieval_requests_details_user_id_foreign` foreign key (`user_id`) references `users` (`id`);
 
 alter table `diploma_retrieval_requests_details` add constraint `diploma_retrieval_requests_details_request_id_foreign` foreign key (`request_id`) references `diploma_retrieval_requests` (`id`);
 
 alter table `diploma_retrieval_requests_details` add constraint `diploma_retrieval_requests_details_requirement_foreign` foreign key (`requirement`) references `diploma_requirement_types` (`id`);
 
 alter table `diploma_retrieval_requests_details` add primary key (`id`);
