<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\BacSi;
use App\Models\PhanQuyen;
use App\Models\ChucVu;
use App\Models\PhongKham;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BacSiControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Tạo chức vụ có quyền quản lý bác sĩ
        $chucVu = ChucVu::create([
            'ten_chuc_vu' => 'Quản lý',
        ]);

        // Gán quyền (id_chuc_nang = 5 là quản lý bác sĩ)
        PhanQuyen::create([
            'id_chuc_vu' => $chucVu->id,
            'id_chuc_nang' => 5
        ]);

        // Tạo tài khoản admin
        $this->admin = BacSi::create([
            'ho_ten' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'id_chuc_vu' => $chucVu->id,
            'is_active' => 1,
        ]);
    }

    private function loginAdmin()
    {
        return $this->actingAs($this->admin, 'sanctum');
    }

    public function test_register_bac_si()
    {
        $response = $this->postJson('/api/bac-si/register', [
            'ho_ten' => 'Nguyen Van A',
            'email' => 'test@gmail.com',
            'password' => '123456',
            'so_dien_thoai' => '0123456789',
            'ngay_sinh' => '1999-02-02',
            'gioi_tinh' => 1,
            'dia_chi' => 'HCMC',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'message' => 'Đăng ký thành công. Vui lòng kiểm tra email để kích hoạt tài khoản',
                 ]);

        $this->assertDatabaseHas('bac_sis', [
            'email' => 'test@gmail.com'
        ]);
    }

    public function test_login_bac_si()
    {
        $bacSi = BacSi::create([
            'ho_ten' => 'Test',
            'email' => 'login@gmail.com',
            'password' => bcrypt('123456'),
            'is_active' => 1,
        ]);

        $response = $this->postJson('/api/bac-si/login', [
            'email' => 'login@gmail.com',
            'password' => '123456',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'message' => 'Đăng nhập thành công',
                 ]);
    }

    public function test_admin_them_bac_si()
    {
        $this->loginAdmin();

        $phongKham = PhongKham::create([
            'ten_phong_kham' => 'PK Test'
        ]);

        $response = $this->postJson('/api/bac-si/store', [
            'ho_ten' => 'Test Bác Sĩ',
            'email' => 'bs@gmail.com',
            'so_dien_thoai' => '0123456798',
            'ngay_sinh' => '1990-01-01',
            'gioi_tinh' => 1,
            'id_phong_kham' => $phongKham->id,
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                 ]);

        $this->assertDatabaseHas('bac_sis', [
            'email' => 'bs@gmail.com'
        ]);
    }

    public function test_admin_xoa_bac_si()
    {
        $this->loginAdmin();

        $bacSi = BacSi::create([
            'ho_ten' => 'Delete Test',
            'email' => 'delete@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        $response = $this->postJson('/api/bac-si/delete', [
            'id' => $bacSi->id
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                 ]);

        $this->assertSoftDeleted('bac_sis', [
            'id' => $bacSi->id
        ]);
    }
}
