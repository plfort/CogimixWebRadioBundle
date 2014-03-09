<?php
namespace Cogipix\CogimixWebRadioBundle\Services;
use Cogipix\CogimixCommonBundle\Entity\TrackResult;

use Cogipix\CogimixCommonBundle\ResultBuilder\ResultBuilderInterface;
use Cogipix\CogimixWebRadioBundle\Entity\WebRadioTrack;
class ResultBuilder implements ResultBuilderInterface
{

    private $basePathThumbnails = 'http://images.gs-cdn.net/static/albums/90_';
    /**
     *
     * @param WebRadio $webRadio
     * @return Ambigous <NULL, \Cogipix\CogimixWebRadioBundle\Entity\WebRadioTrack>
     */
    public function createFromWebRadio($webRadio)
    {
        $item =null;
        if(!empty($webRadio)){
            $item = new WebRadioTrack();
            $item->setEntryId($webRadio->getId());
            $item->setArtist('Web Radio');
            $item->setTitle($webRadio->getName());
            $item->setPath($webRadio->getUrl());
            $item->setThumbnails($this->getDefaultIcon());
            $item->setTag($this->getResultTag());
            $item->setIcon($this->getDefaultIcon());

        }
        return $item;
    }

    public function createArrayFromWebRadios($webRadios)
    {
        $tracks =array();
        if(!empty($webRadios)){
            foreach($webRadios as $webRadio){
                $item = $this->createFromWebRadio($webRadio);
                if($item !==null){
                    $tracks[]=$item;
                }
            }
        }
        return $tracks;
    }


    public function getResultTag(){
        return 'webradio';
    }

    public function getDefaultIcon(){
        return '/bundles/cogimixwebradio/images/webradio_92.png';
    }

}
