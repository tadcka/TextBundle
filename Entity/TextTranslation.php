<?php

/*
 * Tadas Gliaubicas <tadcka89@gmail.com>, Github Tadcka.
 * 13.11.29 15.59
 */

namespace Tadcka\TextBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tadcka_text_translations")
 */
class TextTranslation
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Text $entity
     *
     * @ORM\ManyToOne(targetEntity="Text", inversedBy="translations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="text_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $entity;

    /**
     * @var string $lang
     *
     * @ORM\Column(name="lang", type="string", length=31, nullable=false)
     */
    private $lang;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string $description
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set entity.
     *
     * @param \Tadcka\TextBundle\Entity\Text $entity
     *
     * @return TextTranslation
     */
    public function setEntity(\Tadcka\TextBundle\Entity\Text $entity)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Get entity.
     *
     * @return \Tadcka\TextBundle\Entity\Text
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set lang.
     *
     * @param string $lang
     *
     * @return TextTranslation
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang.
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return TextTranslation
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
