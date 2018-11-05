<?php

namespace ExportDataBundle\Controller;

use Doctrine\DBAL\Schema\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use ExportDataBundle\Entity\Student;
use ExportDataBundle\Classes\GenerateCsv;

class DefaultController extends Controller
{
    /**
     * @Route("/view", name="view")
     */
    public function viewAction()
    {
        $students = $this->getDoctrine()->getManager()->getRepository(Student::class)->findAll();
        return $this->render('ExportDataBundle:Default:view.html.twig', array( 'students' => $students));
    }

    /**
     * @Route("/generate/{listOfStudentsIds}/foo", options={"expose" = true}, name="generate_csv")
     * @Method("POST")
     */
    public function generatecsvAction($listOfStudentsIds)
    {
        $generateCsv = $this->container->get('ExportData.classes.csv_generator')->generateStudentsDetailsCsv($listOfStudentsIds);
        $generateCsvCourseAttendance = $this->container->get('ExportData.classes.csv_generator')->exporttCourseAttendenceToCSV();

        if($generateCsv || $generateCsvCourseAttendance){
            return new Response("true");
        }
        return new Response("false");
    }
}
