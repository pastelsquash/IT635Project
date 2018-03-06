DELIMITER $$
drop procedure if exists getSchedule;

CREATE PROCEDURE getSchedule (IN teacher varchar(255))
BEGIN

select classes.prefix, classes.num, classes.title, schedule.dayOfWeek, schedule.StartTime, schedule.EndTime from classes,schedule where classes.id = schedule.classID and schedule.instructor = teacher;

END $$
DELIMITER ;
