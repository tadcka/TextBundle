<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\TextBundle\Manager;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Tadcka\Component\Breadcrumbs\Breadcrumbs;
use Tadcka\Component\Paginator\Pagination;
use Tadcka\PaginatorBundle\Manager\PaginatorManager;
use Tadcka\TextBundle\Form\Factory\TextFormFactory;
use Tadcka\TextBundle\Form\Handler\TextFormHandler;
use Tadcka\TextBundle\Model\TextInterface;
use Tadcka\TextBundle\Provider\TextProviderInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.lt>
 *
 * @since 1/27/14 8:55 PM
 */
class TextAdministratorManager 
{
    /**
     * @var TextProviderInterface
     */
    private $textProvider;

    /**
     * @var PaginatorManager
     */
    private $paginatorManager;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * Constructor.
     *
     * @param TextProviderInterface $textProvider
     * @param PaginatorManager $paginatorManager
     * @param FormFactoryInterface $formFactory
     * @param SessionInterface $session
     * @param RouterInterface $router
     * @param EngineInterface $templating
     * @param TranslatorInterface $translator
     */
    public function __construct(
        TextProviderInterface $textProvider,
        PaginatorManager $paginatorManager,
        FormFactoryInterface $formFactory,
        SessionInterface $session,
        RouterInterface $router,
        EngineInterface $templating,
        TranslatorInterface $translator
    ) {
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->session = $session;
        $this->templating = $templating;
        $this->textProvider = $textProvider;
        $this->translator = $translator;
        $this->paginatorManager = $paginatorManager;
    }

    public function all(Request $request, $page = 1, $limit = 30)
    {
        $count = $this->textProvider->getCount($request->getLocale());
        $pagination = new Pagination($count, $page, $limit);
        if ($page !== $pagination->getCurrentPage()) {
            $pagination = new Pagination($count, 1, $limit);
        }

        $texts = $this->textProvider->getTexts(
            $request->getLocale(),
            $pagination->getOffset(),
            $pagination->getItemsPerPage()
        );

        if (true === $request->isXmlHttpRequest()) {
            return new Response(
                $this->templating->render(
                    'TadckaTextBundle:Default/List:content.html.twig',
                    array(
                        'pages' => $this->paginatorManager->getPaginatorHtml($pagination),
                        'texts' => $texts,
                    )
                )
            );
        }

        $title = $this->translator->trans('list.title', array(), 'TadckaTextBundle');

        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add($title);

        return new Response(
            $this->templating->render(
                'TadckaTextBundle:Default/List:list.html.twig',
                array(
                    'title' => $title,
                    'breadcrumbs' => $breadcrumbs,
                    'pages' => $this->paginatorManager->getPaginatorHtml($pagination),
                    'texts' => $texts,
                )
            )
        );
    }

    /**
     * Get create text response.
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $form = $this->getForm($this->router->generate('tadcka_text_create'));
        $formHandler = $this->getFormHandler($request);

        if (false !== ($text = $formHandler->process($form))) {
            $this->textProvider->saveText($text);
            $formHandler->onSuccess($this->translator->trans('create.success', array(), 'TadckaTextBundle'));

            return new RedirectResponse($this->router->generate('tadcka_text_homepage'));
        }

        $title = $this->translator->trans('create.title', array(), 'TadckaTextBundle');

        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add(
            $this->translator->trans('list.title', array(), 'TadckaTextBundle'),
            $this->router->generate('tadcka_text_homepage')
        );
        $breadcrumbs->add($title);

        return new Response(
            $this->templating->render(
                'TadckaTextBundle:Default/Action:create.html.twig',
                array(
                    'title' => $title,
                    'breadcrumbs' => $breadcrumbs,
                    'form' => $form->createView(),
                )
            )
        );
    }

    /**
     * Get edit text response.
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse|Response
     *
     * @throws \LogicException
     */
    public function edit(Request $request, $id)
    {
        $text = $this->textProvider->findText($id);

        if (null === $text) {
            throw new \LogicException('Not found text.');
        }

        $form = $this->getForm(
            $this->router->generate('tadcka_text_edit', array('id' => $id)),
            $text
        );

        $formHandler = $this->getFormHandler($request);

        if (false !== ($text = $formHandler->process($form))) {
            $this->textProvider->saveText($text);
            $formHandler->onSuccess($this->translator->trans('edit.success', array(), 'TadckaTextBundle'));

            return new RedirectResponse($this->router->generate('tadcka_text_homepage'));
        }

        $title = $this->translator->trans('edit.title', array(), 'TadckaTextBundle');

        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add(
            $this->translator->trans('list.title', array(), 'TadckaTextBundle'),
            $this->router->generate('tadcka_text_homepage')
        );
        $breadcrumbs->add($title);

        return new Response(
            $this->templating->render(
                'TadckaTextBundle:Default/Action:edit.html.twig',
                array(
                    'title' => $title,
                    'breadcrumbs' => $breadcrumbs,
                    'form' => $form->createView(),
                )
            )
        );
    }

    /**
     * Get delete text response.
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse|Response
     *
     * @throws \LogicException
     */
    public function delete(Request $request, $id)
    {
        $text = $this->textProvider->findText($id);

        if (null === $text) {
            throw new \LogicException('Not found text.');
        }

        if (true === $request->isMethod('POST')) {
            $this->textProvider->deleteText($text);

            $this->session->getFlashBag()->set(
                'flash_notices',
                array('success' => array($this->translator->trans('remove.success', array(), 'TadckaTextBundle')))
            );

            return new RedirectResponse($this->router->generate('tadcka_text_homepage'));
        }

        $title = $this->translator->trans('remove.title', array(), 'TadckaTextBundle');

        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add(
            $this->translator->trans('list.title', array(), 'TadckaTextBundle'),
            $this->router->generate('tadcka_text_homepage')
        );
        $breadcrumbs->add($title);

        return new Response(
            $this->templating->render(
                'TadckaTextBundle:Default/Action:delete.html.twig',
                array(
                    'title' => $title,
                    'breadcrumbs' => $breadcrumbs,
                    'text' => $text,
                )
            )
        );
    }

    /**
     * Get form.
     *
     * @param string $action
     * @param null|TextInterface $data
     *
     * @return FormInterface
     */
    private function getForm($action, $data = null)
    {
        $formFactory = new TextFormFactory($this->formFactory, $this->textProvider);

        return $formFactory->create($action, $data);

    }

    /**
     * Get form handler.
     *
     * @param Request $request
     *
     * @return TextFormHandler
     */
    private function getFormHandler(Request $request)
    {
        return new TextFormHandler($request, $this->session);
    }
}
 