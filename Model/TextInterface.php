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
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set updatedAt.
     *
     * @param \DateTime|null $updatedAt
     *
     * @return TextInterface
     */
    public function setUpdatedAt(\DateTime $updatedAt = null);

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

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
     * @return array|TextTranslationInterface[]
     */
    public function getTranslations();

    /**
     * Set translations.
     *
     * @param array|TextTranslationInterface[] $translations
     *
     * @return TextInterface
     */
    public function setTranslations(array $translations);

    /**
     * Get translation.
     *
     * @param string $locale
     *
     * @return TextTranslationInterface
     */
    public function getTranslation($locale);
}
