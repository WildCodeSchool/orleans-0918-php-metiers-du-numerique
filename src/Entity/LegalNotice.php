<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LegalNoticeRepository")
 */
class LegalNotice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Notice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNotice(): ?string
    {
        return $this->Notice;
    }

    public function setNotice(?string $Notice): self
    {
        $this->Notice = $Notice;

        return $this;
    }
}
