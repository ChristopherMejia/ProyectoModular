<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;


class UsersTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
            'first_name' => 'Christopher',
            'last_name' => 'Mejia',
            'email'    => 'chris@gmail.com',
            'password' => Hash::make('awesome'),
            'role_id'  => '1',
        ));

        User::create(array(
            'first_name' => 'Coordinador',
            'last_name' => 'Lastname',
            'email'    => 'coordinador@gmail.com',
            'password' => Hash::make('awesome'),
            'role_id'  => '2',
        ));

        User::create(array(
            'first_name' => 'Maestro',
            'last_name' => 'Lastname',
            'email'    => 'maestro@gmail.com',
            'password' => Hash::make('awesome'),
            'role_id'  => '3',
        ));
    }

}
