<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GroupUserModel;
use App\Models\UserModel;

class User extends BaseController
{
	public function __construct()
	{
		$this->validate = \Config\Services::validation();
		$this->m_user = new UserModel();
		$this->crop = \Config\Services::image();
		$this->m_group_user = new GroupUserModel();
	}
	public function index()
	{
		$data = [
			'validation' => $this->validate,
			'user' => $this->m_user->getUserRole(),
		];
		if ($this->request->getPost('submit_user')) {
			if ($this->request->getFile('user_image')->getError() == 0) {
				$formSubmit = $this->validate([
					'user_image' => 'uploaded[user_image]|max_size[user_image,1048]|mime_in[user_image,image/png,image/jpg,image/jpeg]|ext_in[user_image,jpg,jpeg,png]',
					'email' => 'required|valid_email',
					'username' => 'required|max_length[50]',
					'user_number' => 'permit_empty|is_natural',
					'password' => 'required|strong_password',
					'password_confirm' => 'required|matches[password]',
					'group' => 'required|integer'
				]);
			} else {
				$formSubmit = $this->validate([
					'email' => 'required|valid_email',
					'username' => 'required|max_length[50]',
					'user_number' => 'permit_empty|is_natural',
					'password' => 'required|strong_password',
					'password_confirm' => 'required|matches[password]',
					'group' => 'required|integer'
				]);
			}
			if (!$formSubmit) {
				return redirect()->to('/users')->withInput();
			} else {
				if (!empty($this->request->getPost('password')) && !empty($this->request->getPost('password_confirm'))) {
					if ($this->request->getFile('user_image')->getError() == 0) {
						$fotoUser = $this->request->getFile('user_image');
						$namaFotoUser = $fotoUser->getRandomName();

						$fotoUser->move('upload/user', $namaFotoUser);
						$move = $this->crop
							->withFile('upload/user/' . $namaFotoUser)
							->fit(200, 200, 'center')
							->save('upload/user/' . $namaFotoUser);
						if ($move) {
							$status = true;
						}
					} else {
						$status = true;
						$namaFotoUser = NULL;
					}

					// Password Create Hash
					$hashOptions = [
						'cost' => 10,
					];
					// Enkripsi password
					$password = password_hash(
						base64_encode(
							hash('sha384', $this->request->getPost('password'), true)
						),
						PASSWORD_DEFAULT,
						$hashOptions
					);

					if ($status) {
						$save = $this->m_user->save([
							'user_image' => $namaFotoUser,
							'email' => $this->request->getPost('email'),
							'username' => ucWords($this->request->getPost('username')),
							'user_number' => $this->request->getPost('user_number'),
							'password_hash' => $password,
							'active' => 1,
						]);
						$user_id = $this->m_user->getInsertID();
						if ($save) {
							$save_group = $this->m_group_user->save([
								'group_id' => $this->request->getPost('group'),
								'user_id' => $user_id,
							]);
							if ($save_group) {
								echo "Berhasil Menambahkan Member";
							} else {
								echo "Gagal Membuat Hak Akses";
							}
						} else {
							echo "Gagal Menambahkan Member";
						}
					} else {
						echo "File Gagal Diupload Ke Server";
					}
				} else {
					echo "Kata Sandi Tidak Boleh Kosong";
				}
			}
		} else if ($this->request->getPost('update_user')) {
			if ($this->request->getFile('user_image_up')->getError() == 0) {
				$formSubmit = $this->validate([
					'user_image_up' => 'uploaded[user_image_up]|max_size[user_image_up,1048]|mime_in[user_image_up,image/png,image/jpg,image/jpeg]|ext_in[user_image_up,jpg,jpeg,png]',
					'email_up' => 'required|valid_email',
					'username_up' => 'required|max_length[50]',
					'user_number_up' => 'permit_empty|is_natural',
					'password_up' => 'permit_empty|strong_password',
					'password_confirm_up' => 'permit_empty|matches[password_up]',
					'group_up' => 'required|integer'
				]);
			} else {
				$formSubmit = $this->validate([
					'email_up' => 'required|valid_email',
					'username_up' => 'required|max_length[50]',
					'user_number_up' => 'permit_empty|is_natural',
					'password_up' => 'permit_empty|strong_password',
					'password_confirm_up' => 'permit_empty|matches[password_up]',
					'group_up' => 'required|integer'
				]);
			}
			if (!$formSubmit) {
				return redirect()->to('/users')->withInput();
			} else {
				$find = $this->m_user->getUserRole($this->request->getPost('id_user'));
				if (!empty($this->request->getPost('password_up')) && !empty($this->request->getPost('password_confirm_up'))) {
					// Password Create Hash
					$hashOptions = [
						'cost' => 10,
					];
					// Enkripsi password
					$password = password_hash(
						base64_encode(
							hash('sha384', $this->request->getPost('password_up'), true)
						),
						PASSWORD_DEFAULT,
						$hashOptions
					);
				} else {
					$password = $find[0]['password_hash'];
				}

				if ($this->request->getFile('user_image_up')->getError() == 0) {
					if(!empty($find[0]['user_image'])){
						if(unlink('upload/user/' . $find[0]['user_image'])){
							$unlink = true;
						}else{
							$unlink = false;
						}
					}else{
						$unlink = true;
					}
					if($unlink){
						$fotoUser = $this->request->getFile('user_image_up');
						$namaFotoUser = $fotoUser->getRandomName();
	
						$fotoUser->move('upload/user', $namaFotoUser);
						$move = $this->crop
							->withFile('upload/user/' . $namaFotoUser)
							->fit(200, 200, 'center')
							->save('upload/user/' . $namaFotoUser);
						if ($move) {
							$status = true;
						}else{
							$status = false;
						}
					}else{
						$status = false;
					}
				} else {
					$status = true;
					$namaFotoUser = $find[0]['user_image'];
				}

				if ($status) {
					$save = $this->m_user->save([
						'id' => $this->request->getPost('id_user'),
						'user_image' => $namaFotoUser,
						'email' => $this->request->getPost('email_up'),
						'username' => ucWords($this->request->getPost('username_up')),
						'user_number' => $this->request->getPost('user_number_up'),
						'password_hash' => $password,
					]);
					if ($save) {
						$save_group = $this->m_group_user->save([
							'id' => $find[0]['groupid'],
							'group_id' => $this->request->getPost('group_up'),
							'user_id' => $this->request->getPost('id_user'),
						]);
						if ($save_group) {
							echo "Berhasil Mengubah Member";
						} else {
							echo "Gagal Membuat Hak Akses";
						}
					} else {
						echo "Gagal Mengubah Member";
					}
				} else {
					echo "File Gagal Diupload Ke Server";
				}
			}
		} else if ($this->request->getPost('delete_user')) {
			$find = $this->m_user->getUserRole($this->request->getPost('id_user'));
			if(!empty($find)){
				if($find[0]['userid'] == user()->id){
					echo "Tidak Dapat Menghapus Diri Sendiri";
				}else{
					if (!empty($find[0]['user_image'])) {
						if (unlink('upload/user/' . $find[0]['user_image'])) {
							$unlink = true;
						} else {
							$unlink = false;
						}
					} else {
						$unlink = true;
					}
					if($unlink){
						if($this->m_user->delete($this->request->getPost('id_user'))){
							echo "Berhasil Menghapus User";
						}else{
							echo "Gagal Menghapus User";
						}
					}else{
						echo "Terjadi kesalahan saat menghapus gambar di server";
					}
				}
			}
		} else {
			return view('Admin/page/users', $data);
		}
	}
}