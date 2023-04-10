<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Storage;
use App\Berita;
use App\Agenda;
use App\Member;
use App\Polsek;
use App\Pengaduan;
use App\Kategori;
use Avatar;
use Illuminate\Support\Facades\Auth;
use Validator;

class v2Controller extends Controller
{
     
    public function __construct() {
        $this->middleware('jwt.verify');
    }
    
    public function tampilAgenda()
    {
        $data = Agenda::latest()->get();
        $res = array();
        foreach($data as $temp) {
            array_push($res, array(
                    "id" =>  $temp->id,
                    "judul" => $temp->judul,
                    "perihal" => $temp->perihal,
                    "lokasi" => $temp->lokasi,
                    "tanggal" => date('d', strtotime($temp->tgl)),
                    "bulan" => date('m', strtotime($temp->tgl)),
                    "tahun" => date('Y', strtotime($temp->tgl))
                )
            );
        }
        return $res;
    }
    
}