set names utf8;
DROP TABLE IF EXISTS ad_bianmin_customer;
CREATE TABLE `ad_bianmin_customer` (
  `customer_name` char(10) DEFAULT NULL,
  `proxy_code` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
insert into `ad_bianmin_customer`(`customer_name`,`proxy_code`) values('两江水务','36441');
insert into `ad_bianmin_customer`(`customer_name`,`proxy_code`) values('菜同水务','36371');
insert into `ad_bianmin_customer`(`customer_name`,`proxy_code`) values('渝南水务','36367');
insert into `ad_bianmin_customer`(`customer_name`,`proxy_code`) values('江东','36368');
insert into `ad_bianmin_customer`(`customer_name`,`proxy_code`) values('道角','36369');
insert into `ad_bianmin_customer`(`customer_name`,`proxy_code`) values('万盛','36370');
insert into `ad_bianmin_customer`(`customer_name`,`proxy_code`) values('合川','36373');

DROP TABLE IF EXISTS ad_customer;
CREATE TABLE `ad_customer` (
  `customer_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '打款时间',
  `customer_name` varchar(45) NOT NULL DEFAULT '' COMMENT '单位名称',
  `customer_contacts` varchar(10) DEFAULT NULL COMMENT '联系人',
  `customer_phone` char(40) DEFAULT NULL,
  `customer_remote` varchar(150) NOT NULL COMMENT '远程信息',
  `customer_shouxufei` int(1) DEFAULT NULL COMMENT '手续费',
  `customer_sxf_sorts` int(1) NOT NULL COMMENT '手续费:0企业出,1用户出',
  `customer_state` int(1) NOT NULL COMMENT '0代表启动,1代表未启用',
  `customer_productid` char(20) NOT NULL DEFAULT '0',
  `customer_dtcenterid` int(2) NOT NULL,
  `customer_note` varchar(300) DEFAULT NULL COMMENT '备注',
  `customer_count` char(30) DEFAULT NULL COMMENT '用户数',
  `customer_dkrq` int(2) DEFAULT NULL COMMENT '打款日期',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `customer_ewm` varchar(100) NOT NULL,
  `customer_up` char(50) DEFAULT NULL,
  `proxy_code` char(9) DEFAULT NULL COMMENT '支付宝对应的清算单位',
  `customer_logo` varchar(100) DEFAULT NULL COMMENT 'LOGO',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('32','贵州习水','王工','18508525230','TV:130444341/123456','2','0','0','1,3','3','前置机密码:sntsoft
贵州水投水务习水有限责任公司23375001040011900(农行)','33354/24726','0','2016-09-26 17:35:05','ewm/9b6a217420160912110110.png','习水/xssntsoft','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('34','重庆秀山','黄琴','15223943665','远程桌面:222.179.220.14:12500 administrator/admin','0','0','0','2','3','商户号：1357977402/079845;Appid:wx39e8c54b3ca04bdf,Key:29bea7c8ef1ae5f2d954586303330290,Appsecret:4b7f02207a3491b6a4d43318efded3e5','36259/32047','0','2016-09-09 17:45:03','ewm/5b333b2b20160909174503.gif','秀山/xssntsoft','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('35','河南确山','强工','13526397677','TV:641376839/123456','4','0','0','1','3','前置机密码:sntsoft','0','11','2016-09-09 17:47:29','','确山/qssntsoft','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('36','贵州荔波','潘工','15286291212','TV:745842298/123456','5','1','1','1','3','','12358/9991','0','2016-09-28 11:15:07','','','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('37','广西宾阳','龙主任','18977105480/13347505522','TV:670125811/123456','0','0','0','2,3','3','公众号:bysc8222261@163.com
公众号密码:by123456
Appid:wx2b004a1a1b5ff348,
Mchid:1360052202,
Key:8dbe48ef64e2cfcb1777fbd62e4adf21,
Appsecret:8dbe48ef64e2cfcb1777fbd62e4adf21
支付平台登录密码:934760','22212/22206','0','2016-09-28 10:30:05','','','36449','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('38','陕西略阳','王洁','13259275528','TV:559 886 990/123456','5','0','1','1','3','前置机密码administrator/ly123456..','9442/7614','0','2016-09-28 11:24:45','','','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('39','贵州桐梓','李姐','13885250380','TV:627153749/123456','0','0','0','2','3','公众号:2623915372@qq.com\\tz123456,
Appid:wxb9f5961711db2400,
Mchid:1361475102,
Key:0063a277aec86bdc8e6b78a1f8c6e3e9,
Appsecret:0063a277aec86bdc8e6b78a1f8c6e3e9,
微信支付密码:807996,
前置机密码:123456aA,
','0','0','2016-08-25 20:52:24','','','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('41','河北双栾','宋','13833431631','tv:122996663/123456','0','0','1','2,3','3','公众号:cdsjy20@163.com/ying*219119,
Appid(公众账号ID)	wx0ec0a97db83f73ff,
Mchid(公司号)	1375084102,
Key:df7fd4799b8e3d5b76e1f6cdd0f66cc1,
Appsecret:832e781f5ad145b8f76bcd1e40074241,
支付平台密码:318695

','0','0','2016-08-30 14:22:30','','','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('44','宁夏中宁','中宁任部长','18995016611','QQ远程密码:5664555','0','0','0','1','1','1','34619','0','2016-09-09 16:42:25','ewm/9816772c20160909164225.png','中林/znsw5664555','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('45','成都龙泉驿','吴主任','13882109773','222.209.200.252:6032/6035','0','0','1','1','1','前置机:Administrator/8!4852195$LQ','0','0','2016-09-09 16:43:39','ewm/eb6ba5c720160909164339.png','龙泉驿/snt123456','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('46','江苏盐城东台','冯工','18905110856','Radmin:221.231.115.244:1315/fjg/dtfjg)))','0','0','0','2','3','Appid:wx54af5176b8f7a6a9,
Mchid:1308168701,
Key:JSDTZLS8jsdtzls8JSDTZLS8jsdtzls8,
Appsecret:558a252d061fccdcfd9a870e8f42487c
','268411/180026','0','2016-09-09 16:47:20','ewm/4c4768fa20160909164720.jpg','东台/snt123456','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('47','辽宁大石桥','陈大威','18041733636','tv:648 500 115/123456','0','0','0','2','3','前置机密码:cdw3702520214#,
Appid:wx92150e61727badbf,
Mchid:1237211002,
Key:IGq88Mja01QItOb2dJevwCX6UYtTFn7d,
Appsecret:29bea7c8ef1ae5f2d954586303330290
','103859/91937','0','2016-09-09 16:49:14','ewm/8aa5dde820160909164914.png','大石桥/9zZzDUYXN!!thk$J','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('48','河南南召','田冬澎','15893506850','TV:513 093 753/123456','5','1','0','1','3','1','33174','23','2016-09-09 17:17:24','ewm/1f955bfe20160909171724.jpg','南召/nzzls','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('49','河南淅川','麻庆锋','13837792100','无','5','0','1','1','1','1','40852','0','2016-09-09 17:19:40','ewm/7ca5e73820160909171940.png','淅川/xcsntsoft','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('50','河北承德平泉','孟工','18830430433','远程桌面218.11.170.110 administrator/pqzl','0','0','0','2,3','3','Appid(公众账号ID)	:wxe6f9ac3da0ac03e5
Mchid(公司号)	:1317358401
Key(公司支付密钥Key:7f9ffa394344f1f609b07f11de277eb6
Appsecret:7f9ffa394344f1f609b07f11de277eb6
支付平台密码:212741
','343434','0','2016-08-28 16:21:21','','','36378','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('51','重庆开县','刘忠诚','13896996128','远程桌面:221.7.90.113(admin/zlsptb)','0','1','0','2,3','4','前置机:administrator/kx_server/192.168.1.208 
Appid(公众账号ID)	wx1d1587e9bbd4d7b4
Mchid(公司号)	1337391201
Key(公司支付密钥Key)	IGq88Mja01QItOb2dJevwCX6UYtTFn6d
Appsecret(JSAPI接口中获取openid)	9213078df033b2ed6d15de399e4da649
商户平台登录密码043931
','149127/122789','0','2016-09-28 11:42:01','','','36401','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('52','贵州遵义县','李定维','182-0841-6668 /qq:461571066','远程桌面202.98.219.254:43389/administrator/sntsoft ','3','0','0','1,3','3','1','45733/35185','29','2016-09-09 17:25:00','ewm/93e3e2ce20160909172500.png','遵义/zysntsoft','36481','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('53','贵州金沙','曾工','15934746055','TV:627791629/123456','5','0','0','1','3','中国农业银行股份有限公司金沙县支行,金沙弘禹供水有限责任公司,	23826001040000358','49737/40665','23','2016-09-09 17:26:06','ewm/ba1feefd20160909172606.png','金沙/bjjssntsoft','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('54','贵州平坝','肖大星','13765342198','','0','1','0','2','1','Appid(公众账号ID)	wxc22db224a77d0e0d
Mchid(公司号)	1335763801
Key(公司支付密钥Key)	dac6f9b592b96db7eff476e1094c485c
Appsecret(JSAPI接口中获取openid)	dac6f9b592b96db7eff476e1094c485c
商户平台登录密码	250733

','24251/20729','0','2016-09-09 21:06:40','ewm/988fdcee20160909210640.png','平坝/pbsntsoft','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('55','贵州务川县','杨总','13668521985','tV:826498369/123456','5','0','0','1','3','贵州省遵义市农行务川县支行,23401001040000690，务川仡佬族苗族自治县供排水有限责任公司','18751/ 14665','1','2016-09-09 17:29:57','ewm/e08a1c2920160909172957.png','务川/wcsntsoft','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('56','成都沱源','0','0','tv:(ID:239506723;密码:sntsoft)','5','0','1','1','1','0','96294/22590','0','2016-09-28 13:23:12','ewm/ccc1ff6f20160909173356.jpg','沱源/tysntsoft','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('57','江苏射阳','蔡工','18262352668','TV:934968468/123456','0','0','0','2,3','3','Appid(公众账号ID)	，wxe85ede956d5120af
Mchid(公司号)	，1336655301
Key(公司支付密钥Key)	，e43aa146f1dd13276fbe523e92a61359
Appsecret(JSAPI接口中获取openid)，	e43aa146f1dd13276fbe523e92a61359
，商户平台登录密码717231','106342/81058','0','2016-09-09 17:37:13','','射阳/sysntsoft','36424','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('58','四川泸州','张主任','15183030061','218.89.136.17:37678(administrator/lzzls)','0','0','0','3','4','前置机:192.168.2.41/administrator/Lzss@alipay','0','0','2016-08-30 13:39:39','','','36433','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('71','四川绵阳','杨城','18981112587','QQ:2480721717/5228353','0','0','0','2','1','Appid:wx2eff2ba967585264,
Mchid:1307142401,
Key:IGq88Mja01QItOb2dJevwCX6UYtAADCF,
Appsecret:a28a6d8cb13a6b6967bc422973486bfd,
','48811/45656','0','2016-09-09 16:40:42','ewm/a8f4e63b20160909164042.jpg','绵阳/ycll5228353','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('72','四川攀枝花','雷金金','15881292750','TV:351145589/123456','0','0','0','2','1','Appid:wxc634da1237bb434d,
Mchid:1277919901,
Key:tYKabLVyBUENUt9TqVHO3DyislYcYxgC,
Appsecret:1aeb0753e08119b9972c91d687f8f359,
','179911/166451','0','2016-09-09 16:54:15','ewm/929a472220160909165415.jpg','攀枝花/PZHsw2015','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('73','四川新都','张弓','186-2810-8270','118.122.126.12:39676（guestwater/yclj@678 ）','0','0','0','1','3','新都:192.168.0.149,
玖源:192.168.0.148,
利民:192.168.0.146,
administrator/yclj!678','355442/290099','0','2016-09-09 16:58:54','ewm/1d81c52d20160909165854.png','新都/xdsntsoft','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('74','内蒙乌海','付工','139-4833-5866','向日葵:629 356 529/1234','0','0','0','1','1','1','62528/53327','0','2016-09-09 17:02:10','ewm/c7a32b5420160909170210.png','乌海/snt123456','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('75','山东临沂','马工','15564405697','tv:147102589/123456','0','0','1','1','1','1','0','0','2016-09-09 17:04:10','ewm/5d59a14120160909170410.png','临沂/lyzlssntsoft','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('76','四川乐山','蒋雨甸','15283332666','TV:931251458/123456','0','0','0','2','1','Appid:wxcc71f07291779628,
Mchid:1315143501,
Key:tYKabLVyBUENUt9TYYXSSUUUYcYxgCas,
Appsecret:713e7c5fa45eef3db361435666b27eb1,
','53388/45074','0','2016-09-09 17:07:40','ewm/f2efa8f020160909170740.jpg','乐山/zls123456','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('77','云南彝良','张组长','13578016268','无','0','0','0','1','3','1','0','0','2016-09-09 17:09:24','ewm/34f0f3aa20160909170924.png','彝良/ynzlssntsoft','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('78','陕西汉中镇巴','王力','18992628709','TV:687 271 511/123456','0','1','0','1','1','1','17434/12961','0','2016-09-21 14:43:44','ewm/8d76991020160909171244.png','镇巴/zhenbashui0916','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('79','铜梁/tlsntsoft','汤姐','13500360022','222.179.116.55:8899/administrator/SNTsnt123','0','0','0','2,3','3','Appid:wxa63dff7cb9b2cc4e,
Mchid:1373264502,
Key:9f761254c9cd19b15e465451d9dc48c6,
Appsecret:9f761254c9cd19b15e465451d9dc48c6,
公众号:cqtllzsw@qq.com/cqtllzsw123456,
支付密码:962796
','130562/118562','0','2016-09-09 17:53:45','ewm/4c50eef320160909175345.png','重庆铜梁','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('80','乌海海南','胡银秀部长','1860473268','无','0','0','0','2','3','APPID：wx664521b3c304b303
AppSecret：2f98ecbaf01048258cfd8c2ab83f7356 
登录邮箱：1400640041@qq.com
原始ID：gh_7e1154c19779
微信支付商号 1366019802
商户平台登录帐号  1366019802@1366019802
密码：268797
支付密匙：IGq09Mja1QYuulladJevwCX7dYtTFn7d
','0','0','2016-09-09 17:58:47','ewm/4c50eef320160909175847.png','乌海海南/whhnsntsoft','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('81','宜宾一供','黄志恒','13659033979','125.64.218.166:3390/administrator/SNTsoft8411','0','0','0','2,3','3','Appid(公众账号ID)	wxb96f8ed2edc192d0,
Mchid(公司号)	1379403002,
Key(公司支付密钥Key)	9f761254c9cd19b15e465451d9dc48c9,
Appsecret(JSAPI接口中获取openid)	d41c0be625ec2dfeb6a474ad247d5d22 ,
公众号:ybqysw@163.com/z2333077,
支付密码：139489


','157003/123642','0','2016-09-12 16:42:02','ewm/f446544820160912164202.jpg','宜宾一供/ybygsntsoft','36456','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('83','大足龙源','龙伟','18725871466','TV:216918246/123456','5','0','0','1,3','3','前置机密码:ly123
重庆市大足区龙源供水有限公司
2213010120010001015
重庆农村商业银行','6074/5204','28','2016-09-26 17:43:06','ewm/f805083920160926174306.png','大足龙源/lysntsoft','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('84','成都青白江','杨工','18280125320','220.167.52.144:9001\\administrator\\a1@','5','0','0','1','3','','12222','0','2016-09-28 10:15:58','ewm/175cb9e620160928101558.png','青白江/qssyx83692777','','ewm/logo_175cb9e620160928101558.jpg');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('85','宜宾二供','姜姐','13989216007','','0','0','0','2,3','3','AppID(应用ID)wxaefd75176fdf7c1b
AppSecret(应用密钥)060ac5c39a788e997f7d6de0f8f9e146
支付迷失:9f761254c9cd19b15e465451d9dc48c9
1380163202
公众号:ybeg2326145@sina.com/ecgsgs2326145
','0','0','2016-09-12 17:24:15','ewm/7f4d8dbe20160912165140.jpg','宜宾二供/ybegsntsoft','36457','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('86','重庆南城','','','183.230.116.10/Administrator/Ncsw123.','0','0','1','3','4','','0','0','2016-09-15 19:57:41','123','','36358','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('91','承德围场','李姐','13131463266','TV:271328973/123456','0','0','0','2','3','Appid(公众账号ID)	wx8ca97f022d7a87eb
Mchid(公司号)	1360032102
Key(公司支付密钥Key)	df7fd4799b8e3d5b76e1f6cdd0f66cc1
Appsecret(JSAPI接口中获取openid)	df7fd4799b8e3d5b76e1f6cdd0f66cc1
//
用户名	403276503@qq.com
密码	wc123456
	gh_64ed55cc89e6

','29904/29590','0','2016-09-29 13:55:50','ewm/c82991d220160929135550.jpg','围场/wcsntsoft','','ewm/logo_c82991d220160929135550.jpg');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('92','四川雅安','张工','','TV:726960183/123456','0','0','1','','4','','','0','2016-10-12 17:23:14','123','','','');
insert into `ad_customer`(`customer_id`,`customer_name`,`customer_contacts`,`customer_phone`,`customer_remote`,`customer_shouxufei`,`customer_sxf_sorts`,`customer_state`,`customer_productid`,`customer_dtcenterid`,`customer_note`,`customer_count`,`customer_dkrq`,`create_time`,`customer_ewm`,`customer_up`,`proxy_code`,`customer_logo`) values('93','河北双滦','宋工','13833431631','TV:122996663/123456','0','0','0','1,2,3','3','Appid(公众账号ID)	wx0ec0a97db83f73ff
Mchid(公司号)	1375084102
Key(公司支付密钥Key)	df7fd4799b8e3d5b76e1f6cdd0f66cc1
Appsecret(JSAPI接口中获取openid)	832e781f5ad145b8f76bcd1e40074241
商户平台登录帐号	1375084102@1375084102
商户平台登录密码	318695

','','0','2016-10-14 14:50:15','ewm/365f6c5f20161014144642.jpg','双滦','','ewm/logo_5063e1b320161014144642.jpg');

DROP TABLE IF EXISTS ad_customer_proxy;
CREATE TABLE `ad_customer_proxy` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `proxy_id` char(6) DEFAULT NULL COMMENT '代收单位ID',
  `proxy_code` int(9) DEFAULT NULL COMMENT '清算单位',
  `countCnt` int(6) DEFAULT NULL,
  `sumMoney` double(20,2) DEFAULT NULL,
  `dzCountCnt` int(6) DEFAULT NULL COMMENT '支付宝总数',
  `dzSumMoney` double(20,2) DEFAULT NULL COMMENT '支付宝总金额',
  `state` char(1) DEFAULT NULL COMMENT '0成功1失败',
  `dzDate` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3577 DEFAULT CHARSET=utf8;
insert into `ad_customer_proxy`(`id`,`proxy_id`,`proxy_code`,`countCnt`,`sumMoney`,`dzCountCnt`,`dzSumMoney`,`state`,`dzDate`) values('3559','1002','36358','487','22590.04','487','22590.04','0','20161014');
insert into `ad_customer_proxy`(`id`,`proxy_id`,`proxy_code`,`countCnt`,`sumMoney`,`dzCountCnt`,`dzSumMoney`,`state`,`dzDate`) values('3560','22','36424','48','3088.44','48','3088.44','0','20161014');
insert into `ad_customer_proxy`(`id`,`proxy_id`,`proxy_code`,`countCnt`,`sumMoney`,`dzCountCnt`,`dzSumMoney`,`state`,`dzDate`) values('3561','1002','36481','9','171.27','9','171.27','0','20161014');
insert into `ad_customer_proxy`(`id`,`proxy_id`,`proxy_code`,`countCnt`,`sumMoney`,`dzCountCnt`,`dzSumMoney`,`state`,`dzDate`) values('3562','1002','36401','290','15250.02','290','15250.02','0','20161014');
insert into `ad_customer_proxy`(`id`,`proxy_id`,`proxy_code`,`countCnt`,`sumMoney`,`dzCountCnt`,`dzSumMoney`,`state`,`dzDate`) values('3563','1022','36378','8','347.90','8','347.90','0','20161014');
insert into `ad_customer_proxy`(`id`,`proxy_id`,`proxy_code`,`countCnt`,`sumMoney`,`dzCountCnt`,`dzSumMoney`,`state`,`dzDate`) values('3564','1002','36433','51','7730.02','51','7730.02','0','20161014');
insert into `ad_customer_proxy`(`id`,`proxy_id`,`proxy_code`,`countCnt`,`sumMoney`,`dzCountCnt`,`dzSumMoney`,`state`,`dzDate`) values('3565','1022','36456','47','3389.37','47','3389.37','0','20161014');
insert into `ad_customer_proxy`(`id`,`proxy_id`,`proxy_code`,`countCnt`,`sumMoney`,`dzCountCnt`,`dzSumMoney`,`state`,`dzDate`) values('3566','1024','36457','22','1192.55','22','1192.55','0','20161014');
insert into `ad_customer_proxy`(`id`,`proxy_id`,`proxy_code`,`countCnt`,`sumMoney`,`dzCountCnt`,`dzSumMoney`,`state`,`dzDate`) values('3567','1022','36449','18','1259.25','18','1259.25','0','20161014');
insert into `ad_customer_proxy`(`id`,`proxy_id`,`proxy_code`,`countCnt`,`sumMoney`,`dzCountCnt`,`dzSumMoney`,`state`,`dzDate`) values('3568','1002','36358','372','16154.24','372','16154.24','0','20161015');
insert into `ad_customer_proxy`(`id`,`proxy_id`,`proxy_code`,`countCnt`,`sumMoney`,`dzCountCnt`,`dzSumMoney`,`state`,`dzDate`) values('3569','22','36424','37','2764.92','37','2764.92','0','20161015');
insert into `ad_customer_proxy`(`id`,`proxy_id`,`proxy_code`,`countCnt`,`sumMoney`,`dzCountCnt`,`dzSumMoney`,`state`,`dzDate`) values('3570','1002','36481','0','0.00','0','0.00','0','20161015');
insert into `ad_customer_proxy`(`id`,`proxy_id`,`proxy_code`,`countCnt`,`sumMoney`,`dzCountCnt`,`dzSumMoney`,`state`,`dzDate`) values('3571','1002','36401','275','14116.09','275','14116.09','0','20161015');
insert into `ad_customer_proxy`(`id`,`proxy_id`,`proxy_code`,`countCnt`,`sumMoney`,`dzCountCnt`,`dzSumMoney`,`state`,`dzDate`) values('3572','1022','36378','9','510.90','9','510.90','0','20161015');
insert into `ad_customer_proxy`(`id`,`proxy_id`,`proxy_code`,`countCnt`,`sumMoney`,`dzCountCnt`,`dzSumMoney`,`state`,`dzDate`) values('3573','1002','36433','35','5620.30','35','5620.30','0','20161015');
insert into `ad_customer_proxy`(`id`,`proxy_id`,`proxy_code`,`countCnt`,`sumMoney`,`dzCountCnt`,`dzSumMoney`,`state`,`dzDate`) values('3574','1022','36456','41','2382.39','41','2382.39','0','20161015');
insert into `ad_customer_proxy`(`id`,`proxy_id`,`proxy_code`,`countCnt`,`sumMoney`,`dzCountCnt`,`dzSumMoney`,`state`,`dzDate`) values('3575','1024','36457','25','981.75','25','981.75','0','20161015');
insert into `ad_customer_proxy`(`id`,`proxy_id`,`proxy_code`,`countCnt`,`sumMoney`,`dzCountCnt`,`dzSumMoney`,`state`,`dzDate`) values('3576','1022','36449','37','5176.00','37','5176.00','0','20161015');

DROP TABLE IF EXISTS ad_dtcenter;
CREATE TABLE `ad_dtcenter` (
  `dtcenter_id` int(2) NOT NULL AUTO_INCREMENT,
  `dtcenter_name` varchar(20) NOT NULL,
  PRIMARY KEY (`dtcenter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
insert into `ad_dtcenter`(`dtcenter_id`,`dtcenter_name`) values('1','数据中心老版本');
insert into `ad_dtcenter`(`dtcenter_id`,`dtcenter_name`) values('2','数据中心2.0');
insert into `ad_dtcenter`(`dtcenter_id`,`dtcenter_name`) values('3','数据中心2.1');
insert into `ad_dtcenter`(`dtcenter_id`,`dtcenter_name`) values('4','支付宝单机版');

DROP TABLE IF EXISTS ad_product;
CREATE TABLE `ad_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(20) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
insert into `ad_product`(`product_id`,`product_name`) values('1','水务通');
insert into `ad_product`(`product_id`,`product_name`) values('2','微信云');
insert into `ad_product`(`product_id`,`product_name`) values('3','支付宝');
insert into `ad_product`(`product_id`,`product_name`) values('4','慧居城市');

DROP TABLE IF EXISTS ad_user;
CREATE TABLE `ad_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `sex` char(4) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `create_time` char(14) DEFAULT NULL,
  `create_time_int` bigint(20) DEFAULT NULL,
  `file_name` varchar(150) DEFAULT NULL COMMENT '图片名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
insert into `ad_user`(`id`,`username`,`password`,`sex`,`mobile`,`email`,`city`,`create_time`,`create_time_int`,`file_name`) values('23','test','20b6d1a3a937f269e5239fb14a3f1f2a','男','15923903091','819058637@qq.com','50,25,25','20160821160132','1471766492','upload/22e0742520160821160132.jpg');
insert into `ad_user`(`id`,`username`,`password`,`sex`,`mobile`,`email`,`city`,`create_time`,`create_time_int`,`file_name`) values('24','zhanglu','8af106be3540a6d1b9f03a97024f8072','男','18580038085','819058637@qq.com','50,23,23','20160828205403','1472388843','upload/a1609a1d20160828205403.jpg');

DROP TABLE IF EXISTS db_admin;
CREATE TABLE `db_admin` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `account` varchar(32) DEFAULT NULL COMMENT '管理员账号',
  `password` varchar(36) DEFAULT NULL COMMENT '管理员密码',
  `login_time` int(11) DEFAULT NULL COMMENT '最后登录时间',
  `login_count` mediumint(8) NOT NULL COMMENT '登录次数',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '账户状态，禁用为0   启用为1',
  `photo` varchar(50) DEFAULT NULL COMMENT '头像',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
insert into `db_admin`(`id`,`account`,`password`,`login_time`,`login_count`,`status`,`photo`,`create_time`) values('18','zhanglu','8af106be3540a6d1b9f03a97024f8072','0','0','1','photo/c20ad4d720160909231552.jpg','1473242722');
insert into `db_admin`(`id`,`account`,`password`,`login_time`,`login_count`,`status`,`photo`,`create_time`) values('28','admin','fa0c664137933dfe720f3398b5bf36ad','0','0','1','photo/c20ad4d720160909231552.jpg','1473434152');

DROP TABLE IF EXISTS db_auth_group;
CREATE TABLE `db_auth_group` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
insert into `db_auth_group`(`id`,`title`,`status`,`rules`,`create_time`) values('34','最高权限分组','1','14,15,16,17,20,18,19,21,22,23,24,25,26,27','1473242709');

DROP TABLE IF EXISTS db_auth_group_access;
CREATE TABLE `db_auth_group_access` (
  `uid` smallint(5) unsigned NOT NULL,
  `group_id` smallint(5) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
insert into `db_auth_group_access`(`uid`,`group_id`) values('18','34');
insert into `db_auth_group_access`(`uid`,`group_id`) values('28','34');

DROP TABLE IF EXISTS db_auth_rule;
CREATE TABLE `db_auth_rule` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL DEFAULT '',
  `title` varchar(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `condition` char(100) NOT NULL DEFAULT '',
  `pid` smallint(5) NOT NULL COMMENT '父级ID',
  `sort` tinyint(4) NOT NULL DEFAULT '50' COMMENT '排序',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL,
  `remark` varchar(30) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('14','admin/System/index','系统管理','1','1','','0','50','1473241480','0','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('15','admin/System/auth_rule','权限菜单','1','1','','14','50','1473241691','0','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('16','admin/System/group_add','添加用户组','1','1','','14','50','1473241721','0','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('17','admin/System/admin_add','添加用户','1','1','','14','50','1473241757','0','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('18','admin/Customer/index','客服管理','1','1','','0','50','1473241874','0','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('19','admin/Customer/customerInfo','客服列表','1','1','','18','50','1473241908','0','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('20','admin/System/group_query','用户组','1','1','','14','50','1473301379','0','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('21','admin/DingDing/index','钉钉测试','1','1','','0','50','1473514276','0','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('22','admin/DingDing/accessToken','获取AccessToken','1','1','','21','50','1473514319','0','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('23','admin/CheckAccount /index','支付宝对账','1','1','','0','50','1473736997','0','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('24','admin/CheckAccount/queryAccount','对账查询','1','1','','23','50','1473737034','0','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('25','admin/CheckAccount/queryBianminAccount','重庆便民','1','1','','23','50','1474000796','0','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('26','admin/Backup/index','备份','1','1','','0','50','1475932862','0','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('27','admin/Backup/backup_database','备份数据库','1','1','','26','50','1475933020','0','');

DROP TABLE IF EXISTS db_user;
CREATE TABLE `db_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile` varchar(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '账号状态   1正常   0禁用',
  `update_time` int(11) DEFAULT NULL,
  `openid` varchar(40) DEFAULT NULL,
  `huifei_sum` int(11) NOT NULL DEFAULT '0' COMMENT '会费金额',
  `password` varchar(40) DEFAULT NULL COMMENT '密码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
insert into `db_user`(`id`,`mobile`,`create_time`,`status`,`update_time`,`openid`,`huifei_sum`,`password`) values('23','18654160150','1461247485','1','0','ozXRDt3OUsSieNiPFDMa7kDFjx9Q','0','e10adc3949ba59abbe56e057f20f883e');

DROP TABLE IF EXISTS wx_custom_menu;
CREATE TABLE `wx_custom_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `click_type_describe` varchar(255) DEFAULT NULL COMMENT '关联值',
  `custom_menu_click_type_id` varchar(100) NOT NULL COMMENT '自定义菜单接口可实现多种类型按钮ID',
  `title` varchar(50) NOT NULL COMMENT '菜单名',
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '一级菜单',
  `sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序号',
  `publics_id` int(100) NOT NULL DEFAULT '0' COMMENT '微信公众号对应wx_publics的ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS wx_custom_menu_click_type;
CREATE TABLE `wx_custom_menu_click_type` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `click_type_name` char(30) NOT NULL COMMENT '自定义菜单接口事件名',
  `click_type_describe` varchar(255) NOT NULL COMMENT '自定义菜单接口事件名描述',
  `click_type_value` varchar(30) NOT NULL DEFAULT '0' COMMENT 'url,key,media_id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
insert into `wx_custom_menu_click_type`(`id`,`click_type_name`,`click_type_describe`,`click_type_value`) values('1','click','点击推事件','key');
insert into `wx_custom_menu_click_type`(`id`,`click_type_name`,`click_type_describe`,`click_type_value`) values('2','view','跳转URL','url');
insert into `wx_custom_menu_click_type`(`id`,`click_type_name`,`click_type_describe`,`click_type_value`) values('3','scancode_push','扫码推事件','key');
insert into `wx_custom_menu_click_type`(`id`,`click_type_name`,`click_type_describe`,`click_type_value`) values('4','scancode_waitmsg','扫码推事件且弹出“消息接收中”提示框','key');
insert into `wx_custom_menu_click_type`(`id`,`click_type_name`,`click_type_describe`,`click_type_value`) values('5','pic_sysphoto','弹出系统拍照发图','key');
insert into `wx_custom_menu_click_type`(`id`,`click_type_name`,`click_type_describe`,`click_type_value`) values('6','pic_photo_or_album','弹出拍照或者相册发图','key');
insert into `wx_custom_menu_click_type`(`id`,`click_type_name`,`click_type_describe`,`click_type_value`) values('7','pic_weixin','弹出微信相册发图器','key');
insert into `wx_custom_menu_click_type`(`id`,`click_type_name`,`click_type_describe`,`click_type_value`) values('8','location_select','弹出地理位置选择器','key');
insert into `wx_custom_menu_click_type`(`id`,`click_type_name`,`click_type_describe`,`click_type_value`) values('9','is_null','一级菜单没有类型','0');

DROP TABLE IF EXISTS wx_publics;
CREATE TABLE `wx_publics` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL COMMENT '用户ID',
  `wx_type` int(1) NOT NULL COMMENT '0普通订阅号，1微信认证订阅号，2普通服务号，3微信认证服务号',
  `wx_name` char(50) NOT NULL COMMENT '微信公众号名称(自定义)',
  `wx_id` char(50) NOT NULL COMMENT '原始ID',
  `wx_app_id` varchar(100) NOT NULL COMMENT 'appid',
  `wx_app_secret` varchar(100) NOT NULL COMMENT 'appsecret',
  `wx_token` varchar(100) NOT NULL COMMENT 'TOKEN',
  `wx_encodingAESKey` varchar(255) NOT NULL COMMENT 'EncodingAESKey',
  `create_time` int(14) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
insert into `wx_publics`(`id`,`uid`,`wx_type`,`wx_name`,`wx_id`,`wx_app_id`,`wx_app_secret`,`wx_token`,`wx_encodingAESKey`,`create_time`) values('3','1','3','张路测试','gh_a2ec9e9b846f','wx7f123bdf99481798','d5eb09316037b13d313ff61ca6313a4e','zl819058637','zl819058637','1478419099');

DROP TABLE IF EXISTS wx_users;
CREATE TABLE `wx_users` (
  `uid` int(100) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `nickname` char(20) NOT NULL COMMENT '用户名',
  `password` char(40) NOT NULL COMMENT '用户密码',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
insert into `wx_users`(`uid`,`nickname`,`password`) values('1','zhanglu','zhanglu');

