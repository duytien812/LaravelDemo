<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\TheLoai;
use App\LoaiTin;

class LoaiTinController extends Controller
{
	public function getDanhSach(){
		$loaitin = LoaiTin::all();
		return view('admin.loaitin.danhsach', ['loaitin' => $loaitin]);
	}

	public function getThem(){
		$theloai = TheLoai::all();
		return view('admin.loaitin.them', ['theloai' => $theloai]);
	}

	public function postThem(Request $request){
		$this->validate($request, 
			[
				'TheLoai' =>'required',
				'Ten' => 'required|unique:LoaiTin,Ten|min:3|max:100',
			], 
			[
				'Ten.required' => 'Bạn chưa nhập tên loại tin',
				'Ten.min' => 'Tên thể loại có độ dài từ 3 kí tự trở lên',
                'Ten.max' => 'Tên thể loại có độ dài từ 3 kí tự trở lên',
                'Ten.unique' => 'Tên thể loại đã tồn tại',
                'TheLoai.required' => 'Bạn chưa chọn thể loại'
			]);
		$loaitin = new LoaiTin;
		$loaitin->Ten = $request->Ten;
		$loaitin->idTheLoai = $request->TheLoai;
		$loaitin->TenKhongDau = changeTitle($request->Ten);
		$loaitin->save();

		return redirect('admin/loaitin/them')->with('thongbao', 'Thêm thành công');
	}

	public function getSua($id){
		$theloai = TheLoai::all();
		$loaitin = LoaiTin::find($id);
		return view('admin.loaitin.sua', ['loaitin' => $loaitin, 'theloai' => $theloai]);
	}

	public function postSua(Request $request, $id){
		$this->validate($request, 
			[
				'TheLoai' =>'required',
				'Ten' => 'required|unique:LoaiTin,Ten|min:3|max:100',
			], 
			[
				'Ten.required' => 'Bạn chưa nhập tên loại tin',
				'Ten.min' => 'Tên thể loại có độ dài từ 3 kí tự trở lên',
                'Ten.max' => 'Tên thể loại có độ dài từ 3 kí tự trở lên',
                'Ten.unique' => 'Tên thể loại đã tồn tại',
                'TheLoai.required' => 'Bạn chưa chọn thể loại'
			]);
		$loaitin = LoaiTin::find($id);
		$loaitin->Ten = $request->Ten;
		$loaitin->TenKhongDau = changeTitle($request->Ten);
		$loaitin->idTheLoai = $request->TheLoai;
		$loaitin->save();

		return redirect('admin/loaitin/sua/'.$id)->with('thongbao', 'Sửa thành công');
	}

	public function getXoa($id){
		$loaitin = LoaiTin::find($id);
		$loaitin->delete();

		return redirect('admin/loaitin/danhsach')->with('thongbao', 'Bạn đã xóa thành công');
	}

}