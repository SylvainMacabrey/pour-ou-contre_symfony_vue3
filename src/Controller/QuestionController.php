<?php

namespace App\Controller;

use App\Entity\UserQuestion;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserQuestionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuestionController extends AbstractController
{

    public function __construct(QuestionRepository $questionRepository, UserQuestionRepository $userQuestionRepository, EntityManagerInterface $em)
    {
        $this->questionRepository = $questionRepository;
        $this->userQuestionRepository = $userQuestionRepository;
        $this->em = $em;
    }

    #[Route('/', name: 'question.index')]
    public function index(): Response
    {
        return $this->render('question/index.html.twig');
    }

    #[Route('/api/question', name: 'question.getQuestion', methods: ['GET'])]
    public function getQuestion(): JsonResponse
    {
        return $this->json([
            'question' => $this->questionRepository->randomQuestion(),
            'isConnected' => $this->getUser() ? true : false
        ]);
    }

    #[Route('/api/answer', name: 'question.answer', methods: ['POST'])]
    public function answer(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $question = $this->questionRepository->find($data['questionId']);
        $hasVoted = $this->userQuestionRepository->hasVoted($question, $this->getUser());
        if($hasVoted) {
            $qr = $hasVoted;
            $qr->setAnswer($data['value']);
            $this->em->persist($qr);
        } else {
            $qr = new UserQuestion();
            $qr->setUser($this->getUser());
            $qr->setQuestion($question);
            $qr->setAnswer($data['value']);
            $this->em->persist($qr);
        }
        $this->em->flush();
        $result = $this->userQuestionRepository->result($data['questionId'], $data['value']);
        return $this->json(['stat' => $result]);
    }
}
