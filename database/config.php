<?php
class Connection
{
    private $conn;

    public function __construct()
    {
        $this->create_connection();
    }

    public function create_connection()
    {

        $servename = "localhost";
        $username = "root";
        $password = "";
        $dbname = "laundry";


        // try {
        $this->conn = mysqli_connect($servename, $username, $password, $dbname);
        // } catch (\Throwable $th) {
        //     print_r($th);
        // }

        if (!$this->conn) {
            die("<script>alert ('connection failed')</script>");
        }
    }

    public function execute_query($sql)
    {
        return mysqli_query($this->conn, $sql);
    }

    public function get_num_rows($sql)
    {
        $result = $this->execute_query($sql);
        return mysqli_num_rows($result);
    }
}