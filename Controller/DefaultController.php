<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\TextBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Tadcka\Component\Breadcrumbs\Breadcrumbs;
use Tadcka\Component\Paginator\Pagination;
use Tadcka\TextBundle\Form\Factory\TextFormFactory;
use Tadcka\TextBundle\Form\Handler\TextFormHandler;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since  13.12.1 13.41
 */
class DefaultController extends ContainerAware
{
    /**
     * Renders a view.
     *
     * @param string $view         The view name
     * @param array $parameters    An array of parameters to pass to the view
     * @param Response $response   A response instance
     *
     * @return Response A Response instance
     */
    private function render($view, array $parameters = array(), Response $response = null)
    {
        return $this->container->get('templating')->renderResponse($view, $parameters, $response);
    }

    /**
     * @return TranslatorInterface
     */
    private function getTranslator()
    {
        return $this->container->get('translator');
    }

    /**
     * @return RouterInterface
     */
    private function getRouter()
    {
        return $this->container->get('router');
    }

    /**
     * @return SessionInterface
     */
    private function getSession()
    {
        return $this->container->get('session');
    }

    /**
     * @return \Tadcka\TextBundle\Provider\Provider
     */
    private function getProvider()
    {
        return $this->container->get('tadcka_text.provider');
    }

    /**
     * Get text form factory.
     *
     * @return TextFormFactory
     */
    private function getTextFormFactory()
    {
        return new TextFormFactory(
            $this->container->get('form.factory'),
            $this->container->getParameter('tadcka_text.text_class'),
            $this->container->getParameter('tadcka_text.text_translation_class')
        );
    }

    public function indexAction(Request $request, $page = 1)
    {
        $limit = 30;

        $count = $this->getProvider()->getCount($request->getLocale());
        $pagination = new Pagination($count, $page, $limit);
        if ($page !== $pagination->getCurrentPage()) {
            $pagination = new Pagination($count, 1, $limit);
        }

        $texts = $this->getProvider()->getTexts(
            $request->getLocale(),
            $pagination->getOffset(),
            $pagination->getItemsPerPage()
        );
        var_dump($texts); die;

        if (true === $request->isXmlHttpRequest()) {
            return $this->render(
                'TadckaTextBundle:Default/List:content.html.twig',
                array(
                    'pages' => $this->container->get('tadcka_paginator.manager')->getPaginatorHtml($pagination),
                    'texts' => $texts,
                )
            );
        }

        $title = $this->getTranslator()->trans('list.title', array(), 'TadckaTextBundle');
        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add($title);

        return $this->render(
            'TadckaTextBundle:Default/List:list.html.twig',
            array(
                'title' => $title,
                'breadcrumbs' => $breadcrumbs,
                'pages' => $this->container->get('tadcka_paginator.manager')->getPaginatorHtml($pagination),
                'texts' => $texts,
            )
        );
    }

    public function createAction(Request $request)
    {
        $form = $this->getTextFormFactory()->create($this->getRouter()->generate('tadcka_text_create'));
        $formHandler = new TextFormHandler($request, $this->getSession());

        if (false !== ($text = $formHandler->process($form))) {
            $this->getProvider()->saveText($text);
            $formHandler->onSuccess($this->getTranslator()->trans('create.success', array(), 'TadckaTextBundle'));

            return new RedirectResponse($this->getRouter()->generate('tadcka_text_homepage'));
        }

        $title = $this->getTranslator()->trans('create.title', array(), 'TadckaTextBundle');
        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add(
            $this->getTranslator()->trans('list.title', array(), 'TadckaTextBundle'),
            $this->getRouter()->generate('tadcka_text_homepage')
        );
        $breadcrumbs->add($title);

        return $this->render(
            'TadckaTextBundle:Default:create_edit.html.twig',
            array(
                'title' => $title,
                'breadcrumbs' => $breadcrumbs,
                'form' => $form->createView(),
            )
        );
    }

    public function editAction(Request $request, $id)
    {
        $text = $this->getProvider()->getTextById($id);

        if (null === $text) {
            throw new \LogicException('Not found text.');
        }

        $form = $this->getTextFormFactory()->create(
            $this->getRouter()->generate('tadcka_text_edit', array('id' => $id)),
            $text
        );
        $formHandler = new TextFormHandler($request, $this->getDoctrine(), $this->getSession());

        if (true === $formHandler->process($form)) {
            $this->getDoctrine()->getManager()->flush();
            $formHandler->onSuccess($this->getTranslator()->trans('edit.success', array(), 'TadckaTextBundle'));

            return new RedirectResponse($this->getRouter()->generate('tadcka_text_homepage'));
        }

        $title = $this->getTranslator()->trans('edit.title', array(), 'TadckaTextBundle');
        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add(
            $this->getTranslator()->trans('list.title', array(), 'TadckaTextBundle'),
            $this->getRouter()->generate('tadcka_text_homepage')
        );
        $breadcrumbs->add($title);

        return $this->render(
            'TadckaTextBundle:Default:create_edit.html.twig',
            array(
                'title' => $title,
                'breadcrumbs' => $breadcrumbs,
                'form' => $form->createView(),
            )
        );
    }
}
