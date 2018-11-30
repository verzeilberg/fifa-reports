<?php

namespace Result\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="result")
 */
class Result {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=11, nullable=false, name="home_away")
     */
    public $homeAway;

    /**
     * @ORM\Column(type="integer", length=11, nullable=false, name="goals")
     * @Annotation\Options({
     * "label": "Goals",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $goals = 0;
    
        /**
     * @ORM\Column(type="integer", length=11, nullable=false, name="goals_against")
     */
    public $goalsAgainst = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=false, name="points")
     */
    public $points = 1;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="shot_on_target")
     * @Annotation\Options({
     * "label": "Shots on target",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $shotOnTarget = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="total_shots")
     * @Annotation\Options({
     * "label": "Total shots",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $totalShots = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="fouls")
     * @Annotation\Options({
     * "label": "Fouls",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $fouls = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="offside")
     * @Annotation\Options({
     * "label": "Offside",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $offside = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="possession")
     * @Annotation\Options({
     * "label": "Possesion",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $possession = 50;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="corners")
     * @Annotation\Options({
     * "label": "Corners",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $corners = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="tackles")
     * @Annotation\Options({
     * "label": "Tackles",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $tackles = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="yellow_cards")
     * @Annotation\Options({
     * "label": "Yellow cards",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $yellowCards = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="red_cards")
     * @Annotation\Options({
     * "label": "Red cards",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $redCards = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="injuries")
     * @Annotation\Options({
     * "label": "Injuries",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $injuries = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="shot_accuracy")
     * @Annotation\Options({
     * "label": "Shot accuracy",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $shotAccuracy = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="pass_accuracy")
     * @Annotation\Options({
     * "label": "Pass accuracy",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $passAccuracy = 0;

    /**
     * @ORM\ManyToOne(targetEntity="Player\Entity\Player", inversedBy="results")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity="Competition\Entity\Competition", inversedBy="gameResults")
     * @ORM\JoinColumn(name="competition_id", referencedColumnName="id")
     */
    private $competition;

    /**
     * @ORM\ManyToOne(targetEntity="Season\Entity\Season", inversedBy="gameResults")
     * @ORM\JoinColumn(name="season_id", referencedColumnName="id")
     */
    private $season;

    function getId() {
        return $this->id;
    }

    function getHomeAway() {
        return $this->homeAway;
    }

    function getGoals() {
        return $this->goals;
    }

    function getPoints() {
        return $this->points;
    }

    function getShotOnTarget() {
        return $this->shotOnTarget;
    }

    function getTotalShots() {
        return $this->totalShots;
    }

    function getFouls() {
        return $this->fouls;
    }

    function getOffside() {
        return $this->offside;
    }

    function getPossession() {
        return $this->possession;
    }

    function getCorners() {
        return $this->corners;
    }

    function getTackles() {
        return $this->tackles;
    }

    function getYellowCards() {
        return $this->yellowCards;
    }

    function getRedCards() {
        return $this->redCards;
    }

    function getInjuries() {
        return $this->injuries;
    }

    function getShotAccuracy() {
        return $this->shotAccuracy;
    }

    function getPassAccuracy() {
        return $this->passAccuracy;
    }

    function getPlayer() {
        return $this->player;
    }

    function getCompetition() {
        return $this->competition;
    }

    function getSeason() {
        return $this->season;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setHomeAway($homeAway) {
        $this->homeAway = $homeAway;
    }

    function setGoals($goals) {
        $this->goals = $goals;
    }

    function setPoints($points) {
        $this->points = $points;
    }

    function setShotOnTarget($shotOnTarget) {
        $this->shotOnTarget = $shotOnTarget;
    }

    function setTotalShots($totalShots) {
        $this->totalShots = $totalShots;
    }

    function setFouls($fouls) {
        $this->fouls = $fouls;
    }

    function setOffside($offside) {
        $this->offside = $offside;
    }

    function setPossession($possession) {
        $this->possession = $possession;
    }

    function setCorners($corners) {
        $this->corners = $corners;
    }

    function setTackles($tackles) {
        $this->tackles = $tackles;
    }

    function setYellowCards($yellowCards) {
        $this->yellowCards = $yellowCards;
    }

    function setRedCards($redCards) {
        $this->redCards = $redCards;
    }

    function setInjuries($injuries) {
        $this->injuries = $injuries;
    }

    function setShotAccuracy($shotAccuracy) {
        $this->shotAccuracy = $shotAccuracy;
    }

    function setPassAccuracy($passAccuracy) {
        $this->passAccuracy = $passAccuracy;
    }

    function setPlayer($player) {
        $this->player = $player;
    }

    function setCompetition($competition) {
        $this->competition = $competition;
    }

    function setSeason($season) {
        $this->season = $season;
    }
    
    function getGoalsAgainst() {
        return $this->goalsAgainst;
    }

    function setGoalsAgainst($goalsAgainst) {
        $this->goalsAgainst = $goalsAgainst;
    }



}
