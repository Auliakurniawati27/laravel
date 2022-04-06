<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
// panggil model pegawai
use App\Pegawai;
 
 
class PegawaiController extends Controller
{
    public function index()
    {
    	// mengambil data pegawai
    	$pegawai = Pegawai::all();
 
    	// mengirim data pegawai ke view pegawai
    	return view('pegawai', ['pegawai' => $pegawai]);
    }
		// method untuk menampilkan view form tambah pegawai
	public function tambah()
	{
	
		// memanggil view tambah
		return view('tambah');
	
	}

		// method untuk insert data ke table pegawai
	public function store(Request $request)
	
	{
    	$this->validate($request,[
    		'nama' => 'required',
    		'alamat' => 'required'
    	]);
 
        Pegawai::create([
    		'nama' => $request->nama,
    		'alamat' => $request->alamat
    	]);
 
    	return redirect('/pegawai');
    }
	

		// method untuk edit data pegawai
	public function edit($id)
	{
		// mengambil data pegawai berdasarkan id yang dipilih
		$pegawai = DB::table('pegawai')->where('pegawai_id',$id)->get();
		// passing data pegawai yang didapat ke view edit.blade.php
		return view('edit',['pegawai' => $pegawai]);
	
	}
		// update data pegawai
	public function update(Request $request)
	{
		// update data pegawai
		DB::table('pegawai')->where('pegawai_id',$request->id)->update([
			'pegawai_nama' => $request->nama,
			'pegawai_jabatan' => $request->jabatan,
			'pegawai_umur' => $request->umur,
			'pegawai_alamat' => $request->alamat
		]);
		// alihkan halaman ke halaman pegawai
		return redirect('/pegawai');
	}	
	
	public function delete($id)
	{
		$pegawai = Pegawai::find($id);
		$pegawai->delete();
		return redirect('/pegawai');
	}

}
