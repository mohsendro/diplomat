-- Description: For formcounselings table structure

-- >>> Up >>>

CREATE TABLE
    IF NOT EXISTS `dip_formcounselings` (
        `ID` bigint(20) UNSIGNED NOT NULL,
        `post_author` bigint(20) UNSIGNED NOT NULL,
        `post_date` datetime(6) NOT NULL DEFAULT current_timestamp(6),
        `post_date_gmt` datetime(6) NOT NULL DEFAULT current_timestamp(6),
        `post_title` text NOT NULL,
        `post_content` longtext NOT NULL,
        `post_status` varchar(20) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci;

-- >>> Down >>>

DROP TABLE IF EXISTS `dip_formcounselings`;