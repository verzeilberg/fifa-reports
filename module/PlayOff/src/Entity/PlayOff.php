<?php

namespace PlayOff\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Zend\Form\Annotation;
use Application\Traits\SoftDeleteableEntity;
use Application\Traits\TimestampableEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 * @ORM\Table(name="play_off")
 */
class PlayOff {

    use SoftDeleteableEntity;
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false, name="name")
     * @Annotation\Options({
     * "label": "Name",
     * "label_attributes": {"class": "col-lg-4 col-md-4 col-sm-4 col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "placeholder":"Name"})
     */
    public $name;

    /**
     * Many Playoff's have one season. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Season\Entity\Season", inversedBy="playOffs")
     * @ORM\JoinColumn(name="season_id", referencedColumnName="id")
     */
    private $season;

    /**
     * Many Playoffs have Many Competitions.
     * @ORM\ManyToMany(targetEntity="Competition\Entity\Competition", mappedBy="playOffs")
     */
    private $competitions;

    /**
     * Many playoff have one play off type. This is the owning side.
     * @ORM\ManyToOne(targetEntity="PlayOffType", inversedBy="playOffs")
     * @ORM\JoinColumn(name="play_off_type_id", referencedColumnName="id")
     */
    private $playOffType;

    public function __construct() {
        $this->competitions = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param mixed $season
     */
    public function setSeason($season): void
    {
        $this->season = $season;
    }

    /**
     * @return mixed
     */
    public function getCompetitions()
    {
        return $this->competitions;
    }

    /**
     * @param mixed $competitions
     */
    public function setCompetitions($competitions): void
    {
        $this->competitions = $competitions;
    }

    /**
     * @return mixed
     */
    public function getPlayOffType()
    {
        return $this->playOffType;
    }

    /**
     * @param mixed $playOffType
     */
    public function setPlayOffType($playOffType): void
    {
        $this->playOffType = $playOffType;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }



}
