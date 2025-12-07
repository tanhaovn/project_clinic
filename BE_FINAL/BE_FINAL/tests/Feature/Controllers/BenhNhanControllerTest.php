<?php

namespace Tests\Feature;

use App\Models\BenhNhan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class BenhNhanControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_get_profile_success()
    {
        // Tạo user
        $user = BenhNhan::factory()->create();

        // Tạo token sanctum
        $this->actingAs($user, 'sanctum');

        // Gọi API
        $response = $this->get('/api/benh-nhan/profile');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'message' => 'Lấy dữ liệu profile thành công'
                 ]);
    }

    /** @test */
    public function test_login_benh_nhan_success()
    {
        $password = '123456';
        $user = BenhNhan::factory()->create([
            'password' => Hash::make($password),
            'is_active' => 1
        ]);

        $response = $this->postJson('/api/benh-nhan/login', [
            'email' => $user->email,
            'password' => $password
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'message' => 'Đăng nhập thành công',
                 ]);

        $this->assertArrayHasKey('token', $response->json());
    }

    /** @test */
    public function test_change_password_success()
    {
        $user = BenhNhan::factory()->create([
            'password' => Hash::make('oldpass')
        ]);

        $this->actingAs($user, 'sanctum');

        $response = $this->postJson('/api/benh-nhan/change-password', [
            'password' => 'oldpass',
            'new_password' => 'newpass123'
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'message' => 'Đã đổi mật khẩu thành công'
                 ]);

        $this->assertTrue(Hash::check('newpass123', $user->fresh()->password));
    }
}
