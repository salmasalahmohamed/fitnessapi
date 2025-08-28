<?php

namespace Tests\Feature;

use App\Models\ClassBooking;
use App\Models\FitnessClass;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClassBookingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_if_user_can_book_class_successfully(): void
    {
        $user=User::factory()->create();
        $this->actingAs($user);
        $fitness=FitnessClass::factory()->create();
        $response = $this->postJson('/api/bookings', [
            'class_id' => $fitness->id
        ]);

        $response->assertStatus(201)->assertJson([
            'user_id' => $user->id,
            'class_id' => $fitness->id
        ]);;
        $this->assertDatabaseHas('class_bookings', [
            'user_id' => $user->id,
            'class_id' => $fitness->id
        ]);    }
    public function test_booking_requires_class_id(){
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson('/api/bookings', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['class_id']);

    }
    public function test_booking_requires_valid_class_id(){
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->postJson('/api/bookings', [
            'class_id' => 999
        ]);

        $response->assertStatus(422);
    }
    public function test_user_cannot_book_full_class(){
        $user = User::factory()->create();
        $this->actingAs($user);
        $fitness=FitnessClass::factory()->create([
            'capacity'=>1,
        ]);
        $otherUser = User::factory()->create();
        ClassBooking::create([
            'user_id' => $otherUser->id,
            'class_id' => $fitness->id
        ]);
        $response = $this->postJson('/api/bookings', [
            'class_id' => $fitness->id
        ]);
        $response->assertStatus(403)->assertJson(['message' => 'Class is full']);

    }
    public function test_user_cannot_book_same_class_twice()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $fitnessClass = FitnessClass::factory()->create([
            'capacity' => 10
        ]);

        ClassBooking::create([
            'user_id' => $user->id,
            'class_id' => $fitnessClass->id
        ]);

        $response = $this->postJson('/api/bookings', [
            'class_id' => $fitnessClass->id
        ]);

        $response->assertStatus(409)
            ->assertJson(['message' => 'Already booked']);
    }

}
