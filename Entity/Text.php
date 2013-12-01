<?php

/*
 * Tadas Gliaubicas <tadcka89@gmail.com>, Github Tadcka.
 * 13.11.29 15.57
 */

namespace Tadcka\TextBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tadcka_texts")
 */
class Text
{
    /**
     * @var int $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $slug
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false)
     */
    private $slug;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection|TextTranslation[]
     *
     * @ORM\OneToMany(targetEntity="TextTranslation", mappedBy="entity", cascade={"persist", "remove"})
     */
    private $translations;

    /**
     * @var \DateTime $createAt
     *
     * @ORM\Column(name="create_at", type="datetime", nullable=false)
     */
    private $createAt;

    /**
     * @var \DateTime $updateAt
     *
     * @ORM\Column(name="update_at", type="datetime", nullable=false)
     */
    private $updateAt;


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
     * @param \Tadcka\TextBundle\Entity\TextTranslation $translations
     *
     * @return Text
     */
    public function addTranslation(\Tadcka\TextBundle\Entity\TextTranslation $translations)
    {
        $this->translations[] = $translations;

        return $this;
    }

    /**
     * Remove translations
     *
     * @param \Tadcka\TextBundle\Entity\TextTranslation $translations
     */
    public function removeTranslation(\Tadcka\TextBundle\Entity\TextTranslation $translations)
    {
        $this->translations->removeElement($translations);
    }

    /**
     * Get translations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTranslations()
    {
        return $this->translations;
    }
}
