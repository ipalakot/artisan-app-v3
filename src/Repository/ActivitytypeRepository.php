<?php

namespace App\Repository;

use App\Entity\Activitytype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Activitytype>
 *
 * @method Activitytype|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activitytype|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activitytype[]    findAll()
 * @method Activitytype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivitytypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activitytype::class);
    }

//    /**
//     * @return Activitytype[] Returns an array of Activitytype objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Activitytype
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
