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
use Symfony\Component\Form\Test\FormInterface;
use Tadcka\TextBundle\Form\Type\TextFormType;
use Tadcka\TextBundle\Model\TextInterface;
use Tadcka\TextBundle\Provider\TextProviderInterface;

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
     * @var TextProviderInterface
     */
    private $textProvider;

    /**
     * Constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param TextProviderInterface $textProvider
     */
    public function __construct(FormFactoryInterface $formFactory, TextProviderInterface $textProvider)
    {
        $this->formFactory = $formFactory;
        $this->textProvider = $textProvider;
    }

    /**
     * Create.
     *
     * @param string $action
     * @param null|TextInterface $data
     *
     * @return FormInterface
     */
    public function create($action, $data = null)
    {
        if (null === $data) {
            $data = $this->textProvider->createText();
        }

        $form = $this->formFactory->create(
            new TextFormType(),
            $data,
            array(
                'method' => 'POST',
                'action' => $action,
                'data_class' => $this->textProvider->getTextClass(),
                'text_translation_class' => $this->textProvider->getTextTranslationClass(),
            )
        );

        return $form;
    }
}
