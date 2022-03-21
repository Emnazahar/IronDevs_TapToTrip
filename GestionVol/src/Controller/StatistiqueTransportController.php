<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Transport;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatistiqueTransportController extends AbstractController
{
    /**
     * @Route("/statistiqueTransport", name="statistiqueTransport")
     */
    public function chartAction()
    {
        $pieChart = new Highchart();

        $pieChart->chart->renderTo('piechart');
        $pieChart->title->text('All Your Expenses by Type');
        $pieChart->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));

        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Categorie::class)->findAll();

        $arrayCategorieNames = array();
        foreach ($categories as $categorie){
            array_push($arrayCategorieNames, $categorie->getNom());
        }

        $arrayNumberUserByCategorieName = array();
        foreach($arrayCategorieNames as $categorieName) {
            array_push($arrayNumberUserByCategorieName,
                $em->getRepository(Transport::class)->findNumberUsersByCategorieName($categorieName));
        }


        $data=array();

        for($i =0 ; $i < count($arrayCategorieNames); $i++) {
            $stat=array();
            array_push($stat,$arrayCategorieNames[$i],$arrayNumberUserByCategorieName[$i]);
            //var_dump($stat);
            array_push($data,$stat);
        }

        $pieChart->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));

            return $this->render('back/statistiqueTransport/statistiqueTransport.html.twig', array('chart' => $pieChart));
    }


}
