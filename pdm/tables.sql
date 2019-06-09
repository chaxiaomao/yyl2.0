/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2019/6/9 星期日 下午 3:54:13                      */
/*==============================================================*/


drop index Index_3 on c2_activity;

drop index Index_2 on c2_activity;

drop index Index_1 on c2_activity;

drop table if exists c2_activity;

drop index Index_5 on c2_activity_player;

drop index Index_4 on c2_activity_player;

drop index Index_3 on c2_activity_player;

drop index Index_2 on c2_activity_player;

drop index Index_1 on c2_activity_player;

drop table if exists c2_activity_player;

/*==============================================================*/
/* Table: c2_activity                                           */
/*==============================================================*/
create table c2_activity
(
   id                   bigint not null auto_increment,
   type                 tinyint(4) default 1,
   title                varchar(255),
   label              varchar(255),
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
   seo_code
);

/*==============================================================*/
/* Table: c2_activity_player                                    */
/*==============================================================*/
create table c2_activity_player
(
   id                   bigint not null auto_increment,
   type                 int default 1,
   user_id              bigint,
   income               decimal(10,2) default 0.00,
   activity_id          bigint,
   player_code          varchar(255),
   title                varchar(255),
   label              varchar(255),
   content              text,
   mobile_number        varchar(255),
   free_vote_number     int(11) default 0,
   gift_vote_number     int(11) default 0,
   total_vote_number    int(11) default 0,
   share_number         int(11) default 0,
   view_number          int(11) default 0,
   state                tinyint default 1,
   status               tinyint default 1,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_activity_player
(
   user_id
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_activity_player
(
   player_code
);

/*==============================================================*/
/* Index: Index_3                                               */
/*==============================================================*/
create index Index_3 on c2_activity_player
(
   title
);

/*==============================================================*/
/* Index: Index_4                                               */
/*==============================================================*/
create index Index_4 on c2_activity_player
(
   activity_id
);

/*==============================================================*/
/* Index: Index_5                                               */
/*==============================================================*/
create index Index_5 on c2_activity_player
(
   mobile_number
);

