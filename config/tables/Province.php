<?php
/**
 * @Entity @Table(name="eso_location_province")
 **/
class Province{
	/** @id @Column(type="integer") @GeneratedValue**/
    public $id;
	/** @region @Column(type="string", nullable=true)**/
    public $region;
	/** @prefix @Column(type="string", nullable=true)**/
    public $prefix;
	/** @name @Column(type="string")**/
    public $name;
	/** @alias @Column(type="string", nullable=true)**/
    public $alias;
	/** @postal @Column(type="integer", nullable=true)**/
    public $postal;
}
?>