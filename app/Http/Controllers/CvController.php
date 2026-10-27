<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CvController extends Controller
{
    public function index()
    {
        $cvs = Cv::latest()->get();
        return view('cv.admin', compact('cvs'));
    }

    public function create()
    {
        return view('cv.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:30',
            'pendidikan' => 'nullable|string|max:255',
            'keahlian' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'video' => 'nullable|file|mimes:mp4|max:20480',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('foto-cv', 'public');
        }

        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')
                ->store('video-cv', 'public');
        }

        Cv::create($data);

        return redirect()->route('cv.index')
            ->with('success', 'CV berhasil ditambahkan.');
    }

    public function show(Cv $cv)
    {
        return view('cv.show', compact('cv'));
    }

    public function edit(Cv $cv)
    {
        return view('cv.edit', compact('cv'));
    }

    public function update(Request $request, Cv $cv)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:30',
            'pendidikan' => 'nullable|string|max:255',
            'keahlian' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'video' => 'nullable|file|mimes:mp4|max:20480',
        ]);

        if ($request->hasFile('foto')) {
            if ($cv->foto) {
                Storage::disk('public')->delete($cv->foto);
            }

            $data['foto'] = $request->file('foto')
                ->store('foto-cv', 'public');
        }

        if ($request->hasFile('video')) {
            if ($cv->video) {
                Storage::disk('public')->delete($cv->video);
            }

            $data['video'] = $request->file('video')
                ->store('video-cv', 'public');
        }

        $cv->update($data);

        return redirect()->route('cv.index')
            ->with('success', 'CV berhasil diperbarui.');
    }

    public function destroy(Cv $cv)
    {
        if ($cv->foto) {
            Storage::disk('public')->delete($cv->foto);
        }

        if ($cv->video) {
            Storage::disk('public')->delete($cv->video);
        }

        $cv->delete();

        return redirect()->route('cv.index')
            ->with('success', 'CV berhasil dihapus.');
    }
}
