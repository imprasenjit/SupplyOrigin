<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message extends Aipl_admin
{
    function __construct()
    {
        parent::__construct();
        $this->isAdminloggedin();
        $this->load->model('message_model');
        $this->load->library('form_validation');
        $this->load->library('breadcrumbs');
    }

    public function index()
    {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'admin/message/index/';
        $config['total_rows'] = $this->message_model->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '.html';
        //$config['first_url'] = base_url() . 'message.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $message = $this->message_model->index_limit($config['per_page'], $start);

        $data = array(
            'message_data' => $message,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Message List', '/admin/message');
        $this->load->view('admin/requires/header',array('title'=>'Message'));
        $this->load->view('admin/message/message_list', $data);
        $this->load->view('admin/requires/footer');
    }

    public function search()
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');

        if ($this->uri->segment(2)=='search') {
            $config['base_url'] = base_url() . 'admin/message/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'admin/message/index/';
        }

        $config['total_rows'] = $this->message_model->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'admin/message/search/'.$keyword.'.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $message = $this->message_model->search_index_limit($config['per_page'], $start, $keyword);

        $data = array(
            'message_data' => $message,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('admin/requires/header',array('title'=>'message'));
        $this->load->view('admin/message/message_list', $data);
        $this->load->view('admin/requires/footer');
    }

    public function read($id){
        $row = $this->message_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'send_from' => $row->send_from,
		'send_to' => $row->send_to,
		'subject' => $row->subject,
		'message' => $row->message,
	    );
		$this->load->view('admin/requires/header',array('title'=>'message'));
        $this->load->view('admin/message/message_read', $data);
        $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/message'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/message/create_action'),
			'id' => set_value('id'),
			'send_from' => set_value('send_from'),
			'send_to' => set_value('send_to'),
			'subject' => set_value('subject'),
			'message' => set_value('message'),
		);
    $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
    $this->breadcrumbs->push('Message List', '/admin/message');
    $this->breadcrumbs->push('Compose Message', '/admin/message/create');
        $this->load->view('admin/requires/header',array('title'=>'message'));
        $this->load->view('admin/message/message_form', $data);
        $this->load->view('admin/requires/footer');
    }

    public function create_action()
    {
       /* $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'send_from' => $this->input->post('send_from',TRUE),
		'send_to' => $this->input->post('send_to',TRUE),
		'subject' => $this->input->post('subject',TRUE),
		'message' => $this->input->post('message',TRUE),
	    );

            $this->message_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('message'));
        }
		*/


		$this->load->helper("sendmail");
        $send_to = $this->input->post('send_to');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');
		$data = array(
			'send_to' => $send_to,
			'subject' => $subject,
			'message' => $message,
	    );

		$this->message_model->insert($data);
        $sub = $subject;
		$msgBody =  $message;
		//$msgFooter =  "Regards, \n Supply Origin \n Guwahati Assam";
        $status=sendmail($send_to, $sub, $msgBody);
		$this->session->set_flashdata('message', 'Email Sent');
        redirect(site_url('admin/message'));



    }

    public function update($id)
    {
        $row = $this->message_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/message/update_action'),
				'id' => set_value('id', $row->id),
				'send_from' => set_value('send_from', $row->send_from),
				'send_to' => set_value('send_to', $row->send_to),
				'subject' => set_value('subject', $row->subject),
				'message' => set_value('message', $row->message),
	    );

		$this->load->view('admin/requires/header',array('title'=>'message'));
        $this->load->view('admin/message/message_form', $data);
		$this->load->view('admin/requires/footer');
		} else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/message'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
			'send_from' => $this->input->post('send_from',TRUE),
			'send_to' => $this->input->post('send_to',TRUE),
			'subject' => $this->input->post('subject',TRUE),
			'message' => $this->input->post('message',TRUE),
			);

        $this->message_model->update($this->input->post('id', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(site_url('admin/message'));
        }
    }

    public function delete($id)
    {
        $row = $this->message_model->get_by_id($id);

        if ($row) {
            $this->message_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/message'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/message'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('send_from', ' ', 'trim');
	$this->form_validation->set_rules('send_to', ' ', 'trim');
	$this->form_validation->set_rules('subject', ' ', 'trim');
	$this->form_validation->set_rules('message', ' ', 'trim');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function get_dtrecords() {
        $columns = array(
            0 => "send_to",
            1 => "subject",
            2 => "message",
            3 => "id",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->message_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->message_model->all_rows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->message_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->message_model->tot_search_rows($search);
        }//End of if else
        $data = array();
        if (!empty($records)) {
            $slno=1;
            foreach ($records as $rows) {
                $id = $rows->id;
                $subject = $rows->subject;
                $send_to = $rows->send_to;
                $message = $rows->message;

                $viewBtn = anchor(site_url('admin/message/read/' . $id), 'View', array('class' => 'btn btn-sm btn-primary')) . "&nbsp;";
                $editBtn = anchor(site_url('admin/message/update/' . $id), 'Edit', array('class' => 'btn btn-sm btn-warning')) . "&nbsp;";
                $deleteBtn = anchor(site_url('admin/message/delete/' . $id), 'Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm(\'Are You Sure you want to delete?\')')) . "&nbsp;";
                $nestedData["slno"] = $slno++;
                $nestedData["send_to"] = $send_to;
                $nestedData["subject"] = $subject;
                $nestedData["message"] = $message;
                $nestedData["id"] = $viewBtn.$editBtn.$deleteBtn;
                $data[] = $nestedData;
            }//End of for
        }//End of if
        $json_data = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }//End of get_dtrecords()

};

/* End of file Message.php */
/* Location: ./application/controllers/Message.php */