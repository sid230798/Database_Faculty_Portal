INSERT INTO Department (Name) VALUES ('Computer Science');
INSERT INTO Department (Name) VALUES ('Electrical');
INSERT INTO Department (Name) VALUES ('Mechanical');


INSERT INTO Positions (Id, Name) VALUES ( 1,'Faculty' );
INSERT INTO Positions (Id, Name) VALUES ( 2, 'HOD');
INSERT INTO Positions (Id, Name) VALUES ( 3, 'Associate Dean Faculty Affairs');
INSERT INTO Positions (Id, Name) VALUES ( 4, 'Dean Faculty Affairs');
INSERT INTO Positions (Id, Name) VALUES ( 5, 'Director');


INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('Dr. Somitra Sanadhya', 1, 'sanadhya@iitrpr.ac.in', '2015-04-01', 'SS', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('Dr. Ramesh Garg', 2, 'rgarg@iitrpr.ac.in', '2015-04-01', 'RG', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('Dr. Ekta Singla', 3, 'ektasing@iitrpr.ac.in', '2015-04-01', 'ES', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('Dr. Abhinav Dhall', 1, 'abhinav@iitrpr.ac.in', '2015-04-01', 'AD', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('Dr. Ashwani Sharma', 2, 'ashwani@iitrpr.ac.in', '2015-04-01', 'AS', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('Dr. Anupam Agrawal', 3, 'anupam@iitrpr.ac.in', '2015-04-01', 'AA', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('Dr. Balwinder Sodhi', 1, 'sodhi@iitrpr.ac.in', '2015-04-01', 'BS', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('Dr. Brajesh Rawat', 2, 'brajesh@iitrpr.ac.in', '2015-04-01', 'BR', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('Dr. Dhiraj K. Mahajan', 3, 'dkm@iitrpr.ac.in', '2015-04-01', 'DKM', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('Dr. Neeraj Goel', 1, 'neeraj@iitrpr.ac.in', '2015-04-01', 'NG', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('Dr. Devarshi Das', 2, 'devarshi@iitrpr.ac.in', '2015-04-01', 'DD', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('Dr. J.S Sahambi', 2, 'sahambi@iitrpr.ac.in', '2015-04-01', 'JSS', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('Prof. Deepak Kashyap', 1, 'deepak@iitrpr.ac.in', '2015-04-01', 'DK', 'prerna');
INSERT INTO faculty (Name, dept_id, Email, Joined_On, username, password) VALUES ('Prof. S. K. Das', 3, 'skdas@iitrpr.ac.in', '2015-04-01', 'SKD', 'prerna');


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

-- Faculty
--INSERT INTO LEAVES (Id, leaves_left, total_leaves, cur_leave_app_id, next_year_leaves, next_year_leaves_left) VALUES (4, 19, 20, 1, 20, 20);
INSERT INTO leave_request(leave_id,status,start_date,end_date, signed_on, comments) VALUES ( 4,'PENDING','2019-11-09','2019-11-13','now()', 'Paper Presentation in Australia');

-- Faculty
--INSERT INTO LEAVES (Id, leaves_left, total_leaves, cur_leave_app_id, next_year_leaves, next_year_leaves_left) VALUES (5, 19, 20, 1, 20, 20);
INSERT INTO leave_request(leave_id,status,start_date,end_date, signed_on, comments) VALUES ( 5,'PENDING','2019-11-09','2019-11-13','now()','Need to go home for a wedding');

-- HOD
--INSERT INTO LEAVES (Id, leaves_left, total_leaves, cur_leave_app_id, next_year_leaves, next_year_leaves_left) VALUES (3, 19, 20, 1, 20, 20);
INSERT INTO leave_request(leave_id,status,start_date,end_date,signed_on,comments) VALUES ( 3,'PENDING','2019-11-09','2019-11-13','now()','Conference in Dubai');

-- {"username" : "SS", "name" : "Dr. Somitra Sanadhya", "email" : "sanadhya@iitrpr.ac.in", "password" : "prerna","Overview": "Interested in Cryptography", "Publication" : [{"Date" : "1998", "Paper" : "Quantum Crypto", "Conf" : "CCF 2017 Conference, Mac Hill"}, {"Date" : "1998", "Paper" : "Proof for secuirty of Quantum Cryptography", "Conf" : "CCF 2018 Conference, Mac Hill"}], "Education" : [{ "Study" : "IIT Ropar B.Tech CSE", "Year" : "1998" },{ "Study" : "Phd Waterloo Univrsity", "Year" : "2003"}],"Award" : [{"Title" : "Best IEEE Conference Paper", "Date" : "Sept 2017"}, {"Title" : "Best Doctorialship Award", "Date" : "May 2014"}],"Grants" : [ ], "Teaching" : [{"Course" : "Crypto", Date: "2018 Fall"}, {"Course" : "Crypto Systems", "Date" : "2019 Spring"}]}

-- {"username" : "RG", "name" : "Dr. Ramesh Garg", "email" : "rgarg@iitrpr.ac.in", "password" : "prerna","Overview": "Interested in Cryptography", "Publication" : [{"Date" : "1998", "Paper" : "Quantum Crypto", "Conf" : "CCF 2017 Conference, Mac Hill"}, {"Date" : "1998", "Paper" : "Proof for secuirty of Quantum Cryptography", "Conf" : "CCF 2018 Conference, Mac Hill"}], "Education" : [{ "Study" : "IIT Ropar B.Tech CSE", "Year" : "1998" },{ "Study" : "Phd Waterloo Univrsity", "Year" : "2003"}],"Award" : [{"Title" : "Best IEEE Conference Paper", "Date" : "Sept 2017"}, {"Title" : "Best Doctorialship Award", "Date" : "May 2014"}],"Grants" : [ ], "Teaching" : [{"Course" : "Crypto", Date: "2018 Fall"}, {"Course" : "Crypto Systems", "Date" : "2019 Spring"}]}

-- {"username" : "ES", "name" : "Dr. Ekta Singla", "email" : "ektasing@iitrpr.ac.in", "password" : "prerna","Overview": "Interested in ME", "Publication" : [{"Date" : "1998", "Paper" : "Motor Engines", "Conf" : "CCF 2017 Conference, Mac Hill"}, {"Date" : "1998", "Paper" : "Building long lasting engines", "Conf" : "CCF 2018 Conference, Mac Hill"}], "Education" : [{ "Study" : "IIT Ropar B.Tech CSE", "Year" : "1998" },{ "Study" : "Phd Waterloo Univrsity", "Year" : "2003"}],"Award" : [{"Title" : "Best IEEE Conference Paper", "Date" : "Sept 2017"}, {"Title" : "Best Doctorialship Award", "Date" : "May 2014"}],"Grants" : [ ], "Teaching" : [{"Course" : "Crypto", Date: "2018 Fall"}, {"Course" : "Crypto Systems", "Date" : "2019 Spring"}]}

-- {"username" : "AD", "name" : "Dr. Abhinav Dhall", "email" : "abhinav@iitrpr.ac.in", "password" : "prerna","Overview": "Interested in Cryptography", "Publication" : [{"Date" : "1998", "Paper" : "Quantum Crypto", "Conf" : "CCF 2017 Conference, Mac Hill"}, {"Date" : "1998", "Paper" : "Proof for secuirty of Quantum Cryptography", "Conf" : "CCF 2018 Conference, Mac Hill"}], "Education" : [{ "Study" : "IIT Ropar B.Tech CSE", "Year" : "1998" },{ "Study" : "Phd Waterloo Univrsity", "Year" : "2003"}],"Award" : [{"Title" : "Best IEEE Conference Paper", "Date" : "Sept 2017"}, {"Title" : "Best Doctorialship Award", "Date" : "May 2014"}],"Grants" : [ ], "Teaching" : [{"Course" : "Crypto", Date: "2018 Fall"}, {"Course" : "Crypto Systems", "Date" : "2019 Spring"}]}

-- {"username" : "AS", "name" : "Dr. Ashwani Sharma", "email" : "ashwani@iitrpr.ac.in", "password" : "prerna","Overview": "Interested in Cryptography", "Publication" : [{"Date" : "1998", "Paper" : "Quantum Crypto", "Conf" : "CCF 2017 Conference, Mac Hill"}, {"Date" : "1998", "Paper" : "Proof for secuirty of Quantum Cryptography", "Conf" : "CCF 2018 Conference, Mac Hill"}], "Education" : [{ "Study" : "IIT Ropar B.Tech CSE", "Year" : "1998" },{ "Study" : "Phd Waterloo Univrsity", "Year" : "2003"}],"Award" : [{"Title" : "Best IEEE Conference Paper", "Date" : "Sept 2017"}, {"Title" : "Best Doctorialship Award", "Date" : "May 2014"}],"Grants" : [ ], "Teaching" : [{"Course" : "Crypto", Date: "2018 Fall"}, {"Course" : "Crypto Systems", "Date" : "2019 Spring"}]}

-- {"username" : "AA", "name" : "Dr. Anupam Agrawal", "email" : "anupam@iitrpr.ac.in", "password" : "prerna","Overview": "Interested in ME", "Publication" : [{"Date" : "1998", "Paper" : "Motor Engines", "Conf" : "CCF 2017 Conference, Mac Hill"}, {"Date" : "1998", "Paper" : "Building long lasting engines", "Conf" : "CCF 2018 Conference, Mac Hill"}], "Education" : [{ "Study" : "IIT Ropar B.Tech CSE", "Year" : "1998" },{ "Study" : "Phd Waterloo Univrsity", "Year" : "2003"}],"Award" : [{"Title" : "Best IEEE Conference Paper", "Date" : "Sept 2017"}, {"Title" : "Best Doctorialship Award", "Date" : "May 2014"}],"Grants" : [ ], "Teaching" : [{"Course" : "Crypto", Date: "2018 Fall"}, {"Course" : "Crypto Systems", "Date" : "2019 Spring"}]}

-- {"username" : "BS", "name" : "Dr. Balwinder Sodhi", "email" : "sodhi@iitrpr.ac.in", "password" : "prerna","Overview": "Interested in Cryptography", "Publication" : [{"Date" : "1998", "Paper" : "Quantum Crypto", "Conf" : "CCF 2017 Conference, Mac Hill"}, {"Date" : "1998", "Paper" : "Proof for secuirty of Quantum Cryptography", "Conf" : "CCF 2018 Conference, Mac Hill"}], "Education" : [{ "Study" : "IIT Ropar B.Tech CSE", "Year" : "1998" },{ "Study" : "Phd Waterloo Univrsity", "Year" : "2003"}],"Award" : [{"Title" : "Best IEEE Conference Paper", "Date" : "Sept 2017"}, {"Title" : "Best Doctorialship Award", "Date" : "May 2014"}],"Grants" : [ ], "Teaching" : [{"Course" : "Crypto", Date: "2018 Fall"}, {"Course" : "Crypto Systems", "Date" : "2019 Spring"}]}

-- {"username" : "BR", "name" : "Dr. Brajesh Rawat", "email" : "brajesh@iitrpr.ac.in", "password" : "prerna","Overview": "Interested in Cryptography", "Publication" : [{"Date" : "1998", "Paper" : "Quantum Crypto", "Conf" : "CCF 2017 Conference, Mac Hill"}, {"Date" : "1998", "Paper" : "Proof for secuirty of Quantum Cryptography", "Conf" : "CCF 2018 Conference, Mac Hill"}], "Education" : [{ "Study" : "IIT Ropar B.Tech CSE", "Year" : "1998" },{ "Study" : "Phd Waterloo Univrsity", "Year" : "2003"}],"Award" : [{"Title" : "Best IEEE Conference Paper", "Date" : "Sept 2017"}, {"Title" : "Best Doctorialship Award", "Date" : "May 2014"}],"Grants" : [ ], "Teaching" : [{"Course" : "Crypto", Date: "2018 Fall"}, {"Course" : "Crypto Systems", "Date" : "2019 Spring"}]}

-- {"username" : "DKM", "name" : "Dr. Dhiraj K. Mahajan", "email" : "dkm@iitrpr.ac.in", "password" : "prerna","Overview": "Interested in ME", "Publication" : [{"Date" : "1998", "Paper" : "Motor Engines", "Conf" : "CCF 2017 Conference, Mac Hill"}, {"Date" : "1998", "Paper" : "Building long lasting engines", "Conf" : "CCF 2018 Conference, Mac Hill"}], "Education" : [{ "Study" : "IIT Ropar B.Tech CSE", "Year" : "1998" },{ "Study" : "Phd Waterloo Univrsity", "Year" : "2003"}],"Award" : [{"Title" : "Best IEEE Conference Paper", "Date" : "Sept 2017"}, {"Title" : "Best Doctorialship Award", "Date" : "May 2014"}],"Grants" : [ ], "Teaching" : [{"Course" : "Crypto", Date: "2018 Fall"}, {"Course" : "Crypto Systems", "Date" : "2019 Spring"}]}

-- {"username" : "NG", "name" : "Dr. Neeraj Goel", "email" : "neeraj@iitrpr.ac.in", "password" : "prerna","Overview": "Interested in Cryptography", "Publication" : [{"Date" : "1998", "Paper" : "Quantum Crypto", "Conf" : "CCF 2017 Conference, Mac Hill"}, {"Date" : "1998", "Paper" : "Proof for secuirty of Quantum Cryptography", "Conf" : "CCF 2018 Conference, Mac Hill"}], "Education" : [{ "Study" : "IIT Ropar B.Tech CSE", "Year" : "1998" },{ "Study" : "Phd Waterloo Univrsity", "Year" : "2003"}],"Award" : [{"Title" : "Best IEEE Conference Paper", "Date" : "Sept 2017"}, {"Title" : "Best Doctorialship Award", "Date" : "May 2014"}],"Grants" : [ ], "Teaching" : [{"Course" : "Crypto", Date: "2018 Fall"}, {"Course" : "Crypto Systems", "Date" : "2019 Spring"}]}

-- {"username" : "DD", "name" : "Dr. Devarshi Das", "email" : "devarshi@iitrpr.ac.in", "password" : "prerna","Overview": "Interested in Cryptography", "Publication" : [{"Date" : "1998", "Paper" : "Quantum Crypto", "Conf" : "CCF 2017 Conference, Mac Hill"}, {"Date" : "1998", "Paper" : "Proof for secuirty of Quantum Cryptography", "Conf" : "CCF 2018 Conference, Mac Hill"}], "Education" : [{ "Study" : "IIT Ropar B.Tech CSE", "Year" : "1998" },{ "Study" : "Phd Waterloo Univrsity", "Year" : "2003"}],"Award" : [{"Title" : "Best IEEE Conference Paper", "Date" : "Sept 2017"}, {"Title" : "Best Doctorialship Award", "Date" : "May 2014"}],"Grants" : [ ], "Teaching" : [{"Course" : "Crypto", Date: "2018 Fall"}, {"Course" : "Crypto Systems", "Date" : "2019 Spring"}]}

-- {"username" : "JSS", "name" : "J.S Sahambi", "email" : "sahambi@iitrpr.ac.in", "password" : "prerna","Overview": "Interested in Cryptography", "Publication" : [{"Date" : "1998", "Paper" : "Quantum Crypto", "Conf" : "CCF 2017 Conference, Mac Hill"}, {"Date" : "1998", "Paper" : "Proof for secuirty of Quantum Cryptography", "Conf" : "CCF 2018 Conference, Mac Hill"}], "Education" : [{ "Study" : "IIT Ropar B.Tech CSE", "Year" : "1998" },{ "Study" : "Phd Waterloo Univrsity", "Year" : "2003"}],"Award" : [{"Title" : "Best IEEE Conference Paper", "Date" : "Sept 2017"}, {"Title" : "Best Doctorialship Award", "Date" : "May 2014"}],"Grants" : [ ], "Teaching" : [{"Course" : "Crypto", Date: "2018 Fall"}, {"Course" : "Crypto Systems", "Date" : "2019 Spring"}]}

-- {"username" : "DK", "name" : "Prof. Deepak Kashyap", "email" : "deepak@iitrpr.ac.in", "password" : "prerna","Overview": "Interested in Cryptography", "Publication" : [{"Date" : "1998", "Paper" : "Quantum Crypto", "Conf" : "CCF 2017 Conference, Mac Hill"}, {"Date" : "1998", "Paper" : "Proof for secuirty of Quantum Cryptography", "Conf" : "CCF 2018 Conference, Mac Hill"}], "Education" : [{ "Study" : "IIT Ropar B.Tech CSE", "Year" : "1998" },{ "Study" : "Phd Waterloo Univrsity", "Year" : "2003"}],"Award" : [{"Title" : "Best IEEE Conference Paper", "Date" : "Sept 2017"}, {"Title" : "Best Doctorialship Award", "Date" : "May 2014"}],"Grants" : [ ], "Teaching" : [{"Course" : "Crypto", Date: "2018 Fall"}, {"Course" : "Crypto Systems", "Date" : "2019 Spring"}]}

-- {"username" : "SKD", "name" : "Prof. S. K. Das", "email" : "skd@iitrpr.ac.in", "password" : "prerna","Overview": "Interested in ME", "Publication" : [{"Date" : "1998", "Paper" : "Motor Engines", "Conf" : "CCF 2017 Conference, Mac Hill"}, {"Date" : "1998", "Paper" : "Building long lasting engines", "Conf" : "CCF 2018 Conference, Mac Hill"}], "Education" : [{ "Study" : "IIT Ropar B.Tech CSE", "Year" : "1998" },{ "Study" : "Phd Waterloo Univrsity", "Year" : "2003"}],"Award" : [{"Title" : "Best IEEE Conference Paper", "Date" : "Sept 2017"}, {"Title" : "Best Doctorialship Award", "Date" : "May 2014"}],"Grants" : [ ], "Teaching" : [{"Course" : "Crypto", Date: "2018 Fall"}, {"Course" : "Crypto Systems", "Date" : "2019 Spring"}]}
