<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use DOMDocument;
use DOMXPath;

class NewsController extends Controller
{
    public function index()
    {
        $news = Cache::remember('basketball_news', 3600, function () {
            return $this->fetchNews();
        });

        return view('news', compact('news'));
    }

    private function fetchNews()
    {
        try {
            // Fetch ESPN NBA RSS feed
            $response = Http::get('https://www.espn.com/espn/rss/nba/news');
            $xmlContent = $response->body();

            // Create a new DOM document
            $doc = new DOMDocument();
            $doc->loadXML($xmlContent);

            // Create an XPath object
            $xpath = new DOMXPath($doc);

            // Register the default namespace if present
            $xpath->registerNamespace('ns', 'http://search.yahoo.com/mrss/');

            // Get all items
            $items = $xpath->query('//item');
            $news = [];

            foreach ($items as $item) {
                $title = $xpath->query('title', $item)->item(0)->nodeValue;
                $description = $xpath->query('description', $item)->item(0)->nodeValue;
                $link = $xpath->query('link', $item)->item(0)->nodeValue;
                $pubDate = $xpath->query('pubDate', $item)->item(0)->nodeValue;

                $news[] = [
                    'title' => $title,
                    'description' => $description,
                    'link' => $link,
                    'date' => $pubDate
                ];
            }

            return array_slice($news, 0, 12); // Return only the first 12 items

        } catch (\Exception $e) {
            \Log::error('Error fetching news: ' . $e->getMessage());
            return [];
        }
    }
} 