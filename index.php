<?php
/**
* index.php
*/

/**
 *
 * the main script for the application. 
 *
 *
 * @todo the encode function could be moved out 
 * 
 * @author  Imran Bukhsh <imranomar@gmail.com>
 *
 * @since 1.0
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="stylesheet"  type="text/css" href="style.css" />
        <?php
        error_reporting(E_ALL);
        require_once('classes/avaaz_mysql_db.php');
        require_once('classes/encryption.php');
        require_once('config.php');
       
        //get which field we need to sort by
        if(isset( $_GET['sort']))
        {
            $sort = $_GET['sort'];
            settype($sort,'string');
        }

        //get the sort order
        if(isset( $_GET['sort_type']))
        {
            $sort_type = $_GET['sort_type'];
            settype($sort,'string');
        }
        else
        {
            $sort_type = 'asc';
        }
        
        //get list of people from the database
        try
        {
            $db = new avaaz_mysql_db($config['db_connection_string'],$config['db_user_name'],$config['db_password']);

            if(isset($sort) && isset($sort_type))
            {
                $arr_people = $db->get_persons(100,0,$sort,$sort_type);
            }
            else
            {
               $arr_people = $db->get_persons(100,0); 
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
        
        //used to encode the output ids of the 
        function encode($val)
        {
            $encryption = new encryption($config['salt_string']);
            return $encryption->encode($val);
        }
        
        ?>
        <script type="text/javascript" src="libraries/jquery-1.6.2.min.js"></script>
        <script  type="text/javascript"  src="scripts/script.js" ></script>
        
    </head>
    <body>
        <div class="footer"><a href="http://imranbukhsh.com">Imran Bukhsh</a> ( imranomar@gmail.com ) </div>
        <div style="width: 248px; height: 115px;background-image : url('http://avaaz.org/stat/new/images/blue/logo_en.png/1346180925')"> </div>
            
        <div id='div_form' class="form">
        <div class="close"><a id='close' href='#'>Close</a></div>
        <form id="frm_person" action="post">
            <table >
                <tr>
                    <td>First Name</td>
                    <td><input class='input_box' id='first_name' value='' type='text'/></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input class='input_box'  id='last_name' value='' type='text'/></td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td><input class='input_box'  id='country' value='' type='text'/></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td><input class='input_box'  id='city' value='' type='text'/></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><input class='input_box'  id='address' value='' type='text'/></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input class='input_box'  id='email' value='' type='text'/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input id='todo' value='' type='hidden' name="todo"/>
                        <input id='id' value='' type='hidden' name="id"/>
                        
                        <input id='submit' name="submit" value='Submit' type='button'/>
                    </td>
                </tr>
            </table>
        </form>
        </div>
        <table cellpadding="5" class="main_table">
            <tr>
                <th><a href="?sort=first_name&sort_type=<?php if($sort_type=='asc'){echo 'desc';}else{echo 'asc';}?>">First Name</a></th>
                <th><a href="?sort=last_name&sort_type=<?php if($sort_type=='asc'){echo 'desc';}else{echo 'asc';}?>">Last Name</a></th>
                <th><a href="?sort=country&sort_type=<?php if($sort_type=='asc'){echo 'desc';}else{echo 'asc';}?>">Country</th>
                <th><a href="?sort=city&sort_type=<?php if($sort_type=='asc'){echo 'desc';}else{echo 'asc';}?>">City</a></th>
                <th><a href="?sort=address&sort_type=<?php if($sort_type=='asc'){echo 'desc';}else{echo 'asc';}?>">Address</a></th>
                <th><a href="?sort=email&sort_type=<?php if($sort_type=='asc'){echo 'desc';}else{echo 'asc';}?>">Email</a></th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            foreach($arr_people as $person)
            {

            ?>
            <tr>
                <td><?php echo htmlentities($person['first_name']);?></td>
                <td><?php echo htmlentities($person['last_name']);?></td>
                <td><?php echo htmlentities($person['country']);?></td>
                <td><?php echo htmlentities($person['city']);?></td>
                <td><?php echo htmlentities($person['address']);?></td>
                <td><?php echo htmlentities($person['email']);?></td>
                <td><a href='#' onclick="edit('<?php echo htmlentities(encode($person['id'].$config['salt_string']));?>')">Edit</a></td>
                <td><a href='#' onclick="del('<?php echo htmlentities(encode($person['id'].$config['salt_string']));?>')">Delete</a></td>
            </tr>
            <?php
            }
            ?>
            </table>
            <input id='add' value='Add New' type='button'/>
    </body>
</html>