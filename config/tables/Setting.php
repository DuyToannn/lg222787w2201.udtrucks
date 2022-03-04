<?php
/**
 * @Entity @Table(name="eso_website_setting")
 **/
class Setting{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @type @Column(type="string")**/
    public $type;
	/** @position @Column(type="string")**/
    public $position;
	/** @value @Column(type="text", nullable=true)**/
    public $value;
}
?>