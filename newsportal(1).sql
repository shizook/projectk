-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306:4306
-- Generation Time: Oct 31, 2025 at 01:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newsportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `slug` varchar(160) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'World', 'world', 'World news and international affairs', '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(2, 'Technology', 'technology', 'Tech news and insights', '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(3, 'Business', 'business', 'Business and finance updates', '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(4, 'Politics', 'politics', 'Topik yang berkaitan dengan politik', '2025-10-02 11:36:41', '2025-10-02 11:36:41'),
(5, 'Comedy', 'comedy', ';lucu', '2025-10-06 03:30:44', '2025-10-06 03:30:44');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 'Very Interesting from asep', '2025-10-02 08:52:08', '2025-10-02 08:52:08'),
(2, 4, 2, 'keren...', '2025-10-02 09:33:14', '2025-10-02 09:33:14'),
(4, 6, 1, 'waww aku mau kenalan sama kak eufrat', '2025-10-03 23:44:26', '2025-10-03 23:44:26');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(120) NOT NULL,
  `url` varchar(255) NOT NULL,
  `location` enum('header','footer') NOT NULL DEFAULT 'header',
  `display_order` int(11) NOT NULL DEFAULT 0,
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `title`, `url`, `location`, `display_order`, `visible`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Home', '/', 'header', 1, 1, NULL, '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(2, 'World', '/category/world', 'header', 2, 1, NULL, '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(3, 'Technology', '/category/technology', 'header', 3, 1, NULL, '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(4, 'Business', '/category/business', 'header', 4, 1, NULL, '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(5, 'About', '/about', 'footer', 1, 1, NULL, '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(6, 'Contact', '/contact', 'footer', 2, 1, NULL, '2025-10-01 10:54:59', '2025-10-01 10:54:59');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_03_16i27_add_profile_photo_to_users_table', 2),
(5, '2025_10_03_000000_create_site_settings_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` varchar(300) DEFAULT NULL,
  `content` longtext NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `view_count` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `slug`, `excerpt`, `content`, `cover_image`, `status`, `view_count`, `meta_title`, `meta_description`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'AI Startups Boom in 2025', 'ai-startups-boom-2025', 'A quick look at the AI startup landscape in 2025.', '<p>Content for AI startups in 2025...</p>', NULL, 'published', 46, 'AI Startups in 2025', 'Overview of AI startups in 2025', '2025-09-21 10:54:59', '2025-10-01 10:54:59', '2025-10-03 23:30:20'),
(2, 2, 1, 'Elections Around the Globe', 'elections-around-the-globe', 'Key election highlights worldwide.', '<p>Global election updates...</p>', NULL, 'published', 33, 'Global Elections', 'Key election highlights', '2025-09-26 10:54:59', '2025-10-01 10:54:59', '2025-10-02 08:54:28'),
(4, 2, 3, 'this one lil bit mad innit bruv', 'brody-htWPF', 'KOMPAS.com - Menteri Transmigrasi M. Iftitah Sulaiman Suryanagara mengatakan, saat ini Jepang membutuhkan 40.000 tenaga kerja dari Indonesia. Namun, saat ini Indonesia baru menyanggupi mengirim sebanyak 25.000 pekerja di...', 'KOMPAS.com - Menteri Transmigrasi M. Iftitah Sulaiman Suryanagara mengatakan, saat ini Jepang membutuhkan 40.000 tenaga kerja dari Indonesia. Namun, saat ini Indonesia baru menyanggupi mengirim sebanyak 25.000 pekerja di sektor pertanian, kelautan, konstruksi, dan perawatan. Iftitah juga mengungkapkan, jumlah transmigran yang bekerja di Jepang saat ini sebesar kurang lebih 100 pekerja dan mendapat gaji sebesar Rp 25 - 55 juta per bulan. \"Dan yang lebih menarik dan membahagiakan kita saat ini adalah bahwa ternyata mereka, masyarakat Jepang sangat nge-value (menilai) tenaga kerja di Indonesia karena keramah tamahannya, hospitality-nya,\" kata Ifititah dikutip dari laman resmi Kementerian Transmigrasi, Kamis (2/10/2025).\r\n\r\nPemerintah dukung WNI yang ingin belajar-magang ke Jepang Sehingga akan ada keuntungan ganda yakni skill yang betul-betul nanti terlatih dari teknologi dan sistem kerja budaya Jepang dan investor yang nanti akan berinvestasi di Indonesia di kawasan transmigrasi. \"Itu kira-kira pembicaraan yang kami lakukan. Sebagai langkah konkret, insya Allah bulan Oktober mereka akan datang ke Indonesia untuk kita melakukan (penandatanganan) nota kesepahaman,\" ujarnya. Iftitah pun mendorong dan memberikan dukungan penuh pada para transmigran yang ingin belajar dan magang ke Jepang.', 'posts/6IC1zAhyVGORS7yapCPs0SFJEhtaq46u3Uijy4Sj.jpg', 'published', 13, 'this one lil bit mad innit bruv', 'KOMPAS.com - Menteri Transmigrasi M. Iftitah Sulaiman Suryanagara mengatakan, saat ini Jepang membutuhkan 40.000 tenaga kerja dari Indonesia. Namun, saat i...', '2025-10-02 09:32:48', '2025-10-02 09:32:48', '2025-10-03 23:30:14'),
(6, 1, 2, 'pusin', 'pusin-sZXvJ', 'raba raba eufrat abis ini ke alo abis tu ke alsut, katanya dia mau ngecas, mau ngecas di perpus, eufrat ga ragu ragu, gamau kalah, jangan gagal, mau kenalan. eufrat bonding sama divisi PR , aldy mesra-mesraan, kata eufra...', 'raba raba eufrat abis ini ke alo abis tu ke alsut, katanya dia mau ngecas, mau ngecas di perpus, eufrat ga ragu ragu, gamau kalah, jangan gagal, mau kenalan. eufrat bonding sama divisi PR , aldy mesra-mesraan, kata eufrat koleksi cewek kaya animal kaiser.', 'posts/Nld3HzOfHKijXiJpkkQVGJfaN3iLkAqafL6WEKL6.jpg', 'published', 3, 'pusin', 'raba raba eufrat abis ini ke alo abis tu ke alsut, katanya dia mau ngecas, mau ngecas di perpus, eufrat ga ragu ragu, gamau kalah, jangan gagal, mau kenala...', '2025-10-03 23:42:13', '2025-10-03 23:42:15', '2025-10-06 03:34:02'),
(10, 1, 3, 'dadad', 'dadad-Xnlnd', 'adadada Dadad Dadada D ADAD AD AD A', 'adadada\r\nDadad\r\n\r\n\r\nDadada\r\nD\r\nADAD\r\nAD\r\nAD\r\nA', 'posts/9gjLmn7cNcAONZu9CBMYTI8xW6MJAbhXz9DkQBQx.webp', 'published', 7, 'dadad', 'adadada Dadad Dadada D ADAD AD AD A', '2025-10-30 22:13:46', '2025-10-30 22:13:46', '2025-10-30 22:23:32'),
(11, 1, 5, 'adada', 'adada-9vjQf', 'adadads dada DAdad', 'adadads dada\r\nDAdad', 'posts/6RrM8d6Ba9AO2kQx4pr5kO7HgLs9m2P2RIoYOviI.webp', 'draft', 0, 'adada', 'adadads dada DAdad', NULL, '2025-10-30 22:15:24', '2025-10-30 22:15:24'),
(12, 1, 1, 'Jangankan hari ini', 'jangankan-hari-ini-KCRCB', 'TESTGott der Herr ist Sonn und Schild (\'God the Lord is sun and shield\'), BWV 79, is a church cantata for Reformation Day by Johann Sebastian Bach. He composed it in 1725, his third year in the position of Thomaskantor i...', '<h1>TEST</h1><p><br></p><blockquote><strong><em>Gott der Herr ist Sonn und Schild</em></strong> (\'God the Lord is sun and shield\'), <strong>BWV 79</strong>, is a <a href=\"https://en.wikipedia.org/wiki/List_of_church_cantatas_by_liturgical_occasion#Reformation_Day\" rel=\"noopener noreferrer\" target=\"_blank\">church cantata for Reformation Day</a> by <a href=\"https://en.wikipedia.org/wiki/Johann_Sebastian_Bach\" rel=\"noopener noreferrer\" target=\"_blank\">Johann Sebastian Bach</a>. He composed it in 1725, his third year in the position of <a href=\"https://en.wikipedia.org/wiki/Thomaskantor\" rel=\"noopener noreferrer\" target=\"_blank\">Thomaskantor</a> in <a href=\"https://en.wikipedia.org/wiki/Leipzig\" rel=\"noopener noreferrer\" target=\"_blank\">Leipzig</a>, and led the first performance on 31 October that year. It is possibly his first cantata for the occasion. He used most of the music for two of his four <a href=\"https://en.wikipedia.org/wiki/Kyrie%E2%80%93Gloria_Masses,_BWV_233%E2%80%93236\" rel=\"noopener noreferrer\" target=\"_blank\">short masses</a> in the 1730s.</blockquote><p><br></p><p>The text was written by an unknown poet, who did not refer to the prescribed readings for the day. He began the <a href=\"https://en.wikipedia.org/wiki/Libretto\" rel=\"noopener noreferrer\" target=\"_blank\">libretto</a> for the feast with a quotation from <a href=\"https://en.wikipedia.org/wiki/Psalm_84\" rel=\"noopener noreferrer\" target=\"_blank\">Psalm 84</a> and included two <a href=\"https://en.wikipedia.org/wiki/Hymn\" rel=\"noopener noreferrer\" target=\"_blank\">hymn</a> <a href=\"https://en.wikipedia.org/wiki/Stanza\" rel=\"noopener noreferrer\" target=\"_blank\">stanzas</a>, the first from <a href=\"https://en.wikipedia.org/wiki/Martin_Rinckart\" rel=\"noopener noreferrer\" target=\"_blank\">Martin Rinckart</a>\'s \"<a href=\"https://en.wikipedia.org/wiki/Nun_danket_alle_Gott\" rel=\"noopener noreferrer\" target=\"_blank\">Nun danket alle Gott</a>\", associated with Reformation Day in Leipzig, as the third <a href=\"https://en.wikipedia.org/wiki/Movement_(music)\" rel=\"noopener noreferrer\" target=\"_blank\">movement</a>, and as the last movement the final stanza of <a href=\"https://en.wikipedia.org/wiki/Ludwig_Helmbold\" rel=\"noopener noreferrer\" target=\"_blank\">Ludwig Helmbold</a>\'s \"<a href=\"https://en.wikipedia.org/wiki/Nun_la%C3%9Ft_uns_Gott_dem_Herren\" rel=\"noopener noreferrer\" target=\"_blank\">Nun laßt uns Gott dem Herren</a>\". Bach composed a work of \"festive magnificence\", structured in six movements, with an <a href=\"https://en.wikipedia.org/wiki/Aria\" rel=\"noopener noreferrer\" target=\"_blank\">aria</a> following the opening chorus, and a <a href=\"https://en.wikipedia.org/wiki/Recitative\" rel=\"noopener noreferrer\" target=\"_blank\">recitative</a> and <a href=\"https://en.wikipedia.org/wiki/Duet\" rel=\"noopener noreferrer\" target=\"_blank\">duet</a> following the first <a href=\"https://en.wikipedia.org/wiki/Chorale\" rel=\"noopener noreferrer\" target=\"_blank\">chorale</a>. He scored the work for three vocal soloists, a <a href=\"https://en.wikipedia.org/wiki/SATB\" rel=\"noopener noreferrer\" target=\"_blank\">four-part</a> choir, and a <a href=\"https://en.wikipedia.org/wiki/Baroque_instruments\" rel=\"noopener noreferrer\" target=\"_blank\">Baroque instrumental</a> ensemble of two horns, timpani, two transverse flutes (added for a later performance), two oboes, strings and continuo. He achieved a unity within the structure by using the horns not only in the opening but also as <a href=\"https://en.wikipedia.org/wiki/Obbligato\" rel=\"noopener noreferrer\" target=\"_blank\"><em>obbligato</em></a> instruments in the two chorales, the first time even playing the same <a href=\"https://en.wikipedia.org/wiki/Motif_(music)\" rel=\"noopener noreferrer\" target=\"_blank\">motifs</a>.</p><p><br></p><p>Bach performed the cantata again, probably in 1730. He later reworked the music of the opening chorus and a duet again for his <a href=\"https://en.wikipedia.org/wiki/Missa,_BWV_236\" rel=\"noopener noreferrer\" target=\"_blank\">Missa in G major, BWV 236</a>, and the music of an alto <a href=\"https://en.wikipedia.org/wiki/Aria\" rel=\"noopener noreferrer\" target=\"_blank\">aria</a> for his <a href=\"https://en.wikipedia.org/wiki/Kyrie%E2%80%93Gloria_masses,_BWV_233%E2%80%93236\" rel=\"noopener noreferrer\" target=\"_blank\">Missa in A major, BWV 234</a>.</p>', NULL, 'published', 3, 'Jangankan hari ini', 'TESTGott der Herr ist Sonn und Schild (\'God the Lord is sun and shield\'), BWV 79, is a church cantata for Reformation Day by Johann Sebastian Bach. He comp...', '2025-10-30 23:06:48', '2025-10-30 23:06:48', '2025-10-31 01:10:33');
INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `slug`, `excerpt`, `content`, `cover_image`, `status`, `view_count`, `meta_title`, `meta_description`, `published_at`, `created_at`, `updated_at`) VALUES
(13, 1, 1, 'Salem Witch Trials', 'salem-witch-trials-TAIY8', 'The Salem witch trials were a series of hearings and prosecutions of people accused of witchcraft in colonial Massachusetts between February 1692 and May 1693. More than 200 people were accused.[1] Thirty people were fou...', '<p class=\"ql-align-justify\"><img src=\"data:image/jpeg;base64,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\"></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">The <strong>Salem witch trials</strong> were a series of hearings and prosecutions of people accused of <a href=\"https://en.wikipedia.org/wiki/Witchcraft\" rel=\"noopener noreferrer\" target=\"_blank\">witchcraft</a> in <a href=\"https://en.wikipedia.org/wiki/Province_of_Massachusetts_Bay\" rel=\"noopener noreferrer\" target=\"_blank\">colonial Massachusetts</a> between February 1692 and May 1693. More than 200 people were accused.<a href=\"https://en.wikipedia.org/wiki/Salem_witch_trials#cite_note-:2-1\" rel=\"noopener noreferrer\" target=\"_blank\"><sup>[1]</sup></a> Thirty people were found guilty, nineteen of whom were executed by <a href=\"https://en.wikipedia.org/wiki/Hanging\" rel=\"noopener noreferrer\" target=\"_blank\">hanging</a> (fourteen women and five men). One other man, <a href=\"https://en.wikipedia.org/wiki/Giles_Corey\" rel=\"noopener noreferrer\" target=\"_blank\">Giles Corey</a>, died under <a href=\"https://en.wikipedia.org/wiki/Torture\" rel=\"noopener noreferrer\" target=\"_blank\">torture</a> after refusing to enter a <a href=\"https://en.wikipedia.org/wiki/Plea\" rel=\"noopener noreferrer\" target=\"_blank\">plea</a>, and at least five people died in the disease-ridden jails without trial.<a href=\"https://en.wikipedia.org/wiki/Salem_witch_trials#cite_note-2\" rel=\"noopener noreferrer\" target=\"_blank\"><sup>[2]</sup></a><a href=\"https://en.wikipedia.org/wiki/Salem_witch_trials#cite_note-:2-1\" rel=\"noopener noreferrer\" target=\"_blank\"><sup>[1]</sup></a></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Although the accusations began in Salem Village (known today as <a href=\"https://en.wikipedia.org/wiki/Danvers,_Massachusetts\" rel=\"noopener noreferrer\" target=\"_blank\">Danvers</a>), accusations and arrests were made in numerous towns beyond the village notably in <a href=\"https://en.wikipedia.org/wiki/Andover,_Massachusetts\" rel=\"noopener noreferrer\" target=\"_blank\">Andover</a> and <a href=\"https://en.wikipedia.org/wiki/Topsfield,_Massachusetts\" rel=\"noopener noreferrer\" target=\"_blank\">Topsfield</a>.<a href=\"https://en.wikipedia.org/wiki/Salem_witch_trials#cite_note-Demos-3\" rel=\"noopener noreferrer\" target=\"_blank\"><sup>[3]</sup></a> The residency of many of the accused is now unknown; around 151 people, nearly half that were accused, were able to be traced back to twenty-five different New England communities.<a href=\"https://en.wikipedia.org/wiki/Salem_witch_trials#cite_note-4\" rel=\"noopener noreferrer\" target=\"_blank\"><sup>[4]</sup></a> The grand juries and trials for this <a href=\"https://en.wikipedia.org/wiki/Capital_crime\" rel=\"noopener noreferrer\" target=\"_blank\">capital crime</a> were conducted by a Court of <a href=\"https://en.wikipedia.org/wiki/Oyer_and_terminer\" rel=\"noopener noreferrer\" target=\"_blank\">Oyer and Terminer</a> in 1692 and by a <a href=\"https://en.wikipedia.org/wiki/Massachusetts_Supreme_Judicial_Court\" rel=\"noopener noreferrer\" target=\"_blank\">Superior Court of Judicature</a> in 1693, both held in <a href=\"https://en.wikipedia.org/wiki/Salem,_Massachusetts\" rel=\"noopener noreferrer\" target=\"_blank\">Salem Town</a> (the regional center for Salem Village), where the hangings also took place. It was the deadliest <a href=\"https://en.wikipedia.org/wiki/Witch_hunt\" rel=\"noopener noreferrer\" target=\"_blank\">witch hunt</a> in the history of colonial North America. Fourteen other women and two men were executed in Massachusetts and Connecticut during the 17th century.<a href=\"https://en.wikipedia.org/wiki/Salem_witch_trials#cite_note-Demos-3\" rel=\"noopener noreferrer\" target=\"_blank\"><sup>[3]</sup></a> The Salem witch trials only came to an end when serious doubts began to arise among leading clergymen about the validity of the <a href=\"https://en.wikipedia.org/wiki/Spectral_evidence\" rel=\"noopener noreferrer\" target=\"_blank\">spectral evidence</a> that had been used to justify so many of the convictions, and due to the sheer number of those accused, \"including several prominent citizens of the colony\".<a href=\"https://en.wikipedia.org/wiki/Salem_witch_trials#cite_note-Vaughan-5\" rel=\"noopener noreferrer\" target=\"_blank\"><sup>[5]</sup></a></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">In the years after the trials, \"several of the accusers – mostly teen-age girls – admitted that they had fabricated their charges.\"<a href=\"https://en.wikipedia.org/wiki/Salem_witch_trials#cite_note-Vaughan-5\" rel=\"noopener noreferrer\" target=\"_blank\"><sup>[5]</sup></a> In 1702, the General Court of Massachusetts declared the trials \"unlawful\",<a href=\"https://en.wikipedia.org/wiki/Salem_witch_trials#cite_note-Katz-6\" rel=\"noopener noreferrer\" target=\"_blank\"><sup>[6]</sup></a> and in 1711 the colonial legislature annulled the convictions, passing a bill \"mentioning 22 individuals by name\"<a href=\"https://en.wikipedia.org/wiki/Salem_witch_trials#cite_note-Katz-6\" rel=\"noopener noreferrer\" target=\"_blank\"><sup>[6]</sup></a> and reversing their <a href=\"https://en.wikipedia.org/wiki/Attainder\" rel=\"noopener noreferrer\" target=\"_blank\">attainders</a>.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">The episode is one of colonial America\'s most notorious cases of <a href=\"https://en.wikipedia.org/wiki/Mass_hysteria\" rel=\"noopener noreferrer\" target=\"_blank\">mass hysteria</a>. It was not unique, but a colonial manifestation of the much broader phenomenon of <a href=\"https://en.wikipedia.org/wiki/Witch_trials_in_the_early_modern_period\" rel=\"noopener noreferrer\" target=\"_blank\">witch trials in the early modern period</a>, which took the lives of tens of thousands in Europe. In America, Salem\'s events have been used in political rhetoric and popular literature as a vivid cautionary tale about the dangers of isolation, religious extremism, false accusations, and lapses in due process.<a href=\"https://en.wikipedia.org/wiki/Salem_witch_trials#cite_note-7\" rel=\"noopener noreferrer\" target=\"_blank\"><sup>[7]</sup></a> Many historians consider the lasting effects of the trials to have been highly influential in the <a href=\"https://en.wikipedia.org/wiki/History_of_the_United_States\" rel=\"noopener noreferrer\" target=\"_blank\">history of the United States</a>. According to historian <a href=\"https://en.wikipedia.org/wiki/George_Lincoln_Burr\" rel=\"noopener noreferrer\" target=\"_blank\">George Lincoln Burr</a>, \"the Salem witchcraft was the rock on which the [New England] <a href=\"https://en.wikipedia.org/wiki/History_of_the_Puritans_in_North_America\" rel=\"noopener noreferrer\" target=\"_blank\">theocracy</a> shattered.\"<a href=\"https://en.wikipedia.org/wiki/Salem_witch_trials#cite_note-8\" rel=\"noopener noreferrer\" target=\"_blank\"><sup>[8]</sup></a></p>', NULL, 'published', 1, 'Salem Witch Trials', 'The Salem witch trials were a series of hearings and prosecutions of people accused of witchcraft in colonial Massachusetts between February 1692 and May 1...', '2025-10-31 01:23:12', '2025-10-31 01:23:12', '2025-10-31 01:23:17');

-- --------------------------------------------------------

--
-- Table structure for table `post_views`
--

CREATE TABLE `post_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `view_date` date NOT NULL,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_views`
--

INSERT INTO `post_views` (`id`, `post_id`, `view_date`, `views`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-09-25', 10, '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(2, 1, '2025-09-26', 12, '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(3, 1, '2025-09-27', 6, '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(4, 1, '2025-09-28', 5, '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(5, 1, '2025-09-29', 3, '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(6, 1, '2025-09-30', 4, '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(7, 1, '2025-10-01', 2, '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(8, 2, '2025-09-25', 8, '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(9, 2, '2025-09-26', 9, '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(10, 2, '2025-09-27', 5, '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(11, 2, '2025-09-28', 7, '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(12, 2, '2025-09-29', 4, '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(13, 2, '2025-09-30', 2, '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(14, 2, '2025-10-01', 1, '2025-10-01 10:54:59', '2025-10-01 10:54:59'),
(15, 1, '2025-10-02', 2, '2025-10-02 15:09:58', '2025-10-02 15:25:43'),
(17, 2, '2025-10-02', 3, '2025-10-02 15:51:59', '2025-10-02 15:54:28'),
(20, 4, '2025-10-02', 3, '2025-10-02 16:32:59', '2025-10-02 16:33:22'),
(23, 4, '2025-10-03', 7, '2025-10-02 18:37:40', '2025-10-03 08:18:05'),
(38, 4, '2025-10-04', 3, '2025-10-04 06:27:17', '2025-10-04 06:30:14'),
(40, 1, '2025-10-04', 2, '2025-10-04 06:29:54', '2025-10-04 06:30:20'),
(46, 6, '2025-10-04', 2, '2025-10-04 06:43:50', '2025-10-04 06:44:26'),
(54, 6, '2025-10-06', 1, '2025-10-06 10:34:02', '2025-10-06 10:34:02'),
(61, 10, '2025-10-31', 7, '2025-10-31 05:13:51', '2025-10-31 05:23:32'),
(68, 12, '2025-10-31', 3, '2025-10-31 06:06:56', '2025-10-31 08:10:33'),
(71, 13, '2025-10-31', 1, '2025-10-31 08:23:17', '2025-10-31 08:23:17');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CsxkxAR919bwGwzxtF4OWnJSdeujdQz7dXAZg5Dk', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZ2p5WDl2RnlWV1NhajQ3ZUw2SlMxS0hpYkF6UUFOUE1ZdkowVjJCYyI7czoyNDoidmlzaXRlZF90b2RheV8yMDI1LTEwLTMxIjtiOjE7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zZWFyY2g/Y2F0ZWdvcnk9JnE9c2FsZW0iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1761899118),
('IGToE3ZRANVgSMSgA5BiW8FhgHTutNSZmMYeKQ5n', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNjFvVnVsY2hGUzFERHpNQm05U2l2NkFkYWViOXoya1VrcTI5d0ZObCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1761672865);

-- --------------------------------------------------------

--
-- Table structure for table `site_metrics`
--

CREATE TABLE `site_metrics` (
  `metric_date` date NOT NULL,
  `visits` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_metrics`
--

INSERT INTO `site_metrics` (`metric_date`, `visits`) VALUES
('2025-09-25', 150),
('2025-09-26', 180),
('2025-09-27', 210),
('2025-09-28', 240),
('2025-09-29', 260),
('2025-09-30', 300),
('2025-10-01', 120),
('2025-10-02', 4),
('2025-10-03', 4),
('2025-10-04', 2),
('2025-10-06', 3),
('2025-10-28', 1),
('2025-10-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`key`, `value`) VALUES
('site_logo', 'branding/iLgr0pgbjr1GPMdkdkOeNpxVADGllqV1c3LRsmRg.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','author','admin') NOT NULL DEFAULT 'user',
  `profile_photo_path` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `profile_photo_path`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'mimin', 'admin@example.com', '$2y$12$jVivNgdajMsKvWxmpVZVyuMJLp30n4HB/A6AZbr25btCN1KuDc/Sy', 'admin', 'avatars/toEqMhyTZsXRYcE800S1YyyEPC2272cNYaaaT5aF.jpg', '2025-10-01 10:54:59', NULL, '2025-10-01 10:54:59', '2025-10-03 02:33:19'),
(2, 'Alice Author', 'author@example.com', '$2y$12$OdRpgwFCJ82q6mAh33JGbOHV4bl9gSdOtc77dB.Qvmg18r4BIiJWq', 'author', NULL, '2025-10-01 10:54:59', NULL, '2025-10-01 10:54:59', '2025-10-02 09:15:30'),
(3, 'Bob Reader', 'user@example.com', '$2y$12$BDON4at/COaqETzb9lEFY.QYLT7HdvVIU8I8gl56sNvTTJ.0VI1/K', 'user', NULL, '2025-10-01 10:54:59', NULL, '2025-10-01 10:54:59', '2025-10-02 09:15:30'),
(4, 'asep', 'asep@email.com', '$2y$12$hf/G1DaJaB3FmHCMf9iPJ.lhOUd9EqwA5C/SdfVDZ1T4ynb/h3TUW', 'author', NULL, NULL, NULL, '2025-10-02 08:50:34', '2025-10-02 11:37:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comments_posts` (`post_id`),
  ADD KEY `fk_comments_users` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location` (`location`,`display_order`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `fk_posts_users` (`user_id`),
  ADD KEY `fk_posts_categories` (`category_id`);

--
-- Indexes for table `post_views`
--
ALTER TABLE `post_views`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_post_date` (`post_id`,`view_date`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `site_metrics`
--
ALTER TABLE `site_metrics`
  ADD PRIMARY KEY (`metric_date`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `post_views`
--
ALTER TABLE `post_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_posts` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_comments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_posts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_views`
--
ALTER TABLE `post_views`
  ADD CONSTRAINT `fk_postviews_posts` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
