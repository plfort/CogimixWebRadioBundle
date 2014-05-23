<?php

namespace Cogipix\CogimixWebRadioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Cogipix\CogimixWebRadioBundle\Form\SearchWebRadioFormType;
use Cogipix\CogimixWebRadioBundle\Entity\WebRadio;
use Symfony\Component\HttpFoundation\Request;
use Cogipix\CogimixCommonBundle\Utils\AjaxResult;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
/**
 * @Route("/webradio")
 * @author plfort - Cogipix
 *
 */
class DefaultController extends Controller
{

    /**
     *  @Route("/index", name="_webradio_index")
     *  @Template
     */
    public function indexAction(){
        //$response = new AjaxResult();
        $form = $this->getWebRadioForm();
        //$response->setSuccess(true);
        $webRadios = $this->getDoctrine()->getRepository("CogimixWebRadioBundle:WebRadio")->searchByName("%");
        $webRadioTracks = $this->get('webradio_music.result_builder')->createArrayFromWebRadios($webRadios);
        //$response->addData("webRadios", $webRadioTracks);
        //$response->setHtml();
        return $this->render('CogimixWebRadioBundle:Default:index.html.twig', array('form'=>$form->createView()));
    }

    /**
     *  @Route("/search", name="_webradio_search",options={"expose"=true})
     */
    public function searchAction(Request $request){
        $response = new AjaxResult();
        $form = $this->getWebRadioForm();
        if($request->getMethod()=='POST'){
            $form->handleRequest($request);
            if($form->isValid()){
                $webRadio = $form->getData();

                $webRadios = $this->getDoctrine()->getRepository("CogimixWebRadioBundle:WebRadio")->searchByName($webRadio->getName());
                $webRadioTracks = $this->get('webradio_music.result_builder')->createArrayFromWebRadios($webRadios);
                $response->addData("webRadios", $webRadioTracks);
                $response->setSuccess(true);
            }
        }
        $response->setHtml($this->renderView('CogimixWebRadioBundle:Default:index.html.twig', array('form'=>$form->createView())));
        return $response->createResponse($this->get('jms_serializer'));
    }

    /**
     *  @Route("/popular", name="_webradio_popular",options={"expose"=true})
     *  
     *  @Cache(expires="tomorrow", public=true)
     *
     */
    public function popularWebRadiosAction(Request $request){
        $response = new AjaxResult();
        $webRadios = $this->getDoctrine()->getRepository("CogimixWebRadioBundle:WebRadio")->searchByName(null,100);
        $webRadioTracks = $this->get('webradio_music.result_builder')->createArrayFromWebRadios($webRadios);
        $response->addData("webRadios", $webRadioTracks);
        $response->setSuccess(true);
        return $response->createResponse($this->get('jms_serializer'));
    }

    /**
     * @Route("/inc/{id}", name="_webradio_increase_play",options={"expose"=true})
     * @param Request $request
     * @param integer $id
     * @param string $url
     */
    public function confirmWebRadioAction(Request $request, $id){
        if($request->isXmlHttpRequest()){
            $url = $request->request->get('url',null);
            if(!empty($url)){
                //TODO : faire les 2 en même temps
                $this->get('webradio_music.webradio_manager')->confirmAndIncreasePlayCount($id,$url);

            }

        }
        return new Response();
    }



    private function getWebRadioForm(){
        $webradio = new WebRadio();
        $form = $this->createForm(new SearchWebRadioFormType(),$webradio);
        return $form;
    }

}
