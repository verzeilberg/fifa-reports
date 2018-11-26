<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Zend\Form\Annotation;
use Application\Traits\SoftDeleteableEntity;
use Application\Traits\TimestampableEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 * @ORM\Table(name="player")
 */
class Player {

    use SoftDeleteableEntity;

use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false, name="sur_name")
     * @Annotation\Options({
     * "label": "Sur name",
     * "label_attributes": {"class": "col-lg-4 col-md-4 col-sm-4 col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "placeholder":"Sur name"})
     */
    private $surName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="last_name_prefix")
     * @Annotation\Options({
     * "label": "Last name prefix",
     * "label_attributes": {"class": "col-lg-4 col-md-4 col-sm-4 col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "placeholder":"Last name prefix"})
     */
    private $lastNamePrefix;

    /**
     * @ORM\Column(type="string", length=255, nullable=false, name="last_name")
     * @Annotation\Options({
     * "label": "Last name",
     * "label_attributes": {"class": "col-lg-4 col-md-4 col-sm-4 col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "placeholder":"Last name"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="screen_name")
     * @Annotation\Options({
     * "label": "Screen name",
     * "label_attributes": {"class": "col-lg-4 col-md-4 col-sm-4 col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "placeholder":"Screen name"})
     */
    private $screenName;

    /**
     * @ORM\OneToMany(targetEntity="Game\Entity\Game", mappedBy="homePlayer")
     */
    private $homeGame;

    /**
     * @ORM\OneToMany(targetEntity="Game\Entity\Game", mappedBy="awayPlayer")
     */
    private $awayGame;

    /**
     * @ORM\ManyToOne(targetEntity="Club\Entity\Club", inversedBy="player")
     * @ORM\JoinColumn(name="club_id", referencedColumnName="id")
     */
    private $club;

    /**
     * One Player has many competitions. This is the inverse side.
     * @ORM\ManyToOne(targetEntity="Competition\Entity\Competition", inversedBy="player")
     * @ORM\JoinColumn(name="competition_id", referencedColumnName="id")
     */
    private $competition;

    function getId() {
        return $this->id;
    }

    function getSurName() {
        return $this->surName;
    }

    function getLastNamePrefix() {
        return $this->lastNamePrefix;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getFullName() {
        return $this->surName . ' ' . ($this->lastNamePrefix ? $this->lastNamePrefix . ' ' : '') . $this->lastName;
    }

    function getScreenName() {
        return $this->screenName;
    }

    function getClub() {
        return $this->club;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSurName($surName) {
        $this->surName = $surName;
    }

    function setLastNamePrefix($lastNamePrefix) {
        $this->lastNamePrefix = $lastNamePrefix;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function setScreenName($screenName) {
        $this->screenName = $screenName;
    }

    function setClub($club) {
        $this->club = $club;
    }

    function getCompetition() {
        return $this->competition;
    }

    function setCompetition($competition) {
        $this->competition = $competition;
    }

    function getHomeGame() {
        return $this->homeGame;
    }

    function getAwayGame() {
        return $this->awayGame;
    }

    function setHomeGame($homeGame) {
        $this->homeGame = $homeGame;
    }

    function setAwayGame($awayGame) {
        $this->awayGame = $awayGame;
    }

}
