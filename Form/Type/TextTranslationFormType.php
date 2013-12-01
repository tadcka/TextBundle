<?php
/*
 * Tadas Gliaubicas <tadcka89@gmail.com>, Github Tadcka.
 * 13.11.29 16.24
 */

namespace Tadcka\TextBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class TextTranslationFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', array(
            'label' => 'title',
            'constraints' => array(new NotBlank()),
        ));

        $builder->add('content', 'ckeditor', array(
            'label' => 'content',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Tadcka\TextBundle\Entity\TextTranslation',
                'translation_domain' => 'TadckaTextBundle',
                'label' => false,
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
        return 'text_translation';
    }
}