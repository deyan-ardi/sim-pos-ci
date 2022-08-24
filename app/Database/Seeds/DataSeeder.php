<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DataSeeder extends Seeder
{
    public function run()
    {
        $this->call('AddSupplier');
        $this->call('AddCategories');
        $this->call('AddItem');
        $this->call('AddMember');
        $this->call('AddGroupUser');
        $this->call('AddUserSuperAdmin');
    }
}
