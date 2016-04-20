<?php
namespace Cogipix\CogimixWebRadioBundle\Entity;

use Cogipix\CogimixCommonBundle\Entity\Song;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSSerializer;
/**
 *
 * @JMSSerializer\AccessType("public_method")
 * @author plfort - Cogipix
 * @ORM\Entity(repositoryClass="Cogipix\CogimixWebRadioBundle\Repository\WebRadioTrackRepository")
 *
 */
class WebRadioTrack extends Song
{
    protected $shareable = true;
    
    protected $duration = -1;

    /**
     * @ORM\Column(type="integer")
     * @var int $playCount
     */
    protected $playCount=0;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean $confirmed
     */
    protected $confirmed = false;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean $active
     */
    protected $active = true;


    public function setPath($path){
        $this->pluginProperties['url']=$path;
        
    }

    public function getPath(){
        return $this->pluginProperties['url'];

    }


    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return int
     */
    public function getPlayCount()
    {
        return $this->playCount;
    }

    /**
     * @param int $playCount
     */
    public function setPlayCount($playCount)
    {
        $this->playCount = $playCount;
    }

    /**
     * @return boolean
     */
    public function isConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * @param boolean $confirmed
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;
    }

    public function increasePlayCount(){
        $this->playCount++;
    }


}
