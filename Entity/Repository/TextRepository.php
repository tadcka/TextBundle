<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\TextBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 13.12.1 18.03
 */
class TextRepository extends EntityRepository
{
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
        $query = $this->_em->createQueryBuilder()
            ->from('TadckaTextBundle:TextTranslation', 'tt')
            ->innerJoin('tt.entity', 't')
            ->andWhere('tt.lang = :locale')
            ->setParameter('locale', $locale)
            ->andWhere('t.slug = :key')
            ->setParameter('key', $key)
            ->select('tt.title, tt.content');

        return $query->getQuery()->getOneOrNullResult();
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
        $query = $this->_em->createQueryBuilder()
            ->from('TadckaTextBundle:TextTranslation', 'tt')
            ->innerJoin('tt.entity', 't')
            ->andWhere('tt.lang = :locale')
            ->setParameter('locale', $locale);

        if (null !== $offset) {
            $query->setFirstResult($offset);
        }

        if (null !== $limit) {
            $query->setMaxResults($limit);
        }

        $query->select('t.slug, tt.title, tt.content');

        return $query->getQuery()->getResult();
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
        $query = $this->_em->createQueryBuilder()
            ->from('TadckaTextBundle:TextTranslation', 'tt')
            ->andWhere('tt.lang = :locale')
            ->setParameter('locale', $locale)
            ->select('COUNT(tt.id)');

        try {
            return $query->getQuery()->getSingleScalarResult();
        } catch (NoResultException $e) {
            return 0;
        } catch (\Exception $e) {
            return 0;
        }
    }
}
