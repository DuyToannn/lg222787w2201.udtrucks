<?php
/**
 * @Entity @Table(name="eso_commerce_manufacturer")
 **/
class Manufacturer{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @name @Column(type="string")**/
    public $name;
	/** @alias @Column(type="string")**/
    public $alias;
	/** @image @Column(type="string", nullable=true)**/
    public $image;
	/** @icon @Column(type="string", nullable=true)**/
    public $icon;
	/** @banner @Column(type="text", nullable=true)**/
    public $banner;
	/** @content @Column(type="text", nullable=true)**/
    public $content;
	/** @title @Column(type="string", nullable=true)**/
    public $title;
	/** @description @Column(type="text", nullable=true)**/
    public $description;
	/** @view @Column(type="integer", nullable=true)**/
    public $view;
	/** @sort @Column(type="integer", nullable=true)**/
    public $sort;
	/** @featured @Column(type="integer", nullable=true)**/
    public $featured;
	/** @published @Column(type="integer", nullable=true)**/
    public $published;
}
?>