<?php
namespace Cogipix\CogimixWebRadioBundle\ViewHooks\DotTemplate;

use Cogipix\CogimixCommonBundle\ViewHooks\DotTemplate\DotTemplateInterface;

class DotTemplateRenderer implements DotTemplateInterface
{

 public function getDotTemplateTemplate() {
        return 'CogimixWebRadioBundle::dotTemplates.html.twig';

 }

}