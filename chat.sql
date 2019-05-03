-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2019-02-13 15:38:26
-- 服务器版本： 5.7.10-log
-- PHP Version: 5.6.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- 表的结构 `chat_communication`
--

CREATE TABLE `chat_communication` (
  `id` int(8) UNSIGNED NOT NULL,
  `fromid` int(5) NOT NULL,
  `fromname` varchar(50) NOT NULL,
  `toid` int(5) NOT NULL,
  `toname` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `time` int(10) NOT NULL,
  `shopid` int(5) DEFAULT NULL,
  `isread` tinyint(2) DEFAULT '0',
  `type` tinyint(2) DEFAULT '1' COMMENT '1是普通文本，2是图片'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `chat_communication`
--

INSERT INTO `chat_communication` (`id`, `fromid`, `fromname`, `toid`, `toname`, `content`, `time`, `shopid`, `isread`, `type`) VALUES
(1, 85, 'Love violet life', 87, '大金', '你好呀87', 1549339697, NULL, 1, 1),
(2, 87, '大金', 85, 'Love violet life', '嘻嘻你好85', 1549339711, NULL, 1, 1),
(3, 85, 'Love violet life', 87, '大金', '周周在吗', 1549339756, NULL, 1, 1),
(4, 85, 'Love violet life', 87, '大金', '周周我想你了', 1549339786, NULL, 1, 1),
(5, 87, '大金', 85, 'Love violet life', '亲爱的', 1549339795, NULL, 1, 1),
(6, 85, 'Love violet life', 87, '大金', '周周在吗', 1549339833, NULL, 1, 1),
(7, 87, '大金', 85, 'Love violet life', '亲爱的', 1549339839, NULL, 1, 1),
(8, 85, 'Love violet life', 87, '大金', '哈哈', 1549339845, NULL, 1, 1),
(9, 85, 'Love violet life', 87, '大金', 'aaa', 1549374374, NULL, 1, 1),
(10, 85, 'Love violet life', 87, '大金', 'aaa', 1549374381, NULL, 1, 1),
(11, 85, 'Love violet life', 87, '大金', '你好', 1549374657, NULL, 1, 1),
(12, 87, '大金', 85, 'Love violet life', '哈哈', 1549374662, NULL, 1, 1),
(13, 85, 'Love violet life', 87, '大金', '你好', 1549375077, NULL, 1, 1),
(14, 87, '大金', 85, 'Love violet life', '是自己的头像了吧', 1549375084, NULL, 1, 1),
(15, 85, 'Love violet life', 87, '大金', '哈哈没错', 1549375091, NULL, 1, 1),
(16, 85, 'Love violet life', 87, '大金', '嘿嘿', 1549376135, NULL, 1, 1),
(17, 87, '大金', 85, 'Love violet life', '可以啦', 1549376142, NULL, 1, 1),
(18, 85, 'Love violet life', 87, '大金', '再发一条', 1549377415, NULL, 1, 1),
(19, 86, '大美如斯', 85, 'Love violet life', '啊啊啊', 1549377529, NULL, 1, 1),
(20, 86, '大美如斯', 85, 'Love violet life', '我是谁啊', 1549377551, NULL, 1, 1),
(21, 85, 'Love violet life', 87, '大金', 'nice', 1549377991, NULL, 1, 1),
(22, 87, '大金', 85, 'Love violet life', '现在聊天记录都已经有啦哈哈', 1549378008, NULL, 1, 1),
(23, 85, 'Love violet life', 87, '大金', '是啊，很OK', 1549378018, NULL, 1, 1),
(24, 85, 'Love violet life', 87, '大金', '能收到消息吗', 1549423784, NULL, 1, 1),
(25, 87, '大金', 85, 'Love violet life', '是最底下吗消息', 1549425841, NULL, 1, 1),
(26, 85, 'Love violet life', 87, '大金', '是的，不用滚动可以看到最新的啦', 1549425862, NULL, 1, 1),
(27, 85, 'Love violet life', 87, '大金', '测试一下', 1549426018, NULL, 1, 1),
(28, 85, 'Love violet life', 87, '大金', '没毛病你是离线了', 1549426029, NULL, 1, 1),
(29, 85, 'Love violet life', 87, '大金', 'chat_img_5c5afcbbb77f6.jpg', 1549466811, NULL, 1, 2),
(30, 85, 'Love violet life', 87, '大金', 'chat_img_5c5afccf308f3.jpg', 1549466831, NULL, 1, 2),
(31, 85, 'Love violet life', 87, '大金', 'chat_img_5c5be6a9205e6.jpg', 1549526697, NULL, 1, 2),
(32, 85, 'Love violet life', 87, '大金', 'chat_img_5c5c3b63dce40.jpg', 1549548387, NULL, 1, 2),
(33, 85, 'Love violet life', 87, '大金', 'chat_img_5c5c3c1d1b753.jpg', 1549548573, NULL, 1, 2),
(34, 85, 'Love violet life', 87, '大金', 'chat_img_5c5c3c414bbb8.jpg', 1549548609, NULL, 1, 2),
(35, 85, 'Love violet life', 87, '大金', 'chat_img_5c5c40538b1c2.jpg', 1549549651, NULL, 1, 2),
(36, 85, 'Love violet life', 87, '大金', 'chat_img_5c5c41316751c.jpg', 1549549873, NULL, 1, 2),
(37, 85, 'Love violet life', 87, '大金', 'qqqq', 1549550156, NULL, 1, 1),
(38, 85, 'Love violet life', 87, '大金', 'chat_img_5c5c4250d83e6.jpg', 1549550160, NULL, 1, 2),
(39, 87, '大金', 85, 'Love violet life', '嗯呢', 1549550946, NULL, 1, 1),
(40, 85, 'Love violet life', 87, '大金', 'chat_img_5c5c45809163f.jpg', 1549550976, NULL, 1, 2),
(41, 85, 'Love violet life', 87, '大金', 'chat_img_5c5c4650b73d4.jpg', 1549551184, NULL, 1, 2),
(42, 87, '大金', 85, 'Love violet life', 'chat_img_5c5c465a3554e.jpg', 1549551194, NULL, 1, 2),
(43, 85, 'Love violet life', 87, '大金', 'chat_img_5c5c47a05d72b.jpg', 1549551520, NULL, 1, 2),
(44, 85, 'Love violet life', 87, '大金', 'chat_img_5c5c4809c1d45.jpg', 1549551625, NULL, 1, 2),
(45, 85, 'Love violet life', 87, '大金', 'ok了吧', 1549551634, NULL, 1, 1),
(46, 87, '大金', 85, 'Love violet life', '恩恩，可以收到图片啦', 1549551643, NULL, 1, 1),
(47, 87, '大金', 85, 'Love violet life', 'chat_img_5c5c481dc99a1.jpg', 1549551645, NULL, 1, 2),
(48, 85, 'Love violet life', 87, '大金', 'chat_img_5c5c49fce589e.jpg', 1549552124, NULL, 1, 2),
(49, 85, 'Love violet life', 87, '大金', 'chat_img_5c617be81e9c4.jpg', 1549892584, NULL, 1, 2),
(50, 87, '大金', 85, 'Love violet life', '额可以的', 1549892590, NULL, 1, 1),
(51, 85, 'Love violet life', 87, '大金', '[em_39]', 1549893612, NULL, 1, 1),
(52, 87, '大金', 85, 'Love violet life', '[em_41]真棒', 1549893628, NULL, 1, 1),
(53, 88, '悦悦', 85, 'Love violet life', '老弟', 1549975049, NULL, 1, 1),
(54, 85, 'Love violet life', 87, '大金', '我在敲代码哦', 1549976248, NULL, 1, 1),
(55, 85, 'Love violet life', 87, '大金', '到了', 1549977651, NULL, 1, 1),
(56, 85, 'Love violet life', 87, '大金', '到了', 1549977651, NULL, 1, 1),
(57, 85, 'Love violet life', 87, '大金', '可以吧', 1549977679, NULL, 1, 1),
(58, 85, 'Love violet life', 87, '大金', '可以吧', 1549977679, NULL, 1, 1),
(59, 85, 'Love violet life', 87, '大金', '可以实时更新了', 1549978456, NULL, 1, 1),
(60, 87, '大金', 85, 'Love violet life', '不行啊', 1549978477, NULL, 1, 1),
(61, 85, 'Love violet life', 87, '大金', '打错了吧', 1549978651, NULL, 1, 1),
(62, 87, '大金', 85, 'Love violet life', '没有啊', 1549978665, NULL, 1, 1),
(63, 87, '大金', 85, 'Love violet life', '啊', 1549978699, NULL, 1, 1),
(64, 87, '大金', 85, 'Love violet life', '哈哈', 1549978733, NULL, 1, 1),
(65, 87, '大金', 85, 'Love violet life', '额', 1549978747, NULL, 1, 1),
(66, 85, 'Love violet life', 87, '大金', '可以了可以了我', 1549978764, NULL, 1, 1),
(67, 85, 'Love violet life', 87, '大金', '不行', 1549978866, NULL, 1, 1),
(68, 88, '悦悦', 85, 'Love violet life', '老铁', 1549978963, NULL, 1, 1),
(69, 87, '大金', 85, 'Love violet life', '有点意思', 1549978978, NULL, 1, 1),
(70, 85, 'Love violet life', 87, '大金', 'OK，已经实时更新', 1549978993, NULL, 1, 1),
(71, 88, '悦悦', 85, 'Love violet life', '啊啊啊', 1549979004, NULL, 1, 1),
(72, 85, 'Love violet life', 87, '大金', '有毛病靠', 1549979014, NULL, 1, 1),
(73, 87, '大金', 85, 'Love violet life', '啊', 1549979020, NULL, 1, 1),
(74, 88, '悦悦', 85, 'Love violet life', '妈的', 1549979027, NULL, 1, 1),
(75, 88, '悦悦', 85, 'Love violet life', '有毒吧', 1549979037, NULL, 1, 1),
(76, 87, '大金', 85, 'Love violet life', ' 是啊', 1549979048, NULL, 1, 1),
(77, 85, 'Love violet life', 87, '大金', '啊啊', 1549979079, NULL, 1, 1),
(78, 88, '悦悦', 85, 'Love violet life', '为什么', 1549979102, NULL, 1, 1),
(79, 85, 'Love violet life', 87, '大金', '有毛病', 1549979115, NULL, 1, 1),
(80, 88, '悦悦', 85, 'Love violet life', '[em_2]', 1549979169, NULL, 1, 1),
(81, 88, '悦悦', 85, 'Love violet life', '[em_13]', 1549979471, NULL, 1, 1),
(82, 88, '悦悦', 85, 'Love violet life', '[em_7]可以了吧', 1549979487, NULL, 1, 1),
(83, 87, '大金', 85, 'Love violet life', '嗯嗯好', 1549979502, NULL, 1, 1),
(84, 87, '大金', 85, 'Love violet life', '未读吧', 1550063930, NULL, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `chat_user`
--

CREATE TABLE `chat_user` (
  `id` int(10) NOT NULL COMMENT '自增ID',
  `mpid` int(10) NOT NULL COMMENT '公众号标识',
  `openid` varchar(255) NOT NULL COMMENT 'openid',
  `nickname` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '昵称',
  `headimgurl` varchar(255) DEFAULT NULL COMMENT '头像',
  `sex` tinyint(1) DEFAULT NULL COMMENT '性别',
  `subscribe` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否关注',
  `subscribe_time` int(10) DEFAULT NULL COMMENT '关注时间',
  `unsubscribe_time` int(10) DEFAULT NULL COMMENT '取消关注时间',
  `relname` varchar(50) DEFAULT NULL COMMENT '真实姓名',
  `signature` text COMMENT '个性签名',
  `mobile` varchar(15) DEFAULT NULL COMMENT '手机号',
  `is_bind` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否绑定',
  `language` varchar(50) DEFAULT NULL COMMENT '使用语言',
  `country` varchar(50) DEFAULT NULL COMMENT '国家',
  `province` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '省',
  `city` varchar(50) DEFAULT NULL COMMENT '城市',
  `remark` varchar(50) DEFAULT NULL COMMENT '备注',
  `group_id` int(10) DEFAULT '0' COMMENT '分组ID',
  `groupid` int(11) NOT NULL DEFAULT '0' COMMENT '公众号分组标识',
  `tagid_list` varchar(255) DEFAULT NULL COMMENT '标签',
  `score` int(10) DEFAULT '0' COMMENT '积分',
  `money` decimal(10,2) DEFAULT '0.00' COMMENT '金钱',
  `latitude` varchar(50) DEFAULT NULL COMMENT '纬度',
  `longitude` varchar(50) DEFAULT NULL COMMENT '经度',
  `location_precision` varchar(50) DEFAULT NULL COMMENT '精度',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0:公众号粉丝1：注册会员',
  `unionid` varchar(160) DEFAULT NULL COMMENT 'unionid字段',
  `password` varchar(64) DEFAULT NULL COMMENT '密码',
  `last_time` int(10) DEFAULT '586969200' COMMENT '最后交互时间',
  `parentid` int(10) DEFAULT '1' COMMENT '非扫码用户默认都是1',
  `isfenxiao` int(8) DEFAULT '0' COMMENT '是否为分销，默认为0，1,2,3，分别为1,2,3级分销',
  `totle_earn` decimal(8,2) DEFAULT '0.00' COMMENT '挣钱总额',
  `balance` decimal(8,2) DEFAULT '0.00' COMMENT '分销挣的剩余未提现额',
  `fenxiao_leavel` int(8) DEFAULT '2' COMMENT '分销等级'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='公众号粉丝表';

--
-- 转存表中的数据 `chat_user`
--

INSERT INTO `chat_user` (`id`, `mpid`, `openid`, `nickname`, `headimgurl`, `sex`, `subscribe`, `subscribe_time`, `unsubscribe_time`, `relname`, `signature`, `mobile`, `is_bind`, `language`, `country`, `province`, `city`, `remark`, `group_id`, `groupid`, `tagid_list`, `score`, `money`, `latitude`, `longitude`, `location_precision`, `type`, `unionid`, `password`, `last_time`, `parentid`, `isfenxiao`, `totle_earn`, `balance`, `fenxiao_leavel`) VALUES
(85, 1, 'oYxpK0bPptICGQd3YP_1s7jfDTmE', 'Love violet life', 'http://www.php.com:999/thinkphp/public/static/index/img/timg.jpg', 1, 1, 1517280919, 1517280912, NULL, NULL, NULL, 0, 'zh_CN', '中国', '江西', '赣州', '', 0, 0, '[]', 0, '0.00', NULL, NULL, NULL, 0, NULL, NULL, 1517478028, 1, 0, '26.00', '26.00', 2),
(86, 1, 'oYxpK0W2u3Sbbp-wevdQtCuviDVM', '大美如斯', 'http://www.php.com:999/thinkphp/public/static/index/newcj/img/123.jpg', 2, 1, 1507261446, NULL, NULL, NULL, NULL, 0, 'zh_CN', '中国', '河南', '焦作', '', 0, 0, '[]', 0, '0.00', NULL, NULL, NULL, 0, NULL, NULL, 586969200, 1, 0, '0.00', '0.00', 2),
(87, 1, 'oYxpK0RsvcwgS9DtmIOuyb_BgJbo', '大金', 'http://www.php.com:999/thinkphp/public/static/index/img/adam-jansen.jpg', 1, 1, 1508920878, NULL, NULL, NULL, NULL, 0, 'zh_CN', '中国', '河南', '商丘', '', 0, 0, '[]', 0, '0.00', NULL, NULL, NULL, 0, NULL, NULL, 586969200, 1, 0, '0.00', '0.00', 2),
(88, 1, 'oYxpK0VnHjESafUHzRpstS8mMwlE', '悦悦', 'http://www.php.com:999/thinkphp/public/static/index/newcj/img/132.jpg', 2, 1, 1512281210, NULL, NULL, NULL, NULL, 0, 'zh_CN', '中国', '福建', '福州', '', 0, 0, '[]', 0, '0.00', NULL, NULL, NULL, 0, NULL, NULL, 586969200, 1, 0, '0.00', '0.00', 2),
(89, 1, 'oYxpK0fJVYveWC_nAd7CBwcvYZ3Q', '雨薇', 'http://www.php.com:999/thinkphp/public/static/index/newcj/img/132.jpg', 2, 1, 1506320564, NULL, NULL, NULL, NULL, 0, 'zh_CN', '', '', '', '', 0, 0, '[]', 0, '0.00', NULL, NULL, NULL, 0, NULL, NULL, 586969200, 1, 0, '0.00', '0.00', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_communication`
--
ALTER TABLE `chat_communication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_user`
--
ALTER TABLE `chat_user`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `chat_communication`
--
ALTER TABLE `chat_communication`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- 使用表AUTO_INCREMENT `chat_user`
--
ALTER TABLE `chat_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID', AUTO_INCREMENT=90;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
