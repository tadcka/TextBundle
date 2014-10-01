<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\TextBundle\Provider;

use Tadcka\TextBundle\ModelManager\TextManagerInterface;
use Tadcka\TextBundle\TextInformation;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since  13.12.17 01.29
 */
class Provider implements ProviderInterface
{
    /**
     * @var TextManagerInterface
     */
    private $textManager;

    /**
     * Constructor.
     *
     * @param TextManagerInterface $textManager
     */
    public function __construct(TextManagerInterface $textManager)
    {
        $this->textManager = $textManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getText($slug, $locale)
    {
        $text = $this->textManager->findTextBySlugAndLocale($slug, $locale);

        if (null !== $text) {
            $translation = $text->getTranslation($locale);
            if (null !== $translation) {

                return new TextInformation($translation->getTitle(), $translation->getContent());
            }
        }

        return null;
    }
}
