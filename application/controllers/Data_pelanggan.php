<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_pelanggan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Data_pelanggan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_pelanggan?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_pelanggan?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_pelanggan';
            $config['first_url'] = base_url() . 'data_pelanggan';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_pelanggan_model->total_rows($q);
        $data_pelanggan = $this->Data_pelanggan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_pelanggan_data' => $data_pelanggan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Data Pelanggan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Data Pelanggan' => '',
        ];

        $data['page'] = 'data_pelanggan/data_pelanggan_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Data_pelanggan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pelanggan' => $row->id_pelanggan,
		'ket_pelanggan' => $row->ket_pelanggan,
		'lokasi_pelanggan' => $row->lokasi_pelanggan,
		'nama_pelanggan' => $row->nama_pelanggan,
		'no_hp' => $row->no_hp,
	    );
        $data['title'] = 'Data Pelanggan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'data_pelanggan/data_pelanggan_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('data_pelanggan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_pelanggan/create_action'),
	    'id_pelanggan' => set_value('id_pelanggan'),
	    'ket_pelanggan' => set_value('ket_pelanggan'),
	    'lokasi_pelanggan' => set_value('lokasi_pelanggan'),
	    'nama_pelanggan' => set_value('nama_pelanggan'),
	    'no_hp' => set_value('no_hp'),
	);
        $data['title'] = 'Data Pelanggan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'data_pelanggan/data_pelanggan_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'ket_pelanggan' => $this->input->post('ket_pelanggan',TRUE),
		'lokasi_pelanggan' => $this->input->post('lokasi_pelanggan',TRUE),
		'nama_pelanggan' => $this->input->post('nama_pelanggan',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
	    );

            $this->Data_pelanggan_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('data_pelanggan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Data_pelanggan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_pelanggan/update_action'),
		'id_pelanggan' => set_value('id_pelanggan', $row->id_pelanggan),
		'ket_pelanggan' => set_value('ket_pelanggan', $row->ket_pelanggan),
		'lokasi_pelanggan' => set_value('lokasi_pelanggan', $row->lokasi_pelanggan),
		'nama_pelanggan' => set_value('nama_pelanggan', $row->nama_pelanggan),
		'no_hp' => set_value('no_hp', $row->no_hp),
	    );
            $data['title'] = 'Data Pelanggan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'data_pelanggan/data_pelanggan_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('data_pelanggan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pelanggan', TRUE));
        } else {
            $data = array(
		'ket_pelanggan' => $this->input->post('ket_pelanggan',TRUE),
		'lokasi_pelanggan' => $this->input->post('lokasi_pelanggan',TRUE),
		'nama_pelanggan' => $this->input->post('nama_pelanggan',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
	    );

            $this->Data_pelanggan_model->update($this->input->post('id_pelanggan', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('data_pelanggan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Data_pelanggan_model->get_by_id($id);

        if ($row) {
            $this->Data_pelanggan_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('data_pelanggan'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('data_pelanggan'));
        }
    }

    public function deletebulk(){
        $delete = $this->Data_pelanggan_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('success', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('ket_pelanggan', 'ket pelanggan', 'trim|required');
	$this->form_validation->set_rules('lokasi_pelanggan', 'lokasi pelanggan', 'trim|required');
	$this->form_validation->set_rules('nama_pelanggan', 'nama pelanggan', 'trim|required');
	$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');

	$this->form_validation->set_rules('id_pelanggan', 'id_pelanggan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "data_pelanggan.xls";
        $judul = "data_pelanggan";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Ket Pelanggan");
	xlsWriteLabel($tablehead, $kolomhead++, "Lokasi Pelanggan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelanggan");
	xlsWriteLabel($tablehead, $kolomhead++, "No Hp");

	foreach ($this->Data_pelanggan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ket_pelanggan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->lokasi_pelanggan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelanggan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=data_pelanggan.doc");

        $data = array(
            'data_pelanggan_data' => $this->Data_pelanggan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('data_pelanggan/data_pelanggan_doc',$data);
    }

  public function printdoc(){
        $data = array(
            'data_pelanggan_data' => $this->Data_pelanggan_model->get_all(),
            'start' => 0
        );
        $this->load->view('data_pelanggan/data_pelanggan_print', $data);
    }

}

/* End of file Data_pelanggan.php */
/* Location: ./application/controllers/Data_pelanggan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-07-05 08:19:51 */
/* http://harviacode.com */