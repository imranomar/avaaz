<?php
/**
* person.php
*/

/**
 * person
 *
 * This class represents a person. 
 *
 *
 * @todo is_only_letters_and_spaces() funciton can be moved to seprate helper class
 * @todo is_valid_email() funciton can be moved to seprate helper class
 * 
 * @author  Imran Bukhsh <imranomar@gmail.com>
 *
 * @since 1.0

 */

class person
{
    /**
    * used to store the id ( mysql id coulumn ) of the person
    * @access private
    * @var integer 
    */
    private $id;
    /**
    * used to store the first name ( first_name coulumn ) of the person
    * @access private
    * @var string 
    */
    private $first_name;
    /**
    * used to store the last name ( last_name column ) of the person
    * @access private
    * @var string 
    */
    private $last_name;
    /**
    * used to store the country( country columns ) of the person
    * @access private
    * @var string 
    */
    private $country;
    /**
    * used to store the city( city column ) of the person
    * @access private
    * @var string 
    */
    private $city;
    /**
    * used to store the address ( address column ) of the person
    * @access private
    * @var string 
    */
    private $address;
    /**
    * used to store the address ( city column ) of the person
    * @access private
    * @var string 
    */
    private $email;
    /**
    * used to store the email ( email column ) of the person
    * @access private
    * @var string 
    */
    
    /**
    * set_id($tmp_id)
    *
    * This function sets the id of the person
    * Throws an exception if the passed value is '' or 0
    *
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @param int $tmp_id the unique id based on the id column of the mysql table of the person
    *
    */
    public function set_id($tmp_id)
    {
                //data type checking and validation happens here
     
        settype($tmp_id, "integer");
        
        if((!isset($tmp_id)) || $tmp_id==0)
        {
            throw new Exception('Incorrect person id');
        }
        
        $this->id = $tmp_id;
    }
    
    /**
    * get_id()
    *
    * This function returns the id of the person
    *
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @return int $this->id The id of the person 
    *
    */
    public function get_id()
    {
        return $this->id;
    }
    
    /**
    * set_first_name($tmp_first_name)
    *
    * This function sets the first name of the person.
    * Throws an exception if the passed variable is not set or is '' or 
    * if it contains anything else besides letters and spaces
    * 
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @param string $tmp_first_name the first name of the person
    *
    */
    public function set_first_name($tmp_first_name)
    {
        //data type checking and validation happens here
        settype($tmp_first_name, "string");
        

        if((!isset($tmp_first_name)) || $tmp_first_name=='')
        {
            throw new Exception('First name cannot be empty');
        }
        
        $tmp_first_name = strip_tags($tmp_first_name);

        if(!$this->is_only_letters_and_spaces($tmp_first_name))
        {
            throw new Exception('Only letters and spaces allowed in first name');
        }
        
        
        $this->first_name = $tmp_first_name;
    }
    
    /**
    * set_first_name($tmp_last_name)
    *
    * This function sets the last name of the person.
    * Throws an exception if the passed variable is not set or is '' or 
    * if it contains anything else besides letters and spaces
    * 
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @param string $tmp_last_name the last name of the person
    *
    */
    public function set_last_name($tmp_last_name)
    {
        //data type checking and validation happens here        
        settype($tmp_last_name, "string");
        
        if(!isset($tmp_last_name) || $tmp_last_name=='')
        {
            throw new Exception('Last name cannot be empty');
        }
        
        $tmp_last_name = strip_tags($tmp_last_name);
        
        if(!$this->is_only_letters_and_spaces($tmp_last_name))
        {
            throw new Exception('Only letters and spaces allowed in last name');
        }
        
        $this->last_name = $tmp_last_name;
    }
    
    /**
    * set_country($tmp_country)
    *
    * This function sets the country of the person.
    * Throws an exception if the passed variable is not set or is '' or 
    * if it contains anything else besides letters and spaces
    * 
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @param string $tmp_country the country of the person
    *
    */
    public function set_country($tmp_country)
    {
        //data type checking and validation happens here
        settype($tmp_country, "string");
        
        if(!isset($tmp_country) || $tmp_country=='')
        {
            throw new Exception('Country cannot be empty');
        }
        
        $tmp_country = strip_tags($tmp_country);
        
        if(!$this->is_only_letters_and_spaces($tmp_country))
        {
            throw new Exception('Only letters and spaces allowed in country');
        }
        
        $this->country = $tmp_country;
    }
    
    /**
    * set_city($tmp_city)
    *
    * This function sets the city of the person.
    * Throws an exception if the passed variable is not set or is '' or 
    * if it contains anything else besides letters and spaces
    * 
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @param string $tmp_city the city of the person
    *
    */
    public function set_city($tmp_city)
    {
        //data type checking and validation happens here
        settype($tmp_city, "string");
        
        if(!isset($tmp_city) || $tmp_city=='')
        {
            throw new Exception('City cannot be empty');
        }
        
        $tmp_city = strip_tags($tmp_city);
        
        if(!$this->is_only_letters_and_spaces($tmp_city))
        {
            throw new Exception('Only letters and spaces allowed in city');
        }
        
        $this->city = $tmp_city;
    }
    
    
    /**
    * set_address($tmp_address)
    *
    * This function sets the address of the person.
    * Throws an exception if the passed variable is not set or is '' or 
    * if it contains anything else besides letters and spaces
    * 
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @param string $tmp_address the address of the person
    *
    */
    public function set_address($tmp_address)
    {
        //data type checking and validation happens here
        settype($tmp_address, "string");
        
        if(!isset($tmp_address) || $tmp_address=='')
        {
            throw new Exception('Address cannot be empty');
        }
        
        $tmp_address = strip_tags($tmp_address);
        
        $this->address = $tmp_address;
    }
    
    /**
    * set_email($tmp_email)
    *
    * This function sets the email of the person.
    * Throws an exception if the passed variable is not set or is '' or 
    * if it is not a correct email
    * 
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @param string $tmp_email the email of the person
    *
    */
    public function set_email($tmp_email)
    {
        //data type checking and validation happens here
        settype($tmp_email, "string");
        
        if(!isset($tmp_email) || $tmp_email=='')
        {
            throw new Exception('Email cannot be empty');
        }
        
        $tmp_email = strip_tags($tmp_email);
        
        //check if first name contains only letters 
        if(!$this->is_valid_email($tmp_email))
        {
            throw new Exception('Invalid email address');
        }
        $this->email = $tmp_email;
    }
    
    /**
    * get_first_name()
    *
    * This function returns the first name of the person
    *
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @return string $this->first_name The first name of the person 
    *
    */
    public function get_first_name()
    {
        return $this->first_name;
    }
    
    /**
    * get_last_name()
    *
    * This function returns the last name of the person
    *
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @return string $this->last_name The last name of the person 
    *
    */
    public function get_last_name()
    {
        return $this->last_name;
    }
    
    /**
    * get_country()
    *
    * This function returns the country of the person
    *
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @return string $this->country The country of the person 
    *
    */
    public function get_country()
    {
        return $this->country;
    }
    
    /**
    * get_city()
    *
    * This function returns the city of the person
    *
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @return string $this->city The city of the person 
    *
    */
    public function get_city()
    {
        return $this->city;
    }

    /**
    * get_address()
    *
    * This function returns the address of the person
    *
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @return string $this->address The address of the person 
    *
    */
    public function get_address()
    {
        return $this->address;
    }
    
    /**
    * get_email()
    *
    * This function returns the email of the person
    *
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    *
    * @return string $this->email The email of the person 
    *
    */
    public function get_email()
    {
        return $this->email;
    }
    
    /**
    * is_only_letters_and_spaces($string)
    *
    * This function check if the passed string contains only letter and spaces
    *
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    * 
    * @param string to be tested for if it contains spaces and letters
    *
    * @return boolean $boolean true if the passed string contains only letter and spaces else false
    *
    */
    public function is_only_letters_and_spaces($string)
    {
        if(preg_match('~^[a-zA-Z ]*$~', $string))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
    * is_valid_email($email)
    *
    * This function checks if the passed string is a valid email address.
    *
    * @author  Imran Omar Bukhsh <imranomar@gmail.com>
    *
    * @since 1.0
    * 
    * @param string $email string to be tested for email address
    * 
    * @return boolean $boolean true if the passed string is a valid email address else false
    *
    */
    public function is_valid_email($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
}


?>
