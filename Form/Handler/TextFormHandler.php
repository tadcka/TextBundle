<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\TextBundle\Form\Handler;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Tadcka\TextBundle\Model\TextInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 13.12.1 13.41
 */
class TextFormHandler
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * Constructor.
     *
     * @param Request $request
     * @param SessionInterface $session
     */
    public function __construct(Request $request, SessionInterface $session)
    {
        $this->request = $request;
        $this->session = $session;
    }

    /**
     * Process.
     *
     * @param FormInterface $form
     *
     * @return bool|TextInterface
     */
    public function process(FormInterface $form)
    {
        if (true === $this->request->isMethod('POST')) {
            $form->submit($this->request);
            if ($form->isValid()) {
                $text = $form->getData();

                return $text;
            }
        }

        return false;
    }

    /**
     * On success.
     *
     * @param string $message
     */
    public function onSuccess($message)
    {
        $this->session->getFlashBag()->set('flash_notices', array('success' => array($message)));
    }
}
