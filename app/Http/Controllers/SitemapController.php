<?php

namespace App\Http\Controllers;

use App\Models\Stores;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function generate()
    {
        // Create a new sitemap instance
        $sitemap = Sitemap::create();

        // Add static URLs
        $sitemap->add(Url::create('/')
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(1.0));

        $sitemap->add(Url::create('/about')
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority(0.8));

        // Add dynamic URLs (e.g., from a database)
        $posts = Stores::all(); // Fetch all posts
        foreach ($posts as $post) {
            $sitemap->add(Url::create("/store/{$post->slug}")
                ->setLastModificationDate($post->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        }

        // Save the sitemap to a file
        $sitemap->writeToFile(public_path('sitemap.xml'));

        return 'Sitemap generated successfully!';
    }
}
