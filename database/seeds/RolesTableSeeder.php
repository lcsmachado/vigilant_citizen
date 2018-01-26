<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         /*
        * INSERT ADMIN ROLE
        */
        Role::create([
            'name'  => 'Admin',
            'admin' => true
        ]);

        /*
        * INSERT EDITOR ROLE
        */
        Role::create([
                'name'   => 'Editor',
                'editor' => true
            ]);

        /*
        * INSERT VISITOR ROLE
        */

        Role::create([
                'name'    => 'Visitante',
                'visitor' => true
            ]);
    }
}
