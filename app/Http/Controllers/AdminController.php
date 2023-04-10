<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Member;
use Redirect;
use Image;
use Storage;
use Alert;

class AdminController extends Controller
{


    public function __construct(Member $member)
    {
        $this->member = $member;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('akses_id', 1)->get();
        return view('epanel.operator.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('epanel.operator.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if($request->password != $request->repassword):
            alert()->error('Password dan Konfrimasi Tidak Cocok');
        return redirect()->back();
        endif;
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->plain = $request->password;
        $data->akses_id = 1;
        $data->save();
        alert()->success('Berhasil Tambah Operator');
        return Redirect::route('operator.index');

        // $cek = $this->member->whereUsername(strtolower($request->username))->first();
        // if(!$cek):
        //     $register = new $this->member;
        //     $register->akses_id = 2;
        //     $register->nama = 'safii';
        //     $register->username = strtolower($request->username);
        //     $register->nik = 647209090297001;
        //     $register->alamat = 'solong'; 
        //     $register->foto = $this->upload2($request->foto, str_random(10));
        //     $register->phone = '0812';
        //     $register->password = bcrypt($request->password);
        //     $register->plain = $request->password;
        //     try {
        //         $register->save();
        //         return 'success';
        //     } catch (QueryException $e) {
        //         return $e;
        //     } catch (PDOException $e) {
        //         return $e;
        //     }

        //     return 'success';
        // endif;

        // return 'registered';
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
        $data = User::where('id', $id)->get();
        return view('epanel.operator.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {   
        $user = User::where('id', $request->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->plain = $request->password;
        $user->akses_id = 2;
        $user->save();
        alert()->success('Berhasil Ubah Data Operator');
        return Redirect::route('operator.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::where('id', $id)->first();
        $data->delete();
        alert()->success('Berhasil Hapus Operator');
        return redirect()->back();
    }


        public function upload2($file, $filename)
    {
        $ekstensi = 'png';
        $image = Image::make($file)->resize(1024, null, function($constraint) {
            $constraint->aspectRatio();
        })->stream();
        Storage::disk('s3')->put('Polsek/Member/'.$filename.'.'.$ekstensi, $image, 'public');
        return Storage::disk('s3')->url('Polsek/Member/'.$filename.'.'.$ekstensi);
    }

}
