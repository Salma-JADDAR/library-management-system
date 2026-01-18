<?php

class Emprunt {
    private int $id;
    private string $dateEmprunt;
    private string $dateRetourPrevue;
    private ?string $dateRetourEffective;
    private float $fraisRetard;
    private int $idMembre;
    private string $isbnLivre;
    private int $idCampus;

    public function __construct(int $id,string $dateEmprunt,string $dateRetourPrevue,?string $dateRetourEffective,float $fraisRetard,int $idMembre,string $isbnLivre,int $idCampus) {
        $this->id = $id;
        $this->dateEmprunt = $dateEmprunt;
        $this->dateRetourPrevue = $dateRetourPrevue;
        $this->dateRetourEffective = $dateRetourEffective;
        $this->fraisRetard = $fraisRetard;
        $this->idMembre = $idMembre;
        $this->isbnLivre = $isbnLivre;
        $this->idCampus = $idCampus;
    }

  

    public function getId(): int {
        return $this->id;
    }

    public function getDateEmprunt(): string {
        return $this->dateEmprunt;
    }

    public function getDateRetourPrevue(): string {
        return $this->dateRetourPrevue;
    }

    public function getDateRetourEffective(): ?string {
        return $this->dateRetourEffective;
    }

    public function getFraisRetard(): float {
        return $this->fraisRetard;
    }

    public function getIdMembre(): int {
        return $this->idMembre;
    }

    public function getIsbnLivre(): string {
        return $this->isbnLivre;
    }

    public function getIdCampus(): int {
        return $this->idCampus;
    }


    public function retournerLivre(string $dateRetour): void {
        $this->dateRetourEffective = $dateRetour;
    }

   
    public function calculerFraisRetard(float $fraisParJour): float {
        if ($this->dateRetourEffective === null) {
            return 0;
        }

        $retourPrevu = new DateTime($this->dateRetourPrevue);
        $retourEffectif = new DateTime($this->dateRetourEffective);

        if ($retourEffectif <= $retourPrevu) {
            return 0;
        }

        $joursRetard = $retourPrevu->diff($retourEffectif)->days;
        $this->fraisRetard = $joursRetard * $fraisParJour;

        return $this->fraisRetard;
    }

    
    public function estEnRetard(): bool {
        if ($this->dateRetourEffective !== null) {
            return $this->dateRetourEffective > $this->dateRetourPrevue;
        }
        return date('Y-m-d') > $this->dateRetourPrevue;
    }
}
