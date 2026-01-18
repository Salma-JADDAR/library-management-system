<?php

class LivreCampus {
    private string $isbnLivre;
    private int $idCampus;
    private int $nombreExemplaires;
    private string $statut;

    public function __construct(string $isbnLivre,int $idCampus,int $nombreExemplaires = 1,string $statut = 'Disponible') {
        $this->isbnLivre = $isbnLivre;
        $this->idCampus = $idCampus;
        $this->nombreExemplaires = $nombreExemplaires;
        $this->statut = $statut;
    }

    public function getIsbnLivre(): string {
        return $this->isbnLivre;
    }

    public function getIdCampus(): int {
        return $this->idCampus;
    }

    public function getNombreExemplaires(): int {
        return $this->nombreExemplaires;
    }

    public function getStatut(): string {
        return $this->statut;
    }

    public function setNombreExemplaires(int $nombre): void {
        $this->nombreExemplaires = $nombre;
    }

    public function setStatut(string $statut): void {
        $this->statut = $statut;
    }

    public function estDisponible(): bool {
        return $this->statut === 'Disponible' && $this->nombreExemplaires > 0;
    }

    public function diminuerExemplaire(): void {
        if ($this->nombreExemplaires > 0) {
            $this->nombreExemplaires--;
        }
    }

    public function augmenterExemplaire(): void {
        $this->nombreExemplaires++;
    }
}
