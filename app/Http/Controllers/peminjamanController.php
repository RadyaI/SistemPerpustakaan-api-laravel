<?php
namespace App\Http\Controllers;
use App\Models\peminjaman;
use App\Models\detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class peminjamanController extends Controller
{
    //SELECT/GET

    public function getpeminjaman($id){
        $data_peminjaman=peminjaman::select('nama_siswa','nama_kelas','judul_buku','tgl_pinjam','status')
        ->join('siswa','siswa.id_siswa','=','peminjaman.id_siswa')
        ->join('kelas','kelas.id_kelas','=','peminjaman.id_kelas')
        ->join('buku','buku.id_buku','=','peminjaman.id_buku')
        ->where('id_peminjaman','=', $id)
        ->get();
        return Response()->json($data_peminjaman);
    
    }   

    public function getpeminjaman1(){
        $data_siswa = peminjaman::get();
            return response()->json($data_siswa);
    }
    // public function getsemuapeminjaman(){
    //     $data_siswa = peminjaman::
    //       join('siswa','siswa.id_siswa','=','peminjaman.id_siswa')
    //     ->join('kelas','kelas.id_kelas','=','peminjaman.id_kelas')
    //     ->join('buku','buku.id_buku','=','peminjaman.id_buku')
    //     ->get();
    //         return response()->json($data_siswa);
    // }

    //CREATE

        public function createpeminjaman (Request $req){
            $validator = validator::make($req->all(),
            [

                'id_siswa'=>'required',
                'id_kelas'=>'required',
                'id_buku'=>'required',

            ]);

            if($validator->fails()){
                return Response()->json($validator->errors()->toJson());
            }

            $kembali= carbon::now()->addDays(10);
            $pinjam= carbon::now();

            $save = peminjaman::create(
                [
                    'id_siswa' => $req->get('id_siswa'),
                    'id_kelas' => $req->get('id_kelas'),
                    'id_buku' => $req->get('id_buku'),
                    'tgl_pinjam' => $pinjam,
                    'tgl_kembali' => $kembali,
                    'status' => "dipinjam",
                ]);

                // DB::table('detail_peminjaman')
                // ->insert([
                //     'tgl_pinjam' => date('Y-m-d H:i:s'),
                //     'tgl_kembali' => date('Y-m-d H:i:s')
                // ]);

                if($save){
                    // return view('status');
                    return Response()->json(['status' => true , 'message' => 'berhasil menambah meminjam' ]);

                }else{
                    return Response()->json(['status' => false , 'message' => 'Gagal menambah meminjam' ]);
                    // return view('gagal');
                }
        }
        

        //UPDATE

        public function updatepeminjaman(Request $req, $id){

            $validator =  Validator::make($req->all(),[
                'id_siswa'=>'required',
                'id_kelas'=>'required',
                'id_buku'=>'required',
            ]);

            if($validator->fails()){
                return Response()->json($validator->errors()->toJson());
            }
            $ubah= peminjaman::where('id_peminjaman',$id)->update(
                [
                    'id_siswa' => $req->get('id_siswa'),
                    'id_kelas' => $req->get('id_kelas'),
                    'id_buku' => $req->get('id_buku'),
                ]);

                if($ubah){
                    // return view('status');
                    return Response()->json(['status' => true , 'message' => 'berhasil update peminjaman' ]);

                }else{
                    return Response()->json(['status' => false , 'message' => 'Gagal update peminjaman' ]);
                    // return view('gagal');
                }
        }

        // DELETE

        public function deletepeminjaman($id){

            $hapus = peminjaman::where('id_peminjaman',$id) -> delete();

            if($hapus){
                // return view('status');
                return Response()->json(['status' => true , 'message' => 'berhasil hapus peminjaman' ]);

            }else{
                return Response()->json(['status' => false , 'message' => 'Gagal hapus peminjaman' ]);
                // return view('gagal');
            }
        }

        public function kembali($id){

            $kembali = peminjaman::where('id_peminjaman',$id)
            ->update([
                'status' => 'kembali'
            ]);

            if($kembali){
                return Response()->json(['Status' => true, 'Message' => 'Sukses mengembalikan buku']);
            }else{
                return Response()->json(['Status' => false, 'Message' => 'gagal mengembalikan buku']);
            }
        }

}
