<?php

namespace Tests\Feature\API;

use App\User;
use Tests\TestCase;
use Laravel\Passport\Passport;

/**
 * Class AuthTest
 *
 * @author  <feras.bbm@gmail.com>
 * @package Tests\Feature\API
 */
class AuthTest extends TestCase
{
    const DRIVER_EMAIL = 'driver@wmis.com';
    const DRIVER_MOBILE = '0597725085';
    const DRIVER_PASSWORD = 'password';

    /**
     * @return void
     * @author <ferasbbm>
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->withExceptionHandling();

        User::query()
            ->firstOrCreate([
                'email' => self::DRIVER_EMAIL
            ], [
                'first_name' => 'driver',
                'second_name' => 'd',
                'third_name' => 'r',
                'last_name' => 'iver',
                'email' => self::DRIVER_EMAIL,
                'mobile' => self::DRIVER_MOBILE,
                'is_active' => 1,
                'created_by' => 1,
                'password' => bcrypt(self::DRIVER_PASSWORD),
            ]);
    }

    /**
     * @test
     * @return void
     * @author <ferasbbm>
     */
    public function driverCanLogin(): void
    {
        $data = [
            'mobile' => self::DRIVER_MOBILE,
            'password' => self::DRIVER_PASSWORD,
        ];

        $this->json('post', 'api/v1/login', $data)
            ->assertStatus(200);
    }

    /**
     * @test
     * @return void
     * @author <ferasbbm>
     */
    public function driverCanForgetPassword(): void
    {
        $data = [
            'mobile' => self::DRIVER_MOBILE,
        ];

        $this->json('post', '/api/v1/forget-password', $data)
            ->assertStatus(200);
    }

    /**
     * @test
     * @return void
     * @author <ferasbbm>
     */
    public function driverCanVerifyCode(): void
    {
        $user = User::query()->where('mobile', self::DRIVER_MOBILE)->first();

        $data = [
            'mobile' => self::DRIVER_MOBILE,
            'code' => $user->otp
        ];

        $this->json('post', '/api/v1/verify-code', $data)
            ->assertStatus(200);
    }

    /**
     * @test
     * @return void
     * @author <ferasbbm>
     */
    public function driverCanLogout(): void
    {
        Passport::actingAs(
            User::where('email', self::DRIVER_EMAIL)->first()
        );

        $this->json('post', '/api/v1/logout', [])
            ->assertStatus(200);
    }


}
