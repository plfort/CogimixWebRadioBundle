<?php
namespace Cogipix\CogimixWebRadioBundle\Entity;

use Cogipix\CogimixCommonBundle\Entity\Song;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSSerializer;
/**
 *
 * @JMSSerializer\AccessType("public_method")
 *
 * @author plfort - Cogipix
 *
 */
class WebRadioTrack extends Song
{
    protected $shareable = true;
    
    protected $duration = -1;
    

    public function setPath($path){
        $this->pluginProperties['url']=$path;
        
    }


    public function setConfirmed($confirmed){

        $this->pluginProperties['confirmed']=$confirmed;
    }
}
