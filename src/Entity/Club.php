<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClubRepository::class)]
class Club
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $createdArt = null;

    #[ORM\ManyToMany(targetEntity: Student::class, inversedBy: 'clubs')]
    private Collection $Student;

    public function __construct()
    {
        $this->Student = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedArt(): ?string
    {
        return $this->createdArt;
    }

    public function setCreatedArt(string $createdArt): self
    {
        $this->createdArt = $createdArt;

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getStudent(): Collection
    {
        return $this->Student;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->Student->contains($student)) {
            $this->Student->add($student);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        $this->Student->removeElement($student);

        return $this;
    }

}
