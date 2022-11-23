<?php

namespace Tests\Unit;

use App\Models\Address;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;


class ModelTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_model()  //testing the user model
    {
        $data = ([
            'name' => 'Yusuf Faruk',
            'email' => 'farukyusufa@gmail.com',
            'password' => Hash::make('password')
        ]);
        //create
        $user = User::create($data);
        $this->assertTrue(true, $user);
        $this->assertEquals($user->name, $data['name']);
        //update
        $user->update([
            'name' => 'Yusuf Faruk Abiola'
        ]);
        //read
        $user = User::where('id', $user->id)->first();
        $this->assertEquals($user->name, 'Yusuf Faruk Abiola');
    }

    public function test_address_model()  //testing the address model
    {
        $user = User::first();
        $data = ([
            'address' => 'MVES, Alagbado, Ilorin, Kwara State',
            'user_id' => $user->id
        ]);
        //create
        $address = Address::create($data);
        $this->assertTrue(true, $address);
        $this->assertEquals($address->address, $data['address']);
        //update
        $address->update([
            'address' => 'MVES, Alagbado Strt, Ilorin, Kwara State'
        ]);
        //read
        $address = Address::where('id', $address->id)->first();
        $this->assertEquals($address->address, 'MVES, Alagbado Strt, Ilorin, Kwara State');
    }

    public function test_address_user_model_relationship()  //testing the relationship between user and address
    {
        $user = User::first();
        $user_address =  $user->address->address;  //get address with relationship
        $address = Address::first()->address;
        $this->assertEquals($address, $user_address);
    }


    public function test_profile_model()  //testing the user model
    {
        $user = User::first();
        $data = ([
            'age' => 26,
            'tel' => '07060528533',
            'user_id' => $user->id
        ]);
        $profile = Profile::create($data);

        $this->assertTrue(true, $profile);
        $this->assertEquals($profile->age, $data['age']);
        //update
        $profile->update([
            'age' => 27
        ]);
        //read
        $profile = Profile::where('id', $profile->id)->first();
        $this->assertEquals($profile->age, 27);
    }

    public function test_profile_user_model_relationship()  //testing the relationship between user and profile
    {
        $user = User::first();
        $user_age =  $user->profile->age;  //get profile age with relationship
        $age = Profile::first()->age;
        $this->assertEquals($age, $user_age);
    }

    public function test_delete_user_address_profile()  // delete
    {
        $address = Address::first()->delete();
        $profile = Profile::first()->delete();
        $user = User::first()->delete();
        $this->assertTrue(true, $address);
        $this->assertTrue(true, $profile);
        $this->assertTrue(true, $user);
    }
}