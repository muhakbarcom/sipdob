<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_odp extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Data_odp_model');
        $this->load->library('form_validation');
    }

    public function redirect_index()
    {
        redirect(site_url('data_odp'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_odp?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_odp?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_odp';
            $config['first_url'] = base_url() . 'data_odp';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_odp_model->total_rows($q);
        $data_odp = $this->Data_odp_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_odp_data' => $data_odp,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Data Odp';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Data Odp' => '',
        ];

        $data['page'] = 'data_odp/data_odp_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id)
    {
        $row = $this->Data_odp_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_odp' => $row->id_odp,
                'id_pelanggan' => $row->id_pelanggan,
                'ket_pelanggan' => $row->ket_pelanggan,
                'lokasi_pelanggan' => $row->lokasi_pelanggan,
                'nama_pelanggan' => $row->nama_pelanggan,
                'odp_name' => $row->odp_name,
                'otp_slot' => $row->otp_slot,
                'tgl_pengecekan' => $row->tgl_pengecekan,
            );
            $data['title'] = 'Data Odp';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'data_odp/data_odp_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('data_odp'));
        }
    }

    public function validasi_data($id_odp)
    {
        $data = array(
            'button' => 'Validasi',
            'action' => site_url('data_odp/validasi_data_action'),
            'id_odp' => $id_odp,
        );

        $data['title'] = 'Data Odp Validasi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'data_odp/validasi_data';
        $this->load->view('template/backend', $data);
    }

    public function validasi_data_action()
    {
        $id_odp = $this->input->post('id_odp', TRUE);
        require_once APPPATH . "/third_party/PHPExcel.php";
        $config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'xlsx|xls|csv';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('uploadFile')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            $nama_file = $data['upload_data']['file_name'];
            $data_update_file = array(
                'file_validasi_data' => $nama_file,
            );
            // update file_validasi_data di data_odp
            $this->Data_odp_model->update($id_odp, $data_update_file);
        }

        $file = "./assets/uploads/$nama_file";

        //load the excel library
        $this->load->library('excel');

        //read file from path
        $objPHPExcel = PHPExcel_IOFactory::load($file);

        //get only the Cell Collection
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

        //extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

            //The header will/should be in row 1 only. of course, this can be modified to suit your need.
            if ($row == 1) {
                $header[$row][$column] = $data_value;
            } else {
                $arr_data[$row][$column] = $data_value;
            }
        }

        //send the data in an array format
        $data['header'] = $header;
        $data['values'] = $arr_data;

        $data_odp = $this->db->query("SELECT * from v_odp where id_odp = '$id_odp'")->row();
        $nama_pelanggan = $data_odp->nama_pelanggan;
        $lokasi_pelanggan = $data_odp->lokasi_pelanggan;
        $odp_name = $data_odp->odp_name;
        $olt_slot = $data_odp->olt_slot;

        $v_odp = $this->db->query("SELECT * from v_odp where id_odp = '$id_odp'")->row();

        $valid = 0;
        foreach ($arr_data as $value) {
            $data_odp_name = $value['A'];
            $data_olt_slot = $value['B'];
            $data_nama_pelanggan = $value['D'];
            $data_lokasi_pelanggan = $value['E'];

            if ($data_odp_name == $odp_name && $data_olt_slot == $olt_slot && $data_nama_pelanggan == $nama_pelanggan && $data_lokasi_pelanggan == $lokasi_pelanggan) {
                $data_update_file = array(
                    'validasi_data' => 1,
                );
                // update file_validasi_data di data_odp
                $this->Data_odp_model->update($id_odp, $data_update_file);

                // insert $v_odp ke tabel history
                $data_v_odp = array(
                    'id_odp' => $v_odp->id_odp,
                    'id_pelanggan' => $v_odp->id_pelanggan,
                    'odp_name' => $v_odp->odp_name,
                    'otp_slot' => $v_odp->olt_slot,
                    'tgl_pengecekan' => date('Y-m-d'),
                    'penginput' => $this->session->userdata('user_id'),
                    'validasi_history' => 1,
                );
                $this->db->insert('history', $data_v_odp);

                $valid = 1;

                redirect(site_url('data_odp'));
            }
        }
        if ($valid == 0) {
            $data_v_odp = array(
                'id_odp' => $v_odp->id_odp,
                'id_pelanggan' => $v_odp->id_pelanggan,
                'odp_name' => $v_odp->odp_name,
                'otp_slot' => $v_odp->olt_slot,
                'tgl_pengecekan' => date('Y-m-d'),
                'penginput' => $this->session->userdata('user_id'),
                'validasi_history' => 0,
            );
            $this->db->insert('history', $data_v_odp);
        }
        redirect(site_url('data_odp'));
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_odp/create_action'),
            'id_odp' => set_value('id_odp'),
            'id_pelanggan' => set_value('id_pelanggan'),
            // 'ket_pelanggan' => set_value('ket_pelanggan'),
            // 'lokasi_pelanggan' => set_value('lokasi_pelanggan'),
            // 'nama_pelanggan' => set_value('nama_pelanggan'),
            'odp_name' => set_value('odp_name'),
            'otp_slot' => set_value('otp_slot'),
            'tgl_pengecekan' => set_value('tgl_pengecekan'),
        );

        $data['list_pelanggan'] = $this->db->query("SELECT * from data_pelanggan")->result();
        // print_r($data['list_pelanggan']);die;
        $data['title'] = 'Data Odp';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'data_odp/data_odp_form_add';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'penginput' => $this->session->userdata['user_id'],
                // 'ket_pelanggan' => $this->input->post('ket_pelanggan',TRUE),
                // 'lokasi_pelanggan' => $this->input->post('lokasi_pelanggan',TRUE),
                // 'nama_pelanggan' => $this->input->post('nama_pelanggan',TRUE),
                'id_pelanggan' => $this->input->post('id_pelanggan', TRUE),
                'odp_name' => $this->input->post('odp_name', TRUE),
                'otp_slot' => $this->input->post('otp_slot', TRUE),
                'tgl_pengecekan' => $this->input->post('tgl_pengecekan', TRUE),
            );

            $this->Data_odp_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('data_odp'));
        }
    }

    public function update($id)
    {
        $row = $this->Data_odp_model->get_by_id($id);
        // print_r($row->id_pelanggan);die;
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_odp/update_action'),
                'id_odp' => set_value('id_odp', $row->id_odp),
                'id_pelanggan' => set_value('id_pelanggan', $row->id_pelanggan),
                // 'ket_pelanggan' => set_value('ket_pelanggan', $row->ket_pelanggan),
                // 'lokasi_pelanggan' => set_value('lokasi_pelanggan', $row->lokasi_pelanggan),
                // 'nama_pelanggan' => set_value('nama_pelanggan', $row->nama_pelanggan),
                'odp_name' => set_value('odp_name', $row->odp_name),
                'otp_slot' => set_value('otp_slot', $row->otp_slot),
                'tgl_pengecekan' => set_value('tgl_pengecekan', $row->tgl_pengecekan),
            );
            $data['list_pelanggan'] = $this->db->query("SELECT * from data_pelanggan")->result();

            $data['title'] = 'Data Odp';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'data_odp/data_odp_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('data_odp'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_odp', TRUE));
        } else {
            $data = array(
                'penginput' => $this->session->userdata['user_id'],
                // 'ket_pelanggan' => $this->input->post('ket_pelanggan',TRUE),
                // 'lokasi_pelanggan' => $this->input->post('lokasi_pelanggan',TRUE),
                // 'nama_pelanggan' => $this->input->post('nama_pelanggan',TRUE),
                'id_pelanggan' => $this->input->post('id_pelanggan', TRUE),
                'odp_name' => $this->input->post('odp_name', TRUE),
                'otp_slot' => $this->input->post('otp_slot', TRUE),
                'tgl_pengecekan' => $this->input->post('tgl_pengecekan', TRUE),
            );

            $this->Data_odp_model->update($this->input->post('id_odp', TRUE), $data);

            $data = array(
                'id_odp' => $this->input->post('id_odp', TRUE),
                'penginput' => $this->session->userdata['user_id'],
                // 'ket_pelanggan' => $this->input->post('ket_pelanggan',TRUE),
                // 'lokasi_pelanggan' => $this->input->post('lokasi_pelanggan',TRUE),
                // 'nama_pelanggan' => $this->input->post('nama_pelanggan',TRUE),
                'id_pelanggan' => $this->input->post('id_pelanggan', TRUE),
                'odp_name' => $this->input->post('odp_name', TRUE),
                'otp_slot' => $this->input->post('otp_slot', TRUE),
                'tgl_pengecekan' => $this->input->post('tgl_pengecekan', TRUE),
            );
            $this->db->insert('history', $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('data_odp'));
        }
    }

    public function history()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_odp_history?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_odp_history?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_odp_history';
            $config['first_url'] = base_url() . 'data_odp_history';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_odp_model->total_rows_history($q);
        $data_odp = $this->Data_odp_model->get_limit_data_history($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_odp_data' => $data_odp,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Data Odp';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Data Odp' => '',
        ];

        $data['page'] = 'data_odp/data_odp_list_history';
        $this->load->view('template/backend', $data);
    }

    public function delete($id)
    {
        $row = $this->Data_odp_model->get_by_id($id);

        if ($row) {
            $this->Data_odp_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('data_odp'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('data_odp'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Data_odp_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('success', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        // $this->form_validation->set_rules('ket_pelanggan', 'ket pelanggan', 'trim|required');
        // $this->form_validation->set_rules('lokasi_pelanggan', 'lokasi pelanggan', 'trim|required');
        // $this->form_validation->set_rules('nama_pelanggan', 'nama pelanggan', 'trim|required');
        $this->form_validation->set_rules('odp_name', 'odp name', 'trim|required');
        $this->form_validation->set_rules('otp_slot', 'otp slot', 'trim|required');
        $this->form_validation->set_rules('tgl_pengecekan', 'tgl pengecekan', 'trim|required');

        $this->form_validation->set_rules('id_odp', 'id_odp', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "data_odp.xls";
        $judul = "data_odp";
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
        // xlsWriteLabel($tablehead, $kolomhead++, "Ket Pelanggan");
        // xlsWriteLabel($tablehead, $kolomhead++, "Lokasi Pelanggan");
        // xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelanggan");
        xlsWriteLabel($tablehead, $kolomhead++, "ID ODP");
        xlsWriteLabel($tablehead, $kolomhead++, "Keterangan Pelangggan");
        xlsWriteLabel($tablehead, $kolomhead++, "Lokasi Pelangggan");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelangggan");

        foreach ($this->Data_odp_model->print_odp() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->id_odp);
            xlsWriteLabel($tablebody, $kolombody++, cek_status_ket($data->ket_pelanggan));
            xlsWriteLabel($tablebody, $kolombody++, $data->lokasi_pelanggan);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelanggan);
            // xlsWriteNumber($tablebody, $kolombody++, $data->odp_name);
            // xlsWriteLabel($tablebody, $kolombody++, $data->otp_slot);
            // xlsWriteLabel($tablebody, $kolombody++, $data->tgl_pengecekan);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=data_odp.doc");

        $data = array(
            'data_odp_data' => $this->Data_odp_model->print_odp(),
            'start' => 0
        );

        $this->load->view('data_odp/data_odp_doc', $data);
    }

    public function printdoc()
    {
        $data = array(
            'data_odp_data' => $this->Data_odp_model->print_odp(),
            'start' => 0
        );
        $this->load->view('data_odp/data_odp_print', $data);
    }
}

/* End of file Data_odp.php */
/* Location: ./application/controllers/Data_odp.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-07-05 08:19:44 */
/* http://harviacode.com */