<?php 


	function nvs_editor($textareaname, $width = "100%", $height = '450px', $val = '', $path = '', $currentpath = '') {
		global $module;
		$CKEditor = new CKEditor ();
		$CKEditor->returnOutput = true;
		if (preg_match ( "/^(Internet Explorer v([0-9])\.([0-9]))+$/", $client_info ['browser'] ['name'], $m )) {
			$jwplayer = ($m [2] < 8) ? false : true;
		} else {
			$jwplayer = true;
		}
		if ($jwplayer) {
			$CKEditor->config ['extraPlugins'] = 'jwplayer';
			$editortoolbar = array (array ('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', '-', 'Link', 'Unlink', 'Anchor', '-', 'Image', 'Flash', 'jwplayer', 'Table', 'Font', 'FontSize', 'RemoveFormat', 'Templates', 'Maximize' ), array ('Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote', 'CreateDiv', '-', 'TextColor', 'BGColor', 'SpecialChar', 'Smiley', 'PageBreak', 'Source', 'About' ) );
		} else {
			$editortoolbar = array (array ('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', '-', 'Link', 'Unlink', 'Anchor', '-', 'Image', 'Flash', 'Table', 'Font', 'FontSize', 'RemoveFormat', 'Templates', 'Maximize' ), array ('Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote', 'CreateDiv', '-', 'TextColor', 'BGColor', 'SpecialChar', 'Smiley', 'PageBreak', 'Source', 'About' ) );
		}
		$CKEditor->config ['skin'] = 'v2';
		$CKEditor->config ['entities'] = false;
		$CKEditor->config ['enterMode'] = 2;
		$CKEditor->config ['language'] = NV_LANG_INTERFACE;
		$CKEditor->config ['toolbar'] = $editortoolbar;
		$CKEditor->config ['pasteFromWordRemoveFontStyles'] = true;
		$CKEditor->basePath = NV_BASE_SITEURL . '' . NV_EDITORSDIR . '/ckeditor/';
		if (! empty ( $width )) {
			$CKEditor->config ['width'] = strpos ( $width, '%' ) ? $width : intval ( $width );
		}
		if (! empty ( $height )) {
			$CKEditor->config ['height'] = strpos ( $height, '%' ) ? $height : intval ( $height );
		}
		$CKEditor->textareaAttributes = array ("cols" => 80, "rows" => 10 );
		$CKEditor->config ['filebrowserBrowseUrl'] = NV_BASE_SITEURL . NV_ADMINDIR . "/index.php?" . NV_NAME_VARIABLE . "=upload&popup=1&path=" . $path . "&currentpath=" . $currentpath;
		$CKEditor->config ['filebrowserImageBrowseUrl'] = NV_BASE_SITEURL . NV_ADMINDIR . "/index.php?" . NV_NAME_VARIABLE . "=upload&popup=1&type=image&path=" . $path . "&currentpath=" . $currentpath;
		$CKEditor->config ['filebrowserFlashBrowseUrl'] = NV_BASE_SITEURL . NV_ADMINDIR . "/index.php?" . NV_NAME_VARIABLE . "=upload&popup=1&type=flash&path=" . $path . "&currentpath=" . $currentpath;
		if (! empty ( $admin_info ['allow_files_type'] )) {
			$CKEditor->config ['filebrowserUploadUrl'] = NV_BASE_SITEURL . NV_ADMINDIR . "/index.php?" . NV_NAME_VARIABLE . "=upload&" . NV_OP_VARIABLE . "=quickupload&currentpath=" . $currentpath;
		}
		if (in_array ( 'images', $admin_info ['allow_files_type'] )) {
			$CKEditor->config ['filebrowserImageUploadUrl'] = NV_BASE_SITEURL . NV_ADMINDIR . "/index.php?" . NV_NAME_VARIABLE . "=upload&" . NV_OP_VARIABLE . "=quickupload&type=image&currentpath=" . $currentpath;
		}
		if (in_array ( 'flash', $admin_info ['allow_files_type'] )) {
			$CKEditor->config ['filebrowserFlashUploadUrl'] = NV_BASE_SITEURL . NV_ADMINDIR . "/index.php?" . NV_NAME_VARIABLE . "=upload&" . NV_OP_VARIABLE . "=quickupload&type=flash&currentpath=" . $currentpath;
		}
		$val = nv_unhtmlspecialchars ( $val );
		return $CKEditor->editor ( $textareaname, $val );
	}
?>