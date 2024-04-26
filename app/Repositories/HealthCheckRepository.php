<?php

namespace App\Repositories;

use App\Models\HealthCheck;

final class HealthCheckRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return HealthCheck::class;
    }
}
