<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- THE FIX: Import the Auth facade

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        // Now the editor understands this line correctly
        $users = User::where('id', '!=', Auth::id())->get();
        return view('users.index', compact('users'));
    }

    /**
     * Toggle the status of a specific user.
     */
    public function toggleStatus(User $user)
    {
        // Change the status
        $newStatus = $user->status == 'active' ? 'inactive' : 'active';
        $user->update(['status' => $newStatus]);

        // Redirect back with a success message
        return redirect()->route('users.index')->with('success', "User status successfully changed to {$newStatus}.");
    }
}