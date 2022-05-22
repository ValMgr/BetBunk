<?php

namespace App\Entity;

use App\Repository\QuizTextRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Quiz;

#[ORM\Entity(repositoryClass: QuizTextRepository::class)]
class QuizText extends Quiz
{
    #[ORM\OneToMany(mappedBy: 'quizText', targetEntity: Question::class, orphanRemoval: true, cascade: ['persist'])]
    private $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }
    
    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setQuizText($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuizText() === $this) {
                $question->setQuizText(null);
            }
        }

        return $this;
    }

    public function getCountQuestions(): int
    {
        return $this->questions->count();
    }
}
