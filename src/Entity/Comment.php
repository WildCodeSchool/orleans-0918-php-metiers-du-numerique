<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 * @Vich\Uploadable
 */
class Comment
{
    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $picture;

    /**
     * @Vich\UploadableField(mapping="comments", fileNameProperty="picture")
     * @var File
     * @Assert\File(maxSize="2M", maxSizeMessage="Cette image est trop volumineuse.")
     */
    private $pictureFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex("/^[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+$/i",
     *              message="Votre nom ne doit contenir que des lettres")
     * @Assert\NotBlank(message="Ce champs ne peut être vide")
     * @Assert\Length(min="3", max="255", minMessage="Le champs ne comporte pas assez de caractère",
     *              maxMessage="Le champ comporte trop de caractère")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex("/^[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+$/i",
     *              message="Votre nom ne doit contenir que des lettres")
     * @Assert\NotBlank(message="Ce champs ne peut être vide")
     * @Assert\Length(min="3", max="255", minMessage="Le champs ne comporte pas assez de caractère",
     *              maxMessage="Le champ comporte trop de caractère")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message="Cette adresse email n'est pas valide.")
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $job;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $company;

    /**
     * @ORM\Column(type="text")
     */
    private $consComment;

    /**
     * @ORM\Column(type="text")
     */
    private $prosComment;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    /**
     * @ORM\Column(type="integer")
     */
    private $liked;

    /**
     * @ORM\Column(type="boolean")
     */
    private $accepted;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Job", inversedBy="associatedComments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $associatedJob;

    /**
     * @ORM\Column(type="datetime")
     */
    private $postDate;

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
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function setPictureFile(File $picture = null)
    {
        $this->pictureFile = $picture;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($picture) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getPictureFile()
    {
        return $this->pictureFile;
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

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getConsComment(): ?string
    {
        return $this->consComment;
    }

    public function setConsComment(string $consComment): self
    {
        $this->consComment = $consComment;

        return $this;
    }

    public function getProsComment(): ?string
    {
        return $this->prosComment;
    }

    public function setProsComment(string $prosComment): self
    {
        $this->prosComment = $prosComment;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getLiked(): ?int
    {
        return $this->liked;
    }

    public function setLiked(int $liked): self
    {
        $this->liked = $liked;

        return $this;
    }

    public function getAccepted(): ?bool
    {
        return $this->accepted;
    }

    public function setAccepted(bool $accepted): self
    {
        $this->accepted = $accepted;

        return $this;
    }

    public function getAssociatedJob(): ?Job
    {
        return $this->associatedJob;
    }

    public function setAssociatedJob(?Job $associatedJob): self
    {
        $this->associatedJob = $associatedJob;

        return $this;
    }

    public function getPostDate(): ?\DateTimeInterface
    {
        return $this->postDate;
    }

    public function setPostDate(\DateTimeInterface $postDate): self
    {
        $this->postDate = $postDate;

        return $this;
    }
}
