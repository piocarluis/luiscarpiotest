<?php

namespace App\Entity;

use App\Repository\TriangleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TriangleRepository::class)]
class Triangle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = "triangle";

    #[ORM\Column]
    private ?float $a = null;

    #[ORM\Column]
    private ?float $b = null;

    #[ORM\Column]
    private ?float $c = null;

    #[ORM\Column]
    private ?float $circumference = null;

    #[ORM\Column]
    private ?float $surface = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datetime = null;

    public function __construct()
    {
        $this->datetime = new \DateTime();
        $this->type = "triangle";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getA(): ?float
    {
        return $this->a;
    }

    public function setA(float $a): static
    {
        $this->a = $a;

        return $this;
    }

    public function getB(): ?float
    {
        return $this->b;
    }

    public function setB(string $b): static
    {
        $this->b = $b;

        return $this;
    }

    public function getC(): ?float
    {
        return $this->c;
    }

    public function setC(float $c): static
    {
        $this->c = $c;

        return $this;
    }

    public function getCircumference(): ?float
    {
        return $this->circumference;
    }

    public function setCircumference(): static
    {
        //$this->circumference = $circumference;
        $this->circumference = number_format(($this->a + $this->b + $this->c), 2, ".", "");

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(): static
    {
        //$this->surface = $surface;
        $this->surface = number_format((($this->a * $this->b) / 2), 2, ".", "");

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
