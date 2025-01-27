namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Article;
use Http;

class ScrapeArticles extends Command
{
    protected $signature = 'scrape:articles';
    protected $description = 'Scrape articles from selected APIs';

    public function handle()
    {
        // Example for NewsAPI
        $response = Http::get('https://newsapi.org/v2/everything', [
            'apiKey' => env('NEWSAPI_KEY'),
            'q' => 'technology',
        ]);

        $articles = $response->json()['articles'];

        foreach ($articles as $article) {
            Article::updateOrCreate(
                ['title' => $article['title']],
                [
                    'content' => $article['content'],
                    'source' => $article['source']['name'],
                    'category' => 'technology',
                    'author' => $article['author'],
                    'published_at' => $article['publishedAt'],
                ]
            );
        }

        $this->info('Articles scraped successfully!');
    }
} 