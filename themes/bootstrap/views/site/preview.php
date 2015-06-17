<script type="text/javascript">
	$(document).ready(function() {
		var o;
		var c;
		var isClicked = false;
		$('#test-update').click(function(){
			// $("#siteloader").html('<object id="crs-object" style="width: 100%; height: 100%" data="http://crs.upd.edu.ph/"/>');
			// $("#siteloader").html('<iframe id="crs-object" src="https://crs.upd.edu.ph/" style="width:100%; height:100%;" frameborder="0"></iframe>');
			$("#siteloader").html('<object id="crs-object" style="width: 100%; height: 100%" data="http://localhost/crs/maroonscrs/"/>');

			setTimeout(function(){   //pumapasok siya sa code na ito
				// alert(document.getElementById('crs-object').contentWindow.document.body.innerHTML);
				o = $('#crs-object');
				c = o[0].contentDocument;

				$('#txt_login', c).val('jsyap');
				$('#pwd_password', c).val('1');

				$('input', o[0].contentDocument).each(function(input, value){
				if(input == 2){
				$(value).click(); //hindi siya nagcclick
				}
				});
				// alert("Done logging in."); //hindi na din nag aalert
			}, 3000);
		});
	});
</script>

<button class="btn btn-inverse">Inverse</button>
<button class="btn btn-success">Success</button>
<button class="btn btn-warning">Warning</button>
<button class="btn btn-danger">Error</button>
<button class="btn btn-info">Info</button>
<br/>
<br/>
<button class="btn btn-info" id="test-update">CRS Test</button>
<br/>
<br/>
<div id="siteloader" style="border: 2px solid blue; width: 100%; height: 600px;"></div>