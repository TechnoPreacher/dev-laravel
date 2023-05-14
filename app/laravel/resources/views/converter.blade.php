<div class="row  justify-content-center">
	
	<div class="col-4">
		<div><?php $eur_buy = $data['EUR']['buy']; print_r($eur_buy); ?></div>
		<div><?php $eur_sale = $data['EUR']['sale']; print_r($eur_sale); ?></div>
		<div><?php $usd_buy = $data['USD']['buy']; print_r($usd_buy); ?></div>
		<div><?php $usd_sale = $data['USD']['sale']; print_r($usd_sale); ?></div>
		
		
		
		@for($i = 1; $i <= 2; $i++)
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<select class="custom-select" id="mySelect<?=$i?>" name="mySelect">

						<?php $j = 0; ?>
						@foreach($data as $k=>$v)
							<?php $j++; ?>
							<option value="option<?=$j?>" data-buy="<?=$v['buy']?>"
							        data-sale="<?=$v['sale']?>"><?=$k?></option>
						@endforeach
					</select>
				</div>
				<input type="text" class="form-control" value="1" name="inp<?=$i?>" id="inp<?=$i?>">
			</div>
		@endfor
	
	</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>


<script>


    // function return_data(selector_, type_) {
    //     let val_ = 0;
    //     let selectedindex_ = $("#" + selector_).prop('selectedIndex');
    //     let currencyacronym_ = $("#" + selector_ + " option:selected").text();
    //     const selectedOption = $('#' + selector_ + ' option:selected');
    //     const optionValue = selectedOption.val();//option1, option2, option3
    //
    //     let first_ = $("#inp1").val();
    //     let second_ = $("#inp2").val();
    //
    //
    //     if (selector_ == 'mySelect1') {//продажа
    //         //    alert(selectedOption.data('buy') + " " + selectedOption.data('sale'));
    //     }
    //     if (type_ === 'buy') {
    //         val_ = selectedOption.data('buy');
    //         //   alert('buy:' + val_);
    //     }
    //
    //     if (type_ === 'sale') {
    //         val_ = selectedOption.data('sale');
    //         //   alert('sale:' + val_);
    //     }
    //     return val_;
    // }

    $(document).ready(
        function () {
            $('#mySelect1 option[value="option3"]').prop('selected', true);//uah
            $('#mySelect2 option[value="option2"]').prop('selected', true);//usd
            conv($('#inp1').val(), 'buy');
        });

    function conv(sum, buyorsalemode_) {
        let insum_ = 0;
        let outsum_ = 0;
        if (buyorsalemode_ === 'buy') {
            insum_ = sum;
            outsum_ = insum_ / $('#' + 'mySelect2' + ' option:selected').data('sale');
            outsum_ = Math.round(outsum_ * 100) / 100;
            $("#inp2").val(outsum_);
        }
	    
        if (buyorsalemode_ === 'sale') {
            insum_ = sum;
            outsum_ = insum_ * $('#' + 'mySelect2' + ' option:selected').data('buy');
            outsum_ = Math.round(outsum_ * 100) / 100;
            $("#inp1").val(outsum_);
        }
    }

    $(document).on('change', function (event) {


            if (event.target.name === 'inp1') {//editing first value
                conv($(event.target).val(), 'buy');
            }

            if (event.target.name === 'inp2') {//editing second value
                conv($(event.target).val(), 'sale');
            }


            if (event.target.id === 'mySelect1') {
                conv($('#inp1').val(), 'buy');
            }

            if (event.target.id === 'mySelect2') {
                conv($('#inp2').val(), 'sale');
            }

        }
    );


</script>