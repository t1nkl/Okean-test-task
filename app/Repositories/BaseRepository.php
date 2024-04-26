<?php

namespace App\Repositories;

use ErrorException;
use Exception;
use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Throwable;

abstract class BaseRepository
{
    protected Model $model;

    /**
     * @param Application $app
     *
     * @throws Exception
     */
    public function __construct(protected Application $app)
    {
        $this->makeModel();
    }

    /**
     * Make Model instance.
     *
     * @return Model
     * @throws RuntimeException
     * @throws BindingResolutionException
     */
    public function makeModel(): Model
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new RuntimeException(
                "Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model"
            );
        }

        return $this->model = $model;
    }

    /**
     * Configure the Model.
     *
     * @return string
     */
    abstract public function model(): string;

    /**
     * Save the model to the database within a transaction.
     *
     * @param array $attributes
     * @return Model
     * @throws ErrorException
     */
    public function create(array $attributes = []): Model
    {
        $model = $this->model->newInstance($attributes);

        try {
            $model->saveOrFail($attributes);

            return $model;
        } catch (Throwable|Exception $e) {
            Log::critical($e->getMessage());

            throw new ErrorException($e->getMessage());
        }
    }
}
