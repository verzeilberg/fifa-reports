<?php

namespace DoctrineORMModule\Proxy\__CG__\Result\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Result extends \Result\Entity\Result implements \Doctrine\ORM\Proxy\Proxy
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
    public static $lazyPropertiesDefaults = ['homeAway' => NULL, 'goals' => 0, 'points' => 1, 'shotOnTarget' => 0, 'totalShots' => 0, 'fouls' => 0, 'offside' => 0, 'possession' => 50, 'corners' => 0, 'tackles' => 0, 'yellowCards' => 0, 'redCards' => 0, 'injuries' => 0, 'shotAccuracy' => 0, 'passAccuracy' => 0];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {
        unset($this->homeAway, $this->goals, $this->points, $this->shotOnTarget, $this->totalShots, $this->fouls, $this->offside, $this->possession, $this->corners, $this->tackles, $this->yellowCards, $this->redCards, $this->injuries, $this->shotAccuracy, $this->passAccuracy);

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }

    /**
     * 
     * @param string $name
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->__getLazyProperties())) {
            $this->__initializer__ && $this->__initializer__->__invoke($this, '__get', [$name]);

            return $this->$name;
        }

        trigger_error(sprintf('Undefined property: %s::$%s', __CLASS__, $name), E_USER_NOTICE);
    }

    /**
     * 
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->__getLazyProperties())) {
            $this->__initializer__ && $this->__initializer__->__invoke($this, '__set', [$name, $value]);

            $this->$name = $value;

            return;
        }

        $this->$name = $value;
    }

    /**
     * 
     * @param  string $name
     * @return boolean
     */
    public function __isset($name)
    {
        if (array_key_exists($name, $this->__getLazyProperties())) {
            $this->__initializer__ && $this->__initializer__->__invoke($this, '__isset', [$name]);

            return isset($this->$name);
        }

        return false;
    }

    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'Result\\Entity\\Result' . "\0" . 'id', 'homeAway', 'goals', 'points', 'shotOnTarget', 'totalShots', 'fouls', 'offside', 'possession', 'corners', 'tackles', 'yellowCards', 'redCards', 'injuries', 'shotAccuracy', 'passAccuracy', '' . "\0" . 'Result\\Entity\\Result' . "\0" . 'player', '' . "\0" . 'Result\\Entity\\Result' . "\0" . 'competition', '' . "\0" . 'Result\\Entity\\Result' . "\0" . 'season'];
        }

        return ['__isInitialized__', '' . "\0" . 'Result\\Entity\\Result' . "\0" . 'id', '' . "\0" . 'Result\\Entity\\Result' . "\0" . 'player', '' . "\0" . 'Result\\Entity\\Result' . "\0" . 'competition', '' . "\0" . 'Result\\Entity\\Result' . "\0" . 'season'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Result $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

            unset($this->homeAway, $this->goals, $this->points, $this->shotOnTarget, $this->totalShots, $this->fouls, $this->offside, $this->possession, $this->corners, $this->tackles, $this->yellowCards, $this->redCards, $this->injuries, $this->shotAccuracy, $this->passAccuracy);
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
    public function getHomeAway()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHomeAway', []);

        return parent::getHomeAway();
    }

    /**
     * {@inheritDoc}
     */
    public function getGoals()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGoals', []);

        return parent::getGoals();
    }

    /**
     * {@inheritDoc}
     */
    public function getPoints()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPoints', []);

        return parent::getPoints();
    }

    /**
     * {@inheritDoc}
     */
    public function getShotOnTarget()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getShotOnTarget', []);

        return parent::getShotOnTarget();
    }

    /**
     * {@inheritDoc}
     */
    public function getTotalShots()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTotalShots', []);

        return parent::getTotalShots();
    }

    /**
     * {@inheritDoc}
     */
    public function getFouls()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFouls', []);

        return parent::getFouls();
    }

    /**
     * {@inheritDoc}
     */
    public function getOffside()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOffside', []);

        return parent::getOffside();
    }

    /**
     * {@inheritDoc}
     */
    public function getPossession()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPossession', []);

        return parent::getPossession();
    }

    /**
     * {@inheritDoc}
     */
    public function getCorners()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCorners', []);

        return parent::getCorners();
    }

    /**
     * {@inheritDoc}
     */
    public function getTackles()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTackles', []);

        return parent::getTackles();
    }

    /**
     * {@inheritDoc}
     */
    public function getYellowCards()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getYellowCards', []);

        return parent::getYellowCards();
    }

    /**
     * {@inheritDoc}
     */
    public function getRedCards()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRedCards', []);

        return parent::getRedCards();
    }

    /**
     * {@inheritDoc}
     */
    public function getInjuries()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getInjuries', []);

        return parent::getInjuries();
    }

    /**
     * {@inheritDoc}
     */
    public function getShotAccuracy()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getShotAccuracy', []);

        return parent::getShotAccuracy();
    }

    /**
     * {@inheritDoc}
     */
    public function getPassAccuracy()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPassAccuracy', []);

        return parent::getPassAccuracy();
    }

    /**
     * {@inheritDoc}
     */
    public function getPlayer()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPlayer', []);

        return parent::getPlayer();
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
    public function getSeason()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSeason', []);

        return parent::getSeason();
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
    public function setHomeAway($homeAway)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHomeAway', [$homeAway]);

        return parent::setHomeAway($homeAway);
    }

    /**
     * {@inheritDoc}
     */
    public function setGoals($goals)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGoals', [$goals]);

        return parent::setGoals($goals);
    }

    /**
     * {@inheritDoc}
     */
    public function setPoints($points)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPoints', [$points]);

        return parent::setPoints($points);
    }

    /**
     * {@inheritDoc}
     */
    public function setShotOnTarget($shotOnTarget)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setShotOnTarget', [$shotOnTarget]);

        return parent::setShotOnTarget($shotOnTarget);
    }

    /**
     * {@inheritDoc}
     */
    public function setTotalShots($totalShots)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTotalShots', [$totalShots]);

        return parent::setTotalShots($totalShots);
    }

    /**
     * {@inheritDoc}
     */
    public function setFouls($fouls)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFouls', [$fouls]);

        return parent::setFouls($fouls);
    }

    /**
     * {@inheritDoc}
     */
    public function setOffside($offside)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOffside', [$offside]);

        return parent::setOffside($offside);
    }

    /**
     * {@inheritDoc}
     */
    public function setPossession($possession)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPossession', [$possession]);

        return parent::setPossession($possession);
    }

    /**
     * {@inheritDoc}
     */
    public function setCorners($corners)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCorners', [$corners]);

        return parent::setCorners($corners);
    }

    /**
     * {@inheritDoc}
     */
    public function setTackles($tackles)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTackles', [$tackles]);

        return parent::setTackles($tackles);
    }

    /**
     * {@inheritDoc}
     */
    public function setYellowCards($yellowCards)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setYellowCards', [$yellowCards]);

        return parent::setYellowCards($yellowCards);
    }

    /**
     * {@inheritDoc}
     */
    public function setRedCards($redCards)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRedCards', [$redCards]);

        return parent::setRedCards($redCards);
    }

    /**
     * {@inheritDoc}
     */
    public function setInjuries($injuries)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setInjuries', [$injuries]);

        return parent::setInjuries($injuries);
    }

    /**
     * {@inheritDoc}
     */
    public function setShotAccuracy($shotAccuracy)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setShotAccuracy', [$shotAccuracy]);

        return parent::setShotAccuracy($shotAccuracy);
    }

    /**
     * {@inheritDoc}
     */
    public function setPassAccuracy($passAccuracy)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPassAccuracy', [$passAccuracy]);

        return parent::setPassAccuracy($passAccuracy);
    }

    /**
     * {@inheritDoc}
     */
    public function setPlayer($player)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPlayer', [$player]);

        return parent::setPlayer($player);
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
    public function setSeason($season)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSeason', [$season]);

        return parent::setSeason($season);
    }

}
