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
     * Find text by id.
     *
     * @param int $id
     *
     * @return null|TextInterface
     */
    public function find($id);

    /**
     * Find text by slug and locale.
     *
     * @param string $slug
     * @param string $locale
     *
     * @return null|TextInterface
     */
    public function findTextBySlugAndLocale($slug, $locale);

    /**
     * Find many texts by locale.
     *
     * @param string $locale
     * @param null|int $offset
     * @param null|int $limit
     *
     * @return array
     */
    public function findManyTextsByLocale($locale, $offset = null, $limit = null);

    /**
     * Get count.
     *
     * @param string $locale
     *
     * @return int
     */
    public function count($locale);

    /**
     * Create text.
     *
     * @return TextInterface
     */
    public function create();

    /**
     * Save text.
     *
     * @param TextInterface $text
     * @param bool $save
     */
    public function add(TextInterface $text, $save = false);

    /**
     * Delete text.
     *
     * @param TextInterface $text
     * @param bool $save
     */
    public function delete(TextInterface $text, $save = false);

    /**
     * Save persisted layer.
     */
    public function save();

    /**
     * Clear persisted layer.
     */
    public function clear();

    /**
     * Get class text model.
     *
     * @return string
     */
    public function getClass();
}
