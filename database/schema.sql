create database library_managment;
use library_managment;

---------- Membre/insertions-------------------
CREATE TABLE Membre (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telephone VARCHAR(20),
    dateDebutAdhesion DATE NOT NULL,
    dateFinAdhesion DATE DEFAULT NULL,
    soldeAmende DECIMAL(10,2) DEFAULT 0,
    role ENUM('ETUDIANT','ENSEIGNANT') NOT NULL,
    niveauEtude ENUM('UNDERGRADUATE','GRADUATE') DEFAULT NULL,
    fonction ENUM('PROFESSOR','RESEARCHER','STAFF') DEFAULT NULL
);
INSERT INTO Membre (nom, email, telephone, dateDebutAdhesion, dateFinAdhesion, soldeAmende, role, niveauEtude, fonction)
VALUES
('Salma Jaddar', 'salma@mail.com', '0600000001', '2026-01-01', '2027-01-01', 0, 'ETUDIANT', 'UNDERGRADUATE', NULL),
('Amine Fathi', 'amine@mail.com', '0600000002', '2025-09-01', '2026-09-01', 5, 'ETUDIANT', 'GRADUATE', NULL),
('Sara Bennis', 'sara@mail.com', '0600000003', '2025-10-01', '2026-10-01', 0, 'ENSEIGNANT', NULL, 'PROFESSOR'),
('Youssef Hadi', 'youssef@mail.com', '0600000004', '2025-11-01', '2026-11-01', 10, 'ENSEIGNANT', NULL, 'RESEARCHER'),
('Lina Kacem', 'lina@mail.com', '0600000005', '2026-01-05', '2027-01-05', 0, 'ETUDIANT', 'UNDERGRADUATE', NULL);
---------- Auteur/insertions -------------------
CREATE TABLE Auteur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    biographie TEXT,
    nationalite VARCHAR(50),
    dateNaissance DATE,
    dateDeces DATE DEFAULT NULL,
    genrePrincipal VARCHAR(50)
);
INSERT INTO Auteur (nom, biographie, nationalite, dateNaissance, dateDeces, genrePrincipal)
VALUES
('Victor Hugo', 'Écrivain français', 'Française', '1802-02-26', '1885-05-22', 'Roman'),
('Agatha Christie', 'Romancière britannique', 'Britannique', '1890-09-15', '1976-01-12', 'Policier'),
('Shakespeare', 'Dramaturge anglais', 'Anglaise', '1564-04-26', '1616-04-23', 'Théâtre'),
('J.K. Rowling', 'Auteur britannique', 'Britannique', '1965-07-31', NULL, 'Fantastique'),
('Albert Camus', 'Écrivain et philosophe français', 'Française', '1913-11-07', '1960-01-04', 'Philosophie');

---------- Categorie/insertions -------------------
CREATE TABLE Categorie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    description text 
);
INSERT INTO Categorie (name, description)
VALUES
('Informatique', 'Livres liés à l’informatique et la programmation'),
('Littérature', 'Romans, poésie et théâtre'),
('Science', 'Livres scientifiques et manuels'),
('Philosophie', 'Œuvres philosophiques et essais'),
('Fantastique', 'Romans fantastiques ou science-fiction');

---------- Livre/insertions  -------------------
CREATE TABLE Livre (
    ISBN VARCHAR(20) PRIMARY KEY,
    titre VARCHAR(200) NOT NULL,
    anneePublication INT
);

INSERT INTO Livre (ISBN, titre, anneePublication)
VALUES
('978-1234567890', 'Les Misérables', 1862),
('978-2345678901', 'Murder on the Orient Express', 1934),
('978-3456789012', 'Hamlet', 1603),
('978-4567890123', 'Harry Potter à l’école des sorciers', 1997),
('978-5678901234', 'L’Étranger', 1942);

 ----------campus/insertions -------------------
CREATE TABLE campus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    location  VARCHAR(50),
    horairesOuverture VARCHAR(50),
    contact VARCHAR(50)
);
INSERT INTO campus (nom, location, horairesOuverture, contact)
VALUES
('Campus Centre', 'Rue Principale, Ville', '08:00-18:00', '0600000010'),
('Campus Nord', 'Avenue Nord, Ville', '09:00-17:00', '0600000011'),
('Campus Sud', 'Boulevard Sud, Ville', '08:30-16:30', '0600000012'),
('Campus Est', 'Rue Est, Ville', '07:30-15:30', '0600000013'),
('Campus Ouest', 'Avenue Ouest, Ville', '08:00-17:00', '0600000014');

 ----------LivreBibliotheque/insertions -------------------
CREATE TABLE LivreCampus (
    idl VARCHAR(20),  
    idc INT,
    nombreExemplaires INT DEFAULT 1,
    statut ENUM('Disponible','Emprunte','Reserve','Maintenance') DEFAULT 'Disponible',
    PRIMARY KEY (idl, idc),
    FOREIGN KEY (idl) REFERENCES Livre(ISBN),
    FOREIGN KEY (idc) REFERENCES campus(id)
);
INSERT INTO LivreCampus (idl, idc, nombreExemplaires, statut)
VALUES
('978-1234567890', 1, 3, 'Disponible'),
('978-2345678901', 2, 2, 'Disponible'),
('978-3456789012', 3, 1, 'Emprunte'),
('978-4567890123', 4, 4, 'Disponible'),
('978-5678901234', 5, 1, 'Reserve');


 ----------LivreAuteur/insertions-------------------
CREATE TABLE LivreAuteur (
    idl VARCHAR(20),
    ida INT,
    role VARCHAR(50),
    PRIMARY KEY (idl, ida),
    FOREIGN KEY (idl) REFERENCES Livre(ISBN),
    FOREIGN KEY (ida) REFERENCES Auteur(id)
);
INSERT INTO LivreAuteur (idl, ida, role)
VALUES
('978-1234567890', 1, 'Auteur Principal'),
('978-2345678901', 2, 'Auteur Principal'),
('978-3456789012', 3, 'Auteur Principal'),
('978-4567890123', 4, 'Auteur Principal'),
('978-5678901234', 5, 'Auteur Principal');


 ----------Emprunt/insertions-------------------
CREATE TABLE Emprunt (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dateEmprunt DATE NOT NULL,
    dateRetourPrevue DATE NOT NULL,
    dateRetourEffective DATE DEFAULT NULL,
    fraisRetard DECIMAL(10,2) DEFAULT 0,
    idM INT NOT NULL,
    idl VARCHAR(20),
    idc INT NOT NULL,
    FOREIGN KEY (idM) REFERENCES Membre(id),
    FOREIGN KEY (idl) REFERENCES Livre(ISBN),
    FOREIGN KEY (idc) REFERENCES campus(id)
);
INSERT INTO Emprunt (dateEmprunt, dateRetourPrevue, dateRetourEffective, fraisRetard, idM, idl, idc)
VALUES
('2026-01-10', '2026-01-24', NULL, 0, 1, '978-1234567890', 1),
('2026-01-11', '2026-01-25', '2026-01-26', 1.5, 2, '978-2345678901', 2),
('2026-01-12', '2026-01-26', NULL, 0, 3, '978-3456789012', 3),
('2026-01-13', '2026-02-12', NULL, 0, 4, '978-4567890123', 4),
('2026-01-14', '2026-01-28', '2026-01-30', 2.0, 5, '978-5678901234', 5);


 ---------- Reservation/insertions-------------------
CREATE TABLE Reservation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dateReservation DATE NOT NULL,
    dateExpiration DATE NOT NULL,
    statut ENUM('EN_ATTENTE','ACTIVE','ANNULEE','EXPIREE') DEFAULT 'EN_ATTENTE',
    idM INT NOT NULL,
    idl VARCHAR(20),
    idc INT NOT NULL,
    FOREIGN KEY (idM) REFERENCES Membre(id),
    FOREIGN KEY (idl) REFERENCES Livre(ISBN),
    FOREIGN KEY (idc) REFERENCES campus(id)
);
INSERT INTO Reservation (dateReservation, dateExpiration, statut, idM, idl, idc)
VALUES
('2026-01-15', '2026-01-20', 'ACTIVE', 1, '978-2345678901', 2),
('2026-01-16', '2026-01-21', 'EN_ATTENTE', 2, '978-3456789012', 3),
('2026-01-17', '2026-01-22', 'EXPIREE', 3, '978-4567890123', 4),
('2026-01-18', '2026-01-23', 'ANNULEE', 4, '978-5678901234', 5),
('2026-01-19', '2026-01-24', 'ACTIVE', 5, '978-1234567890', 1);


 ---------- Paiement/insertions-------------------
CREATE TABLE Paiement (
    idPaiement INT AUTO_INCREMENT PRIMARY KEY,
    datePaiement DATE NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    modePaiement ENUM('ESPECES','CARTE','EN_LIGNE') DEFAULT 'ESPECES',
    idM INT NOT NULL,
    idl VARCHAR(20),
    idc INT NOT NULL,
    FOREIGN KEY (idM) REFERENCES Membre(id),
    FOREIGN KEY (idl) REFERENCES Livre(ISBN),
    FOREIGN KEY (idc) REFERENCES campus(id)
);
INSERT INTO Paiement (datePaiement, montant, modePaiement, idM, idl, idc)
VALUES
('2026-01-12', 1.5, 'ESPECES', 2, '978-2345678901', 2),
('2026-01-13', 2.0, 'CARTE', 5, '978-5678901234', 5),
('2026-01-14', 0.5, 'EN_LIGNE', 4, '978-4567890123', 4),
('2026-01-15', 3.0, 'ESPECES', 1, '978-1234567890', 1),
('2026-01-16', 2.5, 'CARTE', 3, '978-3456789012', 3);


