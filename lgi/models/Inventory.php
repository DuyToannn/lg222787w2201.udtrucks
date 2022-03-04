<?php
class InventoryModel{
	public function countAll(){
		try {
			global $entityManager;
			$query = $entityManager->createQueryBuilder();
            $query->select('count(i.id)')->from('Inventory','i');
			return $query->getQuery()->getSingleScalarResult();
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getOne($value, $field = "id"){
		try {
			global $entityManager;
			return $entityManager->getRepository("Inventory")->findOneBy(array($field => $value));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getList($keyword = null, $store = null, $manufacturer = null, $category = null, $status = null, &$total, $page, $limit = 50){
        try {
			global $entityManager;
			$count = $entityManager->createQueryBuilder();
            $count->select('count(i.id)')->from('Inventory','i')->leftJoin('Product', 'p', 'WITH', 'p.sku = i.product');
			if($keyword != null) $count->andWhere('p.name LIKE \'%' . $keyword . '%\' OR p.sku LIKE \'%' . $keyword . '%\'');
			if($store != null) $count->andWhere("i.store = '".$store."'");
			if ($category != null) {
				if($category == 0) $count->andWhere('p.id_category = 0');
				else $count->leftJoin('Category', 'child', 'WITH', 'child.id = p.id_category ')->leftJoin('Category', 'parent', 'WITH', 'parent.id = child.id_parent')
				->andWhere('child.id = '.$category.' OR parent.id = '.$category.' OR parent.id_parent = '.$category);
			}
            $total = $count->getQuery()->getSingleScalarResult();


            $query = $entityManager->createQueryBuilder();
            $query->add('select', 'i')->from('Inventory', 'i')->leftJoin('Product', 'p', 'WITH', 'p.sku = i.product');
            if($keyword != null) $query->andWhere('p.name LIKE \'%' . $keyword . '%\' OR p.sku LIKE \'%' . $keyword . '%\'');
			if($store != null) $query->andWhere("i.store = '".$store."'");
			if ($category != null) {
				if($category == 0) $query->andWhere('p.id_category = 0');
				else $query->leftJoin('Category', 'child', 'WITH', 'child.id = p.id_category ')->leftJoin('Category', 'parent', 'WITH', 'parent.id = child.id_parent')
				->andWhere('child.id = '.$category.' OR parent.id = '.$category.' OR parent.id_parent = '.$category);
			}
            $query->orderBy('i.quantity', 'DESC');
            $query->setFirstResult(($page - 1) * $limit);
            $query->setMaxResults($limit);
            return $query->getQuery()->getResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getListImport($keyword = null, $category = null, &$total, $page, $limit = 50) {
        try {
			global $entityManager;
			$count = $entityManager->createQueryBuilder();
            $count->select('count(i.id)')->from('Import','i');
			if($keyword != null) $count->andWhere('i.name LIKE \'%' . $keyword . '%\' OR i.code LIKE \'%' . $keyword . '%\' OR i.phone LIKE \'%' . $keyword . '%\' OR i.email LIKE \'%' . $keyword . '%\'');
            $total = $count->getQuery()->getSingleScalarResult();


            $query = $entityManager->createQueryBuilder();
            $query->add('select', 'i')->from('Import', 'i');
            if($keyword != null) $query->andWhere('i.name LIKE \'%' . $keyword . '%\' OR i.code LIKE \'%' . $keyword . '%\' OR i.phone LIKE \'%' . $keyword . '%\' OR i.email LIKE \'%' . $keyword . '%\'');
            $query->orderBy('i.created', 'DESC');
            $query->setFirstResult(($page - 1) * $limit);
            $query->setMaxResults($limit);
            return $query->getQuery()->getResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getListExport($keyword = null, $category = null, &$total, $page, $limit = 50) {
        try {
			global $entityManager;
			$count = $entityManager->createQueryBuilder();
            $count->select('count(i.id)')->from('Export','i');
			if($keyword != null) $count->andWhere('i.name LIKE \'%' . $keyword . '%\' OR i.code LIKE \'%' . $keyword . '%\' OR i.phone LIKE \'%' . $keyword . '%\' OR i.email LIKE \'%' . $keyword . '%\'');
            $total = $count->getQuery()->getSingleScalarResult();


            $query = $entityManager->createQueryBuilder();
            $query->add('select', 'i')->from('Export', 'i');
            if($keyword != null) $query->andWhere('i.name LIKE \'%' . $keyword . '%\' OR i.code LIKE \'%' . $keyword . '%\' OR i.phone LIKE \'%' . $keyword . '%\' OR i.email LIKE \'%' . $keyword . '%\'');
            $query->orderBy('i.created', 'DESC');
            $query->setFirstResult(($page - 1) * $limit);
            $query->setMaxResults($limit);
            return $query->getQuery()->getResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getListRotation($keyword = null, $category = null, &$total, $page, $limit = 50) {
        try {
			global $entityManager;
			$count = $entityManager->createQueryBuilder();
            $count->select('count(i.id)')->from('Rotation','i');
			if($keyword != null) $count->andWhere('i.name LIKE \'%' . $keyword . '%\' OR i.code LIKE \'%' . $keyword . '%\' OR i.phone LIKE \'%' . $keyword . '%\' OR i.email LIKE \'%' . $keyword . '%\'');
            $total = $count->getQuery()->getSingleScalarResult();


            $query = $entityManager->createQueryBuilder();
            $query->add('select', 'i')->from('Rotation', 'i');
            if($keyword != null) $query->andWhere('i.name LIKE \'%' . $keyword . '%\' OR i.code LIKE \'%' . $keyword . '%\' OR i.phone LIKE \'%' . $keyword . '%\' OR i.email LIKE \'%' . $keyword . '%\'');
            $query->orderBy('i.export', 'DESC');
            $query->setFirstResult(($page - 1) * $limit);
            $query->setMaxResults($limit);
            return $query->getQuery()->getResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function create($store = null, $product = null, $color = null, $size = null, $type = null){
        try {
            global $entityManager;
			$item = new Inventory();
			if($store == null) $item->store = $_POST["store"]; else $item->store = $store;
			if($product == null) $item->product = $_POST["product"]; else $item->product = $product;
			if($color == null) $item->color = $_POST["color"]; else $item->color = $color;
			if($size == null) $item->size = $_POST["size"]; else $item->size = $size;
			if($type == null) $item->type = $_POST["type"]; else $item->type = $type;
			$item->quantity = 0;
			$item->temporary = 0;
			$item->code = $item->store.'-'.$item->product.'-'.$item->color.'-'.$item->size.'-'.$item->type;
			$entityManager->persist($item);
            $entityManager->flush();
            $entityManager->clear();
			return $item;
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function import(){
        try {
            global $entityManager;
			$item = $entityManager->getRepository("Inventory")->findOneBy(array("store" => $_POST["store"], "product" => $_POST["product"], "color" => $_POST["color"], "size" => $_POST["size"], "type" => $_POST["type"]));
			if(empty($item)) $item = $this->create();
			$item->quantity += $_POST["quantity"];
			$entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
			//Import Record
			$item = new Import();
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			$item->created = time();
			$item->created_by = Helper::getSession('staff');
			if(empty($_POST['code'])) $item->code = date('Ymd').'-'.$item->vendor.'-'.$item->store;
			$entityManager->persist($item);
            $entityManager->flush();
            $entityManager->clear();
			return Helper::setMessage(array("type" => "success", "message" => "Đã nhập hàng"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function importDelete($id){
        try {
            global $entityManager;
			$item = $entityManager->getRepository("Import")->findOneBy(array("id" => $id));
			//minus inventory
			$inventory = $entityManager->getRepository("Inventory")->findOneBy(array("store" => $item->store, "product" => $item->product, "color" => $item->color, "size" => $item->size, "type" => $item->type));
			$inventory->quantity -= $item->quantity;
			$entityManager->merge($inventory);
            $entityManager->flush();
            $entityManager->clear();
			//delete import
			$query = $entityManager->createQueryBuilder()->delete('Import', 'i')->where('i.id = '.$id);
			$result = $query->getQuery()->getResult();
			return Helper::setMessage(array("type" => "success", "message" => "Đã xóa thông tin nhập hàng"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function export(){
        try {
            global $entityManager;
			$item = $entityManager->getRepository("Inventory")->findOneBy(array("store" => $_POST["store"], "product" => $_POST["product"], "color" => $_POST["color"], "size" => $_POST["size"], "type" => $_POST["type"]));
			if(empty($item) || $item->quantity < $_POST["quantity"]) return Helper::setMessage(array("type" => "error", "message" => "Không có đủ sản phẩm để xuất"));
			$item->quantity -= $_POST["quantity"];
			$entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
			//Export Record
			$item = new Export();
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			$item->created = time();
			$item->created_by = Helper::getSession('staff');
			if(empty($_POST['code'])) $item->code = date('Ymd').'-'.$item->store.'-'.$item->vendor;
			$entityManager->persist($item);
            $entityManager->flush();
            $entityManager->clear();
			return Helper::setMessage(array("type" => "success", "message" => "Đã xuất hàng"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function exportDelete($id){
        try {
            global $entityManager;
			$item = $entityManager->getRepository("Export")->findOneBy(array("id" => $id));
			//minus inventory
			$inventory = $entityManager->getRepository("Inventory")->findOneBy(array("store" => $item->store, "product" => $item->product, "color" => $item->color, "size" => $item->size, "type" => $item->type));
			$inventory->quantity += $item->quantity;
			$entityManager->merge($inventory);
            $entityManager->flush();
            $entityManager->clear();
			//delete Export
			$query = $entityManager->createQueryBuilder()->delete('Export', 'i')->where('i.id = '.$id);
			$result = $query->getQuery()->getResult();
			return Helper::setMessage(array("type" => "success", "message" => "Đã xóa thông tin xuất hàng"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function rotation(){
        try {
            global $entityManager;
			$item = $entityManager->getRepository("Inventory")->findOneBy(array("store" => $_POST["export_store"], "product" => $_POST["product"], "color" => $_POST["color"], "size" => $_POST["size"], "type" => $_POST["type"]));
			if(empty($item) || $item->quantity < $_POST["quantity"]) return Helper::setMessage(array("type" => "error", "message" => "Không có đủ sản phẩm để chuyển đi"));
			$item->quantity -= $_POST["quantity"];
			$item->temporary += $_POST["quantity"];
			$entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
			//Rotation Record
			$item = new Rotation();
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			$item->export = time();
			$item->export_by = Helper::getSession('staff');
			$item->code = date('Ymd').'-'.$item->export_store.'-'.$item->import_store;
			$entityManager->persist($item);
            $entityManager->flush();
            $entityManager->clear();
			return Helper::setMessage(array("type" => "success", "message" => "Đã gửi hàng chuyển đi"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function rotationDelete($id){
        try {
            global $entityManager;
			$item = $entityManager->getRepository("Rotation")->findOneBy(array("id" => $id));
			//Inventory Update Export
			$inventory = $entityManager->getRepository("Inventory")->findOneBy(array("store" => $item->export_store, "product" => $item->product, "color" => $item->color, "size" => $item->size, "type" => $item->type));
			$inventory->quantity += $item->quantity;
			if(empty($item->import)) $inventory->temporary -= $item->quantity;
			$entityManager->merge($inventory);
            $entityManager->flush();
            $entityManager->clear();
			//Inventory Update Import
			if(!empty($item->import)){
				$inventory = $entityManager->getRepository("Inventory")->findOneBy(array("store" => $item->import_store, "product" => $item->product, "color" => $item->color, "size" => $item->size, "type" => $item->type));
				$inventory->quantity -= $item->quantity;
				$entityManager->merge($inventory);
				$entityManager->flush();
				$entityManager->clear();
			}
			//delete Rotation
			$query = $entityManager->createQueryBuilder()->delete('Rotation', 'i')->where('i.id = '.$id);
			$result = $query->getQuery()->getResult();
			return Helper::setMessage(array("type" => "success", "message" => "Đã xóa thông tin chuyển hàng"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function receive($id){
        try {
            global $entityManager;
			$item = $entityManager->getRepository("Rotation")->findOneBy(array("id" => $id));
			$item->import = time();
			$item->import_by = Helper::getSession('staff');
			$entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
			//Inventory Update Export
			$inventory = $entityManager->getRepository("Inventory")->findOneBy(array("store" => $item->export_store, "product" => $item->product, "color" => $item->color, "size" => $item->size, "type" => $item->type));
			$inventory->temporary -= $item->quantity;
			$entityManager->merge($inventory);
            $entityManager->flush();
            $entityManager->clear();
			//Inventory Update Import
			$inventory = $entityManager->getRepository("Inventory")->findOneBy(array("store" => $item->import_store, "product" => $item->product, "color" => $item->color, "size" => $item->size, "type" => $item->type));
			if(empty($inventory)) $inventory = $this->create($item->import_store, $item->product, $item->color, $item->size, $item->type);
			$inventory->quantity += $item->quantity;
			$entityManager->merge($inventory);
            $entityManager->flush();
            $entityManager->clear();
			return Helper::setMessage(array("type" => "success", "message" => "Đã nhận hàng chuyển đến"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function check(){
        try {
            global $entityManager;
			$item = $this->getOne($_POST["id"]);
			//Checkin
			$check = new InventoryCheck();
			$check->code = $item->code;
			$check->quantity = $item->quantity;
			$check->quantity_actual = $_POST["quantity_actual"];
			$check->temporary = $item->temporary;
			$check->temporary_actual = $_POST["temporary_actual"];
			$check->note = $_POST["note"];
			$check->checked = time();
			$check->checked_by = Helper::getSession('staff');
			$entityManager->persist($check);
            $entityManager->flush();
            $entityManager->clear();
			//Inventory Update
			$item->quantity = $check->quantity_actual;
			$item->temporary = $check->temporary_actual;
			$item->note = $check->note;
			$entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
			return Helper::setMessage(array("type" => "success", "message" => "Đã kiểm kho"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getExportList($store, $product, $color, $size, $type, $limit = 30, $start = 0){
		try {
			global $entityManager;
			$query = $entityManager->createQueryBuilder();
            $query->select('i.created, i.quantity, i.vendor, i.created_by, i.note')->from('Export', 'i')
				->where("i.store = '".$store."' AND i.product = '".$product."' AND i.color = '".$color."' AND i.size = '".$size."' AND i.type = '".$type."' ");
			$query->orderBy('i.created', 'DESC');
            $query->setFirstResult($start)->setMaxResults($limit);
            $log1 = $query->getQuery()->getResult();
			
			$query = $entityManager->createQueryBuilder();
            $query->select('i.export as created, i.quantity, i.import_store as vendor, i.export_by as created_by, i.note')->from('Rotation', 'i')
				->where("i.export_store = '".$store."' AND i.product = '".$product."' AND i.color = '".$color."' AND i.size = '".$size."' AND i.type = '".$type."' ");
			$query->orderBy('i.export', 'DESC');
            $query->setFirstResult($start)->setMaxResults($limit);
            $log2 = $query->getQuery()->getResult();
			
			return array_merge($log1, $log2);
			//return $entityManager->getRepository("Export")->findBy(array("store" => $store, "product" => $product, "color" => $color, "size" => $size, "type" => $type), array("created" => "DESC"), $limit, $start);
		} catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
	}
	public function getImportList($store, $product, $color, $size, $type, $limit = 30, $start = 0){
		try {
			global $entityManager;
			$query = $entityManager->createQueryBuilder();
            $query->select('i.created, i.quantity, i.vendor, i.created_by, i.note')->from('Import', 'i')
				->where("i.store = '".$store."' AND i.product = '".$product."' AND i.color = '".$color."' AND i.size = '".$size."' AND i.type = '".$type."' ");
			$query->orderBy('i.created', 'DESC');
            $query->setFirstResult($start)->setMaxResults($limit);
            $log1 = $query->getQuery()->getResult();
			
			$query = $entityManager->createQueryBuilder();
            $query->select('i.import as created, i.quantity, i.export_store as vendor, i.import_by as created_by, i.note')->from('Rotation', 'i')
				->where("i.import_store = '".$store."' AND i.product = '".$product."' AND i.color = '".$color."' AND i.size = '".$size."' AND i.type = '".$type."' ");
			$query->orderBy('i.import', 'DESC');
            $query->setFirstResult($start)->setMaxResults($limit);
            $log2 = $query->getQuery()->getResult();
			//$log1 = $entityManager->getRepository("Import")->findBy(array("store" => $store, "product" => $product, "color" => $color, "size" => $size, "type" => $type), array("created" => "DESC"), $limit, $start);
			
			return array_merge($log1, $log2);
		} catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
	}
	public function getCheckedList($code, $limit = 30, $start = 0){
		try {
			global $entityManager;
			return $entityManager->getRepository("InventoryCheck")->findBy(array("code" => $code), array("checked" => "DESC"), $limit, $start);
		} catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
	}
}
?>