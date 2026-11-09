<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run(): void {
        User::updateOrCreate(
            ['phone' => '09179992797'],
            ['name'=>' تیم برنامه نویسی برام','email'=>'baramtec@gmail.com.com','password'=>Hash::make('password')]
        );
    }
}