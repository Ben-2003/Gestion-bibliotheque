-- Création de la base de données
CREATE DATABASE IF NOT EXISTS biblio;
USE biblio;

-- =========================
-- TABLE ETUDIANT
-- =========================
CREATE TABLE Etudiant (
    CodeEtudiant INT AUTO_INCREMENT PRIMARY KEY, -- Identifiant unique de l'étudiant
    Nom VARCHAR(100) NOT NULL,                    -- Nom de l'étudiant
    Prenom VARCHAR(100) NOT NULL,                 -- Prénom de l'étudiant
    Adresse VARCHAR(255),                         -- Adresse de l'étudiant
    Classe VARCHAR(50)                            -- Classe de l'étudiant
);

-- =========================
-- TABLE LIVRE
-- =========================
CREATE TABLE Livre (
    CodeLivre INT AUTO_INCREMENT PRIMARY KEY, -- Identifiant unique du livre
    Titre VARCHAR(150) NOT NULL,               -- Titre du livre
    Auteur VARCHAR(100) NOT NULL,              -- Auteur du livre
    DateEdition DATE                           -- Date d'édition
);

-- =========================
-- TABLE EMPRUNTER
-- =========================
CREATE TABLE Emprunter (
    CodeEtudiant INT,                           -- Référence à l'étudiant
    CodeLivre INT,                              -- Référence au livre
    DateEmprunt DATE NOT NULL,                  -- Date de l'emprunt
    PRIMARY KEY (CodeEtudiant, CodeLivre),      -- Clé primaire composée
    FOREIGN KEY (CodeEtudiant) REFERENCES Etudiant(CodeEtudiant)
        ON DELETE CASCADE,
    FOREIGN KEY (CodeLivre) REFERENCES Livre(CodeLivre)
        ON DELETE CASCADE
);

CREATE TABLE utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomutilisateur VARCHAR(100) NOT NULL UNIQUE,
    motdepasse VARCHAR(100) NOT NULL
    
);
