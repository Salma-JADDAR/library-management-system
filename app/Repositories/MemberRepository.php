<?php
namespace app\Repositories;

use PDO;
use app\Models\Membre;
use app\Models\Etudiant;
use app\Models\Enseignant;

class MembreRepository{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

   
    public function ajouter(Membre $membre): bool{
        $sql = "INSERT INTO Membre 
            (nom, email, telephone, dateDebutAdhesion, dateFinAdhesion, soldeAmende, role, niveauEtude, fonction)
            VALUES (:nom, :email, :telephone, :dateDebutAdhesion, :dateFinAdhesion, :soldeAmende, :role, :niveauEtude, :fonction)";
        $stmt = $this->pdo->prepare($sql);

        $role = $membre instanceof Etudiant ? 'ETUDIANT' : 'ENSEIGNANT';
        $niveauEtude = $membre instanceof Etudiant ? $membre->getNiveauEtude() : null;
        $fonction = $membre instanceof Enseignant ? $membre->getFonction() : null;

        return $stmt->execute([
            ':nom' => $membre->getNom(),
            ':email' => $membre->getEmail(),
            ':telephone' => $membre->getTelephone(),
            ':dateDebutAdhesion' => $membre->getDateDebutAdhesion(),
            ':dateFinAdhesion' => $membre->getDateFinAdhesion(),
            ':soldeAmende' => $membre->getSoldeAmende(),
            ':role' => $role,
            ':niveauEtude' => $niveauEtude,
            ':fonction' => $fonction
        ]);
    }

   
    public function trouverParId(int $id): ?Membre{
        $sql = "SELECT * FROM Membre WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        
        if ($row['role'] === 'ETUDIANT') {
            return new Etudiant(
                $row['id'],
                $row['nom'],
                $row['email'],
                $row['telephone'],
                $row['dateDebutAdhesion'],
                $row['dateFinAdhesion'],
                $row['niveauEtude'],
                $row['soldeAmende']
            );
        } else {
            return new Enseignant(
                $row['id'],
                $row['nom'],
                $row['email'],
                $row['telephone'],
                $row['dateDebutAdhesion'],
                $row['dateFinAdhesion'],
                $row['fonction'],
                $row['soldeAmende']
            );
        }
    }

   
    public function mettreAJour(Membre $membre): bool{
        $sql = "UPDATE Membre
                SET nom=:nom, email=:email, telephone=:telephone,
                    dateDebutAdhesion=:dateDebutAdhesion, dateFinAdhesion=:dateFinAdhesion,
                    soldeAmende=:soldeAmende, role=:role, niveauEtude=:niveauEtude, fonction=:fonction
                WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $role = $membre instanceof Etudiant ? 'ETUDIANT' : 'ENSEIGNANT';
        $niveauEtude = $membre instanceof Etudiant ? $membre->getNiveauEtude() : null;
        $fonction = $membre instanceof Enseignant ? $membre->getFonction() : null;

        return $stmt->execute([
            ':nom' => $membre->getNom(),
            ':email' => $membre->getEmail(),
            ':telephone' => $membre->getTelephone(),
            ':dateDebutAdhesion' => $membre->getDateDebutAdhesion(),
            ':dateFinAdhesion' => $membre->getDateFinAdhesion(),
            ':soldeAmende' => $membre->getSoldeAmende(),
            ':role' => $role,
            ':niveauEtude' => $niveauEtude,
            ':fonction' => $fonction,
            ':id' => $membre->getId()
        ]);
    }

  
    public function supprimer(int $id): bool{
        $sql = "DELETE FROM Membre WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function lister(): array{
        $sql = "SELECT * FROM Membre";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $membres = [];
        foreach ($rows as $row) {
            $membres[] = $this->trouverParId((int)$row['id']);
        }

        return $membres;
    }
}
