<?php

namespace Competition\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Zend\Form\Annotation;
use Application\Traits\SoftDeleteableEntity;
use Application\Traits\TimestampableEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 * @ORM\Table(name="competition")
 */
class Competition {

    use SoftDeleteableEntity;

use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", length=1, nullable=false, name="away_home_game")
     * @Annotation\Type("Zend\Form\Element\Checkbox")
     * @Annotation\Options({
     * "label": "Away Home Game",
     * "label_attributes": {"class": "col-lg-4 col-md-4 col-sm-4 col-form-label", "for":"awayHomeGame"}
     * })
     * @Annotation\Attributes({"class":"", "id":"awayHomeGame"})
     */
    private $awayHomeGame = true;

    /**
     * @ORM\Column(type="string", nullable=false, name="name")
     * @Annotation\Options({
     * "label": "Name",
     * "label_attributes": {"class": "col-lg-4 col-md-4 col-sm-4 col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "placeholder":"Name"})
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Season\Entity\Season", mappedBy="competitions")
     */
    private $seasons;

    /**
     * @ORM\OneToMany(targetEntity="Game\Entity\Game", mappedBy="competition")
     */
    private $games;

    /**
     * One Competition has many players. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Player\Entity\Player", mappedBy="competition")
     */
    private $players;

    public function __construct() {
        $this->seasons = new ArrayCollection();
        $this->players = new ArrayCollection();
        $this->games = new ArrayCollection();
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getSeasons() {
        return $this->seasons;
    }

    function getGames() {
        return $this->games;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setSeasons($seasons) {
        $this->seasons = $seasons;
    }

    function setGames($games) {
        $this->games = $games;
    }

    function getPlayers() {
        return $this->players;
    }

    function setPlayers($players) {
        $this->players = $players;
    }

    function getAwayHomeGame() {
        return $this->awayHomeGame;
    }

    function setAwayHomeGame($awayHomeGame) {
        $this->awayHomeGame = $awayHomeGame;
    }


}
