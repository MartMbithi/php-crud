-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 17, 2020 at 10:17 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `admin_id` int(20) NOT NULL,
  `admin_username` varchar(200) NOT NULL,
  `admin_number` varchar(200) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `admin_profile_pic` varchar(200) NOT NULL,
  `admin_bio` longtext NOT NULL,
  `admin_phone_number` varchar(200) NOT NULL,
  `admin_login_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`admin_id`, `admin_username`, `admin_number`, `admin_email`, `admin_profile_pic`, `admin_bio`, `admin_phone_number`, `admin_login_id`) VALUES
(1, 'System Administrator', 'LMS-001', 'sysadmin@lms.org', '', '                                                                                                                                                                                                                                                                                                                                                                                                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ', '+254737229776', '1');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(20) NOT NULL,
  `book_category_id` int(20) NOT NULL,
  `book_title` varchar(200) NOT NULL,
  `book_author` varchar(200) NOT NULL,
  `book_isbn_no` varchar(200) NOT NULL,
  `book_publisher` varchar(200) NOT NULL,
  `book_coverimage` varchar(200) NOT NULL,
  `book_status` varchar(200) NOT NULL,
  `book_summary` longtext NOT NULL,
  `book_copies` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_category_id`, `book_title`, `book_author`, `book_isbn_no`, `book_publisher`, `book_coverimage`, `book_status`, `book_summary`, `book_copies`) VALUES
(1, 1, 'The Saviorâ€™s Champion', 'Jenna Moreci', 'JFZN-9608', 'EAP Publishers', 'book-genres-fantasy-fiction.jpg', 'Available', 'Tobias Kaya doesn\'t care about The Savior. He doesn\'t care that She\'s the Ruler of the realm or that She purified the land, and he certainly doesn\'t care that She\'s of age to be married. But when competing for Her hand proves to be his last chance to save his family, he\'s forced to make The Savior his priority.\r\n\r\nNow Tobias is thrown into the Sovereign\'s Tournament with nineteen other men, and each of them is fighting â€” and killing â€” for the chance to rule at The Savior\'s side. Instantly his world is plagued with violence, treachery, and manipulation, revealing the hidden ugliness of his proud realm. And when his circumstances seem especially dire, he stumbles into an unexpected romance, one that opens him up to unimaginable dangers and darkness. \r\n\r\nTrigger warning: this novel contains graphic violence, adult language, and sexual situations.', '191');

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

CREATE TABLE `book_categories` (
  `category_id` int(20) NOT NULL,
  `category_code` varchar(200) NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `category_description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`category_id`, `category_code`, `category_name`, `category_description`) VALUES
(1, 'LMS-QPLC-7860', 'Fantasy', 'Fantasy encompasses a huge part of the book world. Itâ€™s one of the most popular book genres out thereâ€”a personal favorite of mine to read and write.Fantasy is a genre thatâ€™s identified by the use of magic within it.Overall, fantasy is the genre of possibility. You can write in a little magic, like Jenna Moreciâ€™s The Saviorâ€™s Champion or you can write a book where magic is the forefront of the plot, like with J.K. Rowlingâ€™s Harry Potter.\r\n'),
(2, 'LMS-FYKT-3097', 'Adventure', 'Your average adventure novel often focuses on both the characterâ€™s physical journey as well as the journey they go through as a person throughout the novel.Average word count for this book genreAs stated above for an epic fantasy, any genre thatâ€™s â€œepicâ€ is characterized by the magnitude of the plot, character, or themes themselves.An example of an epic adventure novel is Moby Dick, which stands at about 190,000 words and 720 pages long.'),
(3, 'LMS-RFGL-1476', 'Romance', 'Romance authors have one specific goal when it comes to their books: to make you fall in love with the characters just as much as the characters fall in love with each other.In this book genre, the romance is the center point of the plot. The entire novel moves around the relationship, though other plot points may be present.'),
(4, 'LMS-WXIU-5193', 'Contemporary', 'This book genre is among the most popular, though most writers arenâ€™t sure of what this category even is.\r\nThe contemporary book genre is simply books written in the current time period with most of the parts of the novel revolving around common issues in a characterâ€™s life. But really, this genre is actually more of the absence of a genre. You may have heard this genre lumped in with others, like Contemporary Fantasy or Contemporary Romance. The term is used to tell readers that this book takes place in current times, though it might cover other genres as well.'),
(5, 'LMS-JNVU-3490', 'Dystopian', 'This is a newer book genre thatâ€™s really been picking up popularity within the last 5 to 10 years.Though many stories of this nature have been published prior, the term â€œdystopianâ€ was recently coined to describe a book genre in which the current government or society has been destroyed and the book centers around the aftermath. Writing Dystopian fiction can give you a ton of freedom in how you develop society while lowering the worldbuilding youâ€™d have to do for a fantasy or sci-fi novel.'),
(6, 'LMS-FYHD-2697', 'Mystery', 'Weâ€™ve all heard of the mystery book genres. Itâ€™s an extremely popular genre, and for a good reason.This book genre is defined by the plot focusing on solving a mystery, most often with the mystery impacting the main character to the point where theyâ€™re the ones involved in solving it.Many other genres can have mysteries within them (in fact, most do), but what makes a book specific to this genre is the fact that the mystery is the main plot and point of the book.'),
(7, 'LMS-QAXH-7092', 'Horror', 'Horror novels are characterized by the fact that the main plot revolves around something scary and terrifying.Oftentimes, you can find that Horror and Thriller describe the same book, though weâ€™ll touch more on why thrillers are not always horror novels in the next section.'),
(8, 'LMS-NPRT-1594', 'Thriller', 'If youâ€™re writing a thriller novel, the book will focus around a high suspense and action-packed plot.This book genre most often deals with danger and dread instead, with high emotional impact involving fear.'),
(9, 'LMS-FHS-9284', 'Paranormal', 'Paranormal books are characterized by including paranormal activity, like ghosts, clairvoyance, mediums, demons, vampires, and more.The difference between fantasy and paranormal is the elements within. Paranormal doesnâ€™t typically have magic like witches or fantasy-specific beings like unicorns, mermaids, and more.But the paranormal book genre includes a current or real-life setting and is not often set in another world, like fantasy sometimes can be.However, keep in mind that you can have a paranormal fantasy novel if your book covers both types of abnormal occurrences.'),
(10, 'LMS-ORMJ-9813', 'Historical Fiction', 'This book genre is exactly as it sounds: a fictional story that takes place in the past.Usually, historical fiction centers around known events or problems that take place in a time significantly prior to the present.'),
(11, 'LMS-FSQD-0197', 'Science Fiction', 'Sci-fi is among the most popular book genre there is. With movie adaptations like Star Wars and Hitchhikerâ€™s Guide to the Galaxy, this genre has exploded and is abundant in the book world. Science fiction novels are those that take place in a futuristic society with advanced technology and occasionally otherworldly beings. This is another genre that can add to another, like with Sci-Fi Fantasy, which would include a futuristic world with advanced technology and some sort of fantastical being or magic. The word count for this novel genre can be extensive depending on the storyline.'),
(12, 'LMS-SHNJ-4570', 'Fiction', 'LOREM IPSHU');

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `charge_id` varchar(200) NOT NULL,
  `charge_name` varchar(200) NOT NULL,
  `charge_desc` longtext NOT NULL,
  `charge_amount` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`charge_id`, `charge_name`, `charge_desc`, `charge_amount`) VALUES
('1d733aae75e9', 'Lost Book Charge', 'Ksh 1200 Charged on lost book', '1200'),
('7aa16dcab332', 'Lost Book Charge', 'Ksh 2000 /= Charged on Lost Book', '2000'),
('f4cd8b438ff7', 'Damanged Book Charge', 'Ksh 2500/= Charged on damaged book', '2500');

-- --------------------------------------------------------

--
-- Table structure for table `librarians`
--

CREATE TABLE `librarians` (
  `librarian_id` int(20) NOT NULL,
  `librarian_name` varchar(200) NOT NULL,
  `librarian_number` varchar(200) NOT NULL,
  `librarian_email` varchar(200) NOT NULL,
  `librarian_phone_number` varchar(200) NOT NULL,
  `librarian_address` longtext NOT NULL,
  `librarian_profile_picture` varchar(200) NOT NULL,
  `librarian_account_status` varchar(200) NOT NULL,
  `librarian_login_id` varchar(200) NOT NULL,
  `librarian_bio` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `librarians`
--

INSERT INTO `librarians` (`librarian_id`, `librarian_name`, `librarian_number`, `librarian_email`, `librarian_phone_number`, `librarian_address`, `librarian_profile_picture`, `librarian_account_status`, `librarian_login_id`, `librarian_bio`) VALUES
(3, 'Librarian 001', 'LMS-ZXFG-1946', 'librarian001@lms.org', '+254712345678', '127.0.0.1, LocalHost Street', '', 'Denied Login', 'ab70896570139b9cbc581294209e3e2f01ab1ded', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,'),
(4, 'Librarian 002', 'LMS-XBHE-0897', 'librarian002@lms.org', '+254712345678', '127.0.0.1, LocalHost Street', '51-kqWaNeTL.jpg', 'Can Login', '10e0b6dc958adfb5b094d8935a13aeadbe783c25', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,'),
(5, 'Librarian 003', 'LMS-YLRD-5806', 'librarian003@lms.org', '+2547123456432', '127.0.0.1, LocalHost Street', '', 'Denied Login', '57881726e0501d8b6dad5726d1ff622c5f4f6a12', ''),
(6, 'Librarian 006', 'LMS-CFIH-1502', 'librarian006@lms.org', '+2547123456432', '127.0.0.1, LocalHost Street', '', 'Can Login', '1278ae329718c4c2bce70890385291b442f1e979', '');

-- --------------------------------------------------------

--
-- Table structure for table `library_operations`
--

CREATE TABLE `library_operations` (
  `operation_id` varchar(200) NOT NULL,
  `operation_number` varchar(200) NOT NULL,
  `operation_checksum` varchar(200) NOT NULL,
  `operation_type` varchar(200) NOT NULL,
  `operation_desc` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `library_operations`
--

INSERT INTO `library_operations` (`operation_id`, `operation_number`, `operation_checksum`, `operation_type`, `operation_desc`) VALUES
('20dcdb92', 'LMS-JUZY-7150', '407febd56bf86d82896ceb5b', 'Lost', ''),
('50cd0512', 'LMS-QDXC-7192', 'e6712c0cb586b3f9ec5fc00c', 'Borrow', ''),
('61ecee03', 'LMS-XKAT-9382', '96355242a08b57e083a82c16', 'Return', ''),
('7a0ac59b', 'LMS-KZNY-9372', '98ba8df5acc56e24d4561ffa', 'Damanged', ''),
('a7a09fe7', 'LMS-ERFK-4126', '63dc1951c5a7065a9107dc70', 'Lost', ''),
('d8c6b4f4', 'LMS-MNAK-2035', '8316453e26d3358ad79666cd', 'Damanged', ''),
('e9250b2b', 'LMS-QXAS-0731', 'b28505319898312caf2e74b1', 'Return', '');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` varchar(200) NOT NULL,
  `login_user_name` varchar(200) NOT NULL,
  `login_password` varchar(200) NOT NULL,
  `login_user_permission` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `login_user_name`, `login_password`, `login_user_permission`) VALUES
('1', 'sysadmin@lms.org', 'adcd7048512e64b48da55b027577886ee5a36350', '1'),
('10e0b6dc958adfb5b094d8935a13aeadbe783c25', 'librarian002@lms.org', 'adcd7048512e64b48da55b027577886ee5a36350', '0'),
('1278ae329718c4c2bce70890385291b442f1e979', 'librarian006@lms.org', 'a69681bcf334ae130217fea4505fd3c994f5683f', '0'),
('4de9a99476e9964fdbbe77bad954a9544eca29c2', 'student001@lms.org', 'adcd7048512e64b48da55b027577886ee5a36350', ''),
('7a0c21027b66ada3be71c2e779d7b73fdaab1a5a', 'student002@lms.org', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('cb2aab6de4f1079801410a9c030a0407b4bce048', 'student005@lms.org', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('d2a23aa263d5c2afab969bb1a18b4340f7137a20', 'student003@lms.org', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('f410cd6de2a616812ca6878327aa348d959be0c8', 'student006@lms.org', 'a69681bcf334ae130217fea4505fd3c994f5683f', '');

-- --------------------------------------------------------

--
-- Table structure for table `operation_charges`
--

CREATE TABLE `operation_charges` (
  `operation_charge_id` int(11) NOT NULL,
  `operation_charge_charge_id` varchar(200) NOT NULL,
  `operation_charge_student_operation_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operation_charges`
--

INSERT INTO `operation_charges` (`operation_charge_id`, `operation_charge_charge_id`, `operation_charge_student_operation_id`) VALUES
(11, '1d733aae75e9', '20dcdb92'),
(8, '7aa16dcab332', '20dcdb92'),
(9, 'f4cd8b438ff7', '7a0ac59b');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `reset_id` int(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `reset_code` varchar(200) NOT NULL,
  `reset_token` varchar(200) NOT NULL,
  `reset_status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`reset_id`, `email`, `reset_code`, `reset_token`, `reset_status`) VALUES
(1, 'sysadmin@lms.org', 'T5U8RMG12I', '0fadeb8729baa4d45ee6243af91fae7beb829bb6', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(20) NOT NULL,
  `student_name` varchar(200) NOT NULL,
  `student_reg_number` varchar(200) NOT NULL,
  `student_email` varchar(200) NOT NULL,
  `student_gender` varchar(200) NOT NULL,
  `student_phone_number` varchar(200) NOT NULL,
  `student_bio` longtext NOT NULL,
  `student_address` varchar(200) NOT NULL,
  `student_profile_picture` varchar(200) NOT NULL,
  `student_account_status` varchar(200) NOT NULL,
  `student_login_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `student_reg_number`, `student_email`, `student_gender`, `student_phone_number`, `student_bio`, `student_address`, `student_profile_picture`, `student_account_status`, `student_login_id`) VALUES
(4, 'Student 001', 'LMS-CEDN-1749', 'student001@lms.org', 'Male', '+254642106', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,', '127.0.0.1, LocalHost Street', '', 'Can Login', '4de9a99476e9964fdbbe77bad954a9544eca29c2'),
(5, 'Student 002', 'LMS-GLUD-2893', 'student002@lms.org', 'Female', '+2546421068', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,', '127.0.0.1, LocalHost Street', '', 'Can Login', '7a0c21027b66ada3be71c2e779d7b73fdaab1a5a'),
(6, 'Student 003', 'LMS-WCXL-0813', 'student003@lms.org', 'Male', '+2546421069', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,', '127.0.0.1, LocalHost Street', '', 'Can Login', 'd2a23aa263d5c2afab969bb1a18b4340f7137a20'),
(7, 'Student 005', 'LMS-IZYD-1235', 'student005@lms.org', 'Male', '+2546421069', '', '127.0.0.1, LocalHost Street', '', 'Can Login', 'cb2aab6de4f1079801410a9c030a0407b4bce048'),
(8, 'Student 006', 'LMS-KYMN-8731', 'student006@lms.org', 'Male', '+2546421069', '', '127.0.0.1, LocalHost Street', '', 'Can Login', 'f410cd6de2a616812ca6878327aa348d959be0c8');

-- --------------------------------------------------------

--
-- Table structure for table `student_operations`
--

CREATE TABLE `student_operations` (
  `student_operation_id` int(20) NOT NULL,
  `student_operation_student_id` int(20) NOT NULL,
  `Student_operation_operation_id` varchar(200) NOT NULL,
  `student_operation_librarian_id` int(20) NOT NULL,
  `student_operation_book_id` int(20) NOT NULL,
  `student_operation_start_date` varchar(200) NOT NULL,
  `student_operation_end_date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_operations`
--

INSERT INTO `student_operations` (`student_operation_id`, `student_operation_student_id`, `Student_operation_operation_id`, `student_operation_librarian_id`, `student_operation_book_id`, `student_operation_start_date`, `student_operation_end_date`) VALUES
(22, 4, '7a0ac59b', 0, 1, '08-16-2020', '2020-08-23'),
(23, 5, '20dcdb92', 0, 1, '08-16-2020', '2020-08-16'),
(24, 5, '20dcdb92', 0, 1, '08-16-2020', '08-16-2020'),
(25, 4, '7a0ac59b', 0, 1, '08-16-2020', '2020-08-23'),
(26, 7, 'e9250b2b', 0, 1, '08-16-2020', '2020-08-23'),
(27, 7, 'e9250b2b', 0, 1, '08-16-2020', '2020-08-23'),
(28, 6, '61ecee03', 4, 1, '08-16-2020', '2020-08-23'),
(29, 6, '61ecee03', 4, 1, '08-16-2020', '2020-08-23'),
(30, 6, 'a7a09fe7', 4, 1, '08-16-2020', '2020-08-23'),
(31, 6, 'a7a09fe7', 4, 1, '08-16-2020', '08-16-2020'),
(32, 6, 'd8c6b4f4', 4, 1, '08-16-2020', '2020-08-23'),
(33, 6, 'd8c6b4f4', 4, 1, '08-16-2020', '2020-08-23'),
(34, 4, '50cd0512', 0, 1, '08-16-2020', '2020-08-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `book_category_id` (`book_category_id`);

--
-- Indexes for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`charge_id`);

--
-- Indexes for table `librarians`
--
ALTER TABLE `librarians`
  ADD PRIMARY KEY (`librarian_id`);

--
-- Indexes for table `library_operations`
--
ALTER TABLE `library_operations`
  ADD PRIMARY KEY (`operation_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `operation_charges`
--
ALTER TABLE `operation_charges`
  ADD PRIMARY KEY (`operation_charge_id`),
  ADD KEY `operation_charge_charge_id` (`operation_charge_charge_id`,`operation_charge_student_operation_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`reset_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_operations`
--
ALTER TABLE `student_operations`
  ADD PRIMARY KEY (`student_operation_id`),
  ADD KEY `student_operation_student_id` (`student_operation_student_id`),
  ADD KEY `student_operation_librarian_id` (`student_operation_librarian_id`),
  ADD KEY `student_operation_book_id` (`student_operation_book_id`),
  ADD KEY `Operation` (`Student_operation_operation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `admin_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book_categories`
--
ALTER TABLE `book_categories`
  MODIFY `category_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `librarians`
--
ALTER TABLE `librarians`
  MODIFY `librarian_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `operation_charges`
--
ALTER TABLE `operation_charges`
  MODIFY `operation_charge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `reset_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_operations`
--
ALTER TABLE `student_operations`
  MODIFY `student_operation_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_operations`
--
ALTER TABLE `student_operations`
  ADD CONSTRAINT `BookOperation` FOREIGN KEY (`student_operation_book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `Operation` FOREIGN KEY (`Student_operation_operation_id`) REFERENCES `library_operations` (`operation_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `StudentOperation` FOREIGN KEY (`student_operation_student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
