if OBJECT_ID('dbo.sp_draw_analyser_step2_sub1') is not null
begin
    drop procedure dbo.sp_draw_analyser_step2_sub1
    if OBJECT_ID('dbo.sp_draw_analyser_step2_sub1') is not null
        print '<<< FAILED DROPPING PROCEDURE dbo.sp_draw_analyser_step2_sub1 >>>'
    else
        print '<<< DROPPED PROCEDURE dbo.sp_draw_analyser_step2_sub1 >>>'
end
go
create procedure dbo.sp_draw_analyser_step2_sub1
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
if OBJECT_ID('dbo.sp_draw_analyser_step2_sub1') is not null
    print '<<< CREATED PROCEDURE dbo.sp_draw_analyser_step2_sub1 >>>'
else
    print '<<< FAILED CREATING PROCEDURE dbo.sp_draw_analyser_step2_sub1 >>>'
go
grant execute on dbo.sp_draw_analyser_step2_sub1 to level1
go
