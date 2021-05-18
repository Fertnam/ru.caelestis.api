<?php

namespace Database\Seeders;

use App\Models\cs_group;
use App\Models\CsUser;
use Database\Factories\csgroupFactory;
use Illuminate\Database\Seeder;

class CsUserSeeder extends Seeder
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
            cs_group::factory()->create([
                'name' => $group
            ]);
        }

        CsUser::factory(10)->create();
    }
}
