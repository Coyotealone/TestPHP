<?php

namespace AppBundle\Entity\Tests;

use AppBundle\Entity\RecordMovies;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RecordMoviesEntityTest extends WebTestCase
{
    /**
    * @var \Doctrine\ORM\EntityManager
    */
    private $em;

    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        self::bootKernel();
        $this->em = static ::$kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

    /**
     * getEntityManager function.
     *
     * @access protected
     * @return void
     */
    protected function getEntityManager()
    {
        return $this->em;
    }

    /**
     * newRecordMovies function.
     * Création d'un objet RecordMovies
     * @access private
     * @param mixed $title
     * @param mixed $realisator
     * @return void
     */
    private function newRecordMovies($title, $realisator)
    {
    	$recordMovie = new RecordMovies($title, $realisator);
    	return $recordMovie;
    }

    /**
     * testNewRecordMovies function.
     * test du constructeur de RecordMovies
     * @access public
     * @return void
     */
    public function testNewRecordMovies()
    {
        $em = $this->getEntityManager();
        /** Création d'une entité RecordMovies avec deux paramètres */
        $recordMovie1 = $this->newRecordMovies("Titre du film", "Realisateur");
        /** Création d'une entité RecordMovies avec un paramètre */
        $recordMovie2 = $this->newRecordMovies("Titre du film", null);
        $em->persist($recordMovie1);
        $em->persist($recordMovie2);
        /** Ajout des entités en base */
        $em->flush();
        /** Récupération des identitifiants des deux entités */
        $recordMovie1Check = $em->getRepository('AppBundle:RecordMovies')->findOneById($recordMovie1->getId());
        $recordMovie2Check = $em->getRepository('AppBundle:RecordMovies')->findOneById($recordMovie2->getId());
        /** Vérification que les entités créées correspondent bien aux ids récupérés */
        $this->assertEquals($recordMovie1Check, $recordMovie1->getId());
        $this->assertEquals($recordMovie2Check, $recordMovie2->getId());
    }

    /**
     * testAddRecordMovies function.
     * test de la fonction addRecordMovies
     * @access public
     * @return void
     */
    public function testAddRecordMovies()
    {
        $em = $this->getEntityManager();
        /** Création d'une entité RecordMovies avec deux paramètres */
        $recordMovie = $em->getRepository('AppBundle:RecordMovies')->addRecordMovies("Titre film Test", "Nom du réalisateur");
        /** Récupération de l'identifiant de l'entité créée */
        $recordMovieCheck = $em->getRepository('AppBundle:RecordMovies')->findOneById($recordMovie);
        /** Vérification que l'entité correpond à celle créé */
        $this->assertEquals($recordMovieCheck, $recordMovie);

        /** Création d'une entité RecordMovies avec un paramètre */
        $recordMovie = $em->getRepository('AppBundle:RecordMovies')->addRecordMovies("Titre film Test sans réalisateur");
        /** Récupération de l'identifiant de l'entité créée */
        $recordMovieCheck = $em->getRepository('AppBundle:RecordMovies')->findOneById($recordMovie);
        /** Vérification que l'entité correpond à celle créé */
        $this->assertEquals($recordMovieCheck, $recordMovie);
    }

    /**
     * testGetByDates function.
     * test de la fonction getByDates
     * @access public
     * @return void
     */
    public function testGetByDates()
    {
        $em = $this->getEntityManager();
        /** Récupération des entités comprisent entre les deux dates en paramétre */
        $entities = $em->getRepository('AppBundle:RecordMovies')->getByDates(20160101, 20161231);
        /** Vérification du nombre d'entités récupérées */
        $this->assertCount(count($entities), $entities);
        /** Création d'une entité RecordMovies avec deux paramètres */
        $entities = $em->getRepository('AppBundle:RecordMovies')->getByDates("test", "error");
        /** Vérification du code erreur retourné */
        $this->assertEquals("-1", $entities);
        /** Création d'une entité RecordMovies avec deux paramètres */
        $entities = $em->getRepository('AppBundle:RecordMovies')->getByDates(2016010, 20161231);
        $this->assertEquals("-1", $entities);
        /** Création d'une entité RecordMovies avec deux paramètres */
        $entities = $em->getRepository('AppBundle:RecordMovies')->getByDates(20160101, 2016123);
        /** Vérification du code erreur retourné */
        $this->assertEquals("-2", $entities);
        /** Création d'une entité RecordMovies avec deux paramètres */
        $entities = $em->getRepository('AppBundle:RecordMovies')->getByDates(20160101, "error");
        /** Vérification du code erreur retourné */
        $this->assertEquals("-2", $entities);
    }

    /**
     * testCreateDate function.
     * Test de la fonction createDate
     * @access public
     * @return void
     */
    public function testCreateDate()
    {
        $em = $this->getEntityManager();
        /** Création d'un objet DateTime */
        $date = $em->getRepository('AppBundle:RecordMovies')->createDate("2016102");
        /** Vérification de l'erreur retournée */
        $this->assertFalse(true === $date);
        /** Création d'un objet DateTime */
        $date = $em->getRepository('AppBundle:RecordMovies')->createDate("test");
        /** Vérification du code erreur retourné */
        $this->assertFalse(true === $date);
        /** Création d'un objet DateTime */
        $date = $em->getRepository('AppBundle:RecordMovies')->createDate(20161021);
        /** Vérification de la correspondance des deux dates */
        $this->assertEquals(new \DateTime("2016-10-21"), $date);
    }
}