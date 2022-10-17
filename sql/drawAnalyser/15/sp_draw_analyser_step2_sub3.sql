if OBJECT_ID('dbo.sp_draw_analyser_step2_sub3') is not null
begin
    drop procedure dbo.sp_draw_analyser_step2_sub3
    if OBJECT_ID('dbo.sp_draw_analyser_step2_sub3') is not null
        print '<<< FAILED DROPPING PROCEDURE dbo.sp_draw_analyser_step2_sub3 >>>'
    else
        print '<<< DROPPED PROCEDURE dbo.sp_draw_analyser_step2_sub3 >>>'
end
go
create procedure dbo.sp_draw_analyser_step2_sub3
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
if OBJECT_ID('dbo.sp_draw_analyser_step2_sub3') is not null
    print '<<< CREATED PROCEDURE dbo.sp_draw_analyser_step2_sub3 >>>'
else
    print '<<< FAILED CREATING PROCEDURE dbo.sp_draw_analyser_step2_sub3 >>>'
go
grant execute on dbo.sp_draw_analyser_step2_sub3 to level1
go
