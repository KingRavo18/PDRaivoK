<?php
class Database {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    public function connect() {
        try {
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            echo "Error connecting to the database: " . $e->getMessage();
        }
    }

    public function insertData($name, $email, $message) {
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }

    public function fetchAllDataSortedByName() {
        $result = $this->conn->query("SELECT * FROM users ORDER BY name");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['message'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No messages found</td></tr>";
        }
    }
    

    public function closeConnection() {
        $this->conn->close();
    }
}
?>
