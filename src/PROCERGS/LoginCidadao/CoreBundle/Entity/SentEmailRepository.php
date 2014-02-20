<?php

namespace PROCERGS\LoginCidadao\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * SentEmailRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SentEmailRepository extends EntityRepository
{
    public function findAllSentInTheLast24h($indexedByReceiver = false)
    {
        $date = new \DateTime("-24 hours");
        $result = $this->getEntityManager()
            ->createQuery('SELECT s FROM PROCERGSLoginCidadaoCoreBundle:SentEmail s WHERE s.date >= :date')
            ->setParameter('date', $date)
            ->getResult();
        if ($indexedByReceiver) {
            $indexed = array();
            foreach ($result as $email) {
                $indexed[$email->getReceiver()] = $email;
            }
            return $indexed;
        } else {
            return $result;
        }
    }
}