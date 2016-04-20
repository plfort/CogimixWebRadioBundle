<?php
namespace Cogipix\CogimixWebRadioBundle\Repository;


use Doctrine\ORM\NoResultException;

use Doctrine\ORM\Query\Expr\Join;

use Doctrine\ORM\EntityRepository;


/**
 *
 * @author plfort - Cogipix
 *
 */
class WebRadioTrackRepository extends EntityRepository{


    public function searchByName($name,$limit=50,$orderByPlayedCount= true){
       $qb= $this->createQueryBuilder('w');
       $qb->select('w')
            ->andWhere('w.active = true');

       if(!empty($name)){
           $qb->andWhere('LOWER(w.title) like :name')->setParameter('name', '%'.strtolower($name).'%');
       }

       if(!empty($limit)){
           $qb->setMaxResults($limit);
       }
       if($orderByPlayedCount === true){
           $qb->orderBy('w.playCount','DESC');
       }

       $query=$qb->getQuery();
       $query->useQueryCache(true);
       $query->useResultCache(true,600);
       return $query->getResult();
    }



}