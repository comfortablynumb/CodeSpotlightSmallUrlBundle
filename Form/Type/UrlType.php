<?php

/**
 * Created by Gustavo Falco <comfortablynumb84@gmail.com>
 */

namespace CodeSpotlight\Bundle\SmallUrlBundle\Form\Type;

use Symfony\Component\Form\FormBuilder;

use CodeSpotlight\Bundle\ApplicationToolsBundle\Form\Type\AbstractType;

class UrlType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('url', 'text', array('error_bubbling' => true));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class'    => 'CodeSpotlight\Bundle\SmallUrlBundle\Entity\Url',
        );
    }
}
