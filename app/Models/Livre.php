<?php

class Livre {
    private string $ISBN;
    private string $titre;
    private ?int $anneePublication;

    public function __construct(string $ISBN, string $titre, ?int $anneePublication = null) {
        $this->ISBN = $ISBN;
        $this->titre = $titre;
        $this->anneePublication = $anneePublication;
    }

    public function getISBN(): string {
        return $this->ISBN;
    }

    public function getTitre(): string {
        return $this->titre;
    }

    public function getAnneePublication(): ?int {
        return $this->anneePublication;
    }

   

    public function setTitre(string $titre): void {
        $this->titre = $titre;
    }

    public function setAnneePublication(?int $anneePublication): void {
        $this->anneePublication = $anneePublication;
    }
}
