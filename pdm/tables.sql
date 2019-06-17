/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2019/6/17 星期一 上午 9:13:53                     */
/*==============================================================*/


drop index Index_1 on c2_lottery;

drop table if exists c2_lottery;

drop table if exists c2_lottery_prize;

drop index Index_3 on c2_lottery_record;

drop index Index_2 on c2_lottery_record;

drop index Index_1 on c2_lottery_record;

drop table if exists c2_lottery_record;

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

/*==============================================================*/
/* Table: c2_lottery_prize                                      */
/*==============================================================*/
create table c2_lottery_prize
(
   id                   bigint not null auto_increment,
   type                 tinyint(4) default 1,
   name                 varchar(255),
   "label"              varchar(255),
   code                 varchar(255),
   store_number         int(9) default 0,
   position             int default 0,
   status               tinyint default 1,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Table: c2_lottery_record                                     */
/*==============================================================*/
create table c2_lottery_record
(
   id                   bigint not null auto_increment,
   type                 tinyint(4) default 1,
   code                 varchar(255),
   user_id              bigint,
   lottery_id           bigint,
   prize_id             bigint,
   lottery_name         varchar(255),
   prize_name           varchar(255),
   state                tinyint(4) default 1,
   status               tinyint(4) default 1,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_lottery_record
(
   user_id
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_lottery_record
(
   lottery_id
);

/*==============================================================*/
/* Index: Index_3                                               */
/*==============================================================*/
create index Index_3 on c2_lottery_record
(
   prize_id
);

