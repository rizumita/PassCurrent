<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rizumita
 * Date: 2012/10/30
 * Time: 9:36
 * To change this template use File | Settings | File Templates.
 */

/**
 * @group Field
 * @group Model
 */
class Field_Test extends \Fuel\Core\TestCase
{

    public function test_string2type()
    {
        $this->assertEquals(Model_Field::PrimaryField, Model_Field::string2type('primary'));
        $this->assertEquals(Model_Field::SecondaryField, Model_Field::string2type('secondary'));
        $this->assertEquals(Model_Field::AuxiliaryField, Model_Field::string2type('auxiliary'));
        $this->assertEquals(Model_Field::BackField, Model_Field::string2type('back'));
    }

    public function test_type2string()
    {
        $this->assertEquals('primary', Model_Field::type2string(Model_Field::PrimaryField));
        $this->assertEquals('secondary', Model_Field::type2string(Model_Field::SecondaryField));
        $this->assertEquals('auxiliary', Model_Field::type2string(Model_Field::AuxiliaryField));
        $this->assertEquals('back', Model_Field::type2string(Model_Field::BackField));
    }

    public function test_set_others()
    {
        $field = Model_Field::forge(array('key' => 'testkey', 'label' => 'testlabel', 'value' => 'testvalue'));
        $field->set_others('foo:bar hoge:fuga');
        $this->assertEquals($field->others, 'a:2:{i:0;a:1:{s:3:"foo";s:3:"bar";}i:1;a:1:{s:4:"hoge";s:4:"fuga";}}');
    }

    public function test_others_readable()
    {
        $field = Model_Field::forge(array('key' => 'testkey', 'label' => 'testlabel', 'value' => 'testvalue'));
        $field->set_others('foo:bar hoge:fuga');
        $this->assertEquals($field->others_readable(), 'foo:bar hoge:fuga');

        $field->set_others('');
        $this->assertEquals($field->others_readable(), '');
    }
}