<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Spieler;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Platzierung;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\GesamtRang;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Wanderpokal\Monat;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Rangliste\Calculation;

class RanglistenAktualisierenCommand extends ContainerAwareCommand {

    public function configure() {
        $this->setName('kcb:bonnliga:ranglisten-aktualisieren');
    }

    public function run(InputInterface $input, OutputInterface $output) {
        Calculation::run($this->getContainer());
    }

}