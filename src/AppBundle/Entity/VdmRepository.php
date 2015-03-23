<?php
/**
 * Created by PhpStorm.
 * User: tweety
 * Date: 23/03/15
 * Time: 23:10
 */

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\Collection;

use AppBundle\Entity\Vdm;


class VdmRepository extends EntityRepository {

    public function findOverPeriod($from, $to) {

        $sql = 'SELECT vdm FROM '.Vdm::CLASS_NAME.' vdm ';
        $sql .= 'WHERE vdm.when >= :from ';
        $sql .= 'AND vdm.when <= :to ';
        $sql .= 'ORDER BY vdm.when ASC';

        $query = $this->getEntityManager()->createQuery($sql);
        $query->setParameter(':from', $from);
        $query->setParameter(':to', $to);

        return $query->getResult();
    }

    public function findByAuthor($author = "") {

        $sql = 'SELECT vdm FROM '.Vdm::CLASS_NAME.' vdm ';
        $sql .= "WHERE vdm.author = :author ";

        $query = $this->getEntityManager()->createQuery($sql);
        $query->setParameter('author', $author);

        return $query->getResult();
    }

    public function deleteData() {

        $sql = 'DELETE FROM '.Vdm::CLASS_NAME.' vdm WHERE 1=1';
        $query = $this->getEntityManager()->createQuery($sql);
        return $query->execute();

    }
}