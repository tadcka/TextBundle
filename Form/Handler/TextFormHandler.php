<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\TextBundle\Form\Handler;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Tadcka\TextBundle\Message\FlashMessageInterface;
use Tadcka\TextBundle\Model\TextInterface;
use Tadcka\TextBundle\ModelManager\TextManagerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 13.12.1 13.41
 */
class TextFormHandler
{
    /**
     * @var TextManagerInterface
     */
    private $textManager;

    /**
     * @var FlashMessageInterface
     */
    private $flashMessage;

    /**
     * Constructor.
     *
     * @param TextManagerInterface $textManager
     * @param FlashMessageInterface $flashMessage
     */
    public function __construct(TextManagerInterface $textManager, FlashMessageInterface $flashMessage)
    {
        $this->textManager = $textManager;
        $this->flashMessage = $flashMessage;
    }

    /**
     * Process text.
     *
     * @param Request $request
     * @param FormInterface $form
     *
     * @return bool
     */
    public function process(Request $request, FormInterface $form)
    {
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                /** @var TextInterface $text */
                $text = $form->getData();
                foreach ($text->getTranslations() as $translation) {
                    $translation->setText($text);
                }
                $this->textManager->add($form->getData());

                return true;
            }
        }

        return false;
    }

    /**
     * On success.
     *
     * @param string $translationId
     */
    public function onSuccess($translationId)
    {
        $this->flashMessage->onSuccess($translationId);
    }
}
