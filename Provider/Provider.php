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
class Provider implements ProviderInterface
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
     * @param \Tadcka\TextBundle\ModelManager\TextTranslationManagerInterface $textTranslationManager
     */
    public function __construct(TextManagerInterface $textManager, TextTranslationManagerInterface $textTranslationManager)
    {
        $this->textManager = $textManager;
        $this->textTranslationManager = $textTranslationManager;
    }

    /**
     * Get texts.
     *
     * @param string $locale
     * @param null|int $offset
     * @param null|int $limit
     *
     * @return array
     */
    public function getTexts($locale, $offset = null, $limit = null)
    {
        return $this->textManager->getTexts($locale, $offset, $limit);
    }

    /**
     * Get count.
     *
     * @param string $locale
     *
     * @return int
     */
    public function getCount($locale)
    {
        return $this->textManager->getAllTextCount($locale);
    }

    /**
     * Get text by id.
     *
     * @param string $slug
     * @param string $locale
     *
     * @return null|TextInterface
     */
    public function getText($slug, $locale)
    {
        return $this->textManager->getText($slug, $locale);
    }

    /**
     * Find text by id.
     *
     * @param int $id
     *
     * @return null|TextInterface
     */
    public function findText($id)
    {
        // TODO: Implement findText() method.
    }

    /**
     * Save text.
     *
     * @param TextInterface $text
     */
    public function saveText(TextInterface $text)
    {
        $this->textManager->saveText($text, true);
    }

    /**
     * Delete text.
     *
     * @param TextInterface $text
     */
    public function deleteText(TextInterface $text)
    {
        $this->textManager->deleteText($text, true);
    }
}
