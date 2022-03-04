<?php
/**
 * @Entity @Table(name="eso_content_review")
 **/
class Review{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @user @Column(type="string", nullable=true)**/
    public $user;
	/** @type @Column(type="string", nullable=true)**/
    public $type;
	/** @code @Column(type="string", nullable=true)**/
    public $code;
	/** @name @Column(type="string")**/
    public $name;
	/** @phone @Column(type="string")**/
    public $phone;
	/** @email @Column(type="string", nullable=true)**/
    public $email;
	/** @title @Column(type="string", nullable=true)**/
    public $title;
	/** @content @Column(type="text")**/
    public $content;
	/** @comment @Column(type="text", nullable=true)**/
    public $comment;
	/** @rate @Column(type="integer", nullable=true)**/
    public $rate;
	/** @created @Column(type="integer")**/
    public $created;
	/** @updated @Column(type="integer", nullable=true)**/
    public $updated;
	/** @updated_by @Column(type="string", nullable=true)**/
    public $updated_by;
	/** @featured @Column(type="integer", nullable=true)**/
    public $featured;
	/** @published @Column(type="integer", nullable=true)**/
    public $published;
}
?>