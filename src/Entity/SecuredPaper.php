<?php

namespace App\Entity;

use App\Repository\SecuredPaperRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SecuredPaperRepository::class)]
class SecuredPaper
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $secured_paper_type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSecuredPaperType(): ?string
    {
        return $this->secured_paper_type;
    }

    public function setSecuredPaperType(?string $secured_paper_type): static
    {
        $this->secured_paper_type = $secured_paper_type;

        return $this;
    }
}
