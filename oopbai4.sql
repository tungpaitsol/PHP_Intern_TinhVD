-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 09, 2019 lúc 10:00 AM
-- Phiên bản máy phục vụ: 10.1.36-MariaDB
-- Phiên bản PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `oopbai4`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `holiday`
--

CREATE TABLE `holiday` (
  `id` int(5) UNSIGNED NOT NULL,
  `date_holiday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `holiday`
--

INSERT INTO `holiday` (`id`, `date_holiday`) VALUES
(1, '2019-01-01'),
(2, '2019-02-04'),
(3, '2019-02-05'),
(4, '2019-02-06'),
(5, '2019-02-07'),
(6, '2019-02-08'),
(7, '2019-04-14'),
(8, '2019-04-30'),
(9, '2019-05-01'),
(10, '2019-09-02'),
(11, '2019-08-18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `holiday_of_ranch`
--

CREATE TABLE `holiday_of_ranch` (
  `id` int(5) UNSIGNED NOT NULL,
  `ranch_id` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `horse`
--

CREATE TABLE `horse` (
  `id` int(10) UNSIGNED NOT NULL,
  `ranch_id` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL,
  `name_horse` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ranch`
--

CREATE TABLE `ranch` (
  `id` int(5) UNSIGNED NOT NULL,
  `ranch_id` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL,
  `name_ranch` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `phone_ranch` varchar(15) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `ranch`
--

INSERT INTO `ranch` (`id`, `ranch_id`, `name_ranch`, `phone_ranch`) VALUES
(1, 'R001', 'Nông trại 1', '0983xxx1231'),
(2, 'R002', 'Nông trại 2', '0983xxx1221'),
(3, 'R003', 'Nông trại 3', '0983xxx1997');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ranch_calendar`
--

CREATE TABLE `ranch_calendar` (
  `id` int(5) UNSIGNED NOT NULL,
  `ranch_id` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `ranch_calendar`
--

INSERT INTO `ranch_calendar` (`id`, `ranch_id`, `start_date`, `end_date`) VALUES
(1, 'R001', '2019-07-31', '2019-12-31'),
(2, 'R002', '2019-02-27', '2019-08-31'),
(4, 'R003', '2019-02-27', '2019-12-11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ranch_calendar_info`
--

CREATE TABLE `ranch_calendar_info` (
  `id` int(10) NOT NULL,
  `ranch_calendar_id` int(15) NOT NULL,
  `time_of_day` time NOT NULL,
  `group_reception` int(100) NOT NULL,
  `monday_number_horse` int(100) NOT NULL,
  `tuesday_number_horse` int(100) NOT NULL,
  `wednesday_number_horse` int(100) NOT NULL,
  `thursday_number_horse` int(100) NOT NULL,
  `friday_number_horse` int(100) NOT NULL,
  `saturday_number_horse` int(100) NOT NULL,
  `sunday_number_horse` int(100) NOT NULL,
  `holiday_number_horse` int(100) NOT NULL,
  `monday_other_club` tinyint(1) NOT NULL,
  `tuesday_other_club` tinyint(1) NOT NULL,
  `wednesday_other_club` tinyint(1) NOT NULL,
  `thursday_other_club` tinyint(1) NOT NULL,
  `friday_other_club` tinyint(1) NOT NULL,
  `saturday_other_club` tinyint(1) NOT NULL,
  `sunday_other_club` tinyint(1) NOT NULL,
  `holiday_other_club` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ranch_calendar_info`
--

INSERT INTO `ranch_calendar_info` (`id`, `ranch_calendar_id`, `time_of_day`, `group_reception`, `monday_number_horse`, `tuesday_number_horse`, `wednesday_number_horse`, `thursday_number_horse`, `friday_number_horse`, `saturday_number_horse`, `sunday_number_horse`, `holiday_number_horse`, `monday_other_club`, `tuesday_other_club`, `wednesday_other_club`, `thursday_other_club`, `friday_other_club`, `saturday_other_club`, `sunday_other_club`, `holiday_other_club`) VALUES
(1, 1, '08:00:00', 5, 3, 2, 4, 3, 2, 2, 3, 4, 1, 0, 0, 1, 0, 1, 0, 1),
(2, 1, '08:30:00', 3, 4, 6, 5, 3, 4, 5, 5, 5, 0, 1, 1, 1, 1, 0, 0, 0),
(3, 1, '09:00:00', 6, 5, 8, 2, 1, 6, 6, 2, 5, 0, 0, 1, 0, 0, 1, 0, 0),
(4, 1, '10:00:00', 2, 5, 7, 3, 2, 3, 10, 9, 3, 0, 1, 0, 1, 0, 1, 1, 0),
(5, 1, '10:30:00', 7, 4, 4, 4, 6, 4, 7, 6, 5, 0, 1, 0, 1, 0, 1, 0, 1),
(6, 2, '08:30:00', 2, 4, 3, 4, 5, 2, 1, 2, 1, 1, 0, 0, 0, 1, 0, 0, 0),
(7, 2, '12:00:00', 3, 4, 2, 5, 8, 5, 4, 3, 3, 0, 1, 0, 1, 0, 1, 0, 1),
(8, 2, '14:00:00', 3, 5, 5, 7, 6, 2, 4, 2, 5, 0, 0, 1, 0, 0, 0, 1, 0),
(11, 4, '14:00:00', 5, 2, 4, 1, 3, 4, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 4, '13:00:00', 2, 3, 0, 5, 4, 0, 2, 6, 4, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `register_visit`
--

CREATE TABLE `register_visit` (
  `id` int(5) UNSIGNED NOT NULL,
  `ranch_id` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL,
  `phone_user` varchar(15) COLLATE utf8_vietnamese_ci NOT NULL,
  `date_time` date NOT NULL,
  `other_club_horse` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `register_visit_horse_info`
--

CREATE TABLE `register_visit_horse_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `nameCustomer` varchar(500) COLLATE utf8_vietnamese_ci NOT NULL,
  `phoneCustomer` varchar(15) COLLATE utf8_vietnamese_ci NOT NULL,
  `dateVisit` date NOT NULL,
  `nameRanch` varchar(200) COLLATE utf8_vietnamese_ci NOT NULL,
  `time_visit` time NOT NULL,
  `name_horse` varchar(500) COLLATE utf8_vietnamese_ci NOT NULL,
  `number_horse_other_club` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `register_visit_horse_info`
--

INSERT INTO `register_visit_horse_info` (`id`, `nameCustomer`, `phoneCustomer`, `dateVisit`, `nameRanch`, `time_visit`, `name_horse`, `number_horse_other_club`) VALUES
(1, 'Vũ Đăng Tính', '0372052643', '2019-08-16', 'R001', '08:00:00', 'Ngựa 1', 0),
(2, 'Nguyễn Văn A', '0372052644', '2019-08-16', 'R001', '08:00:00', 'Ngựa 2', 0),
(3, 'Vũ Đăng Tính', '0372052643', '2019-08-16', 'R001', '08:00:00', 'Ngựa 3', 0),
(4, 'Ẩn danh', '1900235552', '2019-08-16', 'R003', '14:00:00', 'Ngựa 001', 0),
(5, 'Ẩn danh', '1900235552', '2019-08-16', 'R003', '14:00:00', 'Ngựa 002', 0),
(6, 'Vũ Đăng Tính', '0372052643', '2019-08-16', 'R003', '13:00:00', 'ngựa 1 nông trại 2', 0),
(7, 'Vũ Đăng Tính', '0372052643', '2019-08-17', 'R001', '10:30:00', 'Ngựa R001 1', 0),
(8, 'Vũ Đăng Tính', '0372052643', '2019-08-17', 'R001', '10:30:00', 'Ngựa R001 2', 0),
(9, 'Vũ Đăng Tính', '0372052643', '2019-08-17', 'R001', '10:30:00', 'Ngựa R001 3', 0),
(10, 'Ẩn danh', '1900235552', '2019-08-17', 'R002', '08:30:00', 'Ngựa R002 1', 0),
(11, 'Ẩn danh', '1900235552', '2019-08-17', 'R001', '10:30:00', 'Ngựa R001 1', 0),
(12, 'Ẩn danh', '1900235552', '2019-08-17', 'R001', '10:30:00', 'Ngựa R001 2', 0),
(13, 'Ẩn danh', '1900235552', '2019-08-17', 'R003', '13:00:00', 'Ngựa R003 2', 0),
(14, 'Ẩn danh', '1900235552', '2019-08-17', 'R003', '13:00:00', 'Ngựa R003 5', 0),
(15, 'Nguyễn Văn B', '012211334', '2019-08-17', 'R001', '10:00:00', 'Ngựa R001 2', 3),
(16, 'Lê Thu X', '0837111255', '2019-08-20', 'R002', '12:00:00', 'R002A', 0),
(17, 'Lê Thu X', '0837111255', '2019-08-20', 'R002', '12:00:00', 'R002B', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `holiday_of_ranch`
--
ALTER TABLE `holiday_of_ranch`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `horse`
--
ALTER TABLE `horse`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ranch`
--
ALTER TABLE `ranch`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ranch_calendar`
--
ALTER TABLE `ranch_calendar`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ranch_calendar_info`
--
ALTER TABLE `ranch_calendar_info`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `register_visit`
--
ALTER TABLE `register_visit`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `register_visit_horse_info`
--
ALTER TABLE `register_visit_horse_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `holiday`
--
ALTER TABLE `holiday`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `holiday_of_ranch`
--
ALTER TABLE `holiday_of_ranch`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `horse`
--
ALTER TABLE `horse`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ranch`
--
ALTER TABLE `ranch`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `ranch_calendar`
--
ALTER TABLE `ranch_calendar`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `ranch_calendar_info`
--
ALTER TABLE `ranch_calendar_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `register_visit`
--
ALTER TABLE `register_visit`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `register_visit_horse_info`
--
ALTER TABLE `register_visit_horse_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
