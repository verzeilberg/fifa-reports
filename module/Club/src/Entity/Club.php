<?php

namespace Club\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Application\Traits\SoftDeleteableEntity;
use Application\Traits\TimestampableEntity;

/**
 * @ORM\Entity()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 * @ORM\Table(name="club")
 */
class Club
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
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity="Player\Entity\Player", mappedBy="club")
     */
    private $player;
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getCity() {
        return $this->city;
    }

    function getPlayer() {
        return $this->player;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setCity($city) {
        $this->city = $city;
    }

    function setPlayer($player) {
        $this->player = $player;
    }


}