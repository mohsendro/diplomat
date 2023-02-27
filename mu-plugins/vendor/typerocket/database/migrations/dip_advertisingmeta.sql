-- phpMyAdmin SQL Dump

-- version 5.1.1

-- https://www.phpmyadmin.net/

--

-- Host: 127.0.0.1

-- Generation Time: Feb 01, 2023 at 07:22 AM

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

-- Table structure for table `dip_advertisingmeta`

--

CREATE TABLE
    `dip_advertisingmeta` (
        `meta_id` bigint(20) UNSIGNED NOT NULL,
        `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
        `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
        `meta_value` longtext COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci;

--

-- Indexes for dumped tables

--

--

-- Indexes for table `dip_advertisingmeta`

--

ALTER TABLE
    `dip_advertisingmeta`
ADD PRIMARY KEY (`meta_id`),
ADD KEY `post_id` (`post_id`),
ADD
    KEY `meta_key` (`meta_key`(191));

--

-- AUTO_INCREMENT for dumped tables

--

--

-- AUTO_INCREMENT for table `dip_advertisingmeta`

--

ALTER TABLE
    `dip_advertisingmeta` MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */

;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */

;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */

;