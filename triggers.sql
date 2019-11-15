
-- ****************************************************************************


create or replace function T_insert_faculty() returns trigger as
$BODY$
begin

 IF NEW.Left_On IS NOT NULL then
  IF NEW.Left_On < NEW.Joined_On then
    RAISE NOTICE 'Invalid tenure. Check the joining and leaving date';
    return null;
  ELSE
    return NEW;
  END IF;
 ELSE 
  return NEW;
 END IF;
end;
$BODY$
language plpgsql;

create trigger on_insert_faculty
before insert on Faculty
for each row 
execute procedure T_insert_faculty();


-- ****************************************************************************


create or replace function T_after_insert_faculty() returns trigger as
$BODY$
declare
  var RECORD;
begin

 INSERT INTO Leaves (Id, leaves_left, total_leaves, cur_leave_app_id, next_year_leaves, next_year_leaves_left) VALUES ( NEW.Id, 20, 20, 0, 20, 20 );
 SELECT into var * FROM Positions WHERE LOWER(name) = 'faculty';
 IF var IS NOT NULL THEN
  INSERT INTO Faculty_position ( Faculty_id , Position_Id ) VALUES (NEW.Id , var.Id); 
 END IF;
 RETURN NEW;
end;
$BODY$
language plpgsql;

create trigger after_insert_faculty
after insert on Faculty
for each row 
execute procedure T_after_insert_faculty();


-- ****************************************************************************


create or replace function T_after_insert_HOD() returns trigger as
$BODY$
declare
  var RECORD;
begin

 SELECT into var * FROM Positions WHERE LOWER(name) = 'hod';
 IF var IS NOT NULL THEN
  UPDATE Faculty_position SET Position_Id = var.Id WHERE Faculty_id = NEW.faculty_id;
 END IF;
 RETURN NEW;
end;
$BODY$
language plpgsql;

create trigger after_insert_HOD
after insert on HOD
for each row 
execute procedure T_after_insert_HOD();



-- ****************************************************************************


-- TODO
create or replace function T_after_insert_CCF() returns trigger as
$BODY$
declare
  var RECORD;
begin

 -- SELECT into var * FROM Positions WHERE LOWER(name) = 'CCF';
 -- IF var IS NOT NULL THEN
  UPDATE Faculty_position SET Position_Id = NEW.Position_Id WHERE Faculty_id = NEW.faculty_id;
 -- END IF;
 RETURN NEW;
end;
$BODY$
language plpgsql;

create trigger after_insert_CCF
after insert on CCF
for each row 
execute procedure T_after_insert_CCF();


-- ****************************************************************************


-- Trigger to check if the start and end dates of the posts lie within the serving time of the faculty
create or replace function T_insert_POR() returns trigger as
$$
declare
	var RECORD;

begin

	select into var * from Faculty where id = NEW.faculty_id;

	IF NEW.end_date < NEW.start_date then
 		RAISE NOTICE 'Invalid tenure. Check the joining and leaving date';
 		return null;
 	ELSIF NEW.start_date < var.Joined_On then 
 		RAISE NOTICE 'Invalid Starting of tenure. The joining date is after the tenure begins.';
 		return null;
 	ELSIF var.Left_On IS NOT NULL then
 		IF NEW.end_date > var.Left_On then
 			RAISE NOTICE 'The faculty has leaving date before the tenure ends';
 			return null;
 		END IF;
 	END IF;
  RETURN NEW;
end;
$$
language plpgsql;


create trigger on_insert_HOD
before insert on HOD
for each row 
execute procedure T_insert_POR();

create trigger on_insert_CCF
before insert on CCF
for each row 
execute procedure T_insert_POR();


-- ****************************************************************************


create or replace function T_insert_leave_request() returns trigger as
$BODY$
declare 
  var RECORD;
  var2 RECORD;
  app_fac RECORD;
  receiver_fac RECORD;
begin

 -- Get the position ID
 SELECT into var * FROM Faculty_position WHERE Faculty_id = NEW.leave_id;
 
 -- start the routing 
 SELECT into var2 * FROM Route WHERE applicant = var.Position_Id and sender = var.Position_Id;

 SELECT into app_fac * FROM Faculty WHERE Id = NEW.leave_id;

 -- possible positions: 1:Faculty, 2:HOD, 3:Associate Dean, 4:Dean, 5:Director
 IF var2.recipient = 1 THEN
  RAISE NOTICE 'Invalid Position. Faculty cannot approve leave from another faculty.';
 ELSIF var2.recipient = 2 THEN
  SELECT into receiver_fac * FROM HOD WHERE dept_id = app_fac.dept_id;
 ELSIF var2.recipient = 3 OR var2.recipient = 4 OR var2.recipient = 5 THEN
  SELECT into receiver_fac * FROM CCF WHERE Position_id = var.Position_id;
 ELSE
  RAISE NOTICE 'Invalid Position. The targeted person is Unknown.';
 END IF;

 INSERT INTO Leave_Approvals (LR_id, applicant, sender, recipient, status, signed_On, comments) 
 VALUES (NEW.Id , NEW.leave_id, NEW.leave_id, receiver_fac.faculty_id, 'PENDING' , now() , NEW.comments);
 RETURN NEW;
end;
$BODY$
language plpgsql;

create trigger on_insert_leave_request
after insert on Leave_Request
for each row 
execute procedure T_insert_leave_request();


-- ****************************************************************************


create or replace function T_update_leave_request() returns trigger as
$BODY$
declare 
  var RECORD;
  var2 RECORD;
  app_fac RECORD;
  receiver_fac RECORD;
begin

 -- Get the position ID
 SELECT into var * FROM Faculty_position WHERE Faculty_id = NEW.leave_id;
 
 -- start the routing 
 SELECT into var2 * FROM Route WHERE applicant = var.Position_Id and sender = var.Position_Id;

 SELECT into app_fac * FROM Faculty WHERE Id = NEW.leave_id;

 -- possible positions: 1:Faculty, 2:HOD, 3:Associate Dean, 4:Dean, 5:Director
 IF var2.recipient = 1 THEN
  RAISE NOTICE 'Invalid Position. Faculty cannot approve leave from another faculty.';
 ELSIF var2.recipient = 2 THEN
  SELECT into receiver_fac * FROM HOD WHERE dept_id = app_fac.dept_id;
 ELSIF var2.recipient = 3 OR var2.recipient = 4 OR var2.recipient = 5 THEN
  SELECT into receiver_fac * FROM CCF WHERE Position_id = var.Position_id;
 ELSE
  RAISE NOTICE 'Invalid Position. The targeted person is Unknown.';
 END IF;

 INSERT INTO Leave_Approvals (LR_id, applicant, sender, recipient, status, signed_On, comments) 
 VALUES (NEW.Id , NEW.leave_id, NEW.leave_id, receiver_fac.faculty_id, 'PENDING' , now() , NEW.comments);
 RETURN NEW;
end;
$BODY$
language plpgsql;

create trigger on_update_leave_request
after insert on Leave_Request
for each row 
execute procedure T_insert_leave_request();


-- ****************************************************************************


create or replace function T_update_leave_approval() returns trigger as
$BODY$
declare 
  var RECORD;
  var2 RECORD;
  app_fac RECORD;
  receiver_fac RECORD;
begin

 IF NEW.status = 'REJECTED' THEN

    UPDATE Leave_Request SET status = 'REJECTED', comments = NEW.comments WHERE ID = NEW.LR_id;
    UPDATE Leaves SET cur_leave_app_id = 0 WHERE ID = NEW.leave_id;

 ELSIF NEW.status = 'APPROVED' THEN

    SELECT into var2 * FROM Route WHERE applicant = NEW.applicant and sender = var.recipient;
    SELECT into app_fac * FROM Faculty WHERE Id = NEW.applicant;

    IF var2.recipient = 1 THEN
      RAISE NOTICE 'Invalid Position. Faculty cannot approve leave from another faculty.';
    ELSIF var2.recipient = 2 THEN
      SELECT into receiver_fac * FROM HOD WHERE dept_id = app_fac.dept_id;
    ELSIF var2.recipient = 3 OR var2.recipient = 4 OR var2.recipient = 5 THEN
      SELECT into var * FROM Faculty_position WHERE Faculty_id = var2.recipient;
      SELECT into receiver_fac * FROM CCF WHERE Position_id = var.Position_id;
    ELSE
      RAISE NOTICE 'Invalid Position. The targeted person is Unknown.';
    END IF;
    
    INSERT INTO Leave_Approvals (LR_id, applicant, sender, recipient, status, signed_On, comments) 
    VALUES (NEW.LR_id , NEW.applicant, NEW.recipient, receiver_fac.faculty_id, 'PENDING' , now() , NEW.comments);

  ELSIF NEW.status = 'RENEW' THEN
    UPDATE Leave_Request SET status = 'RENEW' WHERE id = NEW.LR_id;
  END IF;

  RETURN NEW;
end;
$BODY$
language plpgsql;

create trigger on_update_leave_approval
after update on Leave_Approvals
for each row 
execute procedure T_update_leave_approval();

