<?php

namespace Database\Seeders;

use App\Actions\OptimizeWebpImageAction;
use App\Models\Puppy;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PuppySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $puppies = [
            ['name' => 'Bella', 'trait' => 'Always happy', 'image' => '10.jpg'],
            ['name' => 'Rex', 'trait' => 'Fetches everything', 'image' => '9.jpg'],
            ['name' => 'Luna', 'trait' => 'Howls at the moon', 'image' => '8.jpg'],
            ['name' => 'Yoko', 'trait' => 'Ready for anything', 'image' => '6.jpg'],
            ['name' => 'Russ', 'trait' => 'Ready to save the world', 'image' => '5.jpg'],
            ['name' => 'Pupi', 'trait' => 'Loves cheese', 'image' => '4.jpg'],
            ['name' => 'Leia', 'trait' => 'Enjoys naps', 'image' => '3.jpg'],
            ['name' => 'Chase', 'trait' => 'Very good boi', 'image' => '2.jpg'],
            ['name' => 'Frisket', 'trait' => 'Mother of all pups', 'image' => '1.jpg'],
            ['name' => 'Max', 'trait' => 'Loves to play', 'image' => '11.jpg'],
            ['name' => 'Charlie', 'trait' => 'Great listener', 'image' => '12.jpg'],
            ['name' => 'Cooper', 'trait' => 'Always curious', 'image' => '13.jpg'],
            ['name' => 'Buddy', 'trait' => 'Loyal companion', 'image' => '14.jpg'],
            ['name' => 'Milo', 'trait' => 'Gentle soul', 'image' => '15.jpg'],
            ['name' => 'Bear', 'trait' => 'Strong protector', 'image' => '16.jpg'],
            ['name' => 'Rocky', 'trait' => 'Tough exterior', 'image' => '17.jpg'],
            ['name' => 'Duke', 'trait' => 'Noble heart', 'image' => '18.jpg'],
            ['name' => 'Tucker', 'trait' => 'Food enthusiast', 'image' => '19.jpg'],
            ['name' => 'Oliver', 'trait' => 'Sophisticated pup', 'image' => '20.jpg'],
            ['name' => 'Jack', 'trait' => 'Energetic runner', 'image' => '21.jpg'],
            ['name' => 'Zeus', 'trait' => 'Mighty leader', 'image' => '22.jpg'],
            ['name' => 'Daisy', 'trait' => 'Sweet and gentle', 'image' => '1.jpg'],
            ['name' => 'Lucy', 'trait' => 'Playful spirit', 'image' => '2.jpg'],
            ['name' => 'Molly', 'trait' => 'Caring nature', 'image' => '3.jpg'],
            ['name' => 'Sadie', 'trait' => 'Adventure seeker', 'image' => '4.jpg'],
            ['name' => 'Maggie', 'trait' => 'Smart cookie', 'image' => '5.jpg'],
            ['name' => 'Bailey', 'trait' => 'Happy-go-lucky', 'image' => '6.jpg'],
            ['name' => 'Sophie', 'trait' => 'Elegant dancer', 'image' => '7.jpg'],
            ['name' => 'Chloe', 'trait' => 'Fashion forward', 'image' => '8.jpg'],
            ['name' => 'Lola', 'trait' => 'Drama queen', 'image' => '9.jpg'],
            ['name' => 'Nala', 'trait' => 'Brave explorer', 'image' => '10.jpg'],
            ['name' => 'Ruby', 'trait' => 'Precious gem', 'image' => '11.jpg'],
            ['name' => 'Penny', 'trait' => 'Lucky charm', 'image' => '12.jpg'],
            ['name' => 'Rosie', 'trait' => 'Sweet smelling', 'image' => '13.jpg'],
            ['name' => 'Zoe', 'trait' => 'Full of life', 'image' => '14.jpg'],
            ['name' => 'Stella', 'trait' => 'Bright star', 'image' => '15.jpg'],
            ['name' => 'Ginger', 'trait' => 'Spicy personality', 'image' => '16.jpg'],
            ['name' => 'Piper', 'trait' => 'Musical soul', 'image' => '17.jpg'],
            ['name' => 'Ivy', 'trait' => 'Natural climber', 'image' => '18.jpg'],
            ['name' => 'Honey', 'trait' => 'Sweet disposition', 'image' => '19.jpg'],
            ['name' => 'Maya', 'trait' => 'Mysterious ways', 'image' => '20.jpg'],
            ['name' => 'Coco', 'trait' => 'Rich personality', 'image' => '21.jpg'],
            ['name' => 'Koda', 'trait' => 'Wild spirit', 'image' => '22.jpg'],
            ['name' => 'Finn', 'trait' => 'Water lover', 'image' => '1.jpg'],
            ['name' => 'Oscar', 'trait' => 'Award winner', 'image' => '2.jpg'],
            ['name' => 'Leo', 'trait' => 'King of jungle', 'image' => '3.jpg'],
            ['name' => 'Mochi', 'trait' => 'Soft and squishy', 'image' => '4.jpg'],
            ['name' => 'Benny', 'trait' => 'Good fortune', 'image' => '5.jpg'],
            ['name' => 'Gus', 'trait' => 'Old soul', 'image' => '6.jpg'],
            ['name' => 'Winston', 'trait' => 'Distinguished gentleman', 'image' => '7.jpg'],
            ['name' => 'Jasper', 'trait' => 'Precious stone', 'image' => '8.jpg'],
            ['name' => 'Otis', 'trait' => 'Wealth of joy', 'image' => '9.jpg'],
            ['name' => 'Bruno', 'trait' => 'Brown beauty', 'image' => '10.jpg'],
            ['name' => 'Harley', 'trait' => 'Free rider', 'image' => '11.jpg'],
            ['name' => 'Ziggy', 'trait' => 'Zigzag runner', 'image' => '12.jpg'],
            ['name' => 'Apollo', 'trait' => 'Sun god', 'image' => '13.jpg'],
            ['name' => 'Baxter', 'trait' => 'Baker buddy', 'image' => '14.jpg'],
            ['name' => 'Chester', 'trait' => 'Fortress strong', 'image' => '15.jpg'],
            ['name' => 'Diego', 'trait' => 'Supplanter', 'image' => '16.jpg'],
            ['name' => 'Felix', 'trait' => 'Happy cat', 'image' => '17.jpg'],
            ['name' => 'Hank', 'trait' => 'Estate ruler', 'image' => '18.jpg'],
            ['name' => 'Jax', 'trait' => 'God gracious', 'image' => '19.jpg'],
            ['name' => 'King', 'trait' => 'Royal blood', 'image' => '20.jpg'],
            ['name' => 'Louie', 'trait' => 'Famous warrior', 'image' => '21.jpg'],
            ['name' => 'Murphy', 'trait' => 'Sea warrior', 'image' => '22.jpg'],
            ['name' => 'Nina', 'trait' => 'Little girl', 'image' => '1.jpg'],
            ['name' => 'Olive', 'trait' => 'Peace symbol', 'image' => '2.jpg'],
            ['name' => 'Princess', 'trait' => 'Royal lady', 'image' => '3.jpg'],
            ['name' => 'Quinn', 'trait' => 'Wise counsel', 'image' => '4.jpg'],
            ['name' => 'Roxy', 'trait' => 'Bright flame', 'image' => '5.jpg'],
            ['name' => 'Sasha', 'trait' => 'Defender', 'image' => '6.jpg'],
            ['name' => 'Tessa', 'trait' => 'Harvester', 'image' => '7.jpg'],
            ['name' => 'Uma', 'trait' => 'Nation', 'image' => '8.jpg'],
            ['name' => 'Violet', 'trait' => 'Purple flower', 'image' => '9.jpg'],
            ['name' => 'Willow', 'trait' => 'Graceful tree', 'image' => '10.jpg'],
            ['name' => 'Xena', 'trait' => 'Warrior princess', 'image' => '11.jpg'],
            ['name' => 'Yuki', 'trait' => 'Snow happiness', 'image' => '12.jpg'],
            ['name' => 'Zara', 'trait' => 'Blooming flower', 'image' => '13.jpg'],
            ['name' => 'Ace', 'trait' => 'Number one', 'image' => '14.jpg'],
            ['name' => 'Bandit', 'trait' => 'Sneaky thief', 'image' => '15.jpg'],
            ['name' => 'Cash', 'trait' => 'Valuable treasure', 'image' => '16.jpg'],
            ['name' => 'Diesel', 'trait' => 'Powerful engine', 'image' => '17.jpg'],
            ['name' => 'Echo', 'trait' => 'Sound return', 'image' => '18.jpg'],
            ['name' => 'Flash', 'trait' => 'Lightning fast', 'image' => '19.jpg'],
            ['name' => 'Ghost', 'trait' => 'Mysterious spirit', 'image' => '20.jpg'],
            ['name' => 'Hunter', 'trait' => 'Skilled tracker', 'image' => '21.jpg'],
            ['name' => 'Indie', 'trait' => 'Independent soul', 'image' => '22.jpg'],
            ['name' => 'Jazz', 'trait' => 'Musical rhythm', 'image' => '1.jpg'],
            ['name' => 'Knox', 'trait' => 'Round hill', 'image' => '2.jpg'],
            ['name' => 'Link', 'trait' => 'Connection maker', 'image' => '3.jpg'],
            ['name' => 'Matrix', 'trait' => 'Reality bender', 'image' => '4.jpg'],
            ['name' => 'Neo', 'trait' => 'The one', 'image' => '5.jpg'],
            ['name' => 'Orion', 'trait' => 'Star hunter', 'image' => '6.jpg'],
            ['name' => 'Phoenix', 'trait' => 'Rising fire', 'image' => '7.jpg'],
            ['name' => 'Quest', 'trait' => 'Adventure seeker', 'image' => '8.jpg'],
            ['name' => 'Ranger', 'trait' => 'Forest guardian', 'image' => '9.jpg'],
            ['name' => 'Storm', 'trait' => 'Weather master', 'image' => '10.jpg'],
            ['name' => 'Titan', 'trait' => 'Giant strength', 'image' => '11.jpg'],
            ['name' => 'Ultra', 'trait' => 'Beyond limits', 'image' => '12.jpg'],
            ['name' => 'Viper', 'trait' => 'Quick striker', 'image' => '13.jpg'],
            ['name' => 'Wolf', 'trait' => 'Pack leader', 'image' => '14.jpg'],
            ['name' => 'Xerxes', 'trait' => 'Royal ruler', 'image' => '15.jpg'],
            ['name' => 'Yoda', 'trait' => 'Wise master', 'image' => '16.jpg'],
            ['name' => 'Zorro', 'trait' => 'Masked hero', 'image' => '17.jpg'],
            ['name' => 'Angel', 'trait' => 'Heaven sent', 'image' => '18.jpg'],
            ['name' => 'Blaze', 'trait' => 'Fire spirit', 'image' => '19.jpg'],
            ['name' => 'Clover', 'trait' => 'Lucky leaf', 'image' => '20.jpg'],
            ['name' => 'Dash', 'trait' => 'Speed demon', 'image' => '21.jpg'],
            ['name' => 'Ember', 'trait' => 'Glowing coal', 'image' => '22.jpg'],
        ];

        $user = User::first();

        $optimizer = new OptimizeWebpImageAction;

        foreach ($puppies as $puppy) {
            $input = storage_path("app/seeders/images/{$puppy['image']}");
            $optimized = $optimizer->handle($input);
            $path = 'puppies/'.$optimized['fileName'];

            $stored = config('filesystems.default') === 's3'
                ? Storage::put($path, $optimized['webpString'], 'public')
                : Storage::disk('public')->put($path, $optimized['webpString']);

            Puppy::create([
                'user_id' => $user->id,
                'name' => $puppy['name'],
                'trait' => $puppy['trait'],
                'image_url' => $stored ? $path : null,
            ]);
        }
    }
}
