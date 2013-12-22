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
use Tadcka\TextBundle\Form\Type\TextFormType;
use Tadcka\TextBundle\Model\TextInterface;

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
     * @var string
     */
    private $textClass;

    /**
     * @var string
     */
    private $textTranslationClass;

    /**
     * Constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param string               $textClass
     * @param string               $textTranslationClass
     */
    public function __construct(FormFactoryInterface $formFactory, $textClass, $textTranslationClass)
    {
        $this->formFactory = $formFactory;
        $this->textClass = $textClass;
        $this->textTranslationClass = $textTranslationClass;
    }

    /**
     * Create.
     *
     * @param string $action
     * @param null|TextInterface $data
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function create($action, $data = null)
    {
        return $this->formFactory->create(
            new TextFormType(),
            $data,
            array(
                'method' => 'POST',
                'action' => $action,
                'data_class' => $this->textClass,
                'text_translation_class' => $this->textTranslationClass,
            )
        );
    }
}
