<?php

namespace AppBundle\Entity;

/**
 * RecordMoviesRepository
 * @author Anthony
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RecordMoviesRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * addRecordMovies function.
     * Ajout d'une fiche de film
     * @access public
     * @param string $title
     * @param string $realisator (default: null)
     * @return l'entity créée
     */
    public function addRecordMovies($title, $realisator)
    {
        $recordMovie = new RecordMovies($title, $realisator);
        $this->_em->persist($recordMovie);
        $this->_em->flush();
        return $recordMovie;
    }

    /**
     * getByDates function.
     * Recherche des fiches de films entre deux dates
     * @access public
     * @param string $from
     * @param string $to
     * @return les entitées trouvées entre ses deux dates
     */
    public function getByDates($from, $to)
    {
        $fromDate = null;
        $toDate = null;
        if ($this->createDate($from) != false)
        {
            $fromDate = $this->createDate($from);
        }
        else
        {
            return "-1";
        }
        if ($this->createDate($to) != false)
        {
            $toDate = $this->createDate($to);
        }
        else
        {
            return "-2";
        }
        $qb = $this->_em->createQueryBuilder()
                   ->select('rm')
                   ->from('AppBundle:RecordMovies','rm')
                   ->where('rm.from >= :from and rm.to <= :to')
                   ->setParameters(array('from' => $fromDate, 'to' => $toDate));
        return $qb->getQuery()->getResult();
    }

    /**
     * createDate function.
     * Créer une objet DateTime par rapport à entier
     * @access public
     * @param mixed $arg
     * @return void
     */
    public function createDate($arg)
    {
        if (is_int($arg) and strlen($arg) == 8)
        {
            $date = substr($arg, 0, 4) .'-'. substr($arg, 4,2) .'-'. substr($arg, 6,2);
            return new \DateTime($date);
        }
        else
            return false;
    }
}
