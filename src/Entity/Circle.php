<?php

namespace App\Entity;

use App\Repository\CircleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CircleRepository::class)]
class Circle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $type = "circle";

    #[ORM\Column]
    private ?float $radius = null;

    #[ORM\Column]
    private ?float $circumference = null;

    #[ORM\Column]
    private ?float $surface = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datetime = null;

    public function __construct()
    {
        $this->datetime = new \DateTime();
        $this->type = "circle";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getRadius(): ?float
    {
        return $this->radius;
    }

    public function setRadius(float $radius): self
    {
        $this->radius = $radius;

        return $this;
    }

    public function getCircumference(): ?float
    {
        return $this->circumference;
    }

    public function setCircumference(): self
    {
        //$this->circumference = $circumference;
        $this->circumference = number_format(($this->radius * pi() * 2), 2, ".", "");
        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(): self
    {
        //$this->surface = $surface;
        $this->surface = number_format(($this->radius * $this->radius * pi()), 2, ".", "");

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): static
    {
        $this->datetime = $datetime;

        return $this;
    }
}
