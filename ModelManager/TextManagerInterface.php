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
 * @since 13.12.17 00.43
 */
interface TextManagerInterface
{
    /**
     * Get text by id.
     *
     * @param int $id
     *
     * @return null|TextInterface
     */
    public function getText($id);

    /**
     * Create text.
     *
     * @return TextInterface
     */
    public function createText();

    /**
     * Get class.
     *
     * @return string
     */
    public function getClass();
}
