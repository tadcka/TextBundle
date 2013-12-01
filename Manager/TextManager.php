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
use Tadcka\TextBundle\Model\Text;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 13.12.1 13.41
 */
class TextManager
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
     * Get text by locale.
     *
     * @param string $key
     * @param string $locale
     *
     * @return Text|null
     */
    public function getText($key, $locale = 'en')
    {
        if (null !== ($text = $this->doctrine->getRepository('TadckaTextBundle:Text')->getText($key, $locale))) {
            return new Text($text['title'], $text['content']);
        }

        return null;
    }
}
