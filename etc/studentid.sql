CREATE TABLE IF NOT EXISTS `t_studentid` (
  `id` int(9) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL COMMENT '������',
  `token_exptime` int(10) NOT NULL COMMENT '��������Ч��',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '״̬0-δ���״̬1-����',
  `regtime` int(10) NOT NULL COMMENT 'ע��ʱ��',
  PRIMARY KEY (id)
  )DEFAULT CHARSET=utf-8;