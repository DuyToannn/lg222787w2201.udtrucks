<?php
class PController extends Controller{
	public function execute(){
		//if($_SERVER["REMOTE_ADDR"] != "171.246.171.239") header("Location: /admin");
		if(!empty($_POST)){
			if(!empty($_POST["ajax"]) && $_POST["ajax"] == "searchProduct"){
				$result = new stdClass;
				$result->status = "error";
				$result->data = null;
				$result->message = "Đã xảy ra lỗi không mong muốn. Vui lòng thử lại sau.";
				$data = $this->model->product->searchAJAX($_POST["keyword"]);
				if(!empty($data)){
					$result->status = "success";
					$result->data = $data;
					$result->message = "Kết quả tìm kiếm.";
				}else{
					$result->status = "error";
					$result->data = null;
					$result->message = "Không tìm thấy sản phẩm.";
				}
				exit(json_encode($result));
			}
			if(!empty($_POST["ajax"]) && $_POST["ajax"] == "searchPromotion"){
				$result = new stdClass;
				$result->status = "error";
				$result->data = null;
				$result->message = "Đã xảy ra lỗi không mong muốn. Vui lòng thử lại sau.";
				$data = $this->model->promotion->getOne($_POST["code"], "code");
				if(!empty($data) && !empty($data->status) && $data->quantity > 0 && $data->expired > time()){
					if(!empty($data->stack) || empty($this->model->promotion->isUsed($_POST["code"], $_POST["phone"])) || $data->phone == $_POST["phone"]){
						$result->status = "success";
						$result->data = $data;
						$result->message = "Kết quả tìm kiếm.";
					}else{
						$result->status = "error";
						$result->data = null;
						$result->message = "Không tìm thấy khuyến mãi.";
					}
				}else{
					$result->status = "error";
					$result->data = null;
					$result->message = "Không tìm thấy khuyến mãi.";
				}
				exit(json_encode($result));
			}
			if(!empty($_POST["task"])){
				//die(var_dump($_POST));
				if(empty($_POST['detailSku'])){
					Helper::setMessage(array("type" => "error", "message" => "Chưa chọn sản phẩm, vui lòng kiểm tra lại"));
					header("Refresh:0");
				}else{
					$customer = $this->model->customer->createQuick();
					$order = $this->model->order->createQuick($customer->code);
					header("Location: ?page=order&id=".$order->id);
					exit();
				}
			}
		}
	}
}
?>