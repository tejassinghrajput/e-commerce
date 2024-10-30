<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'feedback_id';

    public function getallfeedback() {
        $query = "SELECT * FROM feedback";
        return $this->db->query($query)->getResultArray();
    }
    public function getallaverageratings(){
        $query = "SELECT order_id, AVG(star) as avg_star FROM feedback GROUP BY order_id";
        return $this->db->query($query)->getResultArray();
    }

    public function getFeedbackByOrderId($orderId) {
        $query = "SELECT * FROM feedback WHERE order_id = ? ORDER BY created_at DESC";
        return $this->db->query($query, [$orderId])->getResultArray();
    }

    public function getFeedbackById($feedbackId) {
        $query = "SELECT * FROM feedback WHERE feedback_id = ?";
        return $this->db->query($query, [$feedbackId])->getRowArray();
    }

    public function insertFeedback($userId, $feedbackText, $star, $orderId, $username) {
        $query = "INSERT INTO feedback (user_id, feedback_text, star, order_id, user_name) VALUES (?, ?, ?, ?, ?)";
        return $this->db->query($query, [$userId, $feedbackText, $star, $orderId, $username]);
    }

    public function updateFeedback($feedbackId, $feedbackText, $star) {
        $query = "UPDATE feedback SET feedback_text = ?, star = ? WHERE feedback_id = ?";
        return $this->db->query($query, [$feedbackText, $star, $feedbackId]);
    }

    public function deleteFeedback($feedbackId) {
        $query = "DELETE FROM feedback WHERE feedback_id = ?";
        return $this->db->query($query, [$feedbackId]);
    }
    
    public function getFeedbackByOrderIdAndUserId($orderId, $userId) {
        $query = "SELECT * FROM feedback WHERE order_id = ? AND user_id = ?";
        return $this->db->query($query, [$orderId, $userId])->getRowArray();
    }
    
}
