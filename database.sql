CREATE DATABASE LocationVoiture;
USE LocationVoiture;


CREATE TABLE Role (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL
);


CREATE TABLE Personne (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    motDePasse VARCHAR(255) NOT NULL,
    roleId INT,
    FOREIGN KEY (roleId) REFERENCES Role(id) ON DELETE CASCADE
);


CREATE TABLE Client (
    id INT PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES Personne(id) ON DELETE CASCADE
);


CREATE TABLE Administrateur (
    id INT PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES Personne(id) ON DELETE CASCADE
);


CREATE TABLE Categorie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);


CREATE TABLE Vehicule (
    id INT AUTO_INCREMENT PRIMARY KEY,
    modele VARCHAR(100) NOT NULL,
    prixParJour DECIMAL(10, 2) NOT NULL,
    disponibilite BOOLEAN NOT NULL,
    categorieId INT NOT NULL,
    FOREIGN KEY (categorieId) REFERENCES Categorie(id) ON DELETE CASCADE
);

----stust
CREATE TABLE Reservation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dateDebut DATE NOT NULL,
    dateFin DATE NOT NULL,
    lieuPriseEnCharge VARCHAR(255) NOT NULL,
    clientId INT NOT NULL,
    vehiculeId INT NOT NULL,
    FOREIGN KEY (clientId) REFERENCES Client(id) ON DELETE CASCADE,
    FOREIGN KEY (vehiculeId) REFERENCES Vehicule(id) ON DELETE CASCADE
);


CREATE TABLE Avis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commentaire TEXT NOT NULL,
    note INT CHECK (note BETWEEN 1 AND 5),
    clientId INT NOT NULL,
    vehiculeId INT NOT NULL,
    FOREIGN KEY (clientId) REFERENCES personne(id) ON DELETE CASCADE,
    FOREIGN KEY (vehiculeId) REFERENCES Vehicule(id) ON DELETE CASCADE
);

INSERT INTO `role`(`id`, `nom`) VALUES (1,'admin'),(2,'client');

ALTER TABLE Reservation 
ADD COLUMN statut ENUM('confirmée', 'en attente', 'annulée') DEFAULT 'en attente' AFTER lieuPriseEnCharge;



ALTER TABLE Reservation DROP FOREIGN KEY reservation_ibfk_1;
ALTER TABLE Reservation ADD CONSTRAINT fk_personne_id FOREIGN KEY (clientId) REFERENCES Personne(id) ON DELETE CASCADE;

CREATE VIEW ListeVehicules AS
SELECT 
    v.modele AS modele,
    v.prixParJour AS prix_par_jour,
    v.disponibilite AS est_disponible,
    v.image AS image,
    c.nom AS categorie,
    COALESCE(AVG(a.note), 0) AS note_moyenne,
    COUNT(a.id) AS nombre_avis
FROM 
    vehicule v
JOIN 
    categorie c ON v.categorieId = c.id
LEFT JOIN 
    avis a ON v.id = a.vehiculeId
GROUP BY 
    v.modele, v.prixParJour, v.disponibilite, v.image, c.nom;

ALTER TABLE `avis`
ADD COLUMN `reservationId` INT(11) NOT NULL AFTER `vehiculeId`;    

DROP TABLE Avis;
CREATE TABLE Avis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commentaire TEXT NOT NULL,
    note INT CHECK (note BETWEEN 1 AND 5),
    clientId INT NOT NULL,
    reservationId INT NOT NULL,
    FOREIGN KEY (clientId) REFERENCES personne(id) ON DELETE CASCADE,
    FOREIGN KEY (reservationId) REFERENCES Reservation(id) ON DELETE CASCADE
);

DROP VIEW IF EXISTS ListeVehicules;

CREATE VIEW ListeVehicules AS
SELECT 
    v.modele AS modele,
    v.prixParJour AS prixParJour,
    v.disponibilite AS estDisponible,
    c.nom AS categorie,
    v.image AS image,
    COALESCE(AVG(a.note), 0) AS moyenneNote,
    COUNT(a.id) AS nombreAvis
FROM 
    vehicule v
LEFT JOIN 
    categorie c ON v.categorieId = c.id
LEFT JOIN 
    avis a ON v.id = a.reservationId
GROUP BY 
    v.modele, v.prixParJour, v.disponibilite, c.nom, v.image;
