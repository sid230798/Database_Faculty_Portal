
-- ****************************************************************************

CREATE OR REPLACE FUNCTION T_hod_delete() RETURNS trigger AS
$$
DECLARE
    var RECORD;
BEGIN
    INSERT INTO HOD_History(dept_id, faculty_id, start_date, end_date, rem_date) VALUES(OLD.dept_id, OLD.faculty_id, OLD.start_date, OLD.end_date, now());
    SELECT into var * FROM Positions WHERE LOWER(name) = 'faculty';
    IF var IS NOT NULL THEN
        UPDATE Faculty_Position SET position_id = var.id WHERE faculty_id = OLD.faculty_id;
    END IF;

    RETURN NEW;
END
$$ LANGUAGE plpgsql;

CREATE TRIGGER on_delete_hod 
BEFORE DELETE ON HOD
FOR EACH ROW
EXECUTE PROCEDURE T_hod_delete();


-- ****************************************************************************


-- ALLOW UPDATE TO DATES ONLY
CREATE OR REPLACE FUNCTION T_hod_update() RETURNS trigger AS
$$
DECLARE
    var RECORD;
BEGIN
    -- INSERT INTO HOD_History(dept_id, faculty_id, start_date, end_date, rem_date) VALUES(OLD.dept_id, OLD.faculty_id, OLD.start_date, OLD.end_date, now());

    select into var * from Faculty where id = NEW.faculty_id;

    IF NEW.end_date < NEW.start_date then
        RAISE NOTICE 'Invalid HOD tenure. Check the joining and leaving date';
        return null;
    ELSIF NEW.start_date < var.Joined_On then 
        RAISE NOTICE 'Invalid Starting of tenure. The joining date is after the HOD tenure begins.';
        return null;
    ELSIF var.Left_On IS NOT NULL then
        IF NEW.end_date > var.Left_On then
            RAISE NOTICE 'The faculty has leaving date before the HOD tenure ends';
            return null;
        END IF;
    END IF;

    RETURN NEW;
END
$$ LANGUAGE plpgsql;


CREATE TRIGGER on_update_hod 
BEFORE UPDATE ON HOD
FOR EACH ROW
EXECUTE PROCEDURE T_hod_update();


-- ****************************************************************************


CREATE OR REPLACE FUNCTION T_ccf_delete() RETURNS trigger AS
$$
DECLARE
    var RECORD;
BEGIN
    INSERT INTO CCF_History(POR_id, faculty_id, start_date, end_date, rem_date) VALUES(OLD.POR_id, OLD.faculty_id, OLD.start_date, OLD.end_date, now());
    SELECT into var * FROM Positions WHERE LOWER(name) = 'faculty';
    IF var IS NOT NULL THEN
        UPDATE Faculty_Position SET position_id = var.id WHERE faculty_id = OLD.faculty_id;
    END IF;

    RETURN NEW;
END
$$ LANGUAGE plpgsql;

CREATE TRIGGER on_delete_ccf
BEFORE DELETE ON CCF
FOR EACH ROW
EXECUTE PROCEDURE T_ccf_delete();


-- ****************************************************************************


-- ALLOW UPDATE TO DATES ONLY
CREATE OR REPLACE FUNCTION T_ccf_update() RETURNS trigger AS
$$
DECLARE
    var RECORD;
BEGIN
    -- INSERT INTO CCF_History(POR_id, faculty_id, start_date, end_date, rem_date) VALUES(OLD.POR_id, OLD.faculty_id, OLD.start_date, OLD.end_date, now());

    select into var * from Faculty where id = NEW.faculty_id;

    IF NEW.end_date < NEW.start_date then
        RAISE NOTICE 'Invalid HOD tenure. Check the joining and leaving date';
        return null;
    ELSIF NEW.start_date < var.Joined_On then 
        RAISE NOTICE 'Invalid Starting of tenure. The joining date is after the HOD tenure begins.';
        return null;
    ELSIF var.Left_On IS NOT NULL then
        IF NEW.end_date > var.Left_On then
            RAISE NOTICE 'The faculty has leaving date before the HOD tenure ends';
            return null;
        END IF;
    END IF;

    RETURN NEW;
END
$$ LANGUAGE plpgsql;

CREATE TRIGGER on_update_ccf
BEFORE UPDATE ON CCF
FOR EACH ROW
EXECUTE PROCEDURE T_ccf_update();

-- ****************************************************************************