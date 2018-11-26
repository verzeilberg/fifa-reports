<?php

namespace Game\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Zend\Form\Annotation;
use Application\Traits\SoftDeleteableEntity;
use Application\Traits\TimestampableEntity;

/**
 * @ORM\Entity()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 * @ORM\Table(name="game")
 */
class Game {

    use SoftDeleteableEntity;

use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true, name="play_date")
     * @Annotation\Options({
     * "label": "Play date",
     * "label_attributes": {"class": "col-lg-4 col-md-4 col-sm-4 col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control datepicker", "autocomplete":"off"})
     */
    private $playDate;

    /**
     * @ORM\ManyToOne(targetEntity="Player\Entity\Player", inversedBy="homeGame")
     * @ORM\JoinColumn(name="home_player_id", referencedColumnName="id")
     */
    private $homePlayer;

    /**
     * @ORM\ManyToOne(targetEntity="Player\Entity\Player", inversedBy="awayGame")
     * @ORM\JoinColumn(name="away_player_id", referencedColumnName="id")
     */
    private $awayPlayer;

    /**
     * @ORM\ManyToOne(targetEntity="Season\Entity\Season", inversedBy="game")
     * @ORM\JoinColumn(name="season_id", referencedColumnName="id")
     */
    private $season;

    /**
     * One Game has One Home game result.
     * @ORM\OneToOne(targetEntity="Result\Entity\HomeGameResult", mappedBy="game")
     */
    private $homeGameResult;
    
    /**
     * One Game has One Home game result.
     * @ORM\OneToOne(targetEntity="Result\Entity\AwayGameResult", mappedBy="game")
     */
    private $awayGameResult;

    /**
     * @ORM\ManyToOne(targetEntity="Competition\Entity\Competition", inversedBy="game")
     * @ORM\JoinColumn(name="competition_id", referencedColumnName="id")
     */
    private $competition;

    function getId() {
        return $this->id;
    }

    function getPlayDate() {
        return $this->playDate;
    }

    function getHomePlayer() {
        return $this->homePlayer;
    }

    function getAwayPlayer() {
        return $this->awayPlayer;
    }

    function getSeason() {
        return $this->season;
    }

    function getAwayGameResult() {
        return $this->awayGameResult;
    }

    function getHomeGameResult() {
        return $this->homeGameResult;
    }

    function getCompetition() {
        return $this->competition;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPlayDate($playDate) {
        $this->playDate = $playDate;
    }

    function setHomePlayer($homePlayer) {
        $this->homePlayer = $homePlayer;
    }

    function setAwayPlayer($awayPlayer) {
        $this->awayPlayer = $awayPlayer;
    }

    function setSeason($season) {
        $this->season = $season;
    }

    function setAwayGameResult($awayGameResult) {
        $this->awayGameResult = $awayGameResult;
    }

    function setHomeGameResult($homeGameResult) {
        $this->homeGameResult = $homeGameResult;
    }

    function setCompetition($competition) {
        $this->competition = $competition;
    }

}
