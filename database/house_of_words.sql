-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2024 at 09:00 PM
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
-- Database: `house_of_words`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_Id` int(11) NOT NULL,
  `FName` varchar(30) NOT NULL,
  `LName` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_Id`, `FName`, `LName`, `Email`, `Password`) VALUES
(1, 'Noor', 'Abduallah', 'noorA1213@HOW.com', '11346697'),
(2, 'Ahmed', 'Nasser', 'ahmedN2214@HOW.com', '11472514'),
(3, 'Sahar', 'Ali', 'saharA1515@HOW.com', '17823456'),
(4, 'Salem', 'Faisal', 'salemF1116@HOW.com', '99265582'),
(5, 'Sarah', 'Fahad', 'sarahF4417@HOW.com', '6651238');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Book_id` int(11) NOT NULL,
  `Book_name` varchar(50) NOT NULL,
  `Book_genre` varchar(50) NOT NULL,
  `Author_name` varchar(30) NOT NULL,
  `Published` varchar(50) NOT NULL,
  `Pages` int(10) UNSIGNED NOT NULL,
  `Price` double UNSIGNED NOT NULL,
  `Quantity` int(10) UNSIGNED NOT NULL,
  `Product_description` varchar(1000) NOT NULL,
  `Book_Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Book_id`, `Book_name`, `Book_genre`, `Author_name`, `Published`, `Pages`, `Price`, `Quantity`, `Product_description`, `Book_Image`) VALUES
(1, 'Pride and prejudice ', 'Classic, romantic ', 'Jane Austen', '1813', 226, 21.99, 30, 'The pride and prejudice is a classic novel written by Jane Austen . Pride and Prejudice is the second novel by English author Jane Austen, published in 1813. A novel of manners, it follows the character development of Elizabeth Bennet, the protagonist of the book, who learns about the repercussions of hasty judgments and comes to appreciate the difference between superficial goodness and actual goodness.', 'http://localhost/milestone3/img/book1.jpg'),
(2, 'how to win friends and influen', 'Self-Help', 'Dale Carnegie', '1998', 260, 22.95, 50, 'The book emphasizes the importance of showing genuine interest in others, listening actively, and making others feel important and appreciated. It also suggests that to influence others, one should avoid arguments, admit mistakes, and let others take credit for ideas or work.', 'http://localhost/milestone3/img/book2.jpg'),
(3, 'diary of a wimpy kid', 'Fiction', 'jeff Kinney', '2008', 224, 60, 30, 'Diary of a Wimpy Kid is a children\'s novel written and illustrated by Jeff Kinney. It is the first book in the Diary of a Wimpy Kid series. The book is about a boy named Greg Heffley and his attempts to become popular in his first year of middle school', 'http://localhost/milestone3/img/WimpyKid.jpg'),
(4, 'The design of everyday things', 'Self-Help', 'Don Norman', '2013', 368, 10.95, 80, 'This book explores the cognitive psychology of good design and what makes a product that responds to users\' needs. The author develops the common barriers to good design, how to reduce and fix errors, and how to bring users and technology closer together.', 'http://localhost/milestone3/img/book3.jpg'),
(5, 'Evil Eye', 'Fiction', 'Etaf Rum', '2023', 352, 15.99, 20, 'Evil Eye follows Palestinian American, Yara, as she navigates through racism, sexism, disconnect from her Palestinian culture, her husband, and her life in general. Yara, after escaping an abusive household with her parents, marries a man named Fadi and moves to the suburbs.', 'http://localhost/milestone3/img/book4.jpg'),
(6, 'Crime and Punishment', 'Fiction', 'Fyodor Dostoevsky', '1866', 671, 20.95, 35, 'Raskolnikov, a destitute and desperate former student, wanders through the slums of St Petersburg and commits a random murder without remorse or regret. He imagines himself to be a great man, a Napoleon: acting for a higher purpose beyond conventional moral law. But as he embarks on a dangerous game of cat and mouse with a suspicious police investigator, Raskolnikov is pursued by the growing voice of his conscience and finds the noose of his own guilt tightening around his neck. Only Sonya, a downtrodden sex worker, can offer the chance of redemption.', 'http://localhost/milestone3/img/book5.jpg'),
(7, 'Jurassic Park', 'Action-Horror', 'Michael Crichton', '1990', 466, 34.95, 55, 'A pragmatic paleontologist touring an almost complete theme park on an island in Central America is tasked with protecting a couple of kids after a power failure causes the park\'s cloned dinosaurs to run loose.', 'http://localhost/milestone3/img/Action3.jpg'),
(8, 'The Adventures of Sherlock Holmes', 'Fiction', 'Arthur Conan Doyle', '1891', 289, 19.99, 20, 'The Adventures of Sherlock Holmes is a collection of twelve short stories featuring the famous detective Sherlock Holmes and his loyal friend Dr. Watson. Set in late 19th-century London, the book follows Holmes as he solves a series of complex and intriguing cases using his keen powers of observation and deduction.', 'http://localhost/milestone3/img/book7.jpg'),
(9, 'The 4-Hour Workweek', 'self-help', 'Timothy Ferriss', '2007', 308, 20.99, 25, 'It promotes the idea of \"lifestyle design\" and rejects the traditional \"get a good job, work hard, retire rich\" model. Ferriss argues that by eliminating waste and outsourcing certain aspects of your life, you can reduce your work time to four hours a week.', 'http://localhost/milestone3/img/book6.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_Id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
