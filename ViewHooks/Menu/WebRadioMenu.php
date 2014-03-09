<?php
namespace Cogipix\CogimixWebRadioBundle\ViewHooks\Menu;

use Cogipix\CogimixCommonBundle\ViewHooks\Menu\AbstractMenuItem;
/**
 * Description of WebRadioMenu
 *
 * @author pilou
 */
class WebRadioMenu extends AbstractMenuItem {

    public function getMenuItemTemplate() {
        return "CogimixWebRadioBundle:Menu:webradioMenu.html.twig";
    }

    public function getName() {
        return 'webradio';
    }


}
