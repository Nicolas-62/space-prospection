<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_Submit extends CI_Controller {

    // -------------------------------------------------------------------------

    /**
    * Load entire language into variable
    *
    * @var Array
    */
    protected $language = array();

    // -------------------------------------------------------------------------

    /**
    * Class constructor
    */
    public function __construct()
    {
        parent::__construct();

        $this->lang->load('contact_lang', $this->config->item('language'));
        $this->language = $this->lang->language;
    }

    // -------------------------------------------------------------------------

    /**
    * Accepting parameters from contact_us form inside contact_view page
    */
    public function contact_us()
    {
        $this->form_validation->set_rules(
            'name',
            $this->language['contact_placeholder_name'],
            'trim|required|callback_alpha_space_only'
        );
        $this->form_validation->set_rules(
            'email',
            $this->language['contact_placeholder_email'],
            'trim|required|valid_email'
        );
        $this->form_validation->set_rules(
            'subject',
            $this->language['contact_placeholder_subject'],
            'trim|required'
        );
        $this->form_validation->set_rules(
            'message',
            $this->language['contact_placeholder_message'],
            'trim|required|max_length[160]'
        );

        if ($this->form_validation->run() == FALSE)
        {
            echo validation_errors();
        }
        else
        {
            $name       = $this->input->post('name', TRUE);
            $from_email = $this->input->post('email', TRUE);
            $subject    = $this->input->post('subject', TRUE);
            $message    = $this->input->post('message', TRUE);

            $this->email->from($from_email, $name);
            $this->email->to(EMAIL_ADMIN);
            $this->email->subject($subject);
            $this->email->message($message);

            if ($this->email->send())
            {
                echo 'YES';
            }
            else
            {
                echo 'NO';
            }
        }
    }

    // -------------------------------------------------------------------------

    /**
    * Custom validation function to accept alphabets and space
    *
    * @param String $string
    *
    * @return Bool
    */
    public function alpha_space_only($string)
    {
        if ( ! empty($string))
        {
            if (preg_match("/^[a-zA-Z ]+$/", $string))
            {
                return TRUE;
            }
            else
            {
                $this->form_validation->set_message(
                    'alpha_space_only',
                    $this->language['contact_message_callback_alpha_space_only']
                );
            }
        }
    }

    // -------------------------------------------------------------------------
}
