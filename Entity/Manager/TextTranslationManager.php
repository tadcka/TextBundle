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

use Doctrine\ORM\NoResultException;
use Tadcka\TextBundle\ModelManager\TextTranslationManager as BaseTextTranslationManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 13.12.17 00.54
 */
class TextTranslationManager extends BaseTextTranslationManager
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
     * Get text by locale.
     *
     * @param string $key
     * @param string $locale
     *
     * @return null|array
     */
    public function getText($key, $locale)
    {
        $qb = $this->repository->createQueryBuilder('tt');

        $qb->innerJoin('tt.text', 't');

        $qb->andWhere($qb->expr()->eq('tt.lang', ':locale'))
            ->setParameter('locale', $locale);

        $qb->andWhere($qb->expr()->eq('t.slug', ':key'))
            ->setParameter('key', $key);

        $qb->select('tt.title, tt.content');

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * Get texts.
     *
     * @param string $locale
     * @param null|int $offset
     * @param null|int $limit
     *
     * @return array
     */
    public function getTexts($locale, $offset = null, $limit = null)
    {
        $qb = $this->repository->createQueryBuilder('tt');

        $qb->innerJoin('tt.text', 't');

        $qb->where($qb->expr()->eq('tt.lang', ':locale'))
            ->setParameter('locale', $locale);

        if (null !== $offset) {
            $qb->setFirstResult($offset);
        }

        if ($qb !== $limit) {
            $qb->setMaxResults($limit);
        }

        $qb->select('t.slug, tt.title, tt.content');

        return $qb->getQuery()->getResult();
    }

    /**
     * Get count.
     *
     * @param string $locale
     *
     * @return int
     */
    public function getCount($locale)
    {
        $qb = $this->repository->createQueryBuilder('tt');

        $qb->where($qb->expr()->eq('tt.lang', ':locale'))
            ->setParameter('locale', $locale);

        $qb->select('COUNT(tt.id)');

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (NoResultException $e) {
            return 0;
        } catch (\Exception $e) {
            return 0;
        }
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
