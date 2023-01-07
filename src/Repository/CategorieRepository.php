<?php

namespace App\Repository;

use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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

    /**
     * On renvoie un tableau du nombre de propriétés par catégorie
     *
     * @return array Un tableau des catégories et le nombre de propriétés dans chaque catégorie.
     */
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


    /**
     * On renvoie un tableau des villes avec le plus de propriétés
     *
     * @return array La requête renvoie l'identifiant maximum de la catégorie et la ville de la propriété.
     */
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

    /**
     * On renvoie l'identifiant maximum d'une propriété pour chaque ville
     *
     * @return array L'id max de la catégorie et le cp du bien
     */
    public function countByCode(): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            '
            SELECT MAX(c.id) as max, b.cp as cp
            FROM App\Entity\Bien b
            JOIN App\Entity\Categorie c
            WHERE c.id = b.id_categorie
            GROUP BY b.ville
            ORDER BY max DESC
            '
        );
        return $query->getResult();
    }

    /**
     * On renvoie le nom d'une catégorie en fonction de son identifiant
     *
     * @param id L'identifiant de la catégorie dont vous souhaitez obtenir le nom.
     */
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
