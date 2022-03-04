<?php
/**
 * @Entity @Table(name="eso_commerce_store")
 **/
class Store{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @code @Column(type="string", unique=true)**/
    public $code;
	/** @name @Column(type="string", nullable=true)**/
    public $name;
	/** @alias @Column(type="string", nullable=true)**/
    public $alias;
	/** @phone @Column(type="string", nullable=true)**/
    public $phone;
	/** @email @Column(type="string", nullable=true)**/
    public $email;
	/** @address @Column(type="string", nullable=true)**/
    public $address;
	/** @id_province @Column(type="integer", nullable=true)**/
    public $id_province;
	/** @image @Column(type="string", nullable=true)**/
    public $image;
	/** @description @Column(type="text", nullable=true)**/
    public $description;
	/** @sort @Column(type="integer", nullable=true)**/
    public $sort;
	/** @created @Column(type="integer")**/
    public $created;
	/** @updated @Column(type="integer", nullable=true)**/
    public $updated;
	/** @published @Column(type="integer", nullable=true)**/
    public $published;
}
?>