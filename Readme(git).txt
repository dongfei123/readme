一  安装GIT

Windows环境：

	https://git-for-windows.github.io/下载软件 安装

Linux（ubuntu/centos）环境安装
	sudo apt-get install git  yum install git


Git 工作原理（工作区 -> 版本库（stage=暂存区->master=本地版本库）-> 远程仓库）

工作区（Working Directory）

	用命令 git init   声明用于与版本库建立联系

版本库（Repository）

	git add Readme(git).txt / .        //添加文件到版本库.代表工作区所有文件
	
	git status  		           //查看状态

	git commit -m "添加Readme.txt文件"     //提交并注释*用于区分版本回退

远程仓库（服务器端代码管理）
	
	1.GitHub-做远程服务器仓库-注册GitHub账号

	2.本地仓库与远程仓库建立连接

	//git init
	//git add README.md
	//git commit -m "first commit"

	git remote add origin https://github.com/dongfei123/readme.git  //与远程仓库建立连接
   
	git push -u origin master                                       //推向远程仓库


git 常用命令

1.设置全局设置
	
	git config --global user.name #用户名
	
	git config --global user.email #用户邮箱

2.查看版本	
	 
	git --version



版本回退
常用格式 
	git log          //查看项目日志

	git log 《file》 //查看文件日志

	git log .        //查看本地目录日志
 	
	git reset --hard 版本id号

