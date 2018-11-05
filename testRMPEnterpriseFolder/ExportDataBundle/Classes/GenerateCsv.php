<?php

namespace ExportDataBundle\Classes;

/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/01/2018
 * Time: 18:20
 */

use Doctrine\ORM\EntityManager;
use ExportDataBundle\Entity\Student;
use ExportDataBundle\Entity\Course;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

Class GenerateCsv extends ContainerAwareCommand
{
    /**
     * @var EntityManager
     */
    private $em;
    private $kernel;

    /**
     * CurrenciesHandler constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param $listOfStudentsIds
     * @param $webFolderPath
     * @return bool
     */
    public function generateStudentsDetailsCsv($listOfStudentsIds)
    {
        $studentsDetails = explode("-", $listOfStudentsIds);
        $studentsDetailsToBeStored = array(array("List of students"));
        if (count($studentsDetails) > 0) {
            foreach ($studentsDetails as $studentId) {
                $studentDetails = $this->em->getRepository(Student::class)->find($studentId);

                if ($studentDetails) {
                    array_push(
                        $studentsDetailsToBeStored,
                        array($studentDetails->getId(),
                            $studentDetails->getFirstName(),
                            $studentDetails->getSurname(),
                            $studentDetails->getEmail(),
                            $studentDetails->getNationality(),
                            $studentDetails->getCourse() ? $studentDetails->getCourse()->getCourseName() : "",
                            $studentDetails->getCourse() ? $studentDetails->getCourse()->getUniversity() : "",
                            $studentDetails->getAddress() ? $studentDetails->getAddress()->getHouseNo()
                                . " " . $studentDetails->getAddress()->getLine1()
                                . " " . $studentDetails->getAddress()->getLine2()
                                . " " . $studentDetails->getAddress()->getPostcode()
                                . " " . $studentDetails->getAddress()->getCity() : ""
                        )
                    );
                }
            }
        }
        // file path of the csv file
        $filePath = $_SERVER['DOCUMENT_ROOT'] . "/downloads/studentReports.csv";

        // open the file ".csv" for writing
        $file = fopen($filePath, 'w');

        // save the csv file headers
        fputcsv($file, array("Id", "Forename", "Surname", "Email", "Nationality", "Course", "University", "Address"));

        // loop, add students details
        foreach ($studentsDetailsToBeStored AS $stuDet) {
            fputcsv($file, $stuDet);
        }
        fclose($file);

        return $file;
    }

    /**
     * @return mixed
     */
    public function exporttCourseAttendenceToCSV()
    {
        // set array of courses
        $courseDetailsToBeStored = array(array("List of courses"));
        
        // get all the courses
        $coursesDetails = $this->em->getRepository(Course::class)->findAll();

        if (count($coursesDetails) > 0) {
            // store courses to save in csv file
            foreach ($coursesDetails as $courseDetails) {
                if ($courseDetails) {
                    array_push(
                        $courseDetailsToBeStored,
                        array($courseDetails->getId(),
                            $courseDetails->getCourseName(),
                            $courseDetails->getUniversity(),
                            count($courseDetails->getStudents()))
                    );
                }
            }
        }

        // file path to stare the list of courses
        $filePath = $_SERVER['DOCUMENT_ROOT'] . "/downloads/courseReports.csv";

        // open the file ".csv" for writing
        $file = fopen($filePath, 'w');

        // save the column headers
        fputcsv($file, array("Id", "Course Name", "University", "Students per course"));

        // loop
        foreach ($courseDetailsToBeStored AS $courseDetails) {
            fputcsv($file, $courseDetails);
        }
        fclose($file);

        return $file;
    }
}