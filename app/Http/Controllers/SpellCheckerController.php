<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SpellCheckerController extends Controller
{
    public function index()
    {
        return view('spell-checker.index', [
            'result' => '',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'sentence' => ['required', 'string'],
            'words' => ['required', 'string'],
        ]);

        $sentence = Str::of($request->input('sentence'))->trim()->replace(' ', '');
        $sentence = str_split($sentence);

        $words = Str::of($request->input('words'))->trim()->replace(' ', '');
        $words = str_split($words);

        $words_count = collect($words)->count();
        $intersect_count = collect($words)->intersect($sentence)->count();

        $result = ($intersect_count / $words_count) * 100 . '%';

        return view('spell-checker.index', compact('result'));
    }
}
