<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Alert;
use Redirect;
use App\Berita;
use Str;
use Storage;

class BeritaController extends Controller
{

    public function __construct(Berita $berita) 
    {
        $this->berita = $berita;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Berita::latest()->get();
        return view('epanel.berita.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('epanel.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $detail = $request->detail;
        $dom = new \DomDocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD |  LIBXML_NOERROR |  LIBXML_NOWARNING );    
        $images = $dom->getElementsByTagName('img');
        foreach($images as $k => $img){
        $data = $img->getAttribute('src');
        if(preg_match('/data:image/', $data)) 
        {
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $image_name= "/upload/sbs/" . $detail->smenu_url.'_'.$k.'.png';
        $path = public_path() . $image_name;
        file_put_contents($path, $data);
        $img->removeAttribute('src');
        $img->setAttribute('src', $image_name);
        }
        }
        $detail = $dom->saveHTML();
        $data = $request->all();
        if($request->hasFile('foto')):
            $data['foto'] = $this->upload2($request->file('foto'), Str::random(10));
        endif;
        $data['kontent'] = $detail;
        $this->berita->create($data);
        alert()->success('Berhasil Buat Berita');
        return Redirect::route('berita.index');
        
    }

    public function upload2($file, $filename)
    {
        // $ekstensi = $file->getClientOriginalExtension();
        // $image = Image::make($file)->resize(1024, null, function($constraint) {
        //     $constraint->aspectRatio();
        // })->stream();
        // Storage::disk('s3')->put('Polsek/News/'.$filename.'.'.$ekstensi, $image, 'public');

        // return Storage::disk('s3')->url('Polsek/News/'.$filename.'.'.$ekstensi);
        
        $tmpFilePath = 'app/public/Laporan/';
        $tmpFileDate =  date('Y-m') .'/'.date('d').'/';
        $tmpFileName = $filename;

        makeStorageImgDirectory($tmpFilePath . $tmpFileDate);

		$nama_file = $tmpFilePath . $tmpFileDate . $tmpFileName;

		Image::make($file)->resize(1280, 1024)->save(storage_path() . "/$nama_file".".png");
		return env('APP_URL')."storage/Laporan/{$tmpFileDate}{$tmpFileName}".'.png';
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
        $data = Berita::where('id', $id)->get();
        return view('epanel.berita.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Berita $berita)
    {
       $detail = $request->detail;
        $dom = new \DomDocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD |  LIBXML_NOERROR |  LIBXML_NOWARNING );    
        $images = $dom->getElementsByTagName('img');
        foreach($images as $k => $img){
        $data = $img->getAttribute('src');
        if(preg_match('/data:image/', $data)) 
        {
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $image_name= "/upload/sbs/" . $detail->smenu_url.'_'.$k.'.png';
        $path = public_path() . $image_name;
        file_put_contents($path, $data);
        $img->removeAttribute('src');
        $img->setAttribute('src', $image_name);
        }
        }
        $detail = $dom->saveHTML();
        $berita = Berita::where('id',$request->id)->first();
        $berita->judul = $request->judul;
        $berita->preview = $request->preview;
        $berita->kontent = $detail;
        if($request->hasFile('foto')):
            $name = str_replace('https://masa-depan.website/storage/Laporan/', '', $berita->foto);
            Storage::disk('public')->delete('Laporan/'.$name);
            $berita->delete();
            // awsDeleteImg($berita->foto);
            $berita->foto = $this->upload2($request->file('foto'), Str::random(10));
        endif;
        $berita->save();
        alert()->success('Berhasil Ubah Berita');
        return Redirect::route('berita.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->berita->where('id',$id)->first();
        $name = str_replace('https://masa-depan.website/storage/Laporan/', '', $data->foto);
        Storage::disk('public')->delete('Laporan/'.$name);
        $data->delete();
        alert()->success('Berhasil Hapus Data Polsek');
        return redirect()->back();
        
    }
}
