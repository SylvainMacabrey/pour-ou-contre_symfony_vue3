<?php

namespace App\Repository;

use App\Entity\UserQuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserQuestion>
 *
 * @method UserQuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserQuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserQuestion[]    findAll()
 * @method UserQuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserQuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserQuestion::class);
    }

    public function add(UserQuestion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserQuestion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function hasVoted($question, $user)
    {
        return $this->findOneBy(['user' => $user, 'question' => $question]);
    }

    public function result($idQuestion, $value) {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT (
                    SELECT COUNT(*) FROM user_question AS uq
                    WHERE uq.question_id = :idQuestion AND uq.answer = :v
                    GROUP BY uq.answer
                ) / COUNT(*) AS result FROM user_question AS uq
                WHERE uq.question_id = :idQuestion';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['idQuestion' => $idQuestion, 'v' => $value]);
        return $resultSet->fetchAllAssociative()[0];
    }

//    /**
//     * @return UserQuestion[] Returns an array of UserQuestion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserQuestion
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}