<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SettingSeeder::class);

        // Create Admin
        $admin = User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        // Create Categories
        $categories = ['Teknologi', 'Gaya Hidup', 'Desain', 'Pengembangan', 'Budaya'];
        foreach ($categories as $name) {
            Category::create(['name' => $name, 'slug' => Str::slug($name)]);
        }

        // Create Tags
        $tags = ['Laravel', 'Tailwind', 'AI', 'Minimalisme', 'Kreatif', 'Masa Depan', 'UI/UX', 'Coding', 'Menulis', 'Ide'];
        foreach ($tags as $name) {
            Tag::create(['name' => $name, 'slug' => Str::slug($name)]);
        }

        // Create Posts
        $catIds = Category::pluck('id')->toArray();
        $tagIds = Tag::pluck('id')->toArray();

        for ($i = 1; $i <= 20; $i++) {
            $title = "Judul Artikel Sampel {$i}";
            $post = Post::create([
                'user_id' => $admin->id,
                'category_id' => $catIds[array_rand($catIds)],
                'title' => $title,
                'slug' => Str::slug($title),
                'excerpt' => "Ini adalah kutipan singkat untuk artikel sampel {$i}. Kutipan ini menjelaskan isi artikel dengan gaya minimalis.",
                'content' => "<p>Ini adalah konten utama untuk artikel {$i}.</p><p>Konten ini berisi beberapa paragraf untuk menguji pengalaman membaca dan bar kemajuan pembaca. Minimalisme adalah tentang kesederhanaan dan kejelasan.</p><h2>Ide Utama</h2><p>Ketika kita menulis dengan tujuan, setiap kata sangat berarti. Di portal ini, kita fokus pada esensi pesan.</p><blockquote>'Kesederhanaan adalah kecanggihan tertinggi.' - Leonardo da Vinci</blockquote><p>Kami harap Anda menikmati pengalaman menulis minimalis ini.</p>",
                'reading_time' => rand(2, 10),
                'status' => 'published',
                'published_at' => now()->subDays(rand(1, 30)),
            ]);

            $post->tags()->sync(array_rand(array_flip($tagIds), rand(2, 4)));
        }
    }
}
