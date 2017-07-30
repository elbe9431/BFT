 <link type="text/css" href="css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
        <script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
        <script type="text/javascript">
		$(function(){
			// Dialog			
				$('#dialog').dialog({
					autoOpen: false,
					width: 680,
					buttons: {
						"Schließen": function() { 
							$(this).dialog("close"); 
						}
					}
				});

        	// Dialog Link
				$('#dialog_link').click(function(){
					$('#dialog').dialog('open');
					return false;
				});
		});
        </script>
        