<?php 
class Messages_model extends MY_Model {
    // Returns all messages posted by the user with the specified username.
    // Most recent first.
    public function getMessagesByPoster($name) {
        $sql = 'SELECT user_username, text, posted_at FROM Messages WHERE user_username = ? ORDER BY posted_at DESC';
        $query = $this->db->query($sql, array($name));
        return $query->result_array();
    }

    // Return all messages from all posters.
    // Most recent first.
    public function getAllMessages() {
        $sql = 'SELECT user_username, text, posted_at FROM Messages ORDER BY posted_at DESC';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    // Returns all messages containing the specified search string.
    // Most recent first.
    public function searchMessages($searchString) {
        $sql = "SELECT user_username, text, posted_at FROM Messages WHERE text LIKE '%" . 
        $this->db->escape_like_str($searchString)."%' ESCAPE '!'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    // Adds the supplied message to the messages table in the database.
    public function insertMessage($poster, $message) {  
        $sql = 'INSERT INTO Messages (user_username, text, posted_at) VALUES (?, ?, NOW())';
        $query = $this->db->query($sql, array($poster, $message));
    }

    // Returns all of the messages from all of those followed by the specified user.
    // Most recent first.
    public function getFollowedMessages($name) {
        $sql = 'SELECT m.user_username, m.text, m.posted_at FROM User_Follows f, Messages m WHERE f.follower_username=? && f.followed_username=m.user_username ORDER BY posted_at DESC';
        $query = $this->db->query($sql, array($name));
        return $query->result_array();      
    }
}
