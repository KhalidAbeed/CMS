<?php
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class usercontrol extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::where('email','eldoon2323@yahoo.com')->first();
        if(!$user)
        {
            User::create([
                'name'=>'khaled',
                'email'=>'eldoon2141996@gmail.com',
                'password'=>Hash::make('password'),
                'role'=>'admin',
            ]);
        }
    }
}
