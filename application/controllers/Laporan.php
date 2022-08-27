<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Laporan_model');
        $this->load->model('Data_odp_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'laporan?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'laporan?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'laporan';
            $config['first_url'] = base_url() . 'laporan';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Laporan_model->total_rows($q);
       // $laporan = $this->Laporan_model->get_limit_data($config['per_page'], $start, $q);
       $laporan = $this->Data_odp_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'laporan_data' => $laporan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Laporan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Laporan' => '',
        ];

        $data['page'] = 'laporan/laporan_list';
        $this->load->view('template/backend', $data);
    }

    public function grafik()
    {
        $data['title'] = 'Laporan';
        $data['subtitle'] = 'Laporan chat';
        $data['crumb'] = [
            'Laporan' => '',
        ];

        $bulan = $this->input->post("bulan");
        $lokasi = $this->input->post("lokasi");
        if (isset($bulan)) {
            $bulanini = $bulan;
        } else {
            $bulanini = date('Y-m');
        }

    if ($lokasi!='') {
        $total_lokasi = $this->db->query("SELECT * FROM data_pelanggan dp join data_odp odp on (dp.id_pelanggan=odp.id_pelanggan) where DATE_FORMAT(odp.tgl_pengecekan,'%Y-%m')='$bulanini' and dp.lokasi_pelanggan='$lokasi'")->num_rows();
        $lokasi=preg_replace('/\s+/', '_', $lokasi);
        $data['nama_file']=$lokasi.".png";
        $data['lokasimaps']=$lokasi;
    }else{
        $total_lokasi = $this->db->query("SELECT * FROM data_pelanggan dp join data_odp odp on (dp.id_pelanggan=odp.id_pelanggan) where DATE_FORMAT(odp.tgl_pengecekan,'%Y-%m')='$bulanini'")->num_rows(); 
        $data['nama_file']=".png";
        $data['lokasimaps']=$lokasi;
    }

    // print_r($total_lokasi);
    // die;

       
        // $total_chat_admin = $this->db->query("SELECT count(*) as total FROM chat where status_chat=1 AND DATE_FORMAT(tanggal_chat,'%Y-%m')='$bulanini' GROUP BY month(tanggal_chat)")->row();
        // $total_chat_bot = $this->db->query("SELECT count(*) as total FROM chat where status_chat=0 AND DATE_FORMAT(tanggal_chat,'%Y-%m')='$bulanini' GROUP BY month(tanggal_chat)")->row();
        // $total_chat_selesai = $this->db->query("SELECT count(*) as total FROM chat where status_chat=2 AND DATE_FORMAT(tanggal_chat,'%Y-%m')='$bulanini' GROUP BY month(tanggal_chat)")->row();

        if ($total_lokasi == NULL) {
            $total_lokasi = 0;
        } 

        // print_r($total_lokasi);
        // die;
        $data['total_lokasi'] = $total_lokasi;
        $data['lokasi'] = $this->db->query("SELECT distinct(lokasi_pelanggan) as lokasi from data_pelanggan")->result();
        // $data['total_chat_bot'] = $total_chat_bot;
        // $data['total_chat_admin'] = $total_chat_admin;
        // $data['total_chat_selesai'] = $total_chat_selesai;
        $data['page'] = 'grafik';
        $this->load->view('template/backend', $data);
    }
    

    public function read($id) 
    {
        $row = $this->Laporan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_laporan' => $row->id_laporan,
		'evaluasi' => $row->evaluasi,
		'tgl_evaluasi' => $row->tgl_evaluasi,
	    );
        $data['title'] = 'Laporan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'laporan/laporan_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('laporan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('laporan/create_action'),
	    'id_laporan' => set_value('id_laporan'),
	    'evaluasi' => set_value('evaluasi'),
	    'tgl_evaluasi' => set_value('tgl_evaluasi'),
	);
        $data['title'] = 'Laporan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'laporan/laporan_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'evaluasi' => $this->input->post('evaluasi',TRUE),
		'tgl_evaluasi' => $this->input->post('tgl_evaluasi',TRUE),
	    );

            $this->Laporan_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('laporan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Laporan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('laporan/update_action'),
		'id_laporan' => set_value('id_laporan', $row->id_laporan),
		'evaluasi' => set_value('evaluasi', $row->evaluasi),
		'tgl_evaluasi' => set_value('tgl_evaluasi', $row->tgl_evaluasi),
	    );
            $data['title'] = 'Laporan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'laporan/laporan_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('laporan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_laporan', TRUE));
        } else {
            $data = array(
		'evaluasi' => $this->input->post('evaluasi',TRUE),
		'tgl_evaluasi' => $this->input->post('tgl_evaluasi',TRUE),
	    );

            $this->Laporan_model->update($this->input->post('id_laporan', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('laporan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Laporan_model->get_by_id($id);

        if ($row) {
            $this->Laporan_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('laporan'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('laporan'));
        }
    }

    public function deletebulk(){
        $delete = $this->Laporan_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('success', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('evaluasi', 'evaluasi', 'trim|required');
	$this->form_validation->set_rules('tgl_evaluasi', 'tgl evaluasi', 'trim|required');

	$this->form_validation->set_rules('id_laporan', 'id_laporan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "laporan.xls";
        $judul = "laporan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id ODP");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelanggan");
	xlsWriteLabel($tablehead, $kolomhead++, "Lokasi Pelanggan");

	foreach ($this->Data_odp_model->print_odp() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_odp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelanggan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->lokasi_pelanggan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=laporan.doc");

        $data = array(
            'laporan_data' => $this->Data_odp_model->print_odp(),
            'start' => 0
        );
        
        $this->load->view('laporan/laporan_doc',$data);
    }

  public function printdoc(){
        $data = array(
            'laporan_data' => $this->Data_odp_model->print_odp(),
            'start' => 0
        );
        $this->load->view('laporan/laporan_print', $data);
    }

}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-07-19 10:03:16 */
/* http://harviacode.com */