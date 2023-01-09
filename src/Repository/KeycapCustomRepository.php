<?php

namespace App\Repository;

use App\Entity\KeycapCustom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<KeycapCustom>
 *
 * @method KeycapCustom|null find($id, $lockMode = null, $lockVersion = null)
 * @method KeycapCustom|null findOneBy(array $criteria, array $orderBy = null)
 * @method KeycapCustom[]    findAll()
 * @method KeycapCustom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KeycapCustomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KeycapCustom::class);
    }

    public function save(KeycapCustom $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(KeycapCustom $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return KeycapCustom[] Returns an array of KeycapCustom objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('k')
//            ->andWhere('k.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('k.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?KeycapCustom
//    {
//        return $this->createQueryBuilder('k')
//            ->andWhere('k.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
