<?php

namespace LaraToolkit\Abstractions;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    protected string $modelClass = Model::class;

    /**
     * Retorna uma instância vazia do modelo.
     *
     * @return Model
     */
    public function getEmptyModel(): Model
    {
        return new $this->modelClass;
    }

    /**
     * Retorna um modelo pelo ID.
     *
     * @param int $id
     * @return Model|null
     */
    public function getById(int $id): ?Model
    {
        $model = $this->modelClass::query()->where('id', $id)->first();

        return $model;
    }

    /**
     * Criar um novo modelo.
     *
     * @param array $data
     * @return Model
     */
    public function insert(array $data): Model
    {
        $model = $this->getEmptyModel();
        $model->fill($data);
        $model->save();

        return $model;
    }

    /**
     * Salvar um modelo.
     *
     * @param Model $model
     * @return Model
     */
    public function save(Model $model): Model
    {
        $model->save();

        return $model;
    }

    /**
     * Atualizar um modelo.
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function update(Model $model, array $data): Model
    {
        $model->update($data);

        return $model;
    }

    /**
     * Remover uma Collection de Modelos
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        $model = $this->getEmptyModel();
        return $model->all();
    }
}