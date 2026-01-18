<?php

class Reservation{
    private int $id;
    private string $dateReservation;
    private string $dateExpiration;
    private string $statut; 
    private int $idMembre;
    private string $isbnLivre;
    private int $idCampus;

    public function __construct(int $id,string $dateReservation,string $dateExpiration,int $idMembre,string $isbnLivre,int $idCampus,string $statut = 'EN_ATTENTE') {
        $this->id = $id;
        $this->dateReservation = $dateReservation;
        $this->dateExpiration = $dateExpiration;
        $this->idMembre = $idMembre;
        $this->isbnLivre = $isbnLivre;
        $this->idCampus = $idCampus;
        $this->statut = $statut;
    }

  
    public function getId(): int {
        return $this->id;
    }

    public function getDateReservation(): string {
        return $this->dateReservation;
    }

    public function getDateExpiration(): string {
        return $this->dateExpiration;
    }

    public function getStatut(): string {
        return $this->statut;
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

  

    public function setStatut(string $statut): void {
        $this->statut = $statut;
    }

  
    public function estValide(): bool {
        $aujourdhui = date('Y-m-d');
        return $aujourdhui <= $this->dateExpiration && $this->statut !== 'ANNULEE' && $this->statut !== 'EXPIREE';
    }

    
    public function activer(): void {
        if ($this->estValide()) {
            $this->statut = 'ACTIVE';
        }
    }

  
    public function annuler(): void {
        $this->statut = 'ANNULEE';
    }

    public function expirer(): void {
        $this->statut = 'EXPIREE';
    }
}
