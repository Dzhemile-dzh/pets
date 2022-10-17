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
