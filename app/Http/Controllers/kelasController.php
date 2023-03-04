<?php
namespace App\Http\Controllers;
// use app\Models\siswa;
use App\Models\kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class kelasController extends Controller
{
    //GET
   public function getkelas(){
    $data_kelas = kelas::get();
    return Response()->json($data_kelas);
   }

   public function getdetailkelas($id){
    $data_kelas = kelas::where('id_kelas' ,'=',$id)->get();
        return response()->json($data_kelas);
   }

   //CREATE
   
        public function createkelas(Request $req){
            $validator = validator::make($req->all(),
            [
                'nama_kelas'=>'required',
            ]);

            if($validator->fails()){
                return Response()->json($validator->errors()->toJson());
            }

            $save = kelas::create(
                [
                    'nama_kelas' => $req->get('nama_kelas'),
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

            public function updatekelas(Request $req, $id){

                $validator =  Validator::make($req->all(),[
                    'nama_kelas'=>'required',
                ]);

                if($validator->fails()){
                    return Response()->json($validator->errors()->toJson());
                }
                $ubah= kelas::where('id_kelas',$id)->update(
                    [
                        'nama_kelas' => $req->get('nama_kelas'),
                    ]);

                    if($ubah){
                        // return view('status');
                        return Response()->json(['status' => true , 'message' => 'berhasil update siswa' ]);
    
                    }else{
                        return Response()->json(['status' => false , 'message' => 'Gagal update siswa' ]);
                        // return view('gagal');
                    }
            }

    //DELETE

                public function deletekelas($id){

                    $hapus = kelas::where('id_kelas',$id) -> delete();

                    if($hapus){
                        // return view('status');
                        return Response()->json(['status' => true , 'message' => 'berhasil hapus siswa' ]);
        
                    }else{
                        return Response()->json(['status' => false , 'message' => 'Gagal hapus siswa' ]);
                        // return view('gagal');
                    }
                }

}
