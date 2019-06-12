1. memcached存储数据时,是以key/value的形式来存储的.有点像关联数组.
		['name'=>"xiaohigh"]

2. memcached所存储的信息在软件关闭之后就销毁了.

3. `iptables -F` 可以用来快速关闭防火墙.

4. `ctrl+insert`复制  `shift+insert`粘贴

5. `sftp`

6. 开启错误提醒, 修改php.ini 将`display_error`参数改为`on`

7. session信息是可以自定义存储的. 比如可以将他们存入到mysql, memcache, redis中. `session_set_save_handler`.

8. windows如果telnet命令时效. 
	`控制面包` -> `程序和功能` -> `打开或关闭windows功能` ->  `勾选 telnet服务器和客户端`