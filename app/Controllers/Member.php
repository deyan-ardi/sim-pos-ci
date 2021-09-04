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
				'member_email' => 'required|valid_email',
				'member_description' => 'permit_empty|max_length[500]',
			]);
			if (!$formSubmit) {
				return redirect()->to('/members')->withInput();
			} else {
				$string = "0123456789";
				$token = date('Ym').substr(str_shuffle($string), 0, 4);
				$save = $this->m_member->save([
					'member_code' => $token,
					'member_name' => ucWords($this->request->getPost('member_name')),
					'member_email' => $this->request->getPost('member_email'),
					'member_contact' => $this->request->getPost('member_contact'),
					'member_discount' => $this->request->getPost('member_discount'),
					'member_description' => ucWords($this->request->getPost('member_description')),
				]);
				if($save){
					session()->setFlashdata('berhasil', 'Member Baru Berhasil Ditambahkan');
					return redirect()->to('/members')->withCookies();
				}else{
					session()->setFlashdata('gagal', 'Gagal Menambahkan Member');
					return redirect()->to('/members')->withCookies();
				}
			}
		}else if ($this->request->getPost('update_member')) {
			$formSubmit = $this->validate([
				'member_name_up' => 'required|max_length[200]',
				'member_contact_up' => 'required|is_natural',
				'member_discount_up' => 'permit_empty',
				'member_email' => 'required|valid_email',
				'member_description_up' => 'permit_empty|max_length[500]',
			]);
			if (!$formSubmit) {
				return redirect()->to('/members')->withInput();
			} else {
				$save = $this->m_member->save([
					'id' => $this->request->getPost('id_member'),
					'member_name' => ucWords($this->request->getPost('member_name_up')),
					'member_contact' => $this->request->getPost('member_contact_up'),
					'member_email' => $this->request->getPost('member_email'),
					'member_discount' => $this->request->getPost('member_discount_up'),
					'member_description' => ucWords($this->request->getPost('member_description_up')),
				]);
				if ($save) {
					session()->setFlashdata('berhasil', 'Member Yang Dipilih Berhasil Diubah');
					return redirect()->to('/members')->withCookies();
				} else {
					session()->setFlashdata('gagal', 'Gagal Mengubah Member');
					return redirect()->to('/members')->withCookies();
				}
			}
		} else if ($this->request->getPost('delete_member')) {
			$find = $this->m_member->find($this->request->getPost('id_member'));
			if(!empty($find)){
				if($this->m_member->delete($this->request->getPost('id_member'))){
					session()->setFlashdata('berhasil', 'Member Yang Dipilih Berhasil Dihapus');
					return redirect()->to('/members')->withCookies();
				}else{
					session()->setFlashdata('gagal', 'Gagal Menghapus Member');
					return redirect()->to('/members')->withCookies();
				}
			}else{
				session()->setFlashdata('gagal', 'Data Member Gagal Ditemukan');
				return redirect()->to('/members')->withCookies();
			}
		} else{
			return view('Admin/page/members',$data);
		}
	}
}