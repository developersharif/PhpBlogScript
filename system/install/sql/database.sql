-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2020 at 04:52 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `uid` int(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `uid`, `role`, `date`) VALUES
(1, 1, 'global admin', '2020-06-18 07:58:43');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `role` varchar(25) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `role`, `date`) VALUES
(8, 'Notice', 'admin', '2020-06-27 14:37:13'),
(9, 'Null', 'user', '2020-07-02 06:17:42'),
(10, 'Test', 'user', '2020-07-13 14:10:08');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `title` varchar(101) NOT NULL,
  `message` text NOT NULL,
  `email` varchar(60) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip` varchar(32) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` bigint(20) NOT NULL,
  `uid` int(250) NOT NULL,
  `title` varchar(100) NOT NULL,
  `thumb` varchar(80) NOT NULL,
  `content` longtext NOT NULL,
  `category` varchar(30) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `views` bigint(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `uid`, `title`, `thumb`, `content`, `category`, `status`, `views`, `date`, `ip`) VALUES
(32, 1, 'about bangladesh in english-Demo Post.', '5f13063d53401.png', '<div style=\"color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 14px;\"><div class=\"d7sCQ kp-header\" data-hveid=\"CBcQAg\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8Q3z4oAXoECBcQAg\" style=\"border-bottom: 1px solid rgb(235, 235, 235); border-top: 0px; border-top-left-radius: 0px; border-top-right-radius: 0px;\"><div><div class=\"mod NFQFxe oHglmf xzPb7d\" data-md=\"32\" lang=\"en-BD\" style=\"clear: none;\"><div class=\"kno-mrg kno-swp\" id=\"media_result_group\" data-hveid=\"CBcQBA\" style=\"position: relative; overflow: hidden; border-top-right-radius: 8px; border-top-left-radius: 8px;\"><div class=\"kno-fiu\"><div data-hveid=\"CA0QAA\"><div jscontroller=\"IkchZc\" jsaction=\"ivg_o:h5M12e;rcuQ6b:npT2md\" jsdata=\"X2sNs;;Az+G6I\" jsshadow=\"\"><div jsslot=\"\" jscontroller=\"VugqBb\" data-rc=\"ivg-i\" jsdata=\"U9CFPc;_;Az+G6M\" jsaction=\"rcuQ6b:npT2md\" class=\"umyQi\" data-c=\"rhsg4\" data-h=\"136\" data-nr=\"1\" style=\"border-top-left-radius: 8px; overflow: hidden; float: left; position: absolute;\"><div class=\"eA0Zlc ivg-i img-kc-m PZPZlf\" data-attrid=\"image\" data-docid=\"QITkcs--zgukQM\" data-lpage=\"/search?q=bangladesh&amp;sxsrf=ALeKk022zwrUGd6LzmPF-N1eD3SOoxa9uA:1595081889866&amp;tbm=isch&amp;source=iu&amp;ictx=1&amp;fir=QITkcs--zgukQM%252CTzZR-95_Z3-mzM%252C%252Fm%252F0162b&amp;vet=1&amp;usg=AI4_-kRh6wzOfEG5evx9tO3gIXWFcqDEeA#imgrc=QITkcs--zgukQM\" jsaction=\"fire.ivg_o\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8Q-x0oADAmegQIDRAC\" style=\"vertical-align: top; display: inline-block; margin: 0px; position: relative; overflow: hidden;\"><a href=\"https://www.google.com/search?q=bangladesh&amp;sxsrf=ALeKk022zwrUGd6LzmPF-N1eD3SOoxa9uA:1595081889866&amp;tbm=isch&amp;source=iu&amp;ictx=1&amp;fir=QITkcs--zgukQM%252CTzZR-95_Z3-mzM%252C%252Fm%252F0162b&amp;vet=1&amp;usg=AI4_-kRh6wzOfEG5evx9tO3gIXWFcqDEeA&amp;sa=X&amp;ved=2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8Q_B0wJnoECA0QAw#imgrc=QITkcs--zgukQM\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8Q_B0wJnoECA0QAw\" style=\"color: rgb(102, 0, 153); cursor: pointer; outline: 0px;\"><g-img class=\"BA0A6c\" style=\"display: block; overflow: hidden; height: 136px; width: 226px;\"><img id=\"dimg_37\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOIAAACICAMAAADNocfZAAAAdVBMVEUAak70KkEAbE8Abk//I0D4KEH6JkAAcFC+QUXuK0HQO0Q/ZU3hM0LVN0ORT0gRaU4xZU1mXEtxXUt2XEtiX0wjZ03oL0KaTUcwaE5MYUyyRUasSEfDQEXcNEJYXktHZE18VEmHUkmlS0d5WErJOkS3QkVUYkxki6QEAAADZ0lEQVR4nO2c2XKrMAyGQV4IYQskQBbI0tK8/yMeA+l0OUmmATMIrO+qzRX/SLIt2ZJlEQRBEARBEARBEARBEMRsge+M/TH6AQbRaneMk/V6ncSbq5fWP439VfpgLNqEh8WyzFzBOZe26wfVPn8/sXmoBAfOhe8KKYXCblB/qH/dLMhXDhv7A3sCsI0rZbebtN8om2ahF03ZlGwXBsovnyG4u4+tqYpk6cF/ZL+fIot4kkEJUej+QeAtNKvt5PYRsGKf/01ggxT5aloaYXUQLwisLSmDzZQWV2dXviawMaQbTiYiAc6v+OiXIXkxEWeF6PB8n3gMD3aT0AjFi2H4Dekf8WsEqLrasEa46DVCuuQ9FNYBeUWuMSr62LC14wa1Ruejr0KlsTwh1sjCfl7aIpcpWo2QaBCo4Hus5xzwOpxp7ms8I9XI9jrctEb4OMMRYl0KVTguorHl3AGiTJOb1oh3hGZkuUaFylXxRSNcfZ0SbR6i0wgHfZHY4KLbHD1XqxGVq+bIzOjkmo1oiwBZfgz9z6a/kRdUEuGs24hKYpWOLes7bKk5EhuNHiIzws7Vr9DmmBYc0LrtfyIyZ2xhX0QL/auNguNZU+GkK4v6ibyg8VRIBlGo8g08Ei/6t4waUeJJqTQUpe5KzNAUHKNgGEe1XTRZY9q9wv8cgSWjgtUwoajWmzckVoTrYBL3Y2u7AclgErFUqdhAe0adbGxxeKqeMv89xBLJEY5pz/g/kVgyfxMkGuCo819uDNg0TNj653+AM+AYbkIyZUBKDANtjIgKGyaUp+ZfZDSgVGxCwd+AaxsDLt9MuEI14CJ8gMwf3XMGAx6lmPC0yIAHYhZ70/rML8On0IJ09o81DXhyq1y1c6/Ub7A+nLbA01XgkO8II7EBYj2ncX7AqlBXXRxzK4plORrCUZaoMoz/6Z3/iwx5e5+G5j70jajzb9GsO/p7tDBKH3fz4o0+7dIlei9tAbh0bHqvsGXBj3GOHTIr6eaTGV2gYF0GUExsXMr8x4hYBgyDqZn9SJ+a2Q9mstrxWoV8NF5LCM79y7THa9WAw5KFn9n3hqQtw3TyQ9JaGIuO4aEIfNduRt0JOyurj3ztzWTUXQswSL3rph1YmMTH09aa42BGmPncSYIgCIIgCIIgCIIgCIJ4zj83yDqzFS291wAAAABJRU5ErkJggg==\" class=\"rISBZc M4dUYb\" height=\"136\" title=\"https://en.wikipedia.org/wiki/Bangladesh\" width=\"226\" alt=\"Image result for bangladesh\" data-atf=\"1\" style=\"display: block; border: 0px; position: relative;\"></g-img></a></div></div></div></div></div><div class=\"kno-liu\"><div class=\"mod NFQFxe oHglmf xzPb7d\" data-md=\"33\" lang=\"en-BD\" style=\"clear: both; display: inline;\"><div class=\"kno-mrg-m\" style=\"float: right; font-size: 13px;\"><div data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8QhhgoADAnegQIFxAF\"><div class=\"rhsg4 rhsmap5col\" data-mh=\"136\" data-mw=\"227\" style=\"height: 136px; width: 227px;\"><a data-url=\"/maps/place/Bangladesh/data=!4m2!3m1!1s0x30adaaed80e18ba7:0xf2d28e0c4e1fc6b?sa=X\" href=\"https://www.google.com/search?q=bangladesh&amp;oq=bangladesh&amp;aqs=chrome..69i57j69i60j69i61l3.7830j0j4&amp;sourceid=chrome&amp;ie=UTF-8#\" jsaction=\"jsa.logVedAndGo\" tabindex=\"0\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8Q8gEwJ3oECBcQBg\" style=\"color: rgb(102, 0, 153); cursor: pointer; outline: 0px; position: relative; height: 136px; display: block;\"><img class=\"lu-fs\" height=\"136\" id=\"lu_map\" src=\"https://www.google.com/maps/vt/data=yLNIilRwLTT4r1Cuegri_U7mxCGJI1nJJITcSjhiyt63t9KNSCgc0vYCXJh9LzhjnmWlFPWaSeJ3F4aIWOxfJO5KVg_PCbKdFOxggLaNMoDnptpdeO-lxvS-pH4HB2jlnTQo55aE6Gfn6-al-tF8TF9RzjyYWJgElmIJjdwAnOa0L9AQOD_LT67LlJcYTLJjfWEf9pXJwvMU6j5oUCUWAJ_4NQ1N1qcCoMly-Yo3MyiGf0Wb8UyKZa0\" width=\"227\" title=\"Map of Bangladesh\" alt=\"Map of Bangladesh\" border=\"0\" data-atf=\"1\" style=\"border-top-left-radius: 8px; border-top-right-radius: 8px;\"><div jscontroller=\"ljqMqb\" class=\"adgvqc duf-h x5dMzc\" aria-hidden=\"true\" role=\"button\" tabindex=\"0\" jsaction=\"KQB0gd;rcuQ6b:npT2md\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8QkNEBMCd6BAgXEAc\" style=\"background-color: rgba(255, 255, 255, 0.87); border-radius: 2px; box-shadow: rgba(0, 0, 0, 0.2) 0px 1px 2px; height: 32px; width: 32px; outline: 0px; position: absolute; top: 4px; vertical-align: middle; right: 4px;\"><img class=\"hLcKi\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEgAAABICAYAAABV7bNHAAAAmElEQVR4Ae3a1xHDIBQAQfpvglLxr+M5572Z18AqC4YkSZIkSdF60DwzQIAAaQK6HWfBAXQVzmwgOKOA4AQQnAaC00BwGghOA8FpIDgNBKeB4ADaw9GEc74JR5Kkr39sy4ufT4e1N7fjAPo/nAaC00BwGghOA8FpIDgNBKeB4DQQnAKC00BwdoPTwfnlDd2AAAGSJEmSJGkDhfC3AD4fHSUAAAAASUVORK5CYII=\" alt=\"map expand icon\" height=\"24\" width=\"24\" data-atf=\"1\" style=\"opacity: 0.6; margin: 4px 0px 0px 4px;\"></div></a></div></div></div><div style=\"clear: both;\"></div></div></div></div></div></div><div class=\"fYOrjf kp-hc\" style=\"margin-bottom: 0px; padding-top: 12px; padding-bottom: 12px; position: relative; display: inline-block; width: 454px;\"><div class=\"Hhmu2e mod NFQFxe viOShc LKPcQc\" data-md=\"16\" lang=\"en-BD\" data-hveid=\"CBcQCA\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8QhygoATAoegQIFxAI\" style=\"clear: none;\"><div class=\"Ftghae iirjIb DaSCDf\" style=\"padding-left: 15px; padding-right: 15px; margin-top: 0px; position: relative; margin-bottom: 4px;\"><div class=\"SPZz6b\"><h2 class=\"qrShPb kno-ecr-pt PZPZlf gsmt mfMhoc\" data-dtype=\"d3ifr\" data-local-attribute=\"d3bn\" data-attrid=\"title\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8Q3B0oADAoegQIFxAJ\" style=\"color: rgba(0, 0, 0, 0.87); margin-right: 0px; margin-bottom: 0px; margin-left: 0px; overflow: hidden; font-family: arial, sans-serif-light, sans-serif; display: inline; font-size: 30px; position: relative; transform-origin: left top; overflow-wrap: break-word;\">Bangladesh</h2><div class=\"wwUB2c PZPZlf E75vKf\" data-attrid=\"subtitle\" style=\"margin: 4px 0px; overflow: hidden; color: rgb(112, 117, 122);\"><span data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8Q2kooATAoegQIFxAK\">Country in South Asia</span></div></div><div class=\"ZHyHcb\"></div></div></div></div></div><div jscontroller=\"OOjqEf\" jsaction=\"rcuQ6b:npT2md\"></div><div class=\"mod\" data-md=\"30\" lang=\"en-BD\" data-hveid=\"CAsQAA\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8Q6-0CMCl6BAgLEAA\" style=\"clear: none; padding-left: 15px; padding-right: 15px;\"></div></div><div class=\"Kot7x\" style=\"margin: 0px; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 14px;\"><div id=\"kp-wp-tab-cont-overview\" class=\"SoydSe\" data-hveid=\"CBcQDA\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8QydoBKAB6BAgXEAw\" style=\"padding-bottom: 4px; overflow: visible;\"><div id=\"kp-wp-tab-overview\" data-hveid=\"CBcQDQ\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8Qkt4BKAB6BAgXEA0\"><div class=\"cLjAic LMRCfc\" data-hveid=\"CCAQAA\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8Q04gCKAB6BAggEAA\"><h2 class=\"Uo8X3b\" style=\"clip: rect(1px, 1px, 1px, 1px); height: 1px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; overflow: hidden; padding: 0px; position: absolute; white-space: nowrap; width: 1px; z-index: -1000;\">Description</h2><div class=\"LuVEUc B03h3d P6OZi V14nKc ptcLIOszQJu__wholepage-card wp-ms\" data-hveid=\"CCAQAQ\"><div class=\"UDZeY OTFaAf\"><div class=\"mod\" data-md=\"50\" lang=\"en-BD\" data-hveid=\"CAwQAA\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8QkCkwKnoECAwQAA\" style=\"clear: none; padding-left: 15px; padding-right: 15px;\"><div class=\"PZPZlf hb8SAc\" data-attrid=\"description\" data-hveid=\"CAwQAQ\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8QziAoADAqegQIDBAB\" style=\"overflow: hidden; margin: 13px 0px; color: rgb(77, 81, 86);\"><div jscontroller=\"DGEKAc\" jsaction=\"desclink:c0XUbe;rcuQ6b:npT2md\"><div jscontroller=\"DGEKAc\" class=\"kno-rdesc\" jsaction=\"sngtp:c0XUbe;tp_btn:c0XUbe;rcuQ6b:npT2md\"><h2 class=\"Uo8X3b\" style=\"clip: rect(1px, 1px, 1px, 1px); height: 1px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; overflow: hidden; padding: 0px; position: absolute; white-space: nowrap; width: 1px; z-index: -1000;\">Description</h2>Bangladesh , to the east of India on the Bay of Bengal, is a South Asian country marked by lush greenery and many waterways. Its Padma (Ganges), Meghna and Jamuna rivers create fertile plains, and travel by boat is common. On the southern coast, the Sundarbans, an enormous mangrove forest shared with Eastern India, is home to the royal Bengal tiger.</div><div jscontroller=\"DGEKAc\" class=\"kno-rdesc\" jsaction=\"sngtp:c0XUbe;tp_btn:c0XUbe;rcuQ6b:npT2md\"><b style=\"color: rgb(34, 34, 34); font-size: 16px;\">Bengali</b><span style=\"color: rgb(34, 34, 34); font-size: 16px;\">&nbsp;(Bangla), the national language of Bangladesh, belongs to the Indo-Aryan group of languages and is related to Sanskrit. Like Pali, however, and various other forms of Prakrit in ancient India,&nbsp;</span><b style=\"color: rgb(34, 34, 34); font-size: 16px;\">Bengali</b><span style=\"color: rgb(34, 34, 34); font-size: 16px;\">&nbsp;originated beyond the influence of the Brahman society of the Aryans.</span><br></div></div></div></div><div class=\"mod\" data-attrid=\"kc:/location/country:capital\" data-md=\"1001\" lang=\"en-BD\" data-hveid=\"CBQQAA\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8QkCkwK3oECBQQAA\" style=\"clear: none; padding-left: 15px; padding-right: 15px;\"><div class=\"Z1hOCe\"><div class=\"zloOqf PZPZlf\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8QyxMoADAregQIFBAB\" style=\"margin-top: 7px;\"><span class=\"w8qArf\" style=\"font-weight: bolder;\"><a class=\"fl\" href=\"https://www.google.com/search?sxsrf=ALeKk022zwrUGd6LzmPF-N1eD3SOoxa9uA:1595081889866&amp;q=bangladesh+capital&amp;stick=H4sIAAAAAAAAAOPgE-LQz9U3MDQzStKSyU620s_JT04syczP00_OL80rKaq0Sk4syCxJzFnEKpSUmJeek5iSWpyhABUEAGvYiwc_AAAA&amp;sa=X&amp;ved=2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8Q6BMoADAregQIFBAC\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8Q6BMoADAregQIFBAC\" style=\"color: rgb(26, 13, 171); cursor: pointer; outline: 0px;\">Capital</a>:&nbsp;</span><span class=\"LrzXr kno-fv\"><a class=\"fl\" href=\"https://www.google.com/search?sxsrf=ALeKk022zwrUGd6LzmPF-N1eD3SOoxa9uA:1595081889866&amp;q=Dhaka&amp;stick=H4sIAAAAAAAAAOPgE-LQz9U3MDQzSlICs9Lykky0ZLKTrfRz8pMTSzLz8_ST80vzSooqrZITCzJLEnMWsbK6ZCRmJ-5gZQQATuey2j8AAAA&amp;sa=X&amp;ved=2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8QmxMoATAregQIFBAD\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8QmxMoATAregQIFBAD\" style=\"color: rgb(26, 13, 171); cursor: pointer; outline: 0px;\">Dhaka</a></span></div></div></div><div class=\"mod\" data-attrid=\"kc:/location/country:dialing code\" data-md=\"1001\" lang=\"en-BD\" data-hveid=\"CBMQAA\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8QkCkwLHoECBMQAA\" style=\"clear: none; padding-left: 15px; padding-right: 15px;\"><div class=\"Z1hOCe\"><div class=\"zloOqf PZPZlf\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8QyxMoADAsegQIExAB\" style=\"margin-top: 7px;\"><span class=\"w8qArf\" style=\"font-weight: bolder;\"><a class=\"fl\" href=\"https://www.google.com/search?sxsrf=ALeKk022zwrUGd6LzmPF-N1eD3SOoxa9uA:1595081889866&amp;q=bangladesh+dialing+code&amp;stick=H4sIAAAAAAAAAOPgE-LQz9U3MDQzStJSzE620s_JT04syczP00_OL80rKaq0SslMzMnMS1dIzk9JXcQqnpSYl56TmJJanKGALAMARFrEqEkAAAA&amp;sa=X&amp;ved=2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8Q6BMoADAsegQIExAC\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8Q6BMoADAsegQIExAC\" style=\"color: rgb(26, 13, 171); cursor: pointer; outline: 0px;\">Dialing code</a>:&nbsp;</span><span class=\"LrzXr kno-fv\">+880</span></div></div></div><div class=\"mod\" data-attrid=\"ss:/webfacts:date_format\" data-md=\"1001\" lang=\"en-BD\" data-hveid=\"CBAQAA\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8QkCkwLXoECBAQAA\" style=\"clear: none; padding-left: 15px; padding-right: 15px;\"><div class=\"Z1hOCe\"><div class=\"zloOqf PZPZlf\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8QyxMoADAtegQIEBAB\" style=\"margin-top: 7px;\"><span class=\"w8qArf\" style=\"font-weight: bolder;\"><a class=\"fl\" href=\"https://www.google.com/search?sxsrf=ALeKk022zwrUGd6LzmPF-N1eD3SOoxa9uA:1595081889866&amp;q=bangladesh+date+format&amp;sa=X&amp;ved=2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8Q6BMoADAtegQIEBAC\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8Q6BMoADAtegQIEBAC\" style=\"color: rgb(26, 13, 171); cursor: pointer; outline: 0px;\">Date format</a>:&nbsp;</span><span class=\"LrzXr kno-fv\">dd-mm-yyyy&nbsp;<a class=\"fl\" href=\"https://www.google.com/search?sxsrf=ALeKk022zwrUGd6LzmPF-N1eD3SOoxa9uA:1595081889866&amp;q=AD&amp;stick=H4sIAAAAAAAAAONgVmLXz9U3KMgtW8TK5OgCAHlCCoMQAAAA&amp;sa=X&amp;ved=2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8QmxMoATAtegQIEBAD\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8QmxMoATAtegQIEBAD\" style=\"color: rgb(26, 13, 171); cursor: pointer; outline: 0px;\">AD</a></span></div></div></div><div class=\"mod\" data-attrid=\"kc:/location/statistical_region:population\" data-md=\"1001\" lang=\"en-BD\" data-hveid=\"CBEQAA\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8QkCkwLnoECBEQAA\" style=\"clear: none; padding-left: 15px; padding-right: 15px;\"><div class=\"Z1hOCe\"><div class=\"zloOqf PZPZlf\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8QyxMoADAuegQIERAB\" style=\"margin-top: 7px;\"><span class=\"w8qArf\" style=\"font-weight: bolder;\"><a class=\"fl\" href=\"https://www.google.com/search?sxsrf=ALeKk022zwrUGd6LzmPF-N1eD3SOoxa9uA:1595081889866&amp;q=bangladesh+population&amp;stick=H4sIAAAAAAAAAOPgE-LQz9U3MDQzStLSyk620s_JT04syczP0y8uAdLFJZnJiTnxRanpQCGrgvyC0hyw7CJW0aTEvPScxJTU4gwFhDgAsJ1DIFAAAAA&amp;sa=X&amp;ved=2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8Q6BMoADAuegQIERAC\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8Q6BMoADAuegQIERAC\" style=\"color: rgb(26, 13, 171); cursor: pointer; outline: 0px;\">Population</a>:&nbsp;</span><span class=\"LrzXr kno-fv\">161.4&nbsp;million (2018)</span>&nbsp;<span class=\"XJa8af\" style=\"color: rgb(26, 13, 171); font-size: 11px;\"><a href=\"Image result for bangladesh Map of Bangladeshmap expand icon Bangladesh Country in South Asia Description DescriptionBangladesh, to the east of India on the Bay of Bengal, is a South Asian country marked by lush greenery and many waterways. Its Padma (Ganges), Meghna and Jamuna rivers create fertile plains, and travel by boat is common. On the southern coast, the Sundarbans, an enormous mangrove forest shared with Eastern India, is home to the royal Bengal tiger. Capital: Dhaka Dialing code: +880 Date format: dd-mm-yyyy AD Population: 161.4 million (2018) World Bank\" data-ved=\"2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8QvRkoATAuegQIERAD\" ping=\"/url?sa=t&amp;source=web&amp;rct=j&amp;url=http://datatopics.worldbank.org/world-development-indicators&amp;ved=2ahUKEwiP-7qL_9bqAhXozTgGHaPKDq8QvRkoATAuegQIERAD\" style=\"color: rgb(26, 13, 171); cursor: pointer; outline: 0px;\">World Bank</a></span></div></div></div></div></div></div></div></div></div>', 'Null', 'published', 10, '2020-07-18 14:25:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `site_title` varchar(101) NOT NULL,
  `site_description` varchar(150) NOT NULL,
  `notice` varchar(101) DEFAULT NULL,
  `site_logo` varchar(60) NOT NULL,
  `site_banner` varchar(60) NOT NULL,
  `site_color` varchar(10) NOT NULL,
  `dark_mode` varchar(3) NOT NULL DEFAULT 'off',
  `new_post` varchar(5) NOT NULL,
  `perpage_post` int(255) NOT NULL DEFAULT 5,
  `reg_status` varchar(5) NOT NULL,
  `site_status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_title`, `site_description`, `notice`, `site_logo`, `site_banner`, `site_color`, `dark_mode`, `new_post`, `perpage_post`, `reg_status`, `site_status`) VALUES
(1, 'Blogger', 'Blogger', 'Top BLogger', '', 'logo.png', 'site bannar', '#cb13d8', 'off', 'on', 8, 'on', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `pass` varchar(60) NOT NULL,
  `auth` varchar(60) NOT NULL,
  `phone` int(15) NOT NULL,
  `avatar` varchar(50) NOT NULL DEFAULT 'avatar.png',
  `bio` varchar(101) NOT NULL,
  `role` varchar(25) NOT NULL DEFAULT 'subscriber',
  `ip` varchar(40) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
