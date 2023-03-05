<?php
namespace App\Controllers;

use App\Models\FormExpert;
use TypeRocket\Controllers\Controller;
use TypeRocket\Http\Request;

class FormExpertController extends Controller
{
    /**
     * The index page for admin
     *
     * @return mixed
     */
    public function index()
    {

        $form_expert = FormExpert::new()->findAll()->orderBy('ID', 'DESC')->get()->toArray();
        return $form_expert;
        
    }

    /**
     * The edit page for admin
     *
     * @param string|FormExpert $form_expert
     *
     * @return mixed
     */
    public function edit()
    {
        if( $_GET['action'] == 'edit' ) { var_dump( $_GET['status'] );

            if( isset( $_GET['ID'] ) && isset( $_GET['status'] ) ) {

                // echo 'yessssssssssssssssssss';
                if( $_GET['status'] == 0 ) {
                    $status = 0;
                } else {
                    $status = 1;
                }
                $form_expert = FormExpert::new()->findById($_GET['ID']); //var_dump($form_expert->ID); die();
                // $form_expert->json = ['post_status'=> $status];
                $form_expert->post_status = $status;
                $form_expert->update();

            } else {

                echo 'noooooooooooooooooo';
                // header('Location: http://www.hostinger.com/');
                // $redirect = tr_redirect();
                // return $redirect->toAdmin('themes.php', ['page' => 'theme_options'])->now();
                // $redirect->withMessage('You did it!', 'success');


                // tr_redirect()->toURL(home_url('/account/request/'))->now();

            }
            // if( $request->checkNonce() ) {

                // $form_request->post_author   = $user_id;
                // $form_request->post_date     = date("Y-m-d h:i:s");
                // $form_request->post_date_gmt = date("Y-m-d h:i:s");
                // $form_request->post_title    = $request->getDataPost('request_title');
                // $form_request->post_content  = $request->getDataPost('request_description');
                // $form_request->post_status   = 0;
                // $form_request->save();    
                
                // $response = [
                //     'message' => 'درخواست شما با موفقیت ثبت شد',
                //     'type'    => 200
                // ];
                // $redirect = tr_redirect()->withMessage('درخواست شما با موفقیت ثبت شد', 200);
                // $redirect = tr_redirect();
                // $redirect->toUrl( home_url('/account/request/?action=add') )->now();
                
            // } else {

                // $response = [
                //     // 'message' => 'مشکلی رخ داد، لطفاً مجدداً امتحان نمایید',
                //     // 'type'    => 400
                // ];
                // $redirect = tr_redirect()->withMessage('مشکلی رخ داد، لطفاً مجدداً امتحان نمایید', 400);
                // $redirect->toUrl( home_url('/account/request/?action=add') )->now();           

            // }

        }

    }

    /**
     * The delete page for admin
     *
     * @param string|FormExpert $form_expert
     *
     * @return mixed
     */
    public function delete()
    {
        // $form_expert = FormExpert::new()->findAll()->orderBy('ID', 'DESC')->get()->toArray();
        // return $form_expert;
    }
}