<?php

namespace ExportDataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Course
 *
 * @ORM\Table(name="courses")
 * @ORM\Entity(repositoryClass="ExportDataBundle\Repository\CoursesRepository")
 */
class Course
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="course_name", type="string", length=255)
     */
    private $courseName;

    /**
     * @var string
     *
     * @ORM\Column(name="university", type="string", length=255)
     */
    private $university;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="date")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="ExportDataBundle\Entity\Student", mappedBy="course")
     */
    private $students;

    /**
     * @return Collection|Student[]
     */

    public function getStudents()
    {
        return $this->students;
    }

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->students = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set courseName
     *
     * @param string $courseName
     *
     * @return Courses
     */
    public function setCourseName($courseName)
    {
        $this->courseName = $courseName;

        return $this;
    }

    /**
     * Get courseName
     *
     * @return string
     */
    public function getCourseName()
    {
        return $this->courseName;
    }

    /**
     * Set university
     *
     * @param string $university
     *
     * @return Courses
     */
    public function setUniversity($university)
    {
        $this->university = $university;

        return $this;
    }

    /**
     * Get university
     *
     * @return string
     */
    public function getUniversity()
    {
        return $this->university;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Courses
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Add student
     *
     * @param \ExportDataBundle\Entity\Student $student
     *
     * @return Course
     */
    public function addStudent(\ExportDataBundle\Entity\Student $student)
    {
        $this->students[] = $student;

        return $this;
    }

    /**
     * Remove student
     *
     * @param \ExportDataBundle\Entity\Student $student
     */
    public function removeStudent(\ExportDataBundle\Entity\Student $student)
    {
        $this->students->removeElement($student);
    }
}
