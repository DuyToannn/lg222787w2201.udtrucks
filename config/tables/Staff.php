<?php
/**
 * @Entity @Table(name="eso_hrm_staff")
 **/
class Staff{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @code @Column(type="string", nullable=true, unique=true)**/
    public $code;
	/** @phone @Column(type="string", unique=true)**/
    public $phone;
	/** @password @Column(type="string")**/
    public $password;
	/** @permission @Column(type="string")**/
    public $permission;
	/** @name @Column(type="string")**/
    public $name;
	/** @email @Column(type="string", nullable=true)**/
    public $email;
	/** @dob @Column(type="integer", nullable=true)**/
    public $dob;
	/** @gender @Column(type="integer", nullable=true)**/
    public $gender;
	/** @id_province @Column(type="integer", nullable=true)**/
    public $id_province;
	/** @address @Column(type="string", nullable=true)**/
    public $address;
	/** @avatar @Column(type="string", nullable=true)**/
    public $avatar;
	/** @created @Column(type="bigint")**/
    public $created;
	/** @updated @Column(type="bigint", nullable=true)**/
    public $updated;
	/** @login @Column(type="bigint", nullable=true)**/
    public $login;
	/** @status @Column(type="integer")**/
    public $status;
}
?>