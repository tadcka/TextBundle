<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\TextBundle\Manager;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Tadcka\TextBundle\Entity\Text;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 13.12.1 18.34
 */
class TextAdministratorManager
{
    /**
     * @var RegistryInterface
     */
    private $doctrine;

    /**
     * Constructor.
     *
     * @param RegistryInterface $doctrine
     */
    public function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * Get text by id.
     *
     * @param int $id
     *
     * @return Text|null
     */
    public function getTextById($id)
    {
        $text = $this->doctrine->getRepository('TadckaTextBundle:Text')->find($id);

        return $text;
    }

    /**
     * Get texts.
     *
     * @param string $locale
     * @param int $offset
     * @param int $limit
     *
     * @return array
     */
    public function getTexts($locale = 'en', $offset, $limit)
    {
        return $this->doctrine->getRepository('TadckaTextBundle:Text')->getTexts($locale, $offset, $limit);
    }

    /**
     * Get count.
     *
     * @param string $locale
     *
     * @return int
     */
    public function getCount($locale = 'en')
    {
        return $this->doctrine->getRepository('TadckaTextBundle:Text')->getCount($locale);
    }
}
