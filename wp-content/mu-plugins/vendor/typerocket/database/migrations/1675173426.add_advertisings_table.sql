-- Description: For advertising table structure

-- >>> Up >>>

CREATE TABLE
    IF NOT EXISTS `dip_advertisings` (
        `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        `advertising_author` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
        `advertising_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        `advertising_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        `advertising_content` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
        `advertising_title` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
        `advertising_excerpt` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
        `advertising_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'publish',
        `comment_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
        `ping_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
        `advertising_password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
        `advertising_name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
        `to_ping` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
        `pinged` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
        `advertising_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        `advertising_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        `advertising_content_filtered` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
        `advertising_parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
        `guid` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
        `menu_order` int(11) NOT NULL DEFAULT 0,
        `advertising_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'advertising',
        `advertising_mime_type` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
        `comment_count` bigint(20) NOT NULL DEFAULT 0
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci;

-- >>> Down >>>

DROP TABLE IF EXISTS `dip_advertisings`;