/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2019/6/10 星期一 下午 3:09:02                     */
/*==============================================================*/


drop index Index_3 on c2_activity;

drop index Index_2 on c2_activity;

drop index Index_1 on c2_activity;

drop table if exists c2_activity;

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
   vote_nubmer_limit    tinyint(100) default 1,
   area_limit           bigint,
   share_number         int(11) default 0,
   vote_number          char(10),
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

