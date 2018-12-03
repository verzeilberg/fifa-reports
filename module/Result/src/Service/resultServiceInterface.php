<?php

namespace Result\Service;

interface ResultServiceInterface {

    /**
     * Constructor.
     */
    public function __construct($entityManager);

    /**
     * Get result voor specific season
     * 
     * @var $seasonId id of that specific season
     *
     * @return array
     */
    public function getResultsBySeason($seasonId);

}
