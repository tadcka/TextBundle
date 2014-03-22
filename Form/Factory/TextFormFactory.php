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
use Symfony\Component\Routing\RouterInterface;
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
     * @var RouterInterface
     */
    private $router;

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
     * @param RouterInterface $router
     * @param string $textClass
     * @param string $textTranslationClass
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        $textClass,
        $textTranslationClass
    ) {
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->textClass = $textClass;
        $this->textTranslationClass = $textTranslationClass;
    }

    /**
     * Create text form.
     *
     * @param TextInterface $text
     *
     * @return FormInterface
     */
    public function create(TextInterface $text)
    {

        return $this->formFactory->create(
            new TextFormType(),
            $text,
            array(
                'method' => 'POST',
                'action' => $this->router->getContext()->getPathInfo(),
                'data_class' => $this->textClass,
                'text_translation_class' => $this->textTranslationClass,
            )
        );
    }
}
