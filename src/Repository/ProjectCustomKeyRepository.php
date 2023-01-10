<?php

namespace App\Repository;

use App\Entity\ProjectCustomKey;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProjectCustomKey>
 *
 * @method ProjectCustomKey|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectCustomKey|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectCustomKey[]    findAll()
 * @method ProjectCustomKey[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectCustomKeyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectCustomKey::class);
    }

    public function save(ProjectCustomKey $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProjectCustomKey $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ProjectCustomKey[] Returns an array of ProjectCustomKey objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ProjectCustomKey
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
