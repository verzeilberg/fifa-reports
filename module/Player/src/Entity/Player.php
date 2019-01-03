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
    private $homeGames;

    /**
     * @ORM\OneToMany(targetEntity="Game\Entity\Game", mappedBy="awayPlayer")
     */
    private $awayGames;

    /**
     * One Player has One User.
     * @ORM\OneToOne(targetEntity="User\Entity\User")
     * @ORM\JoinColumn(name="suser_id", referencedColumnName="id")
     * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Annotation\Required(false)
     * @Annotation\AllowEmpty
     * @Annotation\Options({
     * "target_class":"User\Entity\User",
     * "property": "fullName",
     * "empty_option": "--Maak uw keuze--",
     * "label": "User",
     * "label_attributes": {"class": "col-lg-4 col-md-4 col-sm-4 col-form-label"},
     * "find_method":{"name": "findAll","params": {"orderBy":{"fullName": "ASC"}}}
     * })
     * @Annotation\Attributes({"class":"form-control col-md-2"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Club\Entity\Club", inversedBy="player")
     * @ORM\JoinColumn(name="club_id", referencedColumnName="id")
     * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Annotation\Required(false)
     * @Annotation\AllowEmpty
     * @Annotation\Options({
     * "target_class":"Club\Entity\Club",
     * "property": "name",
     * "empty_option": "--Maak uw keuze--",
     * "label": "Favourite club",
     * "label_attributes": {"class": "col-lg-4 col-md-4 col-sm-4 col-form-label"},
     * "find_method":{"name": "findBy","params": {
     *     "criteria":{"deletedAt": null},
     *     "orderBy":{"name": "ASC"}
     *     }
     *  }
     * })
     * @Annotation\Attributes({"class":"form-control col-md-2"})
     */
    private $club;

    /**
     * One Player has many competitions. This is the inverse side.
     * @ORM\ManyToOne(targetEntity="Competition\Entity\Competition", inversedBy="player")
     * @ORM\JoinColumn(name="competition_id", referencedColumnName="id")
     */
    private $competition;

    /**
     * One player have One Image.
     * @ORM\OneToOne(targetEntity="UploadImages\Entity\Image")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $playerImage;

    public function __construct() {
        $this->homeGames = new ArrayCollection();
        $this->awayGames = new ArrayCollection();
    }

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

    function getScreenName() {
        return $this->screenName;
    }

    function getHomeGames() {
        return $this->homeGames;
    }

    function getAwayGames() {
        return $this->awayGames;
    }

    function getClub() {
        return $this->club;
    }

    function getCompetition() {
        return $this->competition;
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

    function setHomeGames($homeGames) {
        $this->homeGames = $homeGames;
    }

    function setAwayGames($awayGames) {
        $this->awayGames = $awayGames;
    }

    function setClub($club) {
        $this->club = $club;
    }

    function setCompetition($competition) {
        $this->competition = $competition;
    }

    function getFullName() {
        return $this->surName . ' ' . ($this->lastNamePrefix ? $this->lastNamePrefix . ' ' : '') . $this->lastName;
    }

    function getFullNameShortLastName() {
        return $this->surName . ' ' . ($this->lastNamePrefix ? $this->lastNamePrefix . ' ' : '') . substr($this->lastName, 0, 1) . '.';
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getPlayerImage()
    {
        return $this->playerImage;
    }

    /**
     * @param mixed $playerImage
     */
    public function setPlayerImage($playerImage): void
    {
        $this->playerImage = $playerImage;
    }

    public function getAllGames() {
        $awayGames = $this->awayGames;
        $homeGames = $this->homeGames;

        $allGames = array_merge($awayGames->toArray(), $homeGames->toArray());

        return $allGames;
    }

}
