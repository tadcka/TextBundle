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
 * @since 13.12.5 00.19
 */
abstract class TextTranslation implements TextTranslationInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var TextInterface
     */
    protected $text;

    /**
     * @var string
     */
    protected $lang;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $content;

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
     * @return TextTranslationInterface
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
     * Set text.
     *
     * @param \Tadcka\TextBundle\Model\TextInterface $text
     *
     * @return TextTranslationInterface
     */
    public function setText(TextInterface $text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text.
     *
     * @return \Tadcka\TextBundle\Model\TextInterface
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return TextTranslationInterface
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

    /**
     * Set content.
     *
     * @param string $content
     *
     * @return TextTranslationInterface
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
