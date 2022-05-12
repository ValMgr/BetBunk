<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

// use Entity\QuizCategory;
// use Entity\QuizText;

#[ORM\Entity(repositoryClass: QuizRepository::class)]
#[ORM\Table(name:"quiz")]
#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name:"type", type:"string", length:2)]
#[ORM\DiscriminatorMap(["QC"=>QuizCategory::class, "QT"=>QuizText::class])]
#[Vich\Uploadable] 
class Quiz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    #[Vich\UploadableField(mapping: 'thumbnails', fileNameProperty: 'thumbnailName', size: 'thumbnailSize')]
    private $thumbnail;

    #[ORM\Column(type: 'string')]
    private $thumbnailName;
    #[ORM\Column(type: 'integer')]
    private $thumbnailSize;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Vich\UploadableField(mapping: 'images', fileNameProperty: 'imageName', size: 'imageSize')]
    private $image;

    #[ORM\Column(type: 'string')]
    private $imageName;
    #[ORM\Column(type: 'integer')]
    private $imageSize;

    #[ORM\Column(type: 'integer')]
    private $note;

    #[ORM\Column(type: 'integer')]
    private $time;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'quizzes')]
    #[ORM\JoinColumn(nullable: false)]
    private $user_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;
        if (null !== $thumbnail) {
            $this->updatedAt = new \DateTimeImmutable();
        }
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;
        if (null !== $image) {
            $this->updatedAt = new \DateTimeImmutable();
        }
        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(int $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}
