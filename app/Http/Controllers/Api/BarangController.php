<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Barang;
use App\Http\Resources\BarangResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        $barang = Barang::latest()->paginate(5);

        //return collection of posts as a resource
        return new BarangResource(true, 'List Data Barang', $barang);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'namaBrg'     => 'required',
            'jumlahBrg'     => 'required',
            'statusBrg'   => 'required',
            'tglMasuk'   => '',
            'tglKeluar'   => '',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $barang = Barang::create([
            'namaBrg'     => $request->namaBrg,
            'jumlahBrg'   => $request->jumlahBrg,
            'statusBrg'     => $request->statusBrg,
            'tglMasuk'   => $request->tglMasuk,
            'tglKeluar'     => $request->tglKeluar,
        ]);

        //return response
        return new BarangResource(true, 'Data Berhasil Ditambahkan!', $barang);
    }

    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    public function show($id)
    {
        //find post by ID
        $barang = Barang::find($id);

        //return single post as a resource
        return new BarangResource(true, 'Detail Data Barang!', $barang);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'namaBrg'     => 'required',
            'jumlahBrg'     => 'required',
            'statusBrg'   => 'required',
            'tglMasuk'   => 'required',
            'tglKeluar'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $barang = Barang::find($id);

        //check if image is not empty
        if ($request->all()) {
            $barang->update([
                'namaBrg'     => $request->namaBrg,
                'jumlahBrg'   => $request->jumlahBrg,
                'statusBrg'     => $request->statusBrg,
                'tglMasuk'   => $request->tglMasuk,
                'tglKeluar'     => $request->tglKeluar,
            ]);

        } else {
            $barang->update([
                'namaBrg'     => $request->namaBrg,
                'jumlahBrg'   => $request->jumlahBrg,
                'statusBrg'     => $request->statusBrg,
                'tglMasuk'   => $request->tglMasuk,
                'tglKeluar'     => $request->tglKeluar,
            ]);
        }

        //return response
        return new BarangResource(true, 'Data Barang Berhasil Diubah!', $barang);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id)
    {

        //find post by ID
        $barang = Barang::find($id);

        //delete post
        $barang->delete();

        //return response
        return new BarangResource(true, 'Data Barang Berhasil Dihapus!', null);
    }
}
