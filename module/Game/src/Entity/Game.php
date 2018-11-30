<?php

namespace Game\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Zend\Form\Annotation;
use Application\Traits\SoftDeleteableEntity;
use Application\Traits\TimestampableEntity;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @ORM\Column(type="integer", nullable=true, name="sort_order")
     * @Annotation\Options({
     * "label": "Play date",
     * "label_attributes": {"class": "col-lg-4 col-md-4 col-sm-4 col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    private $sortOrder;

    /**
     * @ORM\Column(type="integer", nullable=true, name="home_goals")
     * @Annotation\Options({
     * "label": "Home goals",
     * "label_attributes": {"class": "col-lg-4 col-md-4 col-sm-4 col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    private $homeGoals;

    /**
     * @ORM\Column(type="integer", nullable=true, name="away_goals")
     * @Annotation\Options({
     * "label": "Away goals",
     * "label_attributes": {"class": "col-lg-4 col-md-4 col-sm-4 col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    private $awayGoals;

    /**
     * @ORM\ManyToOne(targetEntity="Player\Entity\Player", inversedBy="homeGames")
     * @ORM\JoinColumn(name="home_player_id", referencedColumnName="id")
     */
    private $homePlayer;

    /**
     * @ORM\ManyToOne(targetEntity="Player\Entity\Player", inversedBy="awayGames")
     * @ORM\JoinColumn(name="away_player_id", referencedColumnName="id")
     */
    private $awayPlayer;

    /**
     * @ORM\ManyToOne(targetEntity="Season\Entity\Season", inversedBy="game")
     * @ORM\JoinColumn(name="season_id", referencedColumnName="id")
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity="Result\Entity\Result")
     * @ORM\JoinColumn(name="home_result_id", referencedColumnName="id")
     */
    private $homeResult;

    /**
     * @ORM\ManyToOne(targetEntity="Result\Entity\Result")
     * @ORM\JoinColumn(name="away_result_id", referencedColumnName="id")
     */
    private $awayResult;

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

    function getSortOrder() {
        return $this->sortOrder;
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

    function getHomeResult() {
        return $this->homeResult;
    }

    function getAwayResult() {
        return $this->awayResult;
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

    function setSortOrder($sortOrder) {
        $this->sortOrder = $sortOrder;
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

    function setHomeResult($homeResult) {
        $this->homeResult = $homeResult;
    }

    function setAwayResult($awayResult) {
        $this->awayResult = $awayResult;
    }

    function setCompetition($competition) {
        $this->competition = $competition;
    }

    function getHomeGoals() {
        return $this->homeGoals;
    }

    function getAwayGoals() {
        return $this->awayGoals;
    }

    function setHomeGoals($homeGoals) {
        $this->homeGoals = $homeGoals;
    }

    function setAwayGoals($awayGoals) {
        $this->awayGoals = $awayGoals;
    }

}
