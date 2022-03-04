<?php

if(!empty($_POST["task"]) && $_POST["task"] == "orderNow"){
	$user = $this->model->user->create(false);
					$order = $this->model->order->create($user->code);
					if(!empty($order)){
						Helper::setSession('order', $order->code);
						switch($order->payment){
							case 'napas':
								header('Location: /payment?init=napas');
								break;
							case 'vnpay':
								header('Location: /payment?init=vnpay');
								break;
							case 'momo':
								header('Location: /payment?init=momo');
								break;
							case 'zalopay':
								header('Location: /payment?init=zalopay');
								break;
							default:
								Helper::setMessage(array('type' => 'success', 'message' => "Đặt hàng thành công, vui lòng chờ xác nhận."));
	header("Location: /");
	exit();
						}
					}
	
}