<?php

namespace App\Services;

use App\Repositories\HealthCheckRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Predis\Client;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

readonly class HealthCheckService
{
    public function __construct(private HealthCheckRepository $repository)
    {
    }

    /**
     * @return array
     */
    public function check(): array
    {
        $services = [
            'db' => $this->checkDatabase(),
            'cache' => $this->checkRedis(),
        ];

        $status = ResponseAlias::HTTP_OK;
        foreach ($services as $service) {
            if ($service === false) {
                $status = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
                break;
            }
        }

        $this->repository->create([
            'status' => $status,
            'services' => $status !== ResponseAlias::HTTP_OK ? $services : null,
        ]);

        return [
            'status' => $status,
            'services' => $services,
        ];
    }

    /**
     * @return bool
     */
    private function checkDatabase(): bool
    {
        try {
            DB::connection()->getPdo();

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * @return bool
     */
    private function checkRedis(): bool
    {
        $connection = config('database.redis.default');

        try {
            $redis = new Client($connection);
            $redis->ping();

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }
}
