-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2024 at 04:13 PM
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
-- Database: `hostelweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`sr_no`, `admin_name`, `admin_pass`) VALUES
(1, 'hostel', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `banguet`
--

CREATE TABLE `banguet` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banguet`
--

INSERT INTO `banguet` (`id`, `image`, `name`, `description`) VALUES
(3, 'IMG_70840.png', 'THEATER TYPE', 'In this type of setup, rows of rectangle meeting tables or banquet tables with skirting and banquet chairs are facing a stage or screen. This style is ideal for events where attendees will be sitting and watching for an extended period.'),
(9, 'IMG_69154.png', 'BOARDROOM TYPE', 'It&#039;s referred to as the boardroom setup because it looks like all the standard boardrooms and conference rooms in corporate office spaces. If you have the space in your hotel, a boardroom setup in a smaller banquet hall is ideal as a standing de'),
(10, 'IMG_99683.png', 'U-SHAPE TYPE', 'U-shaped floor plans layout tables and seating to form a &quot;U&quot; toward the front of the room where the speaker will lead a discussion. U-shaped floor plans are good for smaller gatherings in rectangle-shaped rooms.'),
(11, 'IMG_90306.png', 'WEDDING STYLE', 'A banquet is a formal meal held for a large group of people. Banquets are typically held for special occasions like wedding receptions, recognition ceremonies, or large conferences. Many different banquet styles exist including buffet, reception, caf'),
(12, 'IMG_93068.png', 'HERRING BONE TYPE', 'This style is very similar to Classroom, however with a Herringbone seating arrangement, each consecutive row of chairs and tables are angled inwards. Positives: – All of the seats are angled inward towards the podium. – All of the seats are facing f'),
(13, 'IMG_87503.png', 'HOLLOW SQUARE TYPE', 'The hollow square layout is similar to the u-shape floor plan but simply closes off the fourth side to form a closed square or rectangle. It also has an open space in the middle of the table.');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn1` bigint(20) NOT NULL,
  `pn2` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `email`, `fb`, `iframe`) VALUES
(1, '3J8G MFC, Nasugbu, Batangas', 'https://maps.app.goo.gl/kdGkPGPSZvNGX2ur9', 908754767, '4355566', 'registrar.nasugbu@g.batstate-u.edu.ph', 'https://web.facebook.com', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d247691.37575470193!2d120.626131!3d14.066679!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd96a403666c7d:0x397173d7eb8f7cf9!2sBatangas State University, Nasugbu Campus!5e0!3m2!1sen!2sph!4v1725632299713!5m2!1sen!2sph');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
(12, 'IMG_73410.svg', 'TV', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est consequatur aspernatur minima, pariatur numquam assumenda ullam!'),
(13, 'IMG_43730.svg', 'WIFI', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est consequatur aspernatur minima, pariatur numquam assumenda ullam!'),
(15, 'IMG_41769.svg', 'AIrcon', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est consequatur aspernatur minima, pariatur numquam assumenda ullam!'),
(16, 'IMG_86161.svg', 'HEATER', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est consequatur aspernatur minima, pariatur numquam assumenda ullam!'),
(17, 'IMG_98819.svg', 'masssage', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est consequatur aspernatur minima, pariatur numquam assumenda ullam!'),
(18, 'IMG_85689.svg', 'fff', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est consequatur aspernatur minima, pariatur numquam assumenda ullam!'),
(19, 'IMG_73267.svg', 'rrrrr', 'mjkk');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(9, 'Balcony'),
(10, 'Bedroom'),
(16, 'Kitchen');

-- --------------------------------------------------------

--
-- Table structure for table `hostel`
--

CREATE TABLE `hostel` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hostel`
--

INSERT INTO `hostel` (`sr_no`, `image`) VALUES
(6, 'IMG_36905.png'),
(7, 'IMG_88715.png'),
(11, 'IMG_89818.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(350) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `description`, `status`, `removed`, `type_id`) VALUES
(17, 'Suite room', 44, 420, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus deleniti at libero quo. Aperiam incidunt', 1, 0, 8),
(18, 'Presidential room', 23, 2300, 12, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus deleniti at libero quo. Aperiam incidunt nostrum non commodi nam. Praesentium quis eius odit hic reprehenderit iste fugiat dignissimos voluptatum animi tenetur atque, modi volupt', 1, 0, 8),
(19, 'Conference room', 34, 3000, 60, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus deleniti at libero quo. Aperiam incidunt nostrum non commodi nam. Praesentium quis eius odit hic reprehenderit iste fugiat dignissimos voluptatum animi tenetur atque, modi volupt', 1, 0, 8),
(20, 'Dormitory', 23, 2300, 23, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus deleniti at libero quo. Aperiam incidunt nostrum non commodi nam. Praesentium quis eius odit hic reprehenderit iste fugiat dignissimos voluptatum animi tenetur atque, modi volupt', 1, 0, 8),
(21, 'Comfort room', 34, 44, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus deleniti at libero quo. Aperiam incidunt nostrum non commodi nam. Praesentium quis eius odit hic reprehenderit iste fugiat dignissimos voluptatum animi tenetur atque, modi volupt', 1, 0, 9),
(22, 'Rest room', 34, 34, 34, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus deleniti at libero quo. Aperiam incidunt nostrum non commodi nam. Praesentium quis eius odit hic reprehenderit iste fugiat dignissimos voluptatum animi tenetur atque, modi volupt', 1, 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_facilities`
--

INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(201, 19, 13),
(202, 20, 12),
(203, 20, 17),
(206, 18, 13),
(208, 21, 13),
(209, 22, 12),
(212, 17, 12),
(213, 17, 13);

-- --------------------------------------------------------

--
-- Table structure for table `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_features`
--

INSERT INTO `room_features` (`sr_no`, `room_id`, `features_id`) VALUES
(185, 19, 10),
(186, 20, 9),
(189, 18, 9),
(190, 18, 10),
(192, 21, 10),
(193, 22, 9),
(195, 17, 9);

-- --------------------------------------------------------

--
-- Table structure for table `room_image`
--

CREATE TABLE `room_image` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(250) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'BatStateU HOSTEL', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus deleniti at libero quo. Aperiam incidunt nostrum non commodi nam. Praesentium quis eius odit hic reprehenderit iste fugiat dignissimos voluptatum animi tenetur atque, modi volupt', 0);

-- --------------------------------------------------------

--
-- Table structure for table `team_details`
--

CREATE TABLE `team_details` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_details`
--

INSERT INTO `team_details` (`sr_no`, `name`, `picture`) VALUES
(9, 'Emmanuel Laparan', 'Team_member_67485.jpg'),
(16, 'Formal', 'Team_member_66209.png'),
(17, 'Barong', 'Team_member_70296.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `types_room`
--

CREATE TABLE `types_room` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `types_room`
--

INSERT INTO `types_room` (`id`, `image`, `name`, `description`) VALUES
(8, 'IMG_53125.png', 'Function Rooms', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus deleniti at libero quo. Aperiam incidunt nostrum non commodi nam. Praesentium quis eius odit hic reprehenderit iste fugiat dignissimos voluptatum animi tenetur atque, modi volupt'),
(9, 'IMG_87833.png', 'Guest Rooms', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus deleniti at libero quo. Aperiam incidunt nostrum non commodi nam. Praesentium quis eius odit hic reprehenderit iste fugiat dignissimos voluptatum animi tenetur atque, modi volupt');

-- --------------------------------------------------------

--
-- Table structure for table `user_message`
--

CREATE TABLE `user_message` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_message`
--

INSERT INTO `user_message` (`sr_no`, `name`, `email`, `subject`, `message`, `date`, `seen`) VALUES
(16, 'GINA RAMILO LAPARAN', 'erllaparan06@gmail.com', 'sss', 'svdggggg', '2024-10-01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_reg`
--

CREATE TABLE `user_reg` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` date NOT NULL,
  `profile` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(200) DEFAULT NULL,
  `t_expired` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp(),
  `client_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_reg`
--

INSERT INTO `user_reg` (`id`, `name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `is_verified`, `token`, `t_expired`, `status`, `datentime`, `client_type`) VALUES
(18, 'Emmanuel Laparan', 'erllaparan07@gmail.com', 'Brgy.Prenza,Lian Batangas\r\nSitio Balanoy', '09087547679', 4216, '2024-09-12', 'IMG_40588.jpg', '$2y$10$C31Z29y0dza1FEAvyNrNAOARUlbv4WXUeCfh2DpoDZ2Bresq16vpK', 1, NULL, NULL, 1, '2024-09-23 21:18:05', 'internal'),
(21, 'GINA RAMILO LAPARAN', 'erllaparan06@gmail.com', 'BALANOY', '9087547679', 4216, '2020-07-10', 'IMG_62222.jpg', '$2y$10$2FhbXYblrHra.4igMNrjKejZS5w9c5Iqp5WyBPYCuVELAf4bp7N4e', 1, NULL, NULL, 1, '2024-09-24 19:46:26', 'external');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `banguet`
--
ALTER TABLE `banguet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostel`
--
ALTER TABLE `hostel`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_type_id` (`type_id`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `facilities id` (`facilities_id`),
  ADD KEY `room id` (`room_id`);

--
-- Indexes for table `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `rm id` (`room_id`),
  ADD KEY `feat id` (`features_id`);

--
-- Indexes for table `room_image`
--
ALTER TABLE `room_image`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `types_room`
--
ALTER TABLE `types_room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_message`
--
ALTER TABLE `user_message`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user_reg`
--
ALTER TABLE `user_reg`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banguet`
--
ALTER TABLE `banguet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `hostel`
--
ALTER TABLE `hostel`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `room_image`
--
ALTER TABLE `room_image`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `team_details`
--
ALTER TABLE `team_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `types_room`
--
ALTER TABLE `types_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_message`
--
ALTER TABLE `user_message`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_reg`
--
ALTER TABLE `user_reg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_type_id` FOREIGN KEY (`type_id`) REFERENCES `types_room` (`id`);

--
-- Constraints for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `feat id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`),
  ADD CONSTRAINT `rm id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_image`
--
ALTER TABLE `room_image`
  ADD CONSTRAINT `room_image_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
