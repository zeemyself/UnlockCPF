-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jun 26, 2012 at 04:55 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `mobile`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `category`
-- 

CREATE TABLE `category` (
  `CategoryID` int(1) NOT NULL,
  `CategoryName` varchar(30) NOT NULL,
  PRIMARY KEY  (`CategoryID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `category`
-- 

INSERT INTO `category` VALUES (1, 'Hot News!');
INSERT INTO `category` VALUES (2, 'Sports');
INSERT INTO `category` VALUES (3, 'Entertainment');

-- --------------------------------------------------------

-- 
-- Table structure for table `member`
-- 

CREATE TABLE `member` (
  `UserID` int(3) NOT NULL auto_increment,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  PRIMARY KEY  (`UserID`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `member`
-- 

INSERT INTO `member` VALUES (1, 'win', 'win123', 'Weerachai Nukitram', 'is_php@hotmail.com');

-- --------------------------------------------------------

-- 
-- Table structure for table `news`
-- 

CREATE TABLE `news` (
  `NewsID` int(11) NOT NULL auto_increment,
  `NewsDate` datetime NOT NULL,
  `CategoryID` int(1) NOT NULL,
  `Subject` varchar(150) NOT NULL,
  `Details` text NOT NULL,
  PRIMARY KEY  (`NewsID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `news`
-- 

INSERT INTO `news` VALUES (1, '2012-06-01 15:00:00', 1, 'Can we trust Egypt''s new president?', '(CNN) -- The Egyptian uprising, launched by young liberals hoping to bring freedom, democracy and equality to their country, has finally produced a new president.\r\nMohamed Morsi, long known as the hard-line enforcer of the Muslim Brotherhood, has promised to govern for all Egyptians, vowing to protect the rights of women, children, Christians and Muslims. He says he will preserve all international agreements, implying peace with Israel, and has made a commitment to democracy, saying "there is no such thing" as "Islamic democracy."');
INSERT INTO `news` VALUES (2, '2012-06-02 16:00:00', 1, 'NATO, Turkey to huddle over downing of jet by Syria', '(CNN) -- Western military leaders will meet Tuesday at NATO headquarters in Brussels, Belgium, to huddle with Turkey over the downing of one of its military jets by Syria.\r\nThe "consultations" are being held at Turkey''s request under Article 4 of the North Atlantic Treaty Organization''s founding charter.\r\n"Under Article 4, any ally can request consultations whenever, in the opinion of any of them, their territorial integrity, political independence or security is threatened," NATO spokeswoman Oana Lungescu said in an email to CNN.');
INSERT INTO `news` VALUES (3, '2012-06-03 17:00:00', 1, 'Facebook is trying to hijack your email address', 'NEW YORK (CNNMoney) -- If you''re a Facebook user, you have a @facebook.com email address, whether you use it or not. Facebook is now automatically posting those addresses to users'' profiles and displaying them as the default email address.\r\nCue the backlash. Facebook told CNNMoney the change has been rolling out for "a few weeks," but many users weren''t aware of it until a spate of blog posts and news articles began drawing attention to it on Monday');
INSERT INTO `news` VALUES (4, '2012-06-04 18:00:00', 1, '3 police killed in Mexico City airport shooting', '(CNN) -- Gunmen opened fire on federal police officers at Mexico City''s international airport Monday, killing three, officials said.\r\nTwo of the officers died at the scene, while a third was transported to a hospital and died there.\r\nThe gunmen were suspected drug traffickers and opened fire as police closed in on them, the Public Security Ministry said in a statement.\r\nIt was not clear whether there had been any arrests.\r\nThe shooting took place at Benito Juarez International Airport, the country''s busiest.\r\nLast year, authorities there seized 198 pounds (90 kilograms) of cocaine, the ministry said. So far this year, they have seized 440 pounds (200 kilograms) of the drug.');
INSERT INTO `news` VALUES (5, '2012-06-05 19:00:00', 2, 'Djokovic begins Wimbledon defense in style', '(CNN) -- Top seed Novak Djokovic began the defense of his Wimbledon title with an emphatic Centre Court victory over Spain''s Juan Carlos Ferrero on day one of the championships.\r\nThe 25-year-old, playing for the first time since his defeat to Rafael Nadal in the French Open final earlier this month, recovered from a rusty start to cruise through 6-3 6-3 6-1.\r\nThe Serbian world number one had opted to take a break following his defeat to Nadal at Roland Garros, rather than playing in Wimbledon warmup tournaments.');
INSERT INTO `news` VALUES (6, '2012-06-05 11:00:00', 2, 'Ferrari chief: Alonso''s Valencia victory energizes title push', '(CNN) -- Ferrari president Luca di Montezemolo thinks Fernando Alonso''s victory at the European Grand Prix can energize his team''s bid to secure their first drivers'' championship since 2007.\r\nThe Spaniard became the first driver to record two wins this season, after the opening seven races of the campaign were won by seven different drivers.\r\nAlonso had started the race in 11th place but worked his way up the field to take the checkered flag and a 20-point lead in the drivers'' championship.');
INSERT INTO `news` VALUES (7, '2012-06-06 20:00:00', 2, 'Murray relishes Wimbledon''s home comforts', '(CNN) -- Andy Murray believes "the green, green grass of home" can be his theme tune for a memorable summer in 2012.\r\nScot Murray will have two chances of glory on the All England courts this summer, with the Wimbledon Championships followed by a chance of Olympic glory on home soil.\r\nAnd he insists the passionate Wimbledon crowds will prove an inspiration, rather than a burden, in his bid for a glorious summer double.');
INSERT INTO `news` VALUES (8, '2012-06-07 21:00:00', 3, 'Family, fans mark Michael Jackson''s death three years later', '(CNN) -- Memories, tributes and, of course, trending topics continue to flood the Twittersphere as Michael Jackson is remembered on the third anniversary of his death.\r\nJackson''s 14-year-old daughter, Paris, is among the many people who tweeted their respects on Monday.\r\n"RIP Michael Jackson ... Dad you will forever be in my heart <3 i love you," she wrote.');
INSERT INTO `news` VALUES (9, '2012-06-08 22:00:00', 3, 'Is unscripted TV the new reality for record industry executives?', '(CNN) -- For years, there has been talk that the music industry is in decline. The increase of Internet music piracy and the decrease of consumers'' attention spans have been two of the factors blamed for for lackluster sales. So it''s no surprise that music stars have sought other streams of income outside royalties, concert dates and merchandising sales throughout the years.\r\nSome, like Beyonce, Carrie Underwood, Gwen Stefani and Queen Latifah, are the faces of major cosmetic brands, while others, like Jennifer Hudson, Janet Jackson, Marie Osmond and Mariah Carey, offer up their images to popular weight loss systems.');

-- --------------------------------------------------------

-- 
-- Table structure for table `oil`
-- 

CREATE TABLE `oil` (
  `CompID` int(11) NOT NULL auto_increment,
  `CompName` varchar(100) NOT NULL,
  `Logo` varchar(100) NOT NULL,
  `Price` varchar(150) NOT NULL,
  PRIMARY KEY  (`CompID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `oil`
-- 

INSERT INTO `oil` VALUES (1, 'PTT', 'ptt.gif', 'E10=36.53, E20=32.88, E85=20.58');
INSERT INTO `oil` VALUES (2, 'BCP', 'bcp.jpg', 'E10=36.53, E20=32.88, E85=20.58');
INSERT INTO `oil` VALUES (3, 'Shell', 'shell.gif', 'E10=36.53, E20=32.88, E85=20.58');
INSERT INTO `oil` VALUES (4, 'Chevron', 'caltex.gif', 'E10=36.53, E20=32.88, E85=20.58');
INSERT INTO `oil` VALUES (5, 'Susco', 'susco.jpg', 'E10=36.53, E20=32.88, E85=20.58');
INSERT INTO `oil` VALUES (6, 'Pure', 'pure.jpg', 'E10=36.53, E20=32.88, E85=20.58');
INSERT INTO `oil` VALUES (7, 'Petronas', 'petronas.gif', 'E10=36.53, E20=32.88, E85=20.58');
