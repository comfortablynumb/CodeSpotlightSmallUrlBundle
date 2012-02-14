<?php

/**
 * Created by Gustavo Falco <comfortablynumb84@gmail.com>
 */

namespace CodeSpotlight\Bundle\SmallUrlBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use CodeSpotlight\Bundle\ApplicationToolsBundle\Service\AbstractService;
use CodeSpotlight\Bundle\ApplicationToolsBundle\Service\Response\BaseResponse;
use CodeSpotlight\Bundle\SmallUrlBundle\Service\Response\Response;
use CodeSpotlight\Bundle\ApplicationToolsBundle\Exception\InvalidFormException;
use CodeSpotlight\Bundle\SmallUrlBundle\Exception\UrlNotFoundException;

class UrlService extends AbstractService
{
    public function preCreate($data, BaseResponse $response)
    {
        $url = $data->get('url');

        if (!is_null($url)) {
            $repo = $this->getRepository();
            $url = $repo->findOneByUrl($url);

            if ($url) {
                $response->setUrl($this->generateUrl($url->getCode()));

                return $response;
            }
        }
    }

    public function postCreate($data, BaseResponse $response)
    {
        $url = $this->generateUrl($data->getCode());

        $response->setUrl($url);
    }

    public function getUrlForCode($code)
    {
        try {
            $url = $this->getRepository()->findOneByCode((string) $code);

            if (!$url) {
                throw new UrlNotFoundException('La URL ingresada no es válida.');
            }

            $response = $this->createResponse();
            $response->setUrl($url);

            return $response;
        } catch (\Exception $e) {
            if ($this->handleExceptions) {
                return $this->handleException($e);
            } else {
                throw $e;
            }
        }
    }

    public function handleException(\Exception $e)
    {
        $response = parent::handleException($e);

        if ($e instanceof InvalidFormException) {
            $response->setMsg('Algunos de los valores en los campos del formulario son inválidos.');
        }

        return $response;
    }

    public function generateUrl($code)
    {
        return $this->container->get('router')->generate('CodeSpotlightSmallUrlBundle_url', array('code' => $code), true);
    }

    public function createResponse()
    {
        return new Response();
    }

    public function getObjectManager()
    {
        return $this->container->get('doctrine.orm.default_entity_manager');
    }

    public function getObjectClass()
    {
        return 'CodeSpotlight\Bundle\SmallUrlBundle\Entity\Url';
    }

    public function getObjectFormType()
    {
        return 'CodeSpotlight\Bundle\SmallUrlBundle\Form\Type\UrlType';
    }
}
