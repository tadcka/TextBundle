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
 * @since 13.12.5 00.15
 */
abstract class Text implements TextInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection|TextTranslation[]
     */
    protected $translations;

    /**
     * @var \DateTime
     */
    protected $createAt;

    /**
     * @var \DateTime
     */
    protected $updateAt;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createAt = new \DateTime();
        $this->updateAt = $this->createAt;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Text
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get createAt
     *
     * @return \DateTime
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime|null $updateAt
     *
     * @return Text
     */
    public function setUpdateAt($updateAt = null)
    {
        if (null === $updateAt) {
            if ($this->updateAt instanceof \DateTime) {
                $this->updateAt->modify('now');
            } else {
                $this->updateAt = new \DateTime();
            }
        } else {
            $this->updateAt = $updateAt;
        }

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Add translations
     *
     * @param TextTranslationInterface $translations
     *
     * @return Text
     */
    public function addTranslation(TextTranslationInterface $translations)
    {
        $this->translations[] = $translations;

        return $this;
    }

    /**
     * Remove translations
     *
     * @param TextTranslationInterface $translations
     */
    public function removeTranslation(TextTranslationInterface $translations)
    {
        $this->translations->removeElement($translations);
    }

    /**
     * Get translations
     *
     * @return \Doctrine\Common\Collections\Collection|TextTranslationInterface[]
     */
    public function getTranslations()
    {
        return $this->translations;
    }
}
