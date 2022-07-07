<?php

namespace Tests\Feature\API;

use Tests\TestCase;

/**
 * Class WorkOrderTest
 *
 * @author  <feras.bbm@gmail.com>
 * @package Tests\Feature\API
 */
class WorkOrderTest extends TestCase
{
    /**
     * @test
     * @return void
     * @author <ferasbbm>
     */
    public function apiIsAccessible()
    {
        $this->json('get', 'api/v1/test-is-accessible')
            ->assertStatus(200);
    }

}
