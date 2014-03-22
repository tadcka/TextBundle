<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\TextBundle\Provider;

use Tadcka\TextBundle\TextInformation;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 13.12.17 01.30
 */
interface ProviderInterface
{
    /**
     * Get text.
     *
     * @param string $slug
     * @param string $locale
     *
     * @return null|TextInformation
     */
    public function getText($slug, $locale);
}
