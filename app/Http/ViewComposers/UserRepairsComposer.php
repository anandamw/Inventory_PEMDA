<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Repair;

class UserRepairsComposer
{
    public function compose(View $view)
    {
        $userRepairs = [];

        if (Auth::check()) {
            $userRepairs = Repair::where('user_id', Auth::id())
                ->with('admin')
                ->orderBy('scheduled_date', 'desc')
                ->get();
        }

        $view->with('userRepairs', $userRepairs);
    }
}
