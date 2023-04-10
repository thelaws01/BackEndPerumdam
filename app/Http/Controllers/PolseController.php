<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Polsek;
use Redirect;
use Alert;
use Image;
use File;
use Storage;


class PolseController extends Controller
{

    public function __construct(Polsek $polsek)
    {
        $this->polsek = $polsek;
    }
   
    public function index()
    {
        $data = Polsek::all();
        return view('epanel.polsek.index', compact('data'));
    }

    public function create()
    {
        return view('epanel.polsek.create');
    }

    public function store(Request $request)
    {
        $data = new Polsek;
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->phone = $request->phone;
        $data->latitude = $request->latitude;
        $data->longitude = $request->longitude;
        if($request->hasFile('photo')):
            $data->photo = $this->upload2($request->file('photo'), $request->nama);
        endif;
        $data->user_id = $request->user_id;
        $data->save();
        alert()->success('Berhasil Tambah Data Polsek');
        return Redirect::route('polsek.index');
    }


    public function upload2($file, $filename)
    {
        $ekstensi = $file->getClientOriginalExtension();
        $image = Image::make($file)->resize(1024, null, function($constraint) {
            $constraint->aspectRatio();
        })->stream();
        $imageM = Image::make($file)->resize(500, 500)->stream();
        $imageS = Image::make($file)->resize(100, 100)->stream();
        Storage::disk('s3')->put('Aduan/Polsek/'.$filename.'_m.'.$ekstensi, $imageM, 'public');
        Storage::disk('s3')->put('Aduan/Polsek/'.$filename.'_s.'.$ekstensi, $imageS, 'public');
        Storage::disk('s3')->put('Aduan/Polsek/'.$filename.'.'.$ekstensi, $image, 'public');

        return Storage::disk('s3')->url('Aduan/Polsek/'.$filename.'.'.$ekstensi);
    }

    
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = $this->polsek->where('id', $id)->get();
        return view('epanel.polsek.edit', compact('data'));
    }

    public function update(Request $request, Polsek $polsek)
    {
        if($request->hasFile('photo')):
            awsImgDelete($polsek->photo);
            $data['photo'] = $this->upload2($request->file('photo'), $request->nama);
        endif;
        $polsek->update($request->all());
        alert()->success('Berhasil Ubah Data Polsek');
        return Redirect::route('polsek.index');

    }

    public function destroy($id)
    {
        $data = Polsek::where('id', $id)->first();
        awsDeleteImg($data->photo);
        $data->delete();
        alert()->success('Berhasil Hapus Data Polsek');
        return redirect()->back();
    }
}
