<?php

abstract class Membre {
    protected int $id;
    protected string $nom;
    protected string $email;
    protected ?string $telephone;
    protected string $dateDebutAdhesion;
    protected ?string $dateFinAdhesion;
    protected float $soldeAmende;

    public function __construct(int $id,string $nom,string $email,?string $telephone = null,string $dateDebutAdhesion,?string $dateFinAdhesion = null,float $soldeAmende = 0) {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->dateDebutAdhesion = $dateDebutAdhesion;
        $this->dateFinAdhesion = $dateFinAdhesion;
        $this->soldeAmende = $soldeAmende;
    }

   
    public function adhesionValide(): bool {
        $ajourdhui = date('Y-m-d');
        return $ajourdhui >= $this->dateDebutAdhesion &&($this->dateFinAdhesion === null || $ajourdhui <= $this->dateFinAdhesion);
    }

   
    public function getMontantImpayé(): float {
        return $this->soldeAmende;
    }

    public function ajouterFrais(float $montant): void {
        $this->soldeAmende += $montant;
    }

    public function payerFrais(float $montant): void {
        $this->soldeAmende -= $montant;
        if ($this->soldeAmende < 0) $this->soldeAmende = 0;
    }

    
    abstract public function getLimiteEmprunt(): int;
    abstract public function getDureeEmprunt(): int; 
    abstract public function getFraisRetardParJour(): float;
}
