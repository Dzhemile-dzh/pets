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
