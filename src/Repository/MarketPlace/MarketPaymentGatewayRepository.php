<?php

namespace App\Repository\MarketPlace;

use App\Entity\MarketPlace\MarketPaymentGateway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MarketPaymentGateway>
 *
 * @method MarketPaymentGateway|null find($id, $lockMode = null, $lockVersion = null)
 * @method MarketPaymentGateway|null findOneBy(array $criteria, array $orderBy = null)
 * @method MarketPaymentGateway[]    findAll()
 * @method MarketPaymentGateway[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarketPaymentGatewayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarketPaymentGateway::class);
    }

//    /**
//     * @return MarketPaymentGateway[] Returns an array of MarketPaymentGateway objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MarketPaymentGateway
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
