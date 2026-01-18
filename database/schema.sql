-- Table : Membre
CREATE TABLE Membre (
    idMembre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    telephone VARCHAR(50),
    dateExpiration DATE NOT NULL,
    soldeAmende DECIMAL(10,2) DEFAULT 0,
    role ENUM('ETUDIANT','ENSEIGNANT') NOT NULL,
    niveauEtude ENUM('UNDERGRADUATE','GRADUATE') DEFAULT NULL,
    fonction ENUM('PROFESSOR','RESEARCHER','STAFF') DEFAULT NULL
);


-- Table : Auteur
CREATE TABLE Auteur (
    idAuteur INT AUTO_INCREMENT PRIMARY KEY,
    nomComplet VARCHAR(100) NOT NULL,
    biographie TEXT,
    nationalite VARCHAR(50),
    dateNaissance DATE,
    dateDeces DATE DEFAULT NULL,
    genrePrincipal VARCHAR(50)
);

-- -----------------------------
-- Table : Categorie
-- -----------------------------
CREATE TABLE Categorie (
    idCategorie INT AUTO_INCREMENT PRIMARY KEY,
    nomCategorie VARCHAR(50) NOT NULL UNIQUE
);

-- -----------------------------
-- Table : Livre
-- -----------------------------
CREATE TABLE Livre (
    idLivre INT AUTO_INCREMENT PRIMARY KEY,
    ISBN VARCHAR(20) NOT NULL UNIQUE,
    titre VARCHAR(200) NOT NULL,
    anneePublication YEAR,
    status ENUM('Disponible','Emprunte','Reserve','Maintenance') DEFAULT 'Disponible'
);

-- -----------------------------
-- Table : Bibliotheque
-- -----------------------------
CREATE TABLE Bibliotheque (
    idBibliotheque INT AUTO_INCREMENT PRIMARY KEY,
    nomBibliotheque VARCHAR(100) NOT NULL,
    adresse VARCHAR(200),
    telephone VARCHAR(20),
    horaires VARCHAR(100)
);

-- -----------------------------
-- Table associative : LivreBibliotheque
-- -----------------------------
CREATE TABLE LivreBibliotheque (
    idLivre INT,
    idBibliotheque INT,
    nombreExemplaires INT DEFAULT 1,
    PRIMARY KEY (idLivre, idBibliotheque),
    FOREIGN KEY (idLivre) REFERENCES Livre(idLivre),
    FOREIGN KEY (idBibliotheque) REFERENCES Bibliotheque(idBibliotheque)
);

-- -----------------------------
-- Table associative : LivreAuteur
-- -----------------------------
CREATE TABLE LivreAuteur (
    idLivre INT,
    idAuteur INT,
    PRIMARY KEY (idLivre, idAuteur),
    FOREIGN KEY (idLivre) REFERENCES Livre(idLivre),
    FOREIGN KEY (idAuteur) REFERENCES Auteur(idAuteur)
);

-- -----------------------------
-- Table associative : LivreCategorie
-- -----------------------------
CREATE TABLE LivreCategorie (
    idLivre INT,
    idCategorie INT,
    PRIMARY KEY (idLivre, idCategorie),
    FOREIGN KEY (idLivre) REFERENCES Livre(idLivre),
    FOREIGN KEY (idCategorie) REFERENCES Categorie(idCategorie)
);

-- -----------------------------
-- Table : Emprunt
-- -----------------------------
CREATE TABLE Emprunt (
    idEmprunt INT AUTO_INCREMENT PRIMARY KEY,
    idMembre INT NOT NULL,
    idLivre INT NOT NULL,
    idBibliotheque INT NOT NULL,
    dateEmprunt DATE NOT NULL,
    dateRetourPrevue DATE NOT NULL,
    dateRetourReelle DATE DEFAULT NULL,
    montantAmende DECIMAL(6,2) DEFAULT 0,
    FOREIGN KEY (idMembre) REFERENCES Membre(idMembre),
    FOREIGN KEY (idLivre) REFERENCES Livre(idLivre),
    FOREIGN KEY (idBibliotheque) REFERENCES Bibliotheque(idBibliotheque)
);

-- -----------------------------
-- Table : Reservation
-- -----------------------------
CREATE TABLE Reservation (
    idReservation INT AUTO_INCREMENT PRIMARY KEY,
    idMembre INT NOT NULL,
    idLivre INT NOT NULL,
    idBibliotheque INT NOT NULL,
    dateReservation DATE NOT NULL,
    dateExpiration DATE NOT NULL,
    FOREIGN KEY (idMembre) REFERENCES Membre(idMembre),
    FOREIGN KEY (idLivre) REFERENCES Livre(idLivre),
    FOREIGN KEY (idBibliotheque) REFERENCES Bibliotheque(idBibliotheque)
);

-- -----------------------------
-- Table : Paiement
-- -----------------------------
CREATE TABLE Paiement (
    idPaiement INT AUTO_INCREMENT PRIMARY KEY,
    idMembre INT NOT NULL,
    idEmprunt INT DEFAULT NULL,
    idBibliotheque INT NOT NULL,
    datePaiement DATE NOT NULL,
    montant DECIMAL(6,2) NOT NULL,
    FOREIGN KEY (idMembre) REFERENCES Membre(idMembre),
    FOREIGN KEY (idEmprunt) REFERENCES Emprunt(idEmprunt),
    FOREIGN KEY (idBibliotheque) REFERENCES Bibliotheque(idBibliotheque)
);
