<?php

namespace LaraToolkit\Abstractions;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    protected string $modelClass = Model::class;

    public function getEmptyModel(): Model
    {
        return new $this->modelClass;
    }

    public function getById(int $id): ?Model
    {
        $model = $this->modelClass::query()->where('id', $id)->first();

        return $model;
    }

    public function insert(array $data): Model
    {
        $model = $this->getEmptyModel();
        $model->fill($data);
        $model->save();

        return $model;
    }

    public function save(Model $model): Model
    {
        $model->save();

        return $model;
    }

    public function update(Model $model, array $data): Model
    {
        $model->update($data);

        return $model;
    }

    public function getAll(): Collection
    {
        $model = app($this->modelClass);
        return $model->all();
    }
}