<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="utf-8">
	<title>Перевозки грузов по всей России</title>
	<meta name="description" content="Перевозки грузов по всей России">
	<meta name="keywords" content="Перевозки грузов по всей России">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon" href="./img/favicon/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="./css/main.css">
	<link rel="stylesheet" href="./lib/bootstrap/css/bootstrap.css">
	<script src="./js/jquery-3.3.1.min.js"></script>
	<script src="./lib/jquery-ui/jquery-ui.min.js"></script>
	<script src="./lib/bootstrap/js/bootstrap.js"></script>
	<script>
$( document ).ready(function() {
    $("#send-form").click(
		function(){
			sendAjaxForm('result_form', 'formTop', 'send.php');
			return false;
		}
	);
});

function sendAjaxForm(result_form, formTop, url) {
    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: $("#"+formTop).serialize(),
        success: function(data) {
						console.log(data);
						if(data == 1) {
							$('.card-title').html('Спасибо за заявку!');
							$('.card-text').html('Сейчас вам перезвонит менеджер. Будьте готовы уточнить время и порядок загрузки');
	    				$('.overlay_popup, .popup').show();
							$('.overlay_popup').click(function() {
	    					$('.overlay_popup, .popup').hide();
							});
							$('#back-btn').click(function() {
								$('.overlay_popup, .popup').hide();
							})
						} else {
							$('.card-title').html('Ошибка');
							$('.card-text').html(data);
							$('.overlay_popup, .popup').show();
							$('.overlay_popup').click(function() {
								$('.overlay_popup, .popup').hide();
							});
							$('#back-btn').click(function() {
								$('.overlay_popup, .popup').hide();
							})
						}
    				},
    		error: function(data) {
					console.log(data);
    		}
 		});
}
	</script>
</head>

<body>
	<section class="form-top">
		<div class="container-fluid">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-xl-12">
						<div class="title">
							<div class="line-3">Перевозка грузов по всей России</div>
							<div class="description">Аутсорсинг логистических услуг для производственных компаний, заводов изготовителей оборудования, поставки сырья и вывоз готовой продукции</div>
						</div>
					</div>
				</div>

				<div class="row justify-content-center">
					<div class="col-xl-12">
						<div class="info-text">
							Принимаем заявки на перевозки
						</div>
					</div>
				</div>

				<div class="row justify-content-center">

					    <div class="overlay_popup"></div>
					    <div class="popup" id="popup1">
					      <div class="object">
									<div class="container-fluid mt-5">
										<div class="container">
											<div class="row justify-content-center align-items-center">
												<div class="col-xl-4">
													<div class="card">
														<img src="/img/call.jpg" class="card-img-top" alt="">
														<div class="card-body">
															<h5 class="card-title">Спасибо за заявку!</h5>
															<p class="card-text">Сейчас вам перезвонит менеджер. Будьте готовы уточнить время и порядок загрузки</p>
															<div id="back-btn" class="btn btn-primary">Вернуться на сайт</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
							</div>
							</div>
					<form method="post" action="" id="formTop" class="col-xl-12">

						<div class="row justify-content-between">
							<div class="col-xl-3 col-lg-3">
								<div class="input-form"><input type="text" id="from" maxlength="50" name="from" class="input-select" placeholder="Откуда" required></div>
							</div>
							<div class="col-xl-3 col-lg-3">
								<div class="input-form"><input type="text" id="to" name="to" maxlength="50" class="input-select" placeholder="Куда" required></div>
							</div>
							<div class="col-xl-3 col-lg-3">
								<div class="input-form"><input type="text" id="weight" name="weight" maxlength="5" placeholder="Вес(кг) *примерно" required></div>
							</div>
							<div class="col-xl-3 col-lg-3">
								<div class="input-form"><input type="text" id="volume" name="volume" maxlength="5" placeholder="Объем (м3) *примерно" required></div>
							</div>
						</div>

						<div class="row justify-content-center">
							<div class="col-xl-6 col-lg-6">
								<div class="input-form cargo-name">
									<input type="hidden" name="SOURCE_ID" value="78123100057">
									<input type="text" id="phone" name="phone" maxlength="20" placeholder="Номер телефона">
								</div>
							</div>
						</div>

						<div class="row justify-content-center">
							<div class="col-xl-12">
								<div class="text-center form-warning">
								</div>
							</div>
						</div>

						<div class="row justify-content-center">
							<div class="col-xl-12">
								<div class="text-center form-button">
									<input type="hidden" name="SOURCE_ID" value="78123100057">
									<button type="button" id="send-form" class="blue-button show_popup">Рассчитать тариф</button>
								</div>
							</div>
						</div>

					</form>
					<!-- <div id="result_form"></div> -->
				</div>

				<div class="row justify-content-center">
					<div class="col-xl-12">
						<div class="bottom-text-form text-center">
							Уже <b> через 15 минут </b> Ваши проблемы станут нашими
						</div>
					</div>
				</div>

				<div class="row justify-content-center" id="calcOtherRouteJS" style="display: none;">
					<div class="col-xl-12">
						<div class="text-center">
							<span>Рассчитать другой маршрут</span>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>



	<script src="./js/inputmask.js"></script>
	<script src="./js/scripts.js"></script>
</body>
</html>
