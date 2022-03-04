<?php
/**
 * @Entity @Table(name="eso_crm_user")
 **/
class User{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @code @Column(type="string", nullable=true, unique=true)**/
    public $code;
	/** @password @Column(type="string", nullable=true)**/
    public $password;
	/** @name @Column(type="string")**/
    public $name;
	/** @gender @Column(type="integer", nullable=true)**/
    public $gender;
	/** @dob @Column(type="integer", nullable=true)**/
    public $dob;
	/** @phone @Column(type="string", unique=true)**/
    public $phone;
	/** @email @Column(type="string", nullable=true, unique=true)**/
    public $email;
	/** @id_province @Column(type="integer", nullable=true)**/
    public $id_province;
	/** @id_district @Column(type="integer", nullable=true)**/
    public $id_district;
	/** @id_ward @Column(type="integer", nullable=true)**/
    public $id_ward;
	/** @address @Column(type="string", nullable=true)**/
    public $address;
	/** @point @Column(type="integer", nullable=true)**/
    public $point;
	/** @viewed @Column(type="text", nullable=true)**/
    public $viewed;
	/** @wishlist @Column(type="text", nullable=true)**/
    public $wishlist;
	/** @source @Column(type="string", nullable=true)**/
    public $source;
	/** @comment @Column(type="text", nullable=true)**/
    public $comment;
	/** @otp @Column(type="string", nullable=true)**/
    public $otp;
	/** @login @Column(type="integer", nullable=true)**/
    public $login;
	/** @created @Column(type="integer")**/
    public $created;
	/** @status @Column(type="integer")**/
    public $status;
}
?>