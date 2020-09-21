<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $masterRole = Role::where('name', 'master')->first();
        $clientRole = Role::where('name', 'client')->first();

        $master = User::create(
            [
            'name' => 'Master name',
            'email'=> 'master@mail.com',
            'password'=> Hash::make('password')
            ]);

        
        $client = User::create(
            [
            'name' => 'Client name',
            'email'=> 'client@mail.com',
            'password'=> Hash::make('password')
            ]);

        $master->roles()->attach($masterRole);
        $client->roles()->attach($client);
}
