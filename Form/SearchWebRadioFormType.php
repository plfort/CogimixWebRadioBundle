<?php
namespace Cogipix\CogimixWebRadioBundle\Form;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class SearchWebRadioFormType extends AbstractType {



    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name', null);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'Cogipix\CogimixWebRadioBundle\Entity\WebRadio',
                'validation_groups' => array('Search'),
                'intention'=>'search_webradio',
                ));
    }

    public function getName() {
        return 'search_webradio_query_form';
    }



}
