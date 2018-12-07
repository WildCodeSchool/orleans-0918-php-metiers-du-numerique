<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobRepository")
 * @Vich\Uploadable
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
     * @Vich\UploadableField(mapping="jobs", fileNameProperty="picture")
     * @var File
     * @Assert\Image(maxSize="2M",maxSizeMessage="Cette image est trop volumineuse.")
     */
    private $pictureFile;

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

    /**
     * @ORM\ManyToMany(targetEntity="Company", mappedBy="jobs")
     */
    private $companies;
  
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="associatedJob")
     */
    private $associatedComments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="jobs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $associatedCategory;

    public function __construct()
    {

        $this->learningCenters = new ArrayCollection();

        $this->companies = new ArrayCollection();

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
     * @return Collection|Company[]
     */
    public function getCompanies(): Collection
    {
        return $this->companies;
    }

    public function addCompanies(Company $company): self
    {
        if (!$this->companies->contains($company)) {
            $this->companies[] = $company;
            $company->addJob($this);
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
  
    public function removeCompanies(Company $company): self
    {
        if ($this->companies->contains($company)) {
            $this->companies->removeElement($company);
            $company->removeJob($this);
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

    public function getAssociatedCategory(): ?Category
    {
        return $this->associatedCategory;
    }

    public function setAssociatedCategory(?Category $associatedCategory): self
    {
        $this->associatedCategory = $associatedCategory;

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
}
