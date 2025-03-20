-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2025 at 02:37 AM
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
-- Database: `toiec`
--

-- --------------------------------------------------------

--
-- Table structure for table `audio`
--

CREATE TABLE `audio` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `audio`
--

INSERT INTO `audio` (`id`, `file_url`) VALUES
(1, 'audio/001.mp3'),
(2, 'audio/002.mp3'),
(3, 'audio/003.mp3'),
(4, 'audio/004.mp3'),
(5, 'audio/201.mp3'),
(6, 'audio/202.mp3'),
(7, 'audio/203.mp3'),
(8, 'audio/204.mp3'),
(9, 'audio/301.mp3'),
(10, 'audio/302.mp3'),
(11, 'audio/303.mp3'),
(12, 'audio/401.mp3'),
(13, 'audio/402.mp3'),
(14, 'audio/403.mp3');

-- --------------------------------------------------------

--
-- Table structure for table `bai_hoc`
--

CREATE TABLE `bai_hoc` (
  `id` int(10) UNSIGNED NOT NULL,
  `khoa_hoc_id` int(10) UNSIGNED NOT NULL,
  `tai_lieu_id` int(10) UNSIGNED NOT NULL,
  `ten_bai_hoc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bai_kiem_tra`
--

CREATE TABLE `bai_kiem_tra` (
  `id` int(10) UNSIGNED NOT NULL,
  `khoa_hoc_id` int(10) UNSIGNED NOT NULL,
  `ten_bkt` varchar(255) NOT NULL,
  `thoi_gian_lam_bai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `co_cau_hoi_doc`
--

CREATE TABLE `co_cau_hoi_doc` (
  `bai_kiem_tra_id` int(10) UNSIGNED NOT NULL,
  `ngan_hang_chd_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `co_cau_hoi_nghe`
--

CREATE TABLE `co_cau_hoi_nghe` (
  `bai_kiem_tra_id` int(10) UNSIGNED NOT NULL,
  `ngan_hang_chn_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dang_ky_khoa_hoc`
--

CREATE TABLE `dang_ky_khoa_hoc` (
  `nguoi_dung_id` int(10) UNSIGNED NOT NULL,
  `khoa_hoc_id` int(10) UNSIGNED NOT NULL,
  `thoi_gian_dk` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dat_cau_hoi`
--

CREATE TABLE `dat_cau_hoi` (
  `id` int(10) UNSIGNED NOT NULL,
  `khoa_hoc_id` int(10) UNSIGNED NOT NULL,
  `nguoi_dung_id` int(10) UNSIGNED NOT NULL,
  `noi_dung` text NOT NULL,
  `thoi_gian` datetime DEFAULT current_timestamp(),
  `tra_loi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diem_bkt`
--

CREATE TABLE `diem_bkt` (
  `id` int(10) UNSIGNED NOT NULL,
  `bai_kiem_tra_id` int(10) UNSIGNED NOT NULL,
  `nguoi_dung_id` int(10) UNSIGNED NOT NULL,
  `phan_id` int(10) UNSIGNED NOT NULL,
  `diem` float DEFAULT NULL,
  `ngay_lam` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doan_van`
--

CREATE TABLE `doan_van` (
  `id` int(10) UNSIGNED NOT NULL,
  `noi_dung` text NOT NULL,
  `giai_thich` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `doan_van`
--

INSERT INTO `doan_van` (`id`, `noi_dung`, `giai_thich`) VALUES
(1, 'To:Kitchen staff,office employees\nFrom:Manager, LarryPark\nDate:March 23\nSubject: Renovations\n\nTo all kitchen staff and Harmon employees,\n\nFrom Sunday, March 23 to Thursday, March 27, the employee cafeteria kitchens will undergo renovations as new appliances and equipment (1) _____ in to replace the old ones. (2) _____ Instead, the convenience shops will carry more sandwiches, prepared lunch boxes,and snacks for the employees during this time.\n\nThe renovations will increase the number of sinks, ovens, and stove tops so that a larger volume of meals can be provided (3) _____ the lunch and dinner rushes. We apologize for the inconvenience but we hope that the changes will (4) _____ the services in the cafeteria.', 'Giải thích:\r\nGửi: Nhân viên bếp, nhân viên văn phòng Từ: Quản lý, Larry Park Ngày: 23 tháng 3 Chủ đề: Cải tạo Kính gửi toàn thể nhân viên bếp và nhân viên văn phòng Harmon, Từ Chủ nhật, ngày 23 tháng 3 đến Thứ năm, ngày 27 tháng 3, các khu vực bếp của căng tin nhân viên sẽ được cải tạo khi các thiết bị và máy móc mới được đưa vào thay thế cho các thiết bị cũ. Do đó, các bữa ăn nóng sẽ không có sẵn cho khách hàng. Thay vào đó, các cửa hàng tiện lợi sẽ cung cấp thêm nhiều loại sandwich, hộp cơm chuẩn bị sẵn và đồ ăn nhẹ cho nhân viên trong thời gian này. Việc cải tạo sẽ tăng số lượng chậu rửa, lò nướng và bếp ga để có thể phục vụ một lượng bữa ăn lớn hơn trong các giờ cao điểm buổi trưa và buổi tối. Chúng tôi xin lỗi về sự bất tiện này nhưng hy vọng rằng những thay đổi sẽ cải thiện dịch vụ tại căng tin.'),
(2, 'Thank you for shopping at Larson’s China. Our products are known for their modern and unique patterns and color combinations, as well as (1) _____ and strength. (2) _____ Please note, however, that repeated drops and rough handling will (3) _____ eventual breakage. We suggest you store them carefully and that you don’t use harsh chemicals, steel sponges, or (4) _____ scrubbing when cleaning them. Please visit our website at www.larsonchina.com for information about handling and care or call us at 555-1234 if you have any questions or concerns.', 'Giải thích:\r\nCảm ơn quý khách đã mua sắm tại Larson’s China. Sản phẩm của chúng tôi được biết đến với các họa tiết và sự kết hợp màu sắc hiện đại và độc đáo, cũng như độ bền và độ chắc chắn. (Chúng an toàn khi sử dụng trong máy rửa chén và lò vi sóng, và chúng tôi tin rằng quý khách sẽ sử dụng chúng trong nhiều năm tới. Tuy nhiên, xin lưu ý rằng việc rơi nhiều lần và xử lý thô bạo sẽ dẫn đến việc bị vỡ. Chúng tôi đề nghị quý khách cất giữ chúng cẩn thận và không sử dụng các hóa chất mạnh, bọt biển thép, hoặc chà xát mạnh khi làm sạch chúng. Xin vui lòng truy cập trang web của chúng tôi tại www.larsonchina.com để biết thông tin về cách xử lý và chăm sóc hoặc gọi cho chúng tôi theo số 555-1234 nếu quý khách có bất kỳ câu hỏi hay thắc mắc nào.\r\n'),
(3, 'To: samsmith@digitallT.com\r\nFrom: sharronb@email.com\r\nDate: September 24\r\nSubject: Business Contract\r\n\r\nDear Mr. Smith,\r\nI am Sharron Biggs, CEO and founder of BiggsGraphics. I recently came across your advertisement (1) _____ partnership of a graphic design company for a number of your projects. BiggsGraphics has (2) _____ experience working with various small businesses and companies in designing advertising campaigns, logos, and websites. (3) _____ Our website www.biggs-graphics.com also has some information about our company.\r\n\r\nI’m interested in working with your company on your projects and hope we can build a beneficial partnership. I look forward (4) _____ your reply.\r\n\r\nSincerely, Sharron Biggs\r\nCEO, BiggsGraphics', 'Giải thích:\r\nTới: samsmith@digitallT.com\r\nTừ: sharronb@email.com\r\nNgày: 24 tháng 9\r\nChủ đề: Hợp đồng kinh doanh\r\nKính gửi ông Smith,\r\nTôi là Sharron Biggs, Giám đốc điều hành và người sáng lập BiggsGraphics. Gần đây, tôi đã thấy quảng cáo của quý công ty tìm kiếm sự hợp tác với một công ty thiết kế đồ họa cho một số dự án của quý công ty. BiggsGraphics có nhiều kinh nghiệm làm việc với các doanh nghiệp nhỏ và các công ty trong việc thiết kế các chiến dịch quảng cáo, logo và trang web. Tôi đã đính kèm một số thiết kế trước đây của chúng tôi để minh họa những gì chúng tôi chuyên về. Trang web của chúng tôi www.biggs-graphics.com cũng có thông tin về công ty của chúng tôi.\r\nTôi rất quan tâm đến việc hợp tác với quý công ty trong các dự án của quý công ty và hy vọng chúng ta có thể xây dựng một mối quan hệ đối tác có lợi. Tôi mong chờ phản hồi từ quý công ty.\r\nTrân trọng,\r\nSharron Biggs\r\nGiám đốc điều hành, BiggsGraphics\r\n'),
(4, '16 July, Newtown—Health Shack is downtown Newtown\’s hottest new hangout for fitness buffs and corporate employees alike. - [1] - Owners Jill and Barry Baker opened the shop last month to rave reviews and long lines. Getting a seat or table at Health Shack can take as long as 30 minutes on a good day and the place is always crowded no matter the time of day. Health Shack offers only six items on its menu; all are protein shakes including the best sellers, Apple Pie, Peanut Butter Cup, and Tuity Fruity. - [2] - \"We were overwhelmed by the response,\" says Jill Baker. \"In fact, everything spread by word of mouth so we didn\’t even need to advertise.\" Fitness Instructor Julian Miles said, \"I love coming here for a quick lunch that won\’t wreck my fitness goals. I even recommend this place to all my patrons.\"- [3] - \"I come here to get a healthy but satisfying meal during my short break with my co-workers,\" added businessman Tim Hammer. \"Without Health Shack, we\’d be eating junk food.\" - [4] - Health Shack is open from 7:00 A.M. to 8:00 P.M. from Mondays through Fridays, and from 9:00 A.M. to 7:00 P.M. on Saturdays. It closes on Sundays. The owners hope to add new flavors to the menu in the coming months.', ''),
(5, 'Employee Winner of National Contest\nOne of our employees here at Arrow Design Laboratory, Jennifer Holt, has won first place in a web design contest hosted by the Association of Web Designers. Entrants were judged according to clarity of idea, quality of execution, and aesthetics. Ms. Holt was selected among over 300 different applicants. We applaud her achievement and are so happy to have her as an employee at Arrow Design Laboratory.\n\nThe Association of Web Designers (AWD) is an organization founded in 2002 with the goal ọf emphasizing the importance of web design and protecting the rights of web designers. The AWD has members all over the world and is constantly gaining new members. The AWD hosts a variety of contests in order to promote web design as a professional field. The AWD believes that good design can enhance people\’s lives and build better communities.\n\nAs a recipient of the first place for the web design contest, Ms. Holt will receive a cash prize as well as free membership in the Association of Web Designers. In addition, she has been invited to give a speech at the Annual Web Designers\’ Conference to be held next month in Los Angeles, California. The AWD will be holding more contests in the future, and those interested should visit the website at www.awd.com/contests to find out more information.\n', ''),
(6, 'This Amazing World Photography Competition\r\nThe monthly travel magazine This Amazing World is offering a discounted subscription rate for those who sign up during the month of November. This Amazing World has been in print for over 30 years and offers readers insider tips and expert know-how to help you plan the vacation of your dreams.\r\nThe magazine includes vacation package advertisements, reviews from travelers, and insightful essays to introduce you to various cultures, cuisines, and travel destinations.\r\nSubmit your travel photos to our This Amazing World Photography Competition for a chance to win a fantastic vacation to Scotland! The winner of the top prize will receive round-trip tickets and a $2,000 travel voucher for a hotel stay for two people.\r\n', '');

-- --------------------------------------------------------

--
-- Table structure for table `khoa_hoc`
--

CREATE TABLE `khoa_hoc` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten_khoa_hoc` varchar(255) NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `hoc_phi` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `khoa_hoc`
--

INSERT INTO `khoa_hoc` (`id`, `ten_khoa_hoc`, `mo_ta`, `hoc_phi`) VALUES
(1, 'Toeic - Listening', 'Dành cho người chỉ có nhu cầu ôn luyện kỹ năng nghe', 500000.00),
(2, 'Toeic - Reading', 'Dành cho người chỉ có nhu cầu ôn luyện kỹ năng đọc-hiểu', 500000.00);

-- --------------------------------------------------------

--
-- Table structure for table `ngan_hang_chd`
--

CREATE TABLE `ngan_hang_chd` (
  `id` int(10) UNSIGNED NOT NULL,
  `phan_id` int(10) UNSIGNED NOT NULL,
  `doan_van_id` int(10) UNSIGNED DEFAULT NULL,
  `phuong_an_id` int(10) UNSIGNED NOT NULL,
  `noi_dung_chd` text NOT NULL,
  `thu_tu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `ngan_hang_chd`
--

INSERT INTO `ngan_hang_chd` (`id`, `phan_id`, `doan_van_id`, `phuong_an_id`, `noi_dung_chd`, `thu_tu`) VALUES
(1, 5, NULL, 27, '_____ restructuring several departments within the company, the majority of the problems with miscommunication have disappeared.', 0),
(2, 5, NULL, 28, 'The figures that accompany the financial statement should be _____ to the spending category.', 0),
(3, 5, NULL, 29, 'Having proper ventilation throughout the building is _____ for protecting the health and well-being of the workers.', 0),
(4, 5, NULL, 30, 'The governmental department used to provide financial aid, but now it offers _____ services only.', 0),
(5, 5, NULL, 31, '_____ an ankle injury, the baseball player participated in the last game of the season.', 0),
(6, 5, NULL, 32, 'For optimal safety on the road, avoid _____ the view of the rear window and side-view mirrors.', 0),
(7, 6, 1, 33, 'From Sunday, March 23 to Thursday, March 27, the employee cafeteria kitchens will undergo renovations as new appliances and equipment (1) _____ in to replace the old ones.', 1),
(8, 6, 1, 34, '(2) _____ Instead, the convenience shops will carry more sandwiches, prepared lunch boxes,and snacks for the employees during this time.', 2),
(9, 6, 1, 35, 'The renovations will increase the number of sinks, ovens, and stove tops so that a larger volume of meals can be provided (3) _____ the lunch and dinner rushes.', 3),
(10, 6, 1, 36, 'We apologize for the inconvenience but we hope that the changes will (4) _____ the services in the cafeteria.', 4),
(11, 6, 2, 37, 'Our products are known for their modern and unique patterns and color combinations, as well as (1) _____ and strength', 1),
(12, 6, 2, 38, '(2) _____ Please note, however, that repeated drops and rough handling will _____ eventual breakage.', 2),
(13, 6, 2, 39, '_____ Please note, however, that repeated drops and rough handling will (3) _____ eventual breakage.', 3),
(14, 6, 2, 40, 'We suggest you store them carefully and that you don’t use harsh chemicals, steel sponges, or (4) _____ scrubbing when cleaning them.', 4),
(15, 6, 3, 41, 'I recently came across your advertisement (1) _____ partnership of a graphic design company for a number of your projects.', 1),
(16, 6, 3, 42, 'BiggsGraphics has (2) _____ experience working with various small businesses and companies in designing advertising campaigns, logos, and websites.', 2),
(17, 6, 3, 43, '(3) _____ Our website www.biggs-graphics.com also has some information about our company.', 3),
(18, 6, 3, 44, 'I look forward (4) _____ your reply.', 4),
(19, 7, 4, 45, 'What is suggested about the shop?', 1),
(20, 7, 4, 46, 'What is suggested about Health Shack products?', 2),
(21, 7, 4, 47, 'Why don’t the owners advertise?', 3),
(22, 7, 4, 48, 'In which of the positions marked [1], [2], [3] and [4] does the following sentence belong?\r\n“Despite the limited number of products on the menu, customers can’t get enough of the tasty but healthy shakes that are on offer.”', 4),
(23, 7, 5, 49, 'Why most likely was the article written?', 1),
(24, 7, 5, 50, 'The word “founded” in paragraph 2, line 1, is closest in meaning to:', 2),
(25, 7, 5, 51, 'What is suggested about the Association of Web Designers?', 3),
(26, 7, 5, 52, 'According to the article, what can be found on the website?', 4),
(27, 7, 6, 53, 'What is mentioned about the magazine?', 1),
(28, 7, 6, 54, 'What is suggested about the competition?', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ngan_hang_chn`
--

CREATE TABLE `ngan_hang_chn` (
  `id` int(10) UNSIGNED NOT NULL,
  `phan_id` int(10) UNSIGNED NOT NULL,
  `audio_id` int(10) UNSIGNED NOT NULL,
  `phuong_an_id` int(10) UNSIGNED NOT NULL,
  `noi_dung_chn` text DEFAULT NULL,
  `image_url` text DEFAULT NULL,
  `thu_tu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `ngan_hang_chn`
--

INSERT INTO `ngan_hang_chn` (`id`, `phan_id`, `audio_id`, `phuong_an_id`, `noi_dung_chn`, `image_url`, `thu_tu`) VALUES
(1, 1, 1, 1, '', 'images/image_csdl/001.png', NULL),
(2, 1, 2, 2, '', 'images/image_csdl/002.png', NULL),
(3, 1, 3, 3, '', 'images/image_csdl/003.png', NULL),
(4, 1, 4, 4, '', 'images/image_csdl/004.png', NULL),
(5, 2, 5, 5, '', '', NULL),
(6, 2, 6, 6, '', '', NULL),
(7, 2, 7, 7, '', '', NULL),
(8, 2, 8, 8, '', '', NULL),
(9, 3, 9, 9, 'Who most likely is the man?', '', 1),
(10, 3, 9, 10, 'What does the woman mention about the mall?', '', 2),
(11, 3, 9, 11, 'Why does the woman usually visit the mall?', '', 3),
(12, 3, 10, 12, 'Why does the woman call?', 'images/image_csdl/302.png', 1),
(13, 3, 10, 13, 'Look at the graphic. How many points will the woman use? ', 'images/image_csdl/302.png', 2),
(14, 3, 10, 14, 'What suggestion does the man give the woman? ', 'images/image_csdl/302.png', 3),
(15, 3, 11, 15, ' What are the speakers mainly discussing?', '', 1),
(16, 3, 11, 16, ' What is the problem?', '', 2),
(17, 3, 11, 17, ' What most likely will the man do first tomorrow?', '', 3),
(18, 4, 12, 18, ' Who most likely is the speaker?', '', 1),
(19, 4, 12, 19, ' Who are the listeners?', '', 2),
(20, 4, 12, 20, ' What will the listeners do in a meeting room?', '', 3),
(21, 4, 13, 21, ' Look at the graphic. Which items need to be ordered?', 'images/image_csdl/402.png', 1),
(22, 4, 13, 22, ' What does the speaker anticipate about the company?', 'images/image_csdl/402.png', 2),
(23, 4, 13, 23, ' What is the listener asked to do before making any orders?', 'images/image_csdl/402.png', 3),
(24, 4, 14, 24, ' What does the speaker mention about her company?', '', 1),
(25, 4, 14, 25, ' Why does the woman say, “my schedule is too tight to do that”?', '', 2),
(26, 4, 14, 26, ' What will they be sending a lot of?', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `nguoi_dung`
--

CREATE TABLE `nguoi_dung` (
  `id` int(10) UNSIGNED NOT NULL,
  `ho_ten` varchar(255) NOT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `vai_tro` tinyint(1) DEFAULT 0,
  `sdt` varchar(15) DEFAULT NULL,
  `thoi_gian_tao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tai_khoan` varchar(50) NOT NULL,
  `mat_khau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `nguoi_dung`
--

INSERT INTO `nguoi_dung` (`id`, `ho_ten`, `ngay_sinh`, `email`, `vai_tro`, `sdt`, `thoi_gian_tao`, `tai_khoan`, `mat_khau`) VALUES
(1, 'Phạm Anh Ngữ', '2004-10-13', 'ngub2203460@student.ctu.edu.vn', 1, '0987654321', '2025-03-15 01:28:32', 'ngub2203460', '$2y$10$7G2q6.zq7wkLdkldA1OUa.MQUa9/KG9IfihP.6AXbmmWxZemaVCJK'),
(2, 'Lưu Khả Nghị', '2004-01-01', 'nghib2203457@student.ctu.edu.vn', 1, '0987654322', '2025-03-15 01:29:06', 'nghib2203457', '$2y$10$OVldCEX/jpSaZaNexHOQxeLjRJFvfXdIGDXk/r2Fcpd/zhGyWbm1m'),
(3, 'Huỳnh Hiệp Phát', '2004-01-01', 'phatb2203463@student.ctu.edu.vn', 1, '0987654323', '2025-03-15 01:29:47', 'phatb2203463', '$2y$10$c6ohsy7vGKGXtvjX0nvFUeqzyWHyt8Y9tN7x447IePxOqpowZUHfi'),
(4, 'Thạch Sê Tha', '2002-01-01', 'thab2007422@student.ctu.edu.vn', 1, '0987654324', '2025-03-15 01:30:31', 'thab2007422', '$2y$10$fszk3F9N/YRmzJmPbTUdmefEjxe8dGfSkB/OT/pZtHnztEVtwoGl2');

-- --------------------------------------------------------

--
-- Table structure for table `phan`
--

CREATE TABLE `phan` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten_phan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `phan`
--

INSERT INTO `phan` (`id`, `ten_phan`) VALUES
(1, 'Part 1: Photos'),
(2, 'Part 2: Question - Response'),
(3, 'Part 3: Conversations'),
(4, 'Part 4: Short talks'),
(5, 'Part 5: Imcomplete sentences'),
(6, 'Part 6: Text completion'),
(7, 'Part 7: Reading comprehension');

-- --------------------------------------------------------

--
-- Table structure for table `phuong_an`
--

CREATE TABLE `phuong_an` (
  `id` int(10) UNSIGNED NOT NULL,
  `dap_an_a` text DEFAULT NULL,
  `dap_an_b` text DEFAULT NULL,
  `dap_an_c` text DEFAULT NULL,
  `dap_an_d` text DEFAULT NULL,
  `dap_an_dung` char(1) NOT NULL,
  `giai_thich` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `phuong_an`
--

INSERT INTO `phuong_an` (`id`, `dap_an_a`, `dap_an_b`, `dap_an_c`, `dap_an_d`, `dap_an_dung`, `giai_thich`) VALUES
(1, 'A', 'B', 'C', 'D', 'B', 'Bản dịch: \r\n(A) Người phụ nữ đang nói chuyện điện thoại. \r\n(B) Người phụ nữ đang sử dụng điện thoại di động. \r\n(C) Người phụ nữ đang đánh máy tính. \r\n(D) Người phụ nữ đang viết vào sổ tay. '),
(2, 'A', 'B', 'C', 'D', 'A', 'Transcript:\r\n(A) The woman is cooking some bacon.\r\n(B) The woman is baking a cake.\r\n(C) The woman is preparing for dinner.\r\n(D) The woman is frying some fish.'),
(3, 'A', 'B', 'C', 'D', 'A', 'Transcript:\r\n(A) The man is holding some seafood.\r\n(B) The woman is baking a crab.\r\n(C) They are scared of the crab.\r\n(D) The family is shopping for breakfast.'),
(4, 'A', 'B', 'C', 'D', 'B', 'Transcript:\r\n(A) The man is using a screwdriver to screw a nail into the building frame.\r\n(B) The man is hammering something into a building frame.\r\n(C) The man is making the frame with his hand.\r\n(D) The man is wearing protective glasses.'),
(5, 'A', 'B', 'C', '', 'C', 'Bản dịch: \r\nTôi rất ấn tượng với giọng hát của Alex.\r\n(A) Tôi quên tên ca sĩ.\r\n(B) Buổi hòa nhạc ở đâu?\r\n(C) Vâng, anh ấy có một giọng hát tuyệt vời.'),
(6, 'A', 'B', 'C', '', 'B', 'Bản dịch: \r\nBạn đã cân nhắc việc xây dựng một hàng rào chưa?\r\n(A) Ngôi nhà đang được rao bán.\r\n(B) Vâng, chúng ta sẽ làm điều đó sau. \r\n(C) Nhận xét của anh ta gây ra sự xúc phạm.'),
(7, 'A', 'B', 'C', '', 'A', 'Bản dịch: \r\nTại sao tối nay tàu điện ngầm ngừng chạy sớm?\r\n(A) Bởi vì đó là ngày nghỉ lễ.\r\n(B) Hãy xuống ở ga tiếp theo.\r\n(C) Không, ngày mai tôi sẽ không chạy.'),
(8, 'A', 'B', 'C', '', 'A', 'Bản dịch: \r\nBạn muốn làm việc cùng nhau hay riêng biệt?\r\n(A) Thực ra, tôi thích làm việc một mình hơn.\r\n(B) Hãy thu thập dữ liệu của công ty.\r\n(C) Trước hôm thứ Sáu tới.'),
(9, '(A) A shop owner', '(B) A construction worker', '(C) A local resident', '(D) A market researcher', 'D', ' Transcript:\r\nM: Excuse me. Q1 I’m conducting research on the effect that the new downtown mall is having on local residents’ shopping habits. Do you have a moment to talk to me?\r\nW: Sure, no problem. I can tell you that since the mall was built, I find myself coming downtown a lot more. Q2 I think what I like most is that I never have to struggle to find a parking spot.\r\nM: I see. What about the variety of shops? Are you satisfied with that?\r\nW: Q3 Well, I usually come to the mall to shop for clothes. I think there is a wide selection of women’s clothes.\r\n'),
(10, '(A) It was recently renovated', '(B) It has sufficient parking space. ', '(C) It is attracting many tourists.', ' (D) It is located outside of town. ', 'B', ' Transcript:\r\nM: Excuse me. Q1 I’m conducting research on the effect that the new downtown mall is having on local residents’ shopping habits. Do you have a moment to talk to me?\r\nW: Sure, no problem. I can tell you that since the mall was built, I find myself coming downtown a lot more. Q2 I think what I like most is that I never have to struggle to find a parking spot.\r\nM: I see. What about the variety of shops? Are you satisfied with that?\r\nW: Q3 Well, I usually come to the mall to shop for clothes. I think there is a wide selection of women’s clothes.\r\n'),
(11, '(A) To purchase groceries', '(B) To meet with her clients', '(C) To buy clothing', '(D) To deliver products', 'C', ' Transcript:\r\nM: Excuse me. Q1 I’m conducting research on the effect that the new downtown mall is having on local residents’ shopping habits. Do you have a moment to talk to me?\r\nW: Sure, no problem. I can tell you that since the mall was built, I find myself coming downtown a lot more. Q2 I think what I like most is that I never have to struggle to find a parking spot.\r\nM: I see. What about the variety of shops? Are you satisfied with that?\r\nW: Q3 Well, I usually come to the mall to shop for clothes. I think there is a wide selection of women’s clothes.\r\n'),
(12, '(A) To get an upgrade', '(B) To book a flight to Korea and Japan', '(C) To cancel her flight to Singapore', '(D) To sign up for a mileage card', 'A', ' Transcript:\r\nW: Hi, this is Rachel. Q1 I’m calling to see if I can upgrade from coach to business for my flight to Thailand this June.\r\nM: OK, can I have your membership number please?\r\nW: Yes, it’s EM3985771.\r\nM: Q3 I’m sorry. You don’t have enough points for this trip. However, I see that you’re traveling to Korea and Japan next week. That should give you enough points to upgrade in June. Why don’t you call again after your trip?\r\nW: OK, that’s a great idea. I’ll call again in two weeks.\r\n'),
(13, '(A) 50,000', '(B) 60,000', '(C) 70,000', '(D) 80,000', 'B', 'Transcript:\r\nW: Hi, this is Rachel. Q1 I’m calling to see if I can upgrade from coach to business for my flight to Thailand this June.\r\nM: OK, can I have your membership number please?\r\nW: Yes, it’s EM3985771.\r\nM: Q3 I’m sorry. You don’t have enough points for this trip. However, I see that you’re traveling to Korea and Japan next week. That should give you enough points to upgrade in June. Why don’t you call again after your trip?\r\nW: OK, that’s a great idea. I’ll call again in two weeks.\r\n'),
(14, '(A) Upgrade her Korean flight', '(B) Make the request after her trip', '(C) Book a different flight', '(D) Cancel her reservation', 'B', 'Transcript:\r\nW: Hi, this is Rachel. Q1 I’m calling to see if I can upgrade from coach to business for my flight to Thailand this June.\r\nM: OK, can I have your membership number please?\r\nW: Yes, it’s EM3985771.\r\nM: Q3 I’m sorry. You don’t have enough points for this trip. However, I see that you’re traveling to Korea and Japan next week. That should give you enough points to upgrade in June. Why don’t you call again after your trip?\r\nW: OK, that’s a great idea. I’ll call again in two weeks.\r\n'),
(15, '(A) A training seminar', '(B) The installation of a television', '(C) The date of a presentation', '(D) A software upgrade', 'B', 'Transcript:\r\nM: Hello, I’m Steven from Home Appliance Mart. Q1 I’m here to install the UHD television that you ordered last week.\r\nW: Yes, come right this way. We would like to mount the television on this wall. We plan to use it for presentations and training seminars.\r\nM: Oh, no. Q2 It looks like I forgot the tools that I need to screw the television to the wall mount. I’m sorry. I’ll have to come back tomorrow morning.\r\nW: Oh, that’s all right. Q3 However, please call me before you come tomorrow to make sure that someone is in the office to meet you.'),
(16, '(A) The necessary tools are unavailable.', '(B) The office is closed.', '(C) The wall is too weak.', '(D) The phone number was wrong.', 'A', ' Transcript:\r\nM: Hello, I’m Steven from Home Appliance Mart. Q1 I’m here to install the UHD television that you ordered last week.\r\nW: Yes, come right this way. We would like to mount the television on this wall. We plan to use it for presentations and training seminars.\r\nM: Oh, no. Q2 It looks like I forgot the tools that I need to screw the television to the wall mount. I’m sorry. I’ll have to come back tomorrow morning.\r\nW: Oh, that’s all right. Q3 However, please call me before you come tomorrow to make sure that someone is in the office to meet you.\r\n'),
(17, '(A) Order a replacement part', '(B) Consult an instruction manual', '(C) Contact the woman', '(D) Fill out a work order', 'C', ' Transcript:\r\nM: Hello, I’m Steven from Home Appliance Mart. Q1 I’m here to install the UHD television that you ordered last week.\r\nW: Yes, come right this way. We would like to mount the television on this wall. We plan to use it for presentations and training seminars.\r\nM: Oh, no. Q2 It looks like I forgot the tools that I need to screw the television to the wall mount. I’m sorry. I’ll have to come back tomorrow morning.\r\nW: Oh, that’s all right. Q3 However, please call me before you come tomorrow to make sure that someone is in the office to meet you.\r\n'),
(18, '(A)  A scholar', '(B) A producer', '(C) A pilot', '(D) A programmer', 'B', 'Good morning, everyone. Q1 Welcome to a test screening of our pilot for a new daytime sitcom entitled Once Upon a Romance. Your participation in this focus group is essential for assessing audience reception. Q2 This television show is meant to appeal to middle- aged housewives, and that is why you have all been selected. Q3 After watching the pilot, we will take you to a meeting room where we will conduct an in-depth interview that will help us gather your feedback and responses. Thank you again for your cooperation.'),
(19, '(A)  Potential investors', '(B) Actors', '(C) Housewives', '(D) University students', 'C', ' Good morning, everyone. Q1 Welcome to a test screening of our pilot for a new daytime sitcom entitled Once Upon a Romance. Your participation in this focus group is essential for assessing audience reception. Q2 This television show is meant to appeal to middle- aged housewives, and that is why you have all been selected. Q3 After watching the pilot, we will take you to a meeting room where we will conduct an in-depth interview that will help us gather your feedback and responses. Thank you again for your cooperation.'),
(20, '(A)  Participate in a raffle', '(B) Watch a video', '(C) Enroll in a class', 'D', 'D', 'Good morning, everyone. Q1 Welcome to a test screening of our pilot for a new daytime sitcom entitled Once Upon a Romance. Your participation in this focus group is essential for assessing audience reception. Q2 This television show is meant to appeal to middle- aged housewives, and that is why you have all been selected. Q3 After watching the pilot, we will take you to a meeting room where we will conduct an in-depth interview that will help us gather your feedback and responses. Thank you again for your cooperation'),
(21, '(A)  Office tables and chairs', '(B) Chairs and drafting tables', '(C) Whiteboards and office chairs', '(D) Chairs and whiteboard', 'C', 'Hi, Susan. I’m calling about the office furniture we delivered to Harmons & Sons recently. They said their first floor looks really good but they are going to need twenty chairs and twelve whiteboards for their boardrooms upstairs. They recently merged with another company so I think they will have a lot more staff in their building soon. Make sure you check what we have in the warehouse; if we are missing anything, we need to order it today. Also, before you send the order, please have me sign off on it. As the manager, I need to sign all outgoing orders before they leave the office. Please let me know when you have the order prepared.'),
(22, '(A)  They won’t need any more furniture.', '(B) They will have more staff in their building.', '(C) The boardrooms will be renovated.', '(D) Their staff are moving offices.', 'B', 'Hi, Susan. I’m calling about the office furniture we delivered to Harmons & Sons recently. They said their first floor looks really good but they are going to need twenty chairs and twelve whiteboards for their boardrooms upstairs. They recently merged with another company so I think they will have a lot more staff in their building soon. Make sure you check what we have in the warehouse; if we are missing anything, we need to order it today. Also, before you send the order, please have me sign off on it. As the manager, I need to sign all outgoing orders before they leave the office. Please let me know when you have the order prepared.'),
(23, '(A)  Sign them herself ', '(B) Make sure the manager signs them', '(C) Bring some extra paper', '(D) Prepare a delivery receipt', 'B', 'Hi, Susan. I’m calling about the office furniture we delivered to Harmons & Sons recently. They said their first floor looks really good but they are going to need twenty chairs and twelve whiteboards for their boardrooms upstairs. They recently merged with another company so I think they will have a lot more staff in their building soon. Make sure you check what we have in the warehouse; if we are missing anything, we need to order it today. Also, before you send the order, please have me sign off on it. As the manager, I need to sign all outgoing orders before they leave the office. Please let me know when you have the order prepared.'),
(24, '(A)  They have merged with another company', '(B) They are manufacturing a new product.', '(C) They are creating new policies.', '(D) They had record profits.', 'A', 'As I’m sure everyone is aware, Q1 we have recently merged with another company that is located in India. Now that we have become an international corporation, Q3 we will be sending a lot of our most vital data through unsecure email systems. According to the IT department, this is unavoidable. Unfortunately, this means we have to be very careful with what data we send through e-mail. This afternoon, everyone must attend a seminar explaining the new procedures for what data can be sent via e-mail. The rest will be sent using secure air mail. If you don’t come to the meeting then I will have to explain the same thing over and over again and Q2 my schedule is too tight to do that. So, everyone should come to the 1st floor meeting room at 2:30 P.M. '),
(25, '(A)  Because the email is secure.', '(B) To sign a new contract', '(C) She needs some help.', '(D) She doesn’t have time to do it.', 'D', ' As I’m sure everyone is aware, Q1 we have recently merged with another company that is located in India. Now that we have become an international corporation, Q3 we will be sending a lot of our most vital data through unsecure email systems. According to the IT department, this is unavoidable. Unfortunately, this means we have to be very careful with what data we send through e-mail. This afternoon, everyone must attend a seminar explaining the new procedures for what data can be sent via e-mail. The rest will be sent using secure air mail. If you don’t come to the meeting then I will have to explain the same thing over and over again and Q2 my schedule is too tight to do that. So, everyone should come to the 1st floor meeting room at 2:30 P.M. '),
(26, '(A)  Portfolios', '(B) Contract forms', '(C) Vital data', '(D) Building plans', 'C', ' As I’m sure everyone is aware, Q1 we have recently merged with another company that is located in India. Now that we have become an international corporation, Q3 we will be sending a lot of our most vital data through unsecure email systems. According to the IT department, this is unavoidable. Unfortunately, this means we have to be very careful with what data we send through e-mail. This afternoon, everyone must attend a seminar explaining the new procedures for what data can be sent via e-mail. The rest will be sent using secure air mail. If you don’t come to the meeting then I will have to explain the same thing over and over again and Q2 my schedule is too tight to do that. So, everyone should come to the 1st floor meeting room at 2:30 P.M. '),
(27, '(A) After', '(B) Until', '(C) Below', ' (D) Like', 'A', ' After: theo sau trong thời gian, không gian hoặc thứ tự\r\nUntil: cho đến (thời gian đó)\r\nBelow: ở vị trí thấp hơn (so với), dưới\r\nLike: tương tự như; theo cách hoặc phương pháp giống nhau như\r\n=> \"After\" có ý nghĩa phù hợp nhất\r\n=> Sau khi tái cấu trúc một số phòng ban trong công ty, phần lớn các vấn đề về giao tiếp sai đã biến mất.\r\n=> Chọn A\r\n'),
(28, '(A) relevance', '(B) relevantly', '(C) more relevantly', ' (D) relevant', 'D', ' Cấu trúc \"be relevant to\" - có liên quan đến những gì đang xảy ra hoặc đang được thảo luận\r\n=> Chọn đáp án D\r\n=> Các số liệu đi kèm báo cáo tài chính phải có liên quan đến hạng mục chi tiêu.\r\n'),
(29, '(A) cooperative', '(B) visible', '(C) essential', ' (D) alternative', 'C', ' cooperative: sẵn lòng giúp đỡ hoặc làm những gì người khác yêu cầu\r\nvisible: có thể nhìn thấy\r\nessential: cần thiết\r\nalternative: có thể thay thế được\r\n=> \"essential\" có nghĩa hợp lý nhất\r\n=> Việc thông gió thích hợp trong toàn bộ tòa nhà là điều cần thiết để bảo vệ sức khỏe và tinh thần của người lao động.\r\n=> Chọn C\r\n'),
(30, '(A) legal', '(B) legalize', '(C) legally', ' (D) legalizes', 'A', ' Chỗ trống đứng trước một danh từ nên thiếu một tính từ hoặc danh từ\r\n\"Legal\" là một tính từ\r\n=> Chọn A\r\n=> Bộ phận chính phủ trước đây cung cấp hỗ trợ tài chính, nhưng hiện nay chỉ cung cấp dịch vụ pháp lý.\r\n'),
(31, '(A) In spite of', '(B) Even if', '(C) Whether', ' (D) Given that', 'A', ' In spite of + danh từ = Although + mệnh đề: mặc dù => nghĩa phù hợp với câu\r\n(B) Even if + MĐ: dùng để nói rằng dù việc gì đó có đúng hay không thì kết quả cũng như nhau\r\n(C) Whether + MĐ: nếu, hay không\r\n(D) Given that + MĐ: Vì, bởi vì\r\n=> Mặc dù bị thương ở mắt cá chân, cầu thủ bóng chày vẫn tham gia trận đấu cuối cùng của mùa giải.\r\n=> Chọn đáp án A\r\n'),
(32, '(A) obstructs', '(B) obstructed', '(C) obstruction', ' (D) obstructing', 'D', ' Cấu trúc: Avoid + V-ing + N\r\n=> \"obstructing\" là đáp án đúng\r\n=> Choose D\r\n=> Để đảm bảo an toàn tối ưu trên đường, tránh che khuất tầm nhìn của cửa sổ sau và gương chiếu hậu.\r\n'),
(33, '(A) are bringing', '(B) have brought', '(C) bring', ' (D) are brought', 'D', ' Giải thích:\r\n(A) are bringing: Dạng hiện tại tiếp diễn không phù hợp vì nó biểu thị hành động đang xảy ra trong thời điểm hiện tại, không phải một hành động được lên kế hoạch sẽ xảy ra trong tương lai.\r\n(B) have brought: Dạng hiện tại hoàn thành không phù hợp vì nó biểu thị hành động đã xảy ra trong quá khứ và có liên quan đến hiện tại, không phù hợp với ngữ cảnh về các thiết bị sẽ được đưa vào trong tương lai.\r\n(C) bring: Dạng hiện tại đơn không phù hợp vì nó không thể diễn tả được hành động sẽ xảy ra trong tương lai trong ngữ cảnh này.\r\n(D) are brought: Dạng bị động của hiện tại đơn phù hợp vì nó chỉ ra rằng các thiết bị mới sẽ được đưa vào (bởi một tác nhân không xác định) trong quá trình cải tạo\r\nĐáp án đúng là (D) are brought.\r\n'),
(34, '(A) This will take a lot of work.', '(B) As a result, the convenience shops will be closed.', '(C) Because of this, hot meals will not be available for the patrons.', ' (D) There will be noise and chaos as a result.', 'C', ' Tạm dịch: (2)____ Thay vào đó, các cửa hàng tiện lợi sẽ cung cấp thêm nhiều loại sandwich, hộp cơm chuẩn bị sẵn, và đồ ăn nhẹ cho nhân viên trong thời gian này.\r\n(A) Điều này sẽ mất nhiều công sức.\r\n(B) Kết quả là, các cửa hàng tiện lợi sẽ đóng cửa.\r\n(C) Do đó, các bữa ăn nóng sẽ không có sẵn cho khách hàng.\r\n(D) Sẽ có tiếng ồn và hỗn loạn như là kết quả.\r\nDựa vào ngữ cảnh của câu , chọn đáp án C\r\n'),
(35, '(A) before', '(B) after', '(C) during', ' (D) within', 'C', ' Giải thích:\r\n(A) before: \"before\" không phù hợp vì nó chỉ thời gian trước khi các giờ cao điểm diễn ra, không phản ánh mục đích của việc cải tạo để phục vụ trong các giờ cao điểm.\r\n(B) after: \"after\" không phù hợp vì nó chỉ thời gian sau các giờ cao điểm, không liên quan đến việc cung cấp bữa ăn trong các giờ đó.\r\n(C) during: \"during\" là lựa chọn phù hợp vì nó chỉ ra rằng các bữa ăn sẽ được cung cấp trong suốt thời gian các giờ cao điểm buổi trưa và buổi tối.\r\n(D) within: \"within\" không phù hợp vì nó chỉ ra một khoảng thời gian không chính xác trong ngữ cảnh này.\r\nĐáp án đúng là (C) during.\r\n'),
(36, '(A) develop', '(B) improve', '(C) rectify', ' (D) recover', 'C', ' Giải thích:\r\n(A) develop: \"develop\" có nghĩa là phát triển, không hoàn toàn phù hợp trong ngữ cảnh này vì nó không nhấn mạnh việc làm cho dịch vụ trở nên tốt hơn.\r\n(B) improve: \"improve\" có nghĩa là cải thiện, phù hợp trong ngữ cảnh vì nó chỉ việc làm cho dịch vụ tốt hơn.\r\n(C) rectify: \"rectify\" có nghĩa là sửa chữa, thường được dùng khi cần khắc phục lỗi cụ thể, không hoàn toàn phù hợp vì không nhất thiết có lỗi trong dịch vụ cần phải được sửa chữa.\r\n(D) recover: \"recover\" có nghĩa là hồi phục, không phù hợp trong ngữ cảnh này vì nó không liên quan đến việc nâng cao chất lượng dịch vụ.\r\nĐáp án đúng là (B) improve.\r\n'),
(37, '(A) durably', '(B) durability', '(C) durabled', ' (D) durable', 'B', ' Vị trí cần điền một danh từ mô tả đặc tính của sản phẩm để đi cùng với danh từ \"strength\", nên chọn đáp án (B) durability\r\nTạm dịch: Sản phẩm của chúng tôi được biết đến với các họa tiết và sự kết hợp màu sắc hiện đại và độc đáo, cũng như độ bền và độ chắc chắn\r\n'),
(38, '(A) Larson’s utensils and silverware go great with the dinnerware.', '(B) Our most popular line, the Spring Flower China is sold out at most locations,', '(C) Visit our store to check out our other beautiful products.', ' (D) They are dishwasher- and microwave-safe and we’re confident that you’ll be using them for years to come.', 'D', ' Tạm dịch: (2) Tuy nhiên, xin lưu ý rằng việc rơi vỡ và xử lý thô bạo nhiều lần sẽ _____ việc hỏng hóc cuối cùng\r\n(A) Bộ dụng cụ và dao nĩa của Larson rất hợp với bộ đồ ăn.\r\n(B) Dòng sản phẩm phổ biến nhất của chúng tôi, Spring Flower China, đã hết hàng tại hầu hết các địa điểm.\r\n(C) Hãy ghé thăm cửa hàng của chúng tôi để xem các sản phẩm đẹp khác.\r\n(D) Chúng có thể dùng trong máy rửa chén và lò vi sóng, và chúng tôi tự tin rằng bạn sẽ sử dụng chúng trong nhiều năm tới.\r\nDựa vào ngữ cảnh của câu, chọn đáp án D\r\n'),
(39, '(A) result in', '(B) occur to', '(C) ending at', ' (D) stop with', 'A', ' Kiến thức từ vựng: \r\n(A) result in - dẫn đến\r\n(B) occur to - xảy ra với\r\n(C) ending at - kết thúc tại\r\n(D) stop with - dừng lại với\r\nTạm dịch: Xin lưu ý, tuy nhiên, rằng việc rơi vỡ và xử lý thô bạo nhiều lần sẽ dẫn đến hỏng hóc cuối cùng.\r\nDựa vào ngữ cảnh câu, chọn đáp án A\r\n'),
(40, '(A) ambitious', '(B) combative', '(C) aggressive', ' (D) complacent', 'C', ' Kiến thức từ vựng: \r\n(A) ambitious - tham vọng\r\n(B) combative - hiếu chiến\r\n(C) aggressive - hung hăng\r\n(D) complacent - tự mãn\r\nTạm dịch: Chúng tôi khuyên bạn nên bảo quản chúng cẩn thận và không sử dụng các hóa chất mạnh, miếng bọt biển bằng thép, hoặc chà xát mạnh khi làm sạch chúng.\r\nDựa vào ngữ cảnh của câu, chọn đáp án C\r\n'),
(41, '(A) seek', '(B) to seek', '(C) seeking', ' (D) are seeking', 'C', ' Đây là câu mệnh đề rút gọn. Câu đầy đủ là \"I recently came across your advertisement which sought partnership of a graphic company for a number of your projects.\"\nTạm dịch: Gần đây, tôi đã thấy quảng cáo của quý công ty, trong đó tìm kiếm sự hợp tác với một công ty thiết kế đồ họa cho một số dự án của quý công ty\n'),
(42, '(A) extensive', '(B) restricted', '(C) generous', ' (D) limitless', 'A', ' Kiến thức từ vựng:\r\n(A) extensive: phong phú, nhiều\r\n(B) restricted: bị hạn chế\r\n(C) generous: hào phóng\r\n(D) limitless: không giới hạn\r\nDựa theo ngữ cảnh câu, chọn đáp án A.\r\nTạm dịch: BiggsGraphics có nhiều kinh nghiệm làm việc với các doanh nghiệp nhỏ và các công ty trong việc thiết kế các chiến dịch quảng cáo, logo và trang web.\r\n'),
(43, '(A) I would really appreciate the opportunity to work with you.', '(B) I heard that Digital lT is a great company.', '(C) In fact, our designs are often copied by other companies.', ' (D) I have attached a number of our past designs to illustrate what we specialize in.', 'D', ' Tạm dịch: (3)____ Trang web của chúng tôi www.biggs-graphics.com cũng có thông tin về công ty của chúng tôi.\r\n(A) Tôi rất trân trọng cơ hội được làm việc với quý công ty.\r\n(B) Tôi đã nghe rằng Digital IT là một công ty tuyệt vời.\r\n(C) Thực tế, các thiết kế của chúng tôi thường bị các công ty khác sao chép.\r\n(D) Tôi đã đính kèm một số thiết kế trước đây của chúng tôi để minh họa những gì chúng tôi chuyên về.\r\nDựa vào ngữ cảnh câu, chọn đáp án D.\r\n'),
(44, '(A) at', '(B) to', '(C) with', ' (D) from', 'B', ' Cấu trúc: look forward to something/ Ving\r\nTạm dịch: Tôi mong chờ phản hồi từ quý công ty.\r\n'),
(45, '(A) It is very successful.', '(B) It only offers take-out.', '(C) It has been open for a longtime.', ' (D) Only fitness experts patron the shop.', 'A', 'Tạm dịch:\r\nCó gợi ý gì về cửa hàng?\r\n(A) Nó rất thành công.\r\n(B) Nó chỉ phục vụ đồ mang đi.\r\n(C) Nó đã mở cửa trong một thời gian dài.\r\n(D) Chỉ có các chuyên gia thể hình mới lui tới cửa hàng.\r\nThông tin:\r\nNó có thể được suy ra từ \"Việc tìm được chỗ ngồi hoặc bàn ở Health Shack có thể mất tới 30 phút vào một ngày đẹp trời và nơi này luôn đông đúc bất kể thời điểm nào trong ngày.\"  rằng cửa hàng luôn đông đúc và phải mất nhiều thời gian mới có được chỗ ngồi.\r\n=> Chọn đáp án A\r\n'),
(46, '(A) They are very delicious.', '(B) They are healthy.', '(C) They are cheap.', ' (D) They are easy to get.', 'B', 'Tạm dịch:\r\nCó gợi ý gì về sản phẩm của Health Shack?\r\n(A) Chúng rất ngon.\r\n(B) Chúng lành mạnh.\r\n(C) Chúng rẻ.\r\n(D) Chúng dễ kiếm.\r\nThông tin:\r\nDựa trên đánh giá của khách hàng về sản phẩm bữa ăn lành mạnh nhưng no bụng trong thời gian nghỉ ngắn ngày của tôi cùng đồng nghiệp\r\n=> Chọn đáp án B\r\n'),
(47, '(A) They don’t have enough money.', '(B) They are too busy.', '(C) Their customers recommend the place to others.', ' (D) They don’t want to.', 'C', 'Tạm dịch:\r\nTại sao chủ sở hữu không quảng cáo?\r\n(A) Họ không có đủ tiền.\r\n(B) Họ quá bận rộn.\r\n(C) Khách hàng của họ giới thiệu địa điểm này cho người khác\r\n(D) Họ không muốn.\r\nThông tin:\r\nThông tin có thể được suy ra từ: \"Chúng tôi đã bị choáng ngợp trước câu trả lời,\" Jill Baker nói.\r\n=> Chọn đáp án C\r\n'),
(48, '(A) [1]', '(B) [2]', '(C) [3]', ' (D) [4]', 'B', 'Tạm dịch:\r\nCâu sau đây thuộc vị trí nào trong các vị trí được đánh dấu [1], [2], [3] và [4]?\r\n“Mặc dù số lượng sản phẩm trong thực đơn có hạn, nhưng khách hàng không thể bỏ qua các loại sinh tố ngon nhưng lành mạnh được cung cấp.”\r\n(A) [1]\r\n(B) [2]\r\n(C) [3]\r\n(D) [4]\r\nThông tin:\r\nDựa vào thông tin trong Dựa vào thông tin trong “Health Shack chỉ cung cấp sáu món trong thực đơn của mình; tất cả đều là sữa lắc protein bao gồm các sản phẩm bán chạy nhất, Apple Pie, Peanut Butter Cup và Tuity Fruity.c”, có thể suy ra số lượng món trên thực đơn có giới hạn.\r\n=> Chọn đáp án B\r\n'),
(49, '(A) To introduce a new employee', '(B) To report on an award winner', '(C) To announce an annual competition', ' (D) To describe a change in company policy.', 'B', 'Tạm dịch:\r\nTại sao bài viết này có khả năng được viết nhiều nhất?\r\n(A) Để giới thiệu một nhân viên mới\r\n(B) Để báo cáo về người chiến thắng giải thưởng\r\n(C) Để công bố một cuộc thi thường niên\r\n(D) Để mô tả sự thay đổi trong chính sách của công ty\r\nThông tin:\r\nThông tin có thể được suy ra từ:\"Một trong những nhân viên của chúng tôi tại Arrow Design Laboratory, Jennifer Holt, đã giành giải nhất trong cuộc thi thiết kế web do Hiệp hội các nhà thiết kế web tổ chức.\"\r\n=> Chọn đáp án B\r\n'),
(50, '(A) discovered', '(B) learned', '(C) established', ' (D) equipped', 'C', 'Tạm dịch:\r\nTừ “founded” trong đoạn 2, dòng 1, gần nghĩa nhất với:\r\n(A) phát hiện\r\n(B) học được\r\n(C) thành lập\r\n(D) trang bị\r\nThông tin:\r\nfounded là hình thức quá khứ của found (để bắt đầu một cái gì đó, chẳng hạn như một tổ chức hoặc một cơ quan, đặc biệt là bằng cách cung cấp tiền) có cùng ý nghĩa với establish.\r\n=> Chọn đáp án C\r\n'),
(51, '(A) It holds a conference every year.', '(B) It is based in Los Angeles.', '(C) It currently offers free membership.', ' (D) It donates to community projects.', 'A', 'Tạm dịch:\r\nĐiều gì được gợi ý về Hiệp hội các nhà thiết kế web?\r\n(A) Hiệp hội tổ chức hội nghị hàng năm.\r\n(B) Hiệp hội có trụ sở tại Los Angeles.\r\n(C) Hiện tại, hiệp hội cung cấp tư cách thành viên miễn phí.\r\n(D) Hiệp hội quyên góp cho các dự án cộng đồng.\r\nThông tin:\r\nCó thể suy ra từ \"...cô ấy đã được mời đến phát biểu tại Hội nghị thường niên của các nhà thiết kế web\" rằng hàng năm sẽ diễn ra hoặc thực hiện mỗi năm một lần.\r\n=> Chọn đáp án A\r\n'),
(52, '(A) A transcript of a speech.', '(B) An application for an open position.', '(C) Details about upcoming contests.', ' (D) A list of Ms. Holt’s accomplishments.', 'C', 'Tạm dịch:\r\nTheo bài viết, có thể tìm thấy những gì trên trang web?\r\n(A) Bản ghi chép bài phát biểu\r\n(B) Đơn xin việc cho một vị trí tuyển dụng\r\n(C) Chi tiết về các cuộc thi sắp tới\r\n(D) Danh sách các thành tích của cô Holt\r\nThông tin:\r\nAWD sẽ tổ chức nhiều cuộc thi hơn trong tương lai và những ai quan tâm nên truy cập trang web www.awd.com/contests để tìm hiểu thêm thông tin.\r\n=> Chọn đáp án C\r\n'),
(53, '(A) It is a literary journal.', '(B) It includes a recipe book as a supplement.', '(C) It provides travel advice.', ' (D) It has an online version.', 'C', ''),
(54, '(A) It is sponsored by professional photographers.', '(B) It awards a complimentary vacation to the winner.', '(C) It accepts digital photos only.', ' (D) It features photos of Scotland', 'B', '');

-- --------------------------------------------------------

--
-- Table structure for table `tai_lieu`
--

CREATE TABLE `tai_lieu` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten_tai_lieu` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audio`
--
ALTER TABLE `audio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bai_hoc`
--
ALTER TABLE `bai_hoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `khoa_hoc_id` (`khoa_hoc_id`),
  ADD KEY `tai_lieu_id` (`tai_lieu_id`);

--
-- Indexes for table `bai_kiem_tra`
--
ALTER TABLE `bai_kiem_tra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `khoa_hoc_id` (`khoa_hoc_id`);

--
-- Indexes for table `co_cau_hoi_doc`
--
ALTER TABLE `co_cau_hoi_doc`
  ADD PRIMARY KEY (`bai_kiem_tra_id`,`ngan_hang_chd_id`),
  ADD KEY `ngan_hang_chd_id` (`ngan_hang_chd_id`);

--
-- Indexes for table `co_cau_hoi_nghe`
--
ALTER TABLE `co_cau_hoi_nghe`
  ADD PRIMARY KEY (`bai_kiem_tra_id`,`ngan_hang_chn_id`),
  ADD KEY `ngan_hang_chn_id` (`ngan_hang_chn_id`);

--
-- Indexes for table `dang_ky_khoa_hoc`
--
ALTER TABLE `dang_ky_khoa_hoc`
  ADD PRIMARY KEY (`nguoi_dung_id`,`khoa_hoc_id`),
  ADD KEY `khoa_hoc_id` (`khoa_hoc_id`);

--
-- Indexes for table `dat_cau_hoi`
--
ALTER TABLE `dat_cau_hoi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `khoa_hoc_id` (`khoa_hoc_id`),
  ADD KEY `nguoi_dung_id` (`nguoi_dung_id`);

--
-- Indexes for table `diem_bkt`
--
ALTER TABLE `diem_bkt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bai_kiem_tra_id` (`bai_kiem_tra_id`),
  ADD KEY `nguoi_dung_id` (`nguoi_dung_id`),
  ADD KEY `phan_id` (`phan_id`);

--
-- Indexes for table `doan_van`
--
ALTER TABLE `doan_van`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khoa_hoc`
--
ALTER TABLE `khoa_hoc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ngan_hang_chd`
--
ALTER TABLE `ngan_hang_chd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phan_id` (`phan_id`),
  ADD KEY `doan_van_id` (`doan_van_id`),
  ADD KEY `phuong_an_id` (`phuong_an_id`);

--
-- Indexes for table `ngan_hang_chn`
--
ALTER TABLE `ngan_hang_chn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phan_id` (`phan_id`),
  ADD KEY `audio_id` (`audio_id`),
  ADD KEY `phuong_an_id` (`phuong_an_id`);

--
-- Indexes for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tai_khoan` (`tai_khoan`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `sdt` (`sdt`);

--
-- Indexes for table `phan`
--
ALTER TABLE `phan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phuong_an`
--
ALTER TABLE `phuong_an`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tai_lieu`
--
ALTER TABLE `tai_lieu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audio`
--
ALTER TABLE `audio`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `bai_hoc`
--
ALTER TABLE `bai_hoc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bai_kiem_tra`
--
ALTER TABLE `bai_kiem_tra`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dat_cau_hoi`
--
ALTER TABLE `dat_cau_hoi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diem_bkt`
--
ALTER TABLE `diem_bkt`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doan_van`
--
ALTER TABLE `doan_van`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `khoa_hoc`
--
ALTER TABLE `khoa_hoc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ngan_hang_chd`
--
ALTER TABLE `ngan_hang_chd`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `ngan_hang_chn`
--
ALTER TABLE `ngan_hang_chn`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `phan`
--
ALTER TABLE `phan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `phuong_an`
--
ALTER TABLE `phuong_an`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tai_lieu`
--
ALTER TABLE `tai_lieu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bai_hoc`
--
ALTER TABLE `bai_hoc`
  ADD CONSTRAINT `bai_hoc_ibfk_1` FOREIGN KEY (`khoa_hoc_id`) REFERENCES `khoa_hoc` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bai_hoc_ibfk_2` FOREIGN KEY (`tai_lieu_id`) REFERENCES `tai_lieu` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bai_kiem_tra`
--
ALTER TABLE `bai_kiem_tra`
  ADD CONSTRAINT `bai_kiem_tra_ibfk_1` FOREIGN KEY (`khoa_hoc_id`) REFERENCES `khoa_hoc` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `co_cau_hoi_doc`
--
ALTER TABLE `co_cau_hoi_doc`
  ADD CONSTRAINT `co_cau_hoi_doc_ibfk_1` FOREIGN KEY (`bai_kiem_tra_id`) REFERENCES `bai_kiem_tra` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `co_cau_hoi_doc_ibfk_2` FOREIGN KEY (`ngan_hang_chd_id`) REFERENCES `ngan_hang_chd` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `co_cau_hoi_nghe`
--
ALTER TABLE `co_cau_hoi_nghe`
  ADD CONSTRAINT `co_cau_hoi_nghe_ibfk_1` FOREIGN KEY (`bai_kiem_tra_id`) REFERENCES `bai_kiem_tra` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `co_cau_hoi_nghe_ibfk_2` FOREIGN KEY (`ngan_hang_chn_id`) REFERENCES `ngan_hang_chn` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dang_ky_khoa_hoc`
--
ALTER TABLE `dang_ky_khoa_hoc`
  ADD CONSTRAINT `dang_ky_khoa_hoc_ibfk_1` FOREIGN KEY (`nguoi_dung_id`) REFERENCES `nguoi_dung` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dang_ky_khoa_hoc_ibfk_2` FOREIGN KEY (`khoa_hoc_id`) REFERENCES `khoa_hoc` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dat_cau_hoi`
--
ALTER TABLE `dat_cau_hoi`
  ADD CONSTRAINT `dat_cau_hoi_ibfk_1` FOREIGN KEY (`khoa_hoc_id`) REFERENCES `khoa_hoc` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dat_cau_hoi_ibfk_2` FOREIGN KEY (`nguoi_dung_id`) REFERENCES `nguoi_dung` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `diem_bkt`
--
ALTER TABLE `diem_bkt`
  ADD CONSTRAINT `diem_bkt_ibfk_1` FOREIGN KEY (`bai_kiem_tra_id`) REFERENCES `bai_kiem_tra` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `diem_bkt_ibfk_2` FOREIGN KEY (`nguoi_dung_id`) REFERENCES `nguoi_dung` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `diem_bkt_ibfk_3` FOREIGN KEY (`phan_id`) REFERENCES `phan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ngan_hang_chd`
--
ALTER TABLE `ngan_hang_chd`
  ADD CONSTRAINT `ngan_hang_chd_ibfk_1` FOREIGN KEY (`phan_id`) REFERENCES `phan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ngan_hang_chd_ibfk_2` FOREIGN KEY (`doan_van_id`) REFERENCES `doan_van` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ngan_hang_chd_ibfk_3` FOREIGN KEY (`phuong_an_id`) REFERENCES `phuong_an` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ngan_hang_chn`
--
ALTER TABLE `ngan_hang_chn`
  ADD CONSTRAINT `ngan_hang_chn_ibfk_1` FOREIGN KEY (`phan_id`) REFERENCES `phan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ngan_hang_chn_ibfk_2` FOREIGN KEY (`audio_id`) REFERENCES `audio` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ngan_hang_chn_ibfk_3` FOREIGN KEY (`phuong_an_id`) REFERENCES `phuong_an` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
