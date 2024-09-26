<?php 
/**
 * Summary of namespace App\Repositories
 * @author Robert Bellorin <bellorinrobert@gmail.com>
 * @date 2024-09-15
 * 
 */
namespace App\Repositories;
use Illuminate\Database\Eloquent\Collection;

interface RepositoryInterface {
    /**
     * Summary of getAll
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll() : Collection ;
    /**
     * Summary of getById
     * @return mixed
     */
    public function getById($id) : mixed;
    /**
     * Summary of create
     * @param array $data
     * @return mixed
     */
    public function create(array $data) : mixed;
    /**
     * Summary of update
     * @param mixed $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data) : mixed;
    /**
     * Summary of delete
     * @param mixed $id
     * @return void
     */
    public function delete($id) : bool;

}