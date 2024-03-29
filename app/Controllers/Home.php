<?php

namespace App\Controllers;

use App\Models\ItemCategoryModel;
use App\Models\ItemModel;
use App\Models\MemberModel;
use App\Models\PenawaranModel;
use App\Models\SaleModel;
use App\Models\SupplierModel;
use App\Models\UserModel;

class Home extends BaseController
{
    protected $validate;
    protected $m_user;
    protected $m_sale;
    protected $m_category;
    protected $m_item;
    protected $m_member;
    protected $m_penawaran;
    protected $m_supplier;
    protected $crop;
    public function __construct()
    {
        $this->validate   = \Config\Services::validation();
        $this->m_user     = new UserModel();
        $this->m_sale     = new SaleModel();
        $this->m_category = new ItemCategoryModel();
        $this->m_item     = new ItemModel();
        $this->m_member   = new MemberModel();
        $this->m_penawaran = new PenawaranModel();
        $this->m_supplier = new SupplierModel();
        $this->crop       = \Config\Services::image();
    }

    public function index()
    {
        $data = [
            'sale'     => $this->m_sale->limit(7)->findAll(),
            'penawaran' => $this->m_penawaran->limit(7)->findAll(),
            'user'     => $this->m_user->getUserRole(user()->id),
            'member'   => $this->m_member->countAll(),
            'kategori' => $this->m_category->countAll(),
            'supplier' => $this->m_supplier->countAll(),
            'item'     => $this->m_item->countAll(),
        ];

        return view('Admin/page/index', $data);
    }

    public function profile()
    {
        $data = [
            'user'       => $this->m_user->getUserRole(user()->id),
            'validation' => $this->validate,
        ];
        if (!empty($this->request->getPost('submit_profil'))) {
            if ($this->request->getFile('user_image')->getError() == 0) {
                $formSubmit = $this->validate([
                    'user_image'  => 'uploaded[user_image]|max_size[user_image,1048]|mime_in[user_image,image/png,image/jpg,image/jpeg]|ext_in[user_image,jpg,jpeg,png]',
                    'username'    => 'required|max_length[50]',
                    'user_number' => 'permit_empty|is_natural',
                    'password'    => 'permit_empty|strong_password',
                    're_password' => 'permit_empty|matches[password]',
                ]);
            } else {
                $formSubmit = $this->validate([
                    'username'    => 'required|max_length[50]',
                    'user_number' => 'permit_empty|is_natural',
                    'password'    => 'permit_empty|strong_password',
                    're_password' => 'permit_empty|matches[password]',
                ]);
            }
            if (!$formSubmit) {
                return redirect()->to('/profile-setting')->withInput();
            }
            $find = $this->m_user->getUserRole(user()->id);
            if (!empty($this->request->getPost('password')) && !empty($this->request->getPost('re_password'))) {
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
            } else {
                $password = $find[0]['password_hash'];
            }

            if ($this->request->getFile('user_image')->getError() == 0) {
                if (!empty($find[0]['user_image'])) {
                    if (unlink('upload/user/' . $find[0]['user_image'])) {
                        $unlink = true;
                    } else {
                        $unlink = false;
                    }
                } else {
                    $unlink = true;
                }
                if ($unlink) {
                    $fotoUser     = $this->request->getFile('user_image');
                    $namaFotoUser = $fotoUser->getRandomName();

                    $fotoUser->move('upload/user', $namaFotoUser);
                    $move = $this->crop
                        ->withFile('upload/user/' . $namaFotoUser)
                        ->fit(200, 200, 'center')
                        ->save('upload/user/' . $namaFotoUser);
                    if ($move) {
                        $status = true;
                    } else {
                        $status = false;
                    }
                } else {
                    $status = false;
                }
            } else {
                $status       = true;
                $namaFotoUser = $find[0]['user_image'];
            }

            if ($status) {
                $save = $this->m_user->save([
                    'id'            => user()->id,
                    'user_image'    => $namaFotoUser,
                    'username'      => ucwords($this->request->getPost('username')),
                    'user_number'   => $this->request->getPost('user_number'),
                    'password_hash' => $password,
                ]);
                if ($save) {
                    session()->setFlashdata('berhasil', 'Profil Anda Berhasil Diubah');

                    return redirect()->to('/home-page')->withCookies();
                }
                session()->setFlashdata('gagal', 'Gagal Mengubah Profil Anda');

                return redirect()->to('/home-page')->withCookies();
            }
            session()->setFlashdata('gagal', 'Gagal Mengupload File Foto Anda Ke Server');

            return redirect()->to('/home-page')->withCookies();
        }

        return view('Admin/page/setting', $data);
    }
}
