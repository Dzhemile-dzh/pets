if OBJECT_ID('dbo.sp_draw_analyser_step1') is not null
begin
    drop procedure dbo.sp_draw_analyser_step1
    if OBJECT_ID('dbo.sp_draw_analyser_step1') is not null
        print '<<< FAILED DROPPING PROCEDURE dbo.sp_draw_analyser_step1 >>>'
    else
        print '<<< DROPPED PROCEDURE dbo.sp_draw_analyser_step1 >>>'
end
go
--------------------------------------------------------

create procedure dbo.sp_draw_analyser_step1 @in_year integer, @in_quarter integer
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

select 'Running sub procedure "sp_draw_analyser_step1_sub1" to calc dist_to_winner from dist_to_horse_in_front for some foreign races'
exec sp_draw_analyser_step1_sub1

select 'work_horse..da_race_instance and work_horse..da_horse_race now completed!'
--------------------------------------------------------
go
if OBJECT_ID('dbo.sp_draw_analyser_step1') is not null
    print '<<< CREATED PROCEDURE dbo.sp_draw_analyser_step1 >>>'
else
    print '<<< FAILED CREATING PROCEDURE dbo.sp_draw_analyser_step1 >>>'
go
grant execute on dbo.sp_draw_analyser_step1 to level1
go
