<?php

namespace App\Controller;

use App\Entity\Billet;
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
        $pieChart = $this->generatePieChart();
        $barChart = $this->generateBarChart();

        return $this->render('back/statistiqueTransport/statistiqueTransport.html.twig', array('chart' => $pieChart,
            'barChart'=>$barChart));
    }

    public function generatePieChart(){
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
        return $pieChart;
    }

    public function generateBarChart(){
        $barChart = new Highchart();

        $barChart->chart->renderTo('barchart');

        $barChart->plotOptions->bar(
            array(
                'dataLabels' => array(
                    'enabled' => true
                )
            )
        );

        $em = $this->getDoctrine()->getManager();
        $billets = $em->getRepository(Billet::class)->findAll();

        $arrayBilletsMonths = array();
        foreach ($billets as $billet){
            $date = $billet->getDateres();
            $result = $date->format('Y-M-d');
            $month = date("M",strtotime($result));
            if(!in_array($month, $arrayBilletsMonths, true)){
                array_push($arrayBilletsMonths,$month);
            }
        }

        var_dump("*****************",$arrayBilletsMonths);

        for ($i = 0 ; $i< count($billets); $i++) {
            $date = $billets[$i]->getDateres();
            $result = $date->format('Y-M-d');
            $month = date("M",strtotime($result));
            $prix = $billets[$i]->getPrix();
            if(!in_array($month, $arrayBilletsMonths, true)){
                array_push($arrayBilletsMonths,$month);
            }
        }





        $production = array(
            'Work',
            'EAT',
            'TV'
        );
       // $dates = array(1,5,6);
        $barChart->title->text('Production');
        $barChart->xAxis->categories($production);
        $barChart->xAxis->title(array('text'  => "Horizontal axis title"));
        $barChart->yAxis->title(array('text'  => "Vertical axis title"));
        $barChart->legend->legend(
            array(
                'layout' => 'vertical',
                'align'=> 'right',
                'verticalAlign'  =>'top',
                'floating'=> true,
                'borderWidth' =>1,

                'shadow'    =>true
            )
        );




        $broduction = array(
            5,
            20,
            70
        );

        $data=array();

        for($i =0 ; $i < count($production); $i++) {
            $stat=array();
            array_push($stat,$production[$i],$broduction[$i]);
            //var_dump($stat);
            array_push($data,$stat);
        }


      /*  $barChart->getData()->setArrayToDataTable(
            [['Task', 'Hours per Day'],
                ['Work',     11],
                ['Eat',      2],
                ['Commute',  2],
                ['Watch TV', 2],
                ['Sleep',    7]
            ]
        );*/

        $barChart->series(array(array('type' => 'bar','name' => 'Browser share', 'data' => $data)));
        return $barChart;
    }

}
