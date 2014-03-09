<?php
namespace Cogipix\CogimixWebRadioBundle\ViewHooks\Modal;

use Cogipix\CogimixCommonBundle\ViewHooks\Modal\ModalItemInterface;
/**
 *
 * @author plfort - Cogipix
 *
 */
class ModalRenderer implements ModalItemInterface
{

    public function getModalTemplate()
    {
        return 'CogimixWebRadioBundle:Modal:modals.html.twig';

    }

}
