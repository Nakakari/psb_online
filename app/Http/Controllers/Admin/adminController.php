<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\M_siswa;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    public function dataPendaftar()
    {
        $data = [
            'peran' => User::getAll(),
            'title' => 'Daftar Calon Siswa',

        ];
        return view('Admin.v_daftar_calon', $data);
    }

    // Untuk datatable serverside akses data calon siswa
    public function dataCalon()
    {
        $columns = [
            'id_akun',
            'is_active',
            'alamat',
            'tempat_lahir',
            'ttl',
            'tlp',
            'nilai_mtk',
            'nilai_bin',
            'nilai_big',
            'foto',
            'bukti_rapor',
        ];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = M_siswa::select('*')
            ->join('users', 'users.id', '=', 'tbl_siswa.id_akun')
            ->orderBy('id_siswa', "desc");;

        $recordsFiltered = $data->get()->count(); //menghitung data yang sudah difilter

        if (request()->input("search.value")) {
            $data = $data->where(function ($query) {
                $query->whereRaw('LOWER(tbl_mesin.model_mesin) like ?', ['%' . strtolower(request()->input("search.value")) . '%'])
                    ->orWhereRaw('LOWER(tbl_mesin.serial_number) like ?', ['%' . strtolower(request()->input("search.value")) . '%']);
            });
        }

        $data = $data
            ->skip(request()->input('start'))
            ->take(request()->input('length'))
            ->orderBy($orderBy, request()->input("order.0.dir"))
            ->get();
        $recordsTotal = $data->count();

        return response()->json([
            'draw' => request()->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            'all_request' => request()->all()
        ]);
    }

    public function verif(Request $request)
    {
        DB::transaction(
            function () use ($request): void {
                User::where('id', $request->input('id_akun'))->update(request()->only([
                    'is_kirim'
                ]));
                $siswa = M_siswa::find($request->input('id_siswa'));
                $siswa->is_active = $request->is_active;
                $siswa->save();
            }

        );
        return response()->json(true);
    }
    // Memverifikasi atau batal verifikasi
    public function update(Request $request)
    {
        DB::transaction(
            function () use ($request): void {
                User::where('id', $request->input('id_akun'))->update(request()->only([
                    'is_kirim'
                ]));
                $siswa = M_siswa::find($request->input('id_siswa'));
                $siswa->is_active = $request->is_active;
                $siswa->save();
            }

        );
        return response()->json(true);
    }

    // Status Terima Cadangan Tolak
    public function status(Request $request)
    {
        $siswa = M_siswa::find($request->input('id_siswa'));
        $siswa->status = $request->status;
        $siswa->save();
        return response()->json(true);
    }
}
