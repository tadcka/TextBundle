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

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 13.12.5 00.17
 */
interface TextInterface
{
    /**
     * Get id
     *
     * @return int
     */
    public function getId();

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Text
     */
    public function setSlug($slug);

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get createAt
     *
     * @return \DateTime
     */
    public function getCreateAt();

    /**
     * Set updateAt
     *
     * @param \DateTime|null $updateAt
     *
     * @return Text
     */
    public function setUpdateAt($updateAt = null);

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt();

    /**
     * Add translations
     *
     * @param TextTranslationInterface $translations
     *
     * @return Text
     */
    public function addTranslation(TextTranslationInterface $translations);

    /**
     * Remove translations
     *
     * @param TextTranslationInterface $translations
     */
    public function removeTranslation(TextTranslationInterface$translations);

    /**
     * Get translations
     *
     * @return \Doctrine\Common\Collections\Collection|TextTranslationInterface[]
     */
    public function getTranslations();
}
