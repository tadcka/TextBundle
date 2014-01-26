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
     * @var array
     */
    protected $translations = array();

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
        $this->createAt = new \DateTime();
        $this->updateAt = $this->createAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdateAt(\Datetime $updateAt = null)
    {
        if (null === $updateAt) {
            $this->updateAt = new \DateTime();
        } else {
            $this->updateAt = $updateAt;
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }
}
