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

    DELETE FROM HOD WHERE dept_id = OLD.dept_id;

    RETURN NEW;
END
$$ LANGUAGE plpgsql;

CREATE TRIGGER on_delete_hod 
AFTER DELETE ON HOD
FOR EACH ROW
EXECUTE PROCEDURE T_hod_delete();


-- ****************************************************************************


-- ALLOW UPDATE TO DATES ONLY
CREATE OR REPLACE FUNCTION T_hod_update() RETURNS trigger AS
$$
DECLARE
    var RECORD;
    var2 RECORD;
BEGIN
    -- INSERT INTO HOD_History(dept_id, faculty_id, start_date, end_date, rem_date) VALUES(OLD.dept_id, OLD.faculty_id, OLD.start_date, OLD.end_date, now());

    INSERT INTO HOD_History(dept_id, faculty_id, start_date, end_date, rem_date) VALUES(OLD.dept_id, OLD.faculty_id, OLD.start_date, OLD.end_date, now());

    IF NEW.faculty_id <> OLD.faculty_id THEN
        SELECT into var * FROM Positions WHERE LOWER(name) = 'faculty';
        SELECT into var2 * FROM Positions WHERE LOWER(name) = 'hod';
        IF var IS NOT NULL THEN
            UPDATE Faculty_Position SET position_id = var.id WHERE faculty_id = OLD.faculty_id;
            UPDATE Faculty_Position SET position_id = var2.id WHERE faculty_id = NEW.faculty_id;
        END IF;
    END IF;

    RETURN NEW;
END
$$ LANGUAGE plpgsql;


CREATE TRIGGER on_update_hod 
AFTER UPDATE ON HOD
FOR EACH ROW
EXECUTE PROCEDURE T_hod_update();


-- ****************************************************************************


CREATE OR REPLACE FUNCTION T_ccf_delete() RETURNS trigger AS
$$
DECLARE
    var RECORD;
BEGIN
    INSERT INTO CCF_History(Position_id, faculty_id, start_date, end_date, rem_date) VALUES(OLD.position_id, OLD.faculty_id, OLD.start_date, OLD.end_date, now());
    SELECT into var * FROM Positions WHERE LOWER(name) = 'faculty';

    IF var IS NOT NULL THEN
        UPDATE Faculty_Position SET position_id = var.id WHERE faculty_id = OLD.faculty_id;
    END IF;

    DELETE FROM CCF WHERE Position_id = OLD.Position_id;

    RETURN NEW;
END
$$ LANGUAGE plpgsql;

CREATE TRIGGER on_delete_ccf
AFTER DELETE ON CCF
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
    INSERT INTO CCF_History(Position_id, faculty_id, start_date, end_date, rem_date) VALUES(OLD.position_id, OLD.faculty_id, OLD.start_date, OLD.end_date, now());

    IF NEW.faculty_id <> OLD.faculty_id THEN
        SELECT into var * FROM Positions WHERE LOWER(name) = 'faculty';
        IF var IS NOT NULL THEN
            UPDATE Faculty_Position SET position_id = var.id WHERE faculty_id = OLD.faculty_id;
            UPDATE Faculty_Position SET position_id = OLD.position_id WHERE faculty_id = NEW.faculty_id;
        END IF;
    END IF;

    RETURN NEW;
END
$$ LANGUAGE plpgsql;

CREATE TRIGGER on_update_ccf
AFTER UPDATE ON CCF
FOR EACH ROW
EXECUTE PROCEDURE T_ccf_update();
