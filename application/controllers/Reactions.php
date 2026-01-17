<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reactions extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Reaction_model');
    }

    // Submit reaction (AJAX)
    public function submit()
    {
        // Only allow POST
        if ($this->input->method() !== 'post') {
            show_404();
        }

        $article_id = $this->input->post('article_id');
        $type = $this->input->post('type');
        $ip_address = $this->input->ip_address();

        if (!$article_id || !$type) {
            echo json_encode(['success' => false, 'message' => 'Invalid data']);
            return;
        }

        // Add reaction
        if ($this->Reaction_model->add_reaction($article_id, $type, $ip_address)) {
            // Get updated counts
            $counts = $this->Reaction_model->get_counts($article_id);
            echo json_encode([
                'success' => true, 
                'counts' => $counts,
                'user_reaction' => $type
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add reaction']);
        }
    }
}
