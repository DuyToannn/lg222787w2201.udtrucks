<?php
/**
 * @Entity @Table(name="eso_content_blog")
 **/
class Blog{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @id_parent @Column(type="integer")**/
    public $id_parent;
	/** @name @Column(type="string")**/
    public $name;
	/** @alias @Column(type="string")**/
    public $alias;
	/** @image @Column(type="string", nullable=true)**/
    public $image;
	/** @icon @Column(type="string", nullable=true)**/
    public $icon;
	/** @banner @Column(type="string", nullable=true)**/
    public $banner;
	/** @content @Column(type="text", nullable=true)**/
    public $content;
	/** @prefix @Column(type="string", nullable=true)**/
    public $prefix;
	/** @title @Column(type="string", nullable=true)**/
    public $title;
	/** @description @Column(type="text", nullable=true)**/
    public $description;
	/** @sort @Column(type="integer", nullable=true)**/
    public $sort;
	/** @view @Column(type="integer", nullable=true)**/
    public $view;
	/** @published @Column(type="integer", nullable=true)**/
    public $published;
	/** @featured @Column(type="integer", nullable=true)**/
    public $featured;
}
?>