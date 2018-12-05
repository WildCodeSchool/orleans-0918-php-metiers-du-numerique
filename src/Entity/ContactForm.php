<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactFormRepository")
 */
class ContactForm
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ ne peut pas être vide")
     * @Assert\Length(min="3", max="255", minMessage="Le champs ne comporte pas assez de caractère",
     *              maxMessage="Le champ comporte trop de caractère")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ ne peut pas être vide")
     * @Assert\Length(min="3", max="255", minMessage="Le champs ne comporte pas assez de caractère",
     *              maxMessage="Le champ comporte trop de caractère")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min="3", max="255", minMessage="Le champs ne comporte pas assez de caractère",
     *              maxMessage="Le champ comporte trop de caractère")
     */
    private $companyOrLearningCenter;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ ne peut pas être vide")
     * @Assert\Length(min="6", max="255", minMessage="Le champs ne comporte pas assez de caractère",
     *              maxMessage="Le champ comporte trop de caractère")
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ ne peut pas être vide")
     * @Assert\Length(min="3", max="255", minMessage="Le champs ne comporte pas assez de caractère",
     *              maxMessage="Le champ comporte trop de caractère")
     */
    private $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCompanyOrLearningCenter(): ?string
    {
        return $this->companyOrLearningCenter;
    }

    public function setCompanyOrLearningCenter(?string $companyOrLearningCenter): self
    {
        $this->companyOrLearningCenter = $companyOrLearningCenter;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

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
