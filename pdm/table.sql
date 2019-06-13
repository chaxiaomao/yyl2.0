/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2019/6/13 星期四 上午 11:44:54                    */
/*==============================================================*/


drop index Index_5 on c2_gift_order;

drop index Index_4 on c2_gift_order;

drop index Index_3 on c2_gift_order;

drop index Index_2 on c2_gift_order;

drop index Index_1 on c2_gift_order;

drop table if exists c2_gift_order;

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
   gift_name            varchar(255),
   obtain_score         decimal(10,2) default 0,
   obtain_vote_number   int(11),
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

