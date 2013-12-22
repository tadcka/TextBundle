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

use Tadcka\TextBundle\Model\TextTranslationInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 13.12.17 00.43
 */
abstract class TextTranslationManager implements TextTranslationManagerInterface
{
    /**
     * Create text translation.
     *
     * @return TextTranslationInterface
     */
    public function createTextTranslation()
    {
        $class = $this->getClass();
        $textTranslation = new $class;

        return $textTranslation;
    }
}
