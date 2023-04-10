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
class v1Controller extends Controller
{
    public function __construct(Berita $berita, Agenda $agenda, Member $member, Polsek $polsek, Pengaduan $aduan, Kategori $kategori) 
    {
        $this->berita = $berita;
        $this->agenda = $agenda;
        $this->member = $member;
        $this->polsek = $polsek;
        $this->aduan = $aduan;
        $this->kategori = $kategori;
    }

    public function tampilMember()
    {
        $data = $this->member->latest()->get();
        $res = array();
        foreach($data as $temp):
            array_push($res, array(
                "id" => $temp->id,
                "nama" => $temp->nama,
                "nik" => $temp->nik,
                "phone" => $temp->phone,
                "ttl" => $temp->ttl,
                "foto" => $temp->foto,
                "alamat" => $temp->alamat,
                "username" => $temp->username,
                "password" => $temp->password,
                "plain" => $temp->plain
            )
        );
        endforeach;
        return $res;
    }

    public function tampilKategori()
    {
        $data = Kategori::all();
        $res = array();
        foreach ($data as $temp) {
            array_push($res, array(
                    "id" => $temp->id,
                    "label" => $temp->label
                )
            );
        }
        return $res;
    }


    public function tampilBerita()
    {
    	$data = $this->berita::latest()->get();
    	$res = array();
    	foreach($data as $temp) {
            $str=str_replace("\r\n","",$temp->kontent);
            $tindih = str_replace("&nbsp;", '', $str);
            array_push($res, array(
                    "id" =>  $temp->id,
                    "judul" => $temp->judul,
                    "kontent" => strip_tags($tindih),
                    "foto" => $temp->foto,
                    "tanggal" => $temp->created_at->diffForHumans()
                )
            );
        }
        return $res;
    }

    public function detailBerita($id)
    {
        $data = $this->berita::where('id', $id)->get();
        $res = array();
        foreach($data as $temp) {
            $str=str_replace("\r\n","",$temp->kontent);
            $tindih = str_replace("&nbsp;", '', $str);
            array_push($res, array(
                    "id" =>  $temp->id,
                    "judul" => $temp->judul,
                    "kontent" => strip_tags($tindih),
                    "foto" => awsImg($temp->foto),
                    "tanggal" => $temp->created_at->diffForHumans()
                )
            );
        }
        return $res[0];

    }

    public function tampilPengaduan()
    {
        
        $data = Pengaduan::where('status', 3)->orWhere('status', 4)->orderBy('created_at', 'DESC')->get();    
        $res = array();
        foreach ($data as $temp) {
            $oke = Avatar::create(optional($temp->member)->nama)->toBase64();
            array_push($res,array(
                "id" => $temp->id,
                "member_foto" => $oke->encoded,
                "member_nama" => optional($temp->member)->username,
                "lokasi" => $temp->info,
                "foto" => $temp->foto,
                "bentuk" => $temp->alamat,
                "waktu" => $temp->created_at->diffForHumans(),
                "status" => $temp->status,
                "view" => $temp->view,
                "kategori" => optional($temp->kategori)->label
                )
            );
        }
        return $res;
    }
    
    public function upadatView($id)
    {
        $data = $this->aduan->find($id);
        if(empty($data->view)){
            $data->view = 1;
            $data->save();
        } else {
            $data->view = $data->view +1;
            $data->save();
        }
        return 'sukses';
    }

    public function aduanSendiri(Request $request, $username)
    {   
        $member = $this->member->where('username', $username)->first();
        $data = Pengaduan::where('member_id', $member->id)->get();
        $res = array();
        foreach ($data as $temp) {
            array_push($res,array(
                "id" => $temp->id,
                "member_foto" => optional($temp->member)->foto,
                "member_nama" => optional($temp->member)->nama,
                "lokasi" => $temp->alamat,
                "foto" => $temp->foto,
                "bentuk" => $temp->bentuk,
                "waktu" => $temp->created_at->diffForHumans(),
                "status" => $temp->status
                )
            );
        }
        return $res;
    }


    public function detailAduanSendiri(Request $request, $id)
    {   
        $data = Pengaduan::where('id',$id)->get();
        $res = array();
        foreach ($data as $temp) {
            array_push($res,array(
                "id" => $temp->id,
                "nama" => $temp->nama,
                "lokasi" => $temp->alamat,
                "bentuk" => $temp->bentuk,
                "waktu" => $temp->created_at->diffForHumans(),
                "saksi" => $temp->saksi,
                "info" => $temp->info,
                "status" => $temp->status,
                "rugi" => $temp->kerugian
                )
            );
        }
        return $res[0];
    }



    public function tampilSlider()
    {
        $data = $this->berita::latest()->get();
        $res = array();
        foreach($data as $temp) {
            array_push($res, array(
                    "id" =>  $temp->id,
                    "title" => $temp->judul,
                    "subtitle" => '',
                    "photo" => awsImg($temp->foto),
                )
            );
        }
        return $res;
    }

    public function tampilAgenda()
    {
        $data = $this->agenda::latest()->get();
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

    public function login($username, $plain, $fcm_id)
    {
        $cek = $this->member->username($username)->plain($plain)->first();
        if($cek) {
            $cek->fcm_id = $fcm_id;
            $cek->save();
                        return $cek->id.','.$cek->akses_id.','.$cek->nama.','.$cek->username.','.$cek->nik.','.$cek->password.','.awsImg($cek->foto);
        } else {
            return 'gagal';
        }
    }

    public function masuk($username, $plain)
    {
        $cek = $this->member->username($username)->plain($plain)->first();
        if($cek) {
            return $cek;
        } else {
            return json_encode('gagal');
        }
    }
    
    public function loginRiswan(Request $request)
    {
        $cek = $this->member->username($request->username)->plain($request->plain)->first();
        if($cek){
            $cek->fcm_id = $request->token;
            $cek->save();
            return response()->json(
                [
                    'status' => 'Berhasil',
                    'data' => $cek
                ], 200
                );
        } else {
            return response()->json(['status' => 'Gagal']);
        }
    }

    public function register(Request $request)
    {
        $cek = $this->member->whereUsername(strtolower($request->username))->first();
        if(!$cek):
            $register = new $this->member;
            $register->akses_id = 2;
            $register->nama = $request->nama;
            $register->username = strtolower($request->username);
            $register->nik = $request->nik;
            $register->alamat = $request->alamat; 
            $register->foto = $this->upload2($request->foto, str_random(10));
            $register->phone = $request->phone;
            $register->password = bcrypt($request->password);
            $register->plain = $request->password;
            try {
                $register->save();
                return 'success';
            } catch (QueryException $e) {
                return $e;
            } catch (PDOException $e) {
                return $e;
            }

            return 'success';
        endif;

        return 'registered';
    }
    
    public function registerRiswan(Request $request)
    {
        $cek = $this->member->whereUsername(strtolower($request->username))->first();
        if(!$cek){
            $regis = new $this->member;
            $regis->akses_id = 2;
            $regis->username = strtolower($request->username);
            $regis->password = bcrypt($request->password);
            $regis->plain = $request->password;
            $regis->fcm_id = $request->token;
            try {
                $regis->save();
                return response()->json(['status'=> 'success']);
            } catch (QueryException $e) {
                return $e;
            } catch (PDOException $e) {
                return $e;
            }

            return response()->json(['status'=> 'success']);
        }
        
        return response()->json(['status'=> 'Registered']);
        
    }
    
    public function updateProfRiswan(Request $request)
    {
        $cek = $this->member->where('username', $request->username)->first();
        if($cek->foto != null){
            $name = str_replace('https://masa-depan.website/storage/Member/', '', $cek->foto);
            Storage::disk('public')->delete('Member/'.$name);
            $cek->delete();
            $cek->foto = $this->upload2($request->image, str_random(10));    
        } else {
            $cek->foto = $this->upload2($request->image, str_random(10));    
        }
        
        $cek->save();
        return response()->json(
            [
                'message' => 'Berhasil',
                'data' => $cek
            ], 200
        );
    }
    
    public function addPengaduanRiswan(Request $request)
    {
        $member = $this->member->where('username', $request->username)->first();
        $cek = $this->kategori->where('id', $request->kategori_id)->first();
        $data = new Pengaduan();
        $data->member_id = $member->id;
        $data->user_id = 2;
        if($cek->nilai == 60){
            $data->status = 3;
        } else {
            $data->status = 1;
        }
        $data->kategori_id = $request->kategori_id;
        $data->hari = date('y-m-d');
        $data->alamat = $request->alamat;
        $data->info = $request->info;
        // return $data;
        $data->foto = $this->upload($request->image, str_random(10));
        $data->save();    
        return response()->json(
            [
                'message' => 'Berhasil'
            ], 200
        );
        
    }
    
    public function updatePasswordRiswan(Request $request)
    {
        $cek = $this->member->where('username', $request->username)->first();
        if(!$cek){
            return response()->json([
                'status' => 'Not Found'
                ], 200);
        } else {
            $cek->password = bcrypt($request->password);
            $cek->plain = $request->password;
            $cek->save();
        }
        return response()->json([
            'status' => 'Sukses'
            ], 200);
    }
    
    public function updateStringProf(Request $request)
    {
        $cek = $this->member->where('username', $request->username)->first();
        $cek_nik = $this->member->where('nik', $request->nik)->first();
        if($cek_nik){
            return response()->json(
                [
                    'message' => 'Registered',
                    'data' => $cek
                ], 201
            ); 
        }
        $cek->nama = $request->nama;
        $cek->nik = $request->nik;
        $cek->alamat = $request->alamat;
        $cek->phone = $request->phone;
        $cek->ttl = $request->kecamatan;
        $cek->save();
        return response()->json(
            [
                'message' => 'Berhasil',
                'data' => $cek
            ], 200
        );
    }
    
    public function updateProfString(Request $request)
    {
        $cek = $this->member->where('username', $request->username)->first();
        $cek->nama = $request->nama;
        $cek->alamat = $request->alamat;
        $cek->phone = $request->phone;
        $cek->ttl = $request->kecamatan;
        $cek->save();
        return response()->json(
            [
                'message' => 'Berhasil',
                'data' => $cek
            ], 200
        );
    }


    public function upload2($file, $filename)
    {
        // $ekstensi = 'png';
        // $image = Image::make($file)->resize(1024, null, function($constraint) {
        //     $constraint->aspectRatio();
        // })->stream();
        // Storage::disk('s3')->put('Polsek/Member/'.$filename.'.'.$ekstensi, $image, 'public');
        // return Storage::disk('s3')->url('Polsek/Member/'.$filename.'.'.$ekstensi);
        $tmpFilePath = 'app/public/Member/';
        $tmpFileDate =  date('Y-m') .'/'.date('d').'/';
        $tmpFileName = $filename;

        makeStorageImgDirectory($tmpFilePath . $tmpFileDate);

		$nama_file = $tmpFilePath . $tmpFileDate . $tmpFileName;

		Image::make($file)->resize(1280, 1024)->save(storage_path() . "/$nama_file".".png");
		return env('APP_URL')."storage/Member/{$tmpFileDate}{$tmpFileName}".'.png';
    }

    public function haversine($lat, $lng, $radius=100000)
    {
        $kampus = $this->polsek->limit(3)->get();
        $kampus = Polsek::select('polsek.*')
            ->selectRaw('( 6371 * acos( cos( radians(?) ) *
                           cos( radians( latitude ) )
                           * cos( radians( longitude ) - radians(?)
                           ) + sin( radians(?) ) *
                           sin( radians( latitude ) ) )
                         ) AS distance', [$lat, $lng, $lat])
        ->orderBy('distance', 'asc')->get();
        return $kampus;
    }

    public function addAduan(Request $request, $username){
        $member = $this->member->where('username', $username)->first();
        $cek = $this->kategori->where('id', $request->kategori_id)->first();
        $data = new Pengaduan();
        $data->member_id = $member->id;
        $data->user_id = 2;
        if($cek->nilai == 60){
            $data->status = 3;
        } else {
            $data->status = 1;
        }
        $data->kategori_id = $request->kategori_id;
        $data->hari = date('y-m-d');
        $data->alamat = $request->alamat;
        $data->bentuk = $request->bentuk;
        $data->kerugian = $request->kerugian;
        $data->saksi = $request->saksi;
        $data->info = $request->info; 
        $data->foto = $this->upload($request->foto, str_random(10));
        $data->save();    
        return 'sukses';
    }
    
    public function riswanHistory($username)
    {
        $member = $this->member->where('username', $username)->first();
        $data = $this->aduan->where('member_id', $member->id)->orderBy('created_at', 'DESC')->get();
        $res = array();
        foreach ($data as $temp) {
            array_push($res,array(
                "id" => $temp->id,
                "member_foto" => optional($temp->member)->foto,
                "member_nama" => optional($temp->member)->nama,
                "lokasi" => $temp->alamat,
                "foto" => $temp->foto,
                "info" => $temp->info,
                "bentuk" => optional($temp->kategori)->label,
                "waktu" => $temp->created_at->diffForHumans(),
                "status" => $temp->status
                )
            );
        }
        return $res;
    }

     public function upload($file, $filename)
    {   
        // $ekstensi = 'png';
        // $image = Image::make($file)->resize(1024, null, function($constraint) {
        //     $constraint->aspectRatio();
        // })->stream();
        // Storage::disk('s3')->put('Polsek/Pengaduan/'.$filename.'.'.$ekstensi, $image, 'public');
        // return Storage::disk('s3')->url('Polsek/Pengaduan/'.$filename.'.'.$ekstensi);
        $tmpFilePath = 'app/public/Pengaduan/';
        $tmpFileDate =  date('Y-m') .'/'.date('d').'/';
        $tmpFileName = $filename;

        makeStorageImgDirectory($tmpFilePath . $tmpFileDate);

		$nama_file = $tmpFilePath . $tmpFileDate . $tmpFileName;

		Image::make($file)->resize(1280, 1024)->save(storage_path() . "/$nama_file".".png");
		return env('APP_URL')."storage/Pengaduan/{$tmpFileDate}{$tmpFileName}".'.png';
    }

    public function updateProfil(Request $request, $username)
    {
        $data = $this->member->whereUsername($username)->first();
    }

    public function deleteAkun(Request $request, $username){
        $data = $this->member->username($username)->first();
        awsDeleteImg($data->foto);
        $data->delete();
        return 'sukses';
    }
    
    public function updateFoto(Request $request, $id)
    {
        $data = $this->member->where('id',$id)->first();
        awsDeleteImg($data->foto);
        $data->foto = $this->upload2($request->foto, str_random(10));
        $data->save();
        return 'success';
    }
    
    public function ambilFoto($username)
    {
         $data = $this->member->where('username',$username)->get();
         $res = array();
         foreach($data as $temp):
             array_push($res, array(
                        "foto" => $temp->foto
                    )
                 );
             endforeach;
             return $res[0];
    }
    

}
