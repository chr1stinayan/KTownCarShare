CREATE TABLE Member(
    memberNumber INT NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    phoneNumber CHAR(10) NOT NULL,
    memberAddress VARCHAR(255) NOT NULL,
    licenseNumber CHAR(14) NOT NULL,
    creditCardNumber CHAR(16) NOT NULL,
    picturePath VARCHAR(255),
    userType ENUM('client','admin') NOT NULL,
    PRIMARY KEY(memberNumber),
    UNIQUE(email),
    UNIQUE(password),
    UNIQUE(creditCardNumber),
    UNIQUE(licenseNumber)
);

INSERT INTO Member (memberNumber,firstName,lastName,email,password,phoneNumber,memberAddress,licenseNumber,creditCardNumber,userType)
VALUES (1,"Vinith", "Suriyakumar", "suriyaku@gmail.com","biomed2017","6138967865","246 William Street", "98942384226326","0625944108474896",'client'),
       (2,"Christina","Yan","tyanners96@hotmail.com","psc2017","6134567098","466 Brock Street", "0625944108474896","9454093893464501",'client'),
       (3,"Lydia","Noureldin","lydz@outlook.com","vpua2017","6132347890","560 Johnson Street","38290726110670","0462439192609260",'client'),
       (4,"Harry","Rosen","harryrosen@gmail.com","menStore","4167892345","1000 John Counter Boulevard","18245303395706","6774860325401020",'client'),
       (5,"Evan", "Williams","ewill@hotmail.com","246Will","6874560123","343 Montreal Street","76327356414797","0795663644795007",'admin');

CREATE TABLE ParkingLocations(
    lotAddress VARCHAR(255) NOT NULL,
    numberOfCars INT NOT NULL,
    PRIMARY KEY(lotAddress)
);

INSERT INTO ParkingLocations(lotAddress,numberOfCars)
VALUES ("25 Montreal Street",34),
       ("1234 Bath Road",56),
       ("869 Portsmouth Avenue",40),
       ("800 Division Street",23);


CREATE TABLE Car(
    VIN INT NOT NULL AUTO_INCREMENT,
    make VARCHAR(255) NOT NULL,
    model VARCHAR(255) NOT NULL,
    year INT(4) NOT NULL,
    lotAddress VARCHAR(255) NOT NULL,
    dailyFee DECIMAL(5,2) NOT NULL,
    carCondition ENUM("damaged","normal","not running") NOT NULL,
    carOdometer FLOAT NOT NULL,
    picturePath VARCHAR(255),
    PRIMARY KEY (VIN),
    FOREIGN KEY (lotAddress) REFERENCES ParkingLocations(lotAddress)
);

INSERT INTO Car(VIN,make,model,year,lotAddress,dailyFee,carCondition,picturePath,carOdometer)
VALUES(1,"Toyota","Camry",2008,"25 Montreal Street",60.43,"normal",NULL,67543.23),
      (2,"Toyota","Prius",2010,"25 Montreal Street",80.66,"normal",NULL,80345.45),
      (3,"Toyota","Corolla",2006,"25 Montreal Street",45.77,"damaged",NULL,45000.00),
      (4,"Ford","Focus",2014,"25 Montreal Street",50.35,"normal",NULL,123004.97),
      (5,"Chrysler","Caravan",2015,"25 Montreal Street",65.00,"not running",NULL,78045.00),
      (6,"Hyundai","Sonata",2016,"1234 Bath Road",60.00,"normal",NULL,34954.00),
      (7,"Nissan","Altima",2013,"1234 Bath Road",76.80,"normal",NULL,96234.00),
      (8,"Honda","Civic",2017,"1234 Bath Road",46.87,"normal",NULL,8123.00),
      (9,"Ford","Elantra",2014,"1234 Bath Road",65.86,"not running",NULL,102035.00),
      (10,"BMW","Gran Turismo 3",2016,"1234 Bath Road",154.89,"damaged",NULL,23045.00),
      (11,"Lexus","ES 350",2010,"869 Portsmouth Avenue",125.65,"damaged",NULL,134156.79),
      (12,"Dodge","Caravan",2009,"869 Portsmouth Avenue",68.95,"not running",NULL,176923.00),
      (13,"Fiat","500",2016,"869 Portsmouth Avenue",78.45,"normal",NULL,98345.00),
      (14,"Buick","Encore",2017,"869 Portsmouth Avenue",145.00,"normal",NULL,2305.00),
      (15,"Nissan","Altima",2008,"869 Portsmouth Avenue",59.85,"damaged",NULL,179034.00);

CREATE TABLE Reservation(
    reservationNumber INT NOT NULL AUTO_INCREMENT,
    accessCode CHAR(10) NOT NULL,
    memberNumber INT NOT NULL,
    VIN INT NOT NULL,
    startDateTime DATETIME NOT NULL,
    endDateTime DATETIME NOT NULL,
    reservationLength INT NOT NULL,
    PRIMARY KEY(reservationNumber),
    FOREIGN KEY(memberNumber) REFERENCES Member(memberNumber),
    FOREIGN KEY(VIN) REFERENCES Car(VIN),
    UNIQUE(accessCode)
);

INSERT INTO Reservation(reservationNumber,accessCode,memberNumber,VIN,startDateTime,endDateTime,reservationLength)
VALUES(1,"5W3X8NYSPQ",1,2,'2017-02-15 15:15:13','2017-02-17 20:24:45',2),
        (2,"8REEWN8ZEF",2,11,'2017-03-01 10:43:53','2017-03-02 20:24:45',1),
        (3,"4H9ALS9LE2",3,6,'2017-01-21 18:01:35','2017-01-25 09:15:00',4),
        (4,"GYVEL7SDL6",4,1,'2017-04-07 14:10:12','2017-04-13 08:00:00',6),
        (5,"PSKZH4KR4N",1,14,'2017-01-13 12:00:13','2017-01-16 12:15:13',3);

CREATE TABLE RentalHistory(
    reservationNumber INT NOT NULL,
    VIN INT NOT NULL,
    pickUpOdometer FLOAT NOT NULL,
    pickUpDateTime DATETIME NOT NULL,
    dropOffOdometer FLOAT NOT NULL,
    dropOffDateTime DATETIME NOT NULL,
    lotAddress VARCHAR(255) NOT NULL,
    pickUpState ENUM('damaged','normal','not running') NOT NULL,
    dropOffState ENUM('damaged','normal','not running') NOT NULL,
    FOREIGN KEY (reservationNumber) REFERENCES Reservation(reservationNumber),
    FOREIGN KEY (VIN) REFERENCES Car(VIN),
    FOREIGN KEY (lotAddress) REFERENCES ParkingLocations(lotAddress)
);

INSERT INTO RentalHistory(reservationNumber,VIN,pickUpOdometer,pickUpDateTime,dropOffOdometer,dropOffDateTime,lotAddress,pickUpState,dropOffState)
VALUES(1,2,80345.45,'2017-02-15 15:15:13',80947.00,'2017-02-17 20:24:45',"25 Montreal Street",'normal','normal'),
       (2,11,134023.00,'2017-03-01 10:43:53',134156.79,'2017-03-02 20:24:45',"25 Montreal Street",'normal','damaged');

CREATE TABLE MaintenanceHistory(
    VIN INT NOT NULL,
    maintenanceDate DATETIME NOT NULL,
    odometer FLOAT NOT NULL,
    maintenanceType ENUM('scheduled','repair','body work') NOT NULL,
    description TEXT NOT NULL,
    FOREIGN KEY(VIN) references Car(VIN) 
);

INSERT INTO MaintenanceHistory(VIN, maintenanceDate,odometer,maintenanceType,description)
VALUES(11,'2017-03-04 09:00:14',134156.79,'repair',"An oil change had to be made.");

CREATE TABLE MemberComments(
    VIN INT NOT NULL,
    memberNumber INT NOT NULL,
    commentID INT NOT NULL AUTO_INCREMENT,
    commentText TEXT NOT NULL,
    commentDateTime DATETIME NOT NULL,
    rating INT NOT NULL,
    PRIMARY KEY(commentID),
    FOREIGN KEY(VIN) REFERENCES Car(VIN),
    FOREIGN KEY(memberNumber) REFERENCES Member(memberNumber)
);

INSERT INTO MemberComments(VIN,memberNumber,commentID,commentText,commentDateTime,rating)
VALUES(2,1,1,"This was a great car!",'2017-02-18 20:24:45',4);

CREATE TABLE AdminComments(
    adminID INT NOT NULL,
    adminCommentID INT NOT NULL AUTO_INCREMENT,
    correspondingMemberCommentID INT NOT NULL,
    commentText TEXT NOT NULL,
    adminDateTime DATETIME NOT NULL,
    PRIMARY KEY(adminCommentID),
    FOREIGN KEY(adminID) REFERENCES Member(memberNumber),
    FOREIGN KEY(correspondingMemberCommentID) REFERENCES MemberComments(commentID)
);

INSERT INTO AdminComments(adminID,adminCommentID,correspondingMemberCommentID,commentText,adminDateTime)
VALUES (5,1,1,"Glad you enjoyed the car!",'2017-02-18 21:24:45');


