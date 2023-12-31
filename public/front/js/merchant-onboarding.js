		//jQuery time
		var current_fs, next_fs, previous_fs; //fieldsets
		var left, opacity, scale; //fieldset properties which we will animate
		var animating; //flag to prevent quick multi-click glitches

		$(document).on('click', '.next', function() {

			current_fs = $(this).parent();
			step = $(this).data('step');

			//step 1 validation
			if(step == 'personal_info'){
				var requiredFileds = ['name', 'mobile', 'permanent_address', 'district_id', 'thana_id'];
				var errorCount = 0;
				requiredFileds.forEach(field => {
					let el = $('[name='+field+'');
					let checkOther = true;
					if(field == 'mobile'){
						checkOther = validateMobileNo(el.val());
					}
					if(el.val().trim() == '' || !checkOther) {
						console.log('aa');
						el.addClass('has-error');
						errorCount++;
					}else{
						el.removeClass('has-error');
					}
				});
				if(errorCount > 0) return false;
			}

			//step 2 validation
			if(step == 'business_info'){
				var requiredFileds = ['company_name', 'login_mobile', 'warehouse_holding_no', 'warehouse_road_no', 'warehouse_area_name', 'warehouse_area_id', 'warehouse_location_id'];
				var errorCount = 0;
				requiredFileds.forEach(field => {
					let el = $('.'+field);
					let checkOther = true;
					if(field == 'login_mobile'){
						checkOther = validateMobileNo(el.val());
					}
					if(el.val().trim() == '' || !checkOther) {
						el.addClass('has-error');
						errorCount++;
					}else{
						el.removeClass('has-error');
					}
				});
				if(errorCount > 0) return false;
			}

			if(animating) return false;
			animating = true;
			
			next_fs = $(this).parent().next();

			//activate next step on progressbar using the index of next_fs
			$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
			
			//show the next fieldset
			next_fs.show(); 
			//hide the current fieldset with style
			current_fs.animate({opacity: 0}, {
				step: function(now, mx) {
					//as the opacity of current_fs reduces to 0 - stored in "now"
					//1. scale current_fs down to 80%
					scale = 1 - (1 - now) * 0.2;
					//2. bring next_fs from the right(50%)
					left = (now * 50)+"%";
					//3. increase opacity of next_fs to 1 as it moves in
					opacity = 1 - now;
					current_fs.css({
				'transform': 'scale('+scale+')',
				'position': 'absolute'
			});
					next_fs.css({'left': left, 'opacity': opacity});
				}, 
				duration: 800, 
				complete: function(){
					current_fs.hide();
					animating = false;
				}, 
				//this comes from the custom easing plugin
				easing: 'easeInOutBack'
			});
		});

		$(".previous").click(function(){
			if(animating) return false;
			animating = true;
			
			current_fs = $(this).parent();
			previous_fs = $(this).parent().prev();
			
			//de-activate current step on progressbar
			$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
			
			//show the previous fieldset
			previous_fs.show(); 
			//hide the current fieldset with style
			current_fs.animate({opacity: 0}, {
				step: function(now, mx) {
					//as the opacity of current_fs reduces to 0 - stored in "now"
					//1. scale previous_fs from 80% to 100%
					scale = 0.8 + (1 - now) * 0.2;
					//2. take current_fs to the right(50%) - from 0%
					left = ((1-now) * 50)+"%";
					//3. increase opacity of previous_fs to 1 as it moves in
					opacity = 1 - now;
					current_fs.css({'left': left});
					previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
				}, 
				duration: 800, 
				complete: function(){
					current_fs.hide();
					animating = false;
				}, 
				//this comes from the custom easing plugin
				easing: 'easeInOutBack'
			});
		});

        $(document).on('click', '.submit', function() {
            var requiredFileds = ['payment_method'];
            var errorCount = 0;
            requiredFileds.forEach(field => {
                let el = $('[name='+field+'');
                if(el.val().trim() != 'ক্যাশ') {
                    var payment_mobile = $('[name=payment_mobile');
                    if(payment_mobile.val().trim() == '') {
                        payment_mobile.addClass('has-error');
                        errorCount++;
                    }else{
                        payment_mobile.removeClass('has-error');
                    }
                }
            });
            if(errorCount > 0) return false;

            $('#msform').submit();
		});

        function validateMobileNo(mobileNo) {
            let prefixEntered = mobileNo.substring(0, 3);
            const validPrefix = [
                "011",
                "012",
                "013",
                "014",
                "015",
                "016",
                "017",
                "018",
                "019"
            ];
            let status = validPrefix.includes(prefixEntered);
            if (!status || mobileNo.length !== 11) {
                return false;
            } else {
                return true;
            }
        }

        $(document).on('submit', '#merchant-form', function() {

            var company_name = $('.company_name').val();
            var name = $('.name').val();
            var phone = $('.phone').val();

            var error = false;

            if (!company_name) {
                $('.company_name').focus();
                $('.company_name-error').html('আপনার ব্যবসা প্রতিষ্ঠানের নাম প্রদান করুন');
                error = true;
            }
            if (!name) {
                $('.name').focus();
                $('.name-error').html('আপনার পুরো নাম প্রদান করুন');
                error = true;
            }

            if (!phone) {
                $('.phone').focus();
                $('.phone-error').html('আপনার সচল মোবাইল নম্বর প্রদান করুন');
                error = true;
            }

            if (!validateMobileNo(phone)) {
                $('.phone').focus();
                $('.phone-error').html('সঠিক মোবাইল নাম্বার দিন');
                error = true;
            }

            return error ? false : true;
        });

		$(document).on("change", "[name='payment_method']", function () {
			var slot = $(this).data('slot');
			var val = $(this).find(':selected').val();
			$('.'+slot).hide();
			$('.'+val).show();
		});

		$(document).on("change", "#district", function () {
			var baseUrl = $('meta[name="baseUrl"]').attr('content');
			var id = $(this).val();
			var el = $(this);
			var html = '<option value="">--Loading--</option>';
			el.siblings('.thana').html(html);

			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type: "POST",
				url: baseUrl + '/getThana',
				data: "id=" + id,
				success: function (response) {
					var html = '<option value="">--থানা--</option>';
					if(response.length > 0){
						for (var item in response) {
							html +='<option value="'+response[item]['id']+'">'+response[item]['name']+'</option>';
						}
					}else{
						html +='<option value="">No data found</option>';
					}

					el.siblings('.thana').html(html);
				}
			});
		});

		$(document).on('click','.add-more',function(){

			let area = $('#area_html').html();

			html = '';
			html +='<div class="input-group address-container">';
			html +='<input type="text" class="form-control" name="warehouse_holding_no[]" placeholder="হোল্ডিং নম্বর" />';
			html +='<input type="text" class="form-control" name="warehouse_road_no[]" placeholder="রোড নম্বর" />';
			html +='<input type="text" class="form-control" name="warehouse_area_name[]" placeholder="এলাকার নাম" />';
			html +='<select class="form-control custom-select area_id" id="district" name="warehouse_area_id[]">';
			html +='<option value="" selected>এরিয়া</option>';
			html +=area;
			html +='</select>';
			html +='<select class="form-control custom-select location_id" name="warehouse_location_id[]">';
			html +='<option value="" selected>লোকেশন</option>';
			html +='</select>';
			html +='<span class="remove">-</span>';
			html +='</div>';

			$('.before').before(html);
		});
		
		$(document).on('click','.remove',function(){
			$(this).parent().remove(); 
		});

		$(document).on('change', '.area_id', function (e) {

			var area_id = $(this).val();
			let el = $(this);
			var baseUrl = $('meta[name="baseUrl"]').attr('content');
			el.closest('.address-container').find('.location_id').html('<option value="">Select Location</option>');

			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type: "POST",
				url: baseUrl + '/getLocations',
				data: "area_id=" + area_id,
				success: function (response) {
					var html = '<option value="">--Select Location--</option>';
					$.each(response, function(i, item) {
						html += '<option value="'+response[i].id+'">'+response[i].name+'</option>';
					});
					el.closest('.address-container').find('.location_id').html(html);
				}
			});

		});      

		$(document).on('change', '.location_id', function (e) {

			var location_id = $(this).val();
			let el = $(this);
			var baseUrl = $('meta[name="baseUrl"]').attr('content');
			el.closest('.address-container').find('.hub_id').html('<option value="">Select Location</option>');

			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type: "POST",
				url: baseUrl + '/getHub',
				data: "location_id=" + location_id,
				success: function (response) {
					var html = '<option value="">--Select Hub--</option>';
					$.each(response, function(i, item) {
						html += '<option value="'+response[i].branch_id+'">'+response[i].name+'</option>';
					});

					el.closest('.address-container').find('.hub_id').html(html);
				}
			});
		});