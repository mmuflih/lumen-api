<?php

use Illuminate\Database\Seeder;

class RegisterAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@app.com',
            'password' => app('hash')->make('Secreet!'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
