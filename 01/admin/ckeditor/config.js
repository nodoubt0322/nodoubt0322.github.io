/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	config.extraPlugins = 'youtube';
	config.youtube_width = '640';
	config.youtube_height = '480';	
	config.allowedContent = true;
	
	config.language = 'zh';
	config.toolbar = 'Basic';
	config.uiColor = '#E6E6E6';
	config.toolbar = 'TadToolbar';
	config.height = 300; //高度
	config.resize_maxWidth = 950; //改變大小的最小寬度
    config.toolbar_TadToolbar =
    [
    ['Source','-','Copy','Paste','PasteText','PasteFromWord'],
    ['Undo','Redo','-'],
    ['Link','Unlink'],
    ['Image','Table','HorizontalRule','SpecialChar','PageBreak'],
    ['Bold','Italic','Underline','Subscript','Superscript'],
    ['NumberedList','BulletedList','Outdent','Indent'],
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','FontSize','TextColor','Maximize','Youtube']
    ];
	
	<!--原始設定
	    [
    ['Source','-','Templates','-','Cut','Copy','Paste','PasteText','PasteFromWord'],
    ['Undo','Redo','-','SelectAll','RemoveFormat'],
    ['Link','Unlink'],
    ['Image','Flash','Table','HorizontalRule','SpecialChar','PageBreak'],
    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
     ['Format','FontSize','-','TextColor','BGColor']
    ];
	-->
	config.filebrowserBrowseUrl = '/nodoubt/01/admin/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = '/nodoubt/01/admin/ckfinder/ckfinder.html?Type=Images';
	<!--config.filebrowserFlashBrowseUrl = '/nodoubt/01/admin/ckfinder/ckfinder.html?Type=Flash';-->
	config.filebrowserUploadUrl = '/nodoubt/01/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'; //可上傳一般檔案
	config.filebrowserImageUploadUrl = '/nodoubt/01/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';//可上傳圖檔
	<!--config.filebrowserFlashUploadUrl = '/nodoubt/01/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';//可上傳Flash檔案-->
	config.enterMode = CKEDITOR.ENTER_P; 	
};
