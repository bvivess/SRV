<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Role;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $password = Hash::make('12345678');
        $role_id = Role::where('name', 'visitant')->value('id');
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();
        // email a partir del nom i llinatges, evitant duplicats
        $emailBase = Str::ascii(strtolower($firstName . '.' . $lastName));
        $email = $emailBase . '@abc.com';
        $i = 1;
        while (User::where('email', $email)->exists()) {
            $email = $emailBase . $i++ . '@abc.com';
        }
        return [
            'name' => $firstName,
            'lastname' => $lastName,
            'dni' => fake()->unique()->regexify('[0-9]{8}[A-Z]'),
            'email' => $email,
            'phone' => fake()->phoneNumber(),
            'email_verified_at' => now(),
            'password' => $password,
            'role_id' => $role_id,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
