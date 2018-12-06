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
    private $author;

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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url(message="votre lien est invalide")
     * @Assert\Length(min="11", max="255",minMessage="Le champs ne comporte pas assez de caractère",
     *                  maxMessage="Le champ comporte trop de caractère")
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Ce champ ne peut pas être vide")
     * @Assert\Length(min="3", max="255", minMessage="Le champs ne comporte pas assez de caractère",
     *              maxMessage="Le champ comporte trop de caractère")
     */
    private $subject;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }
}
