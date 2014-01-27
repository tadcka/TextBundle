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

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 13.12.17 01.30
 */
interface TextProviderInterface
{
    /**
     * Find text by id.
     *
     * @param int $id
     *
     * @return null|TextInterface
     */
    public function findText($id);

    /**
     * Create text.
     *
     * @return TextInterface
     */
    public function createText();

    /**
     * Save text.
     *
     * @param TextInterface $text
     */
    public function saveText(TextInterface $text);

    /**
     * Delete text.
     *
     * @param TextInterface $text
     */
    public function deleteText(TextInterface $text);

    /**
     * Get text class.
     *
     * @return string
     */
    public function getTextClass();

    /**
     * Get text translation class.
     *
     * @return string
     */
    public function getTextTranslationClass();

    /**
     * Get text by locale.
     *
     * @param string $key
     * @param string $locale
     *
     * @return null|TextInterface
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
}