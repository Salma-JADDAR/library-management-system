<?php
class Enseignant extends Membre {
    private string $fonction; 

    public function __construct(int $id,string $nom,string $email, ?string $telephone = null,string $dateDebutAdhesion,?string $dateFinAdhesion = null,float $soldeAmende = 0,string $fonction) {
        parent::__construct($id, $nom, $email,$telephone, $dateDebutAdhesion, $dateFinAdhesion,  $soldeAmende);
        $this->fonction = $fonction;
    }

    public function getFonction(): string {
        return $this->fonction;
    }

    public function getLimiteEmprunt(): int {
        return 10;
    }

    public function getDureeEmprunt(): int {
        return 30; 
    }

    public function getFraisRetardParJour(): float {
        return 0.25; 
    }
}
