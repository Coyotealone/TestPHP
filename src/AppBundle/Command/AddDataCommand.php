<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;

class AddDataCommand extends ContainerAwareCommand
{
	/**
     * configure function.
     * @see \Symfony\Component\Console\Command\Command::configure()
     * @access protected
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('recordmovies:add')
            ->setDescription('Ajout de fiches de film')
            ->addArgument('title', InputArgument::REQUIRED, 'Titre du film')
            ->addArgument('realisator', InputArgument::OPTIONAL, 'Réalisateur')
        ;
    }

    /**
     * execute function.
     * @see \Symfony\Component\Console\Command\Command::configure()
     * @access protected
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /**
         * output- Affichage de deux lignes
         *
         * @var mixed
         * @access public
         */
        $output->writeln(['Record Movies Add', '',]);
        /**
         * Initialisation de la variable $title avec l'argument 'title' passé en ligne de commande
         *
         * (default value: $input->getArgument('title'))
         *
         * @var string
         * @access public
         */
        $title = $input->getArgument('title');
        /**
         * Initialisation de la variable $realisator avec l'argument 'realisator' passé en ligne de commande
         *
         * (default value: $input->getArgument('realisator'))
         *
         * @var string
         * @access public
         */
        $realisator = $input->getArgument('realisator');
        /**
         * em
         *
         * (default value: $this->getContainer()->get('doctrine')->getManager())
         *
         * @var string
         * @access public
         */
        $em = $this->getContainer()->get('doctrine')->getManager();
        /**
    	 * Ajout d'une fiche de film à partir des deux paramétres $title et $realisator
    	 *
    	 * (default value: $em->getRepository('AppBundle:RecordMovies')->addRecordMovies($title, $realisator))
    	 *
    	 * @var string
    	 * @access public
    	 * @return Retourne id de l'entité créée si tout c'est bien passé sinon un message d'avertissement
    	 */
    	$result = $em->getRepository('AppBundle:RecordMovies')->addRecordMovies($title, $realisator);
    	if (!empty($result))
    	{
            /**
             * output-
             *
             * @var mixed
             * @access public
             */
            $output->writeln('Fiche du film ajoutée ! '.$title.' '.$realisator.' '.$result);
        }
        else
        {
            $output->writeln('Une erreur est survenue');
        }
    }
}