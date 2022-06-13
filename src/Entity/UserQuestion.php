<?php

namespace App\Entity;

use App\Repository\UserQuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserQuestionRepository::class)]
class UserQuestion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Question::class, inversedBy: 'userQuestions')]
    private $question;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'userQuestions')]
    private $user;

    #[ORM\Column(type: 'boolean')]
    private $answer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer ? "Pour" : "Contre";
    }

    public function setAnswer(bool $answer): self
    {
        $this->answer = $answer;

        return $this;
    }
}
