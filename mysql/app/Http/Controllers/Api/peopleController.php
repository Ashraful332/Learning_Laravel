<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class peopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // সব ইউজার দেখাবে
    public function getUsers()
    {
        return response()->json(DB::select('SELECT * FROM users'));
    }

    // নতুন ইউজার যোগ করবে
    public function addUser(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');

        // DB::insert('INSERT INTO users (name, email) VALUES (?, ?)', [$name, $email]);
        DB::insert('INSERT INTO users (name, email) VALUES (?, ?)', ["nameMe", "name@nm.me"]);

        return response()->json(['message' => 'User added successfully']);
    }
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
