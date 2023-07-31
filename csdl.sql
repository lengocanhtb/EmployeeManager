-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 02, 2023 lúc 04:19 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlynhanvien`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chamcong`
--

CREATE TABLE `chamcong` (
  `id` int(11) NOT NULL,
  `nhanvien_id` int(11) NOT NULL,
  `ngay` date NOT NULL,
  `tinh_trang` enum('Có mặt','Vắng mặt') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chamcong`
--

INSERT INTO `chamcong` (`id`, `nhanvien_id`, `ngay`, `tinh_trang`) VALUES
(2, 4, '2023-07-02', 'Có mặt'),
(3, 4, '2023-07-01', 'Có mặt'),
(4, 5, '2023-07-02', 'Có mặt'),
(5, 5, '2023-07-01', 'Có mặt'),
(6, 6, '2023-07-02', 'Vắng mặt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hopdong`
--

CREATE TABLE `hopdong` (
  `id` int(11) NOT NULL,
  `nhanvien_id` int(11) NOT NULL,
  `vitri_congviec` varchar(100) NOT NULL,
  `chuc_danh` varchar(100) NOT NULL,
  `kieu_hopdong` enum('Hợp đồng xác định thời hạn','Hợp đồng không xác định thời hạn') NOT NULL,
  `luong_dai_ngo` varchar(200) NOT NULL,
  `cau_truc_luong` text NOT NULL,
  `gio_lamviec` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hopdong`
--

INSERT INTO `hopdong` (`id`, `nhanvien_id`, `vitri_congviec`, `chuc_danh`, `kieu_hopdong`, `luong_dai_ngo`, `cau_truc_luong`, `gio_lamviec`) VALUES
(2, 4, 'Nhân viên bộ phận kinh doanh', 'Nhân viên văn phòng', 'Hợp đồng không xác định thời hạn', '10 triệu đồng', 'Lương cơ bản (8 triệu) + lương thưởng (2 triệu)', 'Từ 8 giờ tới 17 giờ'),
(3, 6, 'Trưởng phòng nhân sự', 'Trưởng phòng', 'Hợp đồng không xác định thời hạn', '15 triệu đồng 1 tháng', 'Lương cơ bản (15 triệu) + lương thưởng (1 triệu) + lương hiệu quả công việc ( 1- 2 triệu)', 'Từ 8 giờ tới 17 giờ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `id` int(11) NOT NULL,
  `ten` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dien_thoai` varchar(20) NOT NULL,
  `gioi_tinh` enum('Nam','Nữ') NOT NULL,
  `so_cccd` varchar(20) NOT NULL,
  `ngay_sinh` date NOT NULL,
  `que_quan` varchar(200) NOT NULL,
  `tinh_trang_hon_nhan` enum('Độc thân','Đã kết hôn','Ly hôn') NOT NULL,
  `ngay_vao_lam` date NOT NULL,
  `phong_ban` varchar(100) NOT NULL,
  `chuc_vu` varchar(100) NOT NULL,
  `trinh_do_hoc_van` enum('Đại học','Cao Đẳng','Trung học phổ thông','Trung học cơ sở') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`id`, `ten`, `email`, `dien_thoai`, `gioi_tinh`, `so_cccd`, `ngay_sinh`, `que_quan`, `tinh_trang_hon_nhan`, `ngay_vao_lam`, `phong_ban`, `chuc_vu`, `trinh_do_hoc_van`) VALUES
(4, 'Bùi Công Sơn', 'congson@gmail.com', '0394012547', 'Nam', '206314118789', '1998-01-25', 'Quảng Bình', 'Đã kết hôn', '2023-06-25', 'Tài chính', 'Nhân viên', 'Đại học'),
(5, 'Lê Văn Phát', 'levanphat@gmail.com', '0394937456', 'Nam', '400382665412', '1998-05-02', 'Bình Định', 'Độc thân', '2023-06-28', 'Kế toán', 'Nhân viên', 'Đại học'),
(6, 'Lê Thị Loan', 'lethiloan@gmail.com', '0374645328', 'Nữ', '400988735334', '1997-01-22', 'Đà Nẵng', 'Độc thân', '2023-06-25', 'Nhân sự', 'Trưởng phòng', 'Đại học');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `tendangnhap` varchar(255) NOT NULL,
  `matkhau` varchar(255) NOT NULL,
  `tenhienthi` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `tendangnhap`, `matkhau`, `tenhienthi`) VALUES
(1, 'quanly', '123456', 'Quản Lý');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tangca`
--

CREATE TABLE `tangca` (
  `id` int(11) NOT NULL,
  `nhanvien_id` int(11) NOT NULL,
  `ngay` date NOT NULL,
  `so_gio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tangca`
--

INSERT INTO `tangca` (`id`, `nhanvien_id`, `ngay`, `so_gio`) VALUES
(2, 4, '2023-07-01', 2),
(3, 6, '2023-07-02', 4);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chamcong`
--
ALTER TABLE `chamcong`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nhanvien_id` (`nhanvien_id`);

--
-- Chỉ mục cho bảng `hopdong`
--
ALTER TABLE `hopdong`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nhanvien_id` (`nhanvien_id`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD UNIQUE KEY `unique_socccd` (`so_cccd`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tangca`
--
ALTER TABLE `tangca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nhanvien_id` (`nhanvien_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chamcong`
--
ALTER TABLE `chamcong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `hopdong`
--
ALTER TABLE `hopdong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tangca`
--
ALTER TABLE `tangca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chamcong`
--
ALTER TABLE `chamcong`
  ADD CONSTRAINT `chamcong_ibfk_1` FOREIGN KEY (`nhanvien_id`) REFERENCES `nhanvien` (`id`);

--
-- Các ràng buộc cho bảng `hopdong`
--
ALTER TABLE `hopdong`
  ADD CONSTRAINT `hopdong_ibfk_1` FOREIGN KEY (`nhanvien_id`) REFERENCES `nhanvien` (`id`);

--
-- Các ràng buộc cho bảng `tangca`
--
ALTER TABLE `tangca`
  ADD CONSTRAINT `tangca_ibfk_1` FOREIGN KEY (`nhanvien_id`) REFERENCES `nhanvien` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
