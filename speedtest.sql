--
-- Database: `speedtest`
--
CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `device_name` varchar(200) NOT NULL DEFAULT '',
  `device_type` enum('laptop','desktop','mac','phone','ipad','tablet') NOT NULL DEFAULT 'laptop',
  `system` enum('winxp','win7','win8','win10','linux','osx','ios','android') NOT NULL DEFAULT 'win10',
  `internet_type` enum('wifi','cable','3G','4G') NOT NULL DEFAULT 'wifi',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `device_name`, `device_type`, `system`, `internet_type`) VALUES
(3, 'barak ', 'laptop', 'win7', 'wifi'),
(4, 'barak', 'laptop', 'win7', 'cable'),
(8, 'Tomer', 'laptop', 'win10', 'cable'),
(9, 'Tomer', 'laptop', 'win10', 'wifi'),
(10, 'Ori', 'laptop', 'win8', 'cable'),
(11, 'Ori', 'laptop', 'win8', 'wifi');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '' COMMENT 'תיאור מיקום',
  `provider` varchar(200) NOT NULL DEFAULT '' COMMENT 'ספק אינטרנט',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `provider`) VALUES
(6, 'Ethernet Distance Influences', 'AS12849 Hot-Net internet services Ltd.'),
(7, 'Wireless Distance Influences', 'AS12849 Hot-Net internet services Ltd.'),
(8, 'Ethernet Load Influence For 3 Devices', 'AS8551 Bezeq International-Ltd'),
(9, 'Wireless Load Influence For 3 Devices', 'AS8551 Bezeq International-Ltd'),
(10, 'Ethernet Load Influence For 2 Devices', 'AS8551 Bezeq International-Ltd'),
(11, 'Wireless Load Influence For 2 Devices', 'AS8551 Bezeq International-Ltd');

-- --------------------------------------------------------

--
-- Table structure for table `speedtests`
--

CREATE TABLE IF NOT EXISTS `speedtests` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `position_id` int(5) NOT NULL DEFAULT '0',
  `device_id` int(5) NOT NULL DEFAULT '0',
  `internet_distance` double(3,1) NOT NULL DEFAULT '0.0',
  `downloadSpeedAverage` double(10,2) NOT NULL DEFAULT '0.00',
  `downloadSpeedMedian` double(10,2) NOT NULL DEFAULT '0.00',
  `downloadSpeedMax` double(10,2) NOT NULL DEFAULT '0.00',
  `uploadSpeedAverage` double(10,2) NOT NULL DEFAULT '0.00',
  `uploadSpeedMedian` double(10,2) NOT NULL DEFAULT '0.00',
  `uploadSpeedMax` double(10,2) NOT NULL DEFAULT '0.00',
  `pingSpeedAverage` double(10,2) NOT NULL DEFAULT '0.00',
  `pingSpeedMedian` double(10,2) NOT NULL DEFAULT '0.00',
  `pingSpeedMin` double(10,2) NOT NULL DEFAULT '0.00',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `speedtests`
--

INSERT INTO `speedtests` (`id`, `position_id`, `device_id`, `internet_distance`, `downloadSpeedAverage`, `downloadSpeedMedian`, `downloadSpeedMax`, `uploadSpeedAverage`, `uploadSpeedMedian`, `uploadSpeedMax`, `pingSpeedAverage`, `pingSpeedMedian`, `pingSpeedMin`, `date`) VALUES
(12, 6, 8, 0.3, 80.66, 93.16, 106.25, 2113.48, 2033.72, 3555.56, 46.40, 46.00, 41.00, '2016-01-19 22:22:25'),
(14, 6, 8, 1.5, 79.81, 92.06, 135.62, 2047.49, 2028.02, 4112.45, 48.70, 47.50, 39.00, '2016-01-19 22:34:46'),
(15, 6, 8, 18.3, 77.83, 87.30, 103.75, 2020.24, 2022.57, 4162.60, 42.40, 42.50, 33.00, '2016-01-19 22:35:47'),
(16, 6, 8, 19.5, 60.16, 85.65, 105.33, 2004.48, 2013.48, 3704.18, 50.80, 48.50, 44.00, '2016-01-19 22:41:25'),
(17, 7, 9, 1.5, 31.73, 32.35, 464.06, 2011.77, 2022.57, 3668.79, 63.10, 53.50, 44.00, '2016-01-19 23:00:40'),
(18, 7, 9, 0.3, 32.17, 34.11, 101.42, 2017.89, 2028.02, 2887.22, 53.00, 49.00, 42.00, '2016-01-19 23:02:59'),
(27, 8, 8, 0.0, 11.31, 11.35, 27.18, 510.15, 510.47, 1171.24, 347.64, 321.00, 40.00, '2016-01-20 17:31:35'),
(28, 8, 10, 0.0, 7.56, 8.84, 42.67, 1239.56, 1239.28, 18379.49, 73.90, 45.00, 34.00, '2016-01-20 17:31:44'),
(29, 8, 4, 0.0, 11.62, 11.58, 27.85, 710.84, 633.66, 2285.71, 429.20, 398.50, 200.00, '2016-01-20 17:32:10'),
(30, 10, 8, 0.0, 13.29, 11.36, 64.38, 612.54, 511.49, 1703.42, 46.60, 42.00, 36.00, '2016-01-20 17:43:16'),
(31, 10, 10, 0.0, 17.78, 18.27, 49.68, 1166.12, 1098.04, 2258.82, 291.70, 303.00, 41.00, '2016-01-20 17:43:17'),
(32, 9, 11, 0.0, 6.91, 8.45, 27.18, 1207.69, 1200.57, 14000.00, 111.60, 73.00, 36.00, '2016-01-20 17:48:27'),
(33, 9, 9, 0.0, 9.24, 9.61, 51.05, 330.90, 255.49, 764.94, 381.10, 367.50, 198.00, '2016-01-20 17:48:28'),
(34, 9, 3, 0.0, 10.35, 10.47, 75.75, 674.23, 674.97, 2375.26, 358.20, 329.00, 240.00, '2016-01-20 17:48:35'),
(35, 11, 9, 0.0, 13.27, 12.01, 78.62, 386.63, 381.33, 762.66, 56.10, 52.00, 41.00, '2016-01-20 17:50:59'),
(36, 11, 11, 0.0, 15.07, 15.94, 49.46, 1146.99, 1104.81, 2370.37, 102.10, 49.50, 46.00, '2016-01-20 17:51:00'),
(37, 7, 9, 18.3, 18.49, 16.16, 50.99, 2009.66, 2018.02, 3611.29, 58.20, 53.00, 51.00, '2016-01-20 18:13:30'),
(41, 7, 9, 19.5, 12.58, 12.23, 46.07, 2011.88, 2017.59, 3645.57, 55.30, 51.50, 46.00, '2016-01-23 18:05:33');