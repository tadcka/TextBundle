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

use Tadcka\TextBundle\ModelManager\TextTranslationManagerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 13.12.17 01.29
 */
class Provider implements ProviderInterface
{
    /**
     * @var TextTranslationManagerInterface
     */
    private $textTranslationManager;

    /**
     * Constructor.
     *
     * @param TextTranslationManagerInterface $textTranslationManager
     */
    public function __construct(TextTranslationManagerInterface $textTranslationManager)
    {
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
}
