<?php

namespace Agile\TrainingBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CalandarType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'widget' => 'single_text'
        ));
    }
    public function getParent()
    {
        return 'datetime';
    }

    public function getName()
    {
        return 'calandar';
    }
}