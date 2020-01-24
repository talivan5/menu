<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function index()
    {
        $notas = \App\Nota::all();

        return view('notas.index', compact('notas'));
    }
    public function destroy($id)
    {
        \App\Nota::findOrFail($id)->delete();

        return redirect()->back();
    }
}
