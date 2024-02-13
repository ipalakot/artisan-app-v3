<?php

namespace App\Repository;

use App\Entity\Categoryproduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Categoryproduct>
 *
 * @method Categoryproduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categoryproduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categoryproduct[]    findAll()
 * @method Categoryproduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryproductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categoryproduct::class);
    }

//    /**
//     * @return Categoryproduct[] Returns an array of Categoryproduct objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Categoryproduct
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
