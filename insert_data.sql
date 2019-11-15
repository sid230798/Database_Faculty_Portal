INSERT INTO Department (Name) VALUES ('Computer Science');
INSERT INTO Department (Name) VALUES ('Electrical');
INSERT INTO Department (Name) VALUES ('Mechanical');
-- INSERT INTO Department (Name) VALUES ('Civil');
-- INSERT INTO Department (Name) VALUES ('Chemical');
-- INSERT INTO Department (Name) VALUES ('Metallurgy');

-- INSERT INTO POR (Name) VALUES ('Dean Faculty Affairs,');
-- INSERT INTO POR (Name) VALUES ('Associate Dean Faculty Affairs');
-- INSERT INTO POR (Name) VALUES ('Director');


INSERT INTO Positions (Id, Name) VALUES ( 1,'Faculty' );
INSERT INTO Positions (Id, Name) VALUES ( 2, 'HOD');
INSERT INTO Positions (Id, Name) VALUES ( 3, 'Associate Dean Faculty Affairs');
INSERT INTO Positions (Id, Name) VALUES ( 4, 'Dean Faculty Affairs');
INSERT INTO Positions (Id, Name) VALUES ( 5, 'Director');


INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('2016csb1055', 1, '2016csb1055@iitrpr.ac.in', '2017-08-01', 'A', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('2016csb1056', 2, '2016csb1056@iitrpr.ac.in', '2015-04-01', 'B', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('2016csb1057', 3, '2016csb1057@iitrpr.ac.in', '2015-04-01', 'C', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('2016csb1058', 1, '2016csb1058@iitrpr.ac.in', '2015-04-01', 'D', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('2016csb1059', 2, '2016csb1059@iitrpr.ac.in', '2015-04-01', 'E', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('2016csb1060', 3, '2016csb1060@iitrpr.ac.in', '2015-04-01', 'F', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('2016csb1061', 1, '2016csb1061@iitrpr.ac.in', '2015-04-01', 'G', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('2016csb1062', 2, '2016csb1062@iitrpr.ac.in', '2015-04-01', 'H', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('2016csb1063', 3, '2016csb1063@iitrpr.ac.in', '2015-04-01', 'I', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('2016csb1064', 1, '2016csb1064@iitrpr.ac.in', '2015-04-01', 'J', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('2016csb1065', 2, '2016csb1065@iitrpr.ac.in', '2015-04-01', 'K', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('2016csb1066', 3, '2016csb1066@iitrpr.ac.in', '2015-04-01', 'L', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('2016csb1067', 1, '2016csb1067@iitrpr.ac.in', '2015-04-01', 'M', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('2016csb1068', 2, '2016csb1068@iitrpr.ac.in', '2015-04-01', 'N', 'prerna');



INSERT INTO Route (applicant, sender, recipient) VALUES (1,1,2);
INSERT INTO Route (applicant, sender, recipient) VALUES (1,2,4);
INSERT INTO Route (applicant, sender, recipient) VALUES (2,2,5);
INSERT INTO Route (applicant, sender, recipient) VALUES (3,3,4);
INSERT INTO Route (applicant, sender, recipient) VALUES (3,4,5);
INSERT INTO Route (applicant, sender, recipient) VALUES (4,4,5);


INSERT INTO HOD (dept_id, Faculty_Id, start_date, end_date) VALUES (1, 1, '2017-08-01','2019-08-01');
INSERT INTO HOD (dept_id, Faculty_Id, start_date, end_date) VALUES (2, 2, '2017-08-01','2019-08-01');
INSERT INTO HOD (dept_id, Faculty_Id, start_date, end_date) VALUES (3, 3, '2017-08-01','2019-08-01');


INSERT INTO CCF (Position_id, Faculty_Id, start_date, end_date) VALUES (3,12,'2017-07-01', '2019-07-01');
INSERT INTO CCF (Position_id, Faculty_Id, start_date, end_date) VALUES (4,13,'2017-07-01', '2019-07-01');
INSERT INTO CCF (Position_id, Faculty_Id, start_date, end_date) VALUES (5,14,'2017-07-01', '2019-07-01');


