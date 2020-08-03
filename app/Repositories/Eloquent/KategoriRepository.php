<?php

namespace App\Repositories\Eloquent;

use App\Repositories\KategoriRepositoryInterface;
use App\Kategori;
use Illuminate\Http\Request;

class KategoriRepository implements KategoriRepositoryInterface
{
  private $model;
  public function __construct(Kategori $model)
  {
    $this->model = $model;
  }

  public function getAll()
  {
    return $this->model->orderBy('created_at', 'DESC')->paginate(10);
  }

  public function getById($id)
  {
    return $this->model->findById($id);
  }

  public function create(array $attributes)
  {
    return $this->model->create($attributes);
  }

  public function update($id, array $attributes)
  {
    $user = $this->model->findOrFail($id);
    $user->update($attributes);
    return $user;
  }

  public function delete($id)
  {
    $user = $this->model->findOrFail($id);
    $user->delete();
    return $user;
  }
}
