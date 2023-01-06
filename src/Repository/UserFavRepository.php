<?php

namespace App\Repository;

use App\Entity\UserFav;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ManagerRegistry;
use PDO;

/**
 * @extends ServiceEntityRepository<UserFav>
 *
 * @method UserFav|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserFav|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserFav[]    findAll()
 * @method UserFav[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserFavRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserFav::class);
    }

    public function save(UserFav $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserFav $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function countByMonth(): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
        // count of userFavs by month
            'SELECT 
            
            COUNT(u.id) as count, 
            MONTH(u.dateEnvoie) as month, 
            YEAR(u.dateEnvoie) as year
            FROM App\Entity\UserFav u
            GROUP BY month'
        );
        return $query->getResult();
    }

    public function countByYear(): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
        // count of userFavs by month
            'SELECT COUNT(u.id) as count, YEAR(u.dateEnvoie) as year 
            FROM App\Entity\UserFav u
            GROUP BY year'
        );
        return $query->getResult();
    }

    public function countByDay(): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
        // count of userFavs by month
            'SELECT COUNT(u.id) as count, DAY(u.dateEnvoie) as day 
            FROM App\Entity\UserFav u
            GROUP BY day'
        );
        return $query->getResult();
    }

    //SELECT user_fav_bien.bien_id, COUNT(*) FROM `user_fav_bien` GROUP BY bien_id;
    public function countByBienOrdered(): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            '
            SELECT userfav.id, COUNT(userfav.id) as count 
            FROM App\Entity\UserFav userfav 
            GROUP BY userfav.id
            '
        );
        return $query->getResult();
    }


    public function biensByFavorite(): array
    {

        try {
            $dbh = new PDO('mysql:host=localhost;dbname=saferpw;charset=utf8', 'root',);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        $stmt = $dbh->prepare("SELECT categorie.intitule, user_fav.date_envoie,count(bien.id)
                                     FROM user_fav_bien JOIN bien
                                     ON user_fav_bien.bien_id = bien.id
                                     JOIN  user_fav
                                     ON user_fav.id = user_fav_bien.user_fav_id
                                     JOIN categorie 
                                     ON bien.id_categorie_id = categorie.id
                                     GROUP by bien.id");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


//    /**
//     * @return UserFav[] Returns an array of UserFav objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserFav
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
