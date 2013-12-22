<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\TextBundle\Entity\Manager;

use Tadcka\TextBundle\Model\TextInterface;
use Tadcka\TextBundle\ModelManager\TextManager as BaseTextManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 13.12.22 23.24
 */
class TextManager extends BaseTextManager
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * @var string
     */
    protected $class;

    /**
     * Constructor.
     *
     * @param EntityManager     $em
     * @param string            $class
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->em         = $em;
        $this->repository = $em->getRepository($class);
        $this->class      = $em->getClassMetadata($class)->name;
    }

    /**
     * Get text by id.
     *
     * @param int $id
     *
     * @return null|TextInterface
     */
    public function getText($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Get class.
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }
}
