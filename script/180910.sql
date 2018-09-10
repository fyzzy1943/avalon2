set names utf8mb4;
use avalon2;

alter table articles modify column alias varchar(255) not null default '' comment '别名';
