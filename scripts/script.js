
<!--
/**
* del(tmp_id)
*
* This function deleted a person from the db based on the id passed and then reloads the page. Makes an ajax request.
*
* @author  Imran Omar Bukhsh <imranomar@gmail.com>
*
* @since 1.0
* 
* @param integer tmp_id the encrypted if of the person
*
*/
-->
function del(tmp_id)
{
     var r=confirm("Are you sure you want to delete?");
     if (r==false)
     {
       return;
     }
     id = tmp_id;
     $("#id").val(id); //save id clicked to edit in a hidden field
     $("#todo").val('del') //set hidden field to know that we are modifying a record
     $.ajax({
        type: "POST",
        url: "scripts/person_script.php",
        data: { id: id , todo: $("#todo").val()},

        error: function(jq_xhr, text_status, error_thrown)
        {
               alert(error_thrown);
        },
        success: function(data)
        {

            if(data=='done')
            {    
                alert('Done');
                location.reload();
            }


        }
    });
}

<!--
/**
* add()
*
* Merely shows the form , clear the hidden id field and sets the hidden todo field to 'add' so jquery
* knows that we want to add a new record
*
* @author  Imran Omar Bukhsh <imranomar@gmail.com>
*
* @since 1.0
* 
* @param integer tmp_id the encrypted if of the person
*
*/
-->
function add()
{
    $('#frm_person').each(function()
    {
        this.reset();
    });
    $("#todo").val('add'); //let jquery know we are going to add
    $("#id").val(''); //unset hidden id field as not needed when adding
    $("#div_form").show();
    
}
<!--
/**
* edit(tmp_id)
*
* Shows the form , loads the details of the person and displays it, sets the hidden id field and sets the hidden todo field to 'od' so jquery
* knows that we want to add a new record
*
* @author  Imran Omar Bukhsh <imranomar@gmail.com>
*
* @since 1.0
* 
* @param integer tmp_id the encrypted if of the person
*
*/
-->
function edit(tmp_id)
{
     id = tmp_id;
     $("#id").val(id); //save id clicked to edit in a hidden field
     $("#todo").val('mod') //set hidden field to know that we are modifying a record
     $("#div_form").show();
     $.ajax({
        type: "POST",
        url: "scripts/get_person.php",
        data: { id: id},
        dataType: "json",
        error: function(jq_xhr, text_status, error_thrown)
        {
               alert(error_thrown);
        },
        success: function(data)
        {
            $("#first_name").val(data[0].first_name);
            $("#last_name").val(data[0].last_name);
            $("#country").val(data[0].country);
            $("#city").val(data[0].city);
            $("#address").val(data[0].address);
            $("#email").val(data[0].email);

        }
    });
}
<!--
/**
* submit()
*
* Submits the form data along with what needs to be done with it ( using the todo variable set to 'add','mod','del' )
*
* @author  Imran Omar Bukhsh <imranomar@gmail.com>
*
* @since 1.0
*
*/
-->
function submit()
{
        id = $("#id").val();
        first_name = $("#first_name").val();
        last_name = $("#last_name").val();
        country = $("#country").val();
        city = $("#city").val();
        address = $("#address").val();
        email = $("#email").val();
        todo = $("#todo").val(); //what needs to be done : add or mod or delete

        $.ajax({
        type: "POST",
        url: "scripts/person_script.php",
        data:  { id: id, first_name: first_name, last_name: last_name, country: country , city: city, address: address , email:email , todo:todo  },
        error: function(jq_xhr, text_status, error_thrown)
        {
               alert(error_thrown);
        },
        success: function(data)
        {

                if(data=='done')
                {
                    alert('done');
                    $("#id").val(''); //unset id in hidden field 
                    $("#todo").val('');  //unset what do to e.g. add/mod/del in hidden field
                    $("#first_name").val('');
                    $("#last_name").val('');
                    $("#country").val('');
                    $("#city").val('');
                    $("#address").val('');
                    $("#email").val('');
                    location.reload();
                }
                else
                {
                    alert(data);
                }
        }
    });
    return false;
}

$(document).ready(function() 
{
    //click for submit button
    $("#submit").click
    (
        function()
        {
                submit();
        }
    );

    //click for add button
    $("#add").click
    (
        function()
        {
                add();
        }
    );

    //click for close button on the popup form
    $("#close").click
    (
        function()
        {

            $("#div_form").hide();
            $("#id").val(''); //unset id in hidden field 
            $("#todo").val('');  //unset what do to e.g. add/mod/del in hidden field
        }
    );

    //do not show the forum when page loads
    $("#div_form").hide();

});