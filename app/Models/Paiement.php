<?php

class Paiement{
    private int $idPaiement;
    private string $datePaiement;
    private float $montant;
    private string $modePaiement; 
    private int $idMembre;
    private string $isbnLivre;
    private int $idCampus;

    public function __construct(int $idPaiement,string $datePaiement,float $montant,string $modePaiement = 'ESPECES',int $idMembre,string $isbnLivre,int $idCampus) {
        $this->idPaiement = $idPaiement;
        $this->datePaiement = $datePaiement;
        $this->montant = $montant;
        $this->idMembre = $idMembre;
        $this->isbnLivre = $isbnLivre;
        $this->idCampus = $idCampus;
        $this->modePaiement = $modePaiement;
    }


    public function getIdPaiement(): int {
        return $this->idPaiement;
    }

    public function getDatePaiement(): string {
        return $this->datePaiement;
    }

    public function getMontant(): float {
        return $this->montant;
    }

    public function getModePaiement(): string {
        return $this->modePaiement;
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


    public function setModePaiement(string $modePaiement): void {
        $this->modePaiement = $modePaiement;
    }

    public function setMontant(float $montant): void {
        $this->montant = $montant;
    }

   
    public function paiementValide(): bool {
        return $this->montant > 0;
    }

    public function appliquerPaiement(Membre $membre): void {
        if ($this->paiementValide()) {
            $membre->payerFrais($this->montant);
        }
    }
}
