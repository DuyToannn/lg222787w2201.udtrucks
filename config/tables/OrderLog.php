<?php
/**
 * @Entity @Table(name="eso_commerce_order_log")
 **/
class OrderLog{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @code @Column(type="string")**/
    public $code;
	/** @type @Column(type="string")**/
    public $type;
	/** @method @Column(type="string")**/
    public $method;
	/** @method_code @Column(type="string", nullable=true)**/
    public $method_code;
	/** @detail @Column(type="text", nullable=true)**/
    public $detail;
	/** @created @Column(type="integer")**/
    public $created;
	/** @created_by @Column(type="string")**/
    public $created_by;
	/** @note @Column(type="text", nullable=true)**/
    public $note;
}
?>