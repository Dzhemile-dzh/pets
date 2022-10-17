use horses
go

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

/*
Generated by SQLBrowser 2014_05 1202 on 19 Nov 2014
*/

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 1, NULL, 'CHK_MEDIAN', 18, NULL, NULL, NULL, NULL
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 2, NULL, 'CHK_NUM_RACES', 18, NULL, NULL, NULL, NULL
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 3, NULL, 'CHK_RSQUARE', NULL, NULL, NULL, 0.15, NULL
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 5, NULL, 'CHK_FIELD_HIGH', 5, NULL, NULL, NULL, NULL
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 6, NULL, 'CHK_FIELD_STRAIGHT_MAX', 19, NULL, NULL, NULL, NULL
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 7, NULL, 'CHK_STRAIGHTS_SLOPE', NULL, NULL, -0.10, NULL, NULL
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 8, NULL, 'CHK_STRAIGHTS_SLOPE_PLUS', NULL, NULL, 0.10, NULL, NULL
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 9, NULL, 'CHK_FAIL_SIG_STRAIGHT_RUNNER', 20, NULL, NULL, NULL, NULL
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 10, NULL, 'CHK_GOING_FACTOR_A', NULL, NULL, 1.00, NULL, NULL
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 11, NULL, 'CHK_GOING_FACTOR_B', NULL, NULL, 1.25, NULL, NULL
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 12, NULL, 'CHK_GOING_FACTOR_C', NULL, NULL, 1.33, NULL, NULL
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 13, NULL, 'CHK_GOING_FACTOR_D', NULL, NULL, 1.66, NULL, NULL
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 14, NULL, 'CHK_STRENGTH_LOW_TEXT', NULL, NULL, NULL, NULL, 'LOW'
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 15, NULL, 'CHK_STRENGTH_HIGH_TEXT', NULL, NULL, NULL, NULL, 'HIGH'
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 16, NULL, 'CHK_SUM_NO_SIG_TXT', NULL, NULL, NULL, NULL, 'NO SIGNIFICANT ADVANTAGE'
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 17, NULL, 'CHK_SUM_INS_TXT', NULL, NULL, NULL, NULL, 'INSUFFICIENT DATA'
)


insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 18, NULL, 'CHK_BIAS_STRENGTH_SLIGHT', NULL, NULL, NULL, 1.49, NULL
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 19, NULL, 'CHK_BIAS_STRENGTH_MIN', NULL, NULL, NULL, 0.5, NULL
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 20, NULL, 'CHK_NUM_RACES_DISTANCE', 3080, NULL, NULL, NULL, NULL
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 21, NULL, 'CHK_NUM_RACES_LONGRUNNERS', 1, NULL, NULL, NULL, NULL
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 22, NULL, 'CHK_NUM_RACES_LONGDRAWS', 8, NULL, NULL, NULL, NULL
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 23, NULL, 'CHK_TXT_SLIGHT', NULL, NULL, NULL, NULL, 'SLIGHT'
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 24, NULL, 'CHK_TXT_STRONG', NULL, NULL, NULL, NULL, 'STRONG'
)

insert da_config(
 config_uid, course_uid, config_desc, config_int, config_char1, config_dec62, config_dec63, config_varchar255
) values (
 25, NULL, 'CHK_TXT_NONE', NULL, NULL, NULL, NULL, 'NONE'
)

go


/*
Generated by SQLBrowser 2014_05 1202 on 24 Nov 2014
*/
insert da_flip_data(
 course_uid, distance_yards
) values (
 5, 2882
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 7, 2189
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 7, 2616
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 12, 1116
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 12, 1336
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 12, 1556
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 12, 1774
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 16, 3520
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 19, 1100
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 19, 1320
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 19, 1540
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 21, 2420
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 21, 2640
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 21, 3520
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 23, 1100
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 23, 1320
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 31, 2526
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 37, 1100
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 37, 1320
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 37, 1540
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 37, 1760
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 40, 1113
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 40, 1335
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 80, 2640
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 93, 2207
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 93, 2555
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 107, 1189
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 394, 1100
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 513, 1572
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 1212, 1100
)

insert da_flip_data(
 course_uid, distance_yards
) values (
 1212, 1320
)

go


/*
Generated by SQLBrowser 2014_05 1202 on 24 Nov 2014
*/
insert da_course_distance_override(
 course_uid, distance_yards, distance_yard_to_use
) values (
 3, 1980, 2000
)

insert da_course_distance_override(
 course_uid, distance_yards, distance_yard_to_use
) values (
 5, 2200, 2246
)

insert da_course_distance_override(
 course_uid, distance_yards, distance_yard_to_use
) values (
 8, 2626, 2527
)

insert da_course_distance_override(
 course_uid, distance_yards, distance_yard_to_use
) values (
 13, 1210, 1338
)

insert da_course_distance_override(
 course_uid, distance_yards, distance_yard_to_use
) values (
 13, 2499, 2275
)

insert da_course_distance_override(
 course_uid, distance_yards, distance_yard_to_use
) values (
 13, 3171, 2949
)

insert da_course_distance_override(
 course_uid, distance_yards, distance_yard_to_use
) values (
 15, 1240, 1100
)

insert da_course_distance_override(
 course_uid, distance_yards, distance_yard_to_use
) values (
 15, 1430, 1320
)

insert da_course_distance_override(
 course_uid, distance_yards, distance_yard_to_use
) values (
 30, 1769, 1820
)

insert da_course_distance_override(
 course_uid, distance_yards, distance_yard_to_use
) values (
 47, 2420, 2200
)

insert da_course_distance_override(
 course_uid, distance_yards, distance_yard_to_use
) values (
 49, 1980, 1760
)

insert da_course_distance_override(
 course_uid, distance_yards, distance_yard_to_use
) values (
 85, 1210, 1320
)

insert da_course_distance_override(
 course_uid, distance_yards, distance_yard_to_use
) values (
 107, 3080, 3057
)

insert da_course_distance_override(
 course_uid, distance_yards, distance_yard_to_use
) values (
 107, 3608, 3498
)

go

use work_horse
go

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

use horses
go

if OBJECT_ID('dbo.sp_da_step1_sub1') is not null
begin
    drop procedure dbo.sp_da_step1_sub1
    if OBJECT_ID('dbo.sp_da_step1_sub1') is not null
        print '<<< FAILED DROPPING PROCEDURE dbo.sp_da_step1_sub1 >>>'
    else
        print '<<< DROPPED PROCEDURE dbo.sp_da_step1_sub1 >>>'
end
go
create procedure dbo.sp_da_step1_sub1
as

/*
EXEC da_step1_sub1

this procedure gets the da_horse_race5 races where the sum of distance to winners is 0 and recalculates the distance from horses..horse_race as it's using dist_to_horse_in_front

*/

--declare vars
declare @c_race_instance_uid integer
    , @c_horse_uid integer
    , @c_draw tinyint
 --            ,@c_distance_to_winner_uid      integer
 --            ,@c_distance_to_winner_value    decimal(6,2)
    , @c_dist_to_horse_in_front_uid integer
    , @c_distance_value decimal(6, 2)
    , @c_outcome_uid integer
    , @a_sum_distance decimal(6, 2)
    , @race_check integer
    , @row_exists integer
    , @race_batch_count integer
    , @race_batch_limit integer

select
    race_instance_uid,
    count(distance_to_winner_value) as thesum
into #work_races
from work_horse..da_horse_race
where
    distance_to_winner_value = 0
    and distance_to_winner_uid != 617 --deadheat
group by race_instance_uid
having count(distance_to_winner_value) > 1

create index #da_work_races_idx1 on #work_races(
    race_instance_uid
)

--problematic races
--367971 deadheat
--388505 deadheat
--440062 deadheat
--521512 deadheat
--586348 deadheat

select @race_check = 0
    , @race_batch_limit = 500
    , @race_batch_count = 0

declare course_distance_cursor
cursor for
--select rows from horses_horse_race in order to get correct distance
--as da_horse_race has deleted horses beaten by more than 15 lengths
    select hr.race_instance_uid
        , hr.horse_uid
        , hr.draw
        , case
            when hr.dist_to_horse_in_front_uid is null
            then 1
            else hr.dist_to_horse_in_front_uid
        end as dist_to_horse_in_front_uid
        , dth.distance_value
        , hr.final_race_outcome_uid
    from
        horse_race hr
        , dist_to_horse dth
    where
        dth.dist_to_horse_uid = (
        case
            when hr.dist_to_horse_in_front_uid is null
            then 1
            else hr.dist_to_horse_in_front_uid
        end
        )
        and hr.final_race_outcome_uid not in (60, 61, 62)
        and exists (select 1 from #work_races wr where wr.race_instance_uid = hr.race_instance_uid)
    order by
        race_instance_uid
        , final_race_outcome_uid asc
for read only

open course_distance_cursor

while (1 = 1)
begin
    fetch course_distance_cursor
    into @c_race_instance_uid
        , @c_horse_uid
        , @c_draw
        , @c_dist_to_horse_in_front_uid
        , @c_distance_value
        , @c_outcome_uid

    if (@@sqlstatus <> 0)
        break

    if (@race_check != @c_race_instance_uid)
    begin
        select @a_sum_distance = 0.00
        select @race_check = @c_race_instance_uid
        select @race_batch_count = @race_batch_count + 1
        if (@race_batch_count > @race_batch_limit)
        begin
            select 'Batch done. Races fixed: ', @race_batch_count
            return
        end
    end

    select @a_sum_distance = @a_sum_distance + @c_distance_value

    select @row_exists = 0
    select @row_exists = (
            select count(1)
            from work_horse..da_horse_race
            where race_instance_uid = @c_race_instance_uid
                and horse_uid = @c_horse_uid
                and draw = @c_draw
            )
    if (@row_exists > 0)
    begin

        if (@a_sum_distance >= 15.00)
        begin
            delete from work_horse..da_horse_race
            where race_instance_uid = @c_race_instance_uid
                and horse_uid = @c_horse_uid
                and draw = @c_draw
        end
        else
        begin
            update work_horse..da_horse_race
            set distance_to_winner_value = @a_sum_distance
            where race_instance_uid = @c_race_instance_uid
                and horse_uid = @c_horse_uid
                and draw = @c_draw
        end
    end

end
close course_distance_cursor
deallocate cursor course_distance_cursor
--------------------------------------------------------
go
if OBJECT_ID('dbo.sp_da_step1_sub1') is not null
    print '<<< CREATED PROCEDURE dbo.sp_da_step1_sub1 >>>'
else
    print '<<< FAILED CREATING PROCEDURE dbo.sp_da_step1_sub1 >>>'
go
grant execute on dbo.sp_da_step1_sub1 to level1
go
if OBJECT_ID('dbo.sp_da_step2_sub1') is not null
begin
    drop procedure dbo.sp_da_step2_sub1
    if OBJECT_ID('dbo.sp_da_step2_sub1') is not null
        print '<<< FAILED DROPPING PROCEDURE dbo.sp_da_step2_sub1 >>>'
    else
        print '<<< DROPPED PROCEDURE dbo.sp_da_step2_sub1 >>>'
end
go
create procedure dbo.sp_da_step2_sub1
    @in_course_uid smallint,
    @in_distance_yard smallint,
    @in_adjusted_draw_prefix char(1),
    @in_sr_code char(1)
as

declare @course_uid integer
    , @distance_yard integer
    , @adjusted_draw_prefix char(1)
    , @sr_code char(1)
    , @grouped_adjusted_draw tinyint
    , @length_average decimal(6, 2)
    , @smoothed_average decimal(6, 2)
    , @calc_advantage decimal(6, 2)
    , @max_gad tinyint
    , @min_gad integer
    , @x_this_gad tinyint
    , @x_median decimal(6, 2)
    , @x_average decimal(6, 2)
    , @x_advantage decimal(6, 2)
    , @x_former_curr_val decimal(6, 2)
    , @x_former_prev_val decimal(6, 2)
    , @x_former_next_val decimal(6, 2)
    , @x_this_val decimal(6, 2)
    , @x_sum decimal(6, 2)
    , @x_lastsum decimal(6, 2)
--    , @x_calc_adv decimal(6, 2)
    , @x_count decimal(6, 2)
    , @no_rows decimal(6, 2)
    , @get_row_one integer
    , @get_row_two integer

--KS MEDIAN
select
    id = identity (5)
    , num_races
into #tab1
from
    work_horse..da_course_distance_data
where
    course_uid = @in_course_uid
    and distance_yard = @in_distance_yard
    and adjusted_draw_prefix = @in_adjusted_draw_prefix
    and sr_code = @in_sr_code
order by num_races

select @no_rows = count(1) from #tab1

if (@no_rows / 2 = round(@no_rows / 2, 0))
begin
    --odd
    select @get_row_one = round(@no_rows / 2, 0)
        , @get_row_two = round(@no_rows / 2, 0) + 1
end
else
begin
    --even
    select @get_row_one = round(@no_rows / 2, 0)
        , @get_row_two = round(@no_rows / 2, 0)
end

select @x_median = (
        select (sum(num_races) / 2.0)
        from #tab1
        where id in (@get_row_one, @get_row_two)
        )
--KS MEDIAN

--SELECT      @x_median

select @x_count = (
        select count(dacd.grouped_adjusted_draw)
        from work_horse..da_course_distance_data dacd
        where dacd.course_uid = @in_course_uid
            and dacd.distance_yard = @in_distance_yard
            and dacd.adjusted_draw_prefix = @in_adjusted_draw_prefix
            and dacd.sr_code = @in_sr_code
        )

if (@x_count = 0)
begin
    select 'division by zero :-/ (mismatch on ri.distance_yard and t.distance_yard'
        , @in_course_uid
        , @in_distance_yard
        , @in_adjusted_draw_prefix
        , @in_sr_code
    select @x_count = 0.01 --temp fix to not break batch
end

select @max_gad = max(dacd.grouped_adjusted_draw)
    , @min_gad = min(dacd.grouped_adjusted_draw)
    , @x_average = round((sum(dacd.length_average) / count(@x_count)), 2)
from work_horse..da_course_distance_data dacd
where dacd.course_uid = @in_course_uid
    and dacd.distance_yard = @in_distance_yard
    and dacd.adjusted_draw_prefix = @in_adjusted_draw_prefix
    and dacd.sr_code = @in_sr_code

declare cursor_each_course_distance
cursor for
    select
        course_uid
        , distance_yard
        , adjusted_draw_prefix
        , sr_code
        , grouped_adjusted_draw
        , length_average
        , smoothed_average
        , calc_advantage
        , (
            select max(dacd.grouped_adjusted_draw)
            from work_horse..da_course_distance_data dacd
            where dacd.course_uid = @in_course_uid
                and dacd.distance_yard = @in_distance_yard
                and dacd.adjusted_draw_prefix = @in_adjusted_draw_prefix
                and dacd.sr_code = @in_sr_code
            ) as max_gad
    from work_horse..da_course_distance_data dacd
    where dacd.course_uid = @in_course_uid
        and dacd.distance_yard = @in_distance_yard
        and dacd.adjusted_draw_prefix = @in_adjusted_draw_prefix
        and dacd.sr_code = @in_sr_code
for read only

open cursor_each_course_distance

while (1 = 1)
begin
    fetch cursor_each_course_distance
    into @course_uid
        , @distance_yard
        , @adjusted_draw_prefix
        , @sr_code
        , @grouped_adjusted_draw
        , @length_average
        , @smoothed_average
        , @calc_advantage
        , @max_gad

    if (@@sqlstatus <> 0)
        break

    select @x_this_gad = @grouped_adjusted_draw,
        @x_this_val = @length_average

    --if first row, store values as previous row
    if (@x_this_gad = @min_gad)
    begin

        select @x_former_curr_val = @x_this_val,
            @x_former_next_val = @x_this_val,
            @x_sum = 0,
            @x_lastsum = 0
    end

    --if max row
    else if @x_this_gad = @max_gad
    begin

        --sum for last row
        select @x_lastsum = round((sum(@x_former_next_val + @x_this_val + @x_this_val) / 3), 2)
        select @x_advantage = round((@x_average - @x_lastsum), 2)
        --SELECT  "LR update ", (@x_this_gad) , "set ave:",  @x_lastsum, @x_average, " calc:" , @x_advantage

        update work_horse..da_course_distance_data
        set smoothed_average = @x_lastsum
            , calc_advantage = @x_advantage
            , median_races = @x_median
        where grouped_adjusted_draw = @x_this_gad
            and course_uid = @in_course_uid
            and distance_yard = @in_distance_yard
            and adjusted_draw_prefix = @in_adjusted_draw_prefix
            and sr_code = @in_sr_code

        --sum for next to last row
        select @x_former_prev_val = @x_former_curr_val
        select @x_former_curr_val = @x_former_next_val
        select @x_former_next_val = @x_this_val

        select @x_sum = round(sum((@x_former_prev_val + @x_former_curr_val + @x_former_curr_val + @x_former_next_val) / 4), 2)
        select @x_advantage = round((@x_average - @x_sum), 2)
        --SELECT  "NTLR update ", (@x_this_gad - 1), "set ave:", @x_sum, @x_average, " calc:", @x_advantage

        update work_horse..da_course_distance_data
        set smoothed_average = @x_sum
            , calc_advantage = @x_advantage
            , median_races = @x_median
        where grouped_adjusted_draw = (@x_this_gad - 1)
            and course_uid = @in_course_uid
            and distance_yard = @in_distance_yard
            and adjusted_draw_prefix = @in_adjusted_draw_prefix
            and sr_code = @in_sr_code

    end
    --if middle row, add prev+curr
    else
    begin
        --sum former prev + former current (*2 if not first row) + former next
        select @x_former_prev_val = @x_former_curr_val
        select @x_former_curr_val = @x_former_next_val
        select @x_former_next_val = @x_this_val

        if (@x_this_gad = (@min_gad + 1))
        begin
            select @x_sum = round(sum((@x_former_curr_val + @x_former_curr_val + @x_this_val) / 3), 2)
            select @x_advantage = round((@x_average - @x_sum), 2)
            --SELECT  "FR update ", (@x_this_gad - 1) , "set ave:",  @x_sum, @x_average, " calc:", @x_advantage

            update work_horse..da_course_distance_data
            set smoothed_average = @x_sum
                , calc_advantage = @x_advantage
                , median_races = @x_median
            where grouped_adjusted_draw = (@x_this_gad - 1)
                and course_uid = @in_course_uid
                and distance_yard = @in_distance_yard
                and adjusted_draw_prefix = @in_adjusted_draw_prefix
                and sr_code = @in_sr_code
        end
        else
        begin
            select @x_sum = round(sum((@x_former_prev_val + @x_former_curr_val + @x_former_curr_val + @x_former_next_val) / 4), 2)
            select @x_advantage = round((@x_average - @x_sum), 2)
            --SELECT  "MR update ", (@x_this_gad - 1), "set ave:", "(",@x_former_prev_val,",", @x_former_curr_val,",", @x_former_curr_val,",", @x_former_next_val,")", @x_sum, " calc:", @x_advantage

            update work_horse..da_course_distance_data
            set smoothed_average = @x_sum
                , calc_advantage = @x_advantage
                , median_races = @x_median
            where grouped_adjusted_draw = (@x_this_gad - 1)
                and course_uid = @in_course_uid
                and distance_yard = @in_distance_yard
                and adjusted_draw_prefix = @in_adjusted_draw_prefix
                and sr_code = @in_sr_code
        end
    end
end
close cursor_each_course_distance
deallocate cursor cursor_each_course_distance

go
if OBJECT_ID('dbo.sp_da_step2_sub1') is not null
    print '<<< CREATED PROCEDURE dbo.sp_da_step2_sub1 >>>'
else
    print '<<< FAILED CREATING PROCEDURE dbo.sp_da_step2_sub1 >>>'
go
grant execute on dbo.sp_da_step2_sub1 to level1
go
if OBJECT_ID('dbo.sp_da_step2_sub2') is not null
begin
    drop procedure dbo.sp_da_step2_sub2
    if OBJECT_ID('dbo.sp_da_step2_sub2') is not null
        print '<<< FAILED DROPPING PROCEDURE dbo.sp_da_step2_sub2 >>>'
    else
        print '<<< DROPPED PROCEDURE dbo.sp_da_step2_sub2 >>>'
end
go

--------------------------------------------------------

create procedure dbo.sp_da_step2_sub2
    @in_course_uid smallint,
    @in_distance_yard smallint,
    @in_adjusted_draw_prefix char(1),
    @in_sr_code char(1)
as

/*
 * Declare Variables
 */

declare
--    @grouped_adjusted_draw integer,
--    @calc_advantage decimal(6, 2),
    @max_gad integer,

--    @r2_a decimal(6, 4),
--    @r2_b float,
--    @r2_c float,
--    @r2_d float,
--    @r2 decimal(6, 2),

    @sx decimal(6, 2),
    @sy decimal(6, 2),
    @stt float,
    @sts float,
--    @t decimal(6, 2),
    @slope decimal(6, 2),
    @intercept decimal(6, 2)

select
    @max_gad = max(grouped_adjusted_draw),
    @sx = sum(grouped_adjusted_draw),
    @sy = sum(calc_advantage)
from work_horse..da_course_distance_data
where
    course_uid = @in_course_uid
    and distance_yard = @in_distance_yard
    and adjusted_draw_prefix = @in_adjusted_draw_prefix
    and sr_code = @in_sr_code

select
    @stt = 0.0,
    @sts = 0.0
--    @t = 0.0

select
    @stt = sum((grouped_adjusted_draw - (@sx / @max_gad)) * (grouped_adjusted_draw - (@sx / @max_gad))),
    @sts = sum((grouped_adjusted_draw - (@sx / @max_gad)) * calc_advantage)
from work_horse..da_course_distance_data
where
    course_uid = @in_course_uid
    and distance_yard = @in_distance_yard
    and adjusted_draw_prefix = @in_adjusted_draw_prefix
    and sr_code = @in_sr_code

select @slope = convert(decimal(6, 2), @sts / @stt)
select @intercept = convert(decimal(6, 2), (@sy - @sx * @slope) / @max_gad)

update work_horse..da_course_distance_data
set
    slope = @slope,
    intercept = @intercept
where
    course_uid = @in_course_uid
    and distance_yard = @in_distance_yard
    and adjusted_draw_prefix = @in_adjusted_draw_prefix
    and sr_code = @in_sr_code

--------------------------------------------------------
go

if OBJECT_ID('dbo.sp_da_step2_sub2') is not null
    print '<<< CREATED PROCEDURE dbo.sp_da_step2_sub2 >>>'
else
    print '<<< FAILED CREATING PROCEDURE dbo.sp_da_step2_sub2 >>>'
go
grant execute on dbo.sp_da_step2_sub2 to level1
go
if OBJECT_ID('dbo.sp_da_step2_sub3') is not null
begin
    drop procedure dbo.sp_da_step2_sub3
    if OBJECT_ID('dbo.sp_da_step2_sub3') is not null
        print '<<< FAILED DROPPING PROCEDURE dbo.sp_da_step2_sub3 >>>'
    else
        print '<<< DROPPED PROCEDURE dbo.sp_da_step2_sub3 >>>'
end
go
create procedure dbo.sp_da_step2_sub3
    @in_course_uid smallint,
    @in_distance_yard smallint,
    @in_adjusted_draw_prefix char(1),
    @in_sr_code char(1)
as

/*
finally found something that works (with a minimal rounding error) :))

source:
http://ask.sqlservercentral.com/questions/96778/can-this-linear-regression-algorithm-for-sql-serve.html

double check:
http://www.thinkcalculator.com/statistics/r-squared-calculator.php

*/

declare @xbar float
    , @ybar float
    , @Beta float
    , @Alpha float
    , @SS_tot float
    , @SS_err float
    , @r_squared decimal(6, 3)

select grouped_adjusted_draw as x
    , calc_advantage as y
into #stats_temp
from work_horse..da_course_distance_data dacd
where dacd.course_uid = @in_course_uid
    and dacd.distance_yard = @in_distance_yard
    and dacd.adjusted_draw_prefix = @in_adjusted_draw_prefix
    and dacd.sr_code = @in_sr_code

select @xbar = avg(x),
    @ybar = avg(y)
from #stats_temp

--SELECT @xbar
--SELECT @ybar

select @Beta = sum((x - @xbar) * (y - @ybar))
    / --nullif to stop divided by zero
    nullif (sum((x - @xbar) * (x - @xbar)), 0)
from #stats_temp

--SELECT @Beta

select @Alpha = (@ybar - @xbar * @Beta)

--SELECT @Alpha

select @SS_tot = sum((y - @ybar) * (y - @ybar)),
    @SS_err = sum((y - (@Alpha + @Beta * x)) * (y - (@Alpha + @Beta * x)))
from #stats_temp

--SELECT @SS_tot
--SELECT @SS_err

select @r_squared = (
    case
        when @SS_tot = 0
        then 1.0
        else 1.0 - round((@SS_err / @SS_tot), 6)
    end
    )

--SELECT @r_squared

update work_horse..da_course_distance_data
set rsquare = @r_squared
where course_uid = @in_course_uid
    and distance_yard = @in_distance_yard
    and adjusted_draw_prefix = @in_adjusted_draw_prefix
    and sr_code = @in_sr_code

go
if OBJECT_ID('dbo.sp_da_step2_sub3') is not null
    print '<<< CREATED PROCEDURE dbo.sp_da_step2_sub3 >>>'
else
    print '<<< FAILED CREATING PROCEDURE dbo.sp_da_step2_sub3 >>>'
go
grant execute on dbo.sp_da_step2_sub3 to level1
go
if OBJECT_ID('dbo.sp_da_step2_sub4') is not null
begin
    drop procedure dbo.sp_da_step2_sub4
    if OBJECT_ID('dbo.sp_da_step2_sub4') is not null
        print '<<< FAILED DROPPING PROCEDURE dbo.sp_da_step2_sub4 >>>'
    else
        print '<<< DROPPED PROCEDURE dbo.sp_da_step2_sub4 >>>'
end
go

--------------------------------------------------------

create procedure dbo.sp_da_step2_sub4
    @in_course_uid smallint,
    @in_distance_yard smallint,
    @in_adjusted_draw_prefix char(1),
    @in_sr_code char(1)
as

declare
--    @slope decimal(6, 2),
--    @intercept decimal(6, 2),
    @pounds decimal(6, 2)
--    @formula varchar(60)

select @pounds = (

    case

        when (@in_distance_yard >= 1100 and @in_distance_yard < 1320)
        then 3.6

        when (@in_distance_yard >= 1320 and @in_distance_yard < 1540)
        then 3

        when (@in_distance_yard >= 1540 and @in_distance_yard < 1760)
        then 2.6

        when (@in_distance_yard >= 1760 and @in_distance_yard < 2200)
        then 2.3

        when (@in_distance_yard >= 2200 and @in_distance_yard < 2640)
        then 1.9

        when (@in_distance_yard >= 2640 and @in_distance_yard < 3080)
        then 1.6

        when (@in_distance_yard >= 3080 and @in_distance_yard < 3520)
        then 1.4

        when (@in_distance_yard >= 3520)
        then 1.2

        else 1.0

    end

    )

update work_horse..da_course_distance_data
set
    pounds = @pounds,
    regression_line = 'y = ' + convert(varchar, slope) + 'x' + (case when intercept > 0 then ' + ' else '  ' end) + convert(varchar, intercept)
where
    course_uid = @in_course_uid
    and distance_yard = @in_distance_yard
    and adjusted_draw_prefix = @in_adjusted_draw_prefix
    and sr_code = @in_sr_code

--------------------------------------------------------
go

if OBJECT_ID('dbo.sp_da_step2_sub4') is not null
    print '<<< CREATED PROCEDURE dbo.sp_da_step2_sub4 >>>'
else
    print '<<< FAILED CREATING PROCEDURE dbo.sp_da_step2_sub4 >>>'
go
grant execute on dbo.sp_da_step2_sub4 to level1
go
if OBJECT_ID('dbo.sp_da_overnight_data') is not null
begin
    drop procedure dbo.sp_da_overnight_data
    if OBJECT_ID('dbo.sp_da_overnight_data') is not null
        print '<<< FAILED DROPPING PROCEDURE dbo.sp_da_overnight_data >>>'
    else
        print '<<< DROPPED PROCEDURE dbo.sp_da_overnight_data >>>'
end
go

create procedure dbo.sp_da_overnight_data

as

/*
DRAW ANALYSER v5

usage: EXEC da_overnight_data

*/

--declare vars
declare @c_race_instance_uid int
    , @c_course_uid smallint
    , @c_distance_yard smallint
    , @c_fieldsize int
    , @c_nonrunners int
    , @c_straight_round_jubilee_code varchar(1)
    , @c_racedate varchar(10)
    , @c_race_datetime datetime
    , @c_course_name varchar(255)
    , @c_going_type_code char(1)
    , @c_going_type_value int
    , @c_going_type_desc varchar(255)
    , @c_da_sr_code char(1)
    , @c_da_adjusted_draw_prefix char(1)
    , @c_rsquare decimal(6, 3)
    , @c_intercept decimal(6, 2)
    , @c_slope decimal(6, 2)
    , @c_pounds decimal(6, 2)
    , @v_distance_to_use int
    , @v_actual_runners int
    , @iter int
    , @temp_int int
    , @v_draw int
    , @v_tmp_dec decimal(6, 3)
    , @v_tmp_dec1 decimal(6, 3)
    , @v_tmp_dec2 decimal(6, 3)
    , @v_tmp_dec3 decimal(6, 3)
    , @v_avg_dec decimal(6, 3)
    , @v_x_diff decimal(6, 3)
    , @v_text_sum varchar(255)
    --rule cursor from db
    , @config_uid int
    , @config_desc varchar(255)
    , @config_int int
    , @config_char1 char(1)
    , @config_dec62 decimal(6, 2)
    , @config_dec63 decimal(6, 3)
    , @config_varchar255 varchar(255)
    --rules from db
    , @CHK_MEDIAN decimal(6, 2)
    , @CHK_NUM_RACES int
    , @CHK_RSQUARE decimal(6, 3)
    , @CHK_BIAS_STRENGTH_SLIGHT decimal(6, 3)
    , @CHK_BIAS_STRENGTH_MIN decimal(6, 3)
    , @CHK_FIELD_HIGH int
    , @CHK_FIELD_STRAIGHT_MAX int
    , @CHK_STRAIGHTS_SLOPE decimal(6, 2)
    , @CHK_STRAIGHTS_SLOPE_PLUS decimal(6, 2)
    , @CHK_FAIL_SIG_STRAIGHT_RUNNER int
    , @CHK_GOING_FACTOR_A decimal(6, 2)
    , @CHK_GOING_FACTOR_B decimal(6, 2)
    , @CHK_GOING_FACTOR_C decimal(6, 2)
    , @CHK_GOING_FACTOR_D decimal(6, 2)
    , @CHK_STRENGTH_LOW_TEXT varchar(255)
    , @CHK_STRENGTH_HIGH_TEXT varchar(255)
    , @CHK_SUM_NO_SIG_TXT varchar(255)
    , @CHK_SUM_INS_TXT varchar(255)
    , @CHK_NUM_RACES_DISTANCE int
    , @CHK_NUM_RACES_LONGRUNNERS int
    , @CHK_NUM_RACES_LONGDRAWS int
    , @CHK_TXT_SLIGHT varchar(255)
    , @CHK_TXT_STRONG varchar(255)
    , @CHK_TXT_NONE varchar(255)
    , @DEBUG int

select @DEBUG = 0 --1=on 0=off

create table #temp_draw(
    iter int not null
    , draw int not null
    , y_val decimal(6, 3) null
    , y_nor decimal(6, 3) null
    , y_pound decimal(6, 3) null
    , y_going decimal(6, 3) null
)

--set defaults in case no match in db
select @CHK_MEDIAN = null
    , @CHK_NUM_RACES = null
    , @CHK_RSQUARE = null
    , @CHK_BIAS_STRENGTH_SLIGHT = null
    , @CHK_BIAS_STRENGTH_MIN = null
    , @CHK_FIELD_HIGH = null
    , @CHK_FIELD_STRAIGHT_MAX = null
    , @CHK_STRAIGHTS_SLOPE = null
    , @CHK_STRAIGHTS_SLOPE_PLUS = null
    , @CHK_FAIL_SIG_STRAIGHT_RUNNER = null
    , @CHK_GOING_FACTOR_A = null
    , @CHK_GOING_FACTOR_B = null
    , @CHK_GOING_FACTOR_C = null
    , @CHK_GOING_FACTOR_D = null
    , @CHK_STRENGTH_LOW_TEXT = null
    , @CHK_STRENGTH_HIGH_TEXT = null
    , @CHK_SUM_NO_SIG_TXT = null
    , @CHK_SUM_INS_TXT = null
    , @CHK_NUM_RACES_DISTANCE = null
    , @CHK_NUM_RACES_LONGRUNNERS = null
    , @CHK_NUM_RACES_LONGDRAWS = null
    , @CHK_TXT_SLIGHT = null
    , @CHK_TXT_STRONG = null
    , @CHK_TXT_NONE = null

--get rule contants from DB
declare cursor_rules
cursor for

select config_uid
    , config_desc
    , config_int
    , config_char1
    , config_dec62
    , config_dec63
    , config_varchar255
from da_config

for read only
open cursor_rules
while (1 = 1)
begin

    fetch cursor_rules
    into @config_uid
        , @config_desc
        , @config_int
        , @config_char1
        , @config_dec62
        , @config_dec63
        , @config_varchar255

    if (@@sqlstatus <> 0)
        break

    if (@config_desc = 'CHK_MEDIAN') select @CHK_MEDIAN = @config_dec62
    if (@config_desc = 'CHK_NUM_RACES') select @CHK_NUM_RACES = @config_int
    if (@config_desc = 'CHK_RSQUARE') select @CHK_RSQUARE = @config_dec63
    if (@config_desc = 'CHK_BIAS_STRENGTH_SLIGHT') select @CHK_BIAS_STRENGTH_SLIGHT = @config_dec63
    if (@config_desc = 'CHK_BIAS_STRENGTH_MIN') select @CHK_BIAS_STRENGTH_MIN = @config_dec63
    if (@config_desc = 'CHK_FIELD_HIGH') select @CHK_FIELD_HIGH = @config_int
    if (@config_desc = 'CHK_FIELD_STRAIGHT_MAX') select @CHK_FIELD_STRAIGHT_MAX = @config_int
    if (@config_desc = 'CHK_STRAIGHTS_SLOPE') select @CHK_STRAIGHTS_SLOPE = @config_dec62
    if (@config_desc = 'CHK_STRAIGHTS_SLOPE_PLUS') select @CHK_STRAIGHTS_SLOPE_PLUS = @config_dec62
    if (@config_desc = 'CHK_FAIL_SIG_STRAIGHT_RUNNER') select @CHK_FAIL_SIG_STRAIGHT_RUNNER = @config_int
    if (@config_desc = 'CHK_GOING_FACTOR_A') select @CHK_GOING_FACTOR_A = @config_dec62
    if (@config_desc = 'CHK_GOING_FACTOR_B') select @CHK_GOING_FACTOR_B = @config_dec62
    if (@config_desc = 'CHK_GOING_FACTOR_C') select @CHK_GOING_FACTOR_C = @config_dec62
    if (@config_desc = 'CHK_GOING_FACTOR_D') select @CHK_GOING_FACTOR_D = @config_dec62
    if (@config_desc = 'CHK_STRENGTH_LOW_TEXT') select @CHK_STRENGTH_LOW_TEXT = @config_varchar255
    if (@config_desc = 'CHK_STRENGTH_HIGH_TEXT') select @CHK_STRENGTH_HIGH_TEXT = @config_varchar255
    if (@config_desc = 'CHK_SUM_NO_SIG_TXT') select @CHK_SUM_NO_SIG_TXT = @config_varchar255
    if (@config_desc = 'CHK_SUM_INS_TXT') select @CHK_SUM_INS_TXT = @config_varchar255
    if (@config_desc = 'CHK_NUM_RACES_DISTANCE') select @CHK_NUM_RACES_DISTANCE = @config_int
    if (@config_desc = 'CHK_NUM_RACES_LONGRUNNERS') select @CHK_NUM_RACES_LONGRUNNERS = @config_int
    if (@config_desc = 'CHK_NUM_RACES_LONGDRAWS') select @CHK_NUM_RACES_LONGDRAWS = @config_int
    if (@config_desc = 'CHK_TXT_SLIGHT') select @CHK_TXT_SLIGHT = @config_varchar255
    if (@config_desc = 'CHK_TXT_STRONG') select @CHK_TXT_STRONG = @config_varchar255
    if (@config_desc = 'CHK_TXT_NONE') select @CHK_TXT_NONE = @config_varchar255

end
close cursor_rules
deallocate cursor cursor_rules

--truncate da_race_significance
if exists (select 1 from sysobjects where name = 'da_race_significance')
    truncate table da_race_significance

if exists (select 1 from sysobjects where name = 'da_overnight_data')
    truncate table da_overnight_data

--upcoming non-maiden uk flat races overnight 

declare cursor_per_race
cursor for

select
    ri.race_instance_uid,
    ri.course_uid,
    ri.distance_yard,
    count(phr.horse_uid) as fieldsize,
        --non_runner in phr, race_outcome_uid in (60,61,62) in hr
        (
        select count(1)
        from pre_horse_race sphr
        where
            non_runner = 'Y'
            and sphr.race_instance_uid = ri.race_instance_uid
            and sphr.race_status_code = 'O'
        ) as non_runners,
    ri.straight_round_jubilee_code,
    convert(varchar(10), ri.race_datetime, 111) date,
    ri.race_datetime,
    c.course_name,
    ri.going_type_code,
    gt.rp_going_type_value,
    gt.going_type_desc,
    case
        when t.sr_code = 'S'
        then 'S'
        else 'R'
    end as da_sr_code,
    case
        --flip these straight courses at all distances  2   => Ascot, 3   => Ayr, 15  => Doncaster, 17  => Epsom, 21  => Goodwood, 22  => Hamilton, 31  => Lingfield (turf NOT all-weather), 30  => Leicester, 16  => Musselburgh, 36  => Newbury, 38  => Newmarket (rowley), 40  => Nottingham, 49  => Ripon, 80  => Thirsk, 104 => Yarmouth, 107 => York
        when t.sr_code = 'S' and c.course_uid in (2, 3, 15, 16, 17, 21, 22, 30, 31, 36, 38, 40, 49, 80, 104, 107)
        then 'H'
        -- or if they match the flip table
        when flip.distance_yards is not null
        then 'H'
        else 'L'
    end as da_adjusted_draw_prefix
from
    race_instance ri,
    pre_horse_race phr,
    ext_race_instance eri,
    track t,
    course c,
    going_type gt,
    da_flip_data flip
where
    ri.race_datetime > convert(varchar(10), GETDATE(), 111)
    and ri.race_instance_uid = phr.race_instance_uid
    and ri.course_uid = c.course_uid
    and ri.race_status_code = phr.race_status_code
    and ri.race_instance_uid = eri.race_instance_uid
    and eri.track_uid = t.track_uid
    and ri.going_type_code = gt.going_type_code
    and t.distance_yards *= flip.distance_yards
    and c.course_uid *= flip.course_uid
    and ri.race_status_code = 'O'
    and ri.race_type_code in ('F', 'X') --f=Flat Turf, x=Flat AW
    and c.country_code in ('GB', 'IRE')
    and
    not exists (
        select *
        from
            da_override dao
        where
            dao.course_uid = ri.course_uid
            and dao.distance_yards = ri.distance_yard
        )
    and
    'F' != (--remove flag starts
    case
        when ri.rp_stalls_position is null
        then 'N'
        else ri.rp_stalls_position
    end
    )
    and
    'Y' != (--remove flag starts
    case
        when ri.start_flag_yn is null
        then 'N'
        else ri.start_flag_yn
    end
    )
group by
    ri.race_instance_uid,
    ri.course_uid,
    ri.distance_yard,
    ri.straight_round_jubilee_code,
    convert(varchar(10), ri.race_datetime, 111),
    ri.race_datetime,
    t.sr_code,
    c.course_name,
    ri.going_type_code,
    gt.rp_going_type_value,
    gt.going_type_desc,
    case
        when t.sr_code = 'S'
        then 'S'
        else 'R'
    end,
    case
        when t.sr_code = 'S' and c.course_uid in (2, 3, 15, 16, 17, 21, 22, 30, 31, 36, 38, 40, 49, 80, 104, 107)
        then 'H'
        when flip.distance_yards is not null
        then 'H'
        else 'L'
    end
order by
    convert(varchar(10), ri.race_datetime, 111),
    ri.course_uid
for read only

open cursor_per_race
while (1 = 1)
begin

    -----------------------------------------------------------------------------------CURSOR START

    fetch cursor_per_race
    into @c_race_instance_uid
        , @c_course_uid
        , @c_distance_yard
        , @c_fieldsize
        , @c_nonrunners
        , @c_straight_round_jubilee_code
        , @c_racedate
        , @c_race_datetime
        , @c_course_name
        , @c_going_type_code
        , @c_going_type_value
        , @c_going_type_desc

        , @c_da_sr_code
        , @c_da_adjusted_draw_prefix

    if (@@sqlstatus <> 0)
        break

    if (@DEBUG = 1) select @c_race_instance_uid

    --insert row for later updates
    insert into da_race_significance(race_instance_uid) values (@c_race_instance_uid)

    --  GET CORRECT DISTANCE TO USE 
    --  for similar distances where we don't have enough data to make it significant
    --  use the following distances instead 
    if exists (
            select distance_yard_to_use
            from da_course_distance_override
            where
                course_uid = @c_course_uid
                and distance_yards = @c_distance_yard
            )
    begin
        select @v_distance_to_use = distance_yard_to_use
        from da_course_distance_override
        where
            course_uid = @c_course_uid
            and distance_yards = @c_distance_yard
    end
    else
    begin
        select @v_distance_to_use = @c_distance_yard
    end
    ------ GET CORRECT DISTANCE TO USE

    ------ ACTUAL RUNNERS
    select @v_actual_runners = @c_fieldsize - @c_nonrunners
    ------ ACTUAL RUNNERS

    --get r_square, slope, intercept and pounds
    select distinct
        @c_rsquare = rsquare,
        @c_intercept = intercept,
        @c_slope = slope,
        @c_pounds = pounds
    from work_horse..da_course_distance_data
    where
        course_uid = @c_course_uid
        and distance_yard = @c_distance_yard
        and sr_code = @c_da_sr_code
        and adjusted_draw_prefix = @c_da_adjusted_draw_prefix
    --grouping as if we dont have enough data it might not have a specific draw
    group by
        rsquare,
        intercept,
        slope,
        pounds
    --get r_square, slope, intercept and pounds

    ------ GET LOOKUP DRAWS INTO TEMP TABLE
    select
        grouped_adjusted_draw,
        median_races,
        num_races
    into #lookup_draw_table
    from work_horse..da_course_distance_data
    where
        course_uid = @c_course_uid
        and distance_yard = @c_distance_yard
        and sr_code = @c_da_sr_code
        and adjusted_draw_prefix = @c_da_adjusted_draw_prefix
    ------ GET LOOKUP DRAWS INTO TEMP TABLE

    --manual debug for nonrunners
    --update pre_horse_race set non_runner = 'Y' where race_instance_uid = 597333 
    --and horse_uid = 788951 and race_status_code = 'O'

    select
        iter = identity (5),
        phr.draw
    into
        #da_draw_order
    from pre_horse_race phr
    where
        phr.race_instance_uid = @c_race_instance_uid
        and phr.race_status_code = 'O'
        and phr.non_runner is null
    order by
        case
            when @c_da_adjusted_draw_prefix = 'L'
            then phr.draw
            else (phr.draw * - 1)
        end

    if (@DEBUG = 1) select * from #da_draw_order

    --reset loop vals
    select
        @v_tmp_dec = 0.00,
        @v_tmp_dec1 = 0.00,
        @v_tmp_dec2 = 0.00,
        @v_tmp_dec3 = 0.00,
        @v_draw = 0

    --first get actual draw order from #tmp_draw_order into #temp_draw
    select @iter = 0
    while (@iter < @v_actual_runners)
    begin
        select @iter = (@iter + 1)

        select @v_draw = draw from #da_draw_order where iter = @iter

        select @v_tmp_dec = ((@c_slope * @iter) + @c_intercept)

        if @v_draw is not null
            insert into #temp_draw(iter, draw, y_val) values (@iter, @v_draw, @v_tmp_dec)
    end

    if (@DEBUG = 1) select * from #temp_draw

    select @v_avg_dec = avg(y_val) from #temp_draw

    if (@DEBUG = 1) select '@v_avg_dec', @v_avg_dec

    select @v_tmp_dec1 = case
            when @c_going_type_value >= 4
            then @CHK_GOING_FACTOR_A
            when @c_going_type_value = 3
            then @CHK_GOING_FACTOR_B
            when @c_going_type_value = 2
            then @CHK_GOING_FACTOR_C
            when @c_going_type_value = 1
            then @CHK_GOING_FACTOR_D
            else 0
        end

    if (@DEBUG = 1) select * from #temp_draw
    if (@DEBUG = 1) select @v_tmp_dec1 as '@v_tmp_dec1', @v_actual_runners as '@v_actual_runners', @v_avg_dec as '@v_avg_dec'

    --loop again to normalise length y plot
    select @iter = 0
    while (@iter < @v_actual_runners)
    begin
        select @iter = @iter + 1

        select @v_tmp_dec = ROUND((1.000 * ((select y_val from #temp_draw where iter = @iter) - @v_avg_dec)), 3)
        select @v_tmp_dec2 = ROUND((1.000 * (@v_tmp_dec * @c_pounds)), 3) --truncation error otherwise
        select @v_tmp_dec3 = ROUND((1.000 * (@v_tmp_dec * @v_tmp_dec1)), 3) --truncation error otherwise

        update #temp_draw
        set
            y_nor = @v_tmp_dec,
            y_pound = @v_tmp_dec2,
            y_going = @v_tmp_dec3
        where iter = @iter
    end

    --this will be strength value
    select @v_x_diff = (select (max(y_nor) - min(y_nor)) from #temp_draw)

    if (@DEBUG = 1) select * from #temp_draw
    if (@DEBUG = 1) select @c_rsquare as 'c_rsquare', @c_intercept as 'c_intercept', @c_slope as 'c_slope', @c_pounds as 'c_pounds', @v_actual_runners as 'v_actual_runners', @v_distance_to_use as 'v_distance_to_use', @v_x_diff as 'v_x_diff'

    ------ CREATE TEMP DRAW TABLE BASED ON ACTUAL RUNNERS

    ------ SIGNIFICANCE RULES

    --bias_strength
    --num_races
    --field_size
    --rsquare
    update da_race_significance
    set
        bias_strength_yn = case
            when @v_x_diff >= @CHK_BIAS_STRENGTH_MIN
            then 'Y'
            else 'N'
        end,
        rsquare_yn = case
            when @c_rsquare >= @CHK_RSQUARE
            then 'Y'
            else 'N'
        end,
        num_races_yn = case
            when @v_distance_to_use >= @CHK_NUM_RACES_DISTANCE
            then case
                when exists (select * from #lookup_draw_table where num_races <= @CHK_NUM_RACES_LONGRUNNERS and grouped_adjusted_draw <= @CHK_NUM_RACES_LONGDRAWS)
                then 'N'
                else 'Y'
            end
            else case
                    when exists (select * from #lookup_draw_table where num_races < @CHK_NUM_RACES)
                    then 'N'
                    else 'Y'
                end
        end,
        field_size_yn = case
            when @c_da_sr_code = 'S'
            then case
                when @v_actual_runners >= @CHK_FIELD_HIGH and @v_actual_runners <= @CHK_FIELD_STRAIGHT_MAX
                then 'Y'
                else 'N'
            end
            else case
                    when @v_actual_runners >= @CHK_FIELD_HIGH
                    then 'Y'
                    else 'N'
                end
        end
    where race_instance_uid = @c_race_instance_uid

    --straights slopes
    --Find all rows in the Draw C&D Lookup table that relate to �straight course� race distances at that course, with a median figure of at least x races. In all instances the slope values must be -0.1 or lower for a race to be considered significant

    select @temp_int = 0

    --create #straights_slopes if results
    select slope
    into #straights_slopes
    from work_horse..da_course_distance_data
    where
        course_uid = @c_course_uid
        and sr_code = 'S'
        and median_races >= @CHK_MEDIAN

    if (@DEBUG = 1) select @CHK_STRAIGHTS_SLOPE_PLUS as '@CHK_STRAIGHTS_SLOPE_PLUS', @CHK_STRAIGHTS_SLOPE as '@CHK_STRAIGHTS_SLOPE', @CHK_MEDIAN as '@CHK_MEDIAN'
    if (@DEBUG = 1) select 'straights slopes'
    if (@DEBUG = 1) select * from #straights_slopes

    if exists (select * from #straights_slopes)
    begin
        --if result, check all slopes are:   0.1 >= slope <= -0.1
        select @temp_int = 0

        select @temp_int = count(*)
        from #straights_slopes
        where
            slope < @CHK_STRAIGHTS_SLOPE_PLUS --     0.1
            and slope > @CHK_STRAIGHTS_SLOPE --    -0.1

        if (@DEBUG = 1) select 'str int', @temp_int

        update da_race_significance
        set straight_slope_yn = case
                when @temp_int > 0
                then 'N'
                else 'Y'
            end
        where race_instance_uid = @c_race_instance_uid
    end
    else
    begin
        if (@DEBUG = 1) select 'no result, not straight or not width median_races, so ok'

        --if no result, not straight or not width median_races, so ok
        update da_race_significance
        set straight_slope_yn = 'Y'
        where race_instance_uid = @c_race_instance_uid
    end

    --text_summary
    select @v_text_sum = @CHK_SUM_NO_SIG_TXT --default to no significant adv

    --correction for text summary 4/4/2014
    --if not passed significance tests, display no significant advantage
    if exists (
            select *
            from da_race_significance
            where
                bias_strength_yn = 'Y'
                and rsquare_yn = 'Y'
                and num_races_yn = 'Y'
                and field_size_yn = 'Y'
                and straight_slope_yn = 'Y'
                and race_instance_uid = @c_race_instance_uid
            )
    begin

        if (@DEBUG = 1) select 'insert text-summary if passed tests'

        --first check if straight and runners more than 20, then fail as we dont have data to predict those
        if (@c_da_sr_code = 'S' and @v_actual_runners >= @CHK_FAIL_SIG_STRAIGHT_RUNNER)
            select @v_text_sum = @CHK_SUM_INS_TXT
        else
        begin

            if (@v_x_diff >= @CHK_BIAS_STRENGTH_MIN) --1.000
            begin
                select @v_text_sum = @CHK_TXT_SLIGHT
                if (@v_x_diff > @CHK_BIAS_STRENGTH_SLIGHT) --1.499
                    select @v_text_sum = @CHK_TXT_STRONG

                --now check if high or low
                if (@c_da_adjusted_draw_prefix = 'H')
                begin
                    if (@c_slope < 0)
                        select @v_text_sum = @v_text_sum + ' ' + @CHK_STRENGTH_HIGH_TEXT
                    else
                        select @v_text_sum = @v_text_sum + ' ' + @CHK_STRENGTH_LOW_TEXT
                end
                else
                begin
                    if (@c_slope < 0)
                        select @v_text_sum = @v_text_sum + ' ' + @CHK_STRENGTH_LOW_TEXT
                    else
                        select @v_text_sum = @v_text_sum + ' ' + @CHK_STRENGTH_HIGH_TEXT
                end

            end
            else
            begin
                select @v_text_sum = @CHK_SUM_NO_SIG_TXT
            end
        end

        if (@DEBUG = 1) select 'text_sum (passed)', @v_text_sum

        if (@DEBUG = 1) select 'insert only significant data in da_overnight_data'

        insert into da_overnight_data(
            race_instance_uid,
            sequence,
            draw,
            y_temp,
            y_norm_length,
            y_norm_pound,
            y_norm_going
        )
        select
            @c_race_instance_uid,
            iter,
            draw,
            y_val,
            y_nor,
            y_pound,
            y_going
        from #temp_draw

    end
    if (@DEBUG = 1) select 'text_sum (after)', @v_text_sum

    update da_race_significance
    set text_summary = @v_text_sum
    where race_instance_uid = @c_race_instance_uid
    ------ SIGNIFICANCE RULES

    if (@DEBUG = 1)
    begin
        select
            'Numfields in #lookup_draw_table',
                (select count(1) from #lookup_draw_table),
            'Numfields in #straights_slopes',
                (select count(1) from #straights_slopes),
            'Numfields in #da_draw_order',
                (select count(1) from #da_draw_order),
            'Numfields in #temp_draw',
                (select count(1) from #temp_draw)
    end

    --DROP temp tables per race
    drop table #lookup_draw_table
    drop table #straights_slopes
    drop table #da_draw_order
    truncate table #temp_draw

-----------------------------------------------------------------------------------CURSOR END
end
close cursor_per_race
deallocate cursor cursor_per_race

drop table #temp_draw
go
if OBJECT_ID('dbo.sp_da_overnight_data') is not null
    print '<<< CREATED PROCEDURE dbo.sp_da_overnight_data >>>'
else
    print '<<< FAILED CREATING PROCEDURE dbo.sp_da_overnight_data >>>'
go
grant execute on dbo.sp_da_overnight_data to level1
go
if OBJECT_ID('dbo.sp_da_step1') is not null
begin
    drop procedure dbo.sp_da_step1
    if OBJECT_ID('dbo.sp_da_step1') is not null
        print '<<< FAILED DROPPING PROCEDURE dbo.sp_da_step1 >>>'
    else
        print '<<< DROPPED PROCEDURE dbo.sp_da_step1 >>>'
end
go
--------------------------------------------------------

create procedure dbo.sp_da_step1 @in_year integer, @in_quarter integer
as

/*

DRAW ANALYSER v5

to insert data for 2014 quarter 1 (1st jan-31st mar)
usage: EXEC da_step1 2005, 1

expecting these created tables:
-da_flip_data
-work_horse..da_horse_race
-work_horse..da_course_distance

this SP will populate  work_horse..da_race_instance and  work_horse..da_horse_race (and delete old data), and then update  work_horse..da_horse_race with adjusted draws

9 rolling data; (currently 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013)
eg 2014 q1 in, 2014-9 = 2005, anything before anything before q1 enddate out,
eg 2014 q2 in, 2014-9 = 2005, anything before anything before q2 enddate out,

*/

--declare vars
declare @var_date_base datetime,
    @var_date_start datetime,
    @var_date_end datetime,
    @rollingyears integer,
    @deletebefore datetime

--    @var_debug INTEGER,
--    @cur_race_uid INTEGER,
--    @draw INTEGER,
--    @adjusted_draw_prefix CHAR(1),
--    @adjusted_draw INTEGER,
--    @distance_to_winner_value DECIMAL(6, 2),
--    @outcome_uid INTEGER,
--    @del_check INTEGER

select -- @var_debug = 1, -- 0 = Off, 1 = On
    @rollingyears = 9, -- 9 rolling data, eg 2014 q1 in, 2014-9= anything before 2005 q1 enddate out,
    @var_date_base = convert(varchar, @in_year) + '-01-01 00:00:00'

if (@in_quarter between 1 and 4)
begin
    select @var_date_start = dateadd(month, (@in_quarter - 1) * 3, @var_date_base)
    select @var_date_end = dateadd(month, @in_quarter * 3, @var_date_base)
    select @var_date_end = dateadd(second, - 1, @var_date_end)
    select @deletebefore = dateadd(year, - @rollingyears, @var_date_end)
end
else
begin
    select 'Invalid Quarter. Integer 1-4 expected. 1=jan-mar 2=apr-jun 3=jul-sep 4=oct-dec'
    return
end

select 'Date range: [' + convert(varchar, @var_date_start) + '] - [' + convert(varchar, @var_date_end) + ']'
select 'Delete old data before date: ' + convert(varchar, @deletebefore)

if (getdate() < @var_date_end)
begin
    select 'This procedure will abort here, as the 3 month period you are trying to run has not got all the data yet.'
    select 'ABORTING'
    return
end
else
begin
    select 'Period OK, continuing...'
end

if exists (select 1
        from work_horse..da_race_instance
        where race_datetime between @var_date_start and @var_date_end
        )
begin
    select 'Data already exists for: [' + convert(varchar, @in_year) + '] and quarter [' + convert(varchar, @in_quarter) + ']'
    select 'ABORTING'
    return
end
else
begin
    select 'This period has not been run before, continuing...'
end

-- DELETE old data---------------------------------------

select 'DELETING data before: [' + convert(varchar, @deletebefore) + ']'
delete
from work_horse..da_horse_race
where exists (
        select race_instance_uid
        from work_horse..da_race_instance
        where
            work_horse..da_horse_race.race_instance_uid = work_horse..da_race_instance.race_instance_uid
            and race_datetime < @deletebefore
        )

delete
from work_horse..da_race_instance
where race_datetime < @deletebefore

-- DELETE ---------------------------------------

--populate raceinstance with incoming quarter
select 'populate work_horse..da_race_instance with data from: [' + convert(varchar, @var_date_start) + '] to [' + convert(varchar, @var_date_end) + ']'

insert into work_horse..da_race_instance(
    race_instance_uid,
    race_datetime,
    distance_yard,
    course_uid,
    straight_round_jubilee_code,
    going_type_code,
    ages_allowed_uid,
    race_group_uid,
    race_type_code,
    race_status_code,
    rp_stalls_position,
    runners,
    actual_runners
)
select
    ri.race_instance_uid,
    ri.race_datetime,
    ri.distance_yard,
    ri.course_uid,
    ri.straight_round_jubilee_code,
    ri.going_type_code,
    ri.ages_allowed_uid,
    ri.race_group_uid,
    ri.race_type_code,
    ri.race_status_code,
    ri.rp_stalls_position,
    count(hr.horse_uid) as runners,
    (
    (count(hr.horse_uid))
    -
        (
        select count(hr2.horse_uid)
        from horse_race hr2
        where
            hr2.race_instance_uid = ri.race_instance_uid
            and hr2.final_race_outcome_uid in (60, 61, 62) --just nonrunners here to get actual runners
        )
    ) as actual_runners
from
    race_instance ri
    , course c
    , horse_race hr
where
    ri.course_uid = c.course_uid
    and ri.race_instance_uid = hr.race_instance_uid

    and not exists (--remove maiden races
        select *
        from
            race_attrib_join raj,
            race_attrib_lookup ral
        where
            raj.race_instance_uid = ri.race_instance_uid
            and ral.race_attrib_uid = raj.race_attrib_uid
            and ral.race_attrib_code = 'Category'
            and ral.race_attrib_desc = 'Mdn'
        )
    and ri.race_datetime between @var_date_start and @var_date_end
    and ri.race_status_code = 'R' --results only
    and c.country_code in ('GB', 'IRE', 'UAE', 'FR')
    and 999 != case --remove FR & UAE unknown group races
        when c.country_code in ('FR', 'UAE') and ri.race_group_uid = 0
        then 999
        else ri.race_group_uid
    end
    and ri.race_type_code in ('F', 'X') --f=Flat Turf, x=Flat AW
    and ri.ages_allowed_uid != 2 --remove 2-y-o only
    and 'F' != (--remove flag starts
    case
        when ri.rp_stalls_position is null
        then 'N'
        else ri.rp_stalls_position
    end
    )
    and 'Y' != (--remove flag starts
    case
        when ri.start_flag_yn is null
        then 'N'
        else ri.start_flag_yn
    end
    )
group by
    ri.race_instance_uid,
    ri.race_datetime,
    ri.distance_yard,
    ri.course_uid,
    ri.straight_round_jubilee_code,
    ri.going_type_code,
    ri.ages_allowed_uid,
    ri.race_group_uid,
    ri.race_type_code,
    ri.race_status_code,
    ri.rp_stalls_position
having (
    (count(hr.horse_uid))
    -
        (
        select count(hr2.horse_uid)
        from horse_race hr2
        where
            hr2.race_instance_uid = ri.race_instance_uid
            and hr2.final_race_outcome_uid in (60, 61, 62) --just nonrunners here to get actual runners
        )
    ) > 5 --excluding races with 5 runners or less

--store races in #race_uid_table
select 'storing races in #race_uid_table'

select work_horse..da_race_instance.race_instance_uid
into #race_uid_table
from work_horse..da_race_instance
where work_horse..da_race_instance.race_datetime between @var_date_start and @var_date_end

create unique index race_uid_table_pk on #race_uid_table(race_instance_uid)

--populating  work_horse..da_horse_race...
select 'populating work_horse..da_horse_race...'

insert into work_horse..da_horse_race
select
    hr.race_instance_uid,
    c.course_uid,
    case
        when t.sr_code = 'S'
        then 'S'
        else 'R'
    end,
    ri.going_type_code,
    hr.horse_uid,
    hr.final_race_outcome_uid as outcome_uid,
    case
        when hr.starting_price_odds_uid is null
        then 76
        else hr.starting_price_odds_uid
    end as odds_uid,
    o.odds_desc,
    ri.distance_yard,
    --,t.distance_yards

    case when hr.distance_to_winner_uid is null
        then 0
        else hr.distance_to_winner_uid
    end as distance_uid,
    dtw.distance_value,
    hr.draw,

    case
        -- flip these straight courses at all distances. 2   => Ascot, 3   => Ayr, 15  => Doncaster, 17  => Epsom, 21  => Goodwood, 22  => Hamilton, 31  => Lingfield (turf NOT all-weather), 30  => Leicester, 16  => Musselburgh, 36  => Newbury, 38  => Newmarket (rowley), 40  => Nottingham, 49  => Ripon, 80  => Thirsk, 104 => Yarmouth, 107 => York
        when t.sr_code = 'S' and c.course_uid in (2, 3, 15, 16, 17, 21, 22, 30, 31, 36, 38, 40, 49, 80, 104, 107)
        then 'H'
        -- or if they match the flip table
        when flip.distance_yards is not null
        then 'H'
        else 'L'
    end as adjusted_draw_prefix,
    null,
    null,
    null
from
    horse_race hr
    , horse h
    , dist_to_winner dtw
    , odds o
    , race_instance ri
    , ext_race_instance eri
    , track t
    , course c
    , going_type gt
    , work_horse..da_race_instance dari
    , da_flip_data flip
    , #race_uid_table ruid_tmp
where
    hr.horse_uid = h.horse_uid
    --AND hr.starting_price_odds_uid  = o.odds_uid
    --some foreign races has NULL as starting price odds which excludes them unless this case is here
    and case
        when hr.starting_price_odds_uid is null
        then 76
        else hr.starting_price_odds_uid
    end = o.odds_uid
    and dari.race_instance_uid = hr.race_instance_uid
    and case
        when hr.distance_to_winner_uid is null
        then 0
        else hr.distance_to_winner_uid
    end = dtw.dist_to_winner_uid
    and hr.race_instance_uid = ri.race_instance_uid
    and 5 < dari.actual_runners
    --fix for draw 0 and null problem
    and 1 <= (
    case
        when hr.draw is null
        then 0
        else hr.draw
    end
    )
    and t.distance_yards *= flip.distance_yards
    and c.course_uid *= flip.course_uid
    and ri.course_uid = c.course_uid
    and ri.race_instance_uid = eri.race_instance_uid
    and eri.track_uid = t.track_uid
    and ri.going_type_code = gt.going_type_code
    and hr.race_instance_uid = ruid_tmp.race_instance_uid
    and hr.final_race_outcome_uid not in (60, 61, 62) --just non-runners so far

select 'Update the adjusted draw positions for every race'

update work_horse..da_horse_race
set hr.adjusted_draw =
    (select count(*) from work_horse..da_horse_race hr2
    where hr2.race_instance_uid = hr.race_instance_uid and hr2.draw <= hr.draw)
from work_horse..da_horse_race hr
    join #race_uid_table tmp on hr.race_instance_uid = tmp.race_instance_uid
where hr.adjusted_draw_prefix = 'L'

update work_horse..da_horse_race
set hr.adjusted_draw =
    (select count(*) from work_horse..da_horse_race hr2
    where hr2.race_instance_uid = hr.race_instance_uid and hr2.draw >= hr.draw)
from work_horse..da_horse_race hr
    join #race_uid_table tmp on hr.race_instance_uid = tmp.race_instance_uid
where hr.adjusted_draw_prefix = 'H'

update work_horse..da_horse_race
set
    hr.grouped_adjusted_draw = case when (hr.adjusted_draw >= 12) then 12 else hr.adjusted_draw end,
    hr.grouped_adjusted_draw_suffix = case when (hr.adjusted_draw >= 12) then '+' else null end
from work_horse..da_horse_race hr
    join #race_uid_table tmp on hr.race_instance_uid = tmp.race_instance_uid

select 'The deletetion of runners needs to be deleted here for adjusted draws to be correct'

--deleting runners beaten by 15 lengths or more
--now delete these statuses (60-62 gone already)
--Unplaced, Fell, Unseated Rider, Refused, Ran Out, Brought Down,
--Slipped Up, Refused To Race, Left at Start, Pulled Up, Last Disq, Void
delete
from work_horse..da_horse_race
from work_horse..da_horse_race hr, #race_uid_table tmp
where
    hr.race_instance_uid = tmp.race_instance_uid
    and
    (
        hr.distance_to_winner_value >= 15.00
        or
        hr.outcome_uid in (0, 51, 52, 53, 54, 55, 56, 57, 58, 59, 63, 64, 121)
    )

select 'Running sub procedure "sp_da_step1_sub1" to calc dist_to_winner from dist_to_horse_in_front for some foreign races'
exec sp_da_step1_sub1

select 'work_horse..da_race_instance and work_horse..da_horse_race now completed!'
--------------------------------------------------------
go
if OBJECT_ID('dbo.sp_da_step1') is not null
    print '<<< CREATED PROCEDURE dbo.sp_da_step1 >>>'
else
    print '<<< FAILED CREATING PROCEDURE dbo.sp_da_step1 >>>'
go
grant execute on dbo.sp_da_step1 to level1
go
if OBJECT_ID('dbo.sp_da_step2') is not null
begin
    drop procedure dbo.sp_da_step2
    if OBJECT_ID('dbo.sp_da_step2') is not null
        print '<<< FAILED DROPPING PROCEDURE dbo.sp_da_step2 >>>'
    else
        print '<<< DROPPED PROCEDURE dbo.sp_da_step2 >>>'
end
go
create procedure dbo.sp_da_step2
as

/*
DRAW ANALYSER v5

usage: EXEC da_step2

-truncates da_course_distance_data5
-(re-)calculates data based on da_race_instance5 and da_horse_race5
*/

--Declare Variables
declare @c_course_uid smallint
    , @c_distance_yards smallint
    , @c_adjusted_draw_prefix char(1)
    , @c_sr_code char(1)

--Truncate da_course_distance_data5
select 'Truncate da_course_distance_data'

if exists (
        select 1
        from work_horse..sysobjects
        where name = 'da_course_distance_data'
        )
    truncate table work_horse..da_course_distance_data

--insert into dev_inv_horses..da_course_distance_data
select 'insert into dev_inv_horses..da_course_distance_data'

insert into work_horse..da_course_distance_data
select dari.course_uid
    , dari.race_type_code
    , dari.distance_yard
    , dahr.adjusted_draw_prefix
    , dahr.grouped_adjusted_draw
    , dahr.sr_code
    , dahr.grouped_adjusted_draw_suffix
    , round(avg(dahr.distance_to_winner_value), 2) as length_average
    , null
    , null
    , count(*) as num_races
    , null
    , null
    , null
    , null
    , null
    , null
from
    work_horse..da_horse_race dahr
    , work_horse..da_race_instance dari
where dahr.race_instance_uid = dari.race_instance_uid
group by dari.course_uid
    , dari.race_type_code
    , dari.distance_yard
    , dahr.adjusted_draw_prefix
    , dahr.grouped_adjusted_draw
    , dahr.sr_code
    , dahr.grouped_adjusted_draw_suffix

--will do all of these in one sp when i get a chance
select @c_course_uid = null,
    @c_distance_yards = null,
    @c_adjusted_draw_prefix = null,
    @c_sr_code = null

--get cursor for course, distance, adjusted draw prefix and sr_code
select 'get cursor for course, distance, adjusted draw prefix and sr_code'

declare four_cursor
cursor for
    select dahr.course_uid
        , dahr.distance_yards
        , dahr.adjusted_draw_prefix
        , dahr.sr_code
    from
        work_horse..da_horse_race dahr
    group by dahr.course_uid
        , dahr.distance_yards
        , dahr.adjusted_draw_prefix
        , dahr.sr_code
for read only

open four_cursor

while (1 = 1)
begin
    fetch four_cursor
    into @c_course_uid
        , @c_distance_yards
        , @c_adjusted_draw_prefix
        , @c_sr_code

    if (@@sqlstatus <> 0)
        break

    --update da_course_distance_data5; smooth and length advantages
    --select 'start sub1', getdate()
    exec sp_da_step2_sub1 @c_course_uid, @c_distance_yards, @c_adjusted_draw_prefix, @c_sr_code

    --update da_course_distance_data5; slope and intercept
    --select 'start sub2', getdate()
    exec sp_da_step2_sub2 @c_course_uid, @c_distance_yards, @c_adjusted_draw_prefix, @c_sr_code

    --update da_course_distance_data5; r_square
    --select 'start sub3', getdate()
    exec sp_da_step2_sub3 @c_course_uid, @c_distance_yards, @c_adjusted_draw_prefix, @c_sr_code

    --update da_course_distance_data5; pound and formula
    --select 'start sub4', getdate()
    exec sp_da_step2_sub4 @c_course_uid, @c_distance_yards, @c_adjusted_draw_prefix, @c_sr_code

end
close four_cursor
deallocate cursor four_cursor

--populated and updated da_course_distance_data5
select 'populated and updated all fields in da_course_distance_data5'

go
if OBJECT_ID('dbo.sp_da_step2') is not null
    print '<<< CREATED PROCEDURE dbo.sp_da_step2 >>>'
else
    print '<<< FAILED CREATING PROCEDURE dbo.sp_da_step2 >>>'
go
grant execute on dbo.sp_da_step2 to level1
go
