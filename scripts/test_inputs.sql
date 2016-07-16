INSERT INTO Team (Name, Record, Year) VALUES("TEST", "0-0", YEAR(NOW()));

INSERT INTO Game (Team_home, Team_away, Start_time, Date, Points_home, Points_away) VALUES(1, 7, "00:00", "2014/06/01", 0, 0);

INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES("TEST", 9, "815-123-4567", "TEST", "815-123-4567", 1);

INSERT INTO Users VALUES('TEST', SHA1('TEST'), 2);

INSERT INTO Coach (Name, Email, Phone, TeamID, Username) VALUES("TEST", "test@gmail.com", "815-123-4567", 1, 'TEST');
