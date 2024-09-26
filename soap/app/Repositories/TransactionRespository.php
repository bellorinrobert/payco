<?php 

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRespository implements RepositoryInterface {
    public function getAll(): \Illuminate\Database\Eloquent\Collection{
        return Transaction::all();
    }

    public function getById($id): mixed {
        return Transaction::find($id);
    }

    public function create(array $data): mixed {
        return Transaction::create($data);
    }

    public function update($id, array $data): mixed {
        return null;
    }

    public function delete($id): bool {
        return false;
    }
}