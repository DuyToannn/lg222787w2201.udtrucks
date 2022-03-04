<?php
/**
 * @Entity @Table(name="eso_commerce_product")
 **/
class Product{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @id_category @Column(type="string")**/
    public $id_category;
	/** @id_manufacturer @Column(type="integer")**/
    public $id_manufacturer;
	/** @origin @Column(type="string", nullable=true)**/
    public $origin;
	/** @sku @Column(type="string", unique=true)**/
    public $sku;
	/** @name @Column(type="string", nullable=true)**/
    public $name;
	/** @alias @Column(type="string", nullable=true)**/
    public $alias;
	/** @image @Column(type="string", nullable=true)**/
    public $image;
	/** @banner @Column(type="string", nullable=true)**/
    public $banner;
	/** @photo @Column(type="text", nullable=true)**/
    public $photo;
	/** @video @Column(type="string", nullable=true)**/
    public $video;
	/** @file @Column(type="string", nullable=true)**/
    public $file;
	/** @color @Column(type="text", nullable=true)**/
    public $color;
	/** @color_define @Column(type="string", nullable=true)**/
    public $color_define;
	/** @size @Column(type="text", nullable=true)**/
    public $size;
	/** @size_define @Column(type="string", nullable=true)**/
    public $size_define;
	/** @type @Column(type="text", nullable=true)**/
    public $type;
	/** @type_define @Column(type="string", nullable=true)**/
    public $type_define;
	/** @unit @Column(type="string", nullable=true)**/
    public $unit;
	/** @price @Column(type="integer")**/
    public $price;
	/** @price_old @Column(type="integer", nullable=true)**/
    public $price_old;
	/** @price_shock @Column(type="integer", nullable=true)**/
    public $price_shock;
	/** @shock @Column(type="integer", nullable=true)**/
    public $shock;
	/** @shock_selled @Column(type="integer", nullable=true)**/
    public $shock_selled;
	/** @point @Column(type="integer", nullable=true)**/
    public $point;
	/** @highlight @Column(type="text", nullable=true)**/
    public $highlight;
	/** @promotion @Column(type="text", nullable=true)**/
    public $promotion;
	/** @content @Column(type="text", nullable=true)**/
    public $content;
	/** @specs @Column(type="text", nullable=true)**/
    public $specs;
	/** @combo @Column(type="text", nullable=true)**/
    public $combo;
	/** @gift @Column(type="text", nullable=true)**/
    public $gift;
	/** @combo_max @Column(type="integer", nullable=true)**/
    public $combo_max;
	/** @gift_max @Column(type="integer", nullable=true)**/
    public $gift_max;
	/** @featured @Column(type="integer", nullable=true)**/
    public $featured;
	/** @coming @Column(type="integer", nullable=true)**/
    public $coming;
	/** @new @Column(type="integer", nullable=true)**/
    public $new;
	/** @top @Column(type="integer", nullable=true)**/
    public $top;
	/** @sale @Column(type="integer", nullable=true)**/
    public $sale;
	/** @freeship @Column(type="integer", nullable=true)**/
    public $freeship;
	/** @suggest @Column(type="integer", nullable=true)**/
    public $suggest;
	/** @outstock @Column(type="integer", nullable=true)**/
    public $outstock;
	/** @view @Column(type="integer", nullable=true)**/
    public $view;
	/** @title @Column(type="string", nullable=true)**/
    public $title;
	/** @description @Column(type="string", nullable=true)**/
    public $description;
	/** @created @Column(type="integer")**/
    public $created;
	/** @updated @Column(type="integer")**/
    public $updated;
	/** @published @Column(type="integer", nullable=true)**/
    public $published;
}
?>