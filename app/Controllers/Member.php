<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MemberModel;

class Member extends BaseController
{
	public function __construct()
	{
		$this->m_member = new MemberModel();
		$this->validate = \Config\Services::validation();
	}
	public function index()
	{
		$data = [
			'member' => $this->m_member->findAll(),
			'validation' => $this->validate,
		];
		if($this->request->getPost('input_member')){
			$formSubmit = $this->validate([
				'member_name' => 'required|max_length[200]',
				'member_contact' => 'required|is_natural',
				'member_discount' => 'permit_empty',
				'member_description' => 'permit_empty|max_length[500]',
			]);
			if (!$formSubmit) {
				return redirect()->to('/members')->withInput();
			} else {
				$save = $this->m_member->save([
					'member_name' => ucWords($this->request->getPost('member_name')),
					'member_contact' => $this->request->getPost('member_contact'),
					'member_discount' => $this->request->getPost('member_discount'),
					'member_description' => ucWords($this->request->getPost('member_description')),
				]);
				if($save){
					echo "Berhasil Menambahkan Member";
				}else{
					echo "Gagal Menambahkan Member";
				}
			}
		}else if ($this->request->getPost('update_member')) {
			$formSubmit = $this->validate([
				'member_name_up' => 'required|max_length[200]',
				'member_contact_up' => 'required|is_natural',
				'member_discount_up' => 'permit_empty',
				'member_description_up' => 'permit_empty|max_length[500]',
			]);
			if (!$formSubmit) {
				return redirect()->to('/members')->withInput();
			} else {
				$save = $this->m_member->save([
					'id' => $this->request->getPost('id_member'),
					'member_name' => ucWords($this->request->getPost('member_name_up')),
					'member_contact' => $this->request->getPost('member_contact_up'),
					'member_discount' => $this->request->getPost('member_discount_up'),
					'member_description' => ucWords($this->request->getPost('member_description_up')),
				]);
				if ($save) {
					echo "Berhasil Mengubah Member";
				} else {
					echo "Gagal Mengubah Member";
				}
			}
		} else if ($this->request->getPost('delete_member')) {
			$find = $this->m_member->find($this->request->getPost('id_member'));
			if(!empty($find)){
				if($this->m_member->delete($this->request->getPost('id_member'))){
					echo "Berhasil Dihapus";
				}else{
					echo "Gagal Dihapus";
				}
			}else{
				echo "Data Tidak Ditemukan";
			}
		} else{
			return view('Admin/page/members',$data);
		}
	}
}