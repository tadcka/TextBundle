<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\TextBundle\ModelManager;

use Tadcka\TextBundle\Model\TextInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 13.12.22 23.23
 */
abstract class TextManager implements TextManagerInterface
{
    /**
     * Create text.
     *
     * @return TextInterface
     */
    public function createText()
    {
        $class = $this->getClass();
        $text = new $class;

        return $text;
    }
}
