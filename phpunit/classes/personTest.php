<?php

require_once dirname(__FILE__) . '/../../classes/person.php';

/**
 * Test class for person.
 * Generated by PHPUnit on 2012-09-09 at 13:13:55.
 */
class personTest extends PHPUnit_Framework_TestCase {

    /**
     * @var person
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new person;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers person::set_id
     * @todo Implement testSet_id().
     */
    public function testSet_id() 
    {
        try
        {
            $this->object->set_id('');
        }
        catch (Exception $e)
        {
            if($e->getMessage() == "Incorrect person id")
            {
                $this->assertTrue(true);
            }
            else
            {
                $this->assertTrue(false);
            }
        }
    }

    /**
     * @covers person::set_first_name
     * @todo Implement testSet_first_name().
     */
    public function testSet_first_name() {
        $this->object->set_first_name('enva');
        if($this->object->get_first_name()=='enva')
        {
            $this->assertTrue(true);
        }
        else
        {
            $this->assertTrue(false);
        }
        
        try
        {
            $this->object->set_first_name('e 5nva');
        }
        catch (Exception $e)
        {
            if($e->getMessage() == "Only letters and spaces allowed in first name")
            {
                $this->assertTrue(true);
            }
            else
            {
                $this->assertTrue(false);
            }
        }
    }

    /**
     * @covers person::set_address
     * @todo Implement testSet_address().
     */
    public function testSet_address() {
        $this->object->set_address('closer to the sun');
        if($this->object->get_address()=='closer to the sun')
        {
            $this->assertTrue(true);
        }
        else
        {
            $this->assertTrue(false);
        }
    }

    /**
     * @covers person::set_email
     * @todo Implement testSet_email().
     */
    public function testSet_email() {
             
        $this->object->set_email('test123@gmail.com');
        if($this->object->get_email()=='test123@gmail.com')
        {
            $this->assertTrue(true);
        }
        else
        {
            $this->assertTrue(false);
        }
    }

    /**
     * @covers person::get_last_name
     * @todo Implement testGet_last_name().
     */
    public function testGet_last_name() {
        
        $this->object->set_last_name('bukhsh');
        if($this->object->get_last_name()=='bukhsh')
        {
            $this->assertTrue(true);
        }
        else
        {
            $this->assertTrue(false);
        }
    }

    /**
     * @covers person::get_address
     * @todo Implement testGet_address().
     */
    public function testGet_address() {
        $this->object->set_address('sharjah univercity city road');
        if($this->object->get_address()=='sharjah univercity city road')
        {
            $this->assertTrue(true);
        }
        else
        {
            $this->assertTrue(false);
        }
    }

    /**
     * @covers person::get_email
     * @todo Implement testGet_email().
     */
    public function testGet_email() {
        $this->object->set_email('test@gmail.com');
        if($this->object->get_email()=='test@gmail.com')
        {
            $this->assertTrue(true);
        }
        else
        {
            $this->assertTrue(false);
        }
    }

    /**
     * @covers person::is_only_letters_and_spaces
     * @todo Implement testIs_only_letters_and_spaces().
     */
    public function testIs_only_letters_and_spaces() {
        $this->assertTrue($this->object->is_only_letters_and_spaces('das sdgs d '));
        $this->assertTrue($this->object->is_only_letters_and_spaces('dasCZgs d '));
        $this->assertTrue($this->object->is_only_letters_and_spaces('imran'));
        $this->assertTrue($this->object->is_only_letters_and_spaces(' ')); //problem here
        
        $this->assertFalse($this->object->is_only_letters_and_spaces('3'));
        $this->assertFalse($this->object->is_only_letters_and_spaces('qw< script df'));
        $this->assertFalse($this->object->is_only_letters_and_spaces('qw<d3sdf'));
        $this->assertFalse($this->object->is_only_letters_and_spaces('v^xc'));
        $this->assertFalse($this->object->is_only_letters_and_spaces('c"asd(sas')); //problem here
        
    }

    /**
     * @covers person::is_valid_email
     * @todo Implement testIs_valid_email().
     */
    public function testIs_valid_email() {
        $this->assertTrue($this->object->is_valid_email('imranomar@gmail.com'));
        $this->assertTrue($this->object->is_valid_email('i@gma.com'));
        $this->assertTrue($this->object->is_valid_email('imr@gmail.co'));
        $this->assertTrue($this->object->is_valid_email('imranomar@gmail.com'));
        
        $this->assertFalse($this->object->is_valid_email('imranomar@.com'));
        $this->assertFalse($this->object->is_valid_email('imranomar@@.com'));
        $this->assertFalse($this->object->is_valid_email('_ar@.com'));
        $this->assertFalse($this->object->is_valid_email('imranomargmail.com'));
        $this->assertFalse($this->object->is_valid_email('imranomar@gmail'));
        $this->assertFalse($this->object->is_valid_email('imranomargmail.com'));
    }

}

?>
