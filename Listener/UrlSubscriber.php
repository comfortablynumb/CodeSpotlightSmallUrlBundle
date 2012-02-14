<?php

/**
 * Created by Gustavo Falco <comfortablynumb84@gmail.com>
 */

namespace CodeSpotlight\Bundle\SmallUrlBundle\Listener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use CodeSpotlight\Bundle\SmallUrlBundle\Entity\Url;
use CodeSpotlight\Bundle\SmallUrlBundle\Generator\GeneratorInterface;

class UrlSubscriber implements EventSubscriber
{
    protected $codeGenerator;

    public function __construct(GeneratorInterface $codeGenerator)
    {
        $this->codeGenerator = $codeGenerator;
    }

    public function getSubscribedEvents()
    {
        return array('postPersist');
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $object = $args->getEntity();

        if ($object instanceof Url) {
            $code = $this->codeGenerator->generate($object->getId());

            $em = $args->getEntityManager();
            $uow = $em->getUnitOfWork();
            $changes = array(
                'code' => array(null, $code)
            );

            $uow->scheduleExtraUpdate($object, $changes);
            $object->setCode($code);
        }
    }
}
