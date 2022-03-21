<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['food','movies','animals','tech'];

        foreach ($tags as $value) {
            $newTag = new Tag();
            $newTag->name = $value;
            $newTag->slug = Str::slug($value);
            $newTag->save();
        }
    }
}
