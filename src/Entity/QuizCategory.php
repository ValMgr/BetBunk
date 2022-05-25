<?php

namespace App\Entity;

use App\Repository\QuizCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Quiz;

#[ORM\Entity(repositoryClass: QuizCategoryRepository::class)]
class QuizCategory extends Quiz
{
    #[ORM\OneToMany(mappedBy: 'quizCategory', targetEntity: Category::class, orphanRemoval: true)]
    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setQuizCategory($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getQuizCategory() === $this) {
                $category->setQuizCategory(null);
            }
        }

        return $this;
    }
}
