<?php
namespace app\Services;

use app\Repositories\MembreRepository;
use app\Models\Membre;

class MembreService{
    private MembreRepository $repo;

    public function __construct(MembreRepository $repo){
        $this->repo = $repo;
    }

    public function ajouterMembre(Membre $membre): bool{
        return $this->repo->ajouter($membre);
    }

    public function obtenirMembre(int $id): ?Membre{
        return $this->repo->trouverParId($id);
    }

    public function mettreAJourMembre(Membre $membre): bool{
        return $this->repo->mettreAJour($membre);
    }

    public function supprimerMembre(int $id): bool{
        return $this->repo->supprimer($id);
    }

    public function listerMembres(): array{
        return $this->repo->lister();
    }
}
