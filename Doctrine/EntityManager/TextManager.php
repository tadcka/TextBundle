<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\TextBundle\Doctrine\EntityManager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Tadcka\TextBundle\Model\TextInterface;
use Tadcka\TextBundle\ModelManager\TextManager as BaseTextManager;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/26/14 4:44 PM
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
     * {@inheritdoc}
     */
    public function getText($slug, $locale)
    {
        $qb = $this->repository->createQueryBuilder('text');

        $qb->innerJoin('text.translations', 'translation', Join::WITH, $qb->expr()->eq('translation.lang', ':locale'))
            ->setParameter('locale', $locale);

        $qb->andWhere($qb->expr()->eq('text.slug', 'slug'))
            ->setParameter('slug', $slug);

        $qb->select('text, translation');

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function getTexts($locale, $offset = null, $limit = null)
    {
        $qb = $this->repository->createQueryBuilder('text');

        $qb->innerJoin('text.translations', 'translation', Join::WITH, $qb->expr()->eq('translation.lang', ':locale'))
            ->setParameter('locale', $locale);

        if (null !== $offset) {
            $qb->setFirstResult($offset);
        }

        if (null !== $limit) {
            $qb->setMaxResults($offset);
        }

        $qb->select('text, translation');

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function getAllTextCount($locale)
    {
        $qb = $this->repository->createQueryBuilder('text');

        $qb->innerJoin('text.translations', 'translation', Join::WITH, $qb->expr()->eq('translation.lang', ':locale'))
            ->setParameter('locale', $locale);

        $qb->select('COUNT(text)');

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * {@inheritdoc}
     */
    public function saveText(TextInterface $text, $flush = false)
    {
        $this->em->persist($text);

        if (true === $flush) {
            $this->em->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function deleteText(TextInterface $text, $flush = false)
    {
        $this->em->remove($text);

        if (true === $flush) {
            $this->em->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function save()
    {
        $this->em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return $this->class;
    }
}
