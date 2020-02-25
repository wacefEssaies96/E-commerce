<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PanierRepository")
 */
class Panier
{
    const LIV = [
        0 => 'Non',
        1 => 'Oui'
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=1, max=10)
     */
    private $qtt;

    /**
     * @ORM\Column(type="integer")
     */
    private $liv;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="panier")
     * 
     */
    private $uid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produits", inversedBy="paniers")
     */
    private $pid;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $confirm;

    



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getProdId(): ?int
    {
        return $this->ProdId;
    }

    public function setProdId(int $ProdId): self
    {
        $this->ProdId = $ProdId;

        return $this;
    }

    public function getQtt(): ?int
    {
        return $this->qtt;
    }

    public function setQtt(int $qtt): self
    {
        $this->qtt = $qtt;

        return $this;
    }

    public function getLiv(): ?int
    {
        return $this->liv;
    }

    public function setLiv(int $liv): self
    {
        $this->liv = $liv;

        return $this;
    }

    public function getUid(): ?User
    {
        return $this->uid;
    }

    public function setUid(?User $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function getPid(): ?Produits
    {
        return $this->pid;
    }

    public function setPid(?Produits $pid): self
    {
        $this->pid = $pid;

        return $this;
    }

    public function getConfirm(): ?int
    {
        return $this->confirm;
    }

    public function setConfirm(?int $confirm): self
    {
        $this->confirm = $confirm;

        return $this;
    }


   
}
