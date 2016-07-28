<?php

use App\CMSMenu;
use Illuminate\Database\Seeder;

class CMSMenuTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = [
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'description' => nl2br('Contrary to popular belief, Lorem Ipsum is not simply random text
                   It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. 
                   Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. 
                   This book is a treatise on the theory of ethics, very popular during the Renaissance. 
                   The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet...'),
                'image' => 'test.jpg',
                'meta_title' => 'About Us',
                'meta_keyword' => 'About Us',
                'meta_description' => 'About Us',
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact-us',
                'description' => nl2br('Contrary to popular belief, Lorem Ipsum is not simply random text
                   It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. 
                   Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. 
                   This book is a treatise on the theory of ethics, very popular during the Renaissance. 
                   The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet...'),
                'image' => 'test.jpg',
                'meta_title' => 'Contact Us',
                'meta_keyword' => 'Contact Us',
                'meta_description' => 'Contact Us',
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title' => 'Terms And Condtion',
                'slug' => 'terms-and-condtion',
                'description' => nl2br('Contrary to popular belief, Lorem Ipsum is not simply random text
                   It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. 
                   Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. 
                   This book is a treatise on the theory of ethics, very popular during the Renaissance. 
                   The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet...'),
                'image' => 'test.jpg',
                'meta_title' => 'Terms And Condtion',
                'meta_keyword' => 'Terms And Condtion',
                'meta_description' => 'Terms And Condtion',
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'description' => nl2br('Contrary to popular belief, Lorem Ipsum is not simply random text
                   It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. 
                   Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. 
                   This book is a treatise on the theory of ethics, very popular during the Renaissance. 
                   The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet...'),
                'image' => 'test.jpg',
                'meta_title' => 'Privacy Policy',
                'meta_keyword' => 'Privacy Policy',
                'meta_description' => 'Privacy Policy',
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ]
        ];
        foreach($content as $item) {
            CMSMenu::create($item);
        }
    }

}