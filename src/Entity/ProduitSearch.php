<?php
namespace App\Entity;

class ProduitSearch{
 
    private $minPrix;
  
    private $maxPrix;
    
    public function getMinPrix(): ?int
    {
        return $this->minPrix;
    }

    public function setMinPrix(int $minPrix): self
    {
        $this->minPrix = $minPrix;

        return $this;
    }
    public function getMaxPrix(): ?int
    {
        return $this->maxPrix;
    }

    public function setMaxPrix(int $maxPrix): self
    {
        $this->maxPrix = $maxPrix;

        return $this;
    }
}