<?
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LeaderboardController extends Controller
{
    public function index()
    {
        $dailyWinners = User::withCount(['games as wins' => function($query) {
            $query->where('winner_id', '!=', null)
                  ->whereDate('updated_at', today());
        }])->orderBy('wins', 'desc')->take(10)->get();

        $weeklyWinners = User::withCount(['games as wins' => function($query) {
            $query->where('winner_id', '!=', null)
                  ->whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()]);
        }])->orderBy('wins', 'desc')->take(10)->get();

        $allTimeWinners = User::withCount(['games as wins' => function($query) {
            $query->where('winner_id', '!=', null);
        }])->orderBy('wins', 'desc')->take(10)->get();

        return view('welcome', [
            'dailyWinners' => $dailyWinners,
            'weeklyWinners' => $weeklyWinners,
            'allTimeWinners' => $allTimeWinners
        ]);
    }
}
