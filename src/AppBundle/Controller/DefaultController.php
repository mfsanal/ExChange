<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Rate;
use AppBundle\Utils\Finder;
use AppBundle\Utils\RemoteDataCommand;
use AppBundle\Utils\SourceARates;
use AppBundle\Utils\SourceBRates;
use AppBundle\Utils\SourceCRates;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $RateList = $entityManager->getRepository('AppBundle\Entity\Rate')->findAll();

        $Finder = new Finder();
        $Finder->addData($RateList);
        $Finder->exec();

        return $this->render('default/index.html.twig',array("RateMin"=>$Finder->getMin()));
    }



    /**
     * @Route("/load", name="Loadpage")
     */
    public function LoadAction()
    {
        $_list = array();

        $SourceA_raw = RemoteDataCommand::Run('http://www.mocky.io/v2/5a74519d2d0000430bfe0fa0');
        $SourceB_raw = RemoteDataCommand::Run('http://www.mocky.io/v2/5a74524e2d0000430bfe0fa3');
        $SourceC_raw = RemoteDataCommand::Run('http://www.mocky.io/v2/5b5dc82a32000010001cfa66');

        $SourceA = new SourceARates();
        $SourceA->inputData($SourceA_raw);
        $exportA = $SourceA->outputData();

        $SourceB = new SourceBRates();
        $SourceB->inputData($SourceB_raw);
        $exportB = $SourceB->outputData();

        $SourceC = new SourceCRates();
        $SourceC->inputData($SourceC_raw);
        $exportC = $SourceC->outputData();

        foreach ($exportA as $item){array_push($_list,$item);}
        foreach ($exportB as $item){array_push($_list,$item);}
        foreach ($exportC as $item){array_push($_list,$item);}

        foreach ($_list as $data){
            $EntityRate = new Rate();
            $EntityRate->setRate($data->getType());
            $EntityRate->setValue($data->getValue());
            $EntityRate->setSource($data->getSource());

            $EntityManager = $this->getDoctrine()->getManager();
            $EntityManager->merge($EntityRate);
            $EntityManager->flush();
        }

        return $this->render('default/new.html.twig');
    }
}
