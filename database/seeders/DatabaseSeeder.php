<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Rohan Shah',
            'email' => 'rohanshah@gmail.com',
            'address' => 'A/1/13, Brindaban Soc, Bandra (west), Mumbai',
            'mobile_no' => '9869368025',
            'email_verified_at' => now(),
            'password' =>  Hash::make('Rohan@123'),
            'role' => 1,
            'remember_token' => Str::random(10),
        ]);

        $cutomer = User::create([
            'name' => 'Jagdish Yadav',
            'email' => 'jagdish@gmail.com',
            'address' => 'A/1/13, Brindaban Soc, Bandra (west), Mumbai',
            'mobile_no' => '8585698547',
            'email_verified_at' => now(),
            'password' =>  Hash::make('Jagdish@123'),
            'role' => 0,
            'remember_token' => Str::random(10),
        ]);

        //CITIES
        City::create([
            'city_name' => 'Bandra',
            'pincode' => 	400050
        ]);

        //TESTIMONIAL MESSAGES
        $GLOBALS['testMessages'] = ["The cake was INCREDIBLE!!!!!!!! Thank you so much!!! Everyone loved it and it looked so beautiful! I really appreciate everything you did and I will for sure direct more people to you in the future!!!", "I ordered cupcakes for my cousins birthday and I must say these have to be the best cupcakes hands down! They were moist, decadent and made with quality ingredients. I will be returning again to try more flavors!", "The taste was too good . The quality , packaging , time of delivery every thing was perfect.", "Very nicely prepared and taste was excellent. Turns out be the best cake. Thank you", "It met my expectations. It was a treat for eyes and tongue....yummylicious I would say that. Thank you Bake N Flake for making my son's birthday a success.", "It was very delicious and they deliver the cake on time and it's my first order with Bake N Flake and u guys really make my experience superb and definately I am going to order again from Bake N Flake.", "The cake was beautifully packed and delivered on time. The best part was that it was super delicious - much much better than any other cake I have ever ordered! Yummm…", "Absolutely Fantastic! Easy booking, On time delivery, delicious and lovely Cake, I will recommend everyone to order from Bakingo and you will not regret the decision.", "The cake was very pretty ! It was my first time ordering such a cake and bakingo made the experience great! Thank you !"];

        User::factory(100)->create()->each(function (User $user) {
            $user->testimonial()->create([
                'description' => $GLOBALS['testMessages'][rand(0, 8)],
                'ratings' => rand(1, 5),
            ]);
        });
        $this->call(CategoryAndProductSeeder::class);
    }
}
