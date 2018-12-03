<?php

namespace Club\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;
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
     * @Annotation\Options({
     * "label": "Name",
     * "label_attributes": {"class": "col-lg-4 col-md-4 col-sm-4 col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "placeholder":"Name"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Annotation\Options({
     * "label": "City",
     * "label_attributes": {"class": "col-lg-4 col-md-4 col-sm-4 col-form-label"}
     * })
     * @Annotation\Attributes({"class":"form-control", "placeholder":"City"})
     */
    private $city;

    /**
     * One language have One Image.
     * @ORM\OneToOne(targetEntity="UploadImages\Entity\Image")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $clubImage;

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

    /**
     * @return mixed
     */
    public function getClubImage()
    {
        return $this->clubImage;
    }

    /**
     * @param mixed $clubImage
     */
    public function setClubImage($clubImage): void
    {
        $this->clubImage = $clubImage;
    }




}