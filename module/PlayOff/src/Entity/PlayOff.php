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
    private $id;

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
     * Many features have one product. This is the owning side.
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

}
