<?php

class Campus {
    private int $id;
    private string $nom;
    private string $location;
    private string $horairesOuverture;
    private string $contact;

    public function __construct(int $id,string $nom,string $location ,string $horairesOuverture ,string $contact ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->location = $location;
        $this->horairesOuverture = $horairesOuverture;
        $this->contact = $contact;
    }

   

    public function getId(): int {
        return $this->id;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getLocation(): ?string {
        return $this->location;
    }

    public function getHorairesOuverture(): ?string {
        return $this->horairesOuverture;
    }

    public function getContact(): ?string {
        return $this->contact;
    }

   

    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    public function setLocation(?string $location): void {
        $this->location = $location;
    }

    public function setHorairesOuverture(?string $horairesOuverture): void {
        $this->horairesOuverture = $horairesOuverture;
    }

    public function setContact(?string $contact): void {
        $this->contact = $contact;
    }
}
