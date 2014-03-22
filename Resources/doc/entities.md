Entities
==========

## Text

``` php
<?php

namespace Tadcka\AcmeBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Tadcka\TextBundle\Model\Text as AbstractText;
use Tadcka\TextBundle\Model\TextTranslationInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="tadcka_texts")
 */
class Text extends AbstractText
{
    /**
     * @var TextTranslation
     *
     * @ORM\OneToMany(
     *      targetEntity="Tadcka\AcmeBundle\Entity\TextTranslation",
     *      mappedBy="text",
     *      cascade={"persist", "remove"}
     * )
     */
    protected $translations;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->translations = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function addTranslation(TextTranslationInterface $translation)
    {
        $this->translations[] = $translation;
    }

    /**
     * {@inheritdoc}
     */
    public function removeTranslation(TextTranslationInterface $translation)
    {
        $this->translations->removeElement($translation);
    }
}
```
TextTranslation

``` php
<?php

namespace Tadcka\AcmeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Tadcka\TextBundle\Model\TextTranslation as BaseTextTranslation;

/**
 * @ORM\Entity
 * @ORM\Table(
 *      name="tadcka_text_translations",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="unique_lang_idx", columns={"text_id", "lang"})}
 * )
 */
class TextTranslation extends BaseTextTranslation
{
    /**
     * @ORM\ManyToOne(targetEntity="Tadcka\AcmeBundle\Entity\Text", inversedBy="translations")
     * @ORM\JoinColumn(name="text_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    protected $text;
}
```