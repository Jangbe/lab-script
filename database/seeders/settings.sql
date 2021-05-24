SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `settings` (`id`, `key`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'identitas', 'Identitas Web', '{\"nama\":\"Sinergi Lisna Medika\",\"uraian\":\"Laboratorium Klinik Pratama\",\"alamat\":\"Jl. Sunan Kalijaga No. 63 Blok M, Jakarta Selatan\",\"email\":\"sinergilisnamedika@gmail.com\",\"no_telp\":\"(021) 726-2453\",\"no_fax\":\"(021) 726-2453\"}', '2021-05-16 00:26:28', '2021-05-16 00:26:28'),
(2, 'pdf', 'PDF', '{\"show_header\":\"1\",\"show_penanggung_jawab\":\"1\"}', '2021-05-17 16:35:44', '2021-05-17 17:26:27');
COMMIT;
