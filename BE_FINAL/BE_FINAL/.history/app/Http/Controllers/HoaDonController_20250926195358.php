<?php

namespace App\Http\Controllers;

use App\Models\BenhNhan;
use App\Models\PhieuDatLich;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HoaDonController extends Controller
{
    public function getDataHoaDon()
    {
        $data = PhieuDatLich::join('benh_nhans', 'phieu_dat_lichs.id_benh_nhan', '=', 'benh_nhans.id')
            ->join('chi_tiet_dat_lichs', 'phieu_dat_lichs.id', '=', 'chi_tiet_dat_lichs.id_phieu_dat_lich')
            ->join('bac_sis', 'chi_tiet_dat_lichs.id_bac_si', '=', 'bac_sis.id')
            ->select(
                'benh_nhans.ho_ten',
                'benh_nhans.so_dien_thoai',
                'phieu_dat_lichs.ma_dat_lich',
                'phieu_dat_lichs.tong_tien',
                'bac_sis.ho_ten as ten_bac_si',
                'chi_tiet_dat_lichs.*'
            )
            ->where('phieu_dat_lichs.is_thanh_toan', 1)
            ->orderBy('phieu_dat_lichs.id')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function chiTietBill(Request $request){
        $data = BenhNhan::select()
                ->select(
                'benh_nhans.ho_ten as ten_benh_nhan',
                'benh_nhans.so_dien_thoai as so_dien_thoai_benh_nhan',
                'benh_nhans.email as email_benh_nhan',
                'phieu_dat_lichs.ma_dat_lich',
                'benh_nhans.gioi_tinh',
                'benh_nhans.ngay_sinh',
                'phieu_dat_lichs.ly_do_kham',
                'phieu_dat_lichs.tong_tien',
                'bac_sis.ho_ten as ten_bac_si',
                'chi_tiet_dat_lichs.chuan_doan',
                'chuyen_khoas.ten_chuyen_khoa',
                'bac_sis.so_dien_thoai as so_dien_thoai_bac_si',
                DB::raw('DATE_FORMAT(chi_tiet_dat_lichs.thoi_gian_bat_dau, "%H:%i") as thoi_gian_bat_dau'),
                DB::raw('DATE_FORMAT(chi_tiet_dat_lichs.thoi_gian_ket_thuc, "%H:%i") as thoi_gian_ket_thuc'),
                'chi_tiet_dat_lichs.don_gia_kham',
                'phong_khams.ten_phong_kham',
                DB::raw('DATE_FORMAT(phieu_dat_lichs.ngay_dat_hen, "%d/%m/%Y") as ngay_dat_hen'),
            )->first();

        if($data){
            return response()->json([
                'status'  => true,
                'data'    => $data
            ]);
        } else{
            return response()->json([
                'status'  => false,
                'messsage'=> ' Kh'
            ]);
        } 
    }
}
