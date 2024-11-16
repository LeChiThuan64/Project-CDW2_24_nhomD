<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    public function run()
    {
        DB::table('blogs')->insert([
            [
                'user_id' => 1,
                'title' => 'Blog Title 1',
                'content' => 'This is the extended content of blog 1. It provides more detailed information about the topic and engages the reader by explaining the background, key points, and conclusions.',
                'created_at' => '2024-10-22 15:28:15',
                'updated_at' => null,
                'image_url' => 'uploads/blog-1.jpg',
            ],
            [
                'user_id' => 2,
                'title' => 'Blog Title 2',
                'content' => 'This is the extended content of blog 2. The blog discusses an important topic, exploring it in depth while offering insights and actionable advice to the readers.',
                'created_at' => '2024-10-22 15:28:15',
                'updated_at' => null,
                'image_url' => 'uploads/blog-2.jpg',
            ],
            [
                'user_id' => 3,
                'title' => 'Blog Title 3',
                'content' => 'This is the extended content of blog 3. It dives into various aspects of the subject, providing a thorough analysis and making it easier for readers to grasp the core concepts.',
                'created_at' => '2024-10-22 15:28:15',
                'updated_at' => null,
                'image_url' => 'uploads/blog-3.jpg',
            ],
            [
                'user_id' => 1,
                'title' => 'Blog Title 4',
                'content' => 'This is the extended content of blog 4. In this blog, the writer expands on the topic and adds personal experiences, making it relatable and more interesting for the audience.',
                'created_at' => '2024-10-22 15:28:15',
                'updated_at' => null,
                'image_url' => 'uploads/blog-4.jpg',
            ],
            [
                'user_id' => 3,
                'title' => 'Blog Title 5',
                'content' => 'This is the extended content of blog 5. It covers several key aspects, backed up by research and examples, making the blog informative and valuable for readers.',
                'created_at' => '2024-10-22 15:28:15',
                'updated_at' => null,
                'image_url' => 'uploads/blog-5.jpg',
            ],
            [
                'user_id' => 2,
                'title' => 'Blog Title 6',
                'content' => 'This is the extended content of blog 6. The blog offers comprehensive information on the topic, aiming to educate the reader with useful knowledge and practical takeaways.',
                'created_at' => '2024-10-22 15:28:15',
                'updated_at' => null,
                'image_url' => 'uploads/blog-6.jpg',
            ],
            [
                'user_id' => 1,
                'title' => 'Blog Title 7',
                'content' => 'This is the extended content of blog 7. It highlights critical aspects of the subject, drawing the reader\'s attention to new and insightful perspectives.',
                'created_at' => '2024-10-22 15:28:15',
                'updated_at' => null,
                'image_url' => 'uploads/blog-7.jpg',
            ],
            [
                'user_id' => 2,
                'title' => 'Blog Title 8',
                'content' => 'This is the extended content of blog 8. In this blog, readers can find a detailed discussion of the topic with examples that illustrate the main points effectively.',
                'created_at' => '2024-10-22 15:28:15',
                'updated_at' => null,
                'image_url' => 'uploads/blog-8.jpg',
            ],
            [
                'user_id' => 3,
                'title' => 'Blog Title 9',
                'content' => 'This is the extended content of blog 9. It takes the reader through a logical progression of ideas, offering practical advice and real-world applications.',
                'created_at' => '2024-10-22 15:28:15',
                'updated_at' => null,
                'image_url' => 'uploads/blog-9.jpg',
            ],
            [
                'user_id' => 1,
                'title' => 'Blog Title 10',
                'content' => 'This is the extended content of blog 10. This blog is packed with valuable insights, providing readers with in-depth knowledge on the topic and how they can apply it in their own lives.',
                'created_at' => '2024-10-22 15:28:15',
                'updated_at' => null,
                'image_url' => 'uploads/blog-10.jpg',
            ],
        ]);
    }
}
