<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\TextBundle\Form\Factory;
use Symfony\Component\Form\FormFactoryInterface;
use Tadcka\TextBundle\Entity\Text;
use Tadcka\TextBundle\Form\Type\TextFormType;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 13.12.1 19.01
 */
class TextFormFactory
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * Constructor.
     *
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    /**
     * Create.
     *
     * @param Text $data
     * @param $action
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function create($data, $action)
    {
        return $this->formFactory->create(new TextFormType(), $data, array('method' => 'POST', 'action' => $action));
    }
}
