<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\M_siswa;
use Illuminate\Support\Facades\DB;

class siswaController extends Controller
{
    public function index()
    {
        $data = [
            'peran' => User::getAll(),
            'title' => 'Biodata Siswa'
        ];
        return view('Siswa.v_pendaftaran', $data);
    }

    public function sudahDaftar($id)
    {
        $data = [
            'peran' => User::getAll(),
            'title' => 'Biodata Siswa',
            'bio' => M_siswa::getDetail($id),
        ];
        return view('Siswa.v_sudahDaftar', $data);
        // dd($data['bio']);
    }

    public function addBiodata(Request $request)
    {
        // dd(request()->all());
        $this->validate($request, [
            'id_akun' => 'required',
            'name'  => 'required',
            'is_active'  => 'required',
            'alamat'  => 'required',
            'tempat_lahir'  => 'required',
            'ttl'  => 'required',
            'tlp'  => 'required',
            'nilai_mtk'  => 'required',
            'nilai_bin'  => 'required',
            'is_kirim'  => 'required',
            'nilai_big'  => 'required',
            'foto' => 'required|file|image|mimes:jpeg,png,jpg',
            'bukti_rapor' => 'required|file|mimes:jpeg,png,jpg,pdf',
        ]);
        //Membuat upload Foto dan rapor
        $file_foto = $request->file('foto');
        $file_rapor = $request->file('bukti_rapor');
        //Membuat penamaan dari waktu dan nama original file
        $nama_file_foto = time() . "_" . $file_foto->getClientOriginalName();
        $nama_file_rapor = time() . "_" . $file_rapor->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload_foto = 'dok_foto_siswa';
        $tujuan_upload_rapor = 'dok_foto_rapor';
        $file_foto->move($tujuan_upload_foto, $nama_file_foto);
        $file_rapor->move($tujuan_upload_rapor, $nama_file_rapor);
        DB::transaction(
            function () use ($request, $nama_file_foto, $nama_file_rapor): void {
                //Update nama pengguna siswa
                User::where('id', request()->input('id_akun'))->update(request()->only([
                    'name',
                    'is_kirim'
                ]));

                $data = new M_siswa();
                $data->id_akun = $request->get('id_akun');
                $data->is_active = $request->get('is_active');
                $data->alamat = $request->get('alamat');
                $data->tempat_lahir = $request->get('tempat_lahir');
                $data->ttl = $request->get('ttl');
                $data->tlp = $request->get('tlp');
                $data->nilai_mtk = $request->get('nilai_mtk');
                $data->nilai_bin = $request->get('nilai_bin');
                $data->nilai_big = $request->get('nilai_big');
                $data->foto = $nama_file_foto;
                $data->bukti_rapor = $nama_file_rapor;
                // dd($file);

                $data->save();
            }
        );

        return redirect('siswa/home')->with('pesan', 'Akun Sudah Terdaftar.');
    }
    public function daftarkan(Request $request)
    {
        // dd(request()->all());
        $siswa = M_siswa::find($request->input('id_akun'));
        $siswa->daftar = $request->daftar;
        $siswa->save();
        return response()->json(true);
    }
}
