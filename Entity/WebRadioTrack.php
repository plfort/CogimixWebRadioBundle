<?php
namespace Cogipix\CogimixWebRadioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cogipix\CogimixCommonBundle\Entity\TrackResult;
use JMS\Serializer\Annotation as JMSSerializer;
/**
 *
 * @JMSSerializer\AccessType("public_method")
 *
 * @author plfort - Cogipix
 *
 */
class WebRadioTrack extends TrackResult
{
    protected $shareable = true;
    
    protected $duration = -1;

    public function setPath($path){
        $this->pluginProperties['url']=$path;
    }


}
