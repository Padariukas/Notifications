<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeletedUserRepository")
 */
class DeletedUser
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
    private $UserName;

    /**
     * @ORM\Column(type="date")
     */
    private $DisableDate;

    /**
     * @ORM\Column(type="date")
     */
    private $DeleteDate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $IsDeleted;

    /**
     * @ORM\Column(type="date")
     */
    private $ArchiveDate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $IsArchived;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $IsArchiveDeleted;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->UserName;
    }

    public function setUserName(string $UserName): self
    {
        $this->UserName = $UserName;

        return $this;
    }

    public function getDisableDate(): ?\DateTimeInterface
    {
        return $this->DisableDate;
    }

    public function setDisableDate(\DateTimeInterface $DisableDate): self
    {
        $this->DisableDate = $DisableDate;

        return $this;
    }

    public function getDeleteDate(): ?\DateTimeInterface
    {
        return $this->DeleteDate;
    }

    public function setDeleteDate(\DateTimeInterface $DeleteDate): self
    {
        $this->DeleteDate = $DeleteDate;

        return $this;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->IsDeleted;
    }

    public function setIsDeleted(?bool $IsDeleted): self
    {
        $this->IsDeleted = $IsDeleted;

        return $this;
    }

    public function getArchiveDate(): ?\DateTimeInterface
    {
        return $this->ArchiveDate;
    }

    public function setArchiveDate(\DateTimeInterface $ArchiveDate): self
    {
        $this->ArchiveDate = $ArchiveDate;

        return $this;
    }

    public function getIsArchived(): ?bool
    {
        return $this->IsArchived;
    }

    public function setIsArchived(?bool $IsArchived): self
    {
        $this->IsArchived = $IsArchived;

        return $this;
    }

    public function getIsArchiveDeleted(): ?bool
    {
        return $this->IsArchiveDeleted;
    }

    public function setIsArchiveDeleted(?bool $IsArchiveDeleted): self
    {
        $this->IsArchiveDeleted = $IsArchiveDeleted;

        return $this;
    }
}
