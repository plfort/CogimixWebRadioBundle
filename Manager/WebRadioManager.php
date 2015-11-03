<?php
namespace Cogipix\CogimixWebRadioBundle\Manager;

use Cogipix\CogimixCommonBundle\Manager\AbstractManager;
use Cogipix\CogimixWebRadioBundle\Entity\WebRadio;
use Doctrine\DBAL\LockMode;
class WebRadioManager extends AbstractManager
{

    /**
     *
     * @param WebRadio $webRadio
     * @param string $url
     */
    public function confirmAndIncreasePlayCount($webRadioId,$url){
        $this->em->beginTransaction();
        try{
            $webRadio = $this->em->find("CogimixWebRadioBundle:WebRadioTrack", $webRadioId,LockMode::PESSIMISTIC_READ);
            if($webRadio){
                if($webRadio->isConfirmed() == false ){
                    if($webRadio->getUrl() != $url){
                        $webRadio->setUrl($url);
                    }

                    $webRadio->setConfirmed(true);

                }
                $webRadio->increasePlayCount();
                $this->em->flush();
                $this->em->commit();
            }
        }catch(\Exception $ex){
            $this->em->rollback();
        }


    }

    public function increasePlayCountById($webRadioId){
        $webRadio = $this->em->find("CogimiwWebRadioBundle:WebRadioTrack", $webRadioId,LockMode::PESSIMISTIC_READ);
        if($webRadio){
            $webRadio->increasePlayCount();
            $this->em->flush();
        }
    }

}