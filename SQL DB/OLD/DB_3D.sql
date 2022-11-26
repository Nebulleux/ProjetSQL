CREATE DATABASE DB_3D;

USE DB_3D;


CREATE TABLE Product (

 id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
 name varchar(255) NOT NULL,
 description text NOT NULL,
 price double NOT NULL,
 rating double

);


CREATE TABLE Filament (

 id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
 productType varchar(255) NOT NULL,
 filamentType varchar(255) NOT NULL,
 color varchar(255) NOT NULL,
 diameter double NOT NULL,
 tempFusion double NOT NULL,
 weight double NOT NULL,
 dimension varchar(255) NOT NULL,
 idProduct INT,
 FOREIGN KEY (idProduct) REFERENCES Product(id)

);

CREATE TABLE Machine (

 id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
 productType varchar(255) NOT NULL,
 brand varchar(255) NOT NULL,
 model varchar(255) NOT NULL,
 heatingPlate varchar(255) NOT NULL,
 idProduct INT,
 FOREIGN KEY (idProduct) REFERENCES Product(id)

);



CREATE TABLE Accessory (
 
 id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
 productType varchar(255) NOT NULL,
 material varchar(255) NOT NULL,
 idProduct INT,
 FOREIGN KEY (idProduct) REFERENCES Product(id)

);

CREATE TABLE Utilisateur (

 id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
 email varchar(255) NOT NULL,
 username varchar(255) NOT NULL,
 password  varchar(255) NOT NULL

);

CREATE TABLE Rating (
 
 id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
 comm varchar(300) NOT NULL,
 rate double,
 dateOfPub date NOT NULL,
 idUser INT NOT NULL,
 idProduct INT NOT NULL,
 FOREIGN KEY (idProduct) REFERENCES Product(id),
 FOREIGN KEY (idUser) REFERENCES Utilisateur(id)

);

CREATE TABLE Groupe (

 id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
 Label varchar(255) NOT NULL

);

CREATE TABLE GroupUser (

 idUser INT  NOT NULL,
 idGroup INT NOT NULL,
 FOREIGN KEY (idGroup) REFERENCES Groupe(id),
 FOREIGN KEY (idUser) REFERENCES Utilisateur(id)
 

);

CREATE TABLE Fonctionnality (

 id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
 idGroup INT NOT NULL,
 description varchar(300) NOT NULL,
 droit BOOLEAN,
 FOREIGN KEY (idGroup) REFERENCES Groupe(id)
 

);

CREATE TABLE Follow (

 idFollower INT NOT NULL,
 idFollowed INT NOT NULL,
 FOREIGN KEY (idFollower) REFERENCES Utilisateur(id),
 FOREIGN KEY (idFollowed) REFERENCES Utilisateur(id)

);