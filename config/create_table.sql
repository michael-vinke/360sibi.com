create database sibi360;

use sibi360;

create table user (
	uid int(5) not null unique auto_increment, 
	username varchar(25) not null,
	password varchar(25) not null,
	primary key(uid)	
)AUTO_INCREMENT=10000;

create table sibi_item (
	sbid int(10) not null unique auto_increment,
	msg varchar(100),
	primary key(sbid)
)AUTO_INCREMENT=1;

create table user_sibi_relation (
	us_rel_id int(10) not null unique auto_increment,
	uid int(5) not null, 
	sbid int(10) not null,
	primary key(us_rel_id, uid, sbid)
)AUTO_INCREMENT=1;

insert into user(username, password) values('fenicesun', '123456');
insert into user(username, password) values('miketang', '123456');
insert into user(username, password) values('ronfang', '123456');
insert into user(username, password) values('karenfu', '123456');


