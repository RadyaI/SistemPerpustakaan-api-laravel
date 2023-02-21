<?php
namespace App\Http\Controllers;
use App\Models\buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class bukuController extends Controller
{
    //SELECT/GET

    public function getbuku(){
        $data_buku=buku::get();
        return Response()->json($data_buku);
    
    }

    //CREATE

        public function createbuku(Request $req){
            $validator = validator::make($req->all(),
            [
                'judul_buku'=>'required',
                'pengarang'=>'required',

            ]);

            if($validator->fails()){
                return Response()->json($validator->errors()->toJson());
            }

            $save = buku::create(
                [
                    'judul_buku' => $req->get('judul_buku'),
                    'pengarang' => $req->get('pengarang'),
                ]);

                if($save){
                    // return view('status');
                    return Response()->json(['status' => true , 'message' => 'berhasil tambah siswa' ]);

                }else{
                    return Response()->json(['status' => false , 'message' => 'Gagal tambah siswa' ]);
                    // return view('gagal');
                }
        }
        

        //UPDATE

        public function updatebuku(Request $req, $id){

            $validator =  Validator::make($req->all(),[
                'judul_buku'=>'required',
                'pengarang'=>'required',
            ]);

            if($validator->fails()){
                return Response()->json($validator->errors()->toJson());
            }
            $ubah= buku::where('id_buku',$id)->update(
                [
                    'judul_buku' => $req->get('judul_buku'),
                    'pengarang' => $req->get('pengarang'),
                ]);

                if($ubah){
                    // return view('status');
                    return Response()->json(['status' => true , 'message' => 'berhasil update siswa' ]);

                }else{
                    return Response()->json(['status' => false , 'message' => 'Gagal update siswa' ]);
                    // return view('gagal');
                }
        }

        // DELETE

        public function deletebuku($id){

            $hapus = buku::find($id) -> delete();

            if($hapus){
                // return view('status');
                return Response()->json(['status' => true , 'message' => 'berhasil hapus siswa' ]);

            }else{
                return Response()->json(['status' => false , 'message' => 'Gagal hapus siswa' ]);
                // return view('gagal');
            }
        }

}
