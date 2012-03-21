<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Kcb\Bonnliga\Bundle\WebsiteBundle\LessCss\lessc;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

class LessToCssCommand extends ContainerAwareCommand {

    public function configure() {
        $this->setName('kcb:bonnliga:lesstocss');
    }

    public function run(InputInterface $input, OutputInterface $output) {
        $resourcePath = $this->getApplication()->getKernel()->getBundle("KcbBonnligaWebsiteBundle")->getPath() . '/Resources/';

        try {
            lessc::ccompile($resourcePath . 'public/less/bootstrap.less', $resourcePath . 'public/css/bonnliga.css');
            $output->writeln('bonnliga.css erstellt');
        } catch (exception $ex) {
            $output->writeln('lessc fatal error:');
            $output->writeln($ex->getMessage());
        }
    }

}