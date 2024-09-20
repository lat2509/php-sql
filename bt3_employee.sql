-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 10, 2024 lúc 09:53 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bt3_employee`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuc_vu_tbl`
--

CREATE TABLE `chuc_vu_tbl` (
  `id_cv` int(255) NOT NULL,
  `chuc_vu` varchar(255) NOT NULL,
  `ngay_them` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chuc_vu_tbl`
--

INSERT INTO `chuc_vu_tbl` (`id_cv`, `chuc_vu`, `ngay_them`) VALUES
(1, 'Project Manager', '2024-04-23 15:11:03'),
(2, 'Frontend Developer', '2024-04-23 15:12:02'),
(3, 'Backend Developer', '2024-04-23 15:11:03'),
(4, 'Tester', '2024-04-23 15:11:03'),
(5, 'Human Resources', '2024-04-23 15:11:03'),
(6, 'Accountant', '2024-04-23 15:11:03'),
(7, 'Business Analyst', '2024-04-23 15:11:03'),
(10, 'Data Analyst', '2024-05-09 16:53:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `login_tbl`
--

CREATE TABLE `login_tbl` (
  `id_login` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `login_tbl`
--

INSERT INTO `login_tbl` (`id_login`, `username`, `password`, `user_type`) VALUES
(1, 'admin1', 'admin1', 1),
(2, 'nam@gmail.com', '0123456789', 2),
(3, 'thang@gmail.com', '0123456788', 2),
(4, 'thong@gmail.com', '0123456787', 2),
(5, 'vuong@gmail.com', '0123456786', 2),
(6, 'nhuan@gmail.com', '0123456785', 2),
(7, 'a@gmail.com', '0123456784', 2),
(8, 'b@gmail.com', '0123456783', 2),
(9, 'c@gmail.com', '0123456782', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `luong_tbl`
--

CREATE TABLE `luong_tbl` (
  `id_luong` int(255) NOT NULL,
  `id_nv` int(255) NOT NULL,
  `luong_co_ban` bigint(255) NOT NULL,
  `phu_cap` bigint(255) NOT NULL,
  `tong_luong` bigint(255) NOT NULL,
  `ngay_them` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ngay_cap_nhat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `luong_tbl`
--

INSERT INTO `luong_tbl` (`id_luong`, `id_nv`, `luong_co_ban`, `phu_cap`, `tong_luong`, `ngay_them`, `ngay_cap_nhat`) VALUES
(1, 2, 10000000, 2000000, 12000000, '2024-05-09 16:09:36', '0000-00-00'),
(2, 3, 6000000, 4000000, 10000000, '2024-05-09 16:53:40', '0000-00-00'),
(3, 4, 60000000, 15000000, 75000000, '2024-05-09 16:56:42', '0000-00-00'),
(4, 5, 40000000, 7000000, 47000000, '2024-04-23 15:58:21', '2024-04-23'),
(5, 6, 30000000, 5000000, 35000000, '2024-04-23 15:58:21', '2024-04-23'),
(6, 7, 40000000, 5000000, 45000000, '2024-04-23 15:58:21', '2024-04-23'),
(7, 8, 35000000, 5000000, 40000000, '2024-04-23 15:58:21', '2024-04-23'),
(8, 9, 25000000, 5000000, 30000000, '2024-04-23 15:58:21', '2024-04-23'),
(15, 10, 20000000, 5000000, 25000000, '2024-05-09 16:09:17', '2024-05-09'),
(16, 11, 36000000, 4000000, 40000000, '2024-05-09 19:34:32', '2024-05-10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nghi_phep_tbl`
--

CREATE TABLE `nghi_phep_tbl` (
  `id_nghi` int(255) NOT NULL,
  `id_nv` int(255) NOT NULL,
  `ly_do` varchar(255) NOT NULL,
  `chi_tiet` text NOT NULL,
  `ngay_bat_dau` date NOT NULL,
  `ngay_ket_thuc` date NOT NULL,
  `ngay_tao_don` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `trang_thai` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nghi_phep_tbl`
--

INSERT INTO `nghi_phep_tbl` (`id_nghi`, `id_nv`, `ly_do`, `chi_tiet`, `ngay_bat_dau`, `ngay_ket_thuc`, `ngay_tao_don`, `trang_thai`) VALUES
(1, 3, 'Nghỉ ốm', 'Em bị sốt 39 độ 2 ngày nay rồi.', '2024-04-24', '2024-04-27', '2024-05-10 07:37:24', 0),
(2, 5, 'Nghỉ chăm vợ đẻ', 'Vợ em vừa mới sinh, em xin phép ở nhà chăm vợ mấy hôm.', '2024-04-25', '2024-04-29', '2024-05-10 07:01:59', 1),
(3, 6, 'Nghị ốm', 'Em bị sốt 39 độ 2 ngày nay rồi.', '2024-04-24', '2024-04-27', '2024-05-10 06:07:16', 1),
(4, 8, 'Nghỉ do xe hỏng', 'Xe em bị nổ lốp em đang đi sửa.', '2024-04-24', '2024-04-24', '2024-05-10 07:37:15', 0),
(5, 4, 'Nghỉ đi khám bệnh', 'Em đi khám lại dạ dày theo lịch hẹn', '2024-03-24', '2024-03-25', '2024-05-10 07:02:00', 1),
(6, 2, 'Nghỉ đi đám cưới nyc', 'Em đi đám cưới nyc', '2024-05-15', '2024-05-18', '2024-05-10 06:06:48', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhan_vien_tbl`
--

CREATE TABLE `nhan_vien_tbl` (
  `id_nv` int(255) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `ngay_sinh` varchar(255) NOT NULL,
  `gioi_tinh` varchar(255) NOT NULL,
  `so_dien_thoai` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dia_chi` varchar(255) NOT NULL,
  `id_chuc_vu` int(11) NOT NULL,
  `ngay_vao_lam` date NOT NULL,
  `ngay_them` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `anh` varchar(255) NOT NULL DEFAULT 'https://cdn-icons-png.flaticon.com/512/3541/3541871.png',
  `ngay_cap_nhat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nhan_vien_tbl`
--

INSERT INTO `nhan_vien_tbl` (`id_nv`, `ten`, `ngay_sinh`, `gioi_tinh`, `so_dien_thoai`, `email`, `dia_chi`, `id_chuc_vu`, `ngay_vao_lam`, `ngay_them`, `anh`, `ngay_cap_nhat`) VALUES
(2, 'Phạm Hoài Nam', '2003-08-24', 'Nam', '0123456789', 'nam@gmail.com', 'Kim Chung, Đông Anh, Hà Nội', 10, '2024-01-01', '2024-05-10 05:33:27', 'https://cdn.iconscout.com/icon/free/png-256/free-avatar-380-456332.png', '2024-01-01'),
(3, 'Nguyễn Quang Thắng', '2003-01-01', 'Nam', '0123456788', 'thang@gmail.com', 'Hà Đông, Hà Nội', 2, '2024-04-23', '2024-05-10 05:33:42', 'https://cdn.iconscout.com/icon/free/png-256/free-avatar-370-456322.png', '2024-04-23'),
(4, 'Đào Duy Thông', '2003-01-01', 'Nam', '0123456787', 'thong@gmail.com', 'Hà Đông, Hà Nội', 1, '2023-12-15', '2024-05-10 05:37:17', 'https://cdn-icons-png.flaticon.com/128/4140/4140061.png', '2023-12-15'),
(5, 'Lê Minh Vương', '2003-01-01', 'Nam', '0123456786', 'vuong@gmail.com', 'Hà Đông, Hà Nội', 2, '2024-01-10', '2024-05-10 05:41:09', 'https://www.svgrepo.com/show/420337/animal-avatar-bear.svg', '2024-01-10'),
(6, 'Hồ Văn Nhuận', '2003-01-01', 'Nam', '0123456785', 'nhuan@gmail.com', 'Hà Đông, Hà Nội', 5, '2024-04-23', '2024-05-10 05:42:08', 'https://cdn.icon-icons.com/icons2/1736/PNG/512/4043273-animal-avatar-mutton-sheep_113242.png', '2024-04-23'),
(7, 'Lê Văn An', '2003-01-01', 'Nam', '0123456784', 'an@gmail.com', 'Ba Đình, Hà Nội', 6, '2024-04-23', '2024-05-10 07:38:33', 'https://cdn-icons-png.flaticon.com/512/3541/3541871.png', '2024-04-23'),
(8, 'Nguyễn Văn B', '2003-01-01', 'Nam', '0123456783', 'b@gmail.com', 'Thanh Xuân, Hà Nội', 7, '2024-04-23', '2024-05-10 05:42:50', 'https://static.vecteezy.com/system/resources/previews/011/483/813/original/guy-anime-avatar-free-vector.jpg', '2024-04-23'),
(10, 'Nguyễn Minh Tùng', '2024-02-25', 'Nam', '0397403808', 'minhtung@gmail.com', '79 ngõ 22 Dương Lâm', 3, '2024-05-09', '2024-05-10 05:39:38', 'https://i.pinimg.com/474x/7c/c7/a6/7cc7a630624d20f7797cb4c8e93c09c1.jpg', '2024-05-09'),
(11, 'Nguyễn Ngọc Hà', '2003-09-02', 'Nữ', '7635442642', 'ngocha@gmail.com', 'PTIT', 3, '2024-01-02', '2024-05-10 05:40:18', 'https://i.pinimg.com/564x/6e/2e/91/6e2e914b49c7aa38572a8668d527b6e2.jpg', '2024-01-02'),
(13, 'Nguyễn Văn Thắng', '2004-01-15', 'Nam', '0386634627', 'thangvan@gmail.com', '217 Trần Phú,Hà Đông', 4, '2024-02-10', '2024-05-10 05:49:13', 'https://static.vecteezy.com/system/resources/previews/011/961/865/non_2x/programmer-icon-line-color-illustration-vector.jpg', '2024-02-10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tra_luong_tbl`
--

CREATE TABLE `tra_luong_tbl` (
  `id` int(11) NOT NULL,
  `id_nv` int(11) NOT NULL,
  `thoi_gian` date NOT NULL,
  `so_tien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tra_luong_tbl`
--

INSERT INTO `tra_luong_tbl` (`id`, `id_nv`, `thoi_gian`, `so_tien`) VALUES
(1, 2, '2024-01-15', 12000000),
(2, 2, '2024-02-15', 12000000),
(3, 2, '2024-03-15', 12000000),
(4, 2, '2024-04-15', 12000000),
(5, 3, '2024-01-15', 15000000),
(6, 3, '2024-02-15', 15500000),
(7, 3, '2024-03-15', 16000000),
(8, 4, '2024-01-15', 16500000),
(9, 4, '2024-02-15', 17000000),
(10, 4, '2024-03-15', 17500000),
(11, 5, '2024-01-15', 18000000),
(12, 5, '2024-02-15', 18500000),
(13, 5, '2024-03-15', 19000000),
(14, 6, '2024-01-15', 19500000),
(15, 6, '2024-02-15', 20000000),
(16, 6, '2024-03-15', 20500000),
(17, 7, '2024-01-15', 21000000),
(18, 7, '2024-02-15', 21500000),
(19, 7, '2024-03-15', 22000000),
(20, 8, '2024-01-15', 22500000),
(21, 8, '2024-02-15', 23000000),
(22, 8, '2024-03-15', 23500000),
(23, 9, '2024-01-15', 24000000),
(24, 9, '2024-02-15', 24500000),
(25, 9, '2024-03-15', 25000000),
(26, 10, '2024-01-15', 20000000),
(27, 10, '2024-12-15', 19800000),
(28, 11, '2024-03-15', 38500000),
(29, 11, '2024-05-15', 1000000);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chuc_vu_tbl`
--
ALTER TABLE `chuc_vu_tbl`
  ADD PRIMARY KEY (`id_cv`);

--
-- Chỉ mục cho bảng `login_tbl`
--
ALTER TABLE `login_tbl`
  ADD PRIMARY KEY (`id_login`);

--
-- Chỉ mục cho bảng `luong_tbl`
--
ALTER TABLE `luong_tbl`
  ADD PRIMARY KEY (`id_luong`);

--
-- Chỉ mục cho bảng `nghi_phep_tbl`
--
ALTER TABLE `nghi_phep_tbl`
  ADD PRIMARY KEY (`id_nghi`);

--
-- Chỉ mục cho bảng `nhan_vien_tbl`
--
ALTER TABLE `nhan_vien_tbl`
  ADD PRIMARY KEY (`id_nv`);

--
-- Chỉ mục cho bảng `tra_luong_tbl`
--
ALTER TABLE `tra_luong_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chuc_vu_tbl`
--
ALTER TABLE `chuc_vu_tbl`
  MODIFY `id_cv` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `login_tbl`
--
ALTER TABLE `login_tbl`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `luong_tbl`
--
ALTER TABLE `luong_tbl`
  MODIFY `id_luong` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `nghi_phep_tbl`
--
ALTER TABLE `nghi_phep_tbl`
  MODIFY `id_nghi` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `nhan_vien_tbl`
--
ALTER TABLE `nhan_vien_tbl`
  MODIFY `id_nv` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `tra_luong_tbl`
--
ALTER TABLE `tra_luong_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
