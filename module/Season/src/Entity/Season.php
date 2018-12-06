<?php

namespace Season\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Zend\Form\Annotation;
use Application\Traits\SoftDeleteableEntity;
use Application\Traits\TimestampableEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 * @ORM\Table(name="season")
 */
class Season
{

    use SoftDeleteableEntity;

    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=false, name="start_date")
     * @Annotation\Options({
     * "label": "Start date",
     * "label_attributes": {"class": "col-lg-4 col-md-4 col-sm-4 col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control datepicker", "autocomplete":"off"})
     */
    private $startDate;

    /**
     * @ORM\Column(type="date", nullable=false, name="end_date")
     * @Annotation\Options({
     * "label": "End date",
     * "label_attributes": {"class": "col-lg-4 col-md-4 col-sm-4 col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control datepicker", "autocomplete":"off"})
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", nullable=true, name="name")
     * @Annotation\Options({
     * "label": "Name",
     * "label_attributes": {"class": "col-lg-4 col-md-4 col-sm-4 col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "placeholder":"Name"})
     */
    private $name;

    /**
     * @ORM\Column(type="integer", length=1, nullable=false, name="lock_play_schedule")
     * @Annotation\Type("Zend\Form\Element\Checkbox")
     * @Annotation\Options({
     * "label": "Lock play schedule?",
     * "label_attributes": {"class": "col-lg-4 col-md-4 col-sm-4 col-form-label", "for":"lockPlaySchedule"}
     * })
     * @Annotation\Attributes({"class":"", "id":"lockPlaySchedule"})
     */
    private $lockPlaySchedule = false;

    /**
     * @ORM\Column(type="integer", length=1, nullable=false, name="play_off")
     * @Annotation\Type("Zend\Form\Element\Checkbox")
     * @Annotation\Options({
     * "label": "Play offs?",
     * "label_attributes": {"class": "col-lg-4 col-md-4 col-sm-4 col-form-label", "for":"playOff"}
     * })
     * @Annotation\Attributes({"class":"", "id":"playOff"})
     */
    private $playOff = false;

    /**
     * @ORM\OneToMany(targetEntity="Game\Entity\Game", mappedBy="season")
     * @ORM\OrderBy({"sortOrder" = "ASC"})
     */
    private $games;

    /**
     * @ORM\ManyToMany(targetEntity="Competition\Entity\Competition", inversedBy="seasons")
     * @ORM\JoinTable(name="seasons_competitions")
     * @Annotation\Type("DoctrineModule\Form\Element\ObjectMultiCheckbox")
     * @Annotation\Required(false)
     * @Annotation\AllowEmpty
     * @Annotation\Options({
     * "target_class":"Competition\Entity\Competition",
     * "property": "name",
     * "label": "Competitions",
     * "label_attributes": {"class": "col-lg-3 col-md-3 col-sm-3 mb-1 col-form-label"},
     * "find_method":{"name": "findBy","params": {"criteria":{"deletedAt": null},"orderBy":{"name": "ASC"}}}
     * })
     * @Annotation\Attributes({"class":"inputChecked"})
     */
    private $competitions;

    /**
     * @ORM\OneToMany(targetEntity="Result\Entity\Result", mappedBy="season")
     */
    private $gameResults;

    /**
     * One Season has many Playoff's. This is the inverse side.
     * @ORM\OneToMany(targetEntity="PlayOff\Entity\PlayOff", mappedBy="season")
     */
    private $playOffs;

    public function __construct()
    {
        $this->competitions = new ArrayCollection();
        $this->games = new ArrayCollection();
        $this->gameResults = new ArrayCollection();
        $this->playOffs = new ArrayCollection();
    }

    public function addCompetitions(ArrayCollection $competition)
    {
        foreach ($competition as $competition) {
            if (!$this->competitions->contains($competition)) {
                $this->competitions->add($competition);
            }
        }
    }

    public function removeCompetitions(ArrayCollection $competition)
    {
        foreach ($competition as $competition) {
            if ($this->competitions->contains($competition)) {
                $this->competitions->removeElement($competition);
            }
        }
    }

    public function removeAllCompetitions()
    {
        foreach ($this->competitions as $competition) {
            $this->competitions->removeElement($competition);
        }
    }

    function getId()
    {
        return $this->id;
    }

    function getStartDate()
    {
        return $this->startDate;
    }

    function getEndDate()
    {
        return $this->endDate;
    }

    function getName()
    {
        return $this->name;
    }

    function getLockPlaySchedule()
    {
        return $this->lockPlaySchedule;
    }

    function getGames()
    {
        return $this->games;
    }

    function getCompetitions()
    {
        return $this->competitions;
    }

    function getGameResults()
    {
        return $this->gameResults;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function setLockPlaySchedule($lockPlaySchedule)
    {
        $this->lockPlaySchedule = $lockPlaySchedule;
    }

    function setGames($games)
    {
        $this->games = $games;
    }

    function setCompetitions($competitions)
    {
        $this->competitions = $competitions;
    }

    function setGameResults($gameResults)
    {
        $this->gameResults = $gameResults;
    }

    /**
     * @return mixed
     */
    public function getPlayOff()
    {
        return $this->playOff;
    }

    /**
     * @param mixed $playOff
     */
    public function setPlayOff($playOff): void
    {
        $this->playOff = $playOff;
    }

    /**
     * @return mixed
     */
    public function getPlayOffs()
    {
        return $this->playOffs;
    }

    /**
     * @param mixed $playOffs
     */
    public function setPlayOffs($playOffs): void
    {
        $this->playOffs = $playOffs;
    }


}
