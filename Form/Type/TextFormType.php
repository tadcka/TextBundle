<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\TextBundle\Form\Type;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 13.12.1 13.41
 */
class TextFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('slug', 'text', array(
            'label' => 'unique_key',
            'constraints' => array(new NotBlank()),
            'required' => false,
        ));

        $builder->add('translations', 'translations', array(
            'type' => new TextTranslationFormType($options['text_translation_class']),
            'label' => false,
        ));

        $builder->add('submit', 'submit', array(
            'label' => 'button.save'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'translation_domain' => 'TadckaTextBundle',
                'constraints' => array(new UniqueEntity(array('fields' => array('slug'), 'errorPath' => 'slug'))),
                'text_translation_class' => null,
            )
        );
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'text';
    }
}
