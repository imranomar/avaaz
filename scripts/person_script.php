<?php
/**
* person_.php
*/

/**
 * person
 *
 * This scripts is responsible for the add/mod/del of the person. Written to be called by ajax.
 * 
 * @author  Imran Bukhsh <imranomar@gmail.com>
 *
 * @since 1.0
 * 
 * @param  int $_POST['todo'] what needs to be done: 'add' or 'mod' or 'del'
 * @param  int $_POST['id'] the unique encypted id based on the id column of the mysql table of the person.
 * @param  int $_POST['first_name'] the first name of the person
 * @param  int $_POST['last_name'] the last name of the person
 * @param  int $_POST['country'] the country of the person
 * @param  int $_POST['city'] the city of the person
 * @param  int $_POST['address'] the address of the person
 * @param  int $_POST['email'] the email of the person
 */

include '../classes/person.php';
include '../classes/encryption.php';
include '../config.php';
include '../classes/avaaz_mysql_db.php';

try
{
   $id = 0;
   $first_name = '';
   $last_name = '';
   $country = '';
   $city = '';
   $address = '';
   $email= '';
    
   //checking for empty should be in the person class 
   if(isset($_POST['id']))
   {
       $id = $_POST['id'];
      //clean variable //clean further
      settype($id, 'string');

      //decode
      $encryption = new encryption();
      $id = $encryption->decode($id);

      //clean again
      settype($id, 'integer');
   }
   if(isset($_POST['first_name']))
   {
       $first_name = $_POST['first_name'];
   }
   if(isset($_POST['last_name']))
   {
       $last_name = $_POST['last_name'];
   }
   if(isset($_POST['country']))
   {
       $country = $_POST['country'];
   }
   if(isset($_POST['city']))
   {
       $city = $_POST['city'];
   }
   if(isset($_POST['address']))
   {
       $address = $_POST['address'];
   }
   if(isset($_POST['email']))
   {
       $email = $_POST['email'];
   }
   
   //check what are we going to do eg. add, mod or del
   if(isset($_POST['todo']))
   {
       $todo = $_POST['todo'];
   }
   else
   {
       echo "What has to be done has not been defined";
   }
   
   $db =  new avaaz_mysql_db($config['db_connection_string'],$config['db_user_name'],$config['db_password']);
   
   $person = new person();
   
   if($todo== 'add')
   {
        $person->set_first_name($first_name);
        $person->set_last_name($last_name);
        $person->set_country($country);
        $person->set_city($city);
        $person->set_address($address);
        $person->set_email($email);
        $db->add_person($person);
   }
   elseif($todo == 'mod')
   {
        $person->set_id($id);
        $person->set_first_name($first_name);
        $person->set_last_name($last_name);
        $person->set_country($country);
        $person->set_city($city);
        $person->set_address($address);
        $person->set_email($email);
        $db->edit_person($person);
   }
   elseif($todo == 'del')
   {
       $person->set_id($id);
       $db->delete_person($person);
   } 
   
   echo "done";
}
catch(Exception  $e)
{
    echo $e->getMessage();
}

?>
