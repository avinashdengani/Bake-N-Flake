<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategoryAndProductSeeder extends Seeder
{
    public function run()
    {
        $admin = User::find(1);
        $cakes = Category::create([
            'name' => 'Cakes',
            'user_id' => $admin->id,
            'image' => 'images/categories/cakes.jpg'
        ]);

        $chocolateCake = $cakes->products()->create([
            'user_id' => $admin->id,
            'name' => 'Chocolate cake',
            'description' => 'Chocolate cake is a cake flavored with melted chocolate, cocoa powder, or both.. It can also include other ingredients. These include fudge, vanilla cream, and other sweeteners. The history of chocolate cake goes back to the 17th century, when cocoa powder from the Americas were added to traditional cake recipes.',
            'mrp' => 2199,
            'units' => '2kg',
            'discount' => 10,
            'status' => 1,
        ]);

        for($i=1; $i<4; $i++) {
            $chocolateCake->images()->create([
                'image' => 'images/products/chocolate-'.$i.'.jpg'
            ]);
        }
        $chocolateCake->cities()->attach(1);
        $butterCake = $cakes->products()->create([
            'user_id' => $admin->id,
            'name' => 'Butter Cake',
            'description' => 'A butter cake is a cake in which one of the main ingredients is butter. Butter cake is baked with basic ingredients: butter, sugar, eggs, flour, and leavening agents such as baking powder or baking soda. It is considered one of the quintessential cakes in American baking.',
            'mrp' => 1099,
            'units' => '1kg',
            'discount' => 10,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $butterCake->images()->create([
                'image' => 'images/products/butter-'.$i.'.jpg'
            ]);
        }
        $butterCake->cities()->attach(1);
        $poundCake = $cakes->products()->create([
            'user_id' => $admin->id,
            'name' => 'Pound Cake',
            'description' => 'Pound cake is a type of cake traditionally made with a pound of each of four ingredients: flour, butter, eggs, and sugar. Pound cakes are generally baked in either a loaf pan or a Bundt mold. They are sometimes served either dusted with powdered sugar, lightly glazed, or with a coat of icing',
            'mrp' => 1099,
            'units' => '1kg',
            'discount' => 10,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $poundCake->images()->create([
                'image' => 'images/products/pound-'.$i.'.jpg'
            ]);
        }
        $poundCake->cities()->attach(1);
        $spongeCake = $cakes->products()->create([
            'user_id' => $admin->id,
            'name' => 'Sponge Cake',
            'description' => 'Sponge cake is a light cake made with egg whites, flour and sugar, sometimes leavened with baking powder. Sponge cakes, leavened with beaten eggs, originated during the Renaissance, possibly in Spain.',
            'mrp' => 1099,
            'units' => '1kg',
            'discount' => 10,
            'status' => 1,
        ]);
        for($i=1; $i<5; $i++) {
            $spongeCake->images()->create([
                'image' => 'images/products/sponge-'.$i.'.jpg'
            ]);
        }
        $spongeCake->cities()->attach(1);

        $genoiseCake = $cakes->products()->create([
            'user_id' => $admin->id,
            'name' => 'Genoise Cake',
            'description' => 'A génoise, also known as Genoese cake or Genovese cake, is an Italian sponge cake named after the city of Genoa and associated with Italian and French cuisine. Instead of using chemical leavening, air is suspended in the batter during mixing to provide volume.',
            'mrp' => 1099,
            'units' => '1kg',
            'discount' => 10,
            'status' => 1,
        ]);
        for($i=1; $i<5; $i++) {
            $genoiseCake->images()->create([
                'image' => 'images/products/genoise-'.$i.'.jpg'
            ]);
        }
        $genoiseCake->cities()->attach(1);

        $pastries = Category::create([
            'name' => 'Pastries',
            'user_id' => $admin->id,
            'image' => 'images/categories/pastries.jpg'
        ]);

        $fruitPastries = $pastries->products()->create([
            'user_id' => $admin->id,
            'name' => 'Fruit Pastries',
            'description' => 'For the times when your celebration needs a refreshing kick-start, this fruit pastries is here to load your occasion with bliss. The freshly baked pastries topped with juicy fruits like pineapple, cherries, kiwi, orange and grapes would give a healthy twist to your celebrations.',
            'mrp' => 79,
            'units' => '1piece',
            'discount' => 20,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $fruitPastries->images()->create([
                'image' => 'images/products/fruitpastries-'.$i.'.jpg'
            ]);
        }
        $fruitPastries->cities()->attach(1);

        $chocoChipPastries = $pastries->products()->create([
            'user_id' => $admin->id,
            'name' => 'Choco Chip Pastries',
            'description' => "It's time to fall in luxury..in love with this delish pastries loaded with choco chips and white chocolate crown to satiate your chocolate desires. The mushy base with a delicious chocolate topping is something you would have a hard time saying 'No' to.",
            'mrp' => 79,
            'units' => '1piece',
            'discount' => 20,
            'status' => 1,
        ]);

        for($i=1; $i<4; $i++) {
            $chocoChipPastries->images()->create([
                'image' => 'images/products/chocochippastries-'.$i.'.jpg'
            ]);
        }

        $chocoChipPastries->cities()->attach(1);

        $mangoPastries = $pastries->products()->create([
            'user_id' => $admin->id,
            'name' => 'Mango Pastries',
            'description' => "Award yourself with the delish flavours of mango pastries and lose yourself in their sumptuous appeal like never before. The mushy base enrobed with almond shavings and topped with mango glaze and chocolate crown are not only going to satiate your sweet tooth desires but also remind you of the summertime goodness!",
            'mrp' => 79,
            'units' => '1piece',
            'discount' => 20,
            'status' => 1,
        ]);

        for($i=1; $i<4; $i++) {
            $mangoPastries->images()->create([
                'image' => 'images/products/mangopastries-'.$i.'.jpg'
            ]);
        }

        $mangoPastries->cities()->attach(1);

        $kitKatPastries = $pastries->products()->create([
            'user_id' => $admin->id,
            'name' => 'Kit Kat Pastries',
            'description' => "Bring out the kid in you with Kit Kat pastries and feed your inner child with the right kind of sweetness it had been missing for so long. With richly whipped cream swirled over the cake coming along with Kit Kat bar on the top shall give a pleasurable break from your mundane routine.",
            'mrp' => 79,
            'units' => '1piece',
            'discount' => 20,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $kitKatPastries->images()->create([
                'image' => 'images/products/kitkatpastries-'.$i.'.jpg'
            ]);
        }
        $kitKatPastries->cities()->attach(1);

        $blueberryPastries = $pastries->products()->create([
            'user_id' => $admin->id,
            'name' => 'Blueberry Pastries',
            'description' => "Here's blueberry to impart the flavour like never before. This delicious blueberry pastries is sure to leave you spellbound with its perfect dose of richly whipped cream and blueberry glaze and qualify as an impressive dessert.",
            'mrp' => 79,
            'units' => '1piece',
            'discount' => 20,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $blueberryPastries->images()->create([
                'image' => 'images/products/blueberrypastries-'.$i.'.jpg'
            ]);
        }
        $blueberryPastries->cities()->attach(1);

        $irishCreamPastries = $pastries->products()->create([
            'user_id' => $admin->id,
            'name' => 'Irish Cream Pastries',
            'description' => "The incredibly delicious flavour is here to give your tastebuds a treat of all times. These light and fluffy Irish cream pastries have subtle flavours with an appealing blanket of Irish cream and chocolate syrup and are going to be a perfect finale to your meals!",
            'mrp' => 79,
            'units' => '1piece',
            'discount' => 20,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $irishCreamPastries->images()->create([
                'image' => 'images/products/irishcreampastries-'.$i.'.jpg'
            ]);
        }
        $irishCreamPastries->cities()->attach(1);

        $whiteForestPastries = $pastries->products()->create([
            'user_id' => $admin->id,
            'name' => 'White Forest Pastries',
            'description' => "Delve into sweet pleasures with this White Forest pastries that has everything to gratify your palates with a taste of luxury. The mushy base having bits of maraschino cherries with a topping of white chocolate shavings and juicy cherries is a perfect dessert to dig into whenever you are craving for a luxurious indulgence.",
            'mrp' => 79,
            'units' => '1piece',
            'discount' => 20,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $whiteForestPastries->images()->create([
                'image' => 'images/products/whiteforestpastries-'.$i.'.jpg'
            ]);
        }
        $whiteForestPastries->cities()->attach(1);

        $chocolateMudPastries = $pastries->products()->create([
            'user_id' => $admin->id,
            'name' => 'Chocolate Mud Pastries',
            'description' => "A shout out to all the chocolate lovers for here's a treat to satiate your cravings to the utmost. Pastries whether you wish to give a refreshing start to your meal or a perfect end to the binge. These chocolate mud laced treats are sure to become a delicious addition to your meal and create a sweet statement on all occasions.",
            'mrp' => 79,
            'units' => '1piece',
            'discount' => 20,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $chocolateMudPastries->images()->create([
                'image' => 'images/products/chocolatemudpastries-'.$i.'.jpg'
            ]);
        }
        $chocolateMudPastries->cities()->attach(1);

        $brownies = Category::create([
            'name' => 'brownies',
            'user_id' => $admin->id,
            'image' => 'images/categories/brownies.jpg'
        ]);

        $chocoChipBrownie = $brownies->products()->create([
            'user_id' => $admin->id,
            'name' => 'Choco Chip Brownie',
            'description' => "Our classic Choco Chip Brownie is a gooey chocolate brownie loaded with dark chocolate chips. It is a dense fudgy brownie made with pure couverture chocolate, that will simply melt in your mouth.",
            'mrp' => 129,
            'units' => '1piece',
            'discount' => 20,
            'status' => 1,
        ]);
        for($i=1; $i<5; $i++) {
            $chocoChipBrownie->images()->create([
                'image' => 'images/products/chocochip-brownie-'.$i.'.jpg'
            ]);
        }
        $chocoChipBrownie->cities()->attach(1);

        $cookieBrownie = $brownies->products()->create([
            'user_id' => $admin->id,
            'name' => 'Cookie Brownie',
            'description' => "Our Cookie Brownie combines the best of two great products in one outstanding brownie! A classic chocolate brownie base is topped with a layer of chocolate chip cookie dough, resulting in a brownie that is twice as delicious!",
            'mrp' => 129,
            'units' => '1piece',
            'discount' => 20,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $cookieBrownie->images()->create([
                'image' => 'images/products/cookiebrownie-'.$i.'.jpg'
            ]);
        }
        $cookieBrownie->cities()->attach(1);

        $millionarieBrownie = $brownies->products()->create([
            'user_id' => $admin->id,
            'name' => 'Millionaire Brownie',
            'description' => "Our Millionaire Brownie is made of soft buttery caramel sandwiched between our chocolate chip brownie and a layer of rich dark chocolate truffle. This layered treat is an adaptation of the English classic millionaire shortbread and is pure indulgence!",
            'mrp' => 129,
            'units' => '1piece',
            'discount' => 20,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $millionarieBrownie->images()->create([
                'image' => 'images/products/millionairebrownie-'.$i.'.jpg'
            ]);
        }
        $millionarieBrownie->cities()->attach(1);

        $nutellaBrownie = $brownies->products()->create([
            'user_id' => $admin->id,
            'name' => 'Nutella Brownie',
            'description' => "Our Nutella Brownie is a chocolate brownie with toasted hazelnuts, topped with our homemade hazelnut praline, and finished with a drizzle of Nutella. This one is a best-seller!",
            'mrp' => 129,
            'units' => '1piece',
            'discount' => 20,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $nutellaBrownie->images()->create([
                'image' => 'images/products/nutellabrownie-'.$i.'.jpg'
            ]);
        }
        $nutellaBrownie->cities()->attach(1);

        $overloadbrownie = $brownies->products()->create([
            'user_id' => $admin->id,
            'name' => 'Overload Brownie',
            'description' => "As the name suggests, our Overload Brownie is loaded with real dark chocolate. This dense fudgy brownie with the perfect crackling top is the ultimate chocolaty treat.",
            'mrp' => 129,
            'units' => '1piece',
            'discount' => 20,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $overloadbrownie->images()->create([
                'image' => 'images/products/overloadbrownie-'.$i.'.jpg'
            ]);
        }
        $overloadbrownie->cities()->attach(1);

        $walnutBrownie = $brownies->products()->create([
            'user_id' => $admin->id,
            'name' => 'Walnut Brownie',
            'description' => "An old-time classic, our Walnut Brownie is made by folding toasted chopped walnuts into our chocolate brownie batter. The crunchy texture of walnuts contrasts beautifully against the smooth chocolate brownie, make this a decadent delight!",
            'mrp' => 129,
            'units' => '1piece',
            'discount' => 20,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $walnutBrownie->images()->create([
                'image' => 'images/products/walnutbrownie-'.$i.'.jpg'
            ]);
        }
        $walnutBrownie->cities()->attach(1);

        $cupcakes = Category::create([
            'name' => 'cupcakes',
            'user_id' => $admin->id,
            'image' => 'images/categories/cupcakes.jpg'
        ]);

        $blueberryPineappleVanillaCupcakes = $cupcakes->products()->create([
            'user_id' => $admin->id,
            'name' => 'Blueberry Pineapple Vanilla Cupcakes',
            'description' => "Treat your tastebuds with an assortment of 6 delicious and moist cupcakes. Satiate your senses to the rich flavours of blueberry, pineapple, and vanilla with thick dollops of vanilla frosting and alluring toppers. Get a hit of pure flavour in every bite!",
            'mrp' => 99,
            'units' => '1piece',
            'discount' => 10,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $blueberryPineappleVanillaCupcakes->images()->create([
                'image' => 'images/products/blueberryvanillacupcake-'.$i.'.jpg'
            ]);
        }
        $blueberryPineappleVanillaCupcakes->cities()->attach(1);

        $redVelvetPineappleVanillaCupcakes = $cupcakes->products()->create([
            'user_id' => $admin->id,
            'name' => 'Red Velvet Pineapple Vanilla Cupcakes',
            'description' => "Surprise the cake lovers in your life with a hearty hamper of assorted cupcakes. Six assorted cupcakes in three mouthwatering flavours await you. Send this delicately frosted and soft to the bite set of six cupcakes in Red Velvet, Pineapple, and Vanilla flavours sent to your doorstep in a jiffy!",
            'mrp' => 99,
            'units' => '1piece',
            'discount' => 10,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $redVelvetPineappleVanillaCupcakes->images()->create([
                'image' => 'images/products/redvelvetcupcake-'.$i.'.jpg'
            ]);
        }
        $redVelvetPineappleVanillaCupcakes->cities()->attach(1);

        $strawberryCupcakes = $cupcakes->products()->create([
            'user_id' => $admin->id,
            'name' => 'Strawberry Cupcakes',
            'description' => "Do you know that a surprise of sweetness and deliciousness is sure to bring pleasure and delight to the recipient? Send a set of six delicious cupcakes topped with colourful gems, fondant hearts, and edible roses respectively in pair of two. Vanilla-Strawberry with fondant heart, Chocolate-Strawberry, and Vanilla-Strawberry with fondant roses are the flavours.",
            'mrp' => 99,
            'units' => '1piece',
            'discount' => 10,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $strawberryCupcakes->images()->create([
                'image' => 'images/products/strawberrycupcake-'.$i.'.jpg'
            ]);
        }
        $strawberryCupcakes->cities()->attach(1);

        $chocolateChocoChipsAndOreoCupCakes = $cupcakes->products()->create([
            'user_id' => $admin->id,
            'name' => 'Chocolate Choco Chips & Oreo Cup Cakes',
            'description' => "Oreo and chocolate flavoured cupcakes baked with the finest of ingredients, swirled with melt-mouth frosting, and topped with Oreo cookies, choco-chips, and white chocolate balls will make you salivate incessantly that you cannot resist but finish it in a single bite.",
            'mrp' => 99,
            'units' => '1piece',
            'discount' => 10,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $chocolateChocoChipsAndOreoCupCakes->images()->create([
                'image' => 'images/products/chocochiporeocupcake-'.$i.'.jpg'
            ]);
        }
        $chocolateChocoChipsAndOreoCupCakes->cities()->attach(1);

        $multiFlavoredCupcakes = $cupcakes->products()->create([
            'user_id' => $admin->id,
            'name' => 'Multi Flavored Cupcakes',
            'description' => "There's nothing that an appealing yet appetising chocolate cupcake, as this one can't solve in this world. So, this set of chocolate cupcakes, which has been topped up with a rich, luscious chocolate swirl and milk chocolate curl is sure to brighten up anyone's day with its look and taste. Don't trust us? Then try it on your own, folks!",
            'mrp' => 99,
            'units' => '1piece',
            'discount' => 10,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $multiFlavoredCupcakes->images()->create([
                'image' => 'images/products/multiflavoredcupcake-'.$i.'.jpg'
            ]);
        }
        $multiFlavoredCupcakes->cities()->attach(1);

        $jarcakes = Category::create([
            'name' => 'jarcakes',
            'user_id' => $admin->id,
            'image' => 'images/categories/jarcakes.jpg'
        ]);

        $redVelvetSingleJarCake = $jarcakes->products()->create([
            'user_id' => $admin->id,
            'name' => 'Red Velvet Single Jar Cake',
            'description' => "Nothing matches to the goodness of a delectable red velvet jar cake and when it comes as a jar cake, it is sure to spread happiness and other good feelings to your loved ones. So, what's the wait for? Be it, any special occasion turn it into the best possible one by celebrating it over a rich, velvety smooth jar cake, like this.",
            'mrp' => 149,
            'units' => '1piece',
            'discount' => 20,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $redVelvetSingleJarCake->images()->create([
                'image' => 'images/products/RedvelvetJar-'.$i.'.jpg'
            ]);
        }
        $redVelvetSingleJarCake->cities()->attach(1);

        $chocoMudSingleJarCake = $jarcakes->products()->create([
            'user_id' => $admin->id,
            'name' => 'Choco Mud Single Jar Cake',
            'description' => "Chocolate is nature's way of telling us to be happy every day. Glow with beaming joy on all the days ending in 'Y' by having a spoon of this rich, and heavenly choco mud jar cake. With alternate layers of scrummy chocolate layers, choco mud jar cake is the tasty solution to all the problems.",
            'mrp' => 149,
            'units' => '1piece',
            'discount' => 20,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $chocoMudSingleJarCake->images()->create([
                'image' => 'images/products/chocomudJar-'.$i.'.jpg'
            ]);
        }
        $chocoMudSingleJarCake->cities()->attach(1);

        $butterscotchSingleJarCake = $jarcakes->products()->create([
            'user_id' => $admin->id,
            'name' => 'Butterscotch Single Jar Cake',
            'description' => "Crunchy butterscotch and smooth, creamy butterscotch flavoured bread confined into a cute little glass jar - This jar cake is a perfect charmer for a sweet luxury. Surprise your loved ones by gifting them this miniature Butterscotch cake in a jar, on any beautiful day of celebration.",
            'mrp' => 149,
            'units' => '1piece',
            'discount' => 20,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $butterscotchSingleJarCake->images()->create([
                'image' => 'images/products/butterscotchJar-'.$i.'.jpg'
            ]);
        }
        $butterscotchSingleJarCake->cities()->attach(1);

        $blueberrySingleJarCake = $jarcakes->products()->create([
            'user_id' => $admin->id,
            'name' => 'Blueberry Single Jar Cake',
            'description' => "Our 'Cute Blueberry Delight' is nothing less than a heaven of desserts. Packed in a cute and handy glass jar and made with fine blueberries pulp and premium cake ingredients, our Blueberry Jar Cake is sure to give your taste buds a scrumptious ride of delight.",
            'mrp' => 149,
            'units' => '1piece',
            'discount' => 20,
            'status' => 1,
        ]);
        for($i=1; $i<4; $i++) {
            $blueberrySingleJarCake->images()->create([
                'image' => 'images/products/blueberryJar-'.$i.'.jpg'
            ]);
        }
        $blueberrySingleJarCake->cities()->attach(1);

    }
}
