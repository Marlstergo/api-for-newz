namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function search(Request $request)
    {
        $query = Article::query();

        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%')
                  ->orWhere('content', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('source')) {
            $query->where('source', $request->source);
        }

        if ($request->filled('date')) {
            $query->whereDate('published_at', $request->date);
        }

        return $query->get();
    }
} 