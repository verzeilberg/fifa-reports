<?php

namespace Result\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 * @ORM\Entity
 * @ORM\Table(name="away_game_result")
 */
class AwayGameResult {

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
    private $goalsA = 0;

    /**
     * @ORM\Column(type="integer", length=1, nullable=false, name="points")
     */
    private $pointsA;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="shot_on_target")
     * @Annotation\Options({
     * "label": "Shots on target",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    private $shotOnTargetA = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="total_shots")
     * @Annotation\Options({
     * "label": "Total shots",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    private $totalShotsA = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="fouls")
     * @Annotation\Options({
     * "label": "Fouls",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    private $foulsA = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="possession")
     * @Annotation\Options({
     * "label": "Possesion",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    private $possessionA = 50;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="corners")
     * @Annotation\Options({
     * "label": "Corners",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    private $cornersA = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="tackles")
     * @Annotation\Options({
     * "label": "Tackles",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    private $tacklesA = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="yellow_cards")
     * @Annotation\Options({
     * "label": "Yellow cards",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    private $yellowCardsA = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="red_cards")
     * @Annotation\Options({
     * "label": "Red cards",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    private $redCardsA = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="injuries")
     * @Annotation\Options({
     * "label": "Injuries",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    private $injuriesA = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="shot_accuracy")
     * @Annotation\Options({
     * "label": "Shot accuracy",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    private $shotAccuracyA = 0;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true, name="pass_accuracy")
     * @Annotation\Options({
     * "label": "Pass accuracy",
     * "label_attributes": {"class": "col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "autocomplete":"off"})
     */
    private $passAccuracyA = 0;

    /**
     * One Away game result has One Game.
     * @ORM\OneToOne(targetEntity="Game\Entity\Game", inversedBy="awayGameResult")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     */
    private $game;

    /**
     * @ORM\ManyToOne(targetEntity="Player\Entity\Player", inversedBy="awayGameResult")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    private $player;

    function getId() {
        return $this->id;
    }

    function getGoalsA() {
        return $this->goalsA;
    }

    function getPointsA() {
        return $this->pointsA;
    }

    function getShotOnTargetA() {
        return $this->shotOnTargetA;
    }

    function getTotalShotsA() {
        return $this->totalShotsA;
    }

    function getFoulsA() {
        return $this->foulsA;
    }

    function getPossessionA() {
        return $this->possessionA;
    }

    function getCornersA() {
        return $this->cornersA;
    }

    function getTacklesA() {
        return $this->tacklesA;
    }

    function getYellowCardsA() {
        return $this->yellowCardsA;
    }

    function getRedCardsA() {
        return $this->redCardsA;
    }

    function getInjuriesA() {
        return $this->injuriesA;
    }

    function getShotAccuracyA() {
        return $this->shotAccuracyA;
    }

    function getPassAccuracyA() {
        return $this->passAccuracyA;
    }

    function getGame() {
        return $this->game;
    }

    function getPlayer() {
        return $this->player;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setGoalsA($goalsA) {
        $this->goalsA = $goalsA;
    }

    function setPointsA($pointsA) {
        $this->pointsA = $pointsA;
    }

    function setShotOnTargetA($shotOnTargetA) {
        $this->shotOnTargetA = $shotOnTargetA;
    }

    function setTotalShotsA($totalShotsA) {
        $this->totalShotsA = $totalShotsA;
    }

    function setFoulsA($foulsA) {
        $this->foulsA = $foulsA;
    }

    function setPossessionA($possessionA) {
        $this->possessionA = $possessionA;
    }

    function setCornersA($cornersA) {
        $this->cornersA = $cornersA;
    }

    function setTacklesA($tacklesA) {
        $this->tacklesA = $tacklesA;
    }

    function setYellowCardsA($yellowCardsA) {
        $this->yellowCardsA = $yellowCardsA;
    }

    function setRedCardsA($redCardsA) {
        $this->redCardsA = $redCardsA;
    }

    function setInjuriesA($injuriesA) {
        $this->injuriesA = $injuriesA;
    }

    function setShotAccuracyA($shotAccuracyA) {
        $this->shotAccuracyA = $shotAccuracyA;
    }

    function setPassAccuracyA($passAccuracyA) {
        $this->passAccuracyA = $passAccuracyA;
    }

    function setGame($game) {
        $this->game = $game;
    }

    function setPlayer($player) {
        $this->player = $player;
    }

}
