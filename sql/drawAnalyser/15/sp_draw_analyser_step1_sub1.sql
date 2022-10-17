if OBJECT_ID('dbo.sp_draw_analyser_step1_sub1') is not null
begin
    drop procedure dbo.sp_draw_analyser_step1_sub1
    if OBJECT_ID('dbo.sp_draw_analyser_step1_sub1') is not null
        print '<<< FAILED DROPPING PROCEDURE dbo.sp_draw_analyser_step1_sub1 >>>'
    else
        print '<<< DROPPED PROCEDURE dbo.sp_draw_analyser_step1_sub1 >>>'
end
go
create procedure dbo.sp_draw_analyser_step1_sub1
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
if OBJECT_ID('dbo.sp_draw_analyser_step1_sub1') is not null
    print '<<< CREATED PROCEDURE dbo.sp_draw_analyser_step1_sub1 >>>'
else
    print '<<< FAILED CREATING PROCEDURE dbo.sp_draw_analyser_step1_sub1 >>>'
go
grant execute on dbo.sp_draw_analyser_step1_sub1 to level1
go
