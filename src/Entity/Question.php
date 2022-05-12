<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
#[Vich\Uploadable] 
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Vich\UploadableField(mapping: 'images', fileNameProperty: 'imageName', size: 'imageSize')]
    private $image;

    #[ORM\Column(type: 'string')]
    private $imageName;
    #[ORM\Column(type: 'integer')]
    private $imageSize;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    private $answer;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'questions')]
    private $category;

    #[ORM\ManyToOne(targetEntity: QuizText::class, inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    private $quizText;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getQuizText(): ?QuizText
    {
        return $this->quizText;
    }

    public function setQuizText(?QuizText $quizText): self
    {
        $this->quizText = $quizText;

        return $this;
    }
}
