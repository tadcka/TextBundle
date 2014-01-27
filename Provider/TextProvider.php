<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\TextBundle\Provider;

use Tadcka\TextBundle\Model\TextInterface;
use Tadcka\TextBundle\ModelManager\TextManagerInterface;
use Tadcka\TextBundle\ModelManager\TextTranslationManagerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since  13.12.17 01.29
 */
class TextProvider implements TextProviderInterface
{
    /**
     * @var TextTranslationManagerInterface
     */
    private $textTranslationManager;

    /**
     * @var TextManagerInterface
     */
    private $textManager;

    /**
     * Constructor.
     *
     * @param TextManagerInterface $textManager
     * @param TextTranslationManagerInterface $textTranslationManager
     */
    public function __construct(TextManagerInterface $textManager, TextTranslationManagerInterface $textTranslationManager)
    {
        $this->textManager = $textManager;
        $this->textTranslationManager = $textTranslationManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getTexts($locale, $offset = null, $limit = null)
    {
        return $this->textManager->getTexts($locale, $offset, $limit);
    }

    /**
     * {@inheritdoc}
     */
    public function getCount($locale)
    {
        return $this->textManager->getAllTextCount($locale);
    }

    /**
     * {@inheritdoc}
     */
    public function getText($slug, $locale)
    {
        return $this->textManager->getText($slug, $locale);
    }

    /**
     * {@inheritdoc}
     */
    public function findText($id)
    {
        return $this->textManager->findText($id);
    }

    /**
     * {@inheritdoc}
     */
    public function saveText(TextInterface $text)
    {
        $this->textManager->saveText($text, true);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteText(TextInterface $text)
    {
        $this->textManager->deleteText($text, true);
    }

    /**
     * {@inheritdoc}
     */
    public function createText()
    {
        return $this->textManager->createText();
    }

    /**
     * {@inheritdoc}
     */
    public function getTextClass()
    {
        return $this->textManager->getClass();
    }

    /**
     * {@inheritdoc}
     */
    public function getTextTranslationClass()
    {
        return $this->textTranslationManager->getClass();
    }
}
