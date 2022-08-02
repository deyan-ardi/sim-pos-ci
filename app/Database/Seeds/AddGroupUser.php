<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddGroupUser extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'        => 'KASIR',
                'description' => 'Group For Kasir User',
            ],
            [
                'name'        => 'GUDANG',
                'description' => 'Group For Gudang User',
            ],
            [
                'name'        => 'SUPER ADMIN',
                'description' => 'Group For Super Admin User',
            ],
            [
                'name'        => 'ATASAN',
                'description' => 'Group For Atasan User',
            ],
            [
                'name'        => 'PURCHASING',
                'description' => 'Group For Purchasing User',
            ],
            [
                'name'        => 'MARKETING',
                'description' => 'Group For Marketing User',
            ],
            [
                'name'        => 'FINANCE',
                'description' => 'Group For Finance User',
            ],
            [
                'name'        => 'PROYEK',
                'description' => 'Group For Project Team User',
            ],
        ];
        $this->db->table('auth_groups')->insertBatch($data);
    }
}
