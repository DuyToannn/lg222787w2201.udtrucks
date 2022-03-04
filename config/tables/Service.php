<?php
/**
 * @Entity @Table(name="eso_commerce_service")
 **/
class Service{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @id_category @Column(type="integer")**/
    public $id_category;
	/** @name @Column(type="string")**/
    public $name;
	/** @alias @Column(type="string", nullable=true)**/
    public $alias;
	/** @image @Column(type="string", nullable=true)**/
    public $image;
	/** @icon @Column(type="string", nullable=true)**/
    public $icon;
	/** @banner @Column(type="string", nullable=true)**/
    public $banner;
	/** @file @Column(type="string", nullable=true)**/
    public $file;
	/** @content @Column(type="text")**/
    public $content;
	/** @title @Column(type="string", nullable=true)**/
    public $title;
	/** @description @Column(type="string", nullable=true)**/
    public $description;
	/** @created @Column(type="integer")**/
    public $created;
	/** @updated @Column(type="integer", nullable=true)**/
    public $updated;
	/** @view @Column(type="integer", nullable=true)**/
    public $view;
	/** @published @Column(type="integer", nullable=true)**/
    public $published;
	/** @featured @Column(type="integer", nullable=true)**/
    public $featured;
}
?>