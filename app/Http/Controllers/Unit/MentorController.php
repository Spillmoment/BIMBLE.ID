<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use App\Http\Requests\MentorRequest;
use App\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MentorController extends Controller
{
    public function index()
    {
        return view('unit.mentor.index', [
            'mentor' => Mentor::where('unit_id', Auth::id())->get()
        ]);
    }


    public function create()
    {
        return view('unit.mentor.create');
    }


    public function store(Request $request)
    {
        Mentor::create([
            'unit_id' => Auth::id(),
            'nama_mentor' => $request->nama_mentor,
            'kompetensi' => $request->kompetensi,
            'foto'  => $request->file('foto')->store('mentor', 'public'),
        ]);

        return redirect()->route('mentor.index')
            ->with(['status' => 'Data Mentor Berhasil Ditambahkan']);
    }


    public function show(Mentor $mentor)
    {
        // return view('unit.mentor.show', compact('mentor'));
    }


    public function edit(Mentor $mentor)
    {
        return view('unit.mentor.edit', compact('mentor'));
    }


    public function update(MentorRequest $request, Mentor $mentor)
    {
        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($mentor->foto && file_exists(storage_path('app/public/' . $mentor->foto))) {
                Storage::delete('public/' . $mentor->foto);
                $data['foto'] =  $request->file('foto')->store('mentor', 'public');
            } else {
                $data['foto'] =  $request->file('foto')->store('mentor', 'public');
            }
        }

        $mentor->update($data);
        return redirect()->route('mentor.index')->with(['status' => 'Data Mentor Berhasil Di Update']);
    }


    public function destroy(Mentor $mentor)
    {
        Storage::delete('public/' . $mentor->foto);
        $mentor->forceDelete();
        return redirect()->route('mentor.index')
            ->with(['status' => 'Data mentor Berhasil Dihapus']);
    }
}
