<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


//        \DB::table('users')->delete();

        \DB::table('users')->insert(
            array (
                'name' => 'saad mashal',
                'email' => 'saadmashal5@gmail.com',
                'email_verified_at' => '2023-08-22 16:07:05',
                'password' => '$2y$10$TXhWJwGRc37h7uwMy0yPvuL7F6JHBdrS2AUVSAp3PciWlyrT4UP52',
                'otp' => NULL,
                'otp_expire' => NULL,
                'active' => 1,
                'image' => NULL,
                'phone' => NULL,
                'lang' => 'ar',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        );


    }
}
