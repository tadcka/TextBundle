<?php

/*
 * Tadas Gliaubicas <tadcka89@gmail.com>, Github Tadcka.
 * 13.11.29 16.36
 */

namespace Tadcka\TextBundle\Form\Handler;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

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
