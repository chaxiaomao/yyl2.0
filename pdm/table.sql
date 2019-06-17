/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2019/6/17 星期一 上午 9:17:58                     */
/*==============================================================*/


drop index Index_1 on c2_lottery;

drop table if exists c2_lottery;

/*==============================================================*/
/* Table: c2_lottery                                            */
/*==============================================================*/
create table c2_lottery
(
   id                   bigint not null auto_increment,
   type                 tinyint(4),
   name                 varchar(255),
   "label"              varchar(255) default '0',
   activity_id          bigint,
   need_score           tinyint(100) default 0,
   created_by           bigint,
   updated_by           bigint,
   content              text,
   status               tinyint(4) default 1,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_lottery
(
   activity_id
);

