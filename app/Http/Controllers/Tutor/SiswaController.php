<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Kursus;
use Illuminate\Http\Request;
use App\Siswa;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_tutor = Auth::id();
        $siswa = Siswa::where('id_tutor', $id_tutor)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('tutor.siswa.index', [
            'siswa' => $siswa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id_tutor = Auth::id();
        $kursus= Kursus::where('id_tutor', $id_tutor)->get();
        return view('tutor.siswa.create', [
            'kursus' => $kursus
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa'               => 'required|max:255|min:3',
            'jenis_kelamin'            => 'required|in:L,P',
            'alamat'                   => 'required|max:255|min:3',
            'id_kursus'                => 'required|numeric|min:1',
            'foto'                     => 'required|image|mimes:jpeg,jpg,png,bmp',
            'username'                 => 'required|max:255|min:3|unique:siswa',
            'password'                 => 'required|max:255|min:3',
            'konfirmasi_password'      => 'required|same:password|max:255|min:3',
        ]);

        $data = $request->all();
        $data['id_tutor'] = Auth::id();
        $data['password'] = bcrypt($data['password']);
        $data['foto'] =  $request->file('foto')->store('siswa', 'public');

        Siswa::create($data);
        return redirect()->route('siswa.index')
            ->with(['status' => 'Data Siswa Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('tutor.siswa.show', [
            'siswa' => $siswa
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('tutor.siswa.edit', [
            'siswa' => $siswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_siswa'               => 'required|max:255|min:3',
            'jenis_kelamin'            => 'required|in:L,P',
            'alamat'                   => 'required|max:255|min:3',
            'foto'                     => 'sometimes|nullable|image|mimes:jpeg,jpg,png,bmp',
            'username'                 => 'required|max:255|min:3|unique:siswa,username,' . $id,
            'password'                 => 'sometimes|nullable|max:255|min:3',
            'konfirmasi_password'      => 'sometimes|nullable|same:password|max:255|min:3',
        ]);

        $siswa = Siswa::findOrFail($id);
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        if ($request->hasFile('foto')) {
            if ($request->file('foto')) {
                if ($siswa->foto && file_exists(storage_path('app/public/' . $siswa->foto))) {
                    Storage::delete('public/' . $siswa->foto);
                    $file = $request->file('foto')->store('siswa', 'public');
                    $data['foto'] = $file;
                }
            }
        }

        $siswa->update($data);
        return redirect()->route('siswa.index')->with([
            'status' => 'Data Siswa Berhasil Di Update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        Storage::delete('public/' . $siswa->foto);
        $siswa->delete();

        return redirect()->route('siswa.index')
            ->with(['status' => 'Data Siswa Berhasil Dihapus']);
    }

    public function nilai($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('tutor.siswa.nilai', [
            'siswa' => $siswa
        ]);
    }

    public function add_nilai(Request $request, $id)
    {
        $request->validate([
            'nilai'      => 'required|numeric|min:0|max:100',
            'keterangan' => 'required'
        ]);

        $siswa = Siswa::findOrFail($id);
        $data = $request->all();
        // $data['id_tutor'] = Auth::id();
        $siswa->update($data);

        return redirect()->back()
            ->with(['status' => 'Data Nilai Siswa Berhasil Ditambah']);
    }
}
