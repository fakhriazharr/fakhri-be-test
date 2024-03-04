<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pengajuan;
use App\Http\Resources\PengajuanResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        $pengajuan = Pengajuan::latest()->paginate(5);

        //return collection of posts as a resource
        return new PengajuanResource(true, 'List Data Pengajuan', $pengajuan);
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
            'namaPengajuanBrg'     => 'required',
            'jumlahPengajuanBrg'     => 'required',
            'tglPengajuanBrg'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $pengajuan = Pengajuan::create([
            'namaPengajuanBrg'     => $request->namaPengajuanBrg,
            'jumlahPengajuanBrg'   => $request->jumlahPengajuanBrg,
            'tglPengajuanBrg'     => $request->tglPengajuanBrg,
        ]);

        //return response
        return new PengajuanResource(true, 'Data Berhasil Diajukan!', $pengajuan);
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
        $pengajuan = Pengajuan::find($id);

        //return single post as a resource
        return new PengajuanResource(true, 'Detail Data Pengajuan!', $pengajuan);
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
            'namaPengajuanBrg'     => 'required',
            'jumlahPengajuanBrg'     => 'required',
            'tglPengajuanBrg'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $pengajuan = Pengajuan::find($id);

        //check if image is not empty
        if ($request->all()) {
            $pengajuan->update([
                'namaPengajuanBrg'     => $request->namaPengajuanBrg,
                'jumlahPengajuanBrg'   => $request->jumlahPengajuanBrg,
                'tglPengajuanBrg'     => $request->tglPengajuanBrg,
            ]);

        } else {
            $pengajuan->update([
                'namaPengajuanBrg'     => $request->namaPengajuanBrg,
                'jumlahPengajuanBrg'   => $request->jumlahPengajuanBrg,
                'tglPengajuanBrg'     => $request->tglPengajuanBrg,
            ]);
        }

        //return response
        return new PengajuanResource(true, 'Data Pengajuan Berhasil Diubah!', $pengajuan);
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
        $pengajuan = Pengajuan::find($id);

        //delete post
        $pengajuan->delete();

        //return response
        return new PengajuanResource(true, 'Data Pengajuan Berhasil Dihapus!', null);
    }
}
