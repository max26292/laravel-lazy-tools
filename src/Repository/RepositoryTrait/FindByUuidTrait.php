<?php

namespace Max26292\LaravelLazyTools\Repository\RepositoryTrait;

trait FindByUuidTrait
{
    public function find($id, $col = ['*'])
    {
        return $this->model
            ->where('slug', $id)
            ->first();
    }
}
