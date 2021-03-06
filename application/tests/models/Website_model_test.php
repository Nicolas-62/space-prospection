<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use phplibrary\Website as website;

class Website_Model_Test extends TestCase {

    // -------------------------------------------------------------------------

    /**
    * Testing class object data
    *
    * @var Website_model
    */
    private $class_object;

    // -------------------------------------------------------------------------

    /**
    * Website object data
    *
    * @var Website
    */
    private $website_object;

    // -------------------------------------------------------------------------

    /**
    * Website constructor data
    *
    * @var Array
    */
    private $website_data = array(
        'name'          => 'Space Prospection',
        'host'          => 'http://localhost/_develop/space-prospection/',
        'made'          => '2017',
        'language'      => 'english',
        'charset'       => 'utf-8',
        'description'   => 'Small website describing space exploration and search for extraterrestrial life',
        'keywords'      => 'space, exploration, life, et, alien',
    );

    // -------------------------------------------------------------------------

    /**
    * Website test setup method
    */
    public function setUp()
    {
        $this->website_object = new website(array(
            'name'        => $this->website_data['name'],
            'host'        => $this->website_data['host'],
            'made'        => $this->website_data['made'],
            'language'    => $this->website_data['language'],
            'charset'     => $this->website_data['charset'],
            'description' => $this->website_data['description'],
            'keywords'    => $this->website_data['keywords'],
        ));

        $this->class_object = $this->newModel('Website_model');
    }

    // -------------------------------------------------------------------------

    /**
    * Whether or not is possible to retrieve
    * properties from constructor
    */
    public function test_retrieving_website_properties()
    {
        $this->assertArrayHasKey('location', $this->website_object->server);
        $this->assertArrayHasKey('referer', $this->website_object->server);
        $this->assertArrayHasKey('host', $this->website_object->server);
        $this->assertArrayHasKey('uri', $this->website_object->server);
        $this->assertArrayHasKey('path', $this->website_object->server);
        $this->assertArrayHasKey('page', $this->website_object->server);

        $this->assertEquals($this->website_object->name, $this->website_data['name']);
        $this->assertEquals($this->website_object->host, $this->website_data['host']);
        $this->assertEquals($this->website_object->made, $this->website_data['made']);
        $this->assertEquals($this->website_object->language, $this->website_data['language']);
        $this->assertEquals($this->website_object->charset, $this->website_data['charset']);
        $this->assertEquals($this->website_object->description, $this->website_data['description']);
        $this->assertEquals($this->website_object->keywords, $this->website_data['keywords']);

        $this->assertInternalType('string', $this->website_object->name);
        $this->assertInternalType('string', $this->website_object->host);
        $this->assertInternalType('string', $this->website_object->made);
        $this->assertInternalType('string', $this->website_object->language);
        $this->assertInternalType('string', $this->website_object->charset);
        $this->assertInternalType('string', $this->website_object->description);
        $this->assertInternalType('string', $this->website_object->keywords);
        $this->assertInternalType('array', $this->website_object->server);

        $this->assertEmpty($this->website_object->errors);
    }

    // -------------------------------------------------------------------------

    /**
    * Testing website method
    */
    public function test_website_method()
    {
        $result = $this->class_object->website();

        $this->assertNotEmpty($result);
        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('signature', $result);
        $this->assertArrayHasKey('signature_hidden', $result);
        $this->assertArrayHasKey('head', $result);
        $this->assertArrayHasKey('logo', $result);
        $this->assertArrayHasKey('meta', $result);
    }

    // -------------------------------------------------------------------------

    /**
    * Testing navigation method
    */
    public function test_navigation_method()
    {
        $result = $this->class_object->navigation();

        $this->assertNotEmpty($result);
        $this->assertInternalType('array', $result);

        foreach ($result as $item)
        {
            $this->assertArrayHasKey('name', $item);
            $this->assertArrayHasKey('link', $item);
        }
    }

    // -------------------------------------------------------------------------

    /**
    * Testing social_links method
    */
    public function test_social_links_method()
    {
        $result = $this->class_object->social_links();

        $this->assertNotEmpty($result);
        $this->assertInternalType('array', $result);

        foreach ($result as $item)
        {
            $this->assertArrayHasKey('name', $item);
            $this->assertArrayHasKey('link', $item);
        }
    }

    // -------------------------------------------------------------------------

    /**
    * Testing projects method
    */
    public function test_projects_method()
    {
        $result = $this->class_object->projects();

        $this->assertNotEmpty($result);
        $this->assertInternalType('array', $result);

        foreach ($result as $item)
        {
            $this->assertArrayHasKey('title', $item);
            $this->assertArrayHasKey('description', $item);
            $this->assertArrayHasKey('image', $item);
        }
    }

    // -------------------------------------------------------------------------
}
