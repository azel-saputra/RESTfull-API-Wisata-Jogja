<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Wisata::all();
        return response()->json($data); 
    }

    public function listWisata()
    {
        $data=Wisata::all('id_wisata','nama_tempat','alamat','rate','kategori','gambar');
        return response()->json($data);
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
        $validasi=$request->validate([
            'nama_tempat'=>'required',
            'kategori'=>'required',
            'biaya'=>'required',
            'alamat'=>'required',
            'waktu'=>'required',
            'sejarah'=>'required',
            'rate'=>'required',
            'gambar'=>'required|file|mimes:png,jpg'
        ]);
        try {
            $fileName = time().$request->file('gambar')->getClientOriginalName();
            $path = $request->file('gambar')->storeAs('uploads/wisata',$fileName);
            $validasi['gambar']=$path;
            $response = Wisata::create($validasi);
            return response()->json([
                'success' => true,
                'message' =>'success',
                'data' => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'=>'Error',
                'errors'=>$e->getMessage()
                ]);
        }
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
        $validasi=$request->validate([
            'nama_tempat'=>'required',
            'kategori'=>'required',
            'biaya'=>'required',
            'alamat'=>'required',
            'waktu'=>'required',
            'sejarah'=>'required',
            'rate'=>'required',
            'gambar'=>''
        ]);
        try {
            if($request->file('gambar')){
                $fileName = time().$request->file('gambar')->getClientOriginalName();
                $path = $request->file('gambar')->storeAs('uploads/wisata',$fileName);
                $validasi['gambar']=$path;
            }
            $response = Wisata::find($id);
            $response->update($validasi);
            return response()->json([
                'success' => true,
                'message' =>'success',
                'data' => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'=>'Error',
                'errors'=>$e->getMessage()
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $wisata=Wisata::find($id);
        $wisata->delete();
        return response()->json([
            'success'=>true,
            'message'=>'Success'
        ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'=>'Error',
                'errors'=>$e->getMessage()
            ]);
        }
        
    }
}
