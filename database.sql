DROP DATABASE IF EXISTS faculty_portal;
CREATE DATABASE faculty_portal;
\c faculty_portal;

-- The department table will have the names of the branches like: CSE, EE, ME etc
CREATE TABLE Department (
  Id SERIAL,
  name Varchar,
  PRIMARY KEY( Id )
);

-- Faculty table will store the details of all the existing faculties,HODs,Cross-cutting Faculties, Director etc
CREATE TABLE Faculty (
  Id SERIAL,
  Name varchar,
  dept_id Integer REFERENCES Department(Id),
  Email varchar,
  -- Profile varchar,
  Joined_On timestamp,
  Left_On timestamp,
  username varchar UNIQUE,
  password Varchar,
  PRIMARY KEY( Id )
);

-- The table POR will store the names of all the position of responsibilties like Dean Academic Affairs, etc.
-- CREATE TABLE POR (
--   Id SERIAL,
--   Name Varchar,
--   PRIMARY KEY( Id )
-- );

-- This table will store positions like: "FACULTY","HOD","DEAN_ACADEMIC_AFFAIRS","DIRECTOR" etc
CREATE TABLE Positions (
  Id Integer,
  name Varchar UNIQUE,
  PRIMARY KEY(Id)
);

-- This table will be used for dynamic routing
CREATE TABLE Route (
  Id SERIAL,
  applicant Integer REFERENCES Positions(Id),
  sender Integer REFERENCES Positions(Id),
  recipient Integer REFERENCES Positions(Id)
);

-- This table will have the position ID for each faculty to decide his role and get the corresponding route
CREATE TABLE Faculty_position (
  Faculty_id Integer REFERENCES Faculty(Id) ,
  Position_Id Integer REFERENCES Positions(Id),
  PRIMARY KEY(Faculty_id)
);

-- The HOD table will store the IDs and tenures of the faculty who were appointed the HOD of a given department
CREATE TABLE HOD (
  dept_id Integer REFERENCES Department(Id) ,
  faculty_id Integer REFERENCES Faculty(Id) ,
  start_date timestamp,
  end_date timestamp,
  PRIMARY KEY( dept_id )
);

-- This table will store the IDs of faculties who have served as HOD at some point in time
CREATE TABLE HOD_History (
  id SERIAL,
  dept_id Integer,
  faculty_id Varchar,
  start_date timestamp,
  end_date timestamp,
  rem_date timestamp
);

-- The HOD table will store the IDs and tenures of the faculty who are appointed at a POR 
CREATE TABLE CCF (
  id SERIAL,
  Position_id Integer REFERENCES Positions(Id),
  faculty_id Integer REFERENCES Faculty(Id),
  start_date timestamp,
  end_date timestamp,
  PRIMARY KEY(id)
);

-- This table will store the IDs of faculties who have served at any POR at some point in time
CREATE TABLE CCF_History (
  id SERIAL,
  Position_id Integer,
  faculty_id Integer,
  start_date timestamp,
  end_date timestamp,
  rem_date timestamp
);

-- This table will store the details of leaves of corresponding leave IDs of faculty
CREATE TABLE Leaves (
  Id Integer REFERENCES Faculty(Id),
  leaves_left Integer,
  total_leaves Integer,
  cur_leave_app_id Integer,
  next_year_leaves Integer,
  next_year_leaves_left Integer,
  PRIMARY KEY (Id)
);

CREATE TYPE STATUS AS ENUM( 'INITIATED', 'PENDING' , 'REJECTED' , 'APPROVED' , 'RENEW', 'MODIFIED');

-- The leave request table will store the IDs of the current leave applications 
CREATE TABLE Leave_Request (
  Id SERIAL ,
  leave_id Integer REFERENCES Leaves(Id),
  status STATUS,
  start_date timestamp,
  end_date timestamp,
  --Insert
  note text,
  signed_on timestamp,
  -- ------
  comments text,
  PRIMARY KEY(Id)
);

CREATE TABLE Leave_Approvals (
  Id SERIAL,
  LR_id Integer REFERENCES Leave_Request(Id),
  applicant Integer REFERENCES Faculty(Id),
  sender Integer REFERENCES Faculty(Id),
  recipient Integer REFERENCES Faculty(Id),
  -- Insert
  recipient_pos Integer REFERENCES Positions(Id),
  -- ----
  status STATUS,
  signed_On timestamp,
  comments text
);


