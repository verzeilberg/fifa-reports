<?php

namespace DoctrineORMModule\Proxy\__CG__\Player\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Player extends \Player\Entity\Player implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'id', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'surName', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'lastNamePrefix', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'lastName', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'screenName', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'homeGames', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'awayGames', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'user', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'club', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'competition', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'playerImage', 'deletedAt', 'createdAt', 'updatedAt'];
        }

        return ['__isInitialized__', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'id', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'surName', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'lastNamePrefix', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'lastName', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'screenName', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'homeGames', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'awayGames', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'user', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'club', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'competition', '' . "\0" . 'Player\\Entity\\Player' . "\0" . 'playerImage', 'deletedAt', 'createdAt', 'updatedAt'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Player $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getSurName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSurName', []);

        return parent::getSurName();
    }

    /**
     * {@inheritDoc}
     */
    public function getLastNamePrefix()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastNamePrefix', []);

        return parent::getLastNamePrefix();
    }

    /**
     * {@inheritDoc}
     */
    public function getLastName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastName', []);

        return parent::getLastName();
    }

    /**
     * {@inheritDoc}
     */
    public function getScreenName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getScreenName', []);

        return parent::getScreenName();
    }

    /**
     * {@inheritDoc}
     */
    public function getHomeGames()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHomeGames', []);

        return parent::getHomeGames();
    }

    /**
     * {@inheritDoc}
     */
    public function getAwayGames()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAwayGames', []);

        return parent::getAwayGames();
    }

    /**
     * {@inheritDoc}
     */
    public function getClub()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getClub', []);

        return parent::getClub();
    }

    /**
     * {@inheritDoc}
     */
    public function getCompetition()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCompetition', []);

        return parent::getCompetition();
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', [$id]);

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function setSurName($surName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSurName', [$surName]);

        return parent::setSurName($surName);
    }

    /**
     * {@inheritDoc}
     */
    public function setLastNamePrefix($lastNamePrefix)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLastNamePrefix', [$lastNamePrefix]);

        return parent::setLastNamePrefix($lastNamePrefix);
    }

    /**
     * {@inheritDoc}
     */
    public function setLastName($lastName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLastName', [$lastName]);

        return parent::setLastName($lastName);
    }

    /**
     * {@inheritDoc}
     */
    public function setScreenName($screenName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setScreenName', [$screenName]);

        return parent::setScreenName($screenName);
    }

    /**
     * {@inheritDoc}
     */
    public function setHomeGames($homeGames)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHomeGames', [$homeGames]);

        return parent::setHomeGames($homeGames);
    }

    /**
     * {@inheritDoc}
     */
    public function setAwayGames($awayGames)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAwayGames', [$awayGames]);

        return parent::setAwayGames($awayGames);
    }

    /**
     * {@inheritDoc}
     */
    public function setClub($club)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setClub', [$club]);

        return parent::setClub($club);
    }

    /**
     * {@inheritDoc}
     */
    public function setCompetition($competition)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCompetition', [$competition]);

        return parent::setCompetition($competition);
    }

    /**
     * {@inheritDoc}
     */
    public function getFullName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFullName', []);

        return parent::getFullName();
    }

    /**
     * {@inheritDoc}
     */
    public function getFullNameShortLastName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFullNameShortLastName', []);

        return parent::getFullNameShortLastName();
    }

    /**
     * {@inheritDoc}
     */
    public function getUser()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUser', []);

        return parent::getUser();
    }

    /**
     * {@inheritDoc}
     */
    public function setUser($user): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUser', [$user]);

        parent::setUser($user);
    }

    /**
     * {@inheritDoc}
     */
    public function getPlayerImage()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPlayerImage', []);

        return parent::getPlayerImage();
    }

    /**
     * {@inheritDoc}
     */
    public function setPlayerImage($playerImage): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPlayerImage', [$playerImage]);

        parent::setPlayerImage($playerImage);
    }

    /**
     * {@inheritDoc}
     */
    public function getAllGames()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAllGames', []);

        return parent::getAllGames();
    }

    /**
     * {@inheritDoc}
     */
    public function setDeletedAt(\DateTime $deletedAt = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDeletedAt', [$deletedAt]);

        return parent::setDeletedAt($deletedAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getDeletedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDeletedAt', []);

        return parent::getDeletedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function isDeleted()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isDeleted', []);

        return parent::isDeleted();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedAt(\DateTime $createdAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedAt', [$createdAt]);

        return parent::setCreatedAt($createdAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedAt', []);

        return parent::getCreatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdatedAt', [$updatedAt]);

        return parent::setUpdatedAt($updatedAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdatedAt', []);

        return parent::getUpdatedAt();
    }

}
