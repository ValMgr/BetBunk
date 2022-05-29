<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
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

    #[ORM\Column(type: 'string', nullable: true)]
    private $imageName;
    #[ORM\Column(type: 'integer', nullable: true)]
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

    public function getThumbnail(): ?File
    {
        return $this->thumbnail;
    }

    public function getThumbnailName(): ?string
    {
        return $this->thumbnailName;
    }

    public function getThumbnailSize(): ?int
    {
        return $this->thumbnailSize;
    }

    public function setThumbnailName(string $name){
        $this->thumbnailName = $name;
    }

    public function setThumbnailSize(int $size){
        $this->thumbnailSize = $size;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function setImageName(string $name){
        $this->imageName = $name;
    }

    public function setImageSize(int $size){
        $this->imageSize = $size;
    }

    public function setThumbnail(?File $thumbnail): self
    {
        $this->thumbnail = $thumbnail;
        if (null !== $thumbnail) {
            $this->updatedAt = new \DateTimeImmutable();
        }
        return $this;
    }

    public function getImage(): ?File
    {
        return $this->image;
    }

    public function setImage(?File $image): self
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
