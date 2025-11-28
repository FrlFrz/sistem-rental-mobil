<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $cars = collect([
            [
                'title' => 'McLaren P1',
                'transmission' => 'Automatic',
                'seats' => 2,
                'bags' => 2,
                'ac' => true,
                'price' => 'Rp 20.000.000,00/day',
                'status' => 'Available',
                'image' => '#'
            ],
            [
                'title' => 'McLaren P1',
                'transmission' => 'Automatic',
                'seats' => 2,
                'bags' => 2,
                'ac' => true,
                'price' => 'Rp 20.000.000,00/day',
                'status' => 'Unavailable',
                'image' => '#'
            ],
            [
                'title' => 'McLaren P1',
                'transmission' => 'Automatic',
                'seats' => 2,
                'bags' => 2,
                'ac' => true,
                'price' => 'Rp 20.000.000,00/day',
                'status' => 'Available',
                'image' => '#'
            ],
        ]);

        // filter / pagination sederhana bisa ditambahkan
        return view('layouts.katalog', compact('cars'));
    }
}
