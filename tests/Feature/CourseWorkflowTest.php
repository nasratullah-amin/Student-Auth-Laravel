<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CourseWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_guest_is_redirected_to_login_from_dashboard(): void
    {
        $this->get(route('dashboard'))->assertRedirect(route('login'));
    }

    public function test_a_user_can_register_and_password_is_hashed(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Test Student',
            'email' => 'STUDENT@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('login'));

        $user = User::where('email', 'student@example.com')->firstOrFail();
        $this->assertTrue(Hash::check('password123', $user->password));
        $this->assertNotSame('password123', $user->password);
    }

    public function test_a_registered_user_can_log_in_and_log_out(): void
    {
        $user = User::factory()->create([
            'email' => 'student@example.com',
            'password' => Hash::make('password123'),
        ]);

        $this->post(route('login.store'), [
            'email' => 'STUDENT@example.com',
            'password' => 'password123',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);

        $this->post(route('logout'))->assertRedirect(route('login'));
        $this->assertGuest();
    }

    public function test_a_user_can_create_view_update_and_delete_a_course(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->post(route('courses.store'), $this->validCourseData())
            ->assertRedirect(route('dashboard'));

        $course = Course::query()->where('user_id', $user->id)->firstOrFail();
        $this->assertSame('CS101', $course->course_code);
        $this->assertSame(3, $course->credit_hours);

        $this->get(route('courses.show', $course))->assertOk();
        $this->get(route('courses.edit', $course))->assertOk();

        $this->put(route('courses.update', $course), $this->validCourseData([
            'course_code' => 'cs102',
            'course_name' => 'Updated Programming',
        ]))->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('courses', [
            'id' => $course->id,
            'user_id' => $user->id,
            'course_code' => 'CS102',
            'course_name' => 'Updated Programming',
        ]);

        $this->delete(route('courses.destroy', $course))
            ->assertRedirect(route('dashboard'));

        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
    }

    public function test_a_user_cannot_view_or_modify_another_users_course(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $course = Course::create($this->validCourseData([
            'user_id' => $owner->id,
        ]));

        $this->actingAs($otherUser);

        $this->get(route('courses.show', $course))->assertNotFound();
        $this->get(route('courses.edit', $course))->assertNotFound();
        $this->put(route('courses.update', $course), $this->validCourseData())
            ->assertNotFound();
        $this->delete(route('courses.destroy', $course))->assertNotFound();

        $this->assertDatabaseHas('courses', ['id' => $course->id, 'user_id' => $owner->id]);
    }

    public function test_course_code_is_unique_per_user_and_normalized(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->post(route('courses.store'), $this->validCourseData([
            'course_code' => ' cs101 ',
        ]))->assertRedirect(route('dashboard'));

        $this->from(route('dashboard'))
            ->post(route('courses.store'), $this->validCourseData([
                'course_code' => 'CS101',
            ]))
            ->assertSessionHasErrors('course_code');

        $this->assertSame(1, Course::where('user_id', $user->id)->count());
    }

    public function test_course_validation_rejects_invalid_credit_hours_and_semester(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->from(route('dashboard'))
            ->post(route('courses.store'), $this->validCourseData([
                'credit_hours' => 0,
                'semester' => 'Winter 2026',
            ]))
            ->assertSessionHasErrors(['credit_hours', 'semester']);

        $this->assertDatabaseCount('courses', 0);
    }

    private function validCourseData(array $overrides = []): array
    {
        return array_merge([
            'course_code' => 'cs101',
            'course_name' => 'Introduction to Programming',
            'credit_hours' => 3,
            'semester' => 'Fall 2026',
        ], $overrides);
    }
}
