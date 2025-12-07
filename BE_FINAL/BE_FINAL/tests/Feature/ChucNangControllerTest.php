<?php

namespace Tests\Feature;

use App\Models\ChucNang;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChucNangControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_list_chuc_nang()
    {
        // Tạo dữ liệu mẫu
        ChucNang::factory()->count(3)->create();

        // Gọi API
        $response = $this->get('/api/chuc-nang/get-data');

        // Kiểm tra status
        $response->assertStatus(200);

        // Kiểm tra cấu trúc JSON trả về
        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                '*' => [
                    'id',
                    'ten_chuc_nang',
                ]
            ],
        ]);

        // Kiểm tra dữ liệu có trả về đúng số lượng
        $this->assertCount(3, $response->json('data'));
    }
}
