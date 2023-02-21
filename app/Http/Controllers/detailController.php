<?php

namespace App\Http\Controllers;
use App\Models\detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class detailController extends Controller
{

    //ADD

    public function getdetail(){
        $data_detail=detail::select('id_siswa')
        ->join('peminjaman','peminjaman.id_peminjaman','=','detail_peminjaman.id_peminjaman')
        ->get();
        
        return Response()->json($data_detail);
    
    }

    //CREATE

    public function createdetail (Request $req){
        $validator = validator::make($req->all(),
        [
            'id_peminjaman'=>'required',
            'tgl_pinjam'=>'required',
            'tgl_kembali'=>'required',

        ]);

        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }

        $save = detail::create(
            [
                'id_peminjaman' => $req->get('id_peminjaman'),
                'tgl_pinjam' => $req->get('tgl_pinjam'),
                'tgl_kembali' => $req->get('tgl_kembali'),
            ]);

            if($save){
                // return view('status');
                return Response()->json(['status' => true , 'message' => 'berhasil menambah meminjam' ]);

            }else{
                return Response()->json(['status' => false , 'message' => 'Gagal menambah meminjam' ]);
                // return view('gagal');
            }
    }

    //DELETE

    public function deletedetail($id){

        $hapus = detail::where('id_detail',$id) -> delete();

        if($hapus){
            // return view('status');
            return Response()->json(['status' => true , 'message' => 'berhasil hapus peminjaman' ]);

        }else{
            return Response()->json(['status' => false , 'message' => 'Gagal hapus peminjaman' ]);
            // return view('gagal');
        }
    }
    
}
