<?php
/**
* avaaz_mysql_db.php
*/

include_once('person.php');

/**
 * avaaz_mysql_db
 *
 * This class interacts with the mysql database. 
 *
 * 
 * @author  Imran Bukhsh <imranomar@gmail.com>
 *
 * @since 1.0

 */

class avaaz_mysql_db
{
    /**
    * used to validate $sort variable. contains list of all sortable field
    * @access private
    * @var string[] 
    */
    private $fields = array('first_name','last_name','country','city','address','email');
    /**
    * connection string to the database for use of pdo
    * @access private
    * @var string 
    */
    private $connection_string;
    /**
    * user name of database for use of pdo
    * @access private
    * @var string
    */
    private $user_name;
    /**
    * password of database for use of pdo
    * @access private
    * @var string
    */
    private $password;
    
    
    /**
    * avaaz_mysql_db($tmp_connection_string,$tmp_user_name,$tmp_password)
    *
    * This constructor initalizes the connection string, username and password variables
    *
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @param string $tmp_connection_string the connection string for use with pdo
    * @param string $tmp_user_name username to the database
    * @param string $tmp_password password to the database
    *
    */
    public function avaaz_mysql_db($tmp_connection_string,$tmp_user_name,$tmp_password)
    {
        $this->connection_string = $tmp_connection_string;
        $this->user_name = $tmp_user_name;
        $this->password = $tmp_password;
    }
    
    /**
    * add_person($person)
    *
    * Adds a person to the database. 
    * Throws an exception if a perosn with the same name or email exists 
    *
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @param person $person object of the person class
    *
    */
    public function add_person($person)
    {
       
        $first_name = '';
        $last_name = '';
        $country = '';
        $city = '';
        $address = '';
        $email = '';
        
        try
        {
            //check if a person with the same name already exists
            if($this->does_same_name_exist($person))
            {
                throw new Exception('Person with the same name already exists');
            }

            //check if a person with the same email already exists
            if($this->does_email_exist($person))
            {
                throw new Exception('Person with the same email already exists');
            }

            //prepare db and pdo statement
            $db = new PDO($this->connection_string,$this->user_name,$this->password);
            $stmt = $db->prepare("INSERT INTO persons (first_name, last_name, country, city, address, email ) VALUES (:first_name, :last_name, :country, :city, :address, :email )");
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':email', $email);

            // insert one row
            $first_name = $person->get_first_name();
            $last_name = $person->get_last_name();
            $country = $person->get_country();
            $city = $person->get_city();
            $address = $person->get_address();
            $email = $person->get_email();
            $stmt->execute();
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }

    }
    
    /**
    * edit_person($person)
    *
    * Edits a person's details in the database.
    * Throws an exception if a perosn with the same name or email exists 
    *
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @param person $person object of the person class
    *
    */
    public function edit_person($person)
    {
        $first_name = '';
        $last_name = '';
        $country = '';
        $city = '';
        $address = '';
        $email = '';
        
                
        //check if a person with the same name already exists
        try 
        {
            if($this->does_same_name_exist($person))
            {
                throw new Exception('Person with the same name already exists');
            }

            //check if a person with the same email already exists
            if($this->does_email_exist($person))
            {
                throw new Exception('Person with the same email already exists');
            }

            //db and pdo statements
            $db = new PDO($this->connection_string,$this->user_name,$this->password);
            $stmt = $db->prepare("update persons set first_name=:first_name, last_name=:last_name, country=:country, city=:city, address=:address, email=:email where id = :person_id");
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':person_id', $person_id);

            // insert one row
            $person_id = $person->get_id();
            $first_name = $person->get_first_name();
            $last_name = $person->get_last_name();
            $country = $person->get_country();
            $city = $person->get_city();
            $address = $person->get_address();
            $email = $person->get_email();

            $stmt->execute();
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }
  

    }
    
    /**
    * delete_person($person)
    *
    * Deletes a person from the database by his/her database id.
    *
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @param person $person object of the person class
    *
    */
    public function delete_person($person)
    {
        try 
        {
            //check if a person with the same first name and last name already exists
            $db = new PDO($this->connection_string,$this->user_name,$this->password);
            $id = $person->get_id();
            $statement = $db->prepare("delete from persons where id = :id");
            $statement->bindParam('id', $id);
            $statement->execute();
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }
            
    }
    
    /**
    * get_persons($limit = 10, $offset = 0,  $sort='first_name', $sort_type = 'asc')
    *
    * Get people from the database. Throws an exception if the row limit is too high or if 
    * the sort field specified is not listed and if the sort order type is incorect
    *
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @param integer $limit limit the number of records returned
    * @param integer $offset offset when fetching the records 
    * @param string $sort specifies the column to which to sort by
    * @param string $sort_type specifies the sort order 'asc' or 'desc'
    *
    * @return array $rows array of persons which their details
    */
    public function get_persons($limit = 10, $offset = 0,  $sort='first_name', $sort_type = 'asc')
    {
        //validate offet, limit, sort, sorttype , try catch should come here
        try
        {
            if($limit>100)
            {
                throw new Exception('Cannot return more than 100 records at a time');
            }
            if(!in_array($sort, $this->fields))
            {
                throw new Exception('Sort field is not in the database');
            }
            if($sort_type!='asc' && $sort_type!='desc')
            {
                throw new Exception('Incorrect sort type');
            }
            
            //prepare db and prepare statment to get people from the db
            
            $db = new PDO($this->connection_string,$this->user_name,$this->password);
            $statement = $db->prepare("select * from persons order by $sort $sort_type limit $offset,$limit ");
            $statement->execute();
            $rows = $statement->fetchAll();
            return $rows;
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    /**
    * does_same_name_exist($person)
    *
    * Check if see of a person with the same first name and last name already exists in the database
    *
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @param person $person object of the person class
    *
    * @return boolean $boolean true if person with the same first and last name already exists else false
    */
    public function does_same_name_exist($person)
    {
        
        try 
        {
            //check if a person with the same first name and last name already exists
            $db = new PDO($this->connection_string,$this->user_name,$this->password);
            $first_name = $person->get_first_name();
            $last_name = $person->get_last_name();

            if($person->get_id()==0 || $person->get_id()=='') //check if any person exists with the same name
            {

                $statement = $db->prepare("select id from persons where first_name =  :first_name and last_name =  :last_name");
            }
            else //check if any person besides the one who's is specified exists with the same name
            {

                $statement = $db->prepare("select id from persons where first_name =  :first_name and last_name =  :last_name and id!=:id");
                $id =  $person->get_id();
                $statement->bindParam('id', $id);
            }

            $statement->bindParam('first_name', $first_name);
            $statement->bindParam('last_name', $last_name);


            $statement->execute();
            $rows = $statement->fetchAll();

            if(sizeof($rows)>=1)
            {
                return true;
            }
            else 
            {
                return false;
            }
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());echo $e->getMessage();
        }
    }
    
    
    /**
    * does_email_exist($person)
    *
    * Check if see of a person with the same email already exists in database
    *
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @param person $person object of the person class
    *
    * @return boolean $boolean true if person with the same email already exists in database
    */
    public function does_email_exist($person )
    {
        //check if a person with the same first name and last name already exists
        try 
        {
            $db = new PDO($this->connection_string,$this->user_name,$this->password);

            if($person->get_id()==0 || $person->get_id()=='')    //check if any person exists with the same name
            {
                $statement = $db->prepare("select id from persons where email =  :person_email");
            }
            else  //check if any person besides the one who's is specified exists with the same name
            {
                $statement = $db->prepare("select id from persons where email =  :person_email and id!=:id");
                $id =  $person->get_id();
                $statement->bindParam('id', $id);
            }

            $email = $person->get_email();
            $statement->bindParam('person_email',$email);
            $statement->execute();
            $rows = $statement->fetchAll();

            if(sizeof($rows)>=1)
            {
                return true;
            }
            else 
            {
                return false;
            }
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }
    
    /**
    * get_person($id)
    *
    * Get details of a person based on his database id
    *
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @param integer $id id of the person in the database
    *
    * @return array $row array of the details of the person
    */
    public function get_person($id)
    {
        //variable validation happens here
        settype($id,'integer');
        
        try
        {
            $db = new PDO($this->connection_string,$this->user_name,$this->password);
            $statement = $db->prepare("select * from persons where id= :id");
            $statement->bindParam('id', $id);

            $statement->execute();
            $row = $statement->fetchAll();

            if(sizeof($row)>=1)
            {
                return $row;
            }
            else
            {
                throw new Exception('Person with the id not found');
            }
        }
        catch(Exception $e)
        {
            throw new Exception("get_person: ".$e->getMessage());
        }
        
    
    }
    
}


?>
