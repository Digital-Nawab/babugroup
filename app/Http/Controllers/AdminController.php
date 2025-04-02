<?php

namespace App\Http\Controllers;

use Config\App;
use Illuminate\Http\Request;
use App\Models\College;
use App\Models\Student;
use App\Models\student_fee;
use Session;

class AdminController extends Controller
{
    //
    public function dashboard(){
        if(Session::has('admin')){
            $data['title'] = "Admin Login";
            $data['nav']   = "dashboard";
            $data['data'] = array(
                'institutions'  => College::count(),
                'students'      => Student::count(),
                'collected_fee' => student_fee::where(['fee_status'=> 'pay', 'is_active'=> '1'])->count(),
                'remain_fee' => student_fee::where(['fee_status'=> 'remain', 'is_active'=> '1'])->count(),

//                'collected_fee' => student_fee::getSum('student_fee', array('is_active'=> '1', 'fee_status'=> 'pay'), 'installment_amount'),
//                'remain_fee'    => student_fee::getSum('student_fee', array('is_active'=> '1', 'fee_status'=> 'remain'), 'installment_amount'),
            );
            return view('admin.dashboard', $data);
        }else{
            return redirect('auth/dashboard');
        }
    }

    public function singleUpdateData(Request $request){
        if(Session::has('admin') || Session::has('college')){
            $post = $request->all();
            //echo '<pre>'; print_r($post); exit;
            $sql = FunctionModel::update_data('tbl_'.$post['tab'], $post['where'], $post['data']);
            if($sql['code'] == 200){
                return json_encode(array('code'=> 200, 'msg'=> 'Status update successful.'));
            }else{
                return json_encode(array('code'=> 319, 'data'=> 'Try again later.'));
            }
        }else{
            return redirect('auth/dashboard');
        }

    }

    public function getSingleData(Request $request){
        if(Session::has('admin') || Session::has('college')){
            $post = $request->all();
            $sql = FunctionModel::getData('tbl_'.$post['tab'], $post['where'], 'first');
            if($sql != ""){
                return json_encode(array('code'=> 200, 'data'=> $sql));
            }else{
                return json_encode(array('code'=> 319, 'data'=> 'Try again later.'));
            }
        }else{
            return redirect('auth/dashboard');
        }

    }

    public function get_address(Request $request){
        $post = $request->all();
        $url = "http://www.postalpincode.in/api/pincode/".$post['pincode'];
        $address = $this->thiCurl($url);
        $address = json_decode($address, true);
       // echo '<pre>'; print_r($address); exit;
        $data = array();
        if($address['Status'] == "Success"){
            $data['branch']   = $address['PostOffice'][0]['BranchType'];
            $data['district']   = $address['PostOffice'][0]['District'];
            $data['region']     = $address['PostOffice'][0]['Region'];
            $data['state']      = $address['PostOffice'][0]['State'];
            $data['country']    = $address['PostOffice'][0]['Country'];
            return json_encode(array('code'=> 200, 'data'=> $data));
        }else if($address['Status'] == "Error"){
            return json_encode(array('code'=> 319, 'msg'=> $address['Message']));
        }
        //echo '<pre>'; print_r($data); exit;


    }

    public function thiCurl($url){
        $curl_handle=curl_init();
        curl_setopt($curl_handle,CURLOPT_URL,$url);
        curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
        curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
        $buffer = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $buffer;
    }

    public function selectInstitution(Request $request){
        $post = $request->all();
        if(Session::has('institution')){
            Session::forget('institution');
        }
        $get = FunctionModel::getData('tbl_institution', array('id'=> $post['id']), 'first');
        if($get !=""){
            $data = array(
                'id' => $get->id,
                'institution_name' => $get->institution_name,
                'institution_id' => $get->institution_id
            );
            Session::put('institution', $data);
            return json_encode(array('code'=> 200, 'msg'=> 'Institution selected successful.'));
        }else{
            return json_encode(array('code'=> 319, 'msg'=> 'Getting error please try again..'));
        }

    }

}
