<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $content;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: UserQuestion::class)]
    private $userQuestions;

    public function __construct()
    {
        $this->userQuestions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection<int, UserQuestion>
     */
    public function getUserQuestions(): Collection
    {
        return $this->userQuestions;
    }

    public function addUserQuestion(UserQuestion $userQuestion): self
    {
        if (!$this->userQuestions->contains($userQuestion)) {
            $this->userQuestions[] = $userQuestion;
            $userQuestion->setQuestion($this);
        }

        return $this;
    }

    public function removeUserQuestion(UserQuestion $userQuestion): self
    {
        if ($this->userQuestions->removeElement($userQuestion)) {
            // set the owning side to null (unless already changed)
            if ($userQuestion->getQuestion() === $this) {
                $userQuestion->setQuestion(null);
            }
        }

        return $this;
    }
}
