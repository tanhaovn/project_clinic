<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ChucVu;
use App\Models\PhanQuyen;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChucVuControllerTest extends TestCase
{
    use RefreshDatabase;

    // Hàm dùng nhiều lần để tạo user + quyền
    private function actingAsAuthorizedUser()
    {
        $user = User::factory()->create([
            'id_chuc_vu' => 1, // chức vụ test
        ]);

        // Gán quyền id_chuc_nang = 2
        PhanQuyen::create([
            'id_chuc_vu' => 1,
            'id_chuc_nang' => 2,
        ]);

        return $this->actingAs($user, 'sanctum');
    }

    /** @test */
    public function it_can_get_chuc_vu_list()
    {
        $this->actingAsAuthorizedUser();

        ChucVu::factory()->count(3)->create();

        $res = $this->get('/api/chuc-vu/get-data');

        $res->assertStatus(200);
        $this->assertCount(3, $res->json('data'));
    }

    /** @test */
    public function it_can_create_chuc_vu()
    {
        $this->actingAsAuthorizedUser();

        $payload = [
            'ten_chuc_vu' => 'Trưởng phòng',
        ];

        $res = $this->post('/api/chuc-vu/create', $payload);

        $res->assertStatus(200)
            ->assertJson([
                'status' => true,
            ]);

        $this->assertDatabaseHas('chuc_vus', [
            'ten_chuc_vu' => 'Trưởng phòng'
        ]);
    }

    /** @test */
    public function it_can_update_chuc_vu()
    {
        $this->actingAsAuthorizedUser();

        $cv = ChucVu::factory()->create();

        $payload = [
            'id' => $cv->id,
            'ten_chuc_vu' => 'Chức vụ mới'
        ];

        $res = $this->post('/api/chuc-vu/update', $payload);

        $res->assertStatus(200);

        $this->assertDatabaseHas('chuc_vus', [
            'id' => $cv->id,
            'ten_chuc_vu' => 'Chức vụ mới'
        ]);
    }

    /** @test */
    public function it_can_delete_chuc_vu()
    {
        $this->actingAsAuthorizedUser();

        $cv = ChucVu::factory()->create();

        $res = $this->post('/api/chuc-vu/delete', [
            'id' => $cv->id
        ]);

        $res->assertStatus(200);

        $this->assertDatabaseMissing('chuc_vus', [
            'id' => $cv->id
        ]);
    }

    /** @test */
    public function it_can_change_status()
    {
        $this->actingAsAuthorizedUser();

        $cv = ChucVu::factory()->create([
            'tinh_trang' => 1,
        ]);

        $res = $this->post('/api/chuc-vu/change-status', [
            'id' => $cv->id,
            'tinh_trang' => 0
        ]);

        $res->assertStatus(200);

        $this->assertDatabaseHas('chuc_vus', [
            'id' => $cv->id,
            'tinh_trang' => 0
        ]);
    }

    /** @test */
    public function it_can_search_chuc_vu()
    {
        $this->actingAsAuthorizedUser();

        ChucVu::factory()->create(['ten_chuc_vu' => 'Bác sĩ']);
        ChucVu::factory()->create(['ten_chuc_vu' => 'Y tá']);

        $res = $this->get('/api/chuc-vu/search?noi_dung_tim_kiem=Bác');

        $res->assertStatus(200);
        $this->assertCount(1, $res->json('data'));
    }
}

