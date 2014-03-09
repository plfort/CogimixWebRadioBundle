<?php
namespace Cogipix\CogimixWebRadioBundle\ViewHooks\Javascript;
use Cogipix\CogimixCommonBundle\ViewHooks\Javascript\JavascriptImportInterface;

use Cogipix\CogimixCommonBundle\ViewHooks\Menu\MenuItemInterface;

/**
 *
 * @author plfort - Cogipix
 *
 */
class JavascriptImportRenderer implements JavascriptImportInterface
{

    public function getJavascriptImportTemplate()
    {
        return 'CogimixWebRadioBundle::js.html.twig';
    }

}
