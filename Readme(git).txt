һ  ��װGIT

Windows������

	https://git-for-windows.github.io/������� ��װ

Linux��ubuntu/centos��������װ
	sudo apt-get install git  yum install git


Git ����ԭ�������� -> �汾�⣨stage=�ݴ���->master=���ذ汾�⣩-> Զ�ֿ̲⣩

��������Working Directory��

	������ git init   ����������汾�⽨����ϵ

�汾�⣨Repository��

	git add Readme(git).txt / .        //����ļ����汾��.�������������ļ�
	
	git status  		           //�鿴״̬

	git commit -m "���Readme.txt�ļ�"     //�ύ��ע��*�������ְ汾����

Զ�ֿ̲⣨�������˴������
	
	1.GitHub-��Զ�̷������ֿ�-ע��GitHub�˺�

	2.���زֿ���Զ�ֿ̲⽨������

	//git init
	//git add README.md
	//git commit -m "first commit"

	git remote add origin https://github.com/dongfei123/readme.git  //��Զ�ֿ̲⽨������
   
	git push -u origin master                                       //����Զ�ֿ̲�


git ��������

1.����ȫ������
	
	git config --global user.name #�û���
	
	git config --global user.email #�û�����

2.�鿴�汾	
	 
	git --version



�汾����
���ø�ʽ 
	git log          //�鿴��Ŀ��־

	git log ��file�� //�鿴�ļ���־

	git log .        //�鿴����Ŀ¼��־
 	
	git reset --hard �汾id��

