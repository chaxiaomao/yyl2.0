/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2019/6/16 10:20:28                           */
/*==============================================================*/


drop index Index_1 on c2_lottery_prize;

drop table if exists c2_lottery_prize;

drop index Index_2 on c2_lottery_prize_rs;

drop index Index_1 on c2_lottery_prize_rs;

drop table if exists c2_lottery_prize_rs;

drop index Index_3 on c2_lottery_record;

drop index Index_2 on c2_lottery_record;

drop index Index_1 on c2_lottery_record;

drop table if exists c2_lottery_record;

/*==============================================================*/
/* Table: c2_lottery_prize                                      */
/*==============================================================*/
create table c2_lottery_prize
(
   id                   bigint not null auto_increment,
   type                 tinyint(4) default 0,
   name                 varchar(255),
   "label"              varchar(255),
   lottery_id           bigint,
   code                 varchar(255),
   store_number         int(9) default 0,
   position             int,
   status               tinyint default 1,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_lottery_prize
(
   lottery_id
);

/*==============================================================*/
/* Table: c2_lottery_prize_rs                                   */
/*==============================================================*/
create table c2_lottery_prize_rs
(
   id                   bigint not null auto_increment,
   prize_id             bigint default 0,
   lottery_id           bigint,
   chance               decimal(10,2) default 0,
   position             int,
   status               tinyint default 1,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_lottery_prize_rs
(
   lottery_id
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_lottery_prize_rs
(
   prize_id
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

