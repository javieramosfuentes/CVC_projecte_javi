<?php

namespace App\Repository;

use App\Entity\Login;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Login>
 *
 * @method Login|null find($id, $lockMode = null, $lockVersion = null)
 * @method Login|null findOneBy(array $criteria, array $orderBy = null)
 * @method Login[]    findAll()
 * @method Login[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LoginRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Login::class);
    }

    //    /**
    //     * @return Login[] Returns an array of Login objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

        public function findOneByUser($value): ?Login
        {
            return $this->createQueryBuilder('l')
                ->andWhere('l.user = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }

        public function findAllQuery(): \Doctrine\ORM\Query
        {
            return $this->createQueryBuilder('c')
                ->orderBy('c.user', 'ASC')
                ->getQuery();
            //->andWhere('c.isDeleted IS NULL OR c.isDeleted = 0') filtrat per al soft delete

        }

        public function findByText($value): array {
            return $this->createQueryBuilder('c')
                ->where('c.user LIKE :value')
                ->setParameter('value', '%' . $value . '%')
                ->orderBy('c.user', 'ASC')
                ->getQuery()
                ->getResult();
        }
}
