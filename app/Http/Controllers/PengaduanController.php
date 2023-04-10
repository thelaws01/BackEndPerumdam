<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengaduan;
use App\Kategori;
use Alert;
use Avatar;
use Redirect;
use Storage;

class PengaduanController extends Controller
{

    public function __construct(Pengaduan $pengaduan, Kategori $kategori)
    {
        $this->pengaduan = $pengaduan;
        $this->kategori = $kategori;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function quick_sort($my_array)
    {
        $left = $right = array();       //variabel kiri dan kanan merupakan nilai array yang dimana belum memiliki nilai
        if(count($my_array) < 2)        //jika nilai aray kurang dari 2, maka tidak ada yang di sortir dan akan dikembalikan ke nilai araynya return $my_array;
        {
            return $my_array;
        }
        $pivot_key = key($my_array);    //variabel pivot_key digunakan untuk menampung nilai array yang didapat dari key array
        $pivot = array_shift($my_array); //indeks awal nilai pivot yang akan menampung nilai array pertama
        foreach($my_array as $val)      //perulangan jumlah array yang akan diurutkan
        {
            if($val > $pivot)           //kondisi membandingkan jika nilai lebih besar dari pivot
            {
                $left[] = $val;         //maka akan diletakkan disebelah kiri
            }elseif ($val < $pivot)     //atau jika nilai lebih kecil dari pivot
            {
                $right[] = $val;        //maka akan diletakkan disebelah kanan
            }
        }
        return array_merge($this->quick_sort($left),array($pivot_key=>$pivot),$this->quick_sort($right)); //menggabungkan 2 array kiri dan kanan yang telah terurut untuk mendapatkan nilai yang diinginkan
    }
    
    public function bubbleSort($arr) {
    $n = count($arr);
    // for ($i = 0; $i < $n-1; $i++) {
    //     for ($j = 0; $j < $n-$i-1; $j++) {
    //         if ($arr[$j] > $arr[$j+1]) {
    //             // swap arr[j] and arr[j+1]
    //             $temp = $arr[$j];
    //             $arr[$j] = $arr[$j+1];
    //             $arr[$j+1] = $temp;
    //         }
    //     }
    // }
    //     return $arr;
    
    $n = count($arr);
        for ($i = 0; $i < $n-1; $i++) {
            for ($j = 0; $j < $n-$i-1; $j++) {
                if ($arr[$j] < $arr[$j+1]) {
                    // swap arr[j] and arr[j+1]
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j+1];
                    $arr[$j+1] = $temp;
                }
            }
        }
    
    return $arr;
    
    }
    
    public function index()
    {
        // $data = $this->pengaduan->latest()->get();
        

        $dataku = $this->pengaduan->where('status', 1)->orwhere('status', 2)->orderBy('created_at', 'DESC')->get();
        // return $dataku;
        $res = array();
        foreach($dataku as $temp){
            array_push($res, array(
                    "nilai" => $temp->kategori->nilai,                    
                    "id" => $temp->id,
                    "member_nama" => optional($temp->member)->nama,
                    "nama" => $temp->nama,
                    "label" => $temp->kategori->label,
                    "hari" => date('d F Y H:i', strtotime($temp->created_at)),
                    "lokasi" => $temp->alamat,
                    "foto" => $temp->foto,
                    "bentuk" => $temp->bentuk,
                    "waktu" => $temp->created_at->diffForHumans(),
                    "status" => $temp->status
                )
            );
        }
        $data = $this->quick_sort($res);
        return view('epanel.mobile.pengaduan.index', compact('data'));        
    }
    
    public function indexBubble()
    {
         $dataku = $this->pengaduan->where('status', 1)->orwhere('status', 2)->orderBy('created_at', 'DESC')->get();
        // return $dataku;
        $res = array();
        foreach($dataku as $temp){
            array_push($res, array(
                    "nilai" => $temp->kategori->nilai,                    
                    "id" => $temp->id,
                    "member_nama" => optional($temp->member)->nama,
                    "nama" => $temp->nama,
                    "label" => $temp->kategori->label,
                    "hari" => date('d F Y H:i', strtotime($temp->created_at)),
                    "lokasi" => $temp->alamat,
                    "foto" => $temp->foto,
                    "bentuk" => $temp->bentuk,
                    "waktu" => $temp->created_at->diffForHumans(),
                    "status" => $temp->status
                )
            );
        }
        $data = $this->bubbleSort($res);
        return view('epanel.mobile.pengaduan.index', compact('data'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('epanel.mobile.pengaduan.create');
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
        $data['status'] = 1;
        $data['user_id'] = 2;
        $this->pengaduan->create($data);
        alert()->success('Berhasil Tambah Data Pengaduan');
        return Redirect::route('pengaduan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data = $this->pengaduan->where('id', $id)->get();
        if($request->has('purpose')):
                if($request->purpose == 'cetak'):
                    return view('epanel.mobile.pengaduan.cetak', compact('data'));
                endif;
            endif;
        return view('epanel.mobile.pengaduan.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {   
        $base = $this->pengaduan->where('id', $id)->first();
        if($base->status == 3):
            $data = $this->pengaduan->where('id', $id)->get();
            if($request->has('purpose')):
                if($request->purpose == 'cetak'):
                    return view('epanel.mobile.pengaduan.cetak', compact('data'));
                endif;
            endif;
            return view('epanel.mobile.pengaduan.edit1', compact('data'));
            else:
            $data = $this->pengaduan->where('id', $id)->get();
            return view('epanel.mobile.pengaduan.edit', compact('data'));
        endif;
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {   
        $data = Pengaduan::where('id', $request->id)->first();
        if($request->status == 2){
            kirim(str_random(), 
            'Maaf Laporan Anda Di Tolak', 
            'Oleh ' . 'Admin Perumdam', 
            $data->member->fcm_id
        );
        } else if($request->status == 4) {
            kirim(str_random(), 
            'Laporan Anda Telah Selesai Di Tindak Lanjuti', 
            'Oleh ' . 'Admin Perumdam', 
            $data->member->fcm_id
            );
        } else {
            kirim(str_random(), 
            'Laporan Anda Sedang Di Proses', 
            'Oleh ' . 'Admin Perumdam', 
            $data->member->fcm_id
            );
        }
        $pengaduan->update(
        [
            "status" => $request->status
        ]
        );
        alert()->success('Status Pengaduan Berhasil di Ubah');
        return Redirect::route('pengaduan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->pengaduan->where('id',$id)->first();
        $name = str_replace('https://masa-depan.website/storage/Pengaduan/', '', $data->foto);
        Storage::disk('public')->delete('Pengaduan/'.$name);
        $data->delete();
        alert()->success('Berhasil Hapus Data Pengaduan');
        return redirect()->back();
    }
    
    /**
     * Pengaduan Seslesai atau di Proses
     */
    public function selesai()
    {
        $data = $this->pengaduan->where('status', 3)->orWhere('status', 4)->orderBy('updated_at', 'DESC')->get();
        // return $data;
    return view('epanel.mobile.pengaduan.selesai', compact('data'));  
    }
    
}
