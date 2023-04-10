<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Pengaduan;
use Storage;

class MemberController extends Controller
{

    public function __construct(Member $member, Pengaduan $aduan) 
    {
        $this->member = $member;
        $this->aduan = $aduan;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->member->latest()->get();
        return view('epanel.mobile.member.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->member->where('id', $id)->get();
        return view('epanel.mobile.member.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->member->where('id',$id)->first();
        $aduan = $this->aduan->where('member_id', $id)->get();
        if(count($aduan) < 1){
             $name = str_replace('https://masa-depan.website/storage/Member/', '', $data->foto);
            Storage::disk('public')->delete('Member/'.$name);
            // awsDeleteImg($data->foto);
            $data->delete();    
        } else {
            // $aduan = $this->aduan->where('user_id', $id)->get();
            // // awsDeleteImg($data->foto);
            // $name = str_replace('https://masa-depan.website/storage/Member/', '', $data->foto);
            // Storage::disk('public')->delete('Member/'.$name);
            // $data->delete();
            alert()->error('Maaf Member Tidak Dapat di Hapus Karna Telah Melakukan Aduan');
            return redirect()->back();
        }
        alert()->success('Berhasil Hapus Data Member');
        return redirect()->back();
    }
}
