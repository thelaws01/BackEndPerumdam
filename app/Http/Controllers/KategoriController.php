<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use Alert;
use Redirect;

class KategoriController extends Controller
{

    public function __construct(Kategori $kategori)
    {
        $this->kategori = $kategori;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->kategori->latest()->get();
        return view('epanel.mobile.kategori.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('epanel.mobile.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $this->kategori->create($data);
        alert()->success('Berhasil Buat Kategori');
        return Redirect::route('kategori.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->kategori->where('id', $id)->get();
        return view('epanel.mobile.kategori.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {   
        $data = $this->kategori->where('id', $request->id)->first();
        $data->label = $request->label;
        $data->nilai = $request->nilai;
        $data->save();
        alert()->success('Berhasil Ubah Data Kategori');
        return Redirect::route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->kategori->where('id', $id)->first();
        $data->delete();
        alert()->success('Berhasil Hapus Kategori');
        return redirect()->back();
    }
}
