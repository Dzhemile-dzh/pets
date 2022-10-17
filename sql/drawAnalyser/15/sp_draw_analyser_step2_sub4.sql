if OBJECT_ID('dbo.sp_draw_analyser_step2_sub4') is not null
begin
    drop procedure dbo.sp_draw_analyser_step2_sub4
    if OBJECT_ID('dbo.sp_draw_analyser_step2_sub4') is not null
        print '<<< FAILED DROPPING PROCEDURE dbo.sp_draw_analyser_step2_sub4 >>>'
    else
        print '<<< DROPPED PROCEDURE dbo.sp_draw_analyser_step2_sub4 >>>'
end
go

--------------------------------------------------------

create procedure dbo.sp_draw_analyser_step2_sub4
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

if OBJECT_ID('dbo.sp_draw_analyser_step2_sub4') is not null
    print '<<< CREATED PROCEDURE dbo.sp_draw_analyser_step2_sub4 >>>'
else
    print '<<< FAILED CREATING PROCEDURE dbo.sp_draw_analyser_step2_sub4 >>>'
go
grant execute on dbo.sp_draw_analyser_step2_sub4 to level1
go
