<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $job;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $business;

    /**
     * @ORM\Column(type="text")
     */
    private $plusComment;

    /**
     * @ORM\Column(type="text")
     */
    private $lessComment;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $variousComment;

    /**
     * @ORM\Column(type="boolean")
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

    public function getBusiness(): ?string
    {
        return $this->business;
    }

    public function setBusiness(?string $business): self
    {
        $this->business = $business;

        return $this;
    }

    public function getPlusComment(): ?string
    {
        return $this->plusComment;
    }

    public function setPlusComment(string $plusComment): self
    {
        $this->plusComment = $plusComment;

        return $this;
    }

    public function getLessComment(): ?string
    {
        return $this->lessComment;
    }

    public function setLessComment(string $lessComment): self
    {
        $this->lessComment = $lessComment;

        return $this;
    }

    public function getVariousComment(): ?string
    {
        return $this->variousComment;
    }

    public function setVariousComment(?string $variousComment): self
    {
        $this->variousComment = $variousComment;

        return $this;
    }

    public function getLiked(): ?bool
    {
        return $this->liked;
    }

    public function setLiked(bool $liked): self
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
