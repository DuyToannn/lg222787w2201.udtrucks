<?php
class ScriptModel{
	public function getOne($_position){
		try {
			global $entityManager;
			return $entityManager->getRepository("Script")->findOneBy(array('position' => $_position));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getList($_position) {
        try {
            global $entityManager;
            return $entityManager->getRepository('Script')->findBy(array('position' => $_position));
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function dispatchURL($re_url, &$page, &$item){
		return;
    }
}
?>