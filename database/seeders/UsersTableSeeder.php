<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(\App\User::class, 20)->create()->each(function ($user) {
            $user->store()->save(factory(\App\Store::class)->make());
        });
    }
}





// use Illuminate\Database\Seeder;
// // use Illuminate\Support\Facades\DB;
// // use Illuminate\Support\Facades\Hash;
// // use Illuminate\Support\Str;


// class UsersTableSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      *
//      * @return void
//      */
//     public function run()
//     {
//             // \DB::table('users')->insert(
//             // [
//             //     'name' => 'Administrator',
//             //     'email' => 'admin@admin.com',
//             //     'email_verified_at' => now(),
//             //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
//             //     'remember_token' => 'okokdsds',
//             // ]
//             // );

//             // factory(\App\User::class, 40)->create(); // usamos esta forma por estar criando os usuarios só nesta tabela

//             // factory(\App\User::class, 40)->create();


//             factory(\App\User::class, 20)->create()->each(function($user){
//                 $user->store()->save(factory(\App\Store::class)->make());
//             });
//     }
// }
