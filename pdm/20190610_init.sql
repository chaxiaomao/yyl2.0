/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2019/6/10 星期一 下午 3:41:50                     */
/*==============================================================*/


drop index Index_3 on c2_activity;

drop index Index_2 on c2_activity;

drop index Index_1 on c2_activity;

drop table if exists c2_activity;

drop index Index_1 on c2_activity_music;

drop table if exists c2_activity_music;

drop index Index_5 on c2_activity_player;

drop index Index_4 on c2_activity_player;

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

drop index Index_7 on c2_fe_user;

drop index Index_6 on c2_fe_user;

drop index Index_5 on c2_fe_user;

drop index Index_4 on c2_fe_user;

drop index Index_3 on c2_fe_user;

drop index Index_2 on c2_fe_user;

drop index Index_1 on c2_fe_user;

drop table if exists c2_fe_user;

drop index Index_1 on c2_fe_user_profile;

drop table if exists c2_fe_user_profile;

drop index Index_1 on c2_gift;

drop table if exists c2_gift;

drop index Index_5 on c2_gift_order;

drop index Index_4 on c2_gift_order;

drop index Index_3 on c2_gift_order;

drop index Index_2 on c2_gift_order;

drop index Index_1 on c2_gift_order;

drop table if exists c2_gift_order;

drop index Index_1 on c2_luck_draw;

drop table if exists c2_luck_draw;

drop index Index_3 on c2_luck_draw_lottery_record;

drop index Index_2 on c2_luck_draw_lottery_record;

drop index Index_1 on c2_luck_draw_lottery_record;

drop table if exists c2_luck_draw_lottery_record;

drop index Index_1 on c2_order_daily_statics;

drop table if exists c2_order_daily_statics;

drop index Index_1 on c2_prize;

drop table if exists c2_prize;

drop index Index_1 on c2_user_score;

drop table if exists c2_user_score;

drop index Index_1 on c2_user_score_record;

drop table if exists c2_user_score_record;

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
   vote_number_limit    tinyint(100) default 1,
   area_limit           bigint,
   share_number         int(11) default 0,
   vote_number          int(11) default 0,
   view_number          int(11) default 0,
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
/* Table: c2_activity_music                                     */
/*==============================================================*/
create table c2_activity_music
(
   id                   bigint not null auto_increment,
   type                 tinyint(4) default 1,
   name                 varchar(255),
   "label"              varchar(255),
   activity_id          bigint,
   url                  varchar(255),
   position             int(9) default 0,
   status               tinyint default 1,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_activity_music
(
   activity_id
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
   "label"              varchar(255),
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
/* Table: c2_fe_user                                            */
/*==============================================================*/
create table c2_fe_user
(
   id                   bigint not null auto_increment,
   type                 int default 0,
   score                int,
   attributeset_id      bigint default 0,
   username             varchar(255) not null,
   email                varchar(255),
   password_hash        varchar(255),
   auth_key             varchar(255),
   confirmed_at         datetime,
   unconfirmed_email    varchar(255),
   blocked_at           datetime,
   registration_ip      varchar(255),
   registration_src_type tinyint default 100,
   flags                int,
   level                tinyint,
   last_login_at        datetime,
   last_login_ip        varchar(255),
   open_id              varchar(255),
   wechat_union_id      varchar(255),
   wechat_open_id       varchar(255),
   mobile_number        varchar(255),
   sms_receipt          varchar(255),
   access_token         varchar(255),
   password_reset_token varchar(255),
   district_id          bigint,
   province_id          bigint default 0,
   city_id              bigint default 0,
   created_by           bigint default 0,
   updated_by           bigint default 0,
   status               tinyint default 1,
   position             int default 0,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_fe_user
(
   username
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_fe_user
(
   email
);

/*==============================================================*/
/* Index: Index_3                                               */
/*==============================================================*/
create index Index_3 on c2_fe_user
(
   type
);

/*==============================================================*/
/* Index: Index_4                                               */
/*==============================================================*/
create index Index_4 on c2_fe_user
(
   open_id
);

/*==============================================================*/
/* Index: Index_5                                               */
/*==============================================================*/
create index Index_5 on c2_fe_user
(
   wechat_open_id
);

/*==============================================================*/
/* Index: Index_6                                               */
/*==============================================================*/
create index Index_6 on c2_fe_user
(
   access_token,
   status
);

/*==============================================================*/
/* Index: Index_7                                               */
/*==============================================================*/
create index Index_7 on c2_fe_user
(
   mobile_number
);

/*==============================================================*/
/* Table: c2_fe_user_profile                                    */
/*==============================================================*/
create table c2_fe_user_profile
(
   id                   bigint not null auto_increment,
   user_id              bigint,
   name                 varchar(255),
   wechat_number        varchar(255),
   public_email         varchar(255),
   gravatar_email       varchar(255),
   gravatar_id          varchar(255),
   location             varchar(255),
   website              varchar(255),
   bio                  text,
   timezone             varchar(255),
   firstname            varchar(255),
   lastname             varchar(255),
   birthday             datetime,
   avatar               varchar(255),
   id_number            varchar(255),
   address              varchar(255),
   terms                tinyint default 0,
   qr_code              varchar(255),
   qr_code_image        varchar(255),
   status               tinyint default 1,
   position             int default 0,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_fe_user_profile
(
   user_id
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

/*==============================================================*/
/* Table: c2_gift_order                                         */
/*==============================================================*/
create table c2_gift_order
(
   id                   bigint not null auto_increment,
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

/*==============================================================*/
/* Table: c2_luck_draw                                          */
/*==============================================================*/
create table c2_luck_draw
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
create index Index_1 on c2_luck_draw
(
   activity_id
);

/*==============================================================*/
/* Table: c2_luck_draw_lottery_record                           */
/*==============================================================*/
create table c2_luck_draw_lottery_record
(
   id                   bigint not null auto_increment,
   type                 tinyint(4) default 1,
   code                 varchar(255),
   user_id              bigint,
   luck_draw_id         bigint,
   prize_id             bigint,
   state                tinyint(4) default 1,
   status               tinyint(4) default 1,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_luck_draw_lottery_record
(
   user_id
);

/*==============================================================*/
/* Index: Index_2                                               */
/*==============================================================*/
create index Index_2 on c2_luck_draw_lottery_record
(
   luck_draw_id
);

/*==============================================================*/
/* Index: Index_3                                               */
/*==============================================================*/
create index Index_3 on c2_luck_draw_lottery_record
(
   prize_id
);

/*==============================================================*/
/* Table: c2_order_daily_statics                                */
/*==============================================================*/
create table c2_order_daily_statics
(
   id                   bigint not null auto_increment,
   total_income         decimal(10,2) default 0.00,
   start_at             datetime,
   end_at               datetime,
   status               tinyint(4) default 1,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_order_daily_statics
(
   start_at
);

/*==============================================================*/
/* Table: c2_prize                                              */
/*==============================================================*/
create table c2_prize
(
   id                   bigint not null auto_increment,
   type                 tinyint(4) default 0,
   name                 bigint,
   "label"              varchar(255),
   luck_draw_id         bigint,
   drawn_rate           tinyint(100) default 0,
   code                 varchar(255),
   store_number         int(9) default 0,
   status               tinyint default 1,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_prize
(
   luck_draw_id
);

/*==============================================================*/
/* Table: c2_user_score                                         */
/*==============================================================*/
create table c2_user_score
(
   id                   bigint not null auto_increment,
   user_id              bigint,
   score_number         decimal(10,2),
   status               tinyint default 1,
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_user_score
(
   user_id
);

/*==============================================================*/
/* Table: c2_user_score_record                                  */
/*==============================================================*/
create table c2_user_score_record
(
   id                   bigint not null auto_increment,
   user_score_id        bigint,
   score_num            decimal(10,2),
   status               tinyint(4) default 1,
   state                tinyint(4),
   position             int(11),
   created_at           datetime,
   updated_at           datetime,
   primary key (id)
);

/*==============================================================*/
/* Index: Index_1                                               */
/*==============================================================*/
create index Index_1 on c2_user_score_record
(
   user_score_id
);

