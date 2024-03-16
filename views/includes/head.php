<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo $titulo;?></title>
	<link rel="icon" href="favicon.ico">
	<link href="<?php echo constant("URL");?>views/css/style.css" rel="stylesheet">
	<link href="<?php echo constant("URL");?>views/DataTable/css/dataTables.dataTables.css" rel="stylesheet">
	<link href="<?php echo constant("URL");?>views/DataTable/css/jquery.dataTables.css" rel="stylesheet">
	<style>
		#tabla_length > label > input{
			width: 100%;
			outline: 2px solid transparent;
			outline-offset: 2px;
			font-weight: 500;
			padding-top: 0.75rem;
			padding-bottom: 0.75rem;	
			padding-left: 1.25rem;
    	padding-right: 1.25rem;	
			background-color: transparent;
			--tw-border-opacity: 1;
			border-color: rgb(226 232 240 / var(--tw-border-opacity));
			border-width: 1.5px;
			border-radius: 0.25rem;
			letter-spacing: normal;
			word-spacing: normal;
			line-height: normal;
			text-transform: none;
			text-indent: 0px;
			text-shadow: none;
			display: inline-block;
			text-align: start;
			appearance: auto;
			-webkit-rtl-ordering: logical;
			cursor: text;
		}

		#tabla_length > label >select{
			outline: 2px solid transparent;
    	outline-offset: 2px;
			padding-top: 0.75rem;
			padding-bottom: 0.75rem;
			padding-left: 3rem;
			padding-right: 3rem;
			background-color: transparent;
			--tw-border-opacity: 1;
			border-color: rgb(226 232 240 / var(--tw-border-opacity));
			border-width: 1px;
			border-radius: 0.25rem;
			font-family: inherit;
			font-size: 100%;
			font-weight: inherit;
			line-height: inherit;
			color: inherit;
			margin: 0;
			align-items: center;
			white-space: pre;
			-webkit-rtl-ordering: logical;
			text-indent: 0px;
			text-shadow: none;
			display: inline-block;
			text-align: start;
		}

		.paginate_button{
			--tw-text-opacity: 1 !important;
			color: rgb(255 255 255 / var(--tw-text-opacity)) !important;
			padding: 0.5rem !important;
			background-color: rgb(49 61 74 / var(--tw-bg-opacity)) !important;
			border-radius: 0.375rem !important;
			-webkit-appearance: button !important;
			cursor: pointer !important;
			text-transform: none !important;
			font-family: inherit !important;
			font-size: 100% !important;
			font-weight: inherit !important;
			line-height: inherit !important;
			margin: 0 !important;
			margin-right: 2px !important;
		}
	</style>
</head>
<!-- ESTE HEAD YA LES DIJE QUE SE MUESTRA EN TODAS LAS VISTAS -->