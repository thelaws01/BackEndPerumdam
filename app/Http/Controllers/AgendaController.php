<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;
use Alert;
use Redirect;


class AgendaController extends Controller
{

    public function __construct(Agenda $agenda) 
    {
        $this->agenda = $agenda;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Agenda::latest()->get();
        return view('epanel.agenda.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('epanel.agenda.create');
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
        $this->agenda->create($data);
        alert()->success('Berhasil Tambah Agenda');
        return Redirect::route('agenda.index');

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
        $data = Agenda::where('id', $id)->get();
        return view('epanel.agenda.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        $agenda->update($request->all());
        alert()->success('Berhasil Ubah Data Agenda');
        return Redirect::route('agenda.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Agenda::where('id', $id)->first();
        $data->delete();
        alert()->success('Berhasil Hapus Data Agenda');
        return redirect()->back();
    }
}
