<?php

namespace App\Repository;

use App\Entity\Bien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bien>
 *
 * @method Bien|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bien|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bien[]    findAll()
 * @method Bien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bien::class);
    }

    public function save(Bien $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Bien $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * On renvoie la référence d'une propriété
     *
     * @param id L'identifiant de la propriété
     *
     * @return array La référence du bien
     */
    public function getRef($id): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('SELECT p.ref
            FROM App\Entity\Bien p
            WHERE p.id = :id
            ')
            ->setParameter('id', $id);
        return $query->getResult();
    }

    /**
     * On renvoie un tableau de toutes les villes et codes postaux distincts des propriétés dans la base de données
     *
     * @return array Un tableau de toutes les villes et codes postaux des propriétés.
     */
    public function getLocalisation(): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('SELECT distinct p.ville,p.cp
            FROM App\Entity\Bien p
            ORDER BY p.ville asc
            ');
        return $query->getResult();
    }
}
