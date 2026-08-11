<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        $users      = $query->paginate(4)->withQueryString();
        $totalUsers = User::count();
        $adminCount = User::where('role', 'admin')->count();

        // Unique countries & cities for filter dropdowns
        $countries = User::whereNotNull('country')->distinct()->orderBy('country')->pluck('country');
        $cities    = User::whereNotNull('city')->distinct()->orderBy('city')->pluck('city');

        // New this month
        $newThisMonth = User::whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year)
                            ->count();

        return view('admin.all_users', compact(
            'users', 'totalUsers', 'adminCount',
            'newThisMonth', 'countries', 'cities'
        ));
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $query = User::query();

        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        $users = $query->get();

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users_' . now()->format('Y-m-d') . '.csv"',
        ];

        return response()->stream(function () use ($users) {
            $handle = fopen('php://output', 'w');

            // CSV header row
            fputcsv($handle, ['S.No', 'First Name', 'Last Name', 'Email', 'Role', 'Country', 'City', 'Phone', 'Joined']);

            foreach ($users as $i => $user) {
                fputcsv($handle, [
                    str_pad($i + 1, 2, '0', STR_PAD_LEFT),
                    $user->first_name,
                    $user->last_name,
                    $user->email,
                    ucfirst($user->role),
                    $user->country,
                    $user->city,
                    $user->phone,
                    $user->created_at->format('Y-m-d'),
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }

    public function destroy(User $user)
    {
        // Delete profile image from storage if it exists
        if ($user->image) {
            // Since $user->image is "avatars/avatar_user2_1782718914.png",
            // using the "public" disk will look perfectly inside storage/app/public/avatars/...
            if (Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
        }

        $user->delete();

        return redirect()->route('all_users')->with('success', 'User deleted successfully.');
    }
}