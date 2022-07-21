<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_siswa extends Model
{
    use HasFactory;
    protected $fillable = [
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
    protected $table = 'tbl_siswa';
    protected $primaryKey = 'id_siswa';
    public $timestamps = false;

    public static function getDetail($id)
    {
        return DB::table('tbl_siswa')
            ->select(
                '*'
            )
            ->join('users', 'users.id', '=', 'tbl_siswa.id_akun')
            ->where('id_akun', $id)
            ->first();
    }
}
