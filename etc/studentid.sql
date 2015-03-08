CREATE TABLE IF NOT EXISTS `t_studentid` (
  `id` int(9) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL COMMENT '激活码',
  `token_exptime` int(10) NOT NULL COMMENT '激活码有效期',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态0-未激活，状态1-激活',
  `regtime` int(10) NOT NULL COMMENT '注册时间',
  PRIMARY KEY (id)
  )DEFAULT CHARSET=utf-8;