<?php

namespace App\Repository;

use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Categorie>
 *
 * @method Categorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorie[]    findAll()
 * @method Categorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorie::class);
    }

    public function save(Categorie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Categorie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Categorie[] Returns an array of Categorie objects
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


    public function countSorted(): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT c.intitule,count(c.id) as nombre
            FROM App\Entity\Categorie c
            JOIN App\Entity\Bien b
            WHERE c.id = b.id_categorie
            GROUP BY c.id'
        );
        return $query->getResult();
    }


    public function countByCity(): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            '
            SELECT MAX(c.id) as max, b.ville as city
            FROM App\Entity\Bien b
            JOIN App\Entity\Categorie c
            WHERE c.id = b.id_categorie
            GROUP BY b.ville
            ORDER BY max DESC
            '
        );
        return $query->getResult();
    }

    public function affichageIntit($id): array
    {

        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT p.intitule
            FROM App\Entity\Categorie p
            WHERE p.id = :id')
            ->setParameter('id', $id);
        return $query->getResult();
    }
}
