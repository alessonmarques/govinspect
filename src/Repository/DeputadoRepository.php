<?php

namespace App\Repository;

use App\Entity\Deputado;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Deputado>
 *
 * @method Deputado|null find($id, $lockMode = null, $lockVersion = null)
 * @method Deputado|null findOneBy(array $criteria, array $orderBy = null)
 * @method Deputado[]    findAll()
 * @method Deputado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeputadoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Deputado::class);
    }

//    /**
//     * @return Deputado[] Returns an array of Deputado objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Deputado
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
