<?php
class Etudiant extends Membre {
    private string $niveauEtude; 

    public function __construct(int $id,string $nom,string $email,?string $telephone = null,string $dateDebutAdhesion,?string $dateFinAdhesion = null,float $soldeAmende = 0,string $niveauEtude,) {
        parent::__construct($id, $nom, $email, $telephone,$dateDebutAdhesion, $dateFinAdhesion,  $soldeAmende);
        $this->niveauEtude = $niveauEtude;
    }

    public function getNiveauEtude(): string {
        return $this->niveauEtude;
    }

    public function getLimiteEmprunt(): int {
        return 3;
    }

    public function getDureeEmprunt(): int {
        return 14; 
    }

    public function getFraisRetardParJour(): float {
        return 0.50; 
    }
}