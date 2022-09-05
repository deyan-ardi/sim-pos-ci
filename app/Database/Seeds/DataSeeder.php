<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DataSeeder extends Seeder
{
    public function run()
    {
        $this->call('AddGroupUser');
        $this->call('AddUserSuperAdmin');
        $this->call('AddSupplier');
        $this->call('AddCategories');
        $this->call('AddItem');
        $this->call('AddMember');
        $this->call('AddUserGroup');
        $this->call('AddInvoice');
        $this->call('AddPphs');
    }
}
