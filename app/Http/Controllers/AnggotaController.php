<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        $anggotas = Anggota::when($query, function ($q) use ($query) {
            $q->where('nama_anggota', 'like', "%{$query}%")
              ->orWhere('alamat', 'like', "%{$query}%")
              ->orWhere('no_hp', 'like', "%{$query}%");
        })->paginate(10);
        return view('anggotas.index', compact('anggotas', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('anggotas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_anggota' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        Anggota::create($request->all());

        return redirect()->route('anggotas.index')->with('berhasil', 'Anggota berhasil ditambahkan!!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggotas.show', compact('anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggotas.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_anggota' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        $anggota = Anggota::findOrFail($id);
        $anggota->update($request->all());

        return redirect()->route('anggotas.index')->with('berhasil', 'Anggota berhasil diupdate!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggotas.index')->with('berhasil', 'Anggota berhasil dihapus!!');
    }
}
