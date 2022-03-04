<?php
/**
 * @Entity @Table(name="eso_website_menu")
 **/
class Menu{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @id_parent @Column(type="integer", nullable=true)**/
    public $id_parent;
	/** @type @Column(type="string")**/
    public $type;
	/** @name @Column(type="string")**/
    public $name;
	/** @link @Column(type="string")**/
    public $link;
	/** @content @Column(type="text", nullable=true)**/
    public $content;
	/** @icon @Column(type="string", nullable=true)**/
    public $icon;
	/** @image @Column(type="string", nullable=true)**/
    public $image;
	/** @prefix @Column(type="string", nullable=true)**/
    public $prefix;
	/** @position @Column(type="string")**/
    public $position;
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