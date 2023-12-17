<?php
class UList
{
    public $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function fetch_objects($query)
    {
        $res = mysqli_query($this->conn, $query);
        $ret = [];
        while ($dt = mysqli_fetch_object($res)) {
            $ret[] = $dt;
        }
        return $ret;
    }
    public function get_user_by_id($id)
    {
        $res = mysqli_query($this->conn, "SELECT * FROM users WHERE id = $id");
        $ret = mysqli_fetch_object($res);
        return $ret;
    }
    public function edit_user_by_id($data, $id)
    {
        $qry = "UPDATE users SET ";
        foreach ($data as $key => $value) {
            $qry .= "$key='$value',";
        }
        $qry = rtrim($qry, ",");
        $qry .= "WHERE id=$id";
        mysqli_query($this->conn, $qry);
    }
    public function delete_user_by_id($id)
    {
        $qry = "DELETE FROM users WHERE id = $id";
        mysqli_query($this->conn, $qry);
    }
    function getUserIP()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    public function set_active($id)
    {
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $ip = $this->getUserIP();
        $qry = "UPDATE users SET is_active = 1, user_agent = '$agent', ip = '$ip' WHERE id = " . $id;
        mysqli_query($this->conn, $qry);
    }
    public function delete_active($id)
    {
        $qry = "UPDATE users SET is_active = 0, user_agent = '', ip = '' WHERE id = " . $id;
        mysqli_query($this->conn, $qry);
    }
}
