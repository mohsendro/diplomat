-- Description: For advertising table structure

-- >>> Up >>>

CREATE TABLE
    `dip_advertisingmeta` (
        `meta_id` bigint(20) UNSIGNED NOT NULL,
        `advertising_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
        `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
        `meta_value` longtext COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci;

-- >>> Down >>>

DROP TABLE IF EXISTS `dip_advertisingmeta`;