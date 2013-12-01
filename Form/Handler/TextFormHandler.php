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

use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Tadcka\TextBundle\Entity\Text;

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
     * @var RegistryInterface
     */
    private $doctrine;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * Constructor.
     *
     * @param Request $request
     * @param RegistryInterface $doctrine
     * @param SessionInterface $session
     */
    public function __construct(Request $request, RegistryInterface $doctrine, SessionInterface $session)
    {
        $this->request = $request;
        $this->doctrine = $doctrine;
        $this->session = $session;
    }

    /**
     * Process.
     *
     * @param FormInterface $form
     *
     * @return bool
     */
    public function process(FormInterface $form)
    {
        if (true === $this->request->isMethod('POST')) {
            $form->submit($this->request);
            if ($form->isValid()) {
                /** @var Text $text */
                $text = $form->getData();

                $om = $this->doctrine->getManager();
                if (false === $om->contains($text)) {
                    $om->persist($text);
                }

                return true;
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
