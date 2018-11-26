<?php

namespace Result\Service;

interface ResultServiceInterface {

    /**
     *
     * Get array of items
     *
     * @return      array
     *
     */
    public function getItems();
    /**
     *
     * Get item object by on id
     *
     * @param       id  $id The id to fetch the item from the database
     * @return      object
     *
     */
    public function getHomeItem($id);
    
        /**
     *
     * Get item object by on id
     *
     * @param       id  $id The id to fetch the item from the database
     * @return      object
     *
     */
    public function getAwayItem($id);

    /**
     *
     * Get array of items
     * @var $searchString string to search for
     *
     * @return      array
     *
     */
    public function searchItems($searchString);

    /**
     *
     * Create form of an object
     *
     * @param       item $item object
     * @return      form
     *
     */
    public function createHomeForm($item);
        /**
     *
     * Create form of an object
     *
     * @param       item $item object
     * @return      form
     *
     */
    public function createAwayForm($item);
    /**
     *
     * Create a new item object
     * @return      object
     *
     */
    public function newHomeItem();

    /**
     *
     * Create a new item object
     * @return      object
     *
     */
    public function newAwayItem();
    
    /**
     *
     * Save a item to the database
     * @param       item $item object
     * @param       user $user object
     * @return      void
     *
     */
    public function saveItem($item);

    /**
     *
     * Update a item in database
     * @param       item $item object
     * @param       user $user object
     * @return      void
     *
     */
    public function updateItem($item);

    /**
     *
     * Save a item to database
     * @param       item $item object
     * @return      void
     *
     */
    public function storeItem($item);

    /**
     *
     * Delete a item from the database
     * @param       item $item object
     * @return      void
     *
     */
    public function deleteItem($item);
}
