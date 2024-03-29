<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
// use Illuminate\Database\seeds;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            RolesTableSeeder::class,
        ]);
    }
}
