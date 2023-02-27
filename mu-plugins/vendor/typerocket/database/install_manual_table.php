<?php
use TypeRocket\Database\Migration;

return new class($wpdb) extends Migration {
    
    public function up() {

        global $wpdb;
        $table_name_samples   = $wpdb->prefix . 'samples'; 
        $table_name_companies = $wpdb->prefix . 'companies'; 
        $table_name_jobs      = $wpdb->prefix . 'jobs'; 
        $table_name_resumes   = $wpdb->prefix . 'resumes'; 
        $table_name_to_jobs   = $wpdb->prefix . 'to_jobs'; 

        $table_name_samples_up = "CREATE TABLE IF NOT EXISTS " . $table_name_samples . " (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `title` varchar(255) COLLATE utf8_general_ci NOT NULL,
        `samples` longtext COLLATE utf8_general_ci DEFAULT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        
        $table_name_companies_up = "CREATE TABLE IF NOT EXISTS " . $table_name_companies . " (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `title` varchar(255) COLLATE utf8_persian_ci NOT NULL,
            `content` longtext COLLATE utf8_persian_ci DEFAULT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        $table_name_jobs_up = "CREATE TABLE IF NOT EXISTS " . $table_name_jobs . " (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `company_id` int(11) COLLATE utf8_persian_ci NOT NULL,
            `title` varchar(255) COLLATE utf8_persian_ci NOT NULL,
            `content` longtext COLLATE utf8_persian_ci DEFAULT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";    
        
        $table_name_resumes_up = "CREATE TABLE IF NOT EXISTS " . $table_name_resumes . " (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `user_id` int(11) COLLATE utf8_persian_ci NOT NULL,
            `title` varchar(255) COLLATE utf8_persian_ci NOT NULL,
            `content` longtext COLLATE utf8_persian_ci DEFAULT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
            
        $table_name_to_jobs_up = "CREATE TABLE IF NOT EXISTS " . $table_name_to_jobs . " (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `user_id` int(11) COLLATE utf8_persian_ci NOT NULL,
            `job_id` int(11) COLLATE utf8_persian_ci NOT NULL,
            `content` longtext COLLATE utf8_persian_ci DEFAULT NULL,
            `status` varchar(255) COLLATE utf8_persian_ci NOT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        dbDelta($table_name_samples_up);
        dbDelta($table_name_companies_up);
        dbDelta($table_name_jobs_up);
        dbDelta($table_name_resumes_up);
        dbDelta($table_name_to_jobs_up);
        
    }

    public function down() {

        global $wpdb;
        $table_name = $wpdb->prefix . 'resumes'; 

        $table = "DROP TABLE IF EXISTS " . $table_name;
        
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($table);

    }

};