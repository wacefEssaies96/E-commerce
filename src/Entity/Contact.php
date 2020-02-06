<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    private $sujet;
    /**
     * @Assert\Email(
     *      message = "Votre E-mail {{ value }} n'est pas valide !"
     * )
     */
    private $email;
   
    private $message;

    /* getters and setters */
    public function getSujet(): ?string
    {
        return $this->sujet;
    }
    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
