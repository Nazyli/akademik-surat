<?php

namespace Database\Seeders;

use App\Models\FormType;
use App\Models\RoleMembership;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php artisan migrate -> buat database
        // php artisan migrate:refresh -> update refresh
        // php artisan db:seed --class=CreateUsersSeeder
        DB::transaction(function () {

            RoleMembership::insert([
                [
                    'id' => 1,
                    'name' => 'Admin',

                ],
                [
                    'id' => 2,
                    'name' => 'User',
                ]

            ]);

            $user = [
                [
                    'id' => Str::uuid(),
                    'first_name' => 'Admin',
                    'last_name' => 'Dummy',
                    'phone' => '087657890377',
                    'email' => 'admin@gmail.com',
                    'role_id' => '1',
                    'img_url' => 'file/avatars/admin.png',
                    'status' => 'Active',
                    'password' => bcrypt('123456'),
                ],
                [
                    'id' => Str::uuid(),
                    'first_name' => 'User',
                    'last_name' => 'Dummy',
                    'phone' => '087657890377',
                    'email' => 'user@gmail.com',
                    'role_id' => '2',
                    'img_url' => 'file/avatars/user.jpg',
                    'npm' => '011022',
                    'status' => 'Active',
                    'password' => bcrypt('123456'),
                ],
            ];

            foreach ($user as $key => $value) {
                User::create($value);
            }

            $formType = [
                [
                    'id' => "T01",
                    'name' => 'Akademik',
                    'status' => 'Active',
                ],
                [
                    'id' => "T02",
                    'name' => 'Skripsi',
                    'status' => 'Active',
                ], [
                    'id' => "T03",
                    'name' => 'Tesis',
                    'status' => 'Active',
                ], [
                    'id' => "T04",
                    'name' => 'Promosi',
                    'status' => 'Active',
                ],
            ];

            foreach ($formType as $key => $value) {
                FormType::create($value);
            }
        });
    }
}
