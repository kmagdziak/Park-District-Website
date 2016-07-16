DROP TABLE IF EXISTS Player, Game, Coach, Users, Team;

CREATE TABLE Team
(ID int(4) PRIMARY KEY AUTO_INCREMENT, 
Name varchar(30),
Record varchar(10),
Year int(4) default 0000);

CREATE TABLE Users
(Username char(30) PRIMARY KEY,
Password char(40) NOT NULL,
Admin boolean default '0' NOT NULL);

CREATE TABLE Coach
(ID int(4) PRIMARY KEY AUTO_INCREMENT, 
Name varchar(30), 
Email varchar(40), 
Phone char(12), 
TeamID int(4), 
Username char(30) default NULL,
FOREIGN KEY (TeamID) REFERENCES Team(ID),
FOREIGN KEY (Username) REFERENCES Users(Username)
ON UPDATE CASCADE ON DELETE SET NULL);

CREATE TABLE Game
(ID int(4) PRIMARY KEY AUTO_INCREMENT, 
Team_home int(4), 
Team_away int(4), 
Start_time TIME, 
Date DATE, 
Points_home int(2), 
Points_away int(2), 
FOREIGN KEY (Team_home) REFERENCES Team(ID)
ON UPDATE CASCADE ON DELETE SET NULL, 
FOREIGN KEY (Team_away) REFERENCES Team(ID)
ON UPDATE CASCADE ON DELETE SET NULL);

CREATE TABLE Player
(ID int(4) PRIMARY KEY AUTO_INCREMENT, 
Name varchar(30), 
Grade int(2), 
Phone char(12), 
ECName varchar(30), 
ECPhone char(12), 
TeamID int(4), 
FOREIGN KEY (TeamID) REFERENCES Team(ID)
ON UPDATE CASCADE ON DELETE SET NULL);

INSERT INTO Team (Name, Record, Year) VALUES("Rockets", "4-0", 2014);
INSERT INTO Team (Name, Record, Year) VALUES("Avalanche", "1-3", 2014);
INSERT INTO Team (Name, Record, Year) VALUES("Razors", "2-2", 2014);
INSERT INTO Team (Name, Record, Year) VALUES("WolfClan", "3-1", 2014);
INSERT INTO Team (Name, Record, Year) VALUES("Outsiders", "1-3", 2014);
INSERT INTO Team (Name, Record, Year) VALUES("Aliens", "2-2", 2014);

INSERT INTO Game (Team_home, Team_away, Start_time, Date, Points_home, Points_away) VALUES(1, 4, "19:00", "2014/01/05/", 22, 12);
INSERT INTO Game (Team_home, Team_away, Start_time, Date, Points_home, Points_away) VALUES(2, 5, "16:30", "2014/01/05", 19, 14);
INSERT INTO Game (Team_home, Team_away, Start_time, Date, Points_home, Points_away) VALUES(3, 6, "14:00", "2014/01/05", 17, 16);
INSERT INTO Game (Team_home, Team_away, Start_time, Date, Points_home, Points_away) VALUES(4, 2, "19:00", "2014/01/12", 35, 13);
INSERT INTO Game (Team_home, Team_away, Start_time, Date, Points_home, Points_away) VALUES(5, 6, "13:00", "2014/01/12", 20, 23);
INSERT INTO Game (Team_home, Team_away, Start_time, Date, Points_home, Points_away) VALUES(6, 1, "15:00", "2014/01/12", 17, 21);
INSERT INTO Game (Team_home, Team_away, Start_time, Date, Points_home, Points_away) VALUES(1, 5, "17:30", "2014/01/19", 24, 17);
INSERT INTO Game (Team_home, Team_away, Start_time, Date, Points_home, Points_away) VALUES(2, 3, "14:00", "2014/01/19", 16, 33);
INSERT INTO Game (Team_home, Team_away, Start_time, Date, Points_home, Points_away) VALUES(3, 4, "19:00", "2014/01/19", 12, 20);
INSERT INTO Game (Team_home, Team_away, Start_time, Date, Points_home, Points_away) VALUES(4, 3, "12:30", "2014/01/26", 23, 19);
INSERT INTO Game (Team_home, Team_away, Start_time, Date, Points_home, Points_away) VALUES(5, 2, "15:00", "2014/01/26", 21, 24);
INSERT INTO Game (Team_home, Team_away, Start_time, Date, Points_home, Points_away) VALUES(6, 1, "17:00", "2014/01/26", 17, 16);

INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("John Smith", 5, "815-555-1234", "Bill", "815-777-1234", 1);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Ben Folds", 6, "815-555-2345", "Hank", "815-777-2345", 2);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Luke Spencer", 7, "815-555-3456", "Dale", "815-777-3456", 3);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Bobbie Spencer", 8, "815-555-4567", "Boomhauer", "815-777-4567", 4);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Jeff Green", 5, "815-555-5578", "Bill", "815-777-1234", 5);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Mitchell Green", 6, "815-555-6789", "Hank", "815-777-2345", 6);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Mark Doe", 7, "815-555-7890", "Dale", "815-777-3456", 1);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Mike McElven", 8, "815-555-8901", "Boomhauer", "815-777-4567", 2);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Jake Jonnson", 5, "815-555-9012", "Bill", "815-777-1234", 3);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Maria Hughes", 6, "815-555-0987", "Hank", "815-777-2345", 4);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Jon Forest", 7, "815-555-9876", "Dale", "815-777-3456", 5);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Blake Brown", 8, "815-555-8765", "Boomhauer", "815-777-4567", 6);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Delilah Buchanan", 5, "815-555-7654", "Bill", "815-777-1234", 1);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Buffy Sommers", 6, "815-555-6543", "Hank", "815-777-2345", 2);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Brian Brown", 7, "815-555-5432", "Dale", "815-777-3456", 3);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Dave Wearly", 8, "815-555-4321", "Boomhauer", "815-777-4567", 4);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Bob Seger", 5, "815-555-3210", "Bill", "815-777-1234", 5);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("John Hurt", 6, "815-555-2109", "Hank", "815-777-2345", 6);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Bill Broonzy", 7, "815-555-1098", "Dale", "815-777-3456", 1);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Tony Zell", 8, "815-555-1123", "Boomhauer", "815-777-4567", 2);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Mick Jagger", 5, "815-555-1134", "Bill", "815-777-1234", 3);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("John Lennon", 6, "815-555-1145", "Hank", "815-777-2345", 4);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("George Harrison", 7, "815-555-1156", "Dale", "815-777-3456", 5);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Rick Springfield", 8, "815-555-1167", "Boomhauer", "815-777-4567", 6);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Robert Johnson", 5, "815-555-1178", "Bill", "815-777-1234", 1);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("HoneyBoy Edwards", 6, "815-555-1189", "Hank", "815-777-2345", 2);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Brian May", 7, "815-555-1190", "Dale", "815-777-3456", 3);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Randy Duncan", 8, "815-555-1101", "Boomhauer", "815-777-4567", 4);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Keith Richards", 5, "815-555-0098", "Bill", "815-777-1234", 5);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Stu Redman", 6, "815-555-0087", "Hank", "815-777-2345", 6);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Randall Flagg", 7, "815-555-0076", "Dale", "815-777-3456", 1);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Roland Deschain", 8, "815-555-0065", "Boomhauer", "815-777-4567", 2);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Eddie Dean", 5, "815-555-0054", "Bill", "815-777-1234", 3);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Jake Chambers", 6, "815-555-0043", "Hank", "815-777-2345", 4);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Susannah Dean", 7, "815-555-0032", "Dale", "815-777-3456", 5);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Frank Randall", 8, "815-555-0021", "Boomhauer", "815-777-4567", 6);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Geillis Duncan", 5, "815-555-0010", "Bill", "815-777-1234", 1);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Alexander MacKenzie", 6, "815-555-0009", "Hank", "815-777-2345", 2);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Brian Fraser", 7, "815-555-1029", "Dale", "815-777-3456", 3);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Claire Randall", 8, "815-555-2983", "Boomhauer", "815-777-4567", 4);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Bukka White", 5, "815-555-3746", "Bill", "815-777-1234", 5);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Miles Matheson", 6, "815-555-5123", "Hank", "815-777-2345", 6);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Sebastian Monroe", 7, "815-555-5234", "Dale", "815-777-3456", 1);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Aaron Pittman", 8, "815-555-5345", "Boomhauer", "815-777-4567", 2);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("John Pope", 5, "815-555-5456", "Bill", "815-777-1234", 3);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Jim Kirk", 6, "815-555-5567", "Hank", "815-777-2345", 4);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Luke Skywalker", 7, "815-555-5678", "Dale", "815-777-3456", 5);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Wesley Crusher", 8, "815-555-5789", "Boomhauer", "815-777-4567", 6);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Samantha Carter", 5, "815-555-5890", "Bill", "815-777-1234", 1);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("John Crichton", 6, "815-555-5901", "Hank", "815-777-2345", 2);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Aeryn Sun", 7, "815-555-5012", "Dale", "815-777-3456", 3);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Jack O'Neill", 8, "815-555-9123", "Boomhauer", "815-777-4567", 4);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Daniel Jackson", 5, "815-555-9234", "Bill", "815-777-1234", 5);
INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("Paul Davis", 6, "815-555-9345", "Hank", "815-777-2345", 6);

INSERT INTO Users VALUES('admin', SHA1('admin'), 1);
INSERT INTO Users VALUES('Smith', SHA1('Smith'), 0);
INSERT INTO Users VALUES('Greenly', SHA1('Greenly'), 0);
INSERT INTO Users VALUES('Forest', SHA1('Forest'), 0);
INSERT INTO Users VALUES('Hart', SHA1('Hart'), 0);
INSERT INTO Users VALUES('Keely', SHA1('Keely'), 0);
INSERT INTO Users VALUES('Burke', SHA1('Burke'), 0);
INSERT INTO Users VALUES('Smythe', SHA1('Smythe'), 0);
INSERT INTO Users VALUES('Braun', SHA1('Braun'), 0);
INSERT INTO Users VALUES('Hinton', SHA1('Hinton'), 0);
INSERT INTO Users VALUES('Scott', SHA1('Scott'), 0);

INSERT INTO Coach (Name, Email, Phone, TeamID, Username) VALUES("Mr. Smith", "Smith@gmail.com", "815-557-1234", 1, 'Smith');
INSERT INTO Coach (Name, Email, Phone, TeamID, Username) VALUES("Ms. Greenly", "Greenly@gmail.com", "815-557-2345", 1, 'Greenly');
INSERT INTO Coach (Name, Email, Phone, TeamID, Username) VALUES("Ms. Forest", "Forest@gmail.com", "815-557-3456", 2, 'Forest');
INSERT INTO Coach (Name, Email, Phone, TeamID, Username) VALUES("Ms. Hart", "Hart@gmail.com", "815-557-4567", 2, 'Hart');
INSERT INTO Coach (Name, Email, Phone, TeamID, Username) VALUES("Mr. Keely", "Keely@gmail.com", "815-557-5678", 3, 'Keely');
INSERT INTO Coach (Name, Email, Phone, TeamID, Username) VALUES("Mr. Burke", "Burke@gmail.com", "815-557-6789", 4, 'Burke');
INSERT INTO Coach (Name, Email, Phone, TeamID, Username) VALUES("Mr. Smythe", "Smythe@gmail.com", "815-557-7890", 4, 'Smythe');
INSERT INTO Coach (Name, Email, Phone, TeamID, Username) VALUES("Mr. Braun", "Braun@gmail.com", "815-557-8901", 4, 'Braun');
INSERT INTO Coach (Name, Email, Phone, TeamID, Username) VALUES("Ms. Hinton", "Hinton@gmail.com", "815-557-9012", 5, 'Hinton');
INSERT INTO Coach (Name, Email, Phone, TeamID, Username) VALUES("Mr. Scott", "Scott@gmail.com", "815-557-0123", 6, 'Scott');

source /home/turing/cs466105/scripts/test_inputs.sql;
