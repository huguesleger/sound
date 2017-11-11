<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;


/**
 * SoundRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SoundRepository extends EntityRepository
{
  public function getSoundsWithGenre(array $genre)
  {
      $qb = $this->createQueryBuilder('s');

    // On fait une jointure avec l'entité Genre avec pour alias « g »
    $qb
      ->innerJoin('s.genre', 'g')
      ->addSelect('g')
      ->orderBy('s.date', 'DESC');

    // Puis on filtre sur le nom des genres à l'aide d'un IN
    $qb->where($qb->expr()->in('g.nom', $genre));

    return $qb
      ->getQuery()
      ->getResult()
    ;
  
  }
  
  public function findSoundBytitre($motcle){
      
     $qb = $this->createQueryBuilder('s');

    $qb
      ->where('s.titre like :titre')
      ->setParameter('titre', $motcle.'%')     
      ->orWhere('s.auteur Like :auteur')
      ->setParameter('auteur', $motcle.'%')
            ;
     
     return $qb
      ->getQuery()
      ->getResult()
    ;
  }
  

    
}

