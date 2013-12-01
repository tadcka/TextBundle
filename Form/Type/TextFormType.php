<?php

/*
 * Tadas Gliaubicas <tadcka89@gmail.com>, Github Tadcka.
 * 13.11.29 16.23
 */

namespace Tadcka\TextBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Tadcka\TextBundle\Entity\TextTranslation;

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
        ));

        $builder->add('translations', 'translations', array(
            'type' => new TextTranslation(),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Tadcka\TextBundle\Entity\Text',
                'translation_domain' => 'TadckaTextBundle',
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
