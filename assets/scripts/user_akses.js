<script>
        jQuery(document).ready(function() {    
            Metronic.init(); // init metronic core components
            Layout.init(); // init current layout
            QuickSidebar.init(); // init quick sidebar
            Demo.init(); // init demo features
            
            UserAkses.init();
            UITree.init();
            
        });

        function getIDTree(id) {
        	var nodes = $(id).jstree('get_selected');
        	let str = nodes.toString();
			let hasil = str.replace(/,/g,' ');
        	return hasil;
        }

        var countCheckedAkses = function($table, checkboxClass) {
		  if ($table) {
		    // Find all elements with given class
		    var chkAll = $table.find(checkboxClass);
		    // Count checked checkboxes
		    var checked = chkAll.filter(':checked').length;
		    // Count total
		    var total = chkAll.length;    
		    // Return an object with total and checked values
		    return {
		      total: total,
		      checked: checked
		    }
		  }
		}

        function checkAkses() {
		  var result = countCheckedAkses($('#datatable_akses'), '.chk-akses');
		  
		  $('#myText').html(result.checked);
		  var p = document.getElementById('myText');
		  var text = p.textContent;
		  var number = Number(text);

		  if (number > 0){
		    btn_act.style.display = "block";
		  } else {
		    btn_act.style.display = "none";
		  }
		}

		function calc()
		{
			$('.checkall').click(function (event) {    
		        $('.chk-akses').prop('checked', this.checked);
		        var $checkboxes = $('.chk-akses');
		        var number = $checkboxes.filter(':checked').length;
		        
		        var p = document.getElementById('myText');
		  		
		        if (number > 0){
				    btn_act.style.display = "block";
				  } else {
				    btn_act.style.display = "none";
				  }
		    });
		}

		$(document).mouseup(function(e) 
		{
		    var container = $("#search-toggle-setting");
		    var btn = $("#search-btn-setting");
		    var x = document.getElementById("search-toggle-setting");

		    // if the target of the click isn't the container nor a descendant of the container
		    if (!container.is(e.target) && container.has(e.target).length === 0 && !btn.is(e.target)) 
		    {
		        x.style.display = "none";
		    }else if(btn.is(e.target)){
		    	
				if (x.style.display === "none") {
				  x.style.display = "block";
				} else {
				  x.style.display = "none";
				}
		    }
		});

		function save_akses() {
			var id_akses = $('#id_akses').val();
			var type = 1;
			if(id_akses !=""){
				var type = 2;
			}else{
				var id_akses = "";
			}
			var name = $('#nama_akses').val();
			var is_super = $('#is_super_akses').prop('checked');
			console.log(is_super);
			var user_right = getIDTree('#tree_1');
			if(name!=""){
				$("#btn-s-akses").attr("disabled", "disabled");
				$("#btn-rs-akses").attr("disabled", "disabled");
				$("#btn-r-akses").attr("disabled", "disabled");
				$.ajax({
					url: "<?php echo base_url("user/action_akses");?>",
					type: "POST",
					data: {
						type: type,
						id_akses : id_akses,
						name: name,
						is_super: is_super,
						user_right: user_right
					},
					cache: false,
					success: function(dataResult){

						var dataResult = JSON.parse(dataResult);
						if(dataResult.statusCode==200){
							$("#btn-s-akses").removeAttr("disabled");
							$('#frm-user-akses').find('input:text').val('');
							$("#success").show();
							$('#success').html('Data berhasil ditambahkan!');
							$("#success").fadeTo(1500, 500).slideUp(500, function() {
			                	$("#success").slideUp(500);
			                });						
						}
						else if(dataResult.statusCode==201){
						    $("#success").show();
							$('#success').html('Data berhasil diubah!');
							$("#success").fadeTo(1500, 500).slideUp(500, function() {
			                	$("#success").slideUp(500);
			                });	
						}
					},
					error: function() {
						$("#failed").show();
						$('#failed').html('Gagal melakukan aksi!');
						$("#failed").fadeTo(2000, 500).slideUp(500, function() {
		                	$("#failed").slideUp(500);
		                });
					}
				});

				setTimeout(function(){
				   window.location.reload();
				}, 1600);
			}
			else{
				alert('Please fill all the field !');
			}
		}
		$('#btn-s-akses').on('click', function() {
			save_akses();
			$('#add_akses').modal('hide');
		});
		$('#btn-rs-akses').on('click', function(e) {
			e.preventDefault();
			save_akses();
			var $t = $(this),
			target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];

			$(target)
				.find("input,textarea,select")
					.val('')
					.end()
				.find("input[type=checkbox], input[type=radio]")
					.prop("checked", "")
					.end();
			$.uniform.update();
		});
		$('#btn-r-akses').on('click', function(e) {
			e.preventDefault();
			var $t = $(this),
			target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];

			$(target)
				.find('input,textarea,select')
					.val('')
					.end()
				.find('input[type="checkbox"], input[type="radio"]')
					.prop("checked", false)
					.change();

			$.uniform.update();
		});

		$('#53F').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});
		$('#53E').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}			
		});
		$('#53D').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}		
		});
		$('#53D').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}		
		});
		$('#53D').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}		
		});
		function cae_akses(id_akses) {
			var x = document.getElementById("53C");
			if(check_user_right(x.id) == 0){
				$('#modal_unauthorized').modal('show');
			}else{
	            // Set data to Form Edit
	 			$('#tree_1').jstree(true).deselect_all();
	            $('#id_akses').val(id_akses);
	            $.ajax({
					url: "<?php echo base_url("user/get_edit_data");?>",
					type: "POST",
					data: {
						id_akses: id_akses
					},
					cache: false,
					success: function(dataResult){
						// console.log(dataResult);
						var json_data = JSON.parse(dataResult);
						var is_super = json_data.is_Super;
						var user_right = json_data.user_right;

						$('#id_akses').val(json_data.group_user_id);
						$('#nama_akses').val(json_data.user_name);

						if(is_super!=='1'){is_super = false}else{ is_super=true;}
						$('#is_super_akses').prop("checked", is_super);

						// console.log(id_akses);
						// console.log(json_data.user_name);
						// console.log(is_super);
						// console.log(user_right);

						var cbd = user_right.split(" ");
						var arrayLength = cbd.length;
						// console.log(cbd);
						for (var i = 0; i < arrayLength; i++) {
						    $('#tree_1').jstree('select_node', cbd);
						}
						$.uniform.update();
					}
				});

				$('#add_akses').modal('show');
			}
		}

		$('#53B').on('click', function() {
			if(check_user_right(this.id) == 0){
				$('#modal_unauthorized').modal('show');
			}else{
				$('#add_akses').modal('show');
			}		
		});

		$('#btn-h-akses').on('click', function() {
			// Get userid from checked checkboxes
				var akses_arr = [];
				$(".chk-akses:checked").each(function(){
					var aksesid = $(this).val();

					akses_arr.push(aksesid);
				});

				// Array length
				var length = akses_arr.length;

				if(length > 0){

				// AJAX request
					$.ajax({
						url: "<?php echo base_url("user/action_akses");?>",
						type: "POST",
						data: {
							type: 3,
							id_akses : akses_arr
						},
						cache: false,
						success: function(dataResult){

							var dataResult = JSON.parse(dataResult);
							if(dataResult.statusCode==202){
							    $("#success").show();
								$('#success').html('Data berhasil dihapus!');
								$("#success").fadeTo(1500, 500).slideUp(500, function() {
				                	$("#success").slideUp(500);
				                });
							}
						},
						error: function() {
							$("#failed").show();
							$('#failed').html('Gagal melakukan aksi!');
							$("#failed").fadeTo(2000, 500).slideUp(500, function() {
			                	$("#failed").slideUp(500);
			                });
						}
					});
					$('#del_akses').modal('hide');

					setTimeout(function(){
					   window.location.reload();
					}, 1600);
				}
		});

		$('#btn-a-akses').on('click', function() {
			// Get userid from checked checkboxes
				var akses_arr = [];
				$(".chk-akses:checked").each(function(){
					var aksesid = $(this).val();

					akses_arr.push(aksesid);
				});

				// Array length
				var length = akses_arr.length;

				if(length > 0){

				// AJAX request
					$.ajax({
						url: "<?php echo base_url("user/action_akses");?>",
						type: "POST",
						data: {
							type: 4,
							id_akses : akses_arr
						},
						cache: false,
						success: function(dataResult){

							var dataResult = JSON.parse(dataResult);
							if(dataResult.statusCode==202){
							    $("#success").show();
								$('#success').html('Data berhasil diarsipkan!');
								$("#success").fadeTo(1500, 500).slideUp(500, function() {
				                	$("#success").slideUp(500);
				                });
							}
						},
						error: function() {
							$("#failed").show();
							$('#failed').html('Gagal melakukan aksi!');
							$("#failed").fadeTo(2000, 500).slideUp(500, function() {
			                	$("#failed").slideUp(500);
			                });
						}
					});
					$('#del_akses').modal('hide');

					setTimeout(function(){
					   window.location.reload();
					}, 1600);
				}
		});

		$('#btn-rf-akses').on('click', function(e) {
			$('#chk-arsip-akses').prop("checked", false);
			$('#keyword-akses').val("");
			$('#keyword-akses-front').val("");

			$.uniform.update();
		});

		function search_akses() {
			var keyword = $("#keyword-akses").val();
			if(keyword==''){
				keyword = 'none';
			}
			var is_ar = $("#chk-arsip-akses").prop("checked");
			var urlist = "<?php echo base_url('user/akses');?>";
			
			let hostName = window.location.hostname + ":" + window.location.port;
		    let url = new URL(
		      urlist + "/" + keyword + "/" + is_ar + "/"
		    );
		    location.href = url.href;
		}
		$('#btn-sf-akses').on('click', function(e) {
			search_akses();
		});

		$("#keyword-akses-front").on('keyup', function (e) {
		    if (e.key === 'Enter' || e.keyCode === 13) {
				var keyword = $("#keyword-akses-front").val();
		    	$("#keyword-akses").val(keyword);
		        search_akses();
		    }
		});

</script>