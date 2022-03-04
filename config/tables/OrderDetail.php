<?php
/**
 * @Entity @Table(name="eso_commerce_order_detail")
 **/
class OrderDetail{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @code @Column(type="string")**/
    public $code;
	/** @combo @Column(type="string", nullable=true)**/
    public $combo;
	/** @sku @Column(type="string")**/
    public $sku;
	/** @product @Column(type="string", nullable=true)**/
    public $product;
	/** @color @Column(type="string", nullable=true)**/
    public $color;
	/** @size @Column(type="string", nullable=true)**/
    public $size;
	/** @type @Column(type="string", nullable=true)**/
    public $type;
	/** @quantity @Column(type="integer")**/
    public $quantity;
	/** @price @Column(type="integer")**/
    public $price;
	/** @discount @Column(type="integer", nullable=true)**/
    public $discount;
	/** @note @Column(type="text", nullable=true)**/
    public $note;
}
?>