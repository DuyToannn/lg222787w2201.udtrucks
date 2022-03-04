<?php
/**
 * @Entity @Table(name="eso_website_banner")
 **/
class Banner{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @name @Column(type="string")**/
    public $name;
	/** @image @Column(type="string", nullable=true)**/
    public $image;
	/** @description @Column(type="text", nullable=true)**/
    public $description;
	/** @link @Column(type="string", nullable=true)**/
    public $link;
	/** @button @Column(type="string", nullable=true)**/
    public $button;
	/** @position @Column(type="string")**/
    public $position;
	/** @sort @Column(type="integer", nullable=true)**/
    public $sort;
	/** @published @Column(type="integer", nullable=true)**/
    public $published;
}
?>