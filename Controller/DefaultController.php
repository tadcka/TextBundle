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

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since  13.12.1 13.41
 */
class DefaultController extends ContainerAware
{
    /**
     * @return \Tadcka\TextBundle\Manager\TextAdministratorManager
     */
    private function getTextAdministratorManager()
    {
        return $this->container->get('tadcka_text.manager.text_administrator');
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

        return $this->getTextAdministratorManager()->all($request, $page);
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
        return $this->getTextAdministratorManager()->create($request);
    }

    /**
     * Administrator text edit action.
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, $id)
    {
        return $this->getTextAdministratorManager()->edit($request, $id);
    }

    /**
     * Administrator text delete action.
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse|Response
     */
    public function deleteAction(Request $request, $id)
    {
        return $this->getTextAdministratorManager()->delete($request, $id);
    }
}
