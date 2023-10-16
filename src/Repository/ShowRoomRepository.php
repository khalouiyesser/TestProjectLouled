<?php

namespace App\Repository;

use App\Entity\ShowRoom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ShowRoom>
 *
 * @method ShowRoom|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShowRoom|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShowRoom[]    findAll()
 * @method ShowRoom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShowRoomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShowRoom::class);
    }

//    /**
//     * @return ShowRoom[] Returns an array of ShowRoom objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ShowRoom
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
