<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\TextBundle\ModelManager;

use Tadcka\TextBundle\Model\TextTranslationInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 13.12.17 00.56
 */
interface TextTranslationManagerInterface
{
    /**
     * Get text by locale.
     *
     * @param string $key
     * @param string $locale
     *
     * @return null|array
     */
    public function getText($key, $locale);

    /**
     * Get texts.
     *
     * @param string $locale
     * @param null|int $offset
     * @param null|int $limit
     *
     * @return array
     */
    public function getTexts($locale, $offset = null, $limit = null);

    /**
     * Get count.
     *
     * @param string $locale
     *
     * @return int
     */
    public function getCount($locale);

    /**
     * Create text.
     *
     * @return TextTranslationInterface
     */
    public function createText();

    /**
     * Get class.
     *
     * @return string
     */
    public function getClass();
}
