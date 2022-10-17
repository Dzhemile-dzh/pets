-- extracted from TEST15 at окт 24 12:22:48.934
/***************************************************************
 THIS EXTRACT IS FOR INFORMATION ONLY
 DO NOT USE THIS EXTRACT TO RE-CREATE OBJECTS
 IT IS NOT GUARANTEED TO BE AS COMPLETE AS THE ORIGINAL OBJECT
 BEST PRACTICE IS TO  MAINTAIN SQL OBJECTS IN PROPER SOURCE FILES
***************************************************************/

use api_horses
go

if object_id('sp_api_get_meetings_for_day') is not null
	drop proc sp_api_get_meetings_for_day
go
CREATE PROCEDURE dbo.sp_api_get_meetings_for_day
    @date datetime, @runners_needed smallint = 0, @is_worldwide smallint = 0
AS
    declare @start_date VARCHAR(16)
    declare @end_date VARCHAR(16)
    declare @sql VARCHAR(3000)

    select @start_date = CONVERT(varchar, @date, 111) + ' 00:00'
    select @end_date = CONVERT(varchar, @date, 111) + ' 23:59'

    CREATE TABLE #result_data(
        course_name VARCHAR(30) null,
        crs_name VARCHAR(30) null,
        crs_id SMALLINT null,
        rp_abbrev_3 CHAR(3) null,
        course_country CHAR(3) null,
        ttype CHAR(1) null,
        r_date DATETIME null,
        has_finished_race SMALLINT,
        abandoned SMALLINT,
        going_desc VARCHAR(255) null,
        stalls_position VARCHAR(255) null,
        pre_going_desc VARCHAR(255) null,
        pre_weather_desc VARCHAR(255) null,
        fgn SMALLINT null
    )

    SELECT @sql = 'INSERT INTO #result_data
             SELECT  CASE WHEN c2.style_name IS NOT NULL THEN c2.style_name ELSE c.style_name END course_name,
               CASE WHEN c2.course_name IS NOT NULL THEN c2.course_name ELSE c.course_name END crs_name,
               CASE WHEN c2.course_uid IS NOT NULL THEN c2.course_uid ELSE c.course_uid END crs_id,
               c.rp_abbrev_3,
               c.country_code course_country,
               CASE WHEN c2.course_type_code IS NOT NULL THEN c2.course_type_code ELSE c.course_type_code END ttype,
               CONVERT(VARCHAR, ri.race_datetime, 101) r_date,
               CASE WHEN c.course_name IN (''GB'', ''IRE'') AND ri.race_datetime > ''' + CONVERT(varchar, getdate(), 111) + ' 00:00'' AND ri.race_status_code = ''R''  AND ri.formbook_yn = ''Y'' THEN 1 ELSE 0 END has_finished_race,
               CASE WHEN ri.race_status_code = ''A'' THEN 1 ELSE 0 END abandoned,
               md.going_desc going_desc,
               md.stalls_position,
               pmd.going_desc pre_going_desc,
               pmd.weather_details pre_weather_desc,
               (CASE WHEN c.country_code IN (''GB'', ''IRE'') THEN 0 ELSE 1 END) fgn

        FROM race_instance ri
        ' +
        CASE WHEN @runners_needed <> 0 THEN
            ' INNER  JOIN pre_horse_race phr ON (phr.race_instance_uid = ri.race_instance_uid) '
            ELSE
                ''
        END
        + '
                INNER JOIN course c ON (c.course_uid = ri.course_uid)
                LEFT JOIN course c2 ON c.rp_abbrev_3 = c2.rp_abbrev_3 AND c.country_code = c2.country_code AND c2.course_name NOT LIKE ''%(A.W)%'' AND c2.course_uid IN (SELECT course_uid FROM race_instance WHERE race_datetime BETWEEN ''' + @start_date + ''' AND ''' + @start_date + ''')
                LEFT JOIN pre_meeting_details pmd ON (pmd.course_uid = CASE WHEN c2.course_uid IS NOT NULL THEN c2.course_uid ELSE c.course_uid END AND pmd.meeting_date BETWEEN ''' + @start_date + ''' AND ''' + @start_date + '''  )
                LEFT JOIN meeting_details md ON (md.course_uid = CASE WHEN c2.course_uid IS NOT NULL THEN c2.course_uid ELSE c.course_uid
                END AND md.meeting_date between ''' + @start_date + ''' AND ''' + @start_date + ''')
        ' +
        CASE WHEN @is_worldwide <> 0 THEN
            ' LEFT JOIN race_group r_grp ON ri.race_group_uid = r_grp.race_group_uid '
            ELSE
                ''
        END
        + '
        WHERE ((CASE WHEN c.course_type_code = ''P'' AND c.country_code = ''GB'' THEN 0 ELSE 1 END) = 1
        ' +
        CASE WHEN @is_worldwide <> 0 THEN
            ' OR r_grp.race_group_desc IN (''Group 1'', ''Group 2'', ''Group 3'', ''Listed'') '
            ELSE
                ''
        END
        + ')
                AND   ri.race_datetime between ''' + @start_date + ''' AND ''' + @end_date + '''
                AND   c.course_name not like (''%P-T-P%'')
                AND   ri.race_type_code != ''P'''


    exec (@sql)

    SELECT #result_data.course_name,
        #result_data.crs_name,
        #result_data.crs_id,
        #result_data.rp_abbrev_3,
        #result_data.course_country,
        #result_data.ttype,
        #result_data.r_date,
        CASE WHEN SUM(#result_data.has_finished_race) >= 1 THEN 1 ELSE 0 END has_finished_race,
        CASE WHEN SUM(#result_data.abandoned) >= 1 THEN 1 ELSE 0 END abandoned,
        #result_data.going_desc,
        #result_data.stalls_position,
        #result_data.pre_going_desc,
        #result_data.pre_weather_desc,
        #result_data.fgn
    INTO #grouped_data
    FROM #result_data
    GROUP BY #result_data.course_name, #result_data.crs_name, #result_data.crs_id, #result_data.rp_abbrev_3, #result_data.course_country, #result_data.ttype, #result_data.r_date, #result_data.going_desc, #result_data.stalls_position, #result_data.pre_going_desc, #result_data.pre_weather_desc, #result_data.fgn
    ORDER BY abandoned, (CASE WHEN #result_data.course_country IN ('GB', 'IRE') THEN 0 ELSE 1 END), #result_data.rp_abbrev_3

    DROP TABLE #result_data

    SELECT #grouped_data.course_name,
        #grouped_data.crs_name,
        #grouped_data.crs_id,
        #grouped_data.rp_abbrev_3,
        #grouped_data.course_country,
        #grouped_data.ttype, #grouped_data.r_date,
        #grouped_data.has_finished_race,
        #grouped_data.abandoned,
        #grouped_data.going_desc,
        #grouped_data.stalls_position,
        #grouped_data.pre_going_desc,
        #grouped_data.pre_weather_desc,
        #grouped_data.fgn
    FROM #grouped_data
go

exec sp_procxmode 'sp_api_get_meetings_for_day', 'AnyMode'
go
