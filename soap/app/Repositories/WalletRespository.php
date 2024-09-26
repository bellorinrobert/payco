<?php 

namespace App\Repositories;

use App\Models\Wallet;

class WalletRespository implements RepositoryInterface {

    public function getAll(): \Illuminate\Database\Eloquent\Collection{
        return Wallet::all();
    }

    public function getById($id): mixed {
        return Wallet::find($id);
    }

    public function create(array $data): mixed {
        return Wallet::create($data);
    }

    public function update($id, array $data): mixed {
        return Wallet::where('id', $id)->update($data);
    }

    public function delete($id): bool {
        return false;
    }

}