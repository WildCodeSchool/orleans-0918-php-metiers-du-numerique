<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobRepository")
 */
class Job
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $video;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $videoDescription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $videoTitle;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\LearningCenter", mappedBy="jobs")
     */
    private $learningCenters;

    public function __construct()
    {
        $this->learningCenters = new ArrayCollection();
    }
  
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="associatedJob")
     */
    private $associatedComments;

    public function __construct()
    {
        $this->associatedComments = new ArrayCollection();
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

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(?string $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getVideoDescription(): ?string
    {
        return $this->videoDescription;
    }

    public function setVideoDescription(?string $videoDescription): self
    {
        $this->videoDescription = $videoDescription;

        return $this;
    }

    public function getVideoTitle(): ?string
    {
        return $this->videoTitle;
    }

    public function setVideoTitle(?string $videoTitle): self
    {
        $this->videoTitle = $videoTitle;

        return $this;
    }

    /**
     * @return Collection|LearningCenter[]
     */
    public function getLearningCenters(): Collection
    {
        return $this->learningCenters;
    }

    public function addLearningCenter(LearningCenter $learningCenter): self
    {
        if (!$this->learningCenters->contains($learningCenter)) {
            $this->learningCenters[] = $learningCenter;
            $learningCenter->addJob($this);
        }
    }
      
     /**
     * @return Collection|Comment[]
     */
    public function getAssociatedComments(): Collection
    {
        return $this->associatedComments;
    }

    public function addAssociatedComment(Comment $associatedComment): self
    {
        if (!$this->associatedComments->contains($associatedComment)) {
            $this->associatedComments[] = $associatedComment;
            $associatedComment->setAssociatedJob($this);
        }

        return $this;
    }


    public function removeLearningCenter(LearningCenter $learningCenter): self
    {
        if ($this->learningCenters->contains($learningCenter)) {
            $this->learningCenters->removeElement($learningCenter);
            $learningCenter->removeJob($this);
        }
    }
    public function removeAssociatedComment(Comment $associatedComment): self
    {
        if ($this->associatedComments->contains($associatedComment)) {
            $this->associatedComments->removeElement($associatedComment);
            // set the owning side to null (unless already changed)
            if ($associatedComment->getAssociatedJob() === $this) {
                $associatedComment->setAssociatedJob(null);
            }
        }

        return $this;
    }
}
