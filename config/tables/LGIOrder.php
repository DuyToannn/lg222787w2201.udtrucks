<?php
/**
 * @Entity @Table(name="eso_commerce_order")
 **/
class LGIOrder{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @type @Column(type="string", nullable=true)**/
    public $type;
	/** @staff @Column(type="string", nullable=true)**/
    public $staff;
	/** @code @Column(type="string", nullable=true, unique=true)**/
    public $code;
	/** @user @Column(type="string", nullable=true)**/
    public $user;
	/** @name @Column(type="string", nullable=true)**/
    public $name;
	/** @phone @Column(type="string", nullable=true)**/
    public $phone;
	/** @email @Column(type="string", nullable=true)**/
    public $email;
	/** @id_province @Column(type="integer", nullable=true)**/
    public $id_province;
	/** @id_district @Column(type="integer", nullable=true)**/
    public $id_district;
	/** @id_ward @Column(type="integer", nullable=true)**/
    public $id_ward;
	/** @address @Column(type="string", nullable=true)**/
    public $address;
	/** @note @Column(type="text", nullable=true)**/
    public $note;
	/** @guide @Column(type="text", nullable=true)**/
    public $guide;
	/** @product @Column(type="text", nullable=true)**/
    public $product;
	/** @price @Column(type="integer", nullable=true)**/
    public $price;
	/** @discount @Column(type="integer", nullable=true)**/
    public $discount;
	/** @fee @Column(type="integer", nullable=true)**/
    public $fee;
	/** @total @Column(type="integer", nullable=true)**/
    public $total;
	/** @deposit @Column(type="integer", nullable=true)**/
    public $deposit;
	/** @debt @Column(type="integer", nullable=true)**/
    public $debt;
	/** @promotion @Column(type="string", nullable=true)**/
    public $promotion;
	/** @point @Column(type="integer", nullable=true)**/
    public $point;
	/** @shipment @Column(type="string", nullable=true)**/
    public $shipment;
	/** @payment @Column(type="string", nullable=true)**/
    public $payment;
	/** @status @Column(type="integer", nullable=true)**/
    public $status;
	/** @created @Column(type="integer")**/
    public $created;
	/** @updated @Column(type="integer", nullable=true)**/
    public $updated;
	/** @updated_by @Column(type="string", nullable=true)**/
    public $updated_by;
	/** @canceled @Column(type="integer", nullable=true)**/
    public $canceled;
	/** @canceled_by @Column(type="string", nullable=true)**/
    public $canceled_by;
	/** @paid @Column(type="integer", nullable=true)**/
    public $paid;
	/** @paid_by @Column(type="string", nullable=true)**/
    public $paid_by;
	/** @confirmed @Column(type="integer", nullable=true)**/
    public $confirmed;
	/** @confirmed_by @Column(type="string", nullable=true)**/
    public $confirmed_by;
	/** @sent @Column(type="integer", nullable=true)**/
    public $sent;
	/** @sent_by @Column(type="string", nullable=true)**/
    public $sent_by;
	/** @delivered @Column(type="integer", nullable=true)**/
    public $delivered;
	/** @delivered_by @Column(type="string", nullable=true)**/
    public $delivered_by;
	/** @returned @Column(type="integer", nullable=true)**/
    public $returned;
	/** @returned_by @Column(type="string", nullable=true)**/
    public $returned_by;
	/** @comment @Column(type="text", nullable=true)**/
    public $comment;
	/** @complaint @Column(type="text", nullable=true)**/
    public $complaint;
	/** @expired @Column(type="integer", nullable=true)**/
    public $expired;
}
?>