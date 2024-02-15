<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $galery = Galery::where('id_user', $user->id)->latest()->get();

        return view('Page.timeline', compact('galery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'foto' => 'required|file|mimes:jpg,png,svg,gif'
        ]);

        if ($validator->fails()) {
            return back()->with('alert', 'Pastikan Anda mengunggah foto dengan ekstensi jpg, png,gif, atau svg!!!.');
        }

        $nfile = $user->id . date('YmdHis') . '.' . $request->foto->getClientOriginalExtension();
        $request->foto->move(public_path('img'), $nfile);

        $data = [
            'id_user' => $user->id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $nfile,
        ];

        Galery::create($data);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        Galery::where('id', $id)->delete();

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galery $galery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if (isset($request->foto)) {
            $validator = Validator::make($request->all(), [
                'foto' => 'required|file|mimes:jpg,png,svg,gif'
            ]);

            if ($validator->fails()) {
                return back()->with('alert', 'Pastikan Anda mengunggah foto dengan ekstensi jpg, png,gif, atau svg!!!.');
            }

            $nfile = $user->id . date('YmdHis') . '.' . $request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('img'), $nfile);

            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'foto' => $nfile,
            ];

            Galery::where('id', $id)->update($data);

            return back();
        } else {
            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ];

            Galery::where('id', $id)->update($data);

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galery $galery)
    {
        //
    }
}
