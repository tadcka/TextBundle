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
     * Get text by locale.
     *
     * @param string $key
     * @param string $locale
     *
     * @return null|array
     */
    public function getText($key, $locale)
    {
        return $this->textTranslationManager->getText($key, $locale);
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
        return $this->textTranslationManager->getTexts($locale, $offset, $limit);
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
        return $this->textTranslationManager->getCount($locale);
    }

    /**
     * Get text by id.
     *
     * @param int $id
     *
     * @return null|TextInterface
     */
    public function getTextById($id)
    {
        return $this->textManager->getText($id);
    }
}
