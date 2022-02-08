<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>Add/Remove row dynamically [PHP & Ajax]</title>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
	<link href="assets/css/datatables.min.css?v=<?php echo time(); ?>" rel="stylesheet">
	<link href="assets/css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

	<script>
		$(document).ready(function () {
			//Preloader
			preloaderFadeOutTime = 2000;

			function hidePreloader() {
				var preloader = $('.spinner-wrapper');
				preloader.fadeOut(preloaderFadeOutTime);
			}
			hidePreloader();
		});
	</script>
</head>

<body>
	<!--<div class="spinner-wrapper">
		<div class="spinner"></div>
	</div>-->
	<div class="container">
		<h3 class="mb-20">Add/Remove row dynamically [PHP & Ajax]</h3>

		<form method="POST" action="" id="custom_order_form">
			<table name="invoice" id="table" class="display">
				<thead>
					<tr>
						<th>PRODUCT NAME <span class="required">*</span></th>
						<th>SKU <span class="required">*</span></th>
						<th>QUANTITY <span class="required">*</span></th>
						<th>UNIT PRICE [Rs.] <span class="required">*</span></th>
						<th>ITEM TOTAL</th>
						<th width="15%"></th>
					</tr>
				</thead>
				<tbody class="order-table" id="order-table">
					<tr id="row1">
						<td>
							<div class="form-group">
								<div>
									<input type="text" name="product_name[]" id="prod1" class="form-control" required
										placeholder="Enter Product Name">
								</div>
							</div>
						</td>
						<td>
							<div class="form-group">
								<div>
									<input type="text" name="sku[]" id="sku1" class="form-control" required
										placeholder="Enter SKU">
								</div>
							</div>
						</td>
						<td>
							<div class="form-group">
								<div>
									<input type="text" id="quantity1" oninput="CalcAmount(1)" name="quantity[]"
										class="value-input form-control calc_amount" required
										placeholder="Enter quantity">
								</div>
							</div>
						</td>
						<td>
							<div class="form-group">
								<div>
									<input type="text" id="price1" oninput="CalcAmount(1)" name="price[]"
										class="value-input form-control calc_amount" required placeholder="Enter Price">
								</div>
							</div>
						</td>
						<td>
							<p id="item_total1" class="sub_amount"></p>
						</td>
						<td>
							<button type="button" class="btn btn-primary" onclick="add_more()">Add More</button>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<h2>Total</h2>
						</td>
						<td>
							<h2 id="total">0</h2>
						</td>
					</tr>
				</tbody>
				<input type="hidden" id="more" class="form-control" value="1">
			</table>

			<div class="mt-20">
				<input type="submit" name="submit" class="btn btn-primary" id="submit" value="Submit">
			</div>
			<form>
	</div>


	<script src="assets/js/jquery.min.js"></script>

	<script src="assets/js/datatables.min.js"></script>
	<script>
		$(document).ready(function () {
			$('#table').DataTable({
				bFilter: false,
				bInfo: false,
				bSort: false,
				bPaginate: false
			});

		});

		function add_more() {
			var more = $("#more").val();
			var newId = Math.floor(Math.random() * 1000);
			more++;
			$("#more").val(more);
			var data = '<tr id="row' + more +
				'"><td><div class="form-group"><div><input type="text" name="product_name[]" id="prod' + newId +
				'" class="form-control" required placeholder="Enter Product Name"></div></div></td><td><div class="form-group"><div><input type="text" name="sku[]" id="sku' +
				newId +
				'" class="form-control" required placeholder="Enter SKU"></div></div></td><td><div class="form-group"><div><input type="text" id="quantity' +
				newId + '" oninput="CalcAmount(' + newId +
				')" name="quantity[]" class="value-input form-control calc_amount" required placeholder="Enter Quantity"></div></div></td><td><div class="form-group"><div><input type="text" id="price' +
				newId + '" name="price[]" oninput="CalcAmount(' + newId +
				')" class="value-input form-control calc_amount" required placeholder="Enter Price"></div></div></td><td><p class="sub_amount" id="item_total' +
				newId + '"></p></td><td><button type="button" class="btn btn-danger" onclick=remove_row("' + more +
				'")>Remove</button></td></tr>';
			$(".order-table tr:last").before(data);
		}

		function remove_row(id) {
			$("#row" + id).remove();
			calc();
		}

		function CalcAmount(id) {
			var totalAmount = parseFloat($('#price' + id).val()) * parseFloat($('#quantity' + id).val());
			$('#item_total' + id).html(totalAmount);
			calc();
		}

		function calc() {
			var sub_total = 0;
			$(".sub_amount").each(function () {
				sub_total = sub_total + ($(this).html() * 1);
			})
			$("#total").html(sub_total);
		}
	</script>

</body>

</html>