<?php
namespace Skeleton\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * SkeletonRepository
 *
 * Find replace Skeleton with your entity
 *
 * @todo Incoporate a BaseRepository to handle
 *       simple methods
 */
class SkeletonRepository extends EntityRepository
{
    public function findAll($limit = null, $offset = null, $orderBy = null, $order = null, $criteria = null)
    {
        $iterated = false;

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('Skeleton')
           ->from("Skeleton\Entity\Skeleton", "Skeleton");

        if (!is_null($order)) {
            $qb->orderBy("Skeleton." . $orderBy, $order);
        }

        if (!is_null($limit)) {
            $qb->setMaxResults($limit);
        }

        if (!is_null($offset)) {
            $qb->setFirstResult($offset);
        }

        if ($criteria) {
            foreach ($criteria as $key => $value) {
                $qb->andWhere("Lot.{$key} = '{$value}'");
            }
        }

        return $qb->getQuery()->getArrayResult();
    }

    public function findOneBy(array $criteria) {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('Skeleton')
           ->from("Skeleton\Entity\Skeleton", "Skeleton");

        if ($criteria) {
            foreach ($criteria as $key => $value) {
                $qb->andWhere("Skeleton.{$key} = '{$value}'");
            }
        }

        $qb->setMaxResults('1');

        $result = $qb->getQuery()->getResult();
        if (isset($result[0])) {
            return $result[0];
        } else
        return [];
    }    
}