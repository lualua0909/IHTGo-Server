<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 19/5/2018
 * Time: 2:28 PM
 */

namespace App\Repositories;


interface InterfaceRepository
{
    /**
     * Get all
     * @return mixed
     */
    public function getAll();

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * store
     * @param array $attributes
     * @return mixed
     */
    public function store(array $attributes);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);
}