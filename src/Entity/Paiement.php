<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class Paiement
{
    const TYPECB = [
        0 => 'Payal',
        1 => 'Visa',
        2 => 'MasterCard'
    ];
    
    private $typeCb;
   
    private $numCb;
   
    private $codeSecurity;

    private $nom;

    /* getters and setters */
    public function getTypeCb(): ?int
    {
        return $this->typeCb;
    }
    public function setTypeCb(int $typeCb): self
    {
        $this->typeCb = $typeCb;

        return $this;
    }
    public function getNumCb(): ?int
    {
        return $this->numCb;
    }
    public function setNumCb(int $numCb): self
    {
        $this->numCb = $numCb;

        return $this;
    }
    public function getCodeSecurity(): ?int
    {
        return $this->codeSecurity;
    }

    public function setCodeSecurity(int $codeSecurity): self
    {
        $this->codeSecurity = $codeSecurity;

        return $this;
    }
    public function getNom(): ?string
    {
        return $this->nom;
    }
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
}