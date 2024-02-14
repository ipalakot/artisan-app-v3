<?php

namespace App\Repository;

use App\Entity\Trader;
use App\Entity\Activitytype; 


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends    ServiceEntityRepository<Trader>
 * @implements PasswordUpgraderInterface<Trader>
 *
 * @method Trader|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trader|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trader[]    findAll()
 * @method Trader[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TraderRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trader::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof Trader) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    //    /**
    //     * @return Trader[] Returns an array of Trader objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Trader
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }


    //récupérer toutes les boulangeries 
    
    public function findByBoulangerie()
    {
        $qb = $this->createQueryBuilder('a');

        $qb
            ->innerJoin('App\Entity\Activitytype',  'c', 'WITH', 'c = a.activitytype')

            ->where('c.title like :activitytype')
            ->setParameter('activitytype', 'Boulangeries Pâtisseries')
            ->orderBy('a.compagnyname', 'ASC');

        // dump($qb->getQuery()->getResult());

        return $qb->getQuery()->getResult();
    }

    //Récupérer toutes les boucheries 
    public function findByBoucherie()
    {
        $qb = $this->createQueryBuilder('a');

        $qb
            ->innerJoin('App\Entity\Activitytype',  'c', 'WITH', 'c = a.activitytype')

            ->where('c.title like :activitytype')
            ->setParameter('activitytype', 'Boucheries')
            ->orderBy('a.compagnyname', 'ASC');

        // dump($qb->getQuery()->getResult());

        return $qb->getQuery()->getResult();
    }


    //Récupéré toutes les Poissonneries
    public function findByPoissonnerie()
    {
        $qb = $this->createQueryBuilder('a');

        $qb
            ->innerJoin('App\Entity\Activitytype',  'c', 'WITH', 'c = a.activitytype')

            ->where('c.title like :activitytype')
            ->setParameter('activitytype', 'Poissonneries')
            ->orderBy('a.compagnyname', 'ASC');

        // dump($qb->getQuery()->getResult());

        return $qb->getQuery()->getResult();
    }




    //Récupérer touttes les fromageries 
    public function findByFromagerie()
    {
        $qb = $this->createQueryBuilder('a');

        $qb
            ->innerJoin('App\Entity\Activitytype',  'c', 'WITH', 'c = a.activitytype')

            ->where('c.title like :activitytype')
            ->setParameter('activitytype', 'Fromageries')
            ->orderBy('a.compagnyname', 'ASC');

        // dump($qb->getQuery()->getResult());

        return $qb->getQuery()->getResult();
    }


    //Récupérer tous les primeurs 
    public function findByPrimeur()
    {
        $qb = $this->createQueryBuilder('a');

        $qb
            ->innerJoin('App\Entity\Activitytype',  'c', 'WITH', 'c = a.activitytype')

            ->where('c.title like :activitytype')
            ->setParameter('activitytype', 'Primeurs')
            ->orderBy('a.compagnyname', 'ASC');

        // dump($qb->getQuery()->getResult());

        return $qb->getQuery()->getResult();
    }


    //récupérer les traders par activitytype 
    public function findByTraderActivitytype($id)
    {
        $qb = $this->createQueryBuilder('a');

        $qb
            ->innerJoin('App\Entity\Activitytype',  'c', 'WITH', 'c = a.activitytype')

            ->where('c.id like :activitytypeId')
            ->setParameter('activitytypeId', $id)
            ->orderBy('a.compagnyname', 'ASC');

        // dump($qb->getQuery()->getResult());

        return $qb->getQuery()->getResult();
    }










} //fin de class 
