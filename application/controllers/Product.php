<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    //View supplier page of add/edit/delete function
    public function index() {
        $this->check_usersession();
        $companyid = $this->session->userdata('companyid');
        $companyname = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyname($companyname, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];
        $data['products'] = $this->home->alldatafromdatabase($companyid, 'product');

        foreach ($data['products'] as $index => $product) {
            $materials = json_decode($product['materials'], true);
            foreach ($materials as $key => $material) {
                $result = $this->product->getdatabyproductidfromdatabase($companyid, 'material_totalline', $material['id']);
            
                $materials[$key]['code_ean'] = $result['code_ean'];
                $materials[$key]['production_description'] = $result['production_description'];
                $materials[$key]['selling_unit_price_without_vat'] = $result['selling_unit_price_without_vat'];
            }
            $data['products'][$index]['materials'] = json_encode($materials);
        }

        $session['menu']="Products";
        $session['submenu']="p_pm";
        $session['second-submenu']="";
        $this->session->set_flashdata('menu', $session);

        $this->load->view('header');
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/body', $data);
        $this->load->view('dashboard/product/product/head');
        $this->load->view('dashboard/product/product/body');
        $this->load->view('dashboard/product/product/foot');
        $this->load->view('dashboard/product/product/functions.php');
        $this->load->view('dashboard/foot');
        $this->load->view('footer');
    }
    //View clientpage of creating.
    public function addproduct() {
        $companyid = $this->session->userdata('companyid');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyid($companyid, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];
        $data['stocks'] = $this->home->alldatafromdatabase($companyid, 'stock');
        $data['product'] = $this->product->productfromsetting($companyid, 'product');

        $data['attached'] = "Attached Invoice";

        $session['menu']="Products";
        $session['submenu']="pdm";
        $session['second-submenu']="";
        $this->session->set_flashdata('menu', $session);

        $this->load->view('header');
        $this->load->view('main_page/head', $data);
        $this->load->view('dashboard/product/product/head');
        $this->load->view('dashboard/product/product/shead');
        $this->load->view('dashboard/product/product/addproduct');
        $this->load->view('dashboard/product/product/foot');
        $this->load->view('dashboard/product/product/functions.php');
        $this->load->view('dashboard/foot');
        $this->load->view('footer');
    }
    //View supplierpage of editting.
    public function editproduct($product_id) {
        $companyid = $this->session->userdata('companyid');
        $companyname = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyid($companyid, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];
        $data['stocks'] = $this->home->alldatafromdatabase($companyid, 'stock');
        $product = $this->home->databyidfromdatabase($companyid, 'product', $product_id);

        if ($product['status']=="failed")
            return;
        $data['product'] = $product['data'];

        $materials = json_decode($data['product']['materials'], true);
        foreach ($materials as $index => $material) {
            $result = $this->product->getdatabyproductidfromdatabase($companyid, 'material_totalline', $material['id']);
        
            $materials[$index]['code_ean'] = $result['code_ean'];
            $materials[$index]['production_description'] = $result['production_description'];
            $materials[$index]['selling_unit_price_without_vat'] = $result['selling_unit_price_without_vat'];
        }
        $data['product']['materials'] = json_encode($materials);

        $session['menu']="Products";
        $session['submenu']="pdm";
        $session['second-submenu']="";
        $this->session->set_flashdata('menu', $session);

        $this->load->view('header');
        $this->load->view('main_page/head');
        $this->load->view('dashboard/product/product/head');
        $this->load->view('dashboard/product/product/shead');
        $this->load->view('dashboard/product/product/editproduct', $data);
        $this->load->view('dashboard/product/product/foot');
        $this->load->view('dashboard/product/product/functions.php');
        $this->load->view('footer');
    }
    //Delete Supplier param(supplier_name)
    public function delproduct($product_id) {
        $companyid = $this->session->userdata('companyid');
        $result = $this->supplier->removedatabyidfromdatabase($companyid, $product_id, 'product');
        echo $result;
    }
    //Save(Add/Edit) Supplier post(object(name, number, ...)) get(id)
    public function saveproduct() {
        $companyid = $this->session->userdata('companyid');

        $name = $this->input->post('name');
        $materials = $this->input->post('materials');
        $labours = $this->input->post('labours');
        $auxiliaries = $this->input->post('auxiliaries');

        if (!isset($_GET['id'])) {
            $productid = $this->product->createProduct($companyid, $name, $materials, $labours, $auxiliaries);
            echo $productid;
            return;
        }

        $id = $_GET['id'];
        $result = $this->product->saveProduct($companyid, $id, $name, $materials, $labours, $auxiliaries);
        echo $result;
    }

    public function linebycodeean($codeean) {
        $companyid = $this->session->userdata('companyid');
        $data = $this->supplier->linebycodeean($companyid, $codeean);

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function savesessionbyjson() {
        $data['name'] = $this->input->post('name');
        $data['materials'] = $this->input->post('materials');
        $data['labours'] = $this->input->post('labours');
        $data['auxiliaries'] = $this->input->post('auxiliaries');

        $this->session->set_userdata("htmltopdf", $data);
        echo "success";
    }
    //convert html to pdf
    public function htmltopdf() {
        $this->load->library('Pdf');

        $companyid = $this->session->userdata('companyid');
        $company_name = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];
        $data['product'] = $this->session->userdata('htmltopdf');

        $materials = json_decode($data['product']['materials'], true);
        foreach ($materials as $index => $material) {
            $result = $this->product->getdatabyproductidfromdatabase($companyid, 'material_totalline', $material['id']);
        
            $materials[$index]['code_ean'] = $result['code_ean'];
            $materials[$index]['production_description'] = $result['production_description'];
            $materials[$index]['selling_unit_price_without_vat'] = $result['selling_unit_price_without_vat'];
        }
        $data['product']['materials'] = json_encode($materials);

        $html = $this->load->view('dashboard/product/product/invoicepreview', $data, true);

        $this->pdf->createPDF($html, "InvoicePreview.pdf");
        echo "success";
    }
    //showing html page for deploying pdf
    public function invoicepreview() {
        $companyid = $this->session->userdata('companyid');
        $company_name = $this->session->userdata('companyname');
        $data['user'] = $this->session->userdata('user');
        $company = $this->home->databyname($company_name, 'company');
        if ($company['status']=='failed')
            return;
        $data['company'] = $company['data'];
        $data['product'] = $this->session->userdata('htmltopdf');

        $materials = json_decode($data['product']['materials'], true);
        foreach ($materials as $index => $material) {
            $result = $this->product->getdatabyproductidfromdatabase($companyid, 'material_totalline', $material['id']);
        
            $materials[$index]['code_ean'] = $result['code_ean'];
            $materials[$index]['production_description'] = $result['production_description'];
            $materials[$index]['selling_unit_price_without_vat'] = $result['selling_unit_price_without_vat'];
        }
        $data['product']['materials'] = json_encode($materials);

        $this->load->view('dashboard/product/product/invoicepreview', $data);
    }
    //If usersession is not exist, goto login page.
    public function check_usersession() {
        if($this->session->userdata('user')) {
            // do something when exist
            return true;
        } else{
            // do something when doesn't exist
            redirect('home/signview');
            return false;
        }
    }
};
