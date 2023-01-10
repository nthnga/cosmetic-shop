<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Yajra\Datatables\Datatables;
use Session;

class ConnectController extends Controller
{
    public  function index()
    {
        return view('admin.contacts.index');
    }
    public function getList(Request $request)
    {
        $connects = Contact::orderBy('created_at','DESC')->get(); 
        
        return Datatables::of($connects)
            ->addIndexColumn()
            ->editColumn('name', function ($connect){
                return '<a href=""><b>'.$connect->name.'</b></a>';
            })
            ->editColumn('email', function ($connect) {
                return $connect->email;
            })
            ->editColumn('phone', function ($connect) {
                return $connect->phone;
            })
            ->editColumn('title', function ($connect) {
                return $connect->title;
            })
            ->editColumn('message', function ($connect) {
                return $connect->message;
            })
            ->editColumn('created_at', function ($connect) {
                return'<div>
                '.date("H:i | d/m/Y", strtotime($connect->created_at)).'
             </div>';
            })
            ->addColumn('action', function ($connect) {
                return '
                    
                     <a
                        style="cursor:pointer;"
                        data-id="'.$connect->id.'" data-token="{{csrf_token()}}"
                        tooltip="Xóa"
                        flow="up"
                        class="menu-link px-3 text-warning delete">
                        <i style="color:red" class="fa-solid fa-trash"></i>
                    </a>
                ';
            })

            ->rawColumns(['name', 'action','created_at'])
            ->make(true);

    

    }

    public function destroy($id)
    {
        $connect = Contact::find($id);
        $connect->delete();
        return response()->json(['success' => 'Thành công']);
           
    }
}
