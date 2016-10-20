<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class RecordMovies
 * @author Anthony
 * @ORM\Entity
 * @ORM\Table(name="record_movies")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\RecordMoviesRepository");
 * @ORM\HasLifecycleCallbacks
 */
class RecordMovies
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Titre du film
     * @var string
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * Date d'ajout
     * @var \DateTime
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * Auteur
     * @var \string
     * @ORM\Column(name="realisator", type="string", length=255, nullable=true)
     */
    private $realisator;

    /**
     * Date de début
     * @var \Date
     * @ORM\Column(name="from", type="date", nullable=true)
     */
    private $from;

    /**
     * Date de fin
     * @var \Date
     * @ORM\Column(name="to", type="date", nullable=true)
     */
    private $to;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return RecordMovies
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return RecordMovies
     * @ORM\PrePersist
     */
    public function setDate()
    {
        $this->date = new \DateTime();

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set realisator
     *
     * @param string $realisator
     *
     * @return RecordMovies
     */
    public function setRealisator($realisator)
    {
        $this->realisator = $realisator;

        return $this;
    }

    /**
     * Get realisator
     *
     * @return string
     */
    public function getRealisator()
    {
        return $this->realisator;
    }

    /**
     * Set from
     *
     * @param \DateTime $from
     *
     * @return RecordMovies
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get from
     *
     * @return \DateTime
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set to
     *
     * @param \DateTime $to
     *
     * @return RecordMovies
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get to
     *
     * @return \DateTime
     */
    public function getTo()
    {
        return $this->to;
    }
}
