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

use Tadcka\TextBundle\Provider\TextProviderInterface;
use Tadcka\TextBundle\TextInformation;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.lt>
 *
 * @since 1/27/14 9:58 PM
 */
class TextManager 
{
    /**
     * @var TextProviderInterface
     */
    private $textProvider;

    /**
     * Constructor.
     *
     * @param TextProviderInterface $textProvider
     */
    public function __construct(TextProviderInterface $textProvider)
    {
        $this->textProvider = $textProvider;
    }

    /**
     * Get text.
     *
     * @param string $slug
     * @param string $locale
     *
     * @return null|TextInformation
     */
    public function getText($slug, $locale)
    {
        $text = $this->textProvider->getText($slug, $locale);

        if (null !== $text) {
            $translation = $text->getTranslation($locale);
            if (null !== $translation) {

                return new TextInformation($translation->getTitle(), $translation->getContent());
            }
        }

        return null;
    }
}
 