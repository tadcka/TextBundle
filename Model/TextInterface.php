<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\TextBundle\Model;

use Tadcka\TextBundle\Model\TextTranslationInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 13.12.5 00.17
 */
interface TextInterface
{
    /**
     * Get id.
     *
     * @return int
     */
    public function getId();

    /**
     * Set slug.
     *
     * @param string $slug
     *
     * @return TextInterface
     */
    public function setSlug($slug);

    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get createAt.
     *
     * @return \DateTime
     */
    public function getCreateAt();

    /**
     * Set updateAt.
     *
     * @param \DateTime|null $updateAt
     *
     * @return TextInterface
     */
    public function setUpdateAt(\DateTime $updateAt = null);

    /**
     * Get updateAt.
     *
     * @return \DateTime
     */
    public function getUpdateAt();

    /**
     * Add translations.
     *
     * @param TextTranslationInterface $translation
     */
    public function addTranslation(TextTranslationInterface $translation);

    /**
     * Remove translations.
     *
     * @param TextTranslationInterface $translation
     */
    public function removeTranslation(TextTranslationInterface $translation);

    /**
     * Get translations.
     *
     * @return array
     */
    public function getTranslations();

    /**
     * Set translations.
     *
     * @param array $translations
     *
     * @return TextInterface
     */
    public function setTranslations(array $translations);
}
