<?php

/**
 * Created by Gustavo Falco <comfortablynumb84@gmail.com>
 */

namespace CodeSpotlight\Bundle\SmallUrlBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UrlRepository extends EntityRepository
{
    public function findUrlForCode($code)
    {
        return $this->getEntityManager()->findOneByCode($code);
    }
}
