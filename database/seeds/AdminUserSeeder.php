<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::connection()->table('admin_users')->insert([
            'name'=>'琦玉',
            'email'=>'13177839316@163.com',
            'email_verified_at'=>now(),
            'password'=>password_hash('123456',PASSWORD_BCRYPT),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'activated' => true,
        ]);
    }
}
