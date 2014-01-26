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
     * Create text translation.
     *
     * @return TextTranslationInterface
     */
    public function createTextTranslation();

    /**
     * Save text translation.
     *
     * @param TextTranslationInterface $textTranslation
     * @param bool $flush
     */
    public function saveTextTranslation(TextTranslationInterface $textTranslation, $flush = false);

    /**
     * Delete text translation.
     *
     * @param TextTranslationInterface $textTranslation
     * @param bool $flush
     */
    public function deleteTextTranslation(TextTranslationInterface $textTranslation, $flush = false);

    /**
     * Save.
     */
    public function save();

    /**
     * Get class text translation model.
     *
     * @return string
     */
    public function getClass();
}
