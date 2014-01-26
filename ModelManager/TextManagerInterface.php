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

use Tadcka\TextBundle\Model\TextInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 13.12.17 00.43
 */
interface TextManagerInterface
{
    /**
     * Get text by locale.
     *
     * @param string $slug
     * @param string $locale
     *
     * @return null|array
     */
    public function getText($slug, $locale);

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
    public function getAllTextCount($locale);

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
     * @param bool $flush
     */
    public function saveText(TextInterface $text, $flush = false);

    /**
     * Delete text.
     *
     * @param TextInterface $text
     * @param bool $flush
     */
    public function deleteText(TextInterface $text, $flush = false);

    /**
     * Save.
     */
    public function save();

    /**
     * Get class text model.
     *
     * @return string
     */
    public function getClass();
}
