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

/**
 * @Route("/webradio")
 *
 * @author plfort - Cogipix
 *
 */
class DefaultController extends Controller
{

    /**
     * @Route("/search", name="_webradio_search",options={"expose"=true})
     */
    public function searchAction(Request $request)
    {
        $response = new AjaxResult();
        $form = $this->getWebRadioForm($request);
        $serializer = $this->get('jms_serializer');
        $webRadioTracks = array();
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
        }
        if ($request->isMethod('GET')) {


            $form->submit($this->mapQueryForSubmitSearch($request));
        }

        if ($form->isValid()) {
            $webRadio = $form->getData();

            $webRadios = $this->getDoctrine()
                ->getRepository("CogimixWebRadioBundle:WebRadio")
                ->searchByName($webRadio->getName());
            $webRadioTracks = $this->get('webradio_music.result_builder')->createArrayFromWebRadios($webRadios);

            $response->setSuccess(true);
        }
        if ($request->isXmlHttpRequest()) {
            $response->addData("webRadios", $webRadioTracks);
            return $response->createResponse($serializer);
        } else {
            $viewParam = array();
            $viewParam['currentMenu'] = "webradios";
            $viewParam['currentPanel'] = "webradios";
            $viewParam['formWebradio'] = $form->createView();
            $viewParam['webradios'] = $serializer->serialize($webRadioTracks, 'json');
            return $this->render('CogimixWebRadioBundle:Default:search.html.twig', $viewParam);
        }
        // $response->setHtml($this->renderView('CogimixWebRadioBundle:Default:index.html.twig');
    }

    /**
     * @Route("/popular", name="_webradio_popular",options={"expose"=true})
     */
    public function popularWebRadiosAction(Request $request)
    {
        $webRadios = $this->getDoctrine()
            ->getRepository("CogimixWebRadioBundle:WebRadio")
            ->searchByName(null);
        $webRadioTracks = $this->get('webradio_music.result_builder')->createArrayFromWebRadios($webRadios);

        $serializer = $this->get('jms_serializer');
        if ($request->isXmlHttpRequest()) {
            $response = new AjaxResult();
            $response->addData("webRadios", $webRadioTracks);
            $response->setSuccess(true);
            return $response->createResponse($serializer);
        } else {
            $viewParam = array();
            $viewParam['currentMenu'] = "webradios";
            $viewParam['currentPanel'] = "webradios";
            $viewParam['webradios'] = $serializer->serialize($webRadioTracks, 'json');
            return $this->render('CogimixWebRadioBundle:Default:popular.html.twig', $viewParam);
        }
    }

    /**
     * @Route("/inc/{id}", name="_webradio_increase_play",options={"expose"=true})
     *
     * @param Request $request
     * @param integer $id
     * @param string $url
     */
    public function confirmWebRadioAction(Request $request, $id)
    {
        if ($request->isXmlHttpRequest()) {
            $url = $request->request->get('url', null);
            if (! empty($url)) {
                // TODO : faire les 2 en même temps
                $this->get('webradio_music.webradio_manager')->confirmAndIncreasePlayCount($id, $url);
            }
        }
        return new Response();
    }

    /**
     * @Template("CogimixWebRadioBundle:SearchForm:searchForm.html.twig")
     */
    public function renderWebRadioSearchFormAction(Request $request)
    {
        $form = $this->getWebRadioForm($request);

        return array(
            'formWebradio' => $form->createView()
        );
    }

    private function mapQueryForSubmitSearch(Request $request)
    {
            $formData = array();
            $formData['name']=$request->query->get('q',null);
            return $formData;
    }

    private function getWebRadioForm($request)
    {
        $webradio = new WebRadio();
        if($request != null){
            $query = $request->query->get('q', null);
            if ($query != null) {
                $webradio->setName($query);
            }
        }

        $form = $this->createForm(new SearchWebRadioFormType(), $webradio);

        return $form;
    }
}
