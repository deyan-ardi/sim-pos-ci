<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class AddUserSuperAdmin extends Seeder
{
    public function run()
    {
        $csvFile = fopen("csv/users.csv", "r");
        // It will automatically read file from /public/csv folder.
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                $object = new UserModel();
                $object->insert([
                    "id" => $data[0],
                    "email" => $data[1] == "NULL" ? NULL : $data[1],
                    "username" => $data[2] == "NULL" ? NULL : $data[2],
                    "user_image" => $data[3] == "NULL" ? NULL : $data[3],
                    "user_number" => $data[4] == "NULL" ? NULL : $data[4],
                    "password_hash" => $data[5] == "NULL" ? NULL : $data[5],
                    "reset_hash" => $data[6] == "NULL" ? NULL : $data[6],
                    "reset_at" => $data[7] == "NULL" ? NULL : $data[7],
                    "reset_expires" => $data[8] == "NULL" ? NULL : $data[8],
                    "activate_hash" => $data[9] == "NULL" ? NULL : $data[9],
                    "status" => $data[10] == "NULL" ? NULL : $data[10],
                    "status_message" => $data[11] == "NULL" ? NULL : $data[11],
                    "active" => $data[12] == "NULL" ? NULL : $data[12],
                    "force_pass_reset" => $data[13] == "NULL" ? NULL : $data[13],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
