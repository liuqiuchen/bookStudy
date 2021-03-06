# 书中代码，最好用Notepad++打开，关键字高亮

# 创建数据库
create database mytest;

# 选择数据库
use mytest;

# 修改数据库
alter database mytest 
default character set gb2312
default collate gb2312_chinese_ci;

# 删除数据库
drop database if exists mytest;

# 查看数据库
show databases;

# 带有like关键字
show databases like 'mytest';

# 创建表
create table students
(
    student_id int not null auto_increment,
    student_name char(50) not null,
    student_sex char(1) not null default 0,
    student_age int not null,
    student_major char(50) not null,
    student_contact char(50) null,
    primary key(student_id)
)engine=innodb;
    
use mytest;

# 修改表
use mytest;

#alter table students
#add column student_from char(10) not null after student_sex;

#alter table students
#change column student_from student_city char(20) null;

#alter table students
#alter column student_sex set default 1;

#alter table students
#modify  column student_name char(20) first;

#alter table students
#drop column student_contact;

alter table students
rename to university_students;

# 重命名表
rename table university_students to students;

# 复制表 - 只复制表结构，不复制数据
#create table students_copy like students;

# 删除表
#drop table students_copy;

# 显示表名称
#show tables;

# 显示表结构
#show columns from students;
#desc students;

insert into students
VALUES
(1320, '王丽', '1', 22, '计算机专业', '138xxxxxx');

insert into mytest.students
(student_name, student_sex, student_age, student_major)
values
('李明', DEFAULT, 22, '数学专业');

insert into students
set student_name = '王明',student_sex = default, student_age=22,student_major='数学';

insert into students
(student_name, student_sex, student_age, student_major)
values
('张三', '1', 24, '化学专业'),
('王五', '1', 23, '数学专业');

insert into students
(student_name, student_sex, student_age, student_major)
select student_name, student_sex, student_age, student_major 
from mytest.students_copy;

replace into mytest.students
values
(1320, '李芳', '1', '26', '会计专业', '137xxxxxxxx');

delete from students
where student_name='王丽';

# delete语句从多个表中删除数据
delete tbl1, tbl2 from tbl1, tbl2, tbl3
where tbl1.id = tbl2.id and tbl2.id = tbl3.id;

# truncate删除表中所有数据(且数据无法恢复)，
# 执行速度比delete语句更快，truncate先删除原来的表再重新创建一个表，而不是
# 逐行删除表中的数据
truncate table students;

 update students
    -> set student_contact = '139xxxxxx'
    -> where student_name = '王丽';

update students
    -> set student_age = 23, student_major='物理专业'
    -> where student_name = '李明';

update tbl1, tbl2
set tbl1.name = '李明名', tbl2.name = '王伟'
where tbl1.id = tbl2.id;

select student_name, student_contact as '联系方式' from students;

# 计算列值
select student_name,student_id,student_id+100 from students;

# 替换查询结果中的数据
select student_name,
case
when student_sex = '0' then '男'
else '女'
end as '性别'
from students;

# 内连接
select * from a inner join b on a.id > b. id;

#相等连接
select * from a inner join b on a.id = b.id;

select * from students where student_major regexp '物';

select * from students where student_major regexp '自动化专业|计算机专业';

select * from students where student_age regexp '[3-5]';

select * from students where student_name regexp '[园]{2}';

select student_major, count(*) as '总人数' from students
group by student_major
having count(*) >= 2;

select student_major, count(*) as '总人数' from students
group by student_major
having 总人数 >= 2;

# 查找从第二个学生（包括第二个学生）开始的三个学生的信息
select * from students
limit 1, 3;

# 和前面的等价
select * from students
limit 3 offset 1;

# 联合查询	
select student_name, student_major,student_sex from students where student_major = '物理专业'
union
select student_name, student_major,student_sex from students where student_sex = '1';

# 索引	
create index index_students
on students(student_name(3) ASC);

# 使用BTREE的索引类型创建索引
create index index_stud
on students(student_id, student_name)
using btree;	

# 创建表的同时创建索引	
create table course
(
course_id int not null,
course_name char(50) not null,
course_place char(50) null,
course_teacher char(50) null,
primary key(course_id),
index index_course(course_name)
);	

# 修改表的时候添加索引
alter table course
add index index_place(course_place);	
	
# 删除索引要用on指定表名
drop index index_place on course;	

#视图	
create or replace view students_view
as
select student_name, student_major,student_age,student_sex
from students
where student_sex = '0'
with check option;	
	
alter view students_view 
as
select * from students
with check option;

show create view students_view;
	
drop view students_view;	
	
# 参照完整性	
create table grades
(
grade_id int not null auto_increment,
grade_obj char(50) not null,
grade_score int not null,
grade_time int not null,
student_id int not null,
primary key(grade_id),
foreign key(student_id) references students(student_id)
on delete restrict 
on update restrict
);	
	
# 用户定义完整性
create table grades_new
(
grade_id int not null auto_increment,
grade_obj char(50) not null,
grade_score int not null,
grade_time int not null,
student_id int not null,
primary key(grade_id),
check(student_id in (select student_id from students))
);	
	
create table grades_new_two
(
grade_id int not null auto_increment,
grade_obj char(50) not null,
grade_score int not null,
grade_time int not null,
student_id int not null,
primary key(grade_id),
check(grade_score > 0 and grade_score <= 100)
);	
	
# 命名完整性约束	
create table grades_new_three
(
grade_id int not null auto_increment,
grade_obj char(50) not null,
grade_score int not null,
grade_time int not null,
student_id int not null,
constraint PRIMARY_KEY_GRADES primary key(grade_id),
constraint FOREIGN_KEY_GRADES foreign key(student_id) references students(student_id) 
on delete restrict 
on update restrict
);		
	
# 表维护语句
# 更新数据库mytest中students的索引散列程度
analyze table mytest;
show index from students;	
	
# 计算并获取校验和
checksum table students;	

# 检查一个或多个表是否有错误
check table students, grades;

# 查阅数据库mytest中表students的相关检查信息
select table_name, check_time from information_schema
where table_name = 'students'
and table_schema = 'mytest';

# 优化数据库，整理碎片
optimize no_write_to_binlog table students;

### MySQL的数据库编程
# 触发器
# 创建触发器
create trigger student_insert after insert
on students
for each row set @str = 'add a new student';

insert into students
values
(NULL, '王媛', '1', '22', '生物专业', NULL);
	
# 查看用户变量str
select @str;	

# 查看触发器
show triggers;

# 删除触发器
drop trigger if exists student_insert;

# insert 触发器 NEW虚拟表
create trigger mytest.students_insert
    -> after insert
    -> on
    -> mytest.students
    -> for each row
    -> set @str = NEW.student_id;
	
# update 触发器 NEW，OLD虚拟表
create trigger students_update
    -> before update
    -> on students
    -> for each row set NEW.student_age = OLD.student_age + 1;

# delete 触发器 OLD 虚拟表

### 事件
# 查看当前是否已开启事件调度器
show variables like 'event_scheduler';
# 或查看系统变量event_scheduler
select @@event_scheduler;

# 打开事件调度器
set global event_scheduler = true;

create event if not exists event_add
    -> on schedule every 1 month
    -> do
    -> insert into students
    -> values
    -> (NULL, '王维', '0', '24', '自动化专业', NULL);

# 临时关闭事件
alter event event_add disable;
# 再次开启关闭的事件
alter event event_add enable;	
	
alter event event_add rename to event_new;	
	
drop event if exists event_new;	
	
# 创建存储过程
	
# 修改结束命令字符
delimiter ??
create procedure update_name(IN cid int, IN cname char(50))
begin
update students set student_name = cname where student_id = cid;
end??	
	
show create procedure update_name;	
	
# 调用存储过程
delimiter ;
call update_name(1320, '张泽志');
	
# 声明一个字符串局部变量
declare xname varchar(5) default '李明';	
	
# 为局部变量赋值
set xname = '王杰';

select id, data into x, y from test.t1 limit 1;	
	
delimiter ??
create procedure sp_count(OUT rows int)
begin
select count(*) into rows from students;
end ??	
	
call sp_count(@rows);	
select @rows;	
	
drop procedure if exists update_name;	

# 存储过程/函数与游标
use test; # 切换test数据库

drop procedure if exists useCursor;

delimiter ??
create procedure useCursor()
begin
declare tmpName varchar(20) default '';
declare allName varchar(255) default '';
declare cur1 cursor for select name from test.level;
# 循环使用变量tmpName，为null跳出循环。
declare continue handler for sqlstate '02000' set tmpName = null; 
open cur1;
fetch cur1 into tmpName;
while(tmpName is not null) do
set tmpName = concat(tmpName, ';');
set allName = concat(allName, tmpName);
fetch cur1 into tmpName;
end while;
close cur1;
select allName;
end??
	
# 存储函数
delimiter ??
create function fn_search(cid int)
returns char(50)
deterministic
begin
declare name char(50);
select student_name into name from students where student_id = cid;
if name is null then
return(select('没有学生的信息'));
else
return(name);
end if;
end ??	
	
# 调用存储函数
select fn_search(1320);	
	
drop function if exists fn_search;	
	
# 创建用户账号
create user 'zhangsan'@'localhost' identified by '123'; 

drop zhangsan@localhost;	
	
# 修改用户账号
rename user 'zhangsan'@'localhost' to 'wanghong'@'localhost';

# 修改用户口令
set password for 'wanghong'@'localhost'
= password('123456');

# 查看用户的权限
show grants for 'wanghong'@'localhost';

grant select, update
on mytest.students
to 'liming'@'localhost' identified by '123',
'huang'@'localhost' identified by '789';

grant all
on mytest.*
to 'wanghong'@'localhost';

grant create user
on *.*
to 'wanghong'@'localhost';

grant select, update
on mytest.students
to 'stard'@'localhost' identified by '123'
with grant option;

# 限制权限
grant select
on mytest.students
to 'wanghong'@'localhost'
with max_queries_per_hour 1;

revoke select
on mytest.students
from 'stard'@'localhost';

## 备份与恢复
select * from mytest.students
into outfile 'D:/wamp64/tmp/bulfile.txt'
fields terminated by ','
optionally enclosed by '"'
lines terminated by '?';

load data infile 'D:/wamp64/tmp/bulfile.txt'
into table mytest.students_copy
fields terminated by ','
optionally enclosed by '"'
lines terminated by '?';

# 使用mysqldump备份数据


create view V_选课
as
select 姓名,选课.课程名称,课程学分,成绩
from 学生,课程, 选课
where 学生.学号 = 选课.学号
and 选课.课程名称 = 课程.课程名称
and 学生.学院名称 = '信息学院';

alter table 选课 add constraint FK_XH foreign key(学号) references 学生(学号);

create function fn_学分(course_name varchar(20))
returns int
deterministic
begin
declare score int;
select 课程学分 into score from 课程 where 课程名称 = course_name;
return(score);
end ??

# 备份表
mysqldump -h localhost -uroot -p mytest students > C:\BACKUP\file.sql

# 备份数据库
mysqldump -uroot -p --databases mytest > C:\BACKUP\data.sql

# 备份整个数据库系统
mysqldump -uroot -p --all-databases > C:\BACKUP\all.sql

# mysql恢复数据
mysql -uroot -p mytest < C:\BACKUP\data.sql

# mysqlimport 恢复数据
mysqlimport -uroot -p --low-priority --replace mytest C:\BACKUP\data.sql

# 把二进制文件保存到一个文本文件中
mysqlbinlog my_log.000001 > C:\BACKUP\my_log.000001.txt

# 使用二进制日志文件恢复数据
mysqlbinlog my_log.000001 | mysql -u root -p

# 删除二进制文件
purge master logs to 'my_log.000001';
