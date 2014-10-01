<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\TextBundle\Model;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 13.12.5 00.20
 */
interface TextTranslationInterface
{
    /**
     * Get id.
     *
     * @return int
     */
    public function getId();

    /**
     * Set lang.
     *
     * @param string $lang
     *
     * @return TextTranslationInterface
     */
    public function setLang($lang);

    /**
     * Get lang.
     *
     * @return string
     */
    public function getLang();

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return TextTranslationInterface
     */
    public function setTitle($title);

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set content.
     *
     * @param string $content
     *
     * @return TextTranslationInterface
     */
    public function setContent($content);

    /**
     * @return string
     */
    public function getContent();

    /**
     * Set text.
     *
     * @param TextInterface $text
     *
     * @return TextTranslationInterface
     */
    public function setText(TextInterface $text);

    /**
     * Get text.
     *
     * @return TextInterface
     */
    public function getText();
}
