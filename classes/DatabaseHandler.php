<?php
    class DatabaseHandler{
        
        public $driver;
        public $host;
        public $dbname;
        public $username;
        public $password;
        public $dsn;
        public $pdo;

        public function __construct($driver, $host, $dbname, $username, $password) {
            $this->driver = $driver;
            $this->host = $host;
            $this->dbname = $dbname;
            $this->username = $username;
            $this->password = $password;
            $this->dsn = "$this->driver:dbname=$this->dbname;host=$this->host;charset=utf8";
        }

        public function connect(){
            try {
                $this->pdo = new PDO($this->dsn, $this->username, $this->password);
            } catch (PDOException $exception) {
                echo 'Database Error: ' . $exception->getMessage();
            }
        }

        public function disconnect() {
            $this->pdo = null;
        }

        public function getDoctors(){
            $this->connect();
            $sql = "SELECT * FROM doctors;";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $doctors = $statement->fetchAll();
            $this->disconnect();
            return $doctors;
        }

        public function getAllPatients(){
            $this->connect();
            $sql = "SELECT * FROM patients;";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $p = $statement->fetchAll();
            $this->disconnect();
            return $p;
        }

        public function getPatients($query){
            if ($query != null){
                $sql = "SELECT * FROM patients WHERE medical_aid LIKE '%".$query."%'";
            }else{
                $sql = "SELECT * FROM patients";
            }
            $this->connect();
            $statement = $this->pdo->prepare($sql);
            $statement->execute();

            $patients = $statement->fetchAll(PDO::FETCH_ASSOC);
            $this->disconnect();
            return $patients;
        }

        public function getDoctorDeets($id){
            $this->connect();
            $sql = "SELECT * FROM doctors WHERE id = ".intval($id).";";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $doc = $statement->fetch(PDO::FETCH_ASSOC);
            $this->disconnect();

            $this->connect();            
            $sql = "SELECT * FROM appointments WHERE doc_id = ".$id.";";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $appointments = $statement->fetchAll(PDO::FETCH_ASSOC);
            $this->disconnect();
            
            $doc['appointments'] = $appointments;

            $this->connect();            
            $sql = "SELECT * FROM rooms WHERE doc_id = ".$id.";";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $rooms = $statement->fetchAll(PDO::FETCH_ASSOC);
            $this->disconnect();

            $doc['rooms'] = $rooms;
            
            return $doc;
        }
        public function getPatientDeets($id){
            $this->connect();
            $sql = "SELECT * FROM patients WHERE id = ".intval($id).";";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $patient = $statement->fetch(PDO::FETCH_ASSOC);
            $this->disconnect();
            return $patient;
        }
        public function getRoomDeets($id){
            $this->connect();
            $sql = "SELECT room_num, floor_num, doctor_id FROM rooms WHERE id = ".intval($id).";";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $room = $statement->fetch(PDO::FETCH_ASSOC);
            $this->disconnect();
            return $room;
        }

        public function getUsers(){
            $this->connect();
            $sql = "SELECT * FROM users;";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $users = $statement->fetchAll();
            $this->disconnect();
            return $users;
        }

        public function addPatient($name, $medicalAid, $phoneNo){
            $this->connect();
            $sql = "INSERT INTO patients (name, medical_aid, phone_no) VALUES (:name, :medicalAid, :phoneNo);";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':medicalAid', $medicalAid);
            $statement->bindValue(':phoneNo', $phoneNo);
            $statement->execute();
            $this->disconnect();
            return true;
        }

        public function getTime($id){
            $this->connect();
            $sql = "SELECT time FROM time_slots WHERE id = ".($id).";";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $time = $statement->fetch();
            $this->disconnect();
            return $time[0];
        }

        public function getTimes(){
            $this->connect();
            $sql = "SELECT * FROM time_slots;";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $times = $statement->fetchAll();
            $this->disconnect();
            return $times;
        }

        public function addAppointment($app){
            $this->connect();
            $sql = "INSERT INTO appointments (doc_id, patient_id, room_id, date, time_id) VALUES (:doc, :pat, :room, ':date', :time);";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(':doc', $app['doc_id']);
            $statement->bindValue(':pat', $app['patient_id']);
            $statement->bindValue(':room', $app['room_id']);
            $statement->bindValue(':date', $app['date']);
            $statement->bindValue(':time', $app['time_id']);
            $statement->execute();
            $this->disconnect();
            return true;
        }

        public function appointmentDetails($appointmentIndex){
            $appointment = array();
            $appointment['doctor'] = $this->getDoctorDeets($appointmentIndex['doc_id']);
            $appointment['patient'] = $this->getPatientDeets($appointmentIndex['patient_id']);
            $appointment['room'] = $this->getRoomDeets($appointmentIndex['room_id']);
            $appointment['time'] = array('time' => $this->getTime($appointmentIndex['time_id']), 'date' => $appointmentIndex['date']);
            return $appointment;
        }
        
        public function getAppointments(){
            $this->connect();
            $sql = "SELECT * FROM appointments";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $this->disconnect();
            $appointments = array();
            
            $i = 0;
            foreach($results as $record){
                array_push($appointments, $this->appointmentDetails($record));
            }
            return $appointments;
        }
    }
?>