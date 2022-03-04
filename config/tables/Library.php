<?php
/**
 * @Entity @Table(name="eso_content_library")
 **/
class Library{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @name @Column(type="string")**/
    public $name;
	/** @alias @Column(type="string")**/
    public $alias;
	/** @description @Column(type="text", nullable=true)**/
    public $description;
	/** @image @Column(type="string")**/
    public $image;
	/** @photo @Column(type="string", nullable=true)**/
    public $photo;
	/** @video @Column(type="string", nullable=true)**/
    public $video;
	/** @view @Column(type="integer", nullable=true)**/
    public $view;
	/** @created @Column(type="integer")**/
    public $created;
	/** @created_by @Column(type="string")**/
    public $created_by;
	/** @updated @Column(type="integer", nullable=true)**/
    public $updated;
	/** @updated_by @Column(type="string", nullable=true)**/
    public $updated_by;
	/** @published @Column(type="integer", nullable=true)**/
    public $published;
	/** @featured @Column(type="integer", nullable=true)**/
    public $featured;
}
?>