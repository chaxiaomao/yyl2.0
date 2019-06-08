/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2019/6/9 0:09:16                             */
/*==============================================================*/


drop index Index_3 on c2_activity_player;

drop index Index_2 on c2_activity_player;

drop index Index_1 on c2_activity_player;

drop table if exists c2_activity_player;

drop index Index_3 on c2_activity_player_message;

drop index Index_2 on c2_activity_player_message;

drop index Index_1 on c2_activity_player_message;

drop table if exists c2_activity_player_message;

drop index Index_4 on c2_activity_player_vote_record;

drop index Index_3 on c2_activity_player_vote_record;

drop index Index_2 on c2_activity_player_vote_record;

drop index Index_1 on c2_activity_player_vote_record;

drop table if exists c2_activity_player_vote_record;

drop index Index_5 on c2_gift_order;

drop index Index_4 on c2_gift_order;

drop index Index_3 on c2_gift_order;

drop index Index_2 on c2_gift_order;

drop index Index_1 on c2_gift_order;

drop table if exists c2_gift_order;

/*==============================================================*/
/* Table: c2_activity_player                                    */
/*==============================================================*/
create table c2_activity_player
(
   id                   bigint not null auto_increment,
   type                 int default 1,
   user_id              bigint,
   income_number        decimal(10,2) default 0.00,
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
/* Table: c2_activity_player_message                            */
/*==============================================================*/
create table c2_activity_player_message
(
   id                   bigint not null auto_increment,
   type                 tinyint(4) default 1,
   activity_player_id   bigint,
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
create index Index_1 on c2_activity_player_message
(
   user_id
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_activity_player_message
(
   activity_player_id
);

/*==============================================================*/
/* Index: Index_3                                               */
/*==============================================================*/
create index Index_3 on c2_activity_player_message
(
   reply_id
);

/*==============================================================*/
/* Table: c2_activity_player_vote_record                        */
/*==============================================================*/
create table c2_activity_player_vote_record
(
   id                   bigint not null auto_increment,
   type                 tinyint(4) default 1,
   user_id              bigint,
   activity_player_id   bigint,
   vote_number          int(9) default 0,
   gift_id              bigint,
   order_id             bigint,
   remote_ip            varchar(255),
   state                tinyint default 1,
   status               tinyint default 1,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_activity_player_vote_record
(
   user_id
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_activity_player_vote_record
(
   activity_player_id
);

/*==============================================================*/
/* Index: Index_3                                               */
/*==============================================================*/
create index Index_3 on c2_activity_player_vote_record
(
   gift_id
);

/*==============================================================*/
/* Index: Index_4                                               */
/*==============================================================*/
create index Index_4 on c2_activity_player_vote_record
(
   order_id
);

/*==============================================================*/
/* Table: c2_gift_order                                         */
/*==============================================================*/
create table c2_gift_order
(
   id                   bigint not null auto_increment,
   name                 int default 0,
   label              varchar(255),
   code                 varchar(255) default '0',
   customer_id          bigint,
   pay_method           tinyint(4),
   activity_id          bigint,
   activity_player_id   bigint,
   discount_rate        decimal(10,2) default 0.00,
   discount_money       decimal(10,2) default 0.00,
   score                int(11),
   remote_ip            varchar(255),
   memo                 varchar(255),
   pay_price            decimal(10,2) default 0.00,
   src_type             tinyint(4) default 1,
   state                tinyint(4) default 1,
   status               tinyint(4) default 1,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_gift_order
(
   customer_id
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_gift_order
(
   activity_player_id
);

/*==============================================================*/
/* Index: Index_3                                               */
/*==============================================================*/
create index Index_3 on c2_gift_order
(
   code
);

/*==============================================================*/
/* Index: Index_4                                               */
/*==============================================================*/
create index Index_4 on c2_gift_order
(
   activity_id
);

/*==============================================================*/
/* Index: Index_5                                               */
/*==============================================================*/
create index Index_5 on c2_gift_order
(
   created_at
);

