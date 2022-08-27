<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rekap_data_odp extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Rekap_data_odp_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'rekap_data_odp?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'rekap_data_odp?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'rekap_data_odp';
            $config['first_url'] = base_url() . 'rekap_data_odp';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Rekap_data_odp_model->total_rows($q);
        $rekap_data_odp = $this->Rekap_data_odp_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'rekap_data_odp_data' => $rekap_data_odp,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Rekap Data Odp';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Rekap Data Odp' => '',
        ];

        $data['page'] = 'rekap_data_odp/rekap_data_odp_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Rekap_data_odp_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_rekap_data' => $row->id_rekap_data,
		'gambar' => $row->gambar,
		'ket_pelanggan' => $row->ket_pelanggan,
		'lokasi_pelanggan' => $row->lokasi_pelanggan,
		'odp_name' => $row->odp_name,
		'tgl_pengecekan' => $row->tgl_pengecekan,
	    );
        $data['title'] = 'Rekap Data Odp';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'rekap_data_odp/rekap_data_odp_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('rekap_data_odp'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('rekap_data_odp/create_action'),
	    'id_rekap_data' => set_value('id_rekap_data'),
	    'gambar' => set_value('gambar'),
	    'ket_pelanggan' => set_value('ket_pelanggan'),
	    'lokasi_pelanggan' => set_value('lokasi_pelanggan'),
	    'odp_name' => set_value('odp_name'),
	    'tgl_pengecekan' => set_value('tgl_pengecekan'),
	);
        $data['title'] = 'Rekap Data Odp';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'rekap_data_odp/rekap_data_odp_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'gambar' => $this->input->post('gambar',TRUE),
		'ket_pelanggan' => $this->input->post('ket_pelanggan',TRUE),
		'lokasi_pelanggan' => $this->input->post('lokasi_pelanggan',TRUE),
		'odp_name' => $this->input->post('odp_name',TRUE),
		'tgl_pengecekan' => $this->input->post('tgl_pengecekan',TRUE),
	    );

            $this->Rekap_data_odp_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('rekap_data_odp'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Rekap_data_odp_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('rekap_data_odp/update_action'),
		'id_rekap_data' => set_value('id_rekap_data', $row->id_rekap_data),
		'gambar' => set_value('gambar', $row->gambar),
		'ket_pelanggan' => set_value('ket_pelanggan', $row->ket_pelanggan),
		'lokasi_pelanggan' => set_value('lokasi_pelanggan', $row->lokasi_pelanggan),
		'odp_name' => set_value('odp_name', $row->odp_name),
		'tgl_pengecekan' => set_value('tgl_pengecekan', $row->tgl_pengecekan),
	    );
            $data['title'] = 'Rekap Data Odp';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'rekap_data_odp/rekap_data_odp_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('rekap_data_odp'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_rekap_data', TRUE));
        } else {
            $data = array(
		'gambar' => $this->input->post('gambar',TRUE),
		'ket_pelanggan' => $this->input->post('ket_pelanggan',TRUE),
		'lokasi_pelanggan' => $this->input->post('lokasi_pelanggan',TRUE),
		'odp_name' => $this->input->post('odp_name',TRUE),
		'tgl_pengecekan' => $this->input->post('tgl_pengecekan',TRUE),
	    );

            $this->Rekap_data_odp_model->update($this->input->post('id_rekap_data', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('rekap_data_odp'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Rekap_data_odp_model->get_by_id($id);

        if ($row) {
            $this->Rekap_data_odp_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('rekap_data_odp'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('rekap_data_odp'));
        }
    }

    public function deletebulk(){
        $delete = $this->Rekap_data_odp_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('success', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('gambar', 'gambar', 'trim|required');
	$this->form_validation->set_rules('ket_pelanggan', 'ket pelanggan', 'trim|required');
	$this->form_validation->set_rules('lokasi_pelanggan', 'lokasi pelanggan', 'trim|required');
	$this->form_validation->set_rules('odp_name', 'odp name', 'trim|required');
	$this->form_validation->set_rules('tgl_pengecekan', 'tgl pengecekan', 'trim|required');

	$this->form_validation->set_rules('id_rekap_data', 'id_rekap_data', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "rekap_data_odp.xls";
        $judul = "rekap_data_odp";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Gambar");
	xlsWriteLabel($tablehead, $kolomhead++, "Ket Pelanggan");
	xlsWriteLabel($tablehead, $kolomhead++, "Lokasi Pelanggan");
	xlsWriteLabel($tablehead, $kolomhead++, "Odp Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Pengecekan");

	foreach ($this->Rekap_data_odp_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->gambar);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ket_pelanggan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->lokasi_pelanggan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->odp_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_pengecekan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=rekap_data_odp.doc");

        $data = array(
            'rekap_data_odp_data' => $this->Rekap_data_odp_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('rekap_data_odp/rekap_data_odp_doc',$data);
    }

  public function printdoc(){
        $data = array(
            'rekap_data_odp_data' => $this->Rekap_data_odp_model->get_all(),
            'start' => 0
        );
        $this->load->view('rekap_data_odp/rekap_data_odp_print', $data);
    }

}

/* End of file Rekap_data_odp.php */
/* Location: ./application/controllers/Rekap_data_odp.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-07-05 08:19:56 */
/* http://harviacode.com */