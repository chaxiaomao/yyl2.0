/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2019/6/8 19:01:45                            */
/*==============================================================*/


drop index Index_4 on c2_activity;

drop index Index_3 on c2_activity;

drop index Index_2 on c2_activity;

drop index Index_1 on c2_activity;

drop table if exists c2_activity;

drop index Index_3 on c2_activity_entrance_message;

drop index Index_2 on c2_activity_entrance_message;

drop index Index_1 on c2_activity_entrance_message;

drop table if exists c2_activity_entrance_message;

drop index Index_1 on c2_gift;

drop table if exists c2_gift;

/*==============================================================*/
/* Table: c2_activity                                           */
/*==============================================================*/
create table c2_activity
(
   id                   bigint not null auto_increment,
   type                 tinyint(4) default 1,
   title                varchar(255),
   "label"              varchar(255),
   content              text,
   seo_code             varchar(255),
   start_at             datetime,
   end_at               datetime,
   vote_freq            tinyint(100) default 1,
   area_limit           bigint,
   share_number         int(11) default 0,
   income               decimal(10,2) default 0.00,
   is_open_draw         tinyint(4) default 0,
   is_check             tinyint(4) default 0,
   start_id             bigint default 0,
   created_by           bigint,
   updated_by           bigint,
   is_released          tinyint(4) default 1,
   status               tinyint(4) default 1,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_activity
(
   title
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_activity
(
   start_id
);

/*==============================================================*/
/* Index: Index_3                                               */
/*==============================================================*/
create index Index_3 on c2_activity
(
   created_by
);

/*==============================================================*/
/* Index: Index_4                                               */
/*==============================================================*/
create index Index_4 on c2_activity
(
   updated_by
);

/*==============================================================*/
/* Table: c2_activity_entrance_message                          */
/*==============================================================*/
create table c2_activity_entrance_message
(
   id                   bigint not null auto_increment,
   type                 tinyint(4) default 1,
   activity_entrance_id bigint,
   user_id              bigint,
   content              text,
   reply_id             bigint default 0,
   state                tinyint(4) default 1,
   status               tinyint(4) default 1,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_activity_entrance_message
(
   user_id
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_activity_entrance_message
(
   activity_entrance_id
);

/*==============================================================*/
/* Index: Index_3                                               */
/*==============================================================*/
create index Index_3 on c2_activity_entrance_message
(
   reply_id
);

/*==============================================================*/
/* Table: c2_gift                                               */
/*==============================================================*/
create table c2_gift
(
   id                   bigint not null auto_increment,
   name                 int default 0,
   "label"              varchar(255),
   activity_id          bigint,
   code                 varchar(255),
   obtain_score         decimal(10,2) default 0,
   obtain_vote_number   int(9) default 0,
   price                decimal(10,2) default 0.00,
   position             tinyint(4) default 0,
   status               tinyint(4) default 1,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_gift
(
   activity_id
);

