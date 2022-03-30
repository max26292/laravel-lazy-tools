<?php

namespace Max26292\LaravelLazyTools\Repository\RepositoryTrait;

trait SearchTrait
{
    public function getAllWithSearch(string $searchString)
    {
        return $this->model->search($searchString)->get();
    }
}
