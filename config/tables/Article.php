<?php
/**
 * @Entity @Table(name="eso_content_article")
 **/
class Article{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @id_blog @Column(type="integer", nullable=true)**/
    public $id_blog;
	/** @title @Column(type="string")**/
    public $title;
	/** @alias @Column(type="string")**/
    public $alias;
	/** @image @Column(type="string", nullable=true)**/
    public $image;
	/** @summary @Column(type="text", nullable=true)**/
    public $summary;
	/** @content @Column(type="text")**/
    public $content;
	/** @hot @Column(type="integer", nullable=true)**/
    public $hot;
	/** @view @Column(type="integer")**/
    public $view;
	/** @staff @Column(type="string")**/
    public $staff;
	/** @created @Column(type="integer")**/
    public $created;
	/** @updated @Column(type="integer", nullable=true)**/
    public $updated;
	/** @published @Column(type="integer", nullable=true)**/
    public $published;
	/** @featured @Column(type="integer", nullable=true)**/
    public $featured;
}
?>