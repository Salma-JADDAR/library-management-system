<?php

class Auteur {
    protected int $id;
    protected string $nom;
    protected string $biographie;
    protected string $nationalite;
    protected string $dateNaissance;
    protected ?string $dateDeces;
    protected string $genrePrincipal;

    public function __construct(int $id,string $nom,string $biographie,string $nationalite,string $dateNaissance,?string $dateDeces ,string $genrePrincipal ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->biographie = $biographie;
        $this->nationalite = $nationalite;
        $this->dateNaissance = $dateNaissance;
        $this->dateDeces = $dateDeces;
        $this->genrePrincipal = $genrePrincipal;
    }

    
    public function getId(): int {
        return $this->id;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getBiographie(): string {
        return $this->biographie;
    }

    public function getNationalite(): string {
        return $this->nationalite;
    }

    public function getDateNaissance(): string {
        return $this->dateNaissance;
    }

    public function getDateDeces(): ?string {
        return $this->dateDeces;
    }

    public function getGenrePrincipal(): string {
        return $this->genrePrincipal;
    }

    
    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    public function setBiographie(?string $biographie): void {
        $this->biographie = $biographie;
    }

    public function setNationalite(?string $nationalite): void {
        $this->nationalite = $nationalite;
    }

    public function setDateNaissance(?string $dateNaissance): void {
        $this->dateNaissance = $dateNaissance;
    }

    public function setDateDeces(?string $dateDeces): void {
        $this->dateDeces = $dateDeces;
    }

    public function setGenrePrincipal(?string $genrePrincipal): void {
        $this->genrePrincipal = $genrePrincipal;
    }
}
