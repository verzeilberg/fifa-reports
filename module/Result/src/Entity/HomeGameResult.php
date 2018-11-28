<?php

namespace Result\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 * @ORM\Entity
 * @ORM\Table(name="home_game_result")
 */
class HomeGameResult {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", length=11, nullable=false, name="goals")
     * @Annotation\Options({
     * "label": "Goals",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $goalsH = 0;

    /**
     * @ORM\Column(type="integer", length=1, nullable=false, name="points")
     */
    public $pointsH;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="shot_on_target")
     * @Annotation\Options({
     * "label": "Shots on target",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $shotOnTargetH = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="total_shots")
     * @Annotation\Options({
     * "label": "Total shots",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $totalShotsH = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="fouls")
     * @Annotation\Options({
     * "label": "Fouls",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $foulsH = 0;
    
            /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="offside")
     * @Annotation\Options({
     * "label": "Offside",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $offsideH = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="possession")
     * @Annotation\Options({
     * "label": "Possesion",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $possessionH = 50;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="corners")
     * @Annotation\Options({
     * "label": "Corners",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $cornersH = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="tackles")
     * @Annotation\Options({
     * "label": "Tackles",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $tacklesH = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="yellow_cards")
     * @Annotation\Options({
     * "label": "Yellow cards",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $yellowCardsH = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="red_cards")
     * @Annotation\Options({
     * "label": "Red cards",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $redCardsH = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="injuries")
     * @Annotation\Options({
     * "label": "Injuries",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $injuriesH = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="shot_accuracy")
     * @Annotation\Options({
     * "label": "Shotaccuracy",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $shotAccuracyH = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="pass_accuracy")
     * @Annotation\Options({
     * "label": "Pass accuracy",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    public $passAccuracyH = 0;

    /**
     * One Home game result has One Game.
     * @ORM\OneToOne(targetEntity="Game\Entity\Game", inversedBy="homeGameResult")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     */
    private $game;

    /**
     * @ORM\ManyToOne(targetEntity="Player\Entity\Player", inversedBy="homeGameResult")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity="Competition\Entity\Competition", inversedBy="homeGameResults")
     * @ORM\JoinColumn(name="competition_id", referencedColumnName="id")
     */
    private $competition;

    /**
     * @ORM\ManyToOne(targetEntity="Season\Entity\Season", inversedBy="homeGameResults")
     * @ORM\JoinColumn(name="season_id", referencedColumnName="id")
     */
    private $season;

    function getId() {
        return $this->id;
    }

    function getGoalsH() {
        return $this->goalsH;
    }

    function getPointsH() {
        return $this->pointsH;
    }

    function getShotOnTargetH() {
        return $this->shotOnTargetH;
    }

    function getTotalShotsH() {
        return $this->totalShotsH;
    }

    function getFoulsH() {
        return $this->foulsH;
    }

    function getPossessionH() {
        return $this->possessionH;
    }

    function getCornersH() {
        return $this->cornersH;
    }

    function getTacklesH() {
        return $this->tacklesH;
    }

    function getYellowCardsH() {
        return $this->yellowCardsH;
    }

    function getRedCardsH() {
        return $this->redCardsH;
    }

    function getInjuriesH() {
        return $this->injuriesH;
    }

    function getShotAccuracyH() {
        return $this->shotAccuracyH;
    }

    function getPassAccuracyH() {
        return $this->passAccuracyH;
    }

    function getGame() {
        return $this->game;
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

    function setGoalsH($goalsH) {
        $this->goalsH = $goalsH;
    }

    function setPointsH($pointsH) {
        $this->pointsH = $pointsH;
    }

    function setShotOnTargetH($shotOnTargetH) {
        $this->shotOnTargetH = $shotOnTargetH;
    }

    function setTotalShotsH($totalShotsH) {
        $this->totalShotsH = $totalShotsH;
    }

    function setFoulsH($foulsH) {
        $this->foulsH = $foulsH;
    }

    function setPossessionH($possessionH) {
        $this->possessionH = $possessionH;
    }

    function setCornersH($cornersH) {
        $this->cornersH = $cornersH;
    }

    function setTacklesH($tacklesH) {
        $this->tacklesH = $tacklesH;
    }

    function setYellowCardsH($yellowCardsH) {
        $this->yellowCardsH = $yellowCardsH;
    }

    function setRedCardsH($redCardsH) {
        $this->redCardsH = $redCardsH;
    }

    function setInjuriesH($injuriesH) {
        $this->injuriesH = $injuriesH;
    }

    function setShotAccuracyH($shotAccuracyH) {
        $this->shotAccuracyH = $shotAccuracyH;
    }

    function setPassAccuracyH($passAccuracyH) {
        $this->passAccuracyH = $passAccuracyH;
    }

    function setGame($game) {
        $this->game = $game;
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

    function getOffsideH() {
        return $this->offsideH;
    }

    function setOffsideH($offsideH) {
        $this->offsideH = $offsideH;
    }




}
