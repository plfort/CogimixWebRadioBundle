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
class WebRadioRepository extends EntityRepository{


    public function searchByName($name,$limit=50,$orderByPlayedCount= true){
       $qb= $this->createQueryBuilder('w');
       $qb->select('w')
            ->andWhere('w.active = 1');

       if(!empty($name)){
           $qb->andWhere('w.name like :name')->setParameter('name', '%'.$name.'%');
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