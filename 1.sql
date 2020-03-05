#订单表
CREATE TABLE `o2o_order`(
 `id` int(11) unsigned NOT NULL auto_increment,
 `product` VARCHAR(200) NOT NULL DEFAULT '',
 `num` int(11) unsigned NOT NULL DEFAULT 0,
 `username` VARCHAR(50)  NOT NULL DEFAULT '',
 `tel` VARCHAR(20) NOT NULL DEFAULT '',
 `address` VARCHAR(255) NOT NULL DEFAULT '',
 `express_status` tinyint(1) NOT NULL DEFAULT 0,
 `order_status` tinyint(1) NOT NULL DEFAULT 0,
 `order_ip` VARCHAR(20) NOT NULL DEFAULT '',
 `order_addtime` int(11) unsigned NOT NULL DEFAULT 0,
 `remark` text NOT NULL,
 `status` tinyint(1) NOT NULL DEFAULT 0,
 `create_time` int(11) unsigned NOT NULL DEFAULT 0,
 `update_time` int(11) unsigned NOT NULL DEFAULT 0,
 PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET=utf8;