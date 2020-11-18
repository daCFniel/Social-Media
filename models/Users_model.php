<?php 
class Users_model extends MY_Model {
    // Returns TRUE if a user with the specified username and password,
    // exists in the database and FALSE if not.
    // Note: passwords in the database are SHA1 hashed. 
    // Need to hash the supplied password before searching the database.
    public function checkLogin($username,$password) {
        // Hash supplied password.
        $hashedPassword = sha1($password);
        $this->db->where('username', $username);
        $this->db->where('password', $hashedPassword);
        // Equivalent to SELECT * FROM users WHERE username = '$username' 
        // AND password = '$password'.
        $query = $this->db->get('Users');

        // Iif number of rows in result of query is > 0, 
        // username and password are correct.
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Inserts a row into the Following table,
    // indicating that $follower follows $followed.
    public function follow($follower, $followed) {  
        $sql = 'INSERT INTO User_Follows (follower_username, followed_username) VALUES (?, ?)';
        $query = $this->db->query($sql, array($follower, $followed));
    }

    // Returns TRUE if $follower is following the $followed, 
    // FALSE otherwise.
    public function isFollowing($follower, $followed) {
        $sql = 'SELECT * FROM User_Follows WHERE follower_username=? && followed_username=?';
        $query = $this->db->query($sql, array($follower, $followed));
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Return TRUE if user exists in database.
    // Return FALSE otherwise.
    public function checkForUser($username) {
        $sql = 'SELECT * FROM Users WHERE username=?';
        $query = $this->db->query($sql, array($username));
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
