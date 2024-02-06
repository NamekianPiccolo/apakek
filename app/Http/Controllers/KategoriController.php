<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.canteen.kategori',[
            'aksi' => 'kategori',
            'title' => 'Kantin',
            'name' => auth()->user()->name,
            'kategoris' => Kategori::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.canteen.createKategori',[
            'title' => 'Tambah kategori',
            'aksi' => 'kategori',
            'name' => auth()->user()->name,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori'=>'required|max:255'
        ]);
        Kategori::create($validatedData);
        return redirect('/create/kategori')->with('success','New Category has been adden!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('user.canteen.editKategori' , [
            'title' => 'Edit Kategori',
            'name' => auth()->user()->name,
            'aksi' => 'kategori',
            'kategori' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validatedData = $request->validate([
            'nama_kategori'=>'required|max:255'
        ]);
        Kategori::where('id',$kategori->id)
                   ->update($validatedData);
        return redirect('/create/kategori')->with('success','New Category has been edit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        DB::table('produks')->where('id_kategori',$kategori->id)->delete();
        Kategori::destroy($kategori->id);
        // DB::table('produks')->where('id_kategori',$kategori->id)->delete();
        
        return redirect('/create/kategori')->with('success',' Category has been deleted!');
    }
    
    
}
