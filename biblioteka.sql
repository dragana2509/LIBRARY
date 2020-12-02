-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2020 at 05:41 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblioteka`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Author` varchar(255) NOT NULL,
  `Publisher_id` int(11) NOT NULL,
  `Published_on` varchar(128) NOT NULL,
  `Genre` varchar(128) NOT NULL,
  `ISBN` int(255) NOT NULL,
  `Number_of_pages` varchar(1000) NOT NULL,
  `Number_of_copies` varchar(1000) NOT NULL,
  `Avatar` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `Title`, `Author`, `Publisher_id`, `Published_on`, `Genre`, `ISBN`, `Number_of_pages`, `Number_of_copies`, `Avatar`) VALUES
(1, 'Genetics', 'Benjamin A. Pierce', 1, '15.05.2005.', 'Medicine', 7888, '1450', '20', 'Pictures_add_books/genetics.jpg'),
(2, 'Anatomy', 'Frank H. Netter', 1, '02.02.2002.', 'Medicine', 4555, '1300', '20', 'Pictures_add_books/anatomy.jpg'),
(3, 'Telecommunications', 'Fraidoon Mazda ', 2, '25.06.2010.', 'Technology', 9669, '864', '15', 'Pictures_add_books/telecom.jpg'),
(4, 'Chemical Engeneering', 'S. Pushpavanam', 1, '07.09.2017.', 'Technology', 144, '2500', '15', 'Pictures_add_books/engen.jpg'),
(5, 'The art of Rivalry', 'Sebastian Smee', 2, '01.02.2016.', 'Art', 1222, '550', '20', 'Pictures_add_books/art.jpg'),
(6, 'Everything you know about art is wrong', 'Matt Brown', 1, '05.07.2018.', 'Art', 2563, '700', '10', 'Pictures_add_books/art1.jpg'),
(7, 'World history', 'Adam Brown', 1, '11.1.2001.', 'History', 7899, '845', '25', 'Pictures_add_books/worldh.jpg'),
(8, 'The great influenza', 'John M. Barry', 2, '15.09.2005.', 'History', 1254, '1230', '30', 'Pictures_add_books/infl.jpg'),
(9, 'The book of lost friends', 'Lisa Wingate', 1, '12.02.2012.', 'Novel', 4565, '355', '20', 'Pictures_add_books/friends.jpg'),
(10, 'Can love happen twice', 'Ravinder Singh', 1, '03.06.20015.', 'Novel', 2112, '410', '15', 'Pictures_add_books/love.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `id_publisher` int(11) NOT NULL,
  `Publisher` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`id_publisher`, `Publisher`) VALUES
(1, 'Nature Research'),
(2, 'Laguna');

-- --------------------------------------------------------

--
-- Table structure for table `rent`
--

CREATE TABLE `rent` (
  `rent_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `number_rented_books` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rent`
--

INSERT INTO `rent` (`rent_id`, `book_id`, `user_id`, `number_rented_books`) VALUES
(11, 1, 65, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `Surname` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `eMail` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `Name`, `Surname`, `eMail`, `avatar`) VALUES
(50, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Dragana', 'Mitic', 'gaga@gmail.com', 'Pictures_registration/13351-3333-44358.jpg'),
(65, 'goga', '2a48134e63a9f394299653583c0d1151', 'Goga', 'Madic', 'goga@gmail.com', 'Pictures_registration/93787-1509-24664.jpg'),
(67, 'dani', '55b7e8b895d047537e672250dd781555', 'Dani', 'Danic', 'dani@gmail.com', 'Pictures_registration/31137-96827-20916.jfif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id_publisher`);

--
-- Indexes for table `rent`
--
ALTER TABLE `rent`
  ADD PRIMARY KEY (`rent_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id_publisher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rent`
--
ALTER TABLE `rent`
  MODIFY `rent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
