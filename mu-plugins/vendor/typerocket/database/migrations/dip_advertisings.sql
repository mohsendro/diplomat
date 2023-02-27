-- phpMyAdmin SQL Dump

-- version 5.1.1

-- https://www.phpmyadmin.net/

--

-- Host: 127.0.0.1

-- Generation Time: Feb 01, 2023 at 07:21 AM

-- Server version: 10.4.20-MariaDB

-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */

;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */

;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */

;

/*!40101 SET NAMES utf8mb4 */

;

--

-- Database: `diplomat`

--

-- --------------------------------------------------------

--

-- Table structure for table `dip_advertisings`

--

CREATE TABLE
    `dip_advertisings` (
        `ID` bigint(20) UNSIGNED NOT NULL,
        `post_author` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
        `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        `post_content` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
        `post_title` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
        `post_excerpt` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
        `post_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'publish',
        `comment_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
        `ping_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
        `post_password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
        `post_name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
        `to_ping` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
        `pinged` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
        `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        `post_content_filtered` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
        `post_parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
        `guid` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
        `menu_order` int(11) NOT NULL DEFAULT 0,
        `post_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'post',
        `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
        `comment_count` bigint(20) NOT NULL DEFAULT 0
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci;

--

-- Indexes for dumped tables

--

--

-- Indexes for table `dip_advertisings`

--

ALTER TABLE `dip_advertisings`
ADD PRIMARY KEY (`ID`),
ADD
    KEY `post_name` (`post_name`(191)),
ADD
    KEY `type_status_date` (
        `post_type`,
        `post_status`,
        `post_date`,
        `ID`
    ),
ADD
    KEY `post_parent` (`post_parent`),
ADD
    KEY `post_author` (`post_author`);

--

-- AUTO_INCREMENT for dumped tables

--

--

-- AUTO_INCREMENT for table `dip_advertisings`

--

ALTER TABLE
    `dip_advertisings` MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */

;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */

;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */

;