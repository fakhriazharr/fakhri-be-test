<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pengembalian;
use App\Http\Resources\PengembalianResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PengembalianController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        $pengembalian = Pengembalian::latest()->paginate(5);

        //return collection of posts as a resource
        return new PengembalianResource(true, 'List Data Pengembalian', $pengembalian);
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
            'namaPengembalianBrg'     => 'required',
            'jumlahPengembalianBrg'     => 'required',
            'tglPengembalianBrg'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $pengembalian = Pengembalian::create([
            'namaPengembalianBrg'     => $request->namaPengembalianBrg,
            'jumlahPengembalianBrg'   => $request->jumlahPengembalianBrg,
            'tglPengembalianBrg'     => $request->tglPengembalianBrg,
        ]);

        //return response
        return new PengembalianResource(true, 'Data Berhasil Dikembalikan!', $pengembalian);
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
        $pengembalian = Pengembalian::find($id);

        //return single post as a resource
        return new PengembalianResource(true, 'Detail Data Pengembalian!', $pengembalian);
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
            'namaPengembalianBrg'     => 'required',
            'jumlahPengembalianBrg'     => 'required',
            'tglPengembalianBrg'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $pengembalian = Pengembalian::find($id);

        //check if image is not empty
        if ($request->all()) {
            $pengembalian->update([
                'namaPengembalianBrg'     => $request->namaPengembalianBrg,
                'jumlahPengembalianBrg'   => $request->jumlahPengembalianBrg,
                'tglPengembalianBrg'     => $request->tglPengembalianBrg,
            ]);

        } else {
            $pengembalian->update([
                'namaPengembalianBrg'     => $request->namaPengembalianBrg,
                'jumlahPengembalianBrg'   => $request->jumlahPengembalianBrg,
                'tglPengembalianBrg'     => $request->tglPengembalianBrg,
            ]);
        }

        //return response
        return new PengembalianResource(true, 'Data Pengembalian Berhasil Diubah!', $pengembalian);
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
        $pengembalian = Pengembalian::find($id);

        //delete post
        $pengembalian->delete();

        //return response
        return new PengembalianResource(true, 'Data Pengembalian Berhasil Dihapus!', null);
    }
}
