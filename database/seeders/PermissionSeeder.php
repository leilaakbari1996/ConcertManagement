<?php

namespace Database\Seeders;

use App\Models\permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //permission category
        permission::query()->insert([
            [
                'title' => 'create-category'
            ],
            [
                'title' => 'read-category'
            ],
            [
                'title' => 'update-category'
            ],
            [
                'title' => 'delete-category'
            ]
        ]);
        //permission user
        permission::query()->insert([
            [
                'title' => 'read-user'
            ],
            [
                'title' => 'update-user'
            ],
            [
                'title' => 'delete-user'
            ]
        ]);
        //permission Artist
        permission::query()->insert([
            [
                'title' => 'create-artist'
            ],
            [
                'title' => 'read-artist'
            ],
            [
                'title' => 'update-artist'
            ],
            [
                'title' => 'delete-artist'
            ]
        ]);
        //permission role
        permission::query()->insert([
            [
                'title' => 'create-role'
            ],
            [
                'title' => 'read-role'
            ],
            [
                'title' => 'update-role'
            ],
            [
                'title' => 'delete-role'
            ]
        ]);

    }
}
