<?php
/**
* getperson.php
*/

/**
 * person
 *
 * This scripts returns the details of person based on the id of the person in the based. Data is echo'ed in json
 *
 * 
 * @author  Imran Bukhsh <imranomar@gmail.com>
 *
 * @since 1.0
 * 
 * @param  int $_POST['id'] the unique encypted id based on the id column of the mysql table of the person
 * 
 * @return json array details of the person
 */

include '../classes/person.php';
include '../classes/avaaz_mysql_db.php';
include '../classes/encryption.php';
include '../config.php';

try
{
    if(isset($_POST['id']))
    {
        $id = $_POST['id'];

        //clean variable 
        settype($id, 'string');
        $id = strip_tags($id);
        
        //decode
        $encryption = new encryption();
        $id = $encryption->decode($id);
               
        //clean again
        settype($id, 'integer');
        
        //get the person details and output as json
        $db = new avaaz_mysql_db($config['db_connection_string'],$config['db_user_name'],$config['db_password']);
        $row = $db->get_person($id);

        //clean data returned from db
        $arr_peron_details = $row[0];
        foreach ($arr_peron_details as $key => $value)
        {
            $arr_peron_details[$key] = htmlentities($value);
        }

        echo json_encode(array($arr_peron_details));
    }
    
}
catch (Exception $e)
{
    echo $e->getMessage();
}

?>
