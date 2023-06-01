<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;
class UserFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $role = Role::where(Str::lower('role'),'admin')->first();
        return [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '917-965-2009',
            'email_verified_at' => now(),
            'password' => '$2y$10$nJQm3L7wDW.zZ5AfWeHuluOKkACqYCnqbSAqi/fcgczV70hlPPS.u', // Admin123@
            'role_id' => $role->id,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
