<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Wanderpokal;

use Doctrine\ORM\Mapping as ORM;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Rangliste\StammlokalRangliste;

/**
 * @ORM\Entity(repositoryClass="MonatRepository")
 * @ORM\Table(name="WanderpokalMonat")
 */
class Monat {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="date")
     */
    protected $monat;

    /**
     * @ORM\OneToMany(targetEntity="Rang", mappedBy="monat", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"punkte" = "DESC", "vormonatsBester" = "DESC", "teilnahmen" = "DESC"})
     */
    protected $raenge;

    public function __construct(\DateTime $monat) {
        $this->monat = $monat;
        $this->raenge = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function beruecksichtige(StammlokalRangliste $stammlokalRangliste, Monat $vormonat = null) {
        if (count($stammlokalRangliste->getRaengeForRangliste(5)) == 5) {
            $this->raenge->add(new Rang($this, $stammlokalRangliste, $vormonat));
        }
    }

    public function getRaenge() {
        return $this->raenge;
    }

    public function getMonat() {
        return $this->monat;
    }

}