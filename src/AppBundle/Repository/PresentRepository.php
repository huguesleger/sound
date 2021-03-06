<?php

namespace AppBundle\Repository;

/**
 * PresentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PresentRepository extends \Doctrine\ORM\EntityRepository
{
    
     public function getNbPublish() {
      
        $qb = $this->createQueryBuilder('p');
  

        $qb
                        ->select('COUNT(p)')
                        ->where('p.publier = 1');
                        
                        return $qb
                        ->getQuery()
                        ->getSingleScalarResult();
  
    } 
    
}
