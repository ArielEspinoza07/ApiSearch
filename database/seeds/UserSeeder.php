<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\User::create(
            array(
                'name'      =>  'my_user',
                'email'     =>  'my_email',
                'password'  => Hash::make('12345')
            )
        );
    }
}
