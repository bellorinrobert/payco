<?php
/**
 * Summary of namespace App\Repositories
 * @author Robert Bellorin <bellorinrobert@gmail.com>
 * @date 2024-09-15
 * 
 */
namespace App\Repositories;

use App\Models\Client;

class ClientRepository implements RepositoryInterface {
    /**
     * Summary of getAll
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): \Illuminate\Database\Eloquent\Collection {
        return Client::all();

    }
    /**
     * Summary of getById
     * @param mixed $id
     * @return mixed
     */
    public function getById($id): mixed {

        return Client::find($id);

    }
    /**
     * Summary of create
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed {
        
        return Client::create($data);

    }
    /**
     * Summary of update
     * @param mixed $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data): mixed {
        return null;
    }
    /**
     * Summary of delete
     * @param mixed $id
     * @return bool
     */
    public function delete($id): bool {
        return false;
    }


}