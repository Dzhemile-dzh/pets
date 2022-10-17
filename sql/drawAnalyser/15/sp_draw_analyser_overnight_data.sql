if OBJECT_ID('dbo.sp_draw_analyser_overnight_data') is not null
begin
    drop procedure dbo.sp_draw_analyser_overnight_data
    if OBJECT_ID('dbo.sp_draw_analyser_overnight_data') is not null
        print '<<< FAILED DROPPING PROCEDURE dbo.sp_draw_analyser_overnight_data >>>'
    else
        print '<<< DROPPED PROCEDURE dbo.sp_draw_analyser_overnight_data >>>'
end
go

create procedure dbo.sp_draw_analyser_overnight_data

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
if OBJECT_ID('dbo.sp_draw_analyser_overnight_data') is not null
    print '<<< CREATED PROCEDURE dbo.sp_draw_analyser_overnight_data >>>'
else
    print '<<< FAILED CREATING PROCEDURE dbo.sp_draw_analyser_overnight_data >>>'
go
grant execute on dbo.sp_draw_analyser_overnight_data to level1
go
