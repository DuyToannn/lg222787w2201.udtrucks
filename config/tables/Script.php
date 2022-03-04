<?php
/**
 * @Entity @Table(name="eso_website_script")
 **/
class Script{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @name @Column(type="string")**/
    public $name;
	/** @content @Column(type="text", nullable=true)**/
    public $content;
	/** @position @Column(type="string")**/
    public $position;
}
?>