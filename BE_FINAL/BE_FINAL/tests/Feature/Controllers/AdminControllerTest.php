<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\PhanQuyen;
use App\Models\ChuyenKhoa;
use App\Models\LichLamViec;
use App\Models\BacSi;
use Laravel\Sanctum\Sanctum;

class AdminControllerTest extends TestCase
{
    /** @test */
    public function test_lay_gio_lam_viec()
    {
        $response = $this->get('/admin/lay-gio-lam-viec');
        $response->assertStatus(200)
                 ->assertJsonStructure(['status', 'message', 'data']);
    }

    /** @test */
    public function test_get_chuyen_khoa()
    {
        ChuyenKhoa::factory()->count(3)->create();

        $response = $this->get('/admin/chuyen-khoa');
        $response->assertStatus(200)
                 ->assertJsonStructure(['status', 'message', 'data']);
    }

    /** @test */
    public function test_lich_su_kham_benh()
    {
        $response = $this->get('/admin/lich-su-kham/1');
        $response->assertStatus(200);
    }

    /** @test */
    public function test_get_lich_lam_viec()
    {
        $response = $this->get('/admin/lich-lam-viec');
        $response->assertStatus(200)
                 ->assertJsonStructure(['status', 'data', 'bac_si']);
    }

    /** @test */
    public function test_login_admin_that_bai()
    {
        $response = $this->post('/admin/login', [
            'email' => 'sai@gmail.com',
            'password' => '123'
        ]);

        $response->assertJson(['status' => false]);
    }

    /** @test */
    public function test_login_admin_thanh_cong()
    {
        $admin = Admin::factory()->create([
            'password' => bcrypt('123456')
        ]);

        $response = $this->post('/admin/login', [
            'email' => $admin->email,
            'password' => '123456'
        ]);

        $response->assertJson(['status' => true])
                 ->assertJsonStructure(['token']);
    }

    /** @test */
    public function test_get_profile()
    {
        $admin = Admin::factory()->create();
        Sanctum::actingAs($admin, ['*']);

        $response = $this->get('/admin/profile');
        $response->assertStatus(200)
                 ->assertJson(['status' => true]);
    }

    /** @test */
    public function test_update_profile()
    {
        $admin = Admin::factory()->create();
        Sanctum::actingAs($admin, ['*']);

        $response = $this->post('/admin/update-profile', [
            'ho_ten' => 'New Name',
            'email' => $admin->email,
            'so_dien_thoai' => '0123456789',
            'hinh_anh' => 'avatar.png'
        ]);

        $response->assertJson(['status' => true]);
    }

    /** @test */
    public function test_logout_admin()
    {
        $admin = Admin::factory()->create();
        Sanctum::actingAs($admin, ['*']);

        $response = $this->post('/admin/logout');
        $response->assertJson(['status' => true]);
    }

    /** @test */
    public function test_check_token_admin()
    {
        $admin = Admin::factory()->create();
        Sanctum::actingAs($admin, ['*']);

        $response = $this->get('/admin/check-token');
        $response->assertJson(['status' => true]);
    }

    /** @test */
    public function test_khong_co_quyen_voi_quan_ly_nhan_vien()
    {
        $admin = Admin::factory()->create(['id_chuc_vu' => 10]);
        Sanctum::actingAs($admin, ['*']);

        $response = $this->get('/admin/nhan-vien');
        $response->assertJson(['status' => false]);
    }

    /** @test */
    public function test_get_nhan_vien_thanh_cong()
    {
        $admin = Admin::factory()->create(['id_chuc_vu' => 1]);

        PhanQuyen::create([
            'id_chuc_vu' => 1,
            'id_chuc_nang' => 4
        ]);

        Sanctum::actingAs($admin, ['*']);

        $response = $this->get('/admin/nhan-vien');
        $response->assertJson(['status' => true]);
    }

    /** @test */
    public function test_search_nhan_vien()
    {
        $admin = Admin::factory()->create(['id_chuc_vu' => 1]);

        PhanQuyen::create([
            'id_chuc_vu' => 1,
            'id_chuc_nang' => 4
        ]);

        Sanctum::actingAs($admin, ['*']);

        $response = $this->post('/admin/search-nhan-vien', [
            'noi_dung_tim_kiem' => 'a'
        ]);

        $response->assertJson(['status' => true]);
    }
}
