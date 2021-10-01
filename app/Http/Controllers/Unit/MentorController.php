<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use App\Http\Requests\MentorRequest;
use App\KursusUnit;
use App\Mentor;
use App\MentorKursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class MentorController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Mentor::where('unit_id', Auth::id())->latest()->get();
            return DataTables::of($query)
                ->addColumn('option', function ($item) {
                    return
                        '<div class="btn-group">
                            <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="icon icon-sm">
                                    <span class="fas fa-ellipsis-h icon-dark"></span>
                                </span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                <a class="dropdown-item" href="' . route('mentor.edit', $item->id) . '"><span class="fas fa-edit mr-2"></span>Sunting</a>
                                <form action="' . route('mentor.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button id="deleteButton" type="submit" class="dropdown-item text-danger" data-name="' . $item->nama_mentor .  '">
                                        <span class="fas fa-trash-alt mr-2"></span>Hapus</a>
                                    </button>
                                </form>
                            </div>
                        </div>';
                })
                ->editColumn('gambar_mentor', function ($item) {
                    return '<img src="' . Storage::url('public/' . $item->foto) . '" style="max-height: 40px;"/>';
                })
                ->rawColumns(['option', 'gambar_mentor'])
                ->make();
        }

        return view('unit.mentor.index');
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

    public function penempatan()
    {
        if (request()->ajax()) {
            $query = MentorKursus::query()->with(['kursus_unit', 'mentor'])
                ->whereHas('kursus_unit', function ($q) {
                    $q->where('unit_id', Auth::id());
                })
                ->latest();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return
                        '<div class="btn-group">
                            <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="icon icon-sm">
                                    <span class="fas fa-ellipsis-h icon-dark"></span>
                                </span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                <a class="dropdown-item" href="' . route('penempatan.edit', $item->id) . '"><span
                                class="fas fa-edit mr-2"></span>Detail</a>  
                                 <form action="' . route('penempatan.delete', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button id="deleteButton" type="submit" class="dropdown-item text-danger" data-name="' . $item->nama .  '">
                                        <span class="fas fa-trash-alt mr-2"></span>Hapus</a>
                                    </button>
                                </form>
                            </div>
                        </div>';
                })
                ->addColumn('nama_mentor', function ($item) {
                    return $item->mentor->nama_mentor;
                })
                ->addColumn('foto', function ($item) {
                    return '<img src="' . Storage::url('public/' . $item->mentor->foto) . '" style="max-height: 40px;"/>';
                })
                ->addColumn('kursus', function ($item) {
                    return $item->kursus_unit->kursus->nama_kursus;
                })
                ->rawColumns(['foto', 'action'])
                ->make();
        }

        return view('unit.mentor.penempatan_index');
    }

    public function create_penempatan()
    {
        $mentor = Mentor::where('unit_id', Auth::id())->get();
        $kursus_unit = KursusUnit::with('kursus')->where('unit_id',  Auth::id())->get();
        return view('unit.mentor.penempatan_create', compact('mentor', 'kursus_unit'));
    }

    public function store_penempatan(Request $request)
    {
        $request->validate([
            'mentor_id' => 'required|numeric',
            'kursus_unit_id' => 'required|numeric',
            'pengalaman' => 'required'
        ]);

        $cek_data = MentorKursus::where('mentor_id', $request->mentor_id)->where('kursus_unit_id', $request->kursus_unit_id)->first();

        if ($cek_data) {
            return redirect()->back()->with(['warning' => 'Mentor dan kursus tersebut sudah ada sebelumnya.']);
        } else {
            MentorKursus::create([
                'mentor_id' => $request->mentor_id,
                'kursus_unit_id' => $request->kursus_unit_id,
                'pengalaman' => $request->pengalaman
            ]);

            return redirect()->route('penempatan.index')
                ->with(['status' => 'Data Mentor Berhasil Ditambahkan']);
        }
    }

    public function edit_penempatan(MentorKursus $id)
    {
        $mentor = Mentor::where('unit_id', Auth::id())->get();
        $kursus_unit = KursusUnit::with('kursus')->where('unit_id',  Auth::id())->get();
        return view('unit.mentor.penempatan_edit', [
            'mentor_kursus' => $id,
            'mentor' => $mentor,
            'kursus_unit' => $kursus_unit
        ]);
    }

    public function update_penempatan(Request $request, $id)
    {
        $request->validate([
            'mentor_id' => 'required|numeric',
            'kursus_unit_id' => 'required|numeric',
            'pengalaman' => 'required'
        ]);

        $cek_data = MentorKursus::where('mentor_id', $request->mentor_id)
            ->where('kursus_unit_id', $request->kursus_unit_id)
            ->where('id', '!=', $id)
            ->first();

        if ($cek_data) {
            return redirect()->back()->with(['warning' => 'Mentor dan kursus tersebut sudah ada sebelumnya.']);
        } else {
            $mentor_kursus = MentorKursus::find($id);
            $data = $request->all();
            $mentor_kursus->update($data);

            return redirect()->route('penempatan.index')
                ->with(['status' => 'Data Mentor Berhasil Diupdate.']);
        }
    }

    public function delete_penempatan($id)
    {
        $mentor_kursus = MentorKursus::find($id);
        $mentor_kursus->delete();
        return redirect()->route('penempatan.index')
            ->with(['status' => 'Data penempatan mentor berhasil dihapus']);
    }
}
