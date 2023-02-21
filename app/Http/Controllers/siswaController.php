<?php
namespace App\Http\Controllers;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class siswaController extends Controller
{
    //SELECT/GET

    public function getsiswa($id){
        $dt_siswa=siswa::where('id_siswa','=',$id)->get();
        return Response()->json($dt_siswa);
        // return view('perpustakaan.index');
    }

    public function getsemuasiswa(){
        $dt_siswa=siswa::get();
        return Response()->json($dt_siswa);
        // return view('perpustakaan.index');
    }

    public function Websiswa(){

        $dt_siswa = siswa::get();

        $data_siswa=[
            'data_siswa' => $dt_siswa,
        ];
        return view ('siswa.datasiswa',$data_siswa);
    }

    public function webdeletesiswa($id){
        siswa::where('id_siswa',$id) -> delete();
         return redirect ("getsiswa");
    }

    //CREATE

        public function createsiswa(Request $req){
            $validator = validator::make($req->all(),
            [
                'nama_siswa'=>'required',
                'tanggal_lahir'=>'required',
                'gender'=>'required',
                'alamat'=>'required',

            ]);

            if($validator->fails()){
                return Response()->json($validator->errors()->toJson());
            }

            $save = siswa::create(
                [
                    'nama_siswa' => $req->get('nama_siswa'),
                    'tanggal_lahir' => $req->get('tanggal_lahir'),
                    'gender' => $req->get('gender'),
                    'alamat' => $req->get('alamat'),
        
                ]);

                if($save){
                    return Response()->json(['status' => true , 'message' => 'sukses tambah siswa' ]);
                }else{
                    return Response()->json(['status' => false , 'message' => 'Gagal tambah siswa' ]);

                }
        }

        //STORE
        public function store(Request $request){
            $siswa = new siswa([
                'nama_siswa' => $request -> input ('nama_siswa'),
                'tanggal_lahit' => $request -> input ('tanggal_lahit'),
                'gender' => $request -> input ('gender'),
                'alamat' => $request -> input ('input')
            ]);

            $siswa->save();
            return responses()->tojson('Siswa di tambah!');
        }

        //UPDATE

        public function updatesiswa(Request $req, $id){

            $validator =  Validator::make($req->all(),[
                'nama_siswa'=>'required',
                'tanggal_lahir'=>'required',
                'gender'=>'required',
                'alamat'=>'required'
            ]);

            if($validator->fails()){
                return Response()->json($validator->errors()->toJson());
            }
            $ubah= siswa::where('id_siswa',$id)->update(
                [
                    'nama_siswa' => $req->get('nama_siswa'),
                    'tanggal_lahir' => $req->get('tanggal_lahir'),
                    'gender' => $req->get('gender'),
                    'alamat' => $req->get('alamat'),
                ]);

                if($ubah){
                    return Response()->json(['status' => true , 'message' => 'sukses update siswa' ]);
                }else{
                    return Response()->json(['status' => false , 'message' => 'Gagal update siswa' ]);

                }
        }

        // DELETE

        public function deletesiswa($id){

            $hapus = siswa::find($id) -> delete();

            if($hapus){
                return Response()->json(['status' => true , 'message' => 'sukses hapus siswa' ]);
            }else{
                return Response()->json(['status' => false , 'message' => 'Gagal hapus siswa' ]);
            }
        }

}
