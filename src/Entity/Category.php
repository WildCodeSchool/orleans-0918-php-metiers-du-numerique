<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="le champ ne peut pas être vide")
     * @Assert\Regex("/^[\sa-zA-Z0-9ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ'-]+$/i",
     *      message="Votre nom de catégorie ne doit contenir que des lettres")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Job", mappedBy="associatedCategory")
     */
    private $associatedJobs;

    public function __construct()
    {
        $this->associatedJobs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Job[]
     */
    public function getAssociatedJobs(): Collection
    {
        return $this->associatedJobs;
    }

    public function addAssociatedJob(Job $associatedJob): self
    {
        if (!$this->associatedJobs->contains($associatedJob)) {
            $this->associatedJobs[] = $associatedJob;
            $associatedJob->setAssociatedCategory($this);
        }

        return $this;
    }

    public function removeAssociatedJob(Job $associatedJob): self
    {
        if ($this->associatedJobs->contains($associatedJob)) {
            $this->associatedJobs->removeElement($associatedJob);
            // set the owning side to null (unless already changed)
            if ($associatedJob->getAssociatedCategory() === $this) {
                $associatedJob->setAssociatedCategory(null);
            }
        }

        return $this;
    }
}
