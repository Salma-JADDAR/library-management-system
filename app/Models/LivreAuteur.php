<?php

class LivreAuteur {
    private string $isbnLivre;
    private int $idAuteur;
    private string $role;

    public function __construct(string $isbnLivre,int $idAuteur,string $role) {
        $this->isbnLivre = $isbnLivre;
        $this->idAuteur = $idAuteur;
        $this->role = $role;
    }

    public function getIsbnLivre(): string {
        return $this->isbnLivre;
    }

    public function getIdAuteur(): int {
        return $this->idAuteur;
    }

    public function getRole(): string {
        return $this->role;
    }

    public function setRole(string $role): void {
        $this->role = $role;
    }
}
