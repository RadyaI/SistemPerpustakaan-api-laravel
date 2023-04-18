<?php

namespace App\Http\Controllers;

use App\Models\peminjaman;
use App\Models\buku;
// use App\Models\detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class peminjamanController extends Controller
{
    //SELECT/GET

    public function getpeminjaman($id)
    {
        $data_peminjaman = peminjaman::
            //   join('siswa','siswa.id_siswa','=','peminjaman.id_siswa')
            // ->join('kelas','kelas.id_kelas','=','peminjaman.id_kelas')
            join('buku', 'buku.id_buku', '=', 'peminjaman.id_buku')
            ->where('id_peminjaman', '=', $id)
            ->get();
        return Response()->json($data_peminjaman);
    }

    public function getpeminjaman1()
    {
        $data_siswa = peminjaman::
            // join('siswa','siswa.id_siswa','=','peminjaman.id_siswa')
            where('tgl_kembali', '=', null)
            ->orderBy('id_peminjaman', 'desc')
            ->get();
        // ->paginate(3);
        return response()->json($data_siswa);
    }

    public function getstatus($id)
    {
        $status = peminjaman::where('status', '=', $id)
            // ->select('id_peminjaman','id_siswa','nama_siswa','nama_kelas','judul_buku','tanggal_pinjam','tanggal_kembali','status')
            ->join('siswa', 'siswa.id_siswa', '=', 'peminjaman.id_siswa')
            ->get();
        return response()->json($status);
    }

    public function history()
    {
        $history = peminjaman::where('denda', '=', 0)
            ->where('tgl_kembali', '!=', null)
            ->join('buku', 'buku.id_buku', '=', 'peminjaman.id_buku')
            ->orderBy('id_peminjaman', 'desc')
            ->get();
        return response()->json($history);
    }

    public function denda()
    {
        $denda = peminjaman::where('denda', '!=', 0)
            ->where('tgl_kembali', '!=', null)
            ->join('buku', 'buku.id_buku', '=', 'peminjaman.id_buku')
            ->get();
        return response()->json($denda);
    }

    public function bayardenda($id)
    {
        $denda = peminjaman::where('id_peminjaman', '=', $id)->update([
            'denda' => 0
        ]);
    }

    //CREATE

    public function createpeminjaman(Request $req)
    {
        $validator = validator::make(
            $req->all(),
            [

                // 'id_siswa'=>'required',
                // 'id_kelas'=>'required',
                'id_buku' => 'required',

            ]
        );

        if ($validator->fails()) {
            return Response()->json($validator->errors()->toJson());
        }

        $tenggat = carbon::now()->addDays(5);
        $pinjam = carbon::now();
        $get_id = $req->input('id_buku');
        $getbuku = buku::where('id_buku', $get_id)->select('jumlah_pinjam')->first();
        $add = $getbuku->jumlah_pinjam + 1;

        $updatebuku = buku::where('id_buku', $get_id)->update([
            'jumlah_pinjam' => $add
        ]);

        $save = peminjaman::create(
            [
                // 'id_siswa' => $req->get('id_siswa'),
                'nama' => $req->input('nama'),
                // 'id_kelas' => $req->get('id_kelas'),
                'alamat' => $req->input('alamat'),
                'id_buku' => $get_id,
                'tgl_pinjam' => $pinjam,
                'tenggat' => $tenggat,
                'status' => "dipinjam",
            ]
        );

        // DB::table('detail_peminjaman')
        // ->insert([
        //     'tgl_pinjam' => date('Y-m-d H:i:s'),
        //     'tgl_kembali' => date('Y-m-d H:i:s')
        // ]);

        if ($save) {
            // return view('status');
            return Response()->json(['status' => true, 'message' => 'berhasil menambah meminjam']);
        } else {
            return Response()->json(['status' => false, 'message' => 'Gagal menambah meminjam']);
            // return view('gagal');
        }
    }


    //UPDATE
    public function editpeminjaman(Request $req, $id)
    {
        $edit = peminjaman::where('id_peminjaman', '=', $id)->update([
            'tgl_pinjam' => $req->input('tgl_pinjam'),
            'tgl_kembali' => $req->input('tgl_kembali'),
            'tenggat' => $req->input('tenggat'),
            'denda' => $req->input('denda')
        ]);
        return response()->json(['Message' => 'sukses edit data']);
    }

    // DELETE   

    public function deletepeminjaman($id)
    {

        $hapus = peminjaman::where('id_peminjaman', $id)->delete();

        if ($hapus) {
            // return view('status');
            return Response()->json(['status' => true, 'message' => 'berhasil hapus peminjaman']);
        } else {
            return Response()->json(['status' => false, 'message' => 'Gagal hapus peminjaman']);
            // return view('gagal');
        }
    }

    public function kembali($id)
    {
        $dt_kembali = peminjaman::where('id_peminjaman', '=', $id)->select('tgl_kembali')->get();

        // $tgl_sekarang = carbon::now()->format('y-m-d');
        $tgl_sekarang = Carbon::now();
        // $tgl_kembali = new Carbon($dt_kembali -> $tgl_kembali);
        if ($dt_kembali > $tgl_sekarang) {
            $denda = 25000;
        } else {
            $denda = 0;
        }

        // if(strtotime($tgl_sekarang) > strtotime($dt_kembali)) {
        //     $jumlah_hari = $dt_kembali -> diff ($tgl_sekarang) -> days;
        //     $denda = $jumlah_hari*$dendaperhari;
        // }else{
        //     $denda = 0;
        // }



        $kembali = peminjaman::where('id_peminjaman', $id)
            ->update([
                'status' => 'kembali',
                'tgl_kembali' => $tgl_sekarang,
                'denda' => $denda,
            ]);

        if ($kembali) {
            return Response()->json(['Status' => true, 'Message' => 'Sukses mengembalikan buku']);
        } else {
            return Response()->json(['Status' => false, 'Message' => 'gagal mengembalikan buku']);
        }
    }
}
