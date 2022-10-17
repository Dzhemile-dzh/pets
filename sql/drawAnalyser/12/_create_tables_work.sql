/*
 * WORK_HORSE
 */

if exists (select 1
        from sysindexes
        where id = object_id('da_course_distance_data')
            and name = 'da_course_distance_data_idx1'
            and indid > 0
            and indid < 255)
    drop index da_course_distance_data.da_course_distance_data_idx1
go

if exists (select 1
        from sysobjects
        where id = object_id('da_course_distance_data')
            and type = 'U')
    drop table da_course_distance_data
go

/*==============================================================*/
/* Table : da_course_distance_data                              */
/*==============================================================*/
create table da_course_distance_data(
    course_uid smallint not null,
    race_type_code char(1) not null,
    distance_yard smallint not null,
    adjusted_draw_prefix char(1) not null,
    grouped_adjusted_draw tinyint not null,
    sr_code char(1) not null,
    grouped_adjusted_draw_suffix char(1) null,
    length_average DECIMAL(6, 2) null,
    smoothed_average DECIMAL(6, 2) null,
    calc_advantage DECIMAL(6, 2) null,
    num_races smallint null,
    pounds DECIMAL(6, 2) null,
    regression_line varchar(40) null,
    intercept decimal(6, 2) null,
    slope decimal(6, 2) null,
    rsquare decimal(6, 3) null,
    median_races decimal(6, 2) null,
    constraint PK_DA_COURSE_DISTANCE_DATA primary key (course_uid, race_type_code, distance_yard, adjusted_draw_prefix, grouped_adjusted_draw, sr_code)
)
go

/*==============================================================*/
/* Index: da_course_distance_data_idx1                          */
/*==============================================================*/
create index da_course_distance_data_idx1 on da_course_distance_data(
    course_uid asc,
    distance_yard asc,
    adjusted_draw_prefix asc,
    sr_code asc
)
go

if exists (select 1
        from sysobjects
        where id = object_id('da_horse_race')
            and type = 'U')
    alter table da_horse_race
    drop constraint FK_DA_HORSE_REFERENCE_DA_RACE_
go

if exists (select 1
        from sysindexes
        where id = object_id('da_race_instance')
            and name = 'race_datetime_idx1'
            and indid > 0
            and indid < 255)
    drop index da_race_instance.race_datetime_idx1
go

if exists (select 1
        from sysobjects
        where id = object_id('da_race_instance')
            and type = 'U')
    drop table da_race_instance
go

/*==============================================================*/
/* Table : da_race_instance                                     */
/*==============================================================*/
create table da_race_instance(
    race_instance_uid int not null,
    race_datetime datetime not null,
    distance_yard smallint not null,
    course_uid smallint not null,
    straight_round_jubilee_code char(1) null,
    going_type_code char(2) null,
    ages_allowed_uid tinyint null,
    race_group_uid tinyint null,
    race_type_code char(1) null,
    race_status_code char(1) not null,
    rp_stalls_position char(1) null,
    runners smallint not null,
    actual_runners smallint not null,
    constraint PK_DA_RACE_INSTANCE primary key (race_instance_uid)
)
go

/*==============================================================*/
/* Index: race_datetime_idx1                                    */
/*==============================================================*/
create index race_datetime_idx1 on da_race_instance(
    race_datetime asc
)
go

if exists (select 1
        from sysindexes
        where id = object_id('da_horse_race')
            and name = 'da_horse_race_idx1'
            and indid > 0
            and indid < 255)
    drop index da_horse_race.da_horse_race_idx1
go

if exists (select 1
        from sysindexes
        where id = object_id('da_horse_race')
            and name = 'da_horse_race_distance_idx'
            and indid > 0
            and indid < 255)
    drop index da_horse_race.da_horse_race_distance_idx
go

if exists (select 1
        from sysobjects
        where id = object_id('da_horse_race')
            and type = 'U')
    drop table da_horse_race
go

/*==============================================================*/
/* Table : da_horse_race                                        */
/*==============================================================*/
create table da_horse_race(
    race_instance_uid int not null,
    course_uid smallint not null,
    sr_code char(1) null,
    going_type_code char(2) null,
    horse_uid int not null,
    outcome_uid tinyint not null,
    odds_uid smallint not null,
    odds_desc varchar(30) not null,
    distance_yards smallint null,
    distance_to_winner_uid smallint not null,
    distance_to_winner_value decimal(6, 2) not null,
    draw tinyint null,
    adjusted_draw_prefix char(1) null,
    adjusted_draw tinyint null,
    grouped_adjusted_draw tinyint null,
    grouped_adjusted_draw_suffix char(1) null,
    constraint PK_DA_HORSE_RACE primary key (race_instance_uid, horse_uid)
)
go

/*==============================================================*/
/* Index: da_horse_race_idx1                                    */
/*==============================================================*/
create index da_horse_race_idx1 on da_horse_race(
    race_instance_uid asc
)
go

/*==============================================================*/
/* Index: da_horse_race_distance_idx                            */
/*==============================================================*/
create index da_horse_race_distance_idx on da_horse_race(
    distance_to_winner_value asc,
    distance_to_winner_uid asc
)
go

alter table da_horse_race
add constraint FK_DA_HORSE_REFERENCE_DA_RACE_ foreign key (race_instance_uid)
    references da_race_instance(race_instance_uid)
go
