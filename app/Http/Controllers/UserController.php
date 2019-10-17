<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

class UserController extends Controller
{
	public function getDanhSach() {
		$user = User::all();
		return view('admin.user.danhsach', ['user' => $user]);
	}

	public function getThem() {
		return view('admin.user.them');
	}

	public function postThem(Request $request) {
		$this->validate($request, [
			'name' => 'required|min:3',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|min:3|max:32',
			'passwordAgain' => 'required|same:password',
		],[
			'name.required' => 'Bạn chưa nhập tên người dùng',
			'name.min' => 'Tên người dùng phải có ít nhất 3 ký tự',
			'email.required' => 'Bạn chưa nhập email',
			'email.email' => 'Bạn chưa nhập đúng định dạng email',
			'email.unique' => 'Email đã tồn tại',
			'password.required' => 'Bạn chưa nhập mật khẩu',
			'password.min' => 'Mật khẩu phải có ít nhất 3 ký tự',
			'password.max' => 'Mật khẩu chỉ được tối đa 32 ký tự',
			'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
			'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp',
		]);

		$user = new User;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = bcrypt($request->name);
		$user->quyen = $request->quyen;
		$user->save();

		return redirect('admin/user/them')->with('thongbao', 'Thêm thành công');
	}

	public function getSua($id){
		
	}

	public function postSua(Request $request, $id){
		
	}

	public function getXoa($id){
		
	}

}