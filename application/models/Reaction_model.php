<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reaction_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Add reaction
    public function add_reaction($article_id, $reaction_type, $ip_address)
    {
        // Check valid types
        $valid_types = ['smile', 'laugh', 'love', 'sad'];
        if (!in_array($reaction_type, $valid_types)) {
            return false;
        }

        // Check if already reacted to this article from this IP
        if ($this->has_reacted($article_id, $ip_address)) {
            // Update reaction (Switch reaction)
            $this->db->where('article_id', $article_id);
            $this->db->where('ip_address', $ip_address);
            return $this->db->update('article_reactions', [
                'reaction_type' => $reaction_type, 
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
        
        // Insert new reaction
        $data = [
            'article_id' => $article_id,
            'reaction_type' => $reaction_type,
            'ip_address' => $ip_address
        ];
        return $this->db->insert('article_reactions', $data);
    }

    // Check if reacted
    public function has_reacted($article_id, $ip_address)
    {
        $this->db->where('article_id', $article_id);
        $this->db->where('ip_address', $ip_address);
        return $this->db->count_all_results('article_reactions') > 0;
    }
    
    // Get user's current reaction type
    public function get_user_reaction($article_id, $ip_address)
    {
        $this->db->select('reaction_type');
        $this->db->where('article_id', $article_id);
        $this->db->where('ip_address', $ip_address);
        $result = $this->db->get('article_reactions')->row_array();
        return $result ? $result['reaction_type'] : null;
    }

    // Get reaction counts for an article
    public function get_counts($article_id)
    {
        $query = $this->db->query("
            SELECT reaction_type, COUNT(*) as count 
            FROM article_reactions 
            WHERE article_id = ? 
            GROUP BY reaction_type
        ", [$article_id]);
        
        $result = $query->result_array();
        
        // Format to key-value pair
        $counts = [
            'smile' => 0,
            'laugh' => 0,
            'love' => 0,
            'sad' => 0
        ];
        
        foreach ($result as $row) {
            $counts[$row['reaction_type']] = (int)$row['count'];
        }
        
        return $counts;
    }
}
