<?php


class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "noban";
    private $con;

    public function __construct()
    {
        $this->con = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if ($this->con->connect_error) {
            die("Failed to connect to MySQL: " . $this->con->connect_error);
        }
    }



    public function checkProductExists($mobile_number, $product_id) {
        $stmt = $this->con->prepare("SELECT * FROM cart WHERE mobile_number = ? AND product_id = ?");
        $stmt->bind_param("ss", $mobile_number, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        
        return $result->num_rows > 0;
    }

     public function createData($mobile_number,$product_id){


        $insert=$this->con->prepare(
            "INSERT INTO cart (mobile_number,product_id) VALUE(
                ?,?)");


                $insert->bind_param("ss",$mobile_number,$product_id);
                $insert->execute();
                $insert->close();
        
     }





public function displayData()
{
    // $redis = new Redis();
    // $redis->connect('127.0.0.1', 6379);

    // if ($redis->ping()) {
    //     echo "Connected to Redis server.\n";

    // }
    // $cachedData = $redis->get('cached_data');
    // if ($cachedData !== false) {
    //     // اگر داده‌ها در حافظه کش موجود باشند، آن‌ها را برگردانید
    //     return json_decode($cachedData, true);

       
    // }
    $query = "SELECT * FROM products";
    $result = $this->con->query($query);


    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        //         // ذخیره داده‌ها در حافظه کش
        //         $redis->set('cached_data', json_encode($data));
        //         $redis->expire('cached_data', 3600); // تنظیم زمان انقضاء کش (اینجا یک ساعت اس
        return $data;
    } else {
        return array();
    }
}


}