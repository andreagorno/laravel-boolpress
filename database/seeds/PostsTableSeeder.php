<?php

use Illuminate\Database\Seeder;
use App\Post;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 10; $i++) {
            
            $newPost = new Post();

            $newPost->title = "Titolo articolo" . $i;
            $newPost->content = "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Tenetur, voluptate amet tempora maiores beatae minima. Beatae voluptates architecto maiores quidem minus deserunt voluptate, placeat minima accusantium dolorem consectetur eius ipsam aspernatur, animi doloribus non esse officiis nobis aliquid tempora expedita numquam ut quos. Voluptatum iste animi nemo officia blanditiis tenetur iure, quis, maiores ratione quisquam atque maxime cupiditate deserunt dignissimos consequuntur fugiat dolorem dolore consequatur, temporibus eveniet quasi vero nam! Nostrum corrupti voluptates fugiat vitae minima sed maiores, vel, tempore provident in natus qui tenetur magni quibusdam laboriosam quaerat nemo. Nostrum accusamus alias hic nam quas tenetur at dolorem molestiae?" . $i;
            $newPost->slug = Str::slug($newPost->title,'-');

            $newPost->save();
        }
    }
}
