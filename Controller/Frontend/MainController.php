<?php

namespace CodeSpotlight\Bundle\SmallUrlBundle\Controller\Frontend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use CodeSpotlight\Bundle\ApplicationToolsBundle\Controller\BaseController;
use CodeSpotlight\Bundle\SmallUrlBundle\Exception\UrlNotFoundException;

class MainController extends BaseController
{
    protected $response;

    public function indexAction(Request $request)
    {
        $service = $this->getUrlService();

        if ($request->getMethod() === 'POST') {
            $response = $service->createTransactional($request);
            $form = $response->getForm();
        } else {
            $response = $this->response;
            $form = $service->createForm();
        }

        return $this->render('CodeSpotlightSmallUrlBundle:Frontend/Main:index.html.twig', array(
            'form'          => $form->createView(),
            'response'      => $response
        ));
    }

    public function urlAction(Request $request, $code)
    {
        $service = $this->getUrlService();
        $response = $service->getUrlForCode($code);

        if (!$response->isSuccess()) {
            $exception = $response->getException();
            if ($exception instanceof UrlNotFoundException) {
                $this->response = $service->createResponse();
                $this->response->setIsSuccess(false)
                    ->setException($exception)
                    ->setMsg('La URL ingresada no existe en nuestro sistema!');

                return $this->indexAction($request);
            } else {
                throw $exception;
            }

        } else {
            return new RedirectResponse($response->getUrl()->getUrl());
        }
    }

    public function aboutUsAction(Request $request)
    {
        return $this->render('CodeSpotlightSmallUrlBundle:Frontend/Main:about_us.html.twig');
    }

    public function contactAction(Request $request)
    {
        return $this->render('CodeSpotlightSmallUrlBundle:Frontend/Main:contact.html.twig');
    }

    public function getUrlService()
    {
        return $this->get('code_spotlight_small_url.service.url');
    }
}
