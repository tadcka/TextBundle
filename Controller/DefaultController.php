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

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Tadcka\Component\Breadcrumbs\Breadcrumbs;
use Tadcka\Component\Paginator\Pagination;
use Tadcka\PaginatorBundle\Manager\PaginatorManager;
use Tadcka\TextBundle\Form\Factory\TextFormFactory;
use Tadcka\TextBundle\Form\Handler\TextFormHandler;
use Tadcka\TextBundle\ModelManager\TextManagerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since  13.12.1 13.41
 */
class DefaultController extends ContainerAware
{
    /**
     * @return EngineInterface
     */
    private function getTemplating()
    {
        return $this->container->get('templating');
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
     * @return TextFormFactory
     */
    private function getFormFactory()
    {
        return $this->container->get('tadcka_text.form_factory.text');
    }

    /**
     * @return TextFormHandler
     */
    private function getFormHandler()
    {
        return $this->container->get('tadcka_text.form_handler.text');
    }

    /**
     * @return TextManagerInterface
     */
    private function getManager()
    {
        return $this->container->get('tadcka_text.manager.text');
    }

    /**
     * @return PaginatorManager
     */
    private function getPaginatorManager()
    {
        return $this->container->get('tadcka_paginator.manager');
    }

    /**
     * Administrator text list action.
     *
     * @param Request $request
     * @param int $page
     *
     * @return Response
     */
    public function indexAction(Request $request, $page = 1)
    {
        $page = $request->get('page', $page);

        $count = $this->getManager()->count($request->getLocale());
        $pagination = new Pagination($count, $page, 20);

        if ($page !== $pagination->getCurrentPage()) {
            $pagination = new Pagination($count, 1, 20);
        }

        $texts = $this->getManager()->findManyTextsByLocale(
            $request->getLocale(),
            $pagination->getOffset(),
            $pagination->getItemsPerPage()
        );

        if ($request->isXmlHttpRequest()) {
            return $this->getTemplating()->renderResponse(
                'TadckaTextBundle:Default/List:content.html.twig',
                array(
                    'pages' => $this->getPaginatorManager()->getPaginatorHtml($pagination),
                    'texts' => $texts,
                )
            );
        }

        $title = $this->getTranslator()->trans('list.title', array(), 'TadckaTextBundle');

        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add($title);

        return $this->getTemplating()->renderResponse(
            'TadckaTextBundle:Default/List:list.html.twig',
            array(
                'title' => $title,
                'breadcrumbs' => $breadcrumbs,
                'pages' => $this->getPaginatorManager()->getPaginatorHtml($pagination),
                'texts' => $texts,
            )
        );
    }

    /**
     * Administrator text create action.
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
        $form = $this->getFormFactory()->create($this->getManager()->create());

        if (true === $this->getFormHandler()->process($request, $form)) {

            $this->getManager()->save();
            $this->getFormHandler()->onSuccess('create.success');

            return new RedirectResponse($this->getRouter()->generate('tadcka_text_homepage'));
        }

        $title = $this->getTranslator()->trans('create.title', array(), 'TadckaTextBundle');

        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add(
            $this->getTranslator()->trans('list.title', array(), 'TadckaTextBundle'),
            $this->getRouter()->generate('tadcka_text_homepage')
        );
        $breadcrumbs->add($title);

        return $this->getTemplating()->renderResponse(
            'TadckaTextBundle:Default/Action:create.html.twig',
            array(
                'title' => $title,
                'breadcrumbs' => $breadcrumbs,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Administrator text edit action.
     *
     * @param Request $request
     * @param int $id
     *
     * @throws \LogicException
     *
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, $id)
    {
        $text = $this->getManager()->find($id);

        if (null === $text) {
            throw new \LogicException('Text not found.');
        }

        $form = $this->getFormFactory()->create($text);

        if (true === $this->getFormHandler()->process($request, $form)) {

            $this->getManager()->save();
            $this->getFormHandler()->onSuccess('edit.success');

            return new RedirectResponse($this->getRouter()->generate('tadcka_text_homepage'));
        }

        $title = $this->getTranslator()->trans('edit.title', array(), 'TadckaTextBundle');

        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add(
            $this->getTranslator()->trans('list.title', array(), 'TadckaTextBundle'),
            $this->getRouter()->generate('tadcka_text_homepage')
        );
        $breadcrumbs->add($title);

        return $this->getTemplating()->renderResponse(
            'TadckaTextBundle:Default/Action:edit.html.twig',
            array(
                'title' => $title,
                'breadcrumbs' => $breadcrumbs,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Administrator text delete action.
     *
     * @param Request $request
     * @param int $id
     *
     * @throws \LogicException
     *
     * @return RedirectResponse|Response
     */
    public function deleteAction(Request $request, $id)
    {
        $text = $this->getManager()->find($id);

        if (null === $text) {
            throw new \LogicException('Text not found.');
        }

        if ($request->isMethod('POST')) {

            $this->getManager()->delete($text, true);
            $this->container->get('tadcka_text.flash_message')->onSuccess('remove.success');

            return new RedirectResponse($this->getRouter()->generate('tadcka_text_homepage'));
        }

        $title = $this->getTranslator()->trans('remove.title', array(), 'TadckaTextBundle');

        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add(
            $this->getTranslator()->trans('list.title', array(), 'TadckaTextBundle'),
            $this->getRouter()->generate('tadcka_text_homepage')
        );
        $breadcrumbs->add($title);

        return $this->getTemplating()->renderResponse(
            'TadckaTextBundle:Default/Action:delete.html.twig',
            array(
                'title' => $title,
                'breadcrumbs' => $breadcrumbs,
                'text' => $text,
            )
        );
    }
}
