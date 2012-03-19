<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Spieler;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Platzierung;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\GesamtRang;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

class RanglistenAktualisierenCommand extends ContainerAwareCommand {

    public function configure() {
        $this->setName('kcb:bonnliga:ranglisten-aktualisieren');
    }

    public function run(InputInterface $input, OutputInterface $output) {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $ranglisteFactory = $this->getContainer()->get('kcb.bonnliga.rangliste_factory');

        // Gesamtrangliste
        $gesamtRangliste = $ranglisteFactory->getGesamtRangliste();
        $gesamtRangliste->zuruecksetzen();

        $em->flush();

        foreach ($em->getRepository('KcbBonnligaWebsiteBundle:Turnier')->findBy(array(), array('id' => 'asc')) as $turnier) {
            foreach ($turnier->getPlatzierungen() as $platzierung) {
                $gesamtRangliste->beruecksichtige($platzierung);
            }
            $gesamtRangliste->aktualisieren();
        }

        $em->flush();
    }

}