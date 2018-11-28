<?php

namespace DoctrineORMModule\Proxy\__CG__\Competition\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Competition extends \Competition\Entity\Competition implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Competition\\Entity\\Competition' . "\0" . 'id', '' . "\0" . 'Competition\\Entity\\Competition' . "\0" . 'awayHomeGame', '' . "\0" . 'Competition\\Entity\\Competition' . "\0" . 'name', '' . "\0" . 'Competition\\Entity\\Competition' . "\0" . 'seasons', '' . "\0" . 'Competition\\Entity\\Competition' . "\0" . 'games', '' . "\0" . 'Competition\\Entity\\Competition' . "\0" . 'players', '' . "\0" . 'Competition\\Entity\\Competition' . "\0" . 'homeGameResults', '' . "\0" . 'Competition\\Entity\\Competition' . "\0" . 'awayGameResults', 'deletedAt', 'createdAt', 'updatedAt'];
        }

        return ['__isInitialized__', '' . "\0" . 'Competition\\Entity\\Competition' . "\0" . 'id', '' . "\0" . 'Competition\\Entity\\Competition' . "\0" . 'awayHomeGame', '' . "\0" . 'Competition\\Entity\\Competition' . "\0" . 'name', '' . "\0" . 'Competition\\Entity\\Competition' . "\0" . 'seasons', '' . "\0" . 'Competition\\Entity\\Competition' . "\0" . 'games', '' . "\0" . 'Competition\\Entity\\Competition' . "\0" . 'players', '' . "\0" . 'Competition\\Entity\\Competition' . "\0" . 'homeGameResults', '' . "\0" . 'Competition\\Entity\\Competition' . "\0" . 'awayGameResults', 'deletedAt', 'createdAt', 'updatedAt'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Competition $proxy) {
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
    public function getName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getName', []);

        return parent::getName();
    }

    /**
     * {@inheritDoc}
     */
    public function getSeasons()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSeasons', []);

        return parent::getSeasons();
    }

    /**
     * {@inheritDoc}
     */
    public function getGames()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGames', []);

        return parent::getGames();
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
    public function setName($name)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setName', [$name]);

        return parent::setName($name);
    }

    /**
     * {@inheritDoc}
     */
    public function setSeasons($seasons)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSeasons', [$seasons]);

        return parent::setSeasons($seasons);
    }

    /**
     * {@inheritDoc}
     */
    public function setGames($games)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGames', [$games]);

        return parent::setGames($games);
    }

    /**
     * {@inheritDoc}
     */
    public function getPlayers()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPlayers', []);

        return parent::getPlayers();
    }

    /**
     * {@inheritDoc}
     */
    public function setPlayers($players)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPlayers', [$players]);

        return parent::setPlayers($players);
    }

    /**
     * {@inheritDoc}
     */
    public function getAwayHomeGame()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAwayHomeGame', []);

        return parent::getAwayHomeGame();
    }

    /**
     * {@inheritDoc}
     */
    public function setAwayHomeGame($awayHomeGame)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAwayHomeGame', [$awayHomeGame]);

        return parent::setAwayHomeGame($awayHomeGame);
    }

    /**
     * {@inheritDoc}
     */
    public function getHomeGameResults()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHomeGameResults', []);

        return parent::getHomeGameResults();
    }

    /**
     * {@inheritDoc}
     */
    public function getAwayGameResults()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAwayGameResults', []);

        return parent::getAwayGameResults();
    }

    /**
     * {@inheritDoc}
     */
    public function setHomeGameResults($homeGameResults)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHomeGameResults', [$homeGameResults]);

        return parent::setHomeGameResults($homeGameResults);
    }

    /**
     * {@inheritDoc}
     */
    public function setAwayGameResults($awayGameResults)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAwayGameResults', [$awayGameResults]);

        return parent::setAwayGameResults($awayGameResults);
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
