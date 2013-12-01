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

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 13.12.1 13.41
 */
class TextFormHandler
{
    private $request;

    private $doctrine;

    public function __construct(Request $request, RegistryInterface $doctrine)
    {
        $this->request = $request;
        $this->doctrine = $doctrine;
    }

    public function process(FormInterface $form)
    {
        if (true === $this->request->isMethod('POST')) {
            $form->submit($form);
            if ($form->isValid()) {


                return true;
            }
        }

        return false;
    }

    public function onSuccess()
    {

    }
}
