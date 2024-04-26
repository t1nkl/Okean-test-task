<?php

namespace Tests\Feature;

use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class HealthCheckControllerTest extends TestCase
{
    public function test_the_application_returns_a_unsuccessful_response(): void
    {
        $response = $this->get(route('api.v1.health_check.index'));
        $response->assertStatus(ResponseAlias::HTTP_BAD_REQUEST);
    }

    public function test_the_application_returns_a_fail_response_with_uuid(): void
    {
        $response = $this->get(route('api.v1.health_check.index'), ['X-Owner' => Uuid::uuid4()]);
        $response->assertStatus(ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
    }
}
