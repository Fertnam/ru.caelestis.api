<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = ['Admin', 'User', 'Moderator'];

        foreach($groups as $group) {
            Group::factory()->create([
                'name' => $group
            ]);
        }

        User::factory(10)->create();

    }


}
