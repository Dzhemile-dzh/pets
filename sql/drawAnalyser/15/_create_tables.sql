/*
 * HORSES
 */


-- alter table da_course_distance_override
--    drop constraint fk_da_cours_reference_course
-- go

if exists (select 1
        from sysobjects
        where id = object_id('da_course_distance_override')
            and type = 'U')
    drop table da_course_distance_override
go

/*==============================================================*/
/* Table : da_course_distance_override                          */
/*==============================================================*/
create table da_course_distance_override(
    course_uid smallint not null,
    distance_yards smallint not null,
    distance_yard_to_use int null,
    constraint PK_DA_COURSE_DISTANCE_OVERRIDE primary key (course_uid, distance_yards)
)
go

alter table da_course_distance_override
add constraint FK_DA_COURS_REFERENCE_COURSE foreign key (course_uid)
    references course(course_uid)
go

-- alter table da_override
--    drop constraint FK_DA_OVERR_REFERENCE_COURSE
-- go

if exists (select 1
        from sysobjects
        where id = object_id('da_override')
            and type = 'U')
    drop table da_override
go

/*==============================================================*/
/* Table : da_override                                          */
/*==============================================================*/
create table da_override(
    course_uid smallint not null,
    distance_yards smallint not null,
    constraint PK_DA_OVERRIDE primary key (course_uid, distance_yards)
)
go

alter table da_override
add constraint FK_DA_OVERR_REFERENCE_COURSE foreign key (course_uid)
    references course(course_uid)
go

-- alter table da_flip_data
--    drop constraint fk_da_flip__reference_course
-- go

if exists (select 1
        from sysobjects
        where id = object_id('da_flip_data')
            and type = 'U')
    drop table da_flip_data
go

/*==============================================================*/
/* Table : da_flip_data                                         */
/*==============================================================*/
create table da_flip_data(
    course_uid smallint not null,
    distance_yards smallint not null,
    constraint PK_DA_FLIP_DATA primary key (course_uid, distance_yards)
)
go

alter table da_flip_data
add constraint FK_DA_FLIP__REFERENCE_COURSE foreign key (course_uid)
    references course(course_uid)
go

-- alter table da_config
--    drop constraint fk_da_confi_reference_course
-- go

if exists (select 1
        from sysobjects
        where id = object_id('da_config')
            and type = 'U')
    drop table da_config
go

/*==============================================================*/
/* Table : da_config                                            */
/*==============================================================*/
create table da_config(
    config_uid smallint not null,
    course_uid smallint null,
    config_desc varchar(255) null,
    config_int int null,
    config_char1 char(1) null,
    config_dec62 decimal(6, 2) null,
    config_dec63 decimal(6, 2) null,
    config_varchar255 varchar(255) null,
    constraint PK_DA_CONFIG primary key (config_uid)
)
go

alter table da_config
add constraint FK_DA_CONFI_REFERENCE_COURSE foreign key (course_uid)
    references course(course_uid)
go

-- alter table da_race_significance
--    drop constraint FK_DA_RACE__REFERENCE_RACE_INS
-- go

if exists (select 1
        from sysobjects
        where id = object_id('da_race_significance')
            and type = 'U')
    drop table da_race_significance
go

/*==============================================================*/
/* Table : da_race_significance                                 */
/*==============================================================*/
create table da_race_significance(
    race_instance_uid int not null,
    bias_strength_yn char(1) null,
    rsquare_yn char(1) null,
    num_races_yn char(1) null,
    field_size_yn char(1) null,
    straight_slope_yn char(1) null,
    text_summary varchar(255) null,
    constraint PK_DA_RACE_SIGNIFICANCE primary key (race_instance_uid)
)
go

alter table da_race_significance
add constraint FK_DA_RACE__REFERENCE_RACE_INS foreign key (race_instance_uid)
    references race_instance(race_instance_uid)
go

-- alter table da_overnight_data
--    drop constraint FK_DA_OVERN_REFERENCE_RACE_INS
-- go

if exists (select 1
        from sysindexes
        where id = object_id('da_overnight_data')
            and name = 'da_overnight_data_idx1'
            and indid > 0
            and indid < 255)
    drop index da_overnight_data.da_overnight_data_idx1
go

if exists (select 1
        from sysobjects
        where id = object_id('da_overnight_data')
            and type = 'U')
    drop table da_overnight_data
go

/*==============================================================*/
/* Table : da_overnight_data                                    */
/*==============================================================*/
create table da_overnight_data(
    race_instance_uid int not null,
    sequence int not null,
    draw int not null,
    y_temp decimal(6, 3) not null,
    y_norm_length decimal(6, 3) not null,
    y_norm_pound decimal(6, 3) not null,
    y_norm_going decimal(6, 3) not null,
    constraint PK_DA_OVERNIGHT_DATA primary key (race_instance_uid, sequence, draw)
)
go

/*==============================================================*/
/* Index: da_overnight_data_idx1                                */
/*==============================================================*/
create index da_overnight_data_idx1 on da_overnight_data(
    race_instance_uid asc
)
go

alter table da_overnight_data
add constraint FK_DA_OVERN_REFERENCE_RACE_INS foreign key (race_instance_uid)
    references race_instance(race_instance_uid)
go

